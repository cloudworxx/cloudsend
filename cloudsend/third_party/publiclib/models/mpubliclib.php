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

class mPubliclib extends CWX_Model {
    
    public function getEntry( $_entry = NULL ) {
		if( $_entry != NULL && !empty( $_entry ) ) {
		    
		    $_query = 'SELECT * 
				FROM {TRANS}publics 
				WHERE publicUUID = "'.$_entry.'" 
				AND ( 
				    publicLimit IS NULL 
				    OR publicLimit = 0 
				    OR publicLimit >= '.time().' 
				) 
				AND published = "1"';
		    
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
    
    public function getEntryFiles( $_entry = NULL ) {
		if( $_entry != NULL && !empty( $_entry ) ) {
		    
		    $_query = 'SELECT df.*, f.fileName, f.fileUniqueID, f.fileDescription, f.fileNewName, f.fileSize 
				FROM {TRANS}public2file df 
				LEFT JOIN {TRANS}files f 
				ON df.fileUniqueID = f.fileUniqueID 
				WHERE df.publicUniqueID = "'.$_entry.'" 
				AND ( 
				    df.allowedCount IS NULL 
				    OR  df.downloadCount IS NULL 
				    OR  df.allowedCount = 0 
				    OR  df.downloadCount <= df.allowedCount 
				)';

		    $_found = $this->db->query( $_query );

		    if( $_found->num_rows() != 0 ) {
				return $_found->result();
		    } else {
				return false;
		    }
		} else {
		    return false;
		}
    }

    public function getEntryFilesDownload( $_entry = NULL, $_public = NULL ) {
		if( $_entry != NULL && !empty( $_entry ) && $_public != NULL && !empty( $_public ) ) {
		    
		    $_query = 'SELECT df.*, f.fileName, f.fileUniqueID, f.fileDescription, f.fileNewName, f.fileSize 
				FROM {TRANS}public2file df 
				LEFT JOIN {TRANS}files f 
				ON df.fileUniqueID = f.fileUniqueID 
				WHERE df.fileUniqueID = "'.$_entry.'" 
				AND df.publicUniqueID = "'.$_public.'" 
				AND ( 
				    df.allowedCount IS NULL 
				    OR  df.downloadCount IS NULL 
				    OR  df.allowedCount = 0 
				    OR  df.downloadCount < df.allowedCount 
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
    
    public function verifyPassword() {
		$_where = array(
		    'publicUUID' => $this->input->post('linkid'),
		    'publicPassword' => md5( $this->input->post('inputPassword') )
		);
		
		$_found = $this->db->where( $_where )->get( 'publics' );
		
		if( $_found->num_rows() == 1 ) {
		    return true;
		}
		
		return false;
    }
    
    public function updateFileCount( $_file = NULL, $_table = 'files', $_field = 'fileCounter' ) {
		if( isset( $_file ) && !empty( $_file ) ) {
		    
		    $_query = 'UPDATE {TRANS}'.$_table.'  
				SET '.$_field.' = '.$_field.'+1 
				WHERE fileUniqueID = "'.$_file.'"';
		    
		    $_updated = $this->db->query( $_query );
		    
		    return $_updated;
		    
		}
		
		return false;
    }
    
}