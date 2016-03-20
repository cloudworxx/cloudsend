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

class mDashboard extends CWX_Model {
    
    public function latestFiles() {
	$_query = 'SELECT * 
		    FROM {TRANS}files
		    WHERE ( fileByCustomer = "1" OR uploadRequest IS NOT NULL )
		    ORDER BY id DESC 
		    LIMIT 5';

	$_found = $this->db->query( $_query );

	if( $_found->num_rows() != 0 ) {
	    return $_found->result();
	}
	
	return false;
    }
    
    public function regUsers( $bar = false ) {
        $_query = 'SELECT COUNT(*) AS total FROM {TRANS}user';
        if( $bar ) $_query .= ' GROUP BY date_created ORDER BY date_created ASC LIMIT 10';
        
        $_found = $this->db->query( $_query );
        
        if( $_found->num_rows() != 0 ) {
            
            if( $bar == false ) {
                return $_found->row();
            } else {
                $_return = array();
                foreach( $_found->result_array() AS $k => $v ) {
                    $_return[] = $v['total'];
                }
                return $_return;
            }
        }
        
        return false;
    }
    
    public function regTotalFiles( $bar = false ) {
        $_query = 'SELECT COUNT(*) AS total FROM {TRANS}files';
        if( $bar ) $_query .= ' GROUP BY fileTime ORDER BY fileTime ASC LIMIT 10';
        
        $_found = $this->db->query( $_query );
        
        if( $_found->num_rows() != 0 ) {
            
            if( $bar == false ) {
                return $_found->row();
            } else {
                $_return = array();
                foreach( $_found->result_array() AS $k => $v ) {
                    $_return[] = $v['total'];
                }
                return $_return;
            }
        }
        
        return false;
    }    
    
    public function regTotalFileSize( $bar = false ) {
        $_query = 'SELECT SUM(fileSize) AS total FROM {TRANS}files';
        if( $bar ) $_query .= ' GROUP BY fileTime ORDER BY fileTime ASC LIMIT 10';
        
        $_found = $this->db->query( $_query );
        
        if( $_found->num_rows() != 0 ) {
            
            if( $bar == false ) {
                return $_found->row();
            } else {
                $_return = array();
                foreach( $_found->result_array() AS $k => $v ) {
                    $_return[] = $v['total'];
                }
                return $_return;
            }
        }
        
        return false;
    }
    
    public function downTotalFileSize( $bar = false ) {
        $_query = 'SELECT SUM(logSize) AS total FROM {TRANS}logs WHERE logType = "down"';
        if( $bar ) $_query .= ' GROUP BY logTime ORDER BY logTime ASC LIMIT 10';
        
        $_found = $this->db->query( $_query );
        
        if( $_found->num_rows() != 0 ) {
            
            if( $bar == false ) {
                return $_found->row();
            } else {
                $_return = array();
                foreach( $_found->result_array() AS $k => $v ) {
                    $_return[] = $v['total'];
                }
                return $_return;
            }
        }
        
        return false;
    }
}