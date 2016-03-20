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

class Pubuploads extends CWX_Controller {
    
    public function index() {
	redirect('admin/pubuploads/all_entries');
    }
    
    public function all_entries() {
	$this->load->model('user/mUser');
	
	$errortype = isset($_GET['errortype']) ? $_GET['errortype'] : false;
	$errormsg = isset($_GET['errormsg']) ? urldecode( $_GET['errormsg'] ) : '';
				
	$_data = array(
	    'errortype' => $errortype,
	    'errormsg' => $errormsg,
	    'site' => 'pubuploads/all_entries',
	    'title' => __('uploads_title_alluploads'),
	    'items' => $this->mPubuploads->getUploads()
	);
    
	$this->load->view( 'master', $_data );	
	
    }
    
    public function add_upload( $errortype = false, $errormsg = '' ) {
        require APPPATH.'libraries/csfolder.php';
        $this->load->helper( 'form' );
        
        $_folder = new csFolder();

        $_data = array(
            'errortype' => $errortype,
            'errormsg' => $errormsg,
            'site' => 'pubuploads/add_upload',
            'title' => __('uploads_title_add'),
            'folders' => $_folder->getSelect( 0, 1, NULL, 'inputFolder', 'span2', '' )
        );

        $this->load->view( 'master', $_data );			
    }
    
    public function verify_upload() {
	require APPPATH.'libraries/uuid.php';
        
	$_uuid = UUID::generate();
	$_description = $this->input->post('inputDescription');
	$_folder = $this->input->post('inputFolder');
        
	if( !empty( $_description ) ) $_description = addslashes( $_description );
        if( !isset( $_folder ) || empty( $_folder ) || $_folder == '0' ) $_folder = NULL;
	
	$_added = $this->mPubuploads->createUpload( array('uploadUUID' => $_uuid, 'uploadMessage' => $_description, 'defaultFolderID' => $_folder ) );
	
	if( $_added ) {
	    $_errortype = 'success';
	    $_errormsg = __('uploads_msg_addedsuccess');
	
	    $this->mGlobal->log( array( 'type' => "info", 'message' => "Download request with id '{$_uuid}' created by user '{$this->session->userdata['companyName']}'.", 'size' => NULL ) );
	} else {
	    $_errortype = 'error';
	    $_errormsg = __('uploads_msg_addederror');
	    
	    $this->mGlobal->log( array( 'type' => "error", 'message' => "Download request with id '{$_uuid}' from user '{$this->session->userdata['companyName']}' could not be created.", 'size' => NULL ) );
	}
	
	redirect( 'admin/pubuploads/all_entries?errortype='.$_errortype.'&errormsg='.urlencode( $_errormsg ) );
    }
    
    public function edit_entry( $errortype = false, $errormsg = '' ) {
        require APPPATH.'libraries/csfolder.php';
	$this->load->helper( array( 'form' ) );

	$_entry = $this->input->get('entry');
        $_folder = new csFolder();
        
        if( preg_match( "/^(upl_)[a-z0-9]{14}.[a-z0-9]{8}/", $_entry ) ) {
            $_details = $this->mPubuploads->getUpload( $_entry );
            
            $_data = array(
                'errortype' => $errortype,
                'errormsg' => $errormsg,
                'site' => 'pubuploads/edit_upload',
                'title' => __('uploads_title_editupload'),
                'details' => $_details,
		'entry' => $_entry,
                'folders' => $_folder->getSelect( 0, 1, $_details->defaultFolderID, 'inputFolder', 'span2', '' )
            );

            $this->load->view( 'master', $_data );
	
        } else {
            redirect('admin/pubuploads/all_entries?errortype=error&errormsg='.urlencode( __('uploads_msg_argumenterror') ));
        }
    }
    
    public function edit_upload() {
	$_description = $this->input->post('inputDescription');
	$_entry = $this->input->post('entry');
        $_folder = $this->input->post('inputFolder');
	
	if( preg_match( "/^(upl_)[a-z0-9]{14}.[a-z0-9]{8}/", $_entry ) ) {

	    if( !empty( $_description ) ) $_description = addslashes( $_description );
	    if( !isset( $_folder ) || empty( $_folder ) || $_folder == '0' ) $_folder = NULL;

	    $_edited = $this->mPubuploads->editUpload( $_entry, $_description, $_folder );

	    if( $_edited ) {
		$_errortype = 'success';
		$_errormsg = __('uploads_msg_modsuccess');

		$this->mGlobal->log( array( 'type' => "info", 'message' => "Public download link with id '{$_uuid}' edit by user '{$this->session->userdata['companyName']}'.", 'size' => NULL ) );
	    } else {
		$_errortype = 'error';
		$_errormsg = __('uploads_msg_moderror');

		$this->mGlobal->log( array( 'type' => "error", 'message' => "Public download link with id '{$_uuid}' could not be edited by user '{$this->session->userdata['companyName']}'.", 'size' => NULL ) );
	    }

	    redirect( 'admin/pubuploads/all_entries?errortype='.$_errortype.'&errormsg='.urlencode( $_errormsg ) );
	
	} else {
	    redirect('admin/pubuploads/all_entries?errortype=error&errormsg='.urlencode( __('uploads_msg_argumenterror') ));	    
	}
    }    
    
    public function delete_entry() {
	$_entry = $this->input->get( 'entry' );
	
	if( isset( $_entry ) && !empty( $_entry ) ) {
	    if( $this->mPubuploads->deleteEntry( $_entry ) ) {	
		$this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' has removed public download link '{$_entry}'.", 'size' => NULL ) );
		redirect('admin/pubuploads/all_entries?errortype=success&errormsg='.urlencode( __('uploads_msg_entryremovesuccess') ));		
	    } else {
		$this->mGlobal->log( array( 'type' => "error", 'message' => "User '{$this->session->userdata['companyName']}' tried to remove public download link '{$_entry}' but a database error occured.", 'size' => NULL ) );
		redirect('admin/pubuploads/all_entries?errortype=error&errormsg='.urlencode( __('uploads_msg_dberrror') ));
	    }
	} else {
	    $this->mGlobal->log( array( 'type' => "error", 'message' => "User '{$this->session->userdata['companyName']}' tried to remove public download link '{$_entry}' but a parameter error occured.", 'size' => NULL ) );
	    redirect('admin/pubuploads/all_entries?errortype=error&errormsg='.urlencode( __('uploads_msg_argumenterror') ));
	}	
    }    
    
    
    public function published_entry() {
	$_is = $this->input->get( 'is' );
	$_entry = $this->input->get( 'entry' );
	
	if( isset( $_is ) && isset( $_entry ) && !empty( $_entry ) ) {
	    if( $_is == '1' ) {
		$_set = '0';
	    } else {
		$_set = '1';
	    }
	    	    
	    if( $this->mPubuploads->setPublishedEntry( $_set, $_entry ) ) {
		$this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' has changed the publish state of public download '{$_entry}' to '{$_set}'.", 'size' => NULL ) );
		redirect( 'admin/pubuploads/all_entries?errortype=success&errormsg='.urlencode( __('uploads_msg_statuschangesuccess') ) );
	    } else {
		$this->mGlobal->log( array( 'type' => "error", 'message' => "User '{$this->session->userdata['companyName']}' tried to change publish state of public download '{$_entry}' to '{$_set}' but a database error occured.", 'size' => NULL ) );
		redirect( 'admin/pubuploads/all_entries?errortype=error&errormsg='.urlencode( __('uploads_msg_statuschangeerror') ) );
	    }
	} else {
	    $this->mGlobal->log( array( 'type' => "error", 'message' => "User '{$this->session->userdata['companyName']}' tried to change publish state of public download '{$_entry}' to '{$_set}' but parameter error occured.", 'size' => NULL ) );
	    redirect( 'admin/pubuploads/all_entries?errortype=error&errormsg='.urlencode( __('uploads_msg_argumenterror') ) );
	}
    }
    
    
}