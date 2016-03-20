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

class mFolder extends CWX_Model {
    
    public function getFilesByFolder( $_folder = NULL ) {
    	if( isset( $_folder ) && !empty( $_folder ) ) {
            $this->db->where( array( 'folderUniqueID' => $_folder ) );
        } else {
            $this->db->where( 'folderUniqueID IS NULL' );
        }
        $_found = $this->db->order_by( 'fileName ASC' )->get( 'files' );

        if( $_found->num_rows() != 0 ) {
            return $_found->result();
        }

        return false;
    }
    
    public function getFolder( $_folder = NULL ) {
    	$_where = array(
            'folderParent' => $_folder
    	);
        $_found = $this->db->where( $_where )->order_by( 'folderTitle ASC' )->get( 'folders' );

        if( $_found->num_rows() != 0 ) {
            return $_found->result();
        }

        return false;
    }

    public function getThisFolder( $_folder = NULL ) {
    	$_where = array(
            'folderUniqueID' => $_folder
    	);
        $_found = $this->db->where( $_where )->get( 'folders' );

        if( $_found->num_rows() == 1 ) {
            return $_found->row();
        }

        return false;
    }    

    public function countFilesInFolder( $_folder = NULL ) {
    	if( isset( $_folder ) && !empty( $_folder ) ) {
            $_where = array(
                'folderUniqueID' => $_folder
            );

            return $this->db->where( $_where )->count_all_results( 'files' );
    	}

    	return 0;
    }

    public function changeFolderOfFile( $_file = NULL, $_folder = NULL ) {
        if( isset( $_file ) && !empty( $_file ) && isset( $_folder ) ) {

            if( is_null( $_folder ) OR $_folder == '0' ) $_folder = NULL;

            $_where = array(
                'fileUniqueID' => $_file
            );

            $_update = array(
                'folderUniqueID' => $_folder
            );

            $_updated = $this->db->where( $_where )->update( 'files', $_update );
            
            return $_updated;
        }

        return false;
    }

    public function addFolder() {
        $_parentID = $this->input->post('inputParent');
        $_folderTitle = $this->input->post('inputTitle');

        if( isset( $_parentID ) OR empty( $_parentID ) ) {
            $_parentID = NULL;
        }

        $_insert = array(
            'id' => NULL,
            'folderUniqueID' => uniqid( 'fold_',true ),
            'folderTitle' => addslashes( $_folderTitle ),
            'folderParent' => $_parentID,
            'folderTime' => time()
        );

        $_inserted = $this->db->insert( 'folders', $_insert );

        return $_inserted;
    }
    
    public function renameFolder( $_folder = NULL, $_new = NULL ) {
	if( isset( $_folder ) && !empty( $_folder ) && isset( $_new ) && !empty( $_new ) ) {
	    $_where = array(
		'folderUniqueID' => $_folder
	    );
	    
	    $_update = array(
		'folderTitle' => $_new
	    );
	    
	    $_updated = $this->db->where( $_where )->update( 'folders', $_update );
	    
	    return $_updated;
	}
	
	return false;
    }
    
    public function deleteFolder( $_folder = NULL ) {
	if( !empty( $_folder ) ) {
	    $_where = array(
		'folderUniqueID' => $_folder
	    );
	    
	    $_deleteFolder = $this->db->where( $_where )->delete( 'folders' );
            
            if( $_deleteFolder ) {
                $_whereStd = array( 'defaultFolderID' => $_folder );
                $_updateStd = array( 'defaultFolderID' => NULL );
                
                $this->db->where( $_whereStd )->update( 'user', $_updateStd );
                $this->db->where( $_whereStd )->update( 'uploads', $_updateStd );
            }

            return $_deleteFolder;
	}
	
	return false;
    }

}