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

class mUploads extends CWX_Model {
    
    public function latestImportID() {
	$_query = 'SELECT DISTINCT fileImportID 
		    FROM {TRANS}files 
		    ORDER BY fileImportID DESC 
		    LIMIT 1';
	
	$_found = $this->db->query( $_query );
	
	if( $_found->num_rows() == 1 ) {
	    return $_found->row();
	}
	
	return false;
    }
    
    public function latestFiles( $latestID = NULL ) {
	
	if( isset( $latestID ) && !empty( $latestID) && $latestID != false ) {
	    $_where['fileImportID'] = $latestID;
	    
	    $_found = $this->db->where( $_where )->order_by( 'fileName', 'ASC' )->get( 'files' );
	    
	    if( $_found->num_rows() != 0 ) {
		return $_found->result();
	    }
	}
	
	return false;
    }
    
    public function getImports() {
	
	$_query = 'SELECT DISTINCT( f.fileImportID ) AS fileID, f.fileTime, f.fileUploadBy, f.uploadRequest, u.companyName, u.userUniqueID  
		    FROM {TRANS}files f 
		    LEFT JOIN {TRANS}user u 
		    ON f.fileUploadBy = u.userUniqueID 
		    GROUP BY f.fileImportID 
		    ORDER BY fileTime DESC';
	
	$_found = $this->db->query( $_query );
	
	if( $_found->num_rows() != 0 ) {
	    return $_found->result();
	}
	
	return false;
    } 
}