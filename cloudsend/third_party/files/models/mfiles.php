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

class mFiles extends CWX_Model {
    
    public function getFiles( $_file = NULL, $_selected = false ) {	
	$_setfile = false;
	
	if( $_selected != false ) {
	    $_query = 'SELECT * FROM {TRANS}files2cats f2c 
			LEFT JOIN {TRANS}files f 
			ON f2c.fileUniqueID = f.fileUniqueID 
			WHERE f2c.categoryUniqueID = "'.$_selected.'"';
	    
	    $_found = $this->db->query( $_query );	    
	} else {	    
	    if( isset( $_file ) && !empty( $_file ) && $_file != NULL ) {
		$_setfile = true;

		$_where = array(
		    'fileUniqueID' => $_file
		);

		$this->db->where( $_where );
	    }
	    $_found = $this->db->get( 'files' );	    
	}
	
	if( $_setfile ) {
	    if( $_found->num_rows() == 1 ) {
		return $_found->row();
	    }
	} else {
	    if( $_found->num_rows() != 0 ) {
		return $_found->result();
	    }
	}
	
	return false;
    }
    
    public function getMultipleFiles( $_files = array() ) {
	if( isset( $_files ) && !empty( $_files ) && count( $_files ) != 0 ) {
	    $_inFiles = '"'.implode('","', $_files ).'"';
	    
	    $_query = 'SELECT * 
			FROM {TRANS}files 
			WHERE fileUniqueID IN ('.$_inFiles.')';
	    
	    $_found = $this->db->query( $_query );
	    
	    if( $_found->num_rows() != 0 ) {
		return $_found->result();
	    }
	}
	
	return false;
    }
    
    public function getFileByNewName( $_fileName = NULL ) {
	if( isset( $_fileName ) && !empty( $_fileName ) ) {
	    $_where = array(
		'fileNewName' => $_fileName
	    );
	    
	    $_found = $this->db->where( $_where )->get( 'files' );
	    
	    if( $_found->num_rows() == 1 ) {
		return $_found->row();
	    }
	}
	
	return false;
    }
    
    public function renameFile( $_file = NULL, $_new = NULL ) {
	if( isset( $_file ) && !empty( $_file ) && isset( $_new ) && !empty( $_new ) ) {
	    $_where = array(
		'fileUniqueID' => $_file
	    );
	    
	    $_update = array(
		'fileName' => $_new
	    );
	    
	    $_updated = $this->db->where( $_where )->update( 'files', $_update );
	    
	    return $_updated;
	}
	
	return false;
    }
    
    public function updateFile( $_file = NULL, $_set = array() ) {
	if( isset( $_file ) && !empty( $_file ) && $_file != NULL && is_array( $_set ) && count( $_set ) != 0 ) {
	    $_where = array(
		'fileUniqueID' => $_file
	    );
	    
	    $_update = $this->db->where( $_where )->update( 'files', $_set );
	    
	    return $_update;
	}
	
	return false;
    }
       
    
    public function file2user( $_file = NULL, $_user = NULL ) {
	if( !empty( $_file ) && !empty( $_user ) ) {
	    $_where = array(
		'userUniqueID' => $_user,
		'fileUniqueID' => $_file
	    );
	    
	    $_exists = $this->db->where( $_where )->get( 'file2user' );
	    
	    if( $_exists->num_rows() == 0 ) {
		$_insert = array(
		    'id' => NULL,
		    'f2uUniqueID' => uniqid( 'f2u_',true ),
		    'userUniqueID' => $_user,
		    'fileUniqueID' => $_file		    
		);
		
		$_inserted = $this->db->insert( 'file2user', $_insert );
		
		return $_inserted;
	    }
	}
	
	return false;
    }
    
    public function getUser4File( $_file = NULL ) {
        if( !empty( $_file ) && !empty( $_file ) ) {
	    
	    $_query = 'SELECT * 
			FROM {TRANS}file2user f2u 
			LEFT JOIN {TRANS}user u 
			ON f2u.userUniqueID = u.userUniqueID 
			WHERE f2u.fileUniqueID = "'.$_file.'" 
			GROUP BY f2u.userUniqueID';
	    
            $_found = $this->db->query( $_query );
	    
            if( $_found->num_rows() != 0 ) {
                return $_found->result();
            }
        }
        
        return false;
    }
    
    public function getPublic4File( $_file = NULL ) {
        if( !empty( $_file ) && !empty( $_file ) ) {
	    
	    $_query = 'SELECT * 
			FROM {TRANS}public2file p2f 
			LEFT JOIN {TRANS}publics p 
			ON p2f.publicUniqueID = p.publicUniqueID 
			WHERE p2f.fileUniqueID = "'.$_file.'"';
	    
            $_found = $this->db->query( $_query );
	    
            if( $_found->num_rows() != 0 ) {
                return $_found->result();
            }
        }
        
        return false;
    }
    
    public function getUserFiles( $_user = NULL ) {
	if( !empty( $_user ) ) {
	    
	    $_query = 'SELECT * 
			FROM {TRANS}file2user f2u 
			LEFT JOIN {TRANS}files f 
			ON f2u.fileUniqueID = f.fileUniqueID 
			WHERE f2u.userUniqueID = "'.$_user.'"';

	    $_found = $this->db->query( $_query );
	    	    
	    if( $_found->num_rows() != 0 ) {
		return $_found->result();
	    }
	    
	}
	
	return false;
    } 
    
    public function deleteFile( $_file = NULL ) {
	if( !empty( $_file ) ) {
	    $_where = array(
		'fileUniqueID' => $_file
	    );
	    
	    $_deleteFile = $this->db->where( $_where )->delete( 'files' );
	    
	    if( $_deleteFile ) {
		$_deleteF2U = $this->db->where( $_where )->delete( 'file2user' );
		
		if( $_deleteF2U ) {
		    $_deleteF2P = $this->db->where( $_where )->delete( 'public2file' );
                    
                    if( $_deleteF2P ) { // added 1.3.3
                        $_deleteF2C = $this->db->where( $_where )->delete( 'files2cats' );

                        return $_deleteF2C;
                    }
		}
	    }
	}
	
	return false;
    }
    
    public function createPublic( $_insert = array(), $_table = 'publics' ) {
	
	if( isset( $_insert ) && count( $_insert ) != 0 ) {
	    
	    $_inserted = $this->db->insert( $_table, $_insert );
	    
	    return $_inserted;
	    
	}
	
	return false;
    }
    
    public function getFile2UserDetails( $_file = NULL ) {
	if( !empty( $_file ) ) {
	    $_where = array(
		'f2uUniqueID' => $_file
	    );
	    
	    $_found = $this->db->where( $_where )->get( 'file2user' );

	    if( $_found->num_rows() == 1 ) {
		return $_found->row();
	    }
	}
	
	return false;
    }
    
    public function deleteFile2User( $_file = NULL ) {
	if( !empty( $_file ) ) {
	    $_where = array(
		'f2uUniqueID' => $_file
	    );
	    
	    $_deleteFile = $this->db->where( $_where )->delete( 'file2user' );
	    
	    return $_deleteFile;
	}
	
	return false;
    }
    
    public function updateDescription( $_file = NULL, $_description = NULL ) {
	if( !empty( $_file ) ) {
	    $_where = array(
		'fileUniqueID' => $_file
	    );
	    
	    $_update = array(
		'fileDescription' => ( !empty( $_description ) ) ? addslashes( $_description ) : ''
	    );
	    
	    $_updated = $this->db->where( $_where )->update( 'files', $_update );
	    
	    return $_updated;
	}
	
	return false;
    }
    
    public function updateTags( $_file = NULL, $_tags = NULL ) {
	if( !empty( $_file ) ) {
	    $_where = array(
		'fileUniqueID' => $_file
	    );
	    
	    $_update = array(
		'fileTags' => addslashes( $_tags )
	    );
	    
	    $_update = $this->db->where( $_where )->update( 'files', $_update );
	    
	    return $_update;
	}
    }    
    
}