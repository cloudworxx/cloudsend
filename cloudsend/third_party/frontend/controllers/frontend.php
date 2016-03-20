<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
 
class Frontend extends CWX_Controller {
    
    var $edituser = '';
    
    public function index() {	
		$_user = $this->uri->segment(1);

		if( isset( $_user ) && !empty( $_user ) && preg_match("/^[a-zA-Z0-9-_]+$/", $_user) ) {
		    
		    if( isset( $this->session->userdata['frontlogin'] ) && $this->session->userdata['frontlogin'] == true && $this->session->userdata['frontuser'] == $_user ) {
			$_details = $this->mFrontend->getDetailsbyURL( $_user );
		    
			if( $_details != false ) {				
			    $this->session->set_userdata('importUnique',uniqid('imp_',true));
			    $this->session->set_userdata('fileByCustomer','1');

			    $errortype = isset($_GET['errortype']) ? $_GET['errortype'] : false;
			    $errormsg = isset($_GET['errormsg']) ? urldecode( $_GET['errormsg'] ) : '';
			    
			    $_data = array(
				'title' => __('front_title_welcome'),
				'site' => 'frontend/dashboard',
				'user' => $_details,
				'addnavi' => true,
				'errortype' => $errortype,
				'errormsg' => $errormsg,
				'allowupload' => ( $_details->userCanUpload == '1' ) ? 'yes' : 'no',
				'showfree' => $this->mGlobal->getConfig('SHOW_FREESPACE_USER')->configVal,
				'diskfree' => disk_free_space( FCPATH ),
				'disktotal' => disk_total_space( FCPATH ),
                                'folder' => ( ( isset( $_details->defaultFolderID ) && !is_null( $_details->defaultFolderID ) && !empty( $_details->defaultFolderID ) ) ? $_details->defaultFolderID : '' )
			    );
			    
			    if( $_details->userCanUpload == '1' ) {		    
				$this->load->view( 'frontend', $_data );
			    } else {
				redirect( $_user.'/userfiles' );
			    }

			} else {
			    redirect( $_user.'/error' );
			}
		    } else {
			redirect( $_user.'/login' );
		    }
		} else {
		    $_data = array(
			'title' => __('front_title_welcome'),
			'site' => 'frontend/index',
			'header' => 'header'
		    );
		    
		    $this->load->view( 'frontend', $_data );	
		}
	
    }
    
    public function login() {
		$_user = $this->uri->segment(1);
		
		if( isset( $this->session->userdata['frontlogin'] ) && $this->session->userdata['frontlogin'] == true && $this->session->userdata['frontuser'] == $_user ) {
		    redirect( $_user );
		} else {
		    $_details = $this->mFrontend->getDetailsbyURL( $_user );
		    
		    if( $_details != false ) {
			$_data = array(
			    'title' => __('front_title_login'),
			    'site' => 'frontend/login',
			    'user' => $_details,
			    'header' => 'header'
			);

			$this->load->view( 'frontend', $_data );	
		    } else {
			redirect( $_user.'/error' );
		    }
		}
    }
    
    public function verify() {
		$this->load->helper( array('form') );
		$this->load->library('form_validation');
		
		$config = array(
		    array( 'field' => 'inputPassword',	'label' => __('front_lbl_password'),	'rules' => 'trim|required' ),
		    array( 'field' => 'userID',		'label' => __('front_lbl_user'),	'rules' => 'trim|required|alpha_point')
		);
		
		$this->form_validation->set_rules( $config );
		
		if( $this->form_validation->run() == false ) {
		    $_return = array(
			'type' => 'error',
			'message' => validation_errors( ' ', '<br />' )
		    );
		} else {
		    $_verified = $this->mFrontend->verifyPassword();
		    $_details = $this->mFrontend->userDetails( $this->input->post('userID') );
		    
		    if( $_verified != false && $_details != false ) {
			$this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$_details->companyName}' has been logged into frontend '{$_details->userURL}'.", 'size' => NULL ) );
			$_session = array(
			    'frontlogin' => true,
			    'frontuser' => $_details->userURL,
			    'userReceiveNot' => $_details->userReceiveNot,
			    'userUnique' => $this->input->post('userID'),
			    'userid' => $this->input->post('userID')
			);
			
			$this->session->set_userdata( $_session );
			
			$_return = array(
			    'type' => 'success'
			);
		    } else {
			$this->mGlobal->log( array( 'type' => "info", 'message' => "Someone tried to login to frontend '{$_details->userURL}' but password wasn't valid.", 'size' => NULL ) );
			$_return = array(
			    'type' => 'error',
			    'message' => __('front_msg_novalidpassword')
			);
		    }
		}	
		
		$this->output
			->set_status_header( '200' )
			->set_content_type( 'application/json' )
			->set_output( json_encode( $_return ) );
	
    }
    
    public function download() {
		$_user = $this->uri->segment(1);
		$_file = $this->uri->segment(3);
		
		if( isset( $this->session->userdata['frontlogin'] ) && $this->session->userdata['frontlogin'] == true && $this->session->userdata['frontuser'] == $_user ) {
		    $_userDetails = $this->mFrontend->getDetailsbyURL( $_user );
		    
		    if( $_userDetails != false ) {
			$_f2uTemp = $this->mFrontend->fileForUser( $_userDetails->userUniqueID, $_file );
			$_fileTemp = $this->mFrontend->fileIsPublic( $_file );
			$_details = $this->mFrontend->fileDetails( $_file );
			
			if( $_userDetails->userCanDownload == '1' ) {
			    if( $_details->fileUploadBy == $_userDetails->userUniqueID ) {
				$_userCan = true;
			    } else {
				$_userCan = false;
			    }
			} else {
			    $_userCan = false;
			}
			
			if( $_f2uTemp != false OR $_fileTemp != false OR $_userCan != false ) {

			    $file = FCPATH.'data/files/'.$_details->fileNewName;

			    if( file_exists( $file ) ) {	
			    $_downType = $this->mGlobal->getConfig('DOWNLOAD_TYPE')->configVal;
			    
				if( $_downType == 'normal' ) {
				    header('Content-type: '.$_details->fileType);
				    header('Content-Disposition: attachment; filename="' . $_details->fileName . '"');
				    header('Content-Transfer-Encoding: binary');
				    header('Content-Length: ' . filesize( $file ) );
				    header('Accept-Ranges: bytes');

				    @readfile( $file );
				} else {
				    $_chunkSize = (int)$this->mGlobal->getConfig('CHUNKED_SIZE')->configVal;
				    
				    header('Content-type: '.$_details->fileType);
				    header('Content-Disposition: attachment; filename="' . $_details->fileName . '"');
				    header('Content-Transfer-Encoding: binary');
				    header('Content-Length: ' . filesize( $file ) );
				    header('Connection: Keep-Alive');
				    header('Expires: 0');
				    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				    header('Accept-Ranges: bytes');

				    ob_clean();
				    $handle = fopen($file, "rb");
				    $chunksize=(filesize($file)/$_chunkSize);

				    set_time_limit(0);
				    while (!feof($handle)) {
					echo fgets($handle, $chunksize);
					flush();
				    }
				    fclose($handle);			
				}
				$this->mFrontend->updateFileCount( $_file );
				$this->mGlobal->log( array( 'type' => "down", 'message' => "Frontend user '{$this->session->userdata['userid']}' downloaded file '{$_details->fileName}'.", 'data' => $_file, 'size' => $_details->fileSize ) );
				
			    } else {
				$this->mGlobal->log( array( 'type' => "error", 'message' => "Frontend user '{$this->session->userdata['userid']}' tried to download file '{$_details->fileName}' but it does not exist on the server.", 'data' => $_file, 'size' => $_details->fileSize ) );
				redirect( $_user.'/error' );
			    }

			} else {
			    redirect( $_user.'/error' );
			}
		    } else {
			redirect( $_user.'/error' );
		    }
		    
		} else {
		    redirect( $_user );
		}
    }
    
    public function upload() {	
		$_user = $this->uri->segment(1);
		$_details = $this->mFrontend->getDetailsbyURL( $_user );
		if( $_details != false ) {
		    if( $_details->userCanUpload == '0' ) exit;
		} else {
		    exit;
		}
	
        $this->load->helper("upload.class");

        $upload_handler = new UploadHandler();

        header('Pragma: no-cache');
        header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Vary: accept');
        header('Content-Disposition: inline; filename="files.json"');
        header('X-Content-Type-Options: nosniff');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT');
        header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'OPTIONS':
                break;
            case 'HEAD':
            case 'GET':
                $upload_handler->get();
                break;
            case 'POST':
                if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
                    $upload_handler->delete();
                } else {
                    $upload_handler->post();
                }
                break;
            case 'DELETE':
                $upload_handler->delete();
                break;
            default:
                header('HTTP/1.1 405 Method Not Allowed');
        }

    }    
    
    public function bgstream() {
		$_filename = $this->uri->segment(2);
		$_file = FCPATH.'data/backgrounds/'.$_filename;

		if( file_exists( $_file ) ) {
		    header('Content-type: image/jpg');
		    header('Content-Disposition: inline; filename="' . $_filename . '"');
		    header('Content-Transfer-Encoding: binary');
		    header('Content-Length: ' . filesize($_file));
		    header('Accept-Ranges: bytes');

		    @readfile( $_file );	
		}    
    }
    
    public function publicfiles() {
		$_user = $this->uri->segment(1);

		if( !isset( $this->session->userdata['frontlogin'] ) || $this->session->userdata['frontlogin'] != true || $this->session->userdata['frontuser'] != $_user ) {
		    redirect( $_user.'/login' );
		} else {
		    $_data = array(
			'title' => __('front_title_welcome'),
			'site' => 'frontend/list',
			'headtitle' => __('front_title_publicdownloads'),
			'addnavi' => true,
			'user' => $this->mFrontend->getDetailsbyURL( $_user ),
			'files' => $this->mFrontend->listFiles('public')
		    );
		    
		    $this->load->view( 'frontend', $_data );
		}	
    }
    
    public function userfiles() {
		$_user = $this->uri->segment(1);
		
		if( !isset( $this->session->userdata['frontlogin'] ) || $this->session->userdata['frontlogin'] != true || $this->session->userdata['frontuser'] != $_user ) {
		    redirect( $_user.'/login' );
		} else {
		    $_data = array(
			'title' => __('front_title_welcome'),
			'site' => 'frontend/list',
			'headtitle' => __('front_title_userdownloads'),
			'addnavi' => true,
			'user' => $this->mFrontend->getDetailsbyURL( $_user ),
			'files' => $this->mFrontend->listFiles('user')
		    );

		    $this->load->view( 'frontend', $_data );
		}	
    }
    
    public function myuploads() {
		$_user = $this->uri->segment(1);
		
		if( !isset( $this->session->userdata['frontlogin'] ) || $this->session->userdata['frontlogin'] != true || $this->session->userdata['frontuser'] != $_user ) {
		    redirect( $_user.'/login' );
		} else {
		    $_data = array(
			'title' => __('front_title_myuploads'),
			'site' => 'frontend/myuploads',
			'headtitle' => __('front_title_myuploads'),
			'addnavi' => true,
			'user' => $this->mFrontend->getDetailsbyURL( $_user ),
			'files' => $this->mFrontend->listFiles('myuploads')
		    );

		    $this->load->view( 'frontend', $_data );
		}	
    }
    
    public function error() {
		$_data = array(
		    'title' => __('front_title_welcome'),
		    'site' => 'frontend/error',
		    'header' => 'header'
		);
		
		$this->load->view( 'frontend', $_data );
    }   
    
    public function settings( $errortype = false, $errormsg = '', $_edit_user = NULL ) {
		$this->load->helper( array( 'form' ) );
		$this->load->model( array( 'user/mUser' ) );
		
		$_userURL = $this->uri->segment(1);

		if( !isset( $this->session->userdata['frontlogin'] ) || $this->session->userdata['frontlogin'] != true || $this->session->userdata['frontuser'] != $_userURL ) { 
			redirect( $_userURL .'/login' );
		} else {
			$_user = $this->session->userdata('userUnique');
			$this->edituser = $_user;
			
			if( $errortype == false ) $errortype = isset($_GET['errortype']) ? $_GET['errortype'] : false;
			if( empty( $errormsg ) ) $errormsg = isset($_GET['errormsg']) ? urldecode( $_GET['errormsg'] ) : '';
			
			$_data = array(
			    'errortype' => $errortype,
			    'errormsg' => $errormsg,
			    'addnavi' => true,
			    'site' => 'frontend/edit_user',
			    'title' => __('user_title_edituser'),
			    'user' => $this->mUser->getUser( $_user )
			);
				
			$this->load->view( 'frontend', $_data );
		}
    }
    
    public function save_settings() {
		$this->load->library( 'form_validation' );
		
		$_user = $this->input->post( 'user' );

		$config = array(
		    array( 'field' => 'user',		    'label' => __('user_lbl_user'),	    'rules' => 'required|min_length[20]' ),
		    array( 'field' => 'inputName',	    'label' => __('user_lbl_name'),	    'rules' => 'trim|required|min_length[3]' ),
		    array( 'field' => 'inputEmail',	    'label' => __('user_lbl_email'),	    'rules' => "trim|required|valid_email|callback_email_check[$_user]" ),
		    array( 'field' => 'inputTimezone',	    'label' => __('user_lbl_timezone'),	    'rules' => 'trim|required' ),
		    array( 'field' => 'inputDateformat',    'label' => __('user_lbl_dateformat'),   'rules' => 'trim|required' )
		);
		
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
		    $this->settings( $errortype, $errormsg, $_user );
		} else {
		    $this->load->model( array( 'user/mUser' ) );
		    
		    $_updated = $this->mUser->changeUserFront();
		    
		    if( $_updated != false ) {
			$this->mGlobal->log( array( 'type' => "info", 'message' => "Frontend user '{$this->session->userdata['userid']}' changed his settings'.", 'data' => $_user, 'size' => NULL ) );
			$_userDetails = $this->mUser->getUser( $_user );
			redirect( $_userDetails->userURL.'/settings?errortype=success&errormsg='.urlencode( __('user_msg_editok') ) );
		    } else {
			$errortype = 'error';
			$errormsg = __('user_msg_editerror');
			$this->settings( $errortype, $errormsg, $_user );				
		    }
		}
    }     
    
    public function email_check( $email, $user ) {
		$this->load->model( array('user/mUser') );

		$_found = $this->mUser->emailUnique( $email, $user );
		
		if( $_found ) {
		    return true;
		} else {
		    $this->form_validation->set_message('email_check', __('user_msg_emailalreadyreg'));
		    return false;
		}
    }
    
    public function logout() {
		$this->mGlobal->log( array( 'type' => "info", 'message' => "Frontend user '{$this->session->userdata['userid']}' has been logged out from frontend.", 'data' => $this->session->userdata['userid'], 'size' => NULL ) );
		$_url = $this->uri->segment(1);
		$_session = array(
		    'frontlogin' => false,
		    'frontuser' => '',
		    'userReceiveNot' => '',
		    'userUnique' => '',
		    'userid' => ''
		);
		
		$this->session->unset_userdata( $_session );
		
		redirect( $_url.'/login' );
    }
    
    public function finished() {
		if( $this->input->is_ajax_request() ) {
		    $_data = $this->input->post('data');

		    $this->_sendFileEmail( $_data );
		}
    }
    
    private function _sendFileEmail( $_list = array() ) {
		$this->load->model(array('user/mUser','mGlobal'));
		
		if( is_array( $_list ) && count( $_list ) != 0  ) {
		    $_user = $this->session->userdata['userReceiveNot'];
		    
		    $_details = $this->mUser->getUser( $_user );
		    $_sender = $this->mUser->getUser( $this->session->userdata['userid'] );
		    
		    if( $_details != false && $_sender != false ) {
			$this->load->library( 'email' );
			$this->load->helper( 'myemail' );
			
			$emailsend = emailconfig();
			
			$this->email->initialize( $emailsend );		
			
			$_emailBody = $this->mGlobal->getConfig('SEND_FILES_CUST')->configVal;
			$_emailSubject = $this->mGlobal->getConfig('SEND_FILES_CSUBJECT')->configVal;
			$_productName = $this->mGlobal->getConfig('PRODUCT_NAME')->configVal;
			
			$_listText = '';
			for( $i = 0; $i < count( $_list ); $i++ ) {
			    $_data = explode( '|', $_list[$i] );
			    
			    $_listText .= "\n- ".$_data[0].' ( '.roundsize( $_data[1] ).' )';
			}
			
			
			$_emailBody = str_replace( '{adminurl}',site_url( 'admin/account/login' ), $_emailBody );
			$_emailBody = str_replace( '{sender}',$_sender->companyName, $_emailBody );
			$_emailBody = str_replace( '{filelist}',$_listText, $_emailBody );
			$_emailBody = str_replace( '{product}',$_productName, $_emailBody );
			
			$_emailSubject = str_replace( '{recipient}',$_details->companyName, $_emailSubject );
			$_emailSubject = str_replace( '{sender}',$_sender->companyName, $_emailSubject );
			$_emailSubject = str_replace( '{product}',$_productName, $_emailSubject );
			
			$this->email->clear( TRUE );
			
			$this->email->to( $_details->emailAddress );
			$this->email->from( $_sender->emailAddress, $_sender->companyName );
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
    
    public function preview() {
		$this->load->library('image_lib');
		
		$_file = $this->uri->segment(4);
		$_type = $this->uri->segment(3);
		
		$_fileName = pathinfo( $_file,  PATHINFO_FILENAME );
		$_fileExt = pathinfo( $_file, PATHINFO_EXTENSION );
		$_fileExt = strtolower( $_fileExt );

		if( $_type == 'icon' ) {
		    $_fileIcon = 'data'.DS.'thumbs'.DS.$_fileName.'_32x32.jpg';
		    $imageinit['width']             = '32';
		    $imageinit['height']            = '32';
		} else {
		    $_fileIcon = 'data'.DS.'thumbs'.DS.$_file;
		}
		$_fileThumb = 'data'.DS.'thumbs'.DS.$_file;
		
		if( ( !file_exists( $_fileIcon) OR !file_exists( $_fileThumb ) ) && ( $_fileExt == 'jpg' OR $_fileExt == 'png' OR $_fileExt == 'gif' ) ) {
		    $this->re_generate( $_file );
		}
		
		$_fileAsset = 'assets'.DS.'images'.DS.'32px'.DS.strtolower($_fileExt).'.png';
		$_fileBlank = 'assets'.DS.'images'.DS.'32px'.DS.'_blank.png';

		if( file_exists( FCPATH . $_fileIcon ) ) {
		    $_path = $_fileIcon;
		} else {	    
		    if( file_exists( FCPATH . $_fileAsset ) ) {
			$_path = $_fileAsset;
		    } else {
			if( file_exists( FCPATH . $_fileBlank ) ) {
			    $_path = $_fileBlank;
			}
		    }
		}

		$imageinit['dynamic_output']    = true;     // set to true to generate it dynamically
		$imageinit['source_image']	= FCPATH . $_path;
		$imageinit['maintain_ratio']    = true;
		
		$this->image_lib->initialize($imageinit);
		$this->image_lib->resize();
    }    
} 