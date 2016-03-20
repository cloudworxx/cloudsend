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


class mGlobal extends CWX_Model {
    
    public function getConfig( $_var = NULL ) {
	
	if( isset( $_var ) && !empty( $_var ) ) {
	    $_where = array(
			'configVar' => $_var
	    );
	}
	
	$_found = $this->db->where( $_where )->get( 'config', 1 );
	
	if( $_found->num_rows() == 1 ) {
	    return $_found->row();
	}
	
	return false;
	
    }
    
    public function log( $_data = array() ) {
	if( isset( $_data ) && is_array( $_data ) && count( $_data ) >= 3 ) {
	    
	    $_ip = NULL;
	    if ( isset($_SERVER["REMOTE_ADDR"]) )    {
		$_ip = $_SERVER["REMOTE_ADDR"];
	    } else if ( isset($_SERVER["HTTP_X_FORWARDED_FOR"]) )    {
		$_ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	    } else if ( isset($_SERVER["HTTP_CLIENT_IP"]) )    {
		$_ip = $_SERVER["HTTP_CLIENT_IP"];
	    } 	    
	    
	    $_browser = $_SERVER['HTTP_USER_AGENT'];
	    
	    $_insert = array(
		'id' => NULL,
		'logUniqueID' => uniqid( 'log_', true ),
		'logType' => $_data['type'],
		'logMessage' => $_data['message'],
		'logTime' => time(),
		'logIP' => $_ip,
		'logBrowser' => $_browser,
		'logSize' => $_data['size']
	    );
	    
	    if( isset( $_data['data'] ) && !empty( $_data['data'] ) ) {
		$_insert['logDataID'] = $_data['data'];
	    } else {
		$_insert['logDataID'] = (isset($this->session->userdata['userUnique'])) ? $this->session->userdata['userUnique'] : NULL;
	    }
	    
	    $_inserted = $this->db->insert( 'logs', $_insert );

	    return $_inserted;
	}
	
	return false;
    }
    
}