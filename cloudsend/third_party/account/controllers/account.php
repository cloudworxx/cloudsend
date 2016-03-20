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

class Account extends CWX_Controller {
	
    public function index() {
	if( $this->session->userdata('is_logged_in') == false ) {
	    redirect( 'admin/account/login' );
	} else {
	    redirect( 'admin/dashboard/index' );
	}
    }
    
    
    public function login( $errortype = 'info', $errormsg = 'account_msg_login', $uselang = true ) {
	
	if( $this->session->userdata('is_logged_in') ) {
	    
	    redirect( 'admin/dashboard/index' );
	    
	} else {
	
	    $this->load->helper('form');

	    $_data = array(
		'title' => __('account_title_login'),
		'site' => 'account/login_box',
		'errortype' => $errortype,
		'errormsg' => ( $uselang  ) ? __($errormsg) : $errormsg
	    );

	    $this->load->view( 'master', $_data );
	
	}
	
    }
    
    public function validate() {
	$this->load->helper( array('form') );
	$this->load->library('form_validation');
	
	$config = array(
	    array( 'field' => 'inputEmail',	'label' => __('account_lbl_email'),	'rules' => 'trim|required|valid_email' ),
	    array( 'field' => 'inputPassword',	'label' => __('account_lbl_password'),	'rules' => 'trim|required' )
	);
	
	$this->form_validation->set_rules( $config );
	
	if( $this->form_validation->run() == false ) {
	    $_email = $this->input->post('inputEmail');
	    $_email = ( ( isset( $_email ) && !empty( $_email ) ) ? 'with email "'.$_email.'" ' : '' );
	    $this->mGlobal->log( array( 'type' => 'error', 'message' => "Someone {$_email}tried to log in.", 'size' => NULL ) );
	    $errormsg = validation_errors( ' ', '<br />' );
	    $this->login( 'error', $errormsg, false );
	} else {
	    $_account = $this->mAccount->validateLogin();
	    
	    if( $_account != false ) {		
		$_session = array(
		    'userUnique' => $_account->userUniqueID,
		    'companyName' => $_account->companyName,
		    'timeZone' => $_account->timeZone,
		    'timeFormat' => $_account->timeFormat,
		    'emailAddress' => $_account->emailAddress,
		    'level' => $_account->level,
		    'fileByCustomer' => '0',
		    'is_logged_in' => true
		);
		
		$this->session->set_userdata( $_session );
		
		$this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$_account->companyName}' logged in.", 'size' => NULL ) );
		
		redirect( 'admin/dashboard/index' );
	    } else {
		$_email = $this->input->post('inputEmail');
		$_email = ( ( isset( $_email ) && !empty( $_email ) ) ? 'with email "'.$_email.'" ' : '' );
		$this->mGlobal->log( array( 'type' => 'error', 'message' => "Someone {$_email}tried to log in.", 'size' => NULL ) );		
		$this->login( 'error', 'account_msg_loginerror' );
	    }
	}
    }
    
    
    public function logout() {
	$this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' logged out.", 'size' => NULL ) );
	$_session = array(
	    'userUnique' => '',
	    'companyName' => '',
	    'timeZone' => '',
	    'timeFormat' => '',
	    'emailAddress' => '',
	    'level' => '',
	    'fileByCustomer' => '',
	    'is_logged_in' => false
	);
	$this->session->unset_userdata( $_session );
	redirect( 'admin/account/login' );
    }
}

/* End of file login.php */
