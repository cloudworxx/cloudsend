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

class Settings extends CWX_Controller {
    
    public function __construct() {
	parent::__construct();
	
	if( $this->session->userdata['level'] != '1' ) {
	    redirect( 'dashboard/access' );
	}
	
	$this->parts = array( 'general', 'email', 'templates', 'thumbnails', 'downloads' );
    }
	
    public function index( $_errortype = false, $_errormsg = '' ) {
	$this->load->helper(array('form','directory')); // UPDATE: v 1.2
	
	$_part = $this->input->get('part');

	if( !isset( $_part ) OR empty( $_part ) OR $_part == 'index' ) {
	    $_part = 'general';
	} 
	
	if( !in_array( $_part, $this->parts ) ) {
	    show_404();
	    exit;
	}
	
	$errortype = isset($_GET['errortype']) ? $_GET['errortype'] : ( ( $_errortype != false ) ? $_errortype : false );
	$errormsg = isset($_GET['errormsg']) ? urldecode( $_GET['errormsg'] ) : ( ( $_errortype != false ) ? urldecode( $_errormsg ) : '' );
	
	$_data = array(
	    'errortype' => $errortype,
	    'errormsg' => $errormsg,
	    'title' => __('set_title_settings'),
	    'site' => 'settings/index',
	    'section' => $_part,
	    'parts' => $this->parts,
	    'settings' => $this->mSettings->loadSettings( $_part )
	);
    
	$this->load->view( 'master', $_data );
    
    }
    
    public function verify() {
	$this->load->library('form_validation');
	$_section = $this->input->post('section');
	
	if( $_section == 'general' ) {
	    $_function = 'index';
	} else {
	    $_function = $_section;
	}
	
	if( isset( $_section ) && in_array( $_section, $this->parts ) ) {
	    $_old_settings = $this->mSettings->loadSettings( $_section );
	    
	    $config = array();
	    foreach( $_old_settings AS $_old ) {
		if( $_old->configNeeded == '1' ) {
		    $config[] = array( 'field' => 'inputSetting['.$_old->configVar.']', 'label' => __('set_lbl_'.strtolower( $_old->configVar) ), 'rules' => 'trim|required' );
		}
	    }
	    
	    $this->form_validation->set_rules( $config );
	    
	    if( $this->form_validation->run( $this ) == FALSE ) {
		$errortype = 'error';
		$errormsg = validation_errors( ' ','<br />' );
		$this->$_function( $errortype, $errormsg );
	    } else {
		$_postVars = $this->input->post( NULL, TRUE );
		
		$_updates = $this->mSettings->updateSettings( $_postVars );

		if( $_updates ) {
		    $this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' changed settings in area '{$_function}'.", 'size' => NULL ) );
		    $errortype = 'success';
		    $errormsg = __('set_msg_editsuccess');
		    redirect( 'admin/settings?part='.$_function.'&errortype='.$errortype.'&errormsg='.urlencode( $errormsg ) );
		} else {
		    $errortype = 'error';
		    $errormsg = __('set_msg_editerror');
		    $this->$_function( $errortype, $errormsg );		    
		}
	    }
	}
    }
        
}