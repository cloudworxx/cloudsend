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

class Folder extends CWX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('user/mUser');
    }	
    
    public function index() {
    	require_once APPPATH.'libraries/csfolder.php';
    	$this->load->library('breadcrumb');
        $errortype = isset($_GET['errortype']) ? $_GET['errortype'] : false;
        $errormsg = isset($_GET['errormsg']) ? urldecode( $_GET['errormsg'] ) : '';

        $_parent = $this->session->userdata( 'folderUniqueID' );
        if( !isset( $_parent ) OR empty( $_parent ) OR !preg_match( "/^(fold_)[a-z0-9]{14}.[a-z0-9]{8}/", $_parent ) ) {
            $_parent = NULL;
            $_thisFolder = false;
        } else {
            $_thisFolder = $this->mFolder->getThisFolder( $_parent );
        }

        $_selectParent = new csFolder();

        $_data = array(
            'errortype' => $errortype,
            'errormsg' => $errormsg,
            'title' => __('folder_title_files'),
            'site' => 'folder/index',
            'files' => $this->mFolder->getFilesByFolder( $_parent ),
            'folders' => $this->mFolder->getFolder( $_parent ),
            'thisFolder' => $_thisFolder,
            'breadcrumb' => $this->breadcrumb->output( $_thisFolder ),
            'folderList' => $_selectParent->getSelect( 0, 1, $_parent, 'inputParent', 'span5'),
            'users' => $this->mUser->getAllStdUser()
        );
    
        $this->load->view( 'master', $_data );	
    }
    
    public function add_folder( $errortype = false, $errormsg = '' ) {
        require APPPATH.'libraries/csfolder.php';
        $this->load->helper( 'form' );

        $_folder = new csFolder();
        $_thisFolder = NULL;

        $_data = array(
            'errortype' => $errortype,
            'errormsg' => $errormsg,
            'site' => 'folder/add_folder',
            'title' => __('folder_title_add'),
            'folderTag' => $_folder->getSelect( $_thisFolder, 1, NULL, 'inputParent', 'span7' )
        );

        $this->load->view( 'master', $_data );			
    }   

    public function change() {
        if( $this->input->is_ajax_request() ) {
            $_folderUnique = $this->input->post( 'folderUnique' );

            if( isset( $_folderUnique ) && !empty( $_folderUnique ) && preg_match( "/^(fold_)[a-z0-9]{14}.[a-z0-9]{8}/", $_folderUnique ) ) {
                $this->session->set_userdata( 'folderUniqueID', $_folderUnique );
                $_return = array(
                        'type' => 'success',
                        'message' => ''
                );
            } else {
                if( isset( $_folderUnique ) && !empty( $_folderUnique ) && $_folderUnique == 'root' ) {
                    $this->session->unset_userdata( 'folderUniqueID' );
                    $_return = array(
                            'type' => 'success',
                            'message' => ''
                    );
                } else {
                    $_return = array(
                            'type' => 'error',
                            'message' => urlencode( __( 'folder_msg_nochange' ) )
                    );
                }
            }
        } else {
            $_return = array(
                'type' => 'error',
                'message' => urlencode( __('folder_msg_noajax') )
            );
        }

        $this->output
            ->set_content_type( 'application/json' )
            ->set_output( json_encode( $_return ) ); 		
    }

    public function move_files() {
        if( $this->input->is_ajax_request() ) {
            $_p_files = $this->input->post( 'files' );
            $_ar_files = explode( ',', $_p_files );
            $_p_folder = $this->input->post( 'folder' );

            if( isset( $_ar_files ) && count( $_ar_files ) != 0 && isset( $_p_folder ) && $this->_validateFiles( $_ar_files ) ) {
                $_files = array();
                for( $i = 0; $i < count( $_ar_files ); $i++ ) {
                    $_updated = $this->mFolder->changeFolderOfFile( $_ar_files[$i], $_p_folder );
                    if( $_updated ) $_files[] = $_ar_files[$i];
                }
                $_return = array(
                    'type' => 'success',
                    'message' => '',
                    'files' => implode(',',$_files)
                );

            } else {
                $_return = array(
                    'type' => 'error',
                    'message' => __('folder_msg_valerror')
                );
            }

        } else {
            $_return = array(
                'type' => 'error',
                'message' => __('folder_msg_noajax')
            );
        }

        $this->output
            ->set_content_type( 'application/json' )
            ->set_output( json_encode( $_return ) ); 				
    }

    public function delete_files() {
        if( $this->input->is_ajax_request() ) {
            $this->load->model( array( 'files/mFiles' ) );

            $_p_files = $this->input->post( 'files' );
            $_ar_files = explode( ',', $_p_files );

            if( isset( $_ar_files ) && count( $_ar_files ) != 0 && $this->_validateFiles( $_ar_files ) ) {
                $_files = array();
                for( $i = 0; $i < count( $_ar_files ); $i++ ) {
                        $_updated = $this->mFiles->deleteFile( $_ar_files[$i] );
                        if( $_updated ) $_files[] = $_ar_files[$i];
                }
                $_return = array(
                    'type' => 'success',
                    'message' => '',
                    'files' => implode(',',$_files)
                );

            } else {
                $_return = array(
                    'type' => 'error',
                    'message' => __('folder_msg_valerror')
                );
            }

        } else {
            $_return = array(
                'type' => 'error',
                'message' => __('folder_msg_noajax')
            );
        }

        $this->output
            ->set_content_type( 'application/json' )
            ->set_output( json_encode( $_return ) ); 				
    }

    public function verify_folder() {
        $this->load->library( 'form_validation' );

        $config = array(
            array( 'field' => 'inputTitle',	    'label' => __('folder_lbl_title'),		'rules' => 'trim|required|min_length[3]' ),
            array( 'field' => 'inputParent',	'label' => __('folder_lbl_parent'),		'rules' => 'trim' ),
        );

        $this->form_validation->set_rules( $config );

        if( $this->form_validation->run($this) == false ) {
            $errortype = 'error';
            $errormsg = validation_errors( ' ','<br />' );
            $this->add_folder( $errortype, $errormsg );
        } else {  
            $_addFolder = $this->mFolder->addFolder();

            if( $_addFolder != false ) {
                $this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' has added a new folder: {$this->input->post('inputTitle')}.", 'size' => NULL ) );
                redirect( 'admin/folder/index?errortype=success&errormsg='.urlencode( __('folder_msg_addok') ) );	
            } else {
		$errortype = 'error';
		$errormsg = __('folder_msg_valerror');
		$this->add_folder( $errortype, $errormsg );				
            }
        }	 		
    }

    private function _validateFiles( $_files = array() ) {
        if( isset( $_files ) && is_array( $_files ) && count( $_files ) != 0 ) {
            $_return = true;
            for( $i = 0; $i < count( $_files ); $i++ ) {
                    if( !preg_match( "/^(file_)[a-z0-9]{14}.[a-z0-9]{8}/", $_files[$i] ) ) $_return = false;
            }

            return $_return;
        }

        return false;
    }
        
    public function rename() {
	$_oldName = $this->input->post( 'oldName' );
	$_newName = $this->input->post( 'newName' );
	$_folderID  = $this->input->post( 'folderID' );
	
	if( isset( $_oldName ) && !empty( $_oldName ) && isset( $_newName ) && !empty( $_newName ) && isset( $_folderID ) && !empty( $_folderID ) && preg_match( "/^(fold_)[a-z0-9]{14}.[a-z0-9]{8}/", $_folderID ) ) {
	    if( $this->mFolder->renameFolder( $_folderID, $_newName ) ) {
		$_return = array(
		    'type' => 'success',
		    'message' => __('folder_msg_renamesuccess')
		);
	    } else {
		$_return = array(
		    'type' => 'error',
		    'message' => __('folder_msg_renameerror')
		);
	    }
	} else {
	    $_return = array(
		'type' => 'error',
		'message' => __('folder_msg_parammissing')
	    );
	}
	
	$this->output
            ->set_content_type( 'application/json' )
            ->set_output( json_encode( $_return ) );
	
    }
    
 	public function delete_ajax() {
            if( $this->input->is_ajax_request() ) {
                $_folder = $this->input->post( 'folder' );

                if( isset( $_folder ) && !empty( $_folder ) ) {
                    $_updated = $this->mFolder->deleteFolder( $_folder );
                    
                    if( $_updated ) {
                        $_return = array(
                            'type' => 'success',
                            'message' => '',
                            'folder' => $_folder
                        );
                    } else {
                        $_return = array(
                            'type' => 'error',
                            'message' => __('folder_msg_valerror')
                        );
                    }

                } else {
                    $_return = array(
                        'type' => 'error',
                        'message' => __('folder_msg_valerror')
                    );
                }

            } else {
                $_return = array(
                    'type' => 'error',
                    'message' => __('folder_msg_noajax')
                );
            }

            $this->output
                ->set_content_type( 'application/json' )
                ->set_output( json_encode( $_return ) ); 				
 	}  

}