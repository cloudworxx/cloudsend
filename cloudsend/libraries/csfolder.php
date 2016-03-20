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
 
class csFolder {
    
    var $_folder = array();

    public function __construct() {
    	log_message('debug', "Folder View Class Initialized");
    }
      
    public function getSelect( $parent = 0, $level = 1, $active = NULL, $id = 'inputParent', $class = '', $size = '10' ) {		
        return csFolder::_generateLIST( $parent, $level, $active, $id, $class, $size );
    }  
    

    private function _generateArray( $parent = 0, $level = 1 ) {
		$_entries = csFolder::_getDBEntries( $parent );
		
		if( $_entries != false ) {
		    $_count = 0;
		    foreach( $_entries AS $row ) {
				if( $row->count > 0 ) {
				    $this->_folder[] = array(
						'folderLevel' => $level,
						'folderUniqueID' => $row->folderUniqueID,
						'folderTitle' => $row->folderTitle,
				    );		
				    csFolder::_generateArray( $row->folderUniqueID, $level + 1 );
				} else {
				    $this->_folder[] = array(
						'folderLevel' => $level,
						'folderUniqueID' => $row->folderUniqueID,
						'folderTitle' => $row->folderTitle,
				    );		
				}
		    }
		}
    }

    
    private function _generateLIST( $parent = 0, $level = 1, $active = NULL, $id = 'inputParent', $class = '', $size = '' ) {	
		$this->_generateArray( $parent, $level );
		$_select_box = '';

		if( isset( $active ) && !empty( $active ) && $active != NULL ) {
			$_selected = $active;
		} else {
			$_selected = false;
		}

                $_select_box .= '<select name="'.$id.'" id="'.$id.'"'.( ( !empty( $class ) ) ? ' class="'.$class.'"' : '' );
                if( isset( $size ) && !empty( $size ) ) $_select_box .= ' size="10"';
                $_select_box .= '>'."\n";
                $_select_box .= '<option value="0"'.( ( !$_selected ) ? ' selected="selected"' : '' ).'>'.__('folder_lbl_noparent').'</option>'."\n";
		if( count( $this->_folder ) != 0 ):
			for( $i = 0; $i < count( $this->_folder ); $i++ ):
				$_spacer = ( $this->_folder[$i]['folderLevel'] != 1 ) ? str_repeat( "&nbsp;", $this->_folder[$i]['folderLevel']*2 ) : '';
				$_select_box .= '<option value="'.$this->_folder[$i]['folderUniqueID'].'"'.( ( $_selected != false && $_selected == $this->_folder[$i]['folderUniqueID'] ) ? ' selected="selected"' : '' ).'>'.$_spacer.$this->_folder[$i]['folderTitle'].'</option>'."\n";
			endfor;
		endif;
                $_select_box .= '</select>'."\n";

		return $_select_box;
    }
   
    
    /*
     * return db entries
     */
    private function _getDBEntries( $parent = NULL ) {
		$CI =& get_instance();
		
		$_query = 'SELECT folder.folderUniqueID, folder.folderTitle, deriv1.count 
			    FROM {TRANS}folders folder  
			    LEFT OUTER JOIN (
					SELECT folderParent, COUNT(*) AS count 
					FROM {TRANS}folders 
					GROUP BY folderParent
			    ) deriv1 
			    ON folder.folderUniqueID = deriv1.folderParent ';
		if( isset( $parent ) && !empty( $parent ) ) {
			$_query .= 'WHERE folder.folderParent = "'. $parent .'" ';
		} else {
			$_query .= 'WHERE folder.folderParent IS NULL ';
		}
			$_query .= 'ORDER BY folder.folderTitle DESC';

		$_found = $CI->db->query( $_query );

		if( $_found->num_rows() != 0 ) {
		    return $_found->result();
		} else {
		    return false;
		}
    }
}