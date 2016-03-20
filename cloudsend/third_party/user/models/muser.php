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

class mUser extends CWX_Model {
    
    public function getUsers() {	
		$_found = $this->db->get( 'user' );
		
		if( $_found->num_rows() != 0 ) {
		    return $_found->result();
		} 
		
		return false;
    }
  
    public function getUser( $_user = NULL ) {
		if( $_user != NULL && !empty( $_user ) ) {
		    $_where = array(
				'userUniqueID' => $_user
		    );

		    $_found = $this->db->where( $_where )->get( 'user' );

		    if( $_found->num_rows() == 1 ) {
				return $_found->row();
		    } else {
				return false;
		    }
		} else {
		    return false;
		}
    }
        
    public function getAllStdUser() {
		$_where = array(
		    'level' => 3
		);

		$_found = $this->db->where( $_where )->order_by( 'companyName', 'ASC' )->get( 'user' );

		if( $_found->num_rows() != 0 ) {
		    return $_found->result();
		} 
		
		return false;
    }
    
    public function getAllAdminUser() {
		$_where = array(
		    'level <=' => 2
		);

		$_found = $this->db->where( $_where )->order_by( 'companyName', 'ASC' )->get( 'user' );

		if( $_found->num_rows() != 0 ) {
		    return $_found->result();
		} 
		
		return false;
    }

    public function countSuperAdminUser() {
		$_where = array(
		    'level' => 1
		);

		$_total = $this->db->where( $_where )->count_all_results( 'user' );

		return $_total;
    }

    public function addUser() {
	
	$_uniqid = uniqid( 'usr_', true );
	$_level = $this->input->post('inputLevel');
	$_url = $this->input->post('inputURL');
	
	$_max_size = $this->input->post( 'inputMaxSize' );
	$_max_files = $this->input->post( 'inputMaxFiles' );
	$_accepted_types = $this->input->post( 'inputAcceptTypes' );
        
        $_folder = $this->input->post('inputFolder');
        if( !isset( $_folder ) || empty( $_folder ) || $_folder == '0' ) $_folder = NULL;        
        
	$_can_upload = $this->input->post( 'inputCanUpload' );
	if( isset( $_can_upload ) && !empty( $_can_upload ) && $_can_upload == '1' ) {
	    $_can_up = '1';
	} else {
	    $_can_up = '0';
	}
	
	$_can_download = $this->input->post( 'inputCanDownload' );
	if( isset( $_can_download ) && !empty( $_can_download ) && $_can_download == '1' ) {
	    $_can_down = '1';
	} else {
	    $_can_down = '0';
	}
	
	$_insert = array(
	    'id' => NULL,
	    'companyName' => addslashes( $this->input->post('inputName') ),
	    'emailAddress' => $this->input->post( 'inputEmail' ),
	    'password' => md5( $this->input->post( 'inputPassword' ) ),
	    'userUniqueID' => $_uniqid,
	    'timeZone' => $this->input->post('inputTimezone'),
	    'timeFormat' => $this->input->post('inputDateformat'),
	    'userURL' => ( $_level == '3' ) ? $_url : '',
	    'userMaxFileSize' => ( $_level == '3' && (int)$_max_size > 0 ) ? (int)$_max_size : NULL,
	    'userAcceptTypes' => ( $_level == '3' && !empty( $_accepted_types ) ) ? addslashes( $_accepted_types ) : NULL,
	    'userMaxNumFiles' => ( $_level == '3' && (int)$_max_files > 0 ) ? (int)$_max_files : NULL,
	    'userCanUpload' => $_can_up,
	    'userCanDownload' => $_can_down,
	    'level' => $_level,
	    'userReceiveNot' => $this->input->post('inputEmailReceive'),
	    'published' => '1',
	    'date_created' => time(),
            'defaultFolderID' => $_folder
	);
	
	$_inserted = $this->db->insert( 'user', $_insert );

	if( $_inserted ) {;
	    return $_uniqid;
	} else {
	    return false;
	}
    }
    
    public function urlAvailable( $_url ) {
	if( isset( $_url ) && !empty( $_url ) ) {
	    $_where = array(
		'userURL' => $_url
	    );
	    
	    $_found = $this->db->where( $_where )->get( 'user' );
	    
	    if( $_found->num_rows() == 0 ) {
		return true;
	    }
	}
	
	return false;
    }
    
    public function changeUser() {
	$_where = array(
	    'userUniqueID' => $this->input->post( 'user' )
	);
	
	$_level = $this->input->post('inputLevel');
	$_url = $this->input->post('inputURL');
	$_password = $this->input->post('inputPassword');
        $_folder = $this->input->post('inputFolder');
        if( !isset( $_folder ) || empty( $_folder ) || $_folder == '0' ) $_folder = NULL;
	
	$_max_size = $this->input->post( 'inputMaxSize' );
	$_max_files = $this->input->post( 'inputMaxFiles' );
	$_accepted_types = $this->input->post( 'inputAcceptTypes' );	
	$_can_upload = $this->input->post( 'inputCanUpload' );
	if( isset( $_can_upload ) && !empty( $_can_upload ) && $_can_upload == '1' ) {
	    $_can_up = '1';
	} else {
	    $_can_up = '0';
	}
	
	$_can_download = $this->input->post( 'inputCanDownload' );
	if( isset( $_can_download ) && !empty( $_can_download ) && $_can_download == '1' ) {
	    $_can_down = '1';
	} else {
	    $_can_down = '0';
	}	
	
	$_update = array(
	    'companyName' => addslashes( $this->input->post('inputName') ),
	    'emailAddress' => $this->input->post( 'inputEmail' ),
	    'timeZone' => $this->input->post('inputTimezone'),
	    'timeFormat' => $this->input->post('inputDateformat'),
	    'userURL' => ( $_level == '3' ) ? $_url : '',
	    'userMaxFileSize' => ( $_level == '3' && (int)$_max_size > 0 ) ? (int)$_max_size : NULL,
	    'userAcceptTypes' => ( $_level == '3' && !empty( $_accepted_types ) ) ? addslashes( $_accepted_types ) : NULL,
	    'userMaxNumFiles' => ( $_level == '3' && (int)$_max_files > 0 ) ? (int)$_max_files : NULL,
	    'userCanUpload' => $_can_up,
	    'userCanDownload' => $_can_down,
	    'level' => $_level,
	    'userReceiveNot' => $this->input->post('inputEmailReceive'),
            'defaultFolderID' => $_folder
	);
	
	if( isset( $_password ) && !empty( $_password ) ) $_update['password'] = md5( $_password );
 
	
	$_return = $this->db->where( $_where )->update( 'user', $_update );
		    	
	return $_return;
    }  
    
    public function changeUserFront() {
	$_where = array(
	    'userUniqueID' => $this->input->post( 'user' )
	);
	
	$_password = $this->input->post('inputPassword');
	
	$_update = array(
	    'companyName' => addslashes( $this->input->post('inputName') ),
	    'emailAddress' => $this->input->post( 'inputEmail' ),
	    'timeZone' => $this->input->post('inputTimezone'),
	    'timeFormat' => $this->input->post('inputDateformat')
	);
	
	if( isset( $_password ) && !empty( $_password ) ) $_update['password'] = md5( $_password );
 
	
	$_return = $this->db->where( $_where )->update( 'user', $_update );
		    	
	return $_return;
    }  
    
    public function emailUnique( $email, $user ) {
	if( isset( $email ) && !empty( $email ) && isset( $user ) && !empty( $user ) ) {
	    //SELECT * FROM `cloud_user` WHERE emailAddress = 'codeworxx@gmail.com' AND userUniqueID != 'usr_512cce52239ba8.49166650';
	    $_where = array(
		'emailAddress' => $email,
		'userUniqueID !=' => $user
	    );
	    
	    $_found = $this->db->where( $_where )->get( 'user' );
	    
	    if( $_found->num_rows() == 0 ) {
		return true;
	    }
	}
	
	return false;
    }
    
    
    public function updateUser( $_userID = NULL, $_update = array() ) {
	if( !empty( $_userID ) && is_array( $_update ) ) {
	    
	    $_where = array(
		'userUniqueID' => $_userID
	    );


	    $_return = $this->db->where( $_where )->update( 'user', $_update );

	    return $_return;
	}
	
	return false;
    }  
    
    public function deleteUser( $_user ) {
	$_where = array(
	    'userUniqueID' => $_user
	);
	
	$_deleted = $this->db->where( $_where )->delete( 'user' );
	
	return $_deleted;
    }
    
    public function setPublishedUser( $_set, $_unique ) {
        $_where = array(
	    'userUniqueID' => $_unique
	);

	$_update = array(
	    'published' => $_set  
	);
	
	$_updated = $this->db->where( $_where )->update( 'user', $_update );

	return $_updated;
	
    }
    
    public function emailExists( $_email = NULL ) {
	if( isset( $_email ) && !empty( $_email ) ) {
	    $_where = array(
		'emailAddress' => $_email
	    );
	    
	    $_found = $this->db->where( $_where )->get( 'user' );
	    
	    if( $_found->num_rows() != 0 ) {
		return true;
	    }
	}
	
	return false;
    }

}