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

class Dashboard extends CWX_Controller {
	
    public function index() {
	$this->load->model('user/mUser');
	$errortype = isset($_GET['errortype']) ? $_GET['errortype'] : false;
	$errormsg = isset($_GET['errormsg']) ? urldecode( $_GET['errormsg'] ) : '';
	        
	$_data = array(
	    'errortype' => $errortype,
	    'errormsg' => $errormsg,
	    'title' => __('dash_title_dashboard'),
	    'site' => 'dashboard/index',
            
	    'diskfree' => disk_free_space( FCPATH ),
	    'disktotal' => disk_total_space( FCPATH ),
            
	    'files' => $this->mDashboard->latestFiles(),
            
            'regUserBar' => $this->mDashboard->regUsers( true ),
            'regUser' => $this->mDashboard->regUsers(),
            
            'totalFilesBar' => $this->mDashboard->regTotalFiles( true ),
            'totalFiles' => $this->mDashboard->regTotalFiles(),
            
            'totalFileSizeBar' => $this->mDashboard->regTotalFileSize( true ),
            'totalFileSize' => $this->mDashboard->regTotalFileSize(),
            
            'downFileSizeBar' => $this->mDashboard->downTotalFileSize( true ),
            'downFileSize' => $this->mDashboard->downTotalFileSize()
	);
    
	$this->load->view( 'master', $_data );
    
    }
    
    public function access() {
	$_data = array(
	    'title' => __('dash_title_restricted'),
	    'site' => 'dashboard/access'
	);
    
	$this->load->view( 'master', $_data );	
    }
    
}