<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * CloudSend
 *
 * CloudSend was created for companies such as agencies that must constantly send files to the same customers or receive files from the same customers.
 *
 * @package    CloudSend
 * @author     cloudworxx.us
 * @copyright  Copyright (c) 2013 cloudworxx.us - all rights reserved
 * @license    MIT License
 * @link       http://www.cloudworxx.us/
 * @since      Version 1.0
 * @filesource
 *
 *
 *
 * The MIT License (MIT)
 * Copyright (c) 2013 cloudworxx.us
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
 * documentation files (the "Software"), to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and
 * to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
 * TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
 * CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 */
class User extends CWX_Controller {
    
    public function index() {
	redirect( 'admin/user/all_entries' );
    }
    
    public function all_entries() {	
        $this->_noSuperAdmin();
        $this->load->model('files/mFiles');

        $errortype = isset($_GET['errortype']) ? $_GET['errortype'] : false;
        $errormsg = isset($_GET['errormsg']) ? urldecode( $_GET['errormsg'] ) : '';

        $_data = array(
            'errortype' => $errortype,
            'errormsg' => $errormsg,
            'site' => 'user/all_entries',
            'title' => __('user_title_user'),
            'items' => $this->mUser->getUsers()
        );

        $this->load->view( 'master', $_data );	
    }
    
    public function add_user( $errortype = false, $errormsg = '' ) {
        $this->_noSuperAdmin();
        require APPPATH.'libraries/csfolder.php';
        
        $this->load->helper( 'form' );
        $_folder = new csFolder();
        
        $_data = array(
            'errortype' => $errortype,
            'errormsg' => $errormsg,
            'site' => 'user/add_user',
            'title' => __('user_title_adduser'),
            'admins' => $this->mUser->getAllAdminUser(),
            'folder' => $_folder->getSelect( 0, 1, NULL, 'inputFolder', 'span3', '' )
        );

        $this->load->view( 'master', $_data );		
    }
    
    public function verify_user() {
        $this->_noSuperAdmin();

        $this->load->library( 'form_validation' );

        $config = array(
            array( 'field' => 'inputName',	    'label' => __('user_lbl_name'),		'rules' => 'trim|required|min_length[3]' ),
            array( 'field' => 'inputEmail',	    'label' => __('user_lbl_email'),		'rules' => 'trim|required|valid_email|callback_email_unique' ),
            array( 'field' => 'inputPassword',	    'label' => __('user_lbl_password'),		'rules' => 'trim|required|min_length[5]|matches[inputPassword2]' ),
            array( 'field' => 'inputPassword2',	    'label' => __('user_lbl_passwordagain'),	'rules' => 'trim|required|min_length[5]' ),
            array( 'field' => 'inputTimezone',	    'label' => __('user_lbl_timezone'),		'rules' => 'trim|required' ),
            array( 'field' => 'inputDateformat',    'label' => __('user_lbl_dateformat'),	'rules' => 'trim|required' ),
            array( 'field' => 'inputLevel',	    'label' => __('user_lbl_level'),		'rules' => 'trim|required|is_natural' ),
            array( 'field' => 'inputEmailReceive',  'label' => __('user_lbl_recipient'),	'rules' => 'trim|required|exact_length[27]'),
            array( 'field' => 'inputFolder',        'label' => __('user_lbl_folder'),           'rules' => 'trim')
        );


        if( $this->input->post('inputLevel') == '3' ) {
            $add = array( 'field' => 'inputURL',    'label' => __('user_lbl_url'),  'rules' => 'trim|required|min_length[3]|callback_only_seo' );

            $config[] = $add;	    
        }

        $this->form_validation->set_rules( $config );

        if( $this->form_validation->run($this) == false ) {
            $errortype = 'error';
            $errormsg = validation_errors( ' ','<br />' );
            $this->add_user( $errortype, $errormsg );
        } else {  
            $_addUser = $this->mUser->addUser();

            if( $_addUser != false ) {
                $this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' has added a new user to the system: {$this->input->post('inputName')} with level {$this->input->post('inputLevel')}.", 'size' => NULL ) );

                $_sendEmail = $this->input->post('inputSendEmail');
                $_password = $this->input->post('inputPassword');
                $_statusEmail = true;
                $_statusUpload = true;

                if( !empty( $_sendEmail ) && $_sendEmail == 'sendEmail' && preg_match( "/^(usr_)[a-z0-9]{14}.[a-z0-9]{8}/", $_addUser ) )  {
                    $_statusEmail = $this->_sendAccessEmail( $_addUser, $_password );
                    if( $_statusEmail != false ) $this->mGlobal->log( array( 'type' => "error", 'message' => "New user email sent to '{$this->input->post('inputEmail')}'.", 'size' => NULL ) );
                }

                if( preg_match( "/^(usr_)[a-z0-9]{14}.[a-z0-9]{8}/", $_addUser ) ) {
                    $_statusUpload = $this->_uploadFile();

                    if( isset( $_statusUpload['type'] ) && $_statusUpload['type'] == 'error' ) {
                        $_statusUpload = false;
                    } else if( isset( $_statusUpload['file_name'] ) ) {
                        $_statusUpload = $this->mUser->updateUser( $_addUser, array( 'userFile' => $_statusUpload['file_name'] ) );
                    }
                }

                if( $_statusEmail && $_statusUpload ) {
                    redirect( 'admin/user/all_entries?errortype=success&errormsg='.urlencode( __('user_msg_addok') ) );
                } else if( !$_statusEmail && $_statusUpload ) {
                    redirect( 'admin/user/all_entries?errortype=error&errormsg='.urlencode( __('user_msg_addoknoemail') ) );
                } else if( $_statusEmail && !$_statusUpload ) {
                    redirect( 'admin/user/all_entries?errortype=error&errormsg='.urlencode( __('user_msg_addoknoback') ) );
                } else if( !$_statusEmail && !$_statusUpload ) {
                    redirect( 'admin/user/all_entries?errortype=error&errormsg='.urlencode( __('user_msg_addoknobackemail') ) );
                }


            } 
        }	
    }
    
    public function only_seo( $str ) {
        if( !preg_match("/^[a-z0-9-]+$/", $str) ) {
            $this->form_validation->set_message( 'only_seo', __('user_msg_seofielderror') );
            return false;	
        } else {
            $_available = $this->mUser->urlAvailable( $str );
            if( !$_available ) {
                $this->form_validation->set_message( 'only_seo', __('user_msg_urlnotavailable') );
                return false;
            }
            return true;
        }
    }
    
    public function email_unique( $str ) {
        $_emailExists = $this->mUser->emailExists( $str );

        if( $_emailExists ) {
            $this->form_validation->set_message( 'email_unique', __('user_msg_emailexists') );
            return false;		    
        }

        return true;
    }
    
    public function edit_user( $errortype = false, $errormsg = '', $_edit_user = NULL ) {
        require APPPATH.'libraries/csfolder.php';
        $this->load->helper( array( 'form' ) );

        $_user = $this->input->get('user');
        $_folder = new csFolder();
        
        if( !isset( $_user ) || empty( $_user ) ) {
            if( $_edit_user == NULL ) {
                $_user = $this->session->userdata('userUnique');
            } else {
                $this->_noSuperAdmin();
                $_user = $_edit_user;
            }
        }
        
        $_details = $this->mUser->getUser( $_user );

        $_data = array(
            'errortype' => $errortype,
            'errormsg' => $errormsg,
            'site' => 'user/edit_user',
            'title' => __('user_title_edituser'),
            'details' => $_details,
            'admins' => $this->mUser->getAllAdminUser(),
            'folder' => $_folder->getSelect( 0, 1, $_details->defaultFolderID, 'inputFolder', 'span3', '' )
        );

        $this->load->view( 'master', $_data );
    }

    public function change_user() {
        $this->load->library( 'form_validation' );

        $_user = $this->input->post( 'user' );
        $_oldUser = $this->mUser->getUser( $_user );

        $config = array(
            array( 'field' => 'user',		    'label' => __('user_lbl_user'),	    'rules' => 'required|min_length[20]' ),
            array( 'field' => 'inputName',	    'label' => __('user_lbl_name'),	    'rules' => 'trim|required|min_length[3]' ),
            array( 'field' => 'inputTimezone',	    'label' => __('user_lbl_timezone'),	    'rules' => 'trim|required' ),
            array( 'field' => 'inputDateformat',    'label' => __('user_lbl_dateformat'),   'rules' => 'trim|required' ),
            array( 'field' => 'inputLevel',	    'label' => __('user_lbl_level'),	    'rules' => 'trim|required|is_natural' ),
            array( 'field' => 'inputEmailReceive',  'label' => __('user_lbl_recipient'),    'rules' => 'trim|required|exact_length[27]'),
            array( 'field' => 'inputFolder',        'label' => __('user_lbl_folder'),       'rules' => 'trim')
        );


        if( $this->input->post('inputLevel') == '3' && $this->input->post('inputURL') != $_oldUser->userURL ) {
            $add = array( 'field' => 'inputURL',    'label' => __('user_lbl_url'),  'rules' => 'trim|required|min_length[3]|callback_only_seo' );

            $config[] = $add;	    
        }

        if( $this->input->post('inputEmail' ) != $_oldUser->emailAddress ) {
            $addEmail = array( 'field' => 'inputEmail',  'label' => __('user_lbl_email'),	'rules' => 'trim|required|valid_email|callback_email_unique' );
        } else {
            $addEmail = array( 'field' => 'inputEmail',  'label' => __('user_lbl_email'),	'rules' => 'trim|required|valid_email' );
        }

        $config[] = $addEmail;

        $_password = $this->input->post('inputPassword');

        if( isset( $_password ) && !empty( $_password ) ) {
            $config2 = array(
                array( 'field' => 'inputPassword',	'label' => __('user_lbl_password'),	    'rules' => 'required|min_length[6]|matches[inputPassword2]' ),
                array( 'field' => 'inputPassword2',	'label' => __('user_lbl_passwordagain'),    'rules' => 'required|min_length[6]' )
            );

            $config = array_merge( $config, $config2 );
        }


        $this->form_validation->set_rules( $config );

        if( $this->form_validation->run( $this ) == false ) {
            $errortype = 'error';
            $errormsg = validation_errors( ' ','<br />' );
            $this->edit_user( $errortype, $errormsg, $_user );
        } else {
            $_updated = $this->mUser->changeUser();

            if( $_updated != false ) {
                $this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' changed details of user '{$this->input->post('inputName')}'.", 'size' => NULL ) );

                $_changeUser = $this->input->post( 'user' );

                $_sendEmail = $this->input->post('inputSendEmail');
                $_password = $this->input->post('inputPassword');

                $_statusEmail = true;
                $_statusUpload = true;

                if( !empty( $_sendEmail ) && $_sendEmail == 'sendEmail' && preg_match( "/^(usr_)[a-z0-9]{14}.[a-z0-9]{8}/", $_changeUser ) )  {
                    if( isset( $_password ) && !empty( $_password ) ) { // only try sending email, if password is changed... otherwise we have not password, because of MD5 encryption!
                        $_statusEmail = $this->_sendAccessEmail( $_changeUser, $_password );
                        if( $_statusEmail != false ) $this->mGlobal->log( array( 'type' => "error", 'message' => "Email for userdata change sent to '{$this->input->post('inputEmail')}'.", 'size' => NULL ) );
                    }
                }

                if( preg_match( "/^(usr_)[a-z0-9]{14}.[a-z0-9]{8}/", $_changeUser ) ) {
                    $_statusUpload = $this->_uploadFile();

                    if( isset( $_statusUpload['type'] ) && $_statusUpload['type'] == 'error' ) {
                        $_statusUpload = false;
                    } else if( isset( $_statusUpload['file_name'] ) ) {
                        $_statusUpload = $this->mUser->updateUser( $_changeUser, array( 'userFile' => $_statusUpload['file_name'] ) );
                    }
                }
                if( $this->session->userdata['level'] != '1' ) {
                    $_redirect = 'admin/dashboard/index';
                } else {
                    $_redirect = 'admin/user/all_entries';
                }
                if( $_statusEmail && $_statusUpload ) {
                    redirect( $_redirect.'?errortype=success&errormsg='.urlencode( __('user_msg_editok') ) );
                } else if( !$_statusEmail && $_statusUpload ) {
                    redirect( $_redirect.'?errortype=error&errormsg='.urlencode( __('user_msg_editoknoemail') ) );
                } else if( $_statusEmail && !$_statusUpload ) {
                    redirect( $_redirect.'?errortype=error&errormsg='.urlencode( __('user_msg_editoknoback') ) );
                } else if( !$_statusEmail && !$_statusUpload ) {
                    redirect( $_redirect.'?errortype=error&errormsg='.urlencode( __('user_msg_editoknobackemail') ) );
                }


            } else {
                $errortype = 'error';
                $errormsg = __('user_msg_editerror');
                $this->edit_user( $errortype, $errormsg );				
            }
        }
    } 
    
    public function delete_user() {
        $this->_noSuperAdmin();

        $_user = $this->input->get( 'user' );
        $_userDetails = $this->mUser->getUser( $_user );
        $_totalSuperadmins = $this->mUser->countSuperAdminUser();

        if( $_userDetails->level == '1' && $_totalSuperadmins == 1 ) {
                redirect( 'admin/user/all_entries?errortype=error&errormsg='.urlencode( __('user_msg_lastsuperadmin') ) );
        } else {		
                if( isset( $_user ) && !empty( $_user ) ) {
                    if( $this->mUser->deleteUser( $_user ) ) {	

                        $this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' deleted user '{$_userDetails->companyName}'.", 'size' => NULL ) );
                        redirect('admin/user/all_entries?errortype=success&errormsg='.urlencode( __('user_msg_deletesuccess') ));		
                    } else {
                        $this->mGlobal->log( array( 'type' => "error", 'message' => "User '{$this->session->userdata['companyName']}' tried to delete user '{$_userDetails->companyName}' but a database error occured.", 'size' => NULL ) );
                        redirect('admin/user/all_entries?errortype=error&errormsg='.urlencode( __('user_msg_deletedberror') ));
                    }
                } else {
                    $this->mGlobal->log( array( 'type' => "error", 'message' => "User '{$this->session->userdata['companyName']}' tried to delete user '{$_userDetails->companyName}' but a parameter occured.", 'size' => NULL ) );
                    redirect('admin/user/all_entries?errortype=error&errormsg='.urlencode( __('user_msg_deleteargerror') ));
                }	
        }
    }    

        
    public function published_user() {
        $this->_noSuperAdmin();

        $_is = $this->input->get( 'is' );
        $_user = $this->input->get( 'user' );
        $_userDetails = $this->mUser->getUser( $_user );
        $_totalSuperadmins = $this->mUser->countSuperAdminUser();

        if( $_userDetails->level == '1' && $_totalSuperadmins == 1 ) {
            redirect( 'admin/user/all_entries?errortype=error&errormsg='.urlencode( __('user_msg_lastsuperadmin') ) );
        } else {
            if( isset( $_is ) && isset( $_user ) && !empty( $_user ) ) {
                if( $_is == '1' ) {
                            $_set = '0';
                } else {
                            $_set = '1';
                }

                if( $this->mUser->setPublishedUser( $_set, $_user ) ) {
                    $this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' has changed the published state of user '{$_userDetails->companyName}' to '{$_set}'.", 'size' => NULL ) );
                    redirect( 'admin/user/all_entries?errortype=success&errormsg='.urlencode( __('user_msg_statussuccess') ) );
                } else {
                    $this->mGlobal->log( array( 'type' => "error", 'message' => "User '{$this->session->userdata['companyName']}' tried to change published state of user '{$_userDetails->companyName}' but a database error occured.", 'size' => NULL ) );
                    redirect( 'admin/user/all_entries?errortype=error&errormsg='.urlencode( __('user_msg_statuserror') ) );
                }
            } else {
                $this->mGlobal->log( array( 'type' => "error", 'message' => "User '{$this->session->userdata['companyName']}' tried to change published state of user '{$_userDetails->companyName}' but a parameter error occured.", 'size' => NULL ) );
                redirect( 'admin/user/all_entries?errortype=error&errormsg='.urlencode( __('user_msg_statusnotavailable') ) );
            }
        }
    }
    
    private function _sendAccessEmail( $_user = NULL, $_password = NULL ) {
        if( !empty( $_user ) && !empty( $_password ) && preg_match( "/^(usr_)[a-z0-9]{14}.[a-z0-9]{8}/", $_user ) ) {
            $_details = $this->mUser->getUser( $_user );

            if( $_details != false ) {
                $this->load->library( 'email' );

                $emailset = emailconfig();

                $this->email->initialize( $emailset );

                $_fromEmail = $this->session->userdata( 'emailAddress' );
                $_fromName = $this->session->userdata( 'companyName' );
                $_emailBody = $this->mGlobal->getConfig('ADD_USER_EMAIL')->configVal;
                $_emailSubject = $this->mGlobal->getConfig('ADD_USER_SUBJECT')->configVal;
                $_productName = $this->mGlobal->getConfig('PRODUCT_NAME')->configVal;

                if( $_details->level == '3' ) {
                    $_url = site_url( '/'.$_details->userURL );
                } else {
                    $_url = site_url( 'admin/account/login' );
                }

                $_emailBody = str_replace( '{name}',$_details->companyName, $_emailBody );
                $_emailBody = str_replace( '{url}',$_url, $_emailBody );
                $_emailBody = str_replace( '{email}',$_details->emailAddress, $_emailBody );
                $_emailBody = str_replace( '{password}',$_password, $_emailBody );
                $_emailBody = str_replace( '{product}',$_productName, $_emailBody );
                $_emailSubject = str_replace( '{product}', $_productName, $_emailSubject );

                $this->email->clear( TRUE );

                $this->email->to( $_details->emailAddress );
                $this->email->from( $_fromEmail, $_fromName );
                $this->email->subject( $_emailSubject );
                $this->email->message( $_emailBody );
                $this->email->set_alt_message( strip_tags( $_emailBody ) );

                if( $this->email->send() ) {
                    return true;
                }		

                return false;
            }
        }

        return false;
    }
    
    private function _uploadFile() {
        if ( $_FILES['userfile']['error'] != UPLOAD_ERR_NO_FILE ) {

            $this->load->library( 'upload' );

            $config['upload_path'] = FCPATH.'data'.DS.'backgrounds'.DS;
            $config['allowed_types'] = 'jpg';
            $config['encrypt_name'] = TRUE;

            $this->upload->initialize( $config );

            if( $this->upload->do_upload() ) {
                $_return = $this->upload->data();
            } else {
                $_return = array('type' => 'error','message' => $this->upload->display_errors());
            }

            return $_return;
        }

        return true;
    } 
	    
    private function _noSuperAdmin() {
        if( $this->session->userdata['level'] != '1' ) {
            redirect( 'admin/dashboard/access' );
        }	
    }
}