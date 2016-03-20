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

class mPubuploads extends CWX_Model {
    
    public function getUploads() {
	$this->db->select('r.*, u.companyName'); 
	$this->db->from('uploads AS r'); 
	$this->db->join('user AS u', 'r.userUniqueID = u.userUniqueID', 'left'); 
	$_found = $this->db->get();

	
	if( $_found->num_rows() != 0 ) {
	    return $_found->result();
	}
	
	return false;
    }
    
    public function getUpload( $_entry = NULL ) {
	if( $_entry != NULL && !empty( $_entry ) ) {
	    $_where = array(
		'uploadUniqueID ' => $_entry
	    );

	    $_found = $this->db->where( $_where )->get( 'uploads' );

	    if( $_found->num_rows() == 1 ) {
		return $_found->row();
	    } else {
		return false;
	    }
	} else {
	    return false;
	}
    }
    
    public function getUploadByUUID( $_entry = NULL ) {
	if( $_entry != NULL && !empty( $_entry ) ) {
	    $_where = array(
		'uploadUUID' => $_entry
	    );

	    $_found = $this->db->where( $_where )->get( 'uploads' );

	    if( $_found->num_rows() == 1 ) {
		return $_found->row();
	    } else {
		return false;
	    }
	} else {
	    return false;
	}
    }
    
    public function createUpload( $_insert = array() ) {
	if( isset( $_insert ) && is_array( $_insert ) && count( $_insert ) != 0 ) {
	    $_standards = array(
		'id' => NULL,
		'uploadUniqueID' => uniqid( 'upl_', true ),
		'userUniqueID' => $this->session->userdata('userUnique'),
		'published' => '1'
	    );
	    
	    $_insert = array_merge( $_insert, $_standards );
	    
	    $_inserted = $this->db->insert( 'uploads', $_insert );
	    
	    return $_inserted;
	} 
	
	return false;
    }

    public function editUpload( $_entry = NULL, $_description = NULL, $_folder = NULL ) {
	if( isset( $_entry ) && !empty( $_entry ) && isset( $_description ) && isset( $_folder ) ) {
	    $_where = array(
		'uploadUniqueID' => $_entry
	    );
	    
	    $_udpate = array(
		'uploadMessage' => $_description,
                'defaultFolderID' => $_folder
	    );
	    	    
	    $_updated = $this->db->where( $_where )->update( 'uploads', $_udpate );
	    
	    return $_updated;
	} 
	
	return false;
    }    
    
    public function setPublishedEntry( $_set, $_unique ) {
        $_where = array(
	    'uploadUniqueID ' => $_unique
	);

	$_update = array(
	    'published' => $_set  
	);
	
	$_updated = $this->db->where( $_where )->update( 'uploads', $_update );

	return $_updated;
	
    }
    
    public function deleteEntry( $_entry ) {
	$_where = array(
	    'uploadUniqueID' => $_entry
	);
	
	$_deleted = $this->db->where( $_where )->delete( 'uploads' );
	
	return $_deleted;
    }
    
}