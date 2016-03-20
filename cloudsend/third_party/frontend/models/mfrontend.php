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

class mFrontend extends CWX_Model {
    
    public function getDetailsbyURL( $_entry = NULL ) {
	if( $_entry != NULL && !empty( $_entry ) ) {
	    
	    $_query = 'SELECT * 
			FROM {TRANS}user 
			WHERE userURL = "'.$_entry.'" 
			AND level = "3" 
			AND published = "1" 
			AND (
			    expire = 0 OR expire >= '.time().'
			)';
	    
	    $_found = $this->db->query( $_query );
	    
	    if( $_found->num_rows() == 1 ) {
		return $_found->row();
	    } else {
		return false;
	    }
	} else {
	    return false;
	}
    }

    public function verifyPassword() {
	
	$_query = 'SELECT * 
		    FROM {TRANS}user 
		    WHERE userUniqueID = "'.$this->input->post('userID').'" 
		    AND level = "3" 
		    AND published = "1" 
		    AND password = "'.md5( $this->input->post('inputPassword') ).'" 
		    AND (
			expire = 0 OR expire >= '.time().'
		    )';
	
	$_found = $this->db->query( $_query );
	
	if( $_found->num_rows() == 1 ) {
	    return true;
	}
	
	return false;
    }
    
    public function userDetails( $_user = NULL ) {
	if( isset( $_user ) && !empty( $_user ) ) {
	    $_query = 'SELECT * 
			FROM {TRANS}user 
			WHERE userUniqueID = "'.$this->input->post('userID').'" 
			AND level = "3" 
			AND published = "1" 
			AND (
			    expire = 0 OR expire >= '.time().'
			)';

	    $_found = $this->db->query( $_query );

	    if( $_found->num_rows() == 1 ) {
		return $_found->row();
	    }	    
	}
	
	return false;
    }
    
    public function listFiles( $_type = 'public' ) {
	if( !empty( $_type ) ) {
	    $_user = $this->session->userdata('userid');
	    
	    if( $_type == 'public' ) {
		$_query = 'SELECT * FROM {TRANS}files
			    WHERE filePublic = "1"';
	    } else if( $_type == 'user' ) {
		$_query = 'SELECT f2u.*, f.*  
			    FROM {TRANS}file2user f2u 
			    LEFT JOIN {TRANS}files f 
			    ON f2u.fileUniqueID = f.fileUniqueID 
			    WHERE f2u.userUniqueID = "'.$_user.'"';
	    } else if( $_type == 'myuploads' ) {
		$_query = 'SELECT * FROM {TRANS}files 
			    WHERE fileUploadBy = "'.$_user.'" 
			    AND fileByCustomer = "1"';
	    }
	    
	    $_found = $this->db->query( $_query );
	    
	    if( $_found->num_rows() != 0 ) {
		return $_found->result();
	    }
	    
	}
	
	return false;
    }
    
    public function fileIsPublic( $_fileid = NULL ) {
	if( !empty( $_fileid ) ) {
	    $_query = 'SELECT *  
			FROM {TRANS}files
			WHERE fileUniqueID = "'.$_fileid.'" AND filePublic = "1"';
	    
	    $_found = $this->db->query( $_query );
	    
	    if( $_found->num_rows() != 0 ) {
		return true;
	    }
	}
	
	return false;
    }
    
    public function fileForUser( $_userid = NULL, $_fileid = NULL ) {
	if( !empty( $_userid ) && !empty( $_fileid ) ) {
	    $_query = 'SELECT * 
			FROM {TRANS}file2user 
			WHERE userUniqueID = "'.$_userid.'" AND fileUniqueID = "'.$_fileid.'"';
	    
	    $_found = $this->db->query( $_query );

	    if( $_found->num_rows() != 0 ) {
		return true;
	    }
	}
	
	return false;
    }
    
    public function fileDetails( $_file = NULL ) {
	if( $_file != NULL && !empty( $_file ) ) {
	    
	    $_where = array(
		'fileUniqueID' => $_file
	    );
	    
	    $_found = $this->db->where( $_where )->get( 'files' );
	    
	    if( $_found->num_rows() == 1 ) {
		return $_found->row();
	    }
	    
	} else {
	    return false;
	}
	
    }

    public function updateFileCount( $_file = NULL ) {
	
	if( isset( $_file ) && !empty( $_file ) ) {
	    
	    $_query = 'UPDATE {TRANS}files   
			SET fileCounter = fileCounter+1 
			WHERE fileUniqueID = "'.$_file.'"';
	    
	    $_updated = $this->db->query( $_query );
	    
	    return $_updated;
	    
	}
	
	return false;
    }
    
}