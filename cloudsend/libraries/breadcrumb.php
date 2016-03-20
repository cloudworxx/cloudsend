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

class breadcrumb {

	private $_divider 		= ' &nbsp;&#8250;&nbsp; ';
	private $_breadcrumbs	= '';
	
	public function __construct() {		
		log_message('debug', "Breadcrumb Class Initialized");
	}

	function output( $parent = NULL ) {
		if( $parent != false ) $parent = $parent->folderUniqueID;
		$this->_generate( $parent );

		return '<ul class="breadcrumb"><li><a href="#" class="changefolder" data-folder-id="root">'.__('folder_lbl_root').'</a> <span class="divider">'.$this->_divider.'</span></li>'.$this->_breadcrumbs.'</ul>';
	}

	private function _generate( $parent = NULL ) {
		if( isset( $parent ) AND !empty( $parent ) AND $parent != false ) {
			$_entry = $this->_getDBEntries( $parent );

			$this->_breadcrumbs = '<li><a href="#" class="changefolder" data-folder-id="'.$_entry->folderUniqueID.'">'.$_entry->folderTitle.'</a> <span class="divider">'.$this->_divider.'</span></li>'.$this->_breadcrumbs;

			if( isset( $_entry->folderParent ) AND !empty( $_entry->folderParent ) ) {
				$this->_generate( $_entry->folderParent );
			}
		}
	}

    private function _getDBEntries( $parent = NULL ) {
		$CI =& get_instance();
		
		if( isset( $parent ) AND !empty( $parent ) ) {
			$_query = "SELECT * FROM {TRANS}folders WHERE folderUniqueID = '{$parent}'";

			$_found = $CI->db->query( $_query );

			if( $_found->num_rows() == 1 ) {
			    return $_found->row();
			} else {
			    return false;
			}

		} 

		return false;
    }
}
// END Breadcrumb Class
