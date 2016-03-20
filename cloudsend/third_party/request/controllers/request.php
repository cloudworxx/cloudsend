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

class Request extends CWX_Controller {
    
    public function index() {
	$_uuid = $this->uri->segment(2);
	
	if( isset( $_uuid ) && !empty( $_uuid ) && preg_match( "/^[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/", $_uuid ) ) {

	    $_details = $this->mRequest->getUploadByUUID( $_uuid );
	    
	    if( $_details != false ) {
		$this->session->set_userdata('importUnique',uniqid('imp_',true));
		$this->session->set_userdata('requestID',$_uuid);
		$this->session->set_userdata('fileByRequest','1');

		$errortype = isset($_GET['errortype']) ? $_GET['errortype'] : false;
		$errormsg = isset($_GET['errormsg']) ? urldecode( $_GET['errormsg'] ) : '';

		$_data = array(
		    'title' => __('request_title_publicupload'),
		    'site' => 'request/index',
		    'errortype' => $errortype,
		    'errormsg' => $errormsg,
		    'showfree' => $this->mGlobal->getConfig('SHOW_FREESPACE_USER')->configVal,
		    'diskfree' => disk_free_space( FCPATH ),
		    'disktotal' => disk_total_space( FCPATH ),
		    'details' => $this->mRequest->getUploadByUUID( $_uuid ),
		    'request' => $_uuid,
                    'folder' => ( ( isset( $_details->defaultFolderID ) && !is_null( $_details->defaultFolderID ) && !empty( $_details->defaultFolderID ) ) ? $_details->defaultFolderID : '' )
		);

		$this->load->view( 'request', $_data );
	    } else {
		redirect( 'request/error' );
	    }
	} else {
	    redirect('request/error');
	}

    }
    
    public function upload() {	
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
    
    public function finished() {
	if( $this->input->is_ajax_request() ) {
	    $_data = $this->input->post('data');

	    $this->_sendFileEmail( $_data );
	}
    }
    
    private function _sendFileEmail( $_list = array() ) {
	$this->load->model(array('user/mUser','mGlobal','pubuploads/mPubuploads'));
	
	if( is_array( $_list ) && count( $_list ) != 0  ) {
	    $_requestUUID = $this->session->userdata['requestID'];
	    $_requestDetails = $this->mPubuploads->getUploadByUUID( $_requestUUID );
	    	    
	    $_details = $this->mUser->getUser( $_requestDetails->userUniqueID  );
	    
	    if( $_details != false ) {
		$this->load->library( 'email' );
		$this->load->helper( 'myemail' );
		
		$emailsend = emailconfig();
		
		$this->email->initialize( $emailsend );		
		
		$_emailBody = $this->mGlobal->getConfig('SEND_FILES_REQUEST')->configVal;
		$_emailSubject = $this->mGlobal->getConfig('SEND_FILES_REQSUBJECT')->configVal;
		$_productName = $this->mGlobal->getConfig('PRODUCT_NAME')->configVal;
		
		$_listText = '';
		for( $i = 0; $i < count( $_list ); $i++ ) {
		    $_data = explode( '|', $_list[$i] );
		    
		    $_listText .= "<br />- ".$_data[0].' ( '.roundsize( $_data[1] ).' )';
		}
		
		
		$_emailBody = str_replace( '{adminurl}',site_url( 'admin/account/login' ), $_emailBody );
		$_emailBody = str_replace( '{filelist}',$_listText, $_emailBody );
		$_emailBody = str_replace( '{request}',$_requestUUID->uploadUUID, $_emailBody );
		$_emailBody = str_replace( '{product}',$_productName, $_emailBody );
		
		$_emailSubject = str_replace( '{request}',$_requestUUID->uploadUUID, $_emailSubject );
		$_emailSubject = str_replace( '{product}',$_productName, $_emailSubject );
		
		$this->email->clear( TRUE );
		
		$this->email->to( $_details->emailAddress );
		$this->email->from( $_details->emailAddress, $_sender->companyName );
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
    
    public function error() {

	$_data = array(
	    'title' => __('request_title_error'),
	    'site' => 'request/error'
	);

	$this->load->view( 'request', $_data );
    }    
    
}