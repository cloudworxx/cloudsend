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

/* load the MX_Controller class */
require APPPATH."third_party/MX/Controller.php";

class CWX_Controller extends MX_Controller {
	
    public $_thisclass;

    public function CWX_Controller() {	
    	$_uri_string = uri_string();
    	$_uri_string = strtolower( $_uri_string );

    	if( $_uri_string != 'admin/folder' AND $_uri_string != 'admin/folder/' AND 
    		$_uri_string != 'admin/folder/index' AND $_uri_string != 'admin/folder/index#' ) $this->session->unset_userdata( 'folderUniqueID' );
		$this->logdata = (object)$this->session->all_userdata();
		
		$thisclass = $this->router->class;

		$this->_thisclass = $thisclass;

		if( strtolower($this->_thisclass) != 'account' && strtolower($this->_thisclass) != 'publiclib' && strtolower($this->_thisclass) != 'frontend' && strtolower( $this->_thisclass ) != 'request' ) {
		    $this->session->unset_userdata('fileByRequest');
		    $_userUnique = $this->session->userdata('userUnique');
		    
		    if(!isset($this->logdata->is_logged_in) OR (bool)$this->logdata->is_logged_in != true ) {
				date_default_timezone_set( 'America/Los_Angeles' );
				redirect('admin/account/login');
		    } else {
				if( !isset( $_userUnique ) OR empty( $_userUnique ) ) redirect( 'admin/account/logout' );
				$_timeZone = $this->logdata->timeZone;
				date_default_timezone_set( $_timeZone );
		    }
		}

		$thismodel = 'm'.ucfirst($thisclass);

		if(file_exists(APPPATH."models/".strtolower($thismodel).EXT)) {
		    $this->load->model($thismodel);
		} else if(file_exists(APPPATH."third_party/".$thisclass."/models/".strtolower($thismodel).EXT)) {
		    $this->load->model($thismodel);
		}
    }

}