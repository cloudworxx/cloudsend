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

class Files extends CWX_Controller {
    
    public function __construct() {
	parent::__construct();
	
	$this->load->model('user/mUser');
    }
    
    public function index() {	
	$this->load->model( array( 'categories/mCategories' ) );
	
	$errortype = isset($_GET['errortype']) ? $_GET['errortype'] : false;
	$errormsg = isset($_GET['errormsg']) ? urldecode( $_GET['errormsg'] ) : '';
	
	$_selected = $this->input->get('category');
	if( !isset( $_selected ) OR empty( $_selected ) OR !preg_match( "/^(fld_)[a-z0-9]{14}.[a-z0-9]{8}/", $_selected ) ) {
	    $_selected = false;
	}

        $_data = array(
	    'errortype' => $errortype,
	    'errormsg' => $errormsg,
	    'title' => __('files_title_files'),
	    'site' => 'files/index',
	    'files' => $this->mFiles->getFiles( NULL, $_selected ),
	    'users' => $this->mUser->getAllStdUser(),
	    'categories' => $this->mCategories->getCategories(),
	    'catdetail' => $this->mCategories->categoryDetails( $_selected ),
	    'selected' => $_selected
	);
    
	$this->load->view( 'master', $_data );	
    }
    
    public function details( $errortype = false, $errormsg = '' ) {
	$this->load->model('user/mUser');
	$this->load->helper( array( 'form', 'file' ) );

	$_entry = $this->input->get('entry');
        
        if( preg_match( "/^(file_)[a-z0-9]{14}.[a-z0-9]{8}/", $_entry ) ) {	    
            $_data = array(
                'errortype' => $errortype,
                'errormsg' => $errormsg,
                'site' => 'files/details',
                'title' => __('files_title_details'),
                'details' => $this->mFiles->getFiles( $_entry ),
                'userfiles' => $this->mFiles->getUser4File( $_entry ),
		'publicfiles' => $this->mFiles->getPublic4File( $_entry )
            );

	    $this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' has requested file details of file '{$_data['details']->fileName}'.", 'data' => $_data['details']->fileUniqueID, 'size' => NULL ) );
	    
            $this->load->view( 'master', $_data );
	
        } else {
            redirect('admin/files/index?errortype=error&errormsg='.urlencode( __('pub_msg_argumenterror') ));
        }
    }    
    
    
    /**
     * AJAX Functions 
     */
    
    public function published() {
	$_return = array();
	
	if( $this->input->is_ajax_request() ) {
	    $_fileID = $this->uri->segment(4);
	    
	    if( preg_match( "/^(file_)[a-z0-9]{14}.[a-z0-9]{8}/", $_fileID ) ) {
		$this->load->model('mFiles');
		
		$fileDetails = $this->mFiles->getFiles( $_fileID );
		
		if( $fileDetails != false ) {
		    if( $fileDetails->filePublic == 0 ) {
			$_set = '1';
			$_icon = 'icon-unlock icon-large';
		    } else {
			$_set = '0';
			$_icon = 'icon-lock icon-large';
		    }
		    
		    $_update = $this->mFiles->updateFile( $_fileID, array( 'filePublic' => $_set ) );
		    
		    $this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' changed the public state of file '{$fileDetails->fileName}'.", 'data' => $fileDetails->fileUniqueID, 'size' => NULL ) );
		    if( $_update ) {
			$_return = array(
			    'type' => 'success',
			    'message' => __('files_msg_fileupdatesuccess'),
			    'icon' => $_icon
			);		    			
		    } else {
			$_return = array(
			    'type' => 'error',
			    'message' => __('files_msg_fileupdateerror')
			);		    			
		    }
		} else {
		    $_return = array(
			'type' => 'error',
			'message' => __('files_msg_filenotfound')
		    );		    
		}
	    } else {
		$_return = array(
		    'type' => 'error',
		    'message' => __('files_msg_fileproblem')
		);
	    }
	} else {
	    $_return = array(
		'type' => 'error',
		'message' => __('files_msg_noajaxrequest')
	    );
	}
	
	$this->output
		->set_content_type( 'application/json' )
		->set_output( json_encode( $_return ) );
    }
    
    
    public function setrights() {
	$_return = array();
	$this->load->model( 'user/mUser' );
	
	if( $this->input->is_ajax_request() ) {
	    $_all_get = $this->input->get(NULL, TRUE);
	    
	    if( count( $_all_get['freeUser'] ) != 0 && count( $_all_get['mFile'] ) != 0 ) {
		
		$_senderror = false;
		
		for( $i = 0; $i < count( $_all_get['freeUser'] ); $i++ ) {
		    $_fileList = array();
		    for( $f = 0; $f < count( $_all_get['mFile'] ); $f++ ) {
			if( preg_match( "/^(usr_)[a-z0-9]{14}.[a-z0-9]{8}/", $_all_get['freeUser'][$i] ) && preg_match( "/^(file_)[a-z0-9]{14}.[a-z0-9]{8}/", $_all_get['mFile'][$f] ) ) {
			    $_added = $this->mFiles->file2user( $_all_get['mFile'][$f], $_all_get['freeUser'][$i] );
			    $_fileDetails = $this->mFiles->getFiles($_all_get['mFile'][$f]);
			    $_userDetails = $this->mUser->getUser($_all_get['freeUser'][$i]);
			    if( $_added ) $_fileList[] = $_fileDetails->fileName . ' ( '. roundsize( $this->mFiles->getFiles($_all_get['mFile'][$f])->fileSize ) . ' ) ';
	
			    $this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' shared file '{$_fileDetails->fileName}' with user '{$_userDetails->companyName}'.", 'size' => NULL ) );
			}
		    }
		    if( isset( $_all_get['informUser'] ) && $_all_get['informUser'] == 'inform' && count( $_fileList ) != 0 ) {
			$_send = $this->_sendFileEmail( $_all_get['freeUser'][$i], $_fileList );
			if( !$_send ) $_senderror = true;
		    } 
		}
		
		if( !$_senderror ) {
		
		    $_return = array(
			'type' => 'success',
			'message' => __('files_msg_accesssuccess')
		    );
		
		} else {

		    $_return = array(
			'type' => 'success',
			'message' => __('files_msg_successnoemail')
		    );		    
		    
		}
	    
	    } else {
		$_return = array(
		    'type' => 'error',
		    'message' => __('files_msg_transmitproblem')
		);		
	    }
	    
	} else {
	    $_return = array(
		'type' => 'error',
		'message' => __('files_msg_noajaxrequest')
	    );
	}
	
	$this->output
		->set_content_type( 'application/json' )
		->set_output( json_encode( $_return ) );
    }
    
    public function deletefiles() {
	$_return = array();
	
	if( $this->input->is_ajax_request() ) {
	    $_all_get = $this->input->get(NULL, TRUE);
	    
	    if( count( $_all_get['mFile'] ) != 0 ) {
		$_error = false;
		$_errorFiles = array();
		
		$_allFiles = $this->mFiles->getMultipleFiles( $_all_get['mFile'] );
		
		if( $_allFiles != false ) {
		
		    foreach( $_allFiles AS $_fileDetails ) {

			$_fileName = pathinfo( $_fileDetails->fileNewName, PATHINFO_FILENAME);

			$_possibleFiles = array(
			    FCPATH.'data'.DS.'files'.DS.$_fileDetails->fileNewName,
			    FCPATH.'data'.DS.'thumbs'.DS.$_fileName.'.jpg',
			    FCPATH.'data'.DS.'files'.DS.$_fileName.'_32x32.jpg'
			);

			$_delete = $this->mFiles->deleteFile( $_fileDetails->fileUniqueID );
			if( !$_delete ) {
			    $_error = true;
			    $_errorFiles[] = __('files_msg_dbremovefailed',array(pathinfo($_possibleFiles[0],PATHINFO_BASENAME)));
			} else {
			    $this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' has deleted file '{$_fileDetails->fileName}'.", 'size' => NULL ) );
			}

			for( $i = 0; $i < count( $_possibleFiles ); $i++ ) {
			    if( file_exists( $_possibleFiles[$i] ) ) {
				if( unlink( $_possibleFiles[$i] ) ) {
				} else {
				    $_error = true;
				    $_errorFiles[] = __('files_msg_unlinkfailed',array(pathinfo($_possibleFiles[$i],PATHINFO_BASENAME)));
				}
			    }
			}
			
		    }
		
		} else {
		    $_return = array(
			'type' => 'error',
			'message' => __('files_msg_transmitproblem')
		    );				    
		}
		
		if( $_error ) {
		    $_return = array(
			'type' => 'error',
			'message' => __('files_msg_deleteproblems',array(implode( '<br />', $_errorFiles )))
		    );
		} else {
		    $_return = array(
			'type' => 'success',
			'message' => __('files_msg_deletesuccess')
		    );		   
		}
	    
	    } else {
		$_return = array(
		    'type' => 'error',
		    'message' => __('files_msg_transmitproblem')
		);		
	    }
	    
	} else {
	    $_return = array(
		'type' => 'error',
		'message' => __('files_msg_noajaxrequest')
	    );
	}
	
	$this->output
		->set_content_type( 'application/json' )
		->set_output( json_encode( $_return ) );
    }   
    
    
    public function sendbyemail() {
	$this->load->library('email');
	$this->load->helper('email');
	$_return = array();
	$_header = '401';
	
	if( $this->input->is_ajax_request() ) {
	    
	    $_all_get = $this->input->get(NULL, TRUE);
	    
	    if( isset( $_all_get['inputEmail'] ) && isset( $_all_get['inputMessage'] ) && !empty( $_all_get['inputEmail'] ) && valid_email( $_all_get['inputEmail'] ) && !empty( $_all_get['inputMessage'] ) && count( $_all_get['mFile'] ) != 0 ) {
		
		$_senderror = false;
		
		$emailset = emailconfig();
		
		$this->email->initialize( $emailset );
		
		$this->email->clear( TRUE );
		
                $_directDownload = ( isset( $_all_get['inputDirectDownload'] ) && $_all_get['inputDirectDownload'] == 'yes' ) ? true : false;
		$_emailBody = $this->mGlobal->getConfig('SEND_FILES_EMAIL')->configVal;
		$_emailSubject = $this->mGlobal->getConfig('SEND_FILES_SUBJECT')->configVal;
		$_productName = $this->mGlobal->getConfig('PRODUCT_NAME')->configVal;
		
		$_listText = '';
                
                if( $_directDownload ) {
                    require APPPATH.'libraries/uuid.php';

                    $_uuid = UUID::generate();
                    $_pubid = uniqid( 'pub_', true );
                    
                    $_insertPublic = array(
                        'id' => NULL,
                        'publicUniqueID' => $_pubid,
                        'publicUUID' => $_uuid,
                        'publicMessage' => NULL,
                        'userUniqueID' => $this->session->userdata['userUnique'],
                        'publicPassword' => NULL,
                        'publicLimit' => NULL,
                        'published' => '1'
                    );

                    $_insertedPublic = $this->mFiles->createPublic( $_insertPublic );
                    
                    if( !$_insertedPublic ) $_directDownload = false;
                }
		
		for( $i = 0; $i < count( $_all_get['mFile'] ); $i++ ) {
		    $_fileDetails = $this->mFiles->getFiles( $_all_get['mFile'][$i] );
		    $_listText .= "<br />- ".$_fileDetails->fileName.' ( '.roundsize( $_fileDetails->fileSize ).' )';
                    
                    if( $_directDownload ) {
                        $_f2p_insert = array(
                            'id' => NULL,
                            'publicUniqueID' => $_pubid,
                            'fileUniqueID' => $_fileDetails->fileUniqueID,
                            'allowedCount' => NULL,
                            'downloadCount' => NULL
                        );

                        $_file2public = $this->mFiles->createPublic( $_f2p_insert, 'public2file' );
                        
                        if( $_file2public ) {
                            $_listText .= "<br />".site_url( 'public/download/'.$_uuid.'/'. $_fileDetails->fileUniqueID );
                        }
                    } else {
                        if( file_exists( FCPATH.'data'.DS.'files'.DS.$_fileDetails->fileNewName ) ) {
                            $this->email->attach( FCPATH.'data'.DS.'files'.DS.$_fileDetails->fileNewName, 'attachment', $_fileDetails->fileName );
                        }
                    }                    
		}		

		$_emailBody = str_replace( '{email}', $_all_get['inputEmail'], $_emailBody );
		$_emailBody = str_replace( '{sender}',$this->session->userdata['companyName'], $_emailBody );
		$_emailBody = str_replace( '{filelist}',$_listText, $_emailBody );
		$_emailBody = str_replace( '{message}',$_all_get['inputMessage'], $_emailBody );
		$_emailBody = str_replace( '{product}',$_productName, $_emailBody );
		$_emailSubject = str_replace( '{sender}',$this->session->userdata['companyName'], $_emailSubject );
		$_emailSubject = str_replace( '{recipient}',$_all_get['inputEmail'], $_emailSubject );
		$_emailSubject = str_replace( '{product}',$_productName, $_emailSubject );
				
		$this->email->to( $_all_get['inputEmail'] );
		$this->email->from( $this->session->userdata['emailAddress'], $this->session->userdata['companyName'] );
		$this->email->subject( $_emailSubject );
		$this->email->message( $_emailBody );
		$this->email->set_alt_message( strip_tags( $_emailBody ) );
		
		if( $this->email->send() ) {
		    for( $i = 0; $i < count( $_all_get['mFile'] ); $i++ ) {
			$_fileDetails = $this->mFiles->getFiles( $_all_get['mFile'][$i] );
			
			$this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' sent file '{$_fileDetails->fileName}' to '{$_all_get['inputEmail']}'.", 'data' => $_all_get['mFile'][$i], 'size' => $_fileDetails->fileSize ) );
		    }
		    
		    $_return = array(
			'type' => 'success',
			'message' => __('files_msg_emailsendsuccess')
		    );
		
		} else {
		    $_return = array(
			'type' => 'error',
			'message' => __('files_msg_emailsenderror')
		    );		    
		    
		}
	    
	    } else {
		$_return = array(
		    'type' => 'error',
		    'message' => __('files_msg_transmitproblem')
		);		
	    }
	    
	} else {
	    $_return = array(
		'type' => 'error',
		'message' => __('files_msg_noajaxrequest')
	    );
	}
	
	$this->output
		->set_content_type( 'application/json' )
		->set_output( json_encode( $_return ) );
    }
    
    public function rename() {
	$_oldName = $this->input->post( 'oldName' );
	$_newName = $this->input->post( 'newName' );
	$_fileID  = $this->input->post( 'fileID' );
	
	if( isset( $_oldName ) && !empty( $_oldName ) && isset( $_newName ) && !empty( $_newName ) && isset( $_fileID ) && !empty( $_fileID ) && preg_match( "/^(file_)[a-z0-9]{14}.[a-z0-9]{8}/", $_fileID ) ) {
	    if( $this->mFiles->renameFile( $_fileID, $_newName ) ) {
		$_return = array(
		    'type' => 'success',
		    'message' => __('files_msg_renamesuccess')
		);
	    } else {
		$_return = array(
		    'type' => 'error',
		    'message' => __('files_msg_renameerror')
		);
	    }
	} else {
	    $_return = array(
		'type' => 'error',
		'message' => __('files_msg_parammissing')
	    );
	}
	
	$this->output
		->set_content_type( 'application/json' )
		->set_output( json_encode( $_return ) );
	
    }
    
    public function createpublic() {
	require APPPATH.'libraries/uuid.php';
	
	$_return = array();
	
	if( $this->input->is_ajax_request() ) {
	    $_all_get = $this->input->get(NULL, TRUE);
	    
	    if( count( $_all_get['mFile'] ) != 0 ) {
		$_uuid = UUID::generate();
		$_pubid = uniqid( 'pub_', true );
		
		$_set_pass = ( isset( $_all_get['optPubPassword'] ) && $_all_get['optPubPassword'] == 'activate' ) ? true : false;
		$_pass = NULL;
		$_set_time = ( isset( $_all_get['optPubOpen'] ) && $_all_get['optPubOpen'] == 'activate' ) ? true : false;
		$_time = NULL;
		$_set_limit = ( isset( $_all_get['optPubLimit'] ) && $_all_get['optPubLimit'] == 'activate' ) ? true : false;
		$_limit = NULL;
		$_set_message = ( isset( $_all_get['optPubMessage'] ) && $_all_get['optPubMessage'] == 'activate' ) ? true : false;
		$_message = NULL;
		
		if( $_set_time ) $_time = strtotime( $_all_get['inputPublicDay'].'.'.$_all_get['inputPublicMonth'].'.'.$_all_get['inputPublicYear'] );
		if( $_set_pass ) $_pass = ( !empty( $_all_get['inputPublicPassword'] ) ) ? md5( $_all_get['inputPublicPassword'] ) : NULL;
		if( $_set_limit ) $_limit = ( $_all_get['inputPublicLimit'] != 0 ) ? $_all_get['inputPublicLimit'] : 0;
		if( $_set_message ) $_message = ( !empty( $_all_get['inputPublicMessage'] ) ) ? addslashes( $_all_get['inputPublicMessage'] ) : NULL;
		
		$_insert = array(
		    'id' => NULL,
		    'publicUniqueID' => $_pubid,
		    'publicUUID' => $_uuid,
		    'publicMessage' => $_message,
		    'userUniqueID' => $this->session->userdata['userUnique'],
		    'publicPassword' => $_pass,
		    'publicLimit' => $_time,
		    'published' => '1'
		);
		
		$_inserted = $this->mFiles->createPublic( $_insert );
		
		$this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' created public link '{$_uuid}'.", 'size' => NULL ) );
		
		if( $_inserted ) {
		    $_error = false;
		
		    for( $i = 0; $i < count( $_all_get['mFile'] ); $i++ ) {
			$_fileDetails = $this->mFiles->getFiles( $_all_get['mFile'][$i] );
			
			if( $_fileDetails != false ) {
				if( $_limit == 0 OR $_limit == NULL ) {
					$_downloadCounter = NULL;
				} else {
					$_downloadCounter = '0';
				}
			    $_f2p_insert = array(
					'id' => NULL,
					'publicUniqueID' => $_pubid,
					'fileUniqueID' => $_fileDetails->fileUniqueID,
					'allowedCount' => $_limit,
					'downloadCount' => $_downloadCounter
			    );

			    $_file2public = $this->mFiles->createPublic( $_f2p_insert, 'public2file' );
			    
			    $this->mGlobal->log( array( 'type' => "info", 'message' => "Added file '{$_fileDetails->fileName}' to public link '{$_uuid}'.", 'data' => $_fileDetails->fileUniqueID, 'size' => NULL ) );
			    if( $_file2public == false ) $_error = true;
			}
		    }

		    if( $_error ) {
			$_return = array(
			    'type' => 'error',
			    'message' => __('files_msg_releaseproblems')
			);
		    } else {
			$_return = array(
			    'type' => 'success',
			    'message' => __('files_msg_pubcreatesuccess',array(site_url( 'public/'.$_uuid ),site_url( 'public/'.$_uuid ))).'<br /><small><a id="copy-button" data-clipboard-text="'.site_url( 'public/'.$_uuid ).'" title="'.__('copy_to_clipboard').'">'.__('copy_to_clipboard').'</a></small>'
			);		   
		    }
		    
		} else {
		    $_return = array(
			'type' => 'error',
			'message' => __('files_msg_pubcreateproblems')
		    );				    
		}
	    } else {
		$_return = array(
		    'type' => 'error',
		    'message' => __('files_msg_transmitproblem')
		);		
	    }
	    
	} else {
	    $_return = array(
		'type' => 'error',
		'message' => __('files_msg_noajaxrequest')
	    );
	}
	
	$this->output
		->set_content_type( 'application/json' )
		->set_output( json_encode( $_return ) );	
    }
    
    
    private function _sendFileEmail( $_user = NULL, $_list = array() ) {
	if( !empty( $_user ) && is_array( $_list ) && count( $_list ) != 0 && preg_match( "/^(usr_)[a-z0-9]{14}.[a-z0-9]{8}/", $_user ) ) {
	    $_details = $this->mUser->getUser( $_user );
	    
	    if( $_details != false ) {
		$this->load->library( 'email' );
		
		$emailset = emailconfig();
		
		$this->email->initialize( $emailset );
		
		$_emailBody = $this->mGlobal->getConfig('ADD_FILES_EMAIL')->configVal;
		$_emailSubject = $this->mGlobal->getConfig('ADD_FILES_SUBJECT')->configVal;
		$_productName = $this->mGlobal->getConfig('PRODUCT_NAME')->configVal;
		$_url = site_url( '/'.$_details->userURL );
		
		$_listText = '';
		for( $i = 0; $i < count( $_list ); $i++ ) {
		    $_listText .= "<br />- ".$_list[$i];
		}
		
		$_emailBody = str_replace( '{name}',$_details->companyName, $_emailBody );
		$_emailBody = str_replace( '{sender}',$this->session->userdata['companyName'], $_emailBody );
		$_emailBody = str_replace( '{url}',$_url, $_emailBody );
		$_emailBody = str_replace( '{filelist}',$_listText, $_emailBody );
		$_emailBody = str_replace( '{product}',$_productName, $_emailBody );
		$_emailSubject = str_replace( '{recipient}', $_details->companyName, $_emailSubject );
		$_emailSubject = str_replace( '{sender}', $this->session->userdata['companyName'], $_emailSubject );
		$_emailSubject = str_replace( '{product}', $_productName, $_emailSubject );
		
		$this->email->clear( TRUE );
		
		$this->email->to( $_details->emailAddress );
		$this->email->from( $this->session->userdata['emailAddress'], $this->session->userdata['companyName'] );
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
        
    public function download() {
	$_file = $this->uri->segment(4);

	if( isset( $_file ) && !empty( $_file ) && preg_match( "/^(file_)[a-z0-9]{14}.[a-z0-9]{8}/", $_file ) ) {

	    $_details = $this->mFiles->getFiles( $_file );

	    if( $_details != false ) {
		$_file_name = FCPATH.'data/files/' . $_details->fileNewName;

		if( file_exists( $_file_name ) ) {	
		    
		    $_downType = $this->mGlobal->getConfig('DOWNLOAD_TYPE')->configVal;
		    
		    if( $_downType == 'normal' ) {
			header('Content-type: '.$_details->fileType);
			header('Content-Disposition: attachment; filename="' . $_details->fileName . '"');
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: ' . filesize( $_file_name ));
			header('Accept-Ranges: bytes');

			@readfile( $_file_name );
		    } else {
			$_chunkSize = (int)$this->mGlobal->getConfig('CHUNKED_SIZE')->configVal;
			
			header('Content-type: '.$_details->fileType);
			header('Content-Disposition: attachment; filename="' . $_details->fileName . '"');
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: ' . filesize( $_file_name ) );
			header('Connection: Keep-Alive');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Accept-Ranges: bytes');

			ob_clean();
			$handle = fopen($_file_name, "rb");
			$chunksize=(filesize($_file_name)/$_chunkSize);

			set_time_limit(0);
			while (!feof($handle)) {
			    echo fgets($handle, $chunksize);
			    flush();
			}
			fclose($handle);
		    }
		    
		    $this->mGlobal->log( array( 'type' => "down", 'message' => "User '{$this->session->userdata['companyName']}' downloaded file '{$_details->fileName}'.", 'size' => $_details->fileSize ) );
		   
		} else {
		    $this->mGlobal->log( array( 'type' => "down", 'message' => "File '{$_details->fileName}' requested does not exist on server.", 'data' => $_file, 'size' => NULL ) );
		}
	    }
	}
	exit;
    }    
    
    public function user() {
	$_userid = $this->uri->segment(4);
	
	if( isset( $_userid ) && !empty( $_userid ) && preg_match( "/^(usr_)[a-z0-9]{14}.[a-z0-9]{8}/", $_userid ) ) {
	    $_userDetails = $this->mUser->getUser( $_userid );
	    $this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' has displayed the files shared with user '{$_userDetails->companyName}'.", 'size' => NULL ) );
	    
	    $_data = array(
		'title' => __('files_title_files'),
		'site' => 'files/userfiles',
		'files' => $this->mFiles->getUserFiles( $_userid )
	    );

	    $this->load->view( 'master', $_data );	
	} else {
	    $errortype = 'error';
	    $errormsg = __('files_msg_nouser');
	    redirect( 'admin/dashboard/index?errortype='.urlencode( $errortype ).'&errormsg='.urlencode( $errormsg ) );
	}
    }
    
    public function delf2u() {
	$this->load->model('user/mUser');
	$_return = array();
	
	if( $this->input->is_ajax_request() ) {
	    $_all_get = $this->input->get(NULL, TRUE);
	    
	    if( count( $_all_get['mFile'] ) != 0 ) {
		$_errorFiles = array();
		
		for( $i = 0; $i < count( $_all_get['mFile'] ); $i++ ) {
		    
		    $_details = $this->mFiles->getFile2UserDetails( $_all_get['mFile'][$i] );
		    $_userDetails = $this->mUser->getUser( $_details->userUniqueID );
		    $_delete = $this->mFiles->deleteFile2User( $_all_get['mFile'][$i] );
		    $_fileDetails = $this->mFiles->getFiles( $_details->fileUniqueID );
		    
		    if( !$_delete ) {
			$_errorFiles[] = __('files_msg_dbremovefailed',array($_fileDetails->fileName));
			$this->mGlobal->log( array( 'type' => "error", 'message' => "File sharing for file'{$_fileDetails->fileName}' with user '{$_userDetails->companyName}' could not be removed.", 'size' => NULL ) );
		    } else {
			$this->mGlobal->log( array( 'type' => "info", 'message' => "Removed file sharing for file'{$_fileDetails->fileName}' with user '{$_userDetails->companyName}'.", 'size' => NULL ) );
		    }
		    
		}
		
		if( count( $_errorFiles ) != 0 ) {
		    $_return = array(
			'type' => 'error',
			'message' => __('files_msg_deleteproblems',array(implode( '<br />', $_errorFiles )))
		    );
		} else {
		    $_return = array(
			'type' => 'success',
			'message' => __('files_msg_deletesuccess')
		    );		   
		}
	    
	    } else {
		$_return = array(
		    'type' => 'error',
		    'message' => __('files_msg_transmitproblem')
		);		
	    }
	    
	} else {
	    $_return = array(
		'type' => 'error',
		'message' => __('files_msg_noajaxrequest')
	    );
	}
	
	$this->output
		->set_content_type( 'application/json' )
		->set_output( json_encode( $_return ) );
    }     

    
    public function preview() {
	$this->load->library('image_lib');
	
	$_file = $this->uri->segment(5);
	$_type = $this->uri->segment(4);
	
	$_fileName = pathinfo( $_file,  PATHINFO_FILENAME );
	$_fileExt = pathinfo( $_file, PATHINFO_EXTENSION );
	$_fileExt = strtolower( $_fileExt );

	if( $_type == 'icon' ) {
	    $_fileIcon = 'data'.DS.'thumbs'.DS.$_fileName.'_32x32.jpg';
	    $imageinit['width']             = '32';
	    $imageinit['height']            = '32';
	} else {
	    $_fileIcon = 'data'.DS.'thumbs'.DS.$_fileName.'.jpg';
	}
	$_fileThumb = 'data'.DS.'thumbs'.DS.$_fileName.'.jpg';
	
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
	if(!$this->image_lib->resize()){
	    echo $this->image_lib->display_errors(); // print error if it fails
	}
    }
    
    private function re_generate( $_unique = NULL ) {
	if( !empty( $_unique ) ) {
	    $this->load->library('image_lib');
	    
	    $_imageName = pathinfo( $_unique, PATHINFO_FILENAME );
	    $config = array(
		    'source_image' => FCPATH.'data'.DS.'files'.DS.$_unique,
		    'new_image' => FCPATH.'data'.DS.'thumbs'.DS.$_imageName.'.jpg',
		    'maintain_ratio' => true,
		    'width' => $this->mGlobal->getConfig('THUMB_X')->configVal,
		    'height' => $this->mGlobal->getConfig('THUMB_Y')->configVal
	    );

	    $this->image_lib->initialize( $config );
	    $this->image_lib->resize();		
	    $this->image_lib->clear();

	    $config32 = array(
		'source_image' => FCPATH.'data'.DS.'files'.DS.$_unique,
		'new_image' => FCPATH.'data'.DS.'thumbs'.DS.$_imageName.'_32x32.jpg',
		'maintain_ratio' => true,
		'width' => '32',
		'height' => '32'
	    );

	    $this->image_lib->initialize( $config32 );
	    $this->image_lib->resize();		
	    $this->image_lib->clear();
	}
    }
    
    public function save() {
	if( $this->input->is_ajax_request() ) {
	    $_file = $this->input->post('inputFile');
	    $_desc = $this->input->post('inputDescription');
	    
	    $_fileDetails = $this->mFiles->getFiles( $_file );
	    $_updated = $this->mFiles->updateDescription( $_file, $_desc );
	    
	    if( $_updated ) {
		$this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' has updated file description for file '{$_fileDetails->fileName}' from '{$_fileDetails->fileDescription}' to '{$_desc}'.", 'data' => $_file, 'size' => NULL ) );

		$_output = array(
		    'type' => 'success',
		    'message' => __('files_msg_descsuccess')
		);
	    } else {
		$_output = array(
		    'type' => 'error',
		    'message' => __('files_msg_descerror')
		);
	    }
	} else {
	    $_output = array(
		'type' => 'error',
		'message' => __('files_msg_noajax')
	    );
	}
	
	$this->output
	    ->set_content_type('application/json')
	    ->set_output( json_encode( $_output ) );	
    }
    
    public function save_tags() {
	if( $this->input->is_ajax_request() ) {
	    $_file = $this->input->get( 'file' );
	    $_tags_array = $this->input->post('tag');
	    
	    $_fileDetails = $this->mFiles->getFiles( $_file );

	    if( isset( $_file ) && !empty( $_file ) && preg_match( "/^(file_)[a-z0-9]{14}.[a-z0-9]{8}/", $_file ) ) {
		$_tags = implode(',', $_tags_array);
		$this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' has updated file tags for file '{$_fileDetails->fileName}' from '{$_fileDetails->fileTags}' to '{$_tags}'.", 'data' => $_file, 'size' => NULL ) );

		$this->mFiles->updateTags( $_file, $_tags );
	    }
	}
    }
    
    public function stream_video() {
	$_filename = $this->input->get( 'file' );
	$_ext = pathinfo( $_filename, PATHINFO_EXTENSION );
	$_data = pathinfo( $_filename, PATHINFO_FILENAME );	
	
	if( isset( $_filename ) && !empty( $_filename ) && preg_match( "/^(data_)[a-z0-9]{14}.[a-z0-9]{8}/", $_data ) )  {
	    $_fileDetails = $this->mFiles->getFileByNewName( $_filename );

	    if( $_fileDetails != false ) {
		$_file = FCPATH.'data/files/'.$_filename;

		if( file_exists( $_file ) ) {
		    $this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' is streaming video file '{$_fileDetails->fileName}'.", 'size' => NULL ) );

		    header('Content-type: video/'.$_ext);
		    header('Expires: -1');
		    header('Cache-Control: no-store, no-cache, must-revalidate');
		    header('Cache-Control: post-check=0, pre-check=0', false);	    
		    header('Content-Length: ' . filesize($_file));

		    @readfile( $_file );	
		}
	    } else {
		$this->mGlobal->log( array( 'type' => "error", 'message' => "User '{$this->session->userdata['companyName']}' tried streaming video file '{$_filename}' but it wasn't found in library.", 'size' => NULL ) );
	    }
	}
	    	    
    }
    
    public function stream_audio() {
	$_filename = $this->input->get( 'file' );
	$_ext = pathinfo( $_filename, PATHINFO_EXTENSION );
	$_data = pathinfo( $_filename, PATHINFO_FILENAME );
	
	if( isset( $_filename ) && !empty( $_filename ) && preg_match( "/^(data_)[a-z0-9]{14}.[a-z0-9]{8}/", $_data ) )  {
	    $_fileDetails = $this->mFiles->getFileByNewName( $_filename );
	    
	    if( $_fileDetails != false ) {
		$_file = FCPATH.'data/files/'.$_filename;

		if( file_exists( $_file ) ) {
		    $this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' is streaming audio file '{$_fileDetails->fileName}'.", 'size' => NULL ) );

		    header('Content-Type: "application/octet-stream"');
		    header('Content-Disposition: inline; filename="'.$filename.'"');
		    header("Content-Transfer-Encoding: binary");
		    header('Expires: 0');
		    header('Pragma: no-cache');
		    header("Content-Length: ".filesize($_file));

		    @readfile($_file);		    
		}
	    } else {
		$this->mGlobal->log( array( 'type' => "error", 'message' => "User '{$this->session->userdata['companyName']}' tried streaming audio file '{$_filename}' but it wasn't found in library.", 'size' => NULL ) );
	    }
	}
	    	    
    }

        public function stream_pdf() {
            $_filename = $this->input->get( 'file' );
            $_ext = pathinfo( $_filename, PATHINFO_EXTENSION );
            $_data = pathinfo( $_filename, PATHINFO_FILENAME );

            if( isset( $_filename ) && !empty( $_filename ) && preg_match( "/^(data_)[a-z0-9]{14}.[a-z0-9]{8}/", $_data ) )  {
                $_fileDetails = $this->mFiles->getFileByNewName( $_filename );

                if( $_fileDetails != false ) {
                    $_file = FCPATH.'data/files/'.$_filename;

                    if( file_exists( $_file ) ) {
                        $this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' is streaming pdf file '{$_fileDetails->fileName}'.", 'size' => NULL ) );

                        header('Content-Type: "application/pdf"');
                        header('Content-Disposition: inline; filename="'.$filename.'"');
                        header("Content-Transfer-Encoding: binary");
                        header('Expires: 0');
                        header('Pragma: no-cache');
                        header("Content-Length: ".filesize($_file));

                        @readfile($_file);		    
                    }
                } else {
                    $this->mGlobal->log( array( 'type' => "error", 'message' => "User '{$this->session->userdata['companyName']}' tried streaming pdf file '{$_filename}' but it wasn't found in library.", 'size' => NULL ) );
                }
            }

        }

 	public function delete_ajax() {
 		if( $this->input->is_ajax_request() ) {
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

 	public function create_archive() {
            if( $this->input->is_ajax_request() ) {
                $_all_get = $this->input->post(NULL, TRUE);

                if( count( $_all_get['mFile'] ) != 0 ) {
                    $_tmp_folder = uniqid( 'tmp_' );
                    $_tmp_path = FCPATH.'data'.DS.'tmp'.DS;

                    if( !is_dir( $_tmp_path.$_tmp_folder ) ) {
                        if( mkdir( $_tmp_path.$_tmp_folder, 0700 ) ) {
                            $_zip_file = 'archive-'.date('Ymd-His').'.zip';

                            $zip = new ZipArchive;
                            $res = $zip->open( $_tmp_path.$_tmp_folder.DS.$_zip_file, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE );

                            if( $res === true ) {
                                $_error = array();
                                for( $i = 0; $i < count( $_all_get['mFile'] ); $i++ ) {
                                    $_fileDetails = $this->mFiles->getFiles( $_all_get['mFile'][$i] );

                                    if( file_exists( FCPATH.'data'.DS.'files'.DS.$_fileDetails->fileNewName ) ) {
                                        $zip->addFile( FCPATH.'data'.DS.'files'.DS.$_fileDetails->fileNewName, $_fileDetails->fileName );
                                    } else {
                                        $_error[] = $_fileDetails->fileName;
                                    }
                                }	   

                                $zip->close();

                                if( file_exists( $_tmp_path.$_tmp_folder.DS.$_zip_file ) ) {
                                    $this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' has created a zip archive '{$_zip_file}'.", 'size' => filesize($_tmp_path.$_tmp_folder.DS.$_zip_file) ) );

                                    if( count( $_error ) != 0 ) { 
                                        $_return = array(
                                            'type' => 'error',
                                            'mesage' => __('files_msg_zipnotadded',implode(',', $_error))
                                        );
                                    } else {
                                        $_return = array(
                                            'type' => 'success',
                                            'message' => '',
                                            'download' => '<a href="'.site_url( 'admin/files/zip/'.$_tmp_folder.'/'.$_zip_file ).'">'.$_zip_file.'</a>',
                                            'zipfile' => $_zip_file,
                                            'downfolder' => $_tmp_folder.'/'.$_zip_file
                                        );
                                    }
                                } else {
                                    $_return = array(
                                        'type' => 'error',
                                        'mesage' => __('files_msg_ziperrorfound')
                                    );
                                }		
                            } else {
                                $_return = array(
                                    'type' => 'error',
                                    'message' => __('files_msg_zipnotcreated')
                                );
                            }

                        } else {
                            $_return = array(
                                'type' => 'error',
                                'message' => __('files_msg_zipfoldcreate')
                            );
                        }
                    } else {
                        $_return = array(
                            'type' => 'error',
                            'message' => __('files_msg_zipfolderexists')
                        );
                    }

                } else {
                    $_return = array(
                        'type' => 'error',
                        'message' => __('files_msg_transmitproblem')
                    );
                }
            } else {
                $_return = array(
                    'type' => 'error',
                    'message' => __('files_msg_noajax')
                );
            }

            $this->output
                ->set_content_type( 'application/json' )
                ->set_output( json_encode( $_return ) ); 
 	}

    public function zip() {
        $_folder = $this->uri->segment(4);
        $_file = $this->uri->segment(5);
        $_file_name = FCPATH.'data/tmp/'.$_folder.'/'.$_file;

        if( file_exists( $_file_name ) ) {		    
            $_downType = $this->mGlobal->getConfig('DOWNLOAD_TYPE')->configVal;

            if( $_downType == 'normal' ) {
                header('Content-type: application/zip');
                header('Content-Disposition: attachment; filename="' . $_file . '"');
                header('Content-Transfer-Encoding: binary');
                header('Content-Length: ' . filesize( $_file_name ));
                header('Accept-Ranges: bytes');
                @readfile( $_file_name );
            } else {
                $_chunkSize = (int)$this->mGlobal->getConfig('CHUNKED_SIZE')->configVal;

                header('Content-type: application/zip');
                header('Content-Disposition: attachment; filename="' . $_file . '"');
                header('Content-Transfer-Encoding: binary');
                header('Content-Length: ' . filesize( $_file_name ) );
                header('Connection: Keep-Alive');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Accept-Ranges: bytes');

                ob_clean();
                $handle = fopen($_file_name, "rb");
                $chunksize=(filesize($_file_name)/$_chunkSize);

                set_time_limit(0);
                while (!feof($handle)) {
                    echo fgets($handle, $chunksize);
                    flush();
                }
                fclose($handle);
            }

            $this->mGlobal->log( array( 'type' => "down", 'message' => "User '{$this->session->userdata['companyName']}' downloaded file '{$_file}'.", 'size' => filesize( $_file_name ) ) );

        } else {
            $this->mGlobal->log( array( 'type' => "down", 'message' => "The File '{$_file}' requested does not exist on server.", 'data' => $_file, 'size' => NULL ) );
        }
        exit;
    }    
    
    public function remove_archive() {
        if( $this->input->is_ajax_request() ) {
            $_file = $this->input->post('zipfile');
            $_tmp_path = FCPATH.'data'.DS.'tmp'.DS.$_file;

            if( file_exists( $_tmp_path ) ) {
                if( unlink( $_tmp_path  ) ) {
                    $_folder = dirname( $_tmp_path );
                    
                    if( file_exists( $_folder ) ) {
                        if( rmdir( $_folder ) ) {
                            $this->mGlobal->log( array( 'type' => "info", 'message' => "The temporary folder for the ZIP file {$_file} was successfully removed." ) );
                        } else {
                            $this->mGlobal->log( array( 'type' => "error", 'message' => "The folder {$_file} could not be removed!" ) );
                        }
                    } else {
                        $this->mGlobal->log( array( 'type' => "error", 'message' => "The folder {$_folder} does not exist!" ) );
                    }
                } else {
                    $this->mGlobal->log( array( 'type' => "error", 'message' => "The temporary ZIP {$_file} could not be removed!" ) );
                }
            } else {
                $this->mGlobal->log( array( 'type' => "error", 'message' => "The temporary ZIP {$_file} does not exist!" ) );
            }
        } else {
            $_return = array(
                'type' => 'error',
                'message' => __('files_msg_noajax')
            );
        }

        $this->output
            ->set_content_type( 'application/json' )
            ->set_output( json_encode( $_return ) ); 
    }
 	  
}