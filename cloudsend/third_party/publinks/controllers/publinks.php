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

class Publinks extends CWX_Controller {
        
    public function index() {
		redirect( 'admin/publinks/all_entries' );
    }
    
    public function all_entries() {
		$this->load->model('user/mUser');
		
		$errortype = isset($_GET['errortype']) ? $_GET['errortype'] : false;
		$errormsg = isset($_GET['errormsg']) ? urldecode( $_GET['errormsg'] ) : '';
					
		$_data = array(
		    'errortype' => $errortype,
		    'errormsg' => $errormsg,
		    'site' => 'publinks/all_entries',
		    'title' => __('pub_title_publiclinks'),
		    'items' => $this->mPublinks->getLinks()
		);
	    
		$this->load->view( 'master', $_data );	
    }
   
    
    public function edit_entry( $errortype = false, $errormsg = '', $_edit_user = NULL ) {
		$this->load->model('user/mUser');
		$this->load->helper( array( 'form' ) );

		$_entry = $this->input->get('entry');
        
        if( preg_match( "/^(pub_)[a-z0-9]{14}.[a-z0-9]{8}/", $_entry ) ) {
		
            $_data = array(
                'errortype' => $errortype,
                'errormsg' => $errormsg,
                'site' => 'publinks/edit_entry',
                'title' => __('pub_title_editpublink'),
                'details' => $this->mPublinks->getEntry( $_entry ),
                'files' => $this->mPublinks->getEntryFiles( $_entry )
            );

            $this->load->view( 'master', $_data );
	
        } else {
            redirect('admin/publinks/all_entries?errortype=error&errormsg='.urlencode( __('pub_msg_argumenterror') ));
        }
    }
    
    public function delete_entry() {
		$_entry = $this->input->get( 'entry' );
		
		if( isset( $_entry ) && !empty( $_entry ) ) {
		    if( $this->mPublinks->deleteEntry( $_entry ) ) {	
			$this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' has removed public link '{$_entry}'.", 'size' => NULL ) );
			redirect('admin/publinks/all_entries?errortype=success&errormsg='.urlencode( __('pub_msg_entryremovesuccess') ));		
		    } else {
			$this->mGlobal->log( array( 'type' => "error", 'message' => "User '{$this->session->userdata['companyName']}' tried to remove public link '{$_entry}' but a database error occured.", 'size' => NULL ) );
			redirect('admin/publinks/all_entries?errortype=error&errormsg='.urlencode( __('pub_msg_dberrror') ));
		    }
		} else {
		    $this->mGlobal->log( array( 'type' => "error", 'message' => "User '{$this->session->userdata['companyName']}' tried to remove public link '{$_entry}' but a parameter error occured.", 'size' => NULL ) );
		    redirect('admin/publinks/all_entries?errortype=error&errormsg='.urlencode( __('pub_msg_argumenterror') ));
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
		    	    
		    if( $this->mPublinks->setPublishedEntry( $_set, $_entry ) ) {
			$this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' has changed the publish state of link '{$_entry}' to '{$_set}'.", 'size' => NULL ) );
			redirect( 'admin/publinks/all_entries?errortype=success&errormsg='.urlencode( __('pub_msg_statuschangesuccess') ) );
		    } else {
			$this->mGlobal->log( array( 'type' => "error", 'message' => "User '{$this->session->userdata['companyName']}' tried to change publish state of link '{$_entry}' to '{$_set}' but a database error occured.", 'size' => NULL ) );
			redirect( 'admin/publinks/all_entries?errortype=error&errormsg='.urlencode( __('pub_msg_statuschangeerror') ) );
		    }
		} else {
		    $this->mGlobal->log( array( 'type' => "error", 'message' => "User '{$this->session->userdata['companyName']}' tried to change publish state of link '{$_entry}' to '{$_set}' but parameter error occured.", 'size' => NULL ) );
		    redirect( 'admin/publinks/all_entries?errortype=error&errormsg='.urlencode( __('pub_msg_erroroccured') ) );
		}
    }
  
}