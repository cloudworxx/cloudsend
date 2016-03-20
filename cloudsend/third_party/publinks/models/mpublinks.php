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

class mPublinks extends CWX_Model {
    
    public function getLinks() {	
		$this->db->order_by('id','DESC');
		$_found = $this->db->get( 'publics' );
		
		if( $_found->num_rows() != 0 ) {
		    return $_found->result();
		} 
		
		return false;
    }
  
    public function getEntry( $_entry = NULL ) {
		if( $_entry != NULL && !empty( $_entry ) ) {
		    $_where = array(
			'publicUniqueID' => $_entry
		    );

		    $_found = $this->db->where( $_where )->get( 'publics' );

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
		    
		    $_query = 'SELECT df.*, f.fileName, f.fileUniqueID 
				FROM {TRANS}public2file df 
				LEFT JOIN {TRANS}files f 
				ON df.fileUniqueID = f.fileUniqueID 
				WHERE df.publicUniqueID = "'.$_entry.'"';

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
    
    public function updateEntry( $_entry = NULL, $_update = array() ) {
		if( !empty( $_entry ) && is_array( $_update ) ) {
		    
		    $_where = array(
			'publicUniqueID' => $_entry
		    );


		    $_return = $this->db->where( $_where )->update( 'publics', $_update );

		    return $_return;
		}
		
		return false;
    }  
    
    public function deleteEntry( $_entry ) {
		$_where = array(
		    'publicUniqueID' => $_entry
		);
		
		$_deleted = $this->db->where( $_where )->delete( 'publics' );
		
		if( $_deleted ) {
		    $_deleted = $this->db->where( $_where )->delete( 'public2file' );		    
		}
		
		return $_deleted;
    }
    
    public function setPublishedEntry( $_set, $_unique ) {
        $_where = array(
		    'publicUniqueID' => $_unique
		);

		$_update = array(
		    'published' => $_set  
		);
		
		$_updated = $this->db->where( $_where )->update( 'publics', $_update );

		return $_updated;
    }
    
}