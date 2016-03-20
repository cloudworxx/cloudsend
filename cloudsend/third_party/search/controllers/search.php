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

class Search extends CWX_Controller {
    
    public function index() {
	$_query = $this->input->post('query');
	$_redirect = $this->input->post('redirect');

	if( isset( $_query ) && !empty( $_query ) ) {
	    $_return = $this->mSearch->search( $_query );
	    
	    if( $_return != false ) {
		$this->load->model( array('user/mUser') );
		
		$_data = array(
		    'title' => __('srch_title_results'),
		    'site' => 'search/results',
		    'search' => $_query,
		    'files' => $_return,
		    'users' => $this->mUser->getAllStdUser()
		);

		$this->load->view( 'master', $_data );	
	    } else {
		redirect( 'admin/files/index?errortype=error&errormsg='.urlencode(__('srch_msg_noresults')) );
	    }
	} else {
	    redirect( $_redirect );
	}
    }
    
    public function typeahead() {
	$_query = $this->input->post('query');
	
	if( isset( $_query ) && !empty( $_query ) ) {
	    $_return = $this->mSearch->search( $_query );
	  
	    if( $_return != false ) {
		$_result = array();
		
		foreach( $_return AS $_entry ) {
		    $_result[] = $_entry->fileName;
		}

		if( count( $_result ) != 0 ) {
		    $this->output
			    ->set_content_type( 'application/json' )
			    ->set_output( json_encode( $_result ) );
		}
	    } 
	} 
	
    }
    
}