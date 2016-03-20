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

class mCategories extends CWX_Model {
    
    public function getCategories( ) {
	
	$_found = $this->db->order_by( 'categoryTitle', 'ASC' )->get( 'categories' );
	
	if( $_found->num_rows() != 0 ) {
	    return $_found->result();
	}
	
	return false;
	
    }
    
    public function categoryDetails( $_cat = false ) {
	if( isset( $_cat ) && $_cat != false ) {
	    $_where = array(
		'categoryUniqueID' => $_cat
	    );
	    
	    $_found = $this->db->where( $_where )->get( 'categories' );
	    
	    if( $_found->num_rows() == 1 ) {
		return $_found->row();
	    }
	}
	
	return false;
    }
    
    public function categoryExists( $_categoryTitle = NULL ) {
	$_where = array(
	    'categoryTitle' => addslashes( $_categoryTitle )
	);
	
	$_found = $this->db->where( $_where )->get( 'categories' );
	
	if( $_found->num_rows() != 0 ) {
	    return true;
	}
	
	return false;
    }
    
    public function changeCateogry() {
	
	$_where = array(
	    'categoryUniqueID' => $this->input->post('category')
	);
	
	$_update = array(
	    'categoryTitle' => addslashes( $this->input->post( 'inputCategory' ) )
	);
	
	$_updated = $this->db->where( $_where )->update( 'categories', $_update );
	
	return $_updated;
	
    }
    
    public function addCategory() {
	
	$_exists = $this->categoryExists( $this->input->post('inputCategory') );
	
	if( $_exists ) return false;
	
	$_insert = array(
	    'categoryID' => NULL,
	    'categoryUniqueID' => uniqid( 'fld_', true ),
	    'categoryTitle' => addslashes( $this->input->post('inputCategory') )
	);
	
	$_inserted = $this->db->insert( 'categories ', $_insert );
	
	return $_inserted;
    }
    
    public function removeCategory( $_category = NULL ) {
	if( isset( $_category ) && !empty( $_category ) ) {
	    
	    $_where = array(
		'categoryUniqueID' => $_category
	    );
	    
	    $_deleted = $this->db->where( $_where )->delete( 'categories' );
	    
	    if( $_deleted ) {
		$_deleted = $this->db->where( $_where )->delete( 'files2cats' );
	    }
	    
	    return $_deleted;
	}
    }
    
    public function getFilesFromCategory( $_category = NULL ) {
	if( isset( $_category ) && !empty( $_category ) ) {
	    $_where = array(
		'categoryUniqueID' => $_category
	    );
	    
	    $_found = $this->db->where( $_where )->get( 'files2cats' );
	    
	    if ( $_found->num_rows() != 0 ) {
		return $_found->result();
	    }
	}
	
	return false;
    }
    
    public function file2cat_exists( $_file = NULL, $_category = NULL ) {
	
	if( isset( $_file ) && !empty( $_file ) && isset( $_category ) && !empty( $_category ) ) {
	    $_where = array(
		'fileUniqueID' => $_file,
		'categoryUniqueID' => $_category
	    );
	    
	    $_found = $this->db->where( $_where )->get( 'files2cats' );
	    
	    if( $_found->num_rows() != 0 ) {
		return true;
	    }
	}
	
	return false;
    }
    
    public function add_file2cat( $_file = NULL, $_category = NULL ) {
	
	if( isset( $_file ) && !empty( $_file ) && isset( $_category ) && !empty( $_category ) ) {
	    $_insert = array(
		'fileUniqueID' => $_file,
		'categoryUniqueID' => $_category
	    );
	    
	    $_inserted = $this->db->insert( 'files2cats', $_insert );
	    
	    return $_inserted;
	}
	
	return false;
    }
    
    public function remove_file2cat( $_file = NULL, $_category = NULL ) {
	
	if( isset( $_file ) && !empty( $_file ) && isset( $_category ) && !empty( $_category ) ) {
	    $_delete = array(
		'fileUniqueID' => $_file,
		'categoryUniqueID' => $_category
	    );
	    
	    $_deleted = $this->db->delete( 'files2cats', $_delete );
	    
	    return $_deleted;
	}
	
	return false;
    }
    
}