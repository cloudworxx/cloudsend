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

class Categories extends CWX_Controller {
    
    public function index() {
	redirect( 'admin/categories/all_categories' );
    }
    
    public function all_categories() {	
	$errortype = isset($_GET['errortype']) ? $_GET['errortype'] : false;
	$errormsg = isset($_GET['errormsg']) ? urldecode( $_GET['errormsg'] ) : '';
				
	$_data = array(
	    'errortype' => $errortype,
	    'errormsg' => $errormsg,
	    'site' => 'categories/all_entries',
	    'title' => __('cats_title_categories'),
	    'categories' => $this->mCategories->getCategories()
	);
    
	$this->load->view( 'master', $_data );	
	
    }
    
    public function add_category(  $_errortype = false, $_errormsg = false ) {
	$_data = array(
	    'errortype' => $_errortype,
	    'errormsg' => $_errormsg,
	    'site' => 'categories/add_entry',
	    'title' => __('cats_title_addcategory')
	);

	$this->load->view( 'master', $_data );
    }
    
    public function verify_category() {
	$this->load->library( 'form_validation' );
	
	$config = array(
	    array( 'field' => 'inputCategory',	    'label' => 'Title',	    'rules' => 'trim|required|alpha_numeric|min_length[3]' ),
	);
		
	$this->form_validation->set_rules( $config );
	
	if( $this->form_validation->run( $this ) == false ) {
	    $errortype = 'error';
	    $errormsg = validation_errors( ' ','<br />' );
	    $this->add_category( $errortype, $errormsg );
	} else {
	    $_updated = $this->mCategories->addCategory();
	    
	    if( $_updated != false ) {
		$_errormsg = __('cats_msg_catsuccessadded');
		redirect( 'admin/categories/all_categories?errortype=success&errormsg='.urlencode( $_errormsg ) );
	    } else {
		$errortype = 'error';
		$errormsg = __('cats_msg_erroradding');
		$this->add_category( $errortype, $errormsg );				
	    }
	}
    }
    
    public function edit_category( $_errortype = false, $_errormsg = false, $_category = false ) {
	
	if( !isset( $_category ) OR $_category == false ) {
	    $_category = $this->input->get('category');
	}
	
	if( isset( $_category ) && !empty( $_category ) && preg_match( "/^(fld_)[a-z0-9]{14}.[a-z0-9]{8}/", $_category ) ) {
	
	    $_details = $this->mCategories->categoryDetails( $_category );
	    
	    if( $_details != false ) {
		
		$_data = array(
		    'errortype' => $_errortype,
		    'errormsg' => $_errormsg,
		    'site' => 'categories/edit_entry',
		    'title' => __('cats_title_editcategory'),
		    'category' => $_details
		);

		$this->load->view( 'master', $_data );
		
	    } else {
		
		$_errormsg = __('cats_msg_catnotfound');
		redirect( 'admin/categories/all_categories?errortype=error&errormsg='.urlencode( $_errormsg ) );
		
	    }
	    
	} else {
	    
	    $_errormsg = __('cats_msg_parametererror');
	    redirect( 'admin/categories/all_categories?errortype=error&errormsg='.urlencode( $_errormsg ) );
	    
	}
    }
    
    public function change_category() {
	$this->load->library( 'form_validation' );
	
	$_category = $this->input->post( 'category' );
	
	$config = array(
	    array( 'field' => 'inputCategory',	    'label' => 'Title',	    'rules' => 'trim|required|alpha_numeric|min_length[3]' ),
	);
		
	$this->form_validation->set_rules( $config );
	
	if( $this->form_validation->run( $this ) == false ) {
	    $errortype = 'error';
	    $errormsg = validation_errors( ' ','<br />' );
	    $this->edit_category( $errortype, $errormsg, $_category );
	} else {
	    $_updated = $this->mCategories->changeCateogry();
	    
	    if( $_updated != false ) {
		$_errormsg = __('cats_msg_catsuccessupdated');
		redirect( 'admin/categories/all_categories?errortype=success&errormsg='.urlencode( $_errormsg ) );
	    } else {
		$errortype = 'error';
		$errormsg = __('cats_msg_errorupdating');
		$this->edit_category( $errortype, $errormsg, $_category );				
	    }
	}
    }   
    
    public function remove_category() {
	if( $this->input->is_ajax_request() ) {
	    $_category = $this->input->post('category');
	    $_delFiles = $this->input->post('files');

	    if( isset( $_category ) && !empty( $_category ) && preg_match( "/^(fld_)[a-z0-9]{14}.[a-z0-9]{8}/", $_category ) ) {
		$_result = array();
		
		if( $_delFiles ) {
		    $_files = $this->mCategories->getFilesFromCategory( $_category );

		    if( $_files != false ) {
			$this->load->model( array( 'files/mFiles' ) );
			
			foreach( $_files AS $_file ) {
			    $_fileDetails = $this->mFiles->getFiles( $_file->fileUniqueID );
			    
			    if( $_fileDetails != false ) {
				$_deleteFile = $this->mFiles->deleteFile( $_file->fileUniqueID );

				if( $_deleteFile ) {
				    $_fileName = pathinfo( $_fileDetails->fileNewName, PATHINFO_FILENAME);

				    $_possibleFiles = array(
					FCPATH.'data'.DS.'files'.DS.$_fileDetails->fileNewName,
					FCPATH.'data'.DS.'thumbs'.DS.$_fileName.'.jpg',
					FCPATH.'data'.DS.'files'.DS.$_fileName.'_32x32.jpg'
				    );

				    for( $i = 0; $i < count( $_possibleFiles ); $i++ ) {
					if( file_exists( $_possibleFiles[$i] ) ) {
					    unlink( $_possibleFiles[$i] );
					}
				    }
				}
			    }
			}
		    } 
		} 
		
		$_removeCategory = $this->mCategories->removeCategory( $_category );

		if( $_removeCategory ) {
		    $_result = array(
			'type' => 'success',
			'message' => __('cats_msg_catsuccessremove')
		    );
		} else {
		    $_result = array(
			'type' => 'error',
			'message' => __('cats_msg_errorremoving')
		    );
		}
	    } else {
		$_result = array(
		    'type' => 'error',
		    'message' => __('cats_msg_parametererror')
		);
	    }
	} else {
	    $_result = array(
		'type' => 'error',
		'message' => __('cats_msg_noajaxrequest')
	    );
	}
	
	$this->output
		->set_content_type( 'application/json' )
		->set_output( json_encode( $_result ) );	
    }
    
    public function file2cat() {
	if( $this->input->is_ajax_request() ) {
	    $_file = $this->input->post('file');
	    $_cat = $this->input->post('cat');
	    
	    if( isset( $_file ) && !empty( $_file ) && preg_match( "/^(file_)[a-z0-9]{14}.[a-z0-9]{8}/", $_file ) && isset( $_cat ) && !empty( $_cat ) && preg_match( "/^(fld_)[a-z0-9]{14}.[a-z0-9]{8}/", $_cat ) ) {
		$_exists = $this->mCategories->file2cat_exists( $_file, $_cat );
		
		if( !$_exists ) {
		    $_added = $this->mCategories->add_file2cat( $_file, $_cat );
		    
		    if( $_added ) {
			$_return = array(
			    'type' => 'success',
			    'message' => __('cats_msg_filesuccessadded')
			);
		    } else {
			$_return = array(
			    'type' => 'error',
			    'message' => __('cats_msg_dberror')
			);			
		    }
		} else {
		    $_return = array(
			'type' => 'info',
			'message' => __('cats_msg_fileincategory')
		    );
		}
		
	    } else {
		$_return = array(
		    'type' => 'error',
		    'message' => __('cats_msg_parametererror')
		);
	    }
	} else {
	    $_return = array(
		'type' => 'error',
		'message' => __('cats_msg_noajaxrequest')
	    );
	}
	
	$this->output
	    ->set_content_type( 'application/json' )
	    ->set_output( json_encode( $_return ) );    	
    }
    
    public function filedelcat() {
	if( $this->input->is_ajax_request() ) {
	    $_file = $this->input->post('file');
	    $_cat = $this->input->post('cat');
	    
	    if( isset( $_file ) && !empty( $_file ) && preg_match( "/^(file_)[a-z0-9]{14}.[a-z0-9]{8}/", $_file ) && isset( $_cat ) && !empty( $_cat ) && preg_match( "/^(fld_)[a-z0-9]{14}.[a-z0-9]{8}/", $_cat ) ) {
		$_exists = $this->mCategories->file2cat_exists( $_file, $_cat );
		
		if( $_exists ) {
		    $_removed = $this->mCategories->remove_file2cat( $_file, $_cat );
		    
		    if( $_removed ) {
			$_return = array(
			    'type' => 'success',
			    'message' => __('cats_msg_filesuccessrem')
			);
		    } else {
			$_return = array(
			    'type' => 'error',
			    'message' => __('cats_msg_dberror')
			);			
		    }
		} else {
		    $_return = array(
			'type' => 'info',
			'message' => __('cats_msg_filenotincategory')
		    );
		}
		
	    } else {
		$_return = array(
		    'type' => 'error',
		    'message' => __('cats_msg_parametererror')
		);
	    }
	} else {
	    $_return = array(
		'type' => 'error',
		'message' => __('cats_msg_noajaxrequest')
	    );
	}
	
	$this->output
	    ->set_content_type( 'application/json' )
	    ->set_output( json_encode( $_return ) );    	
    }    
    
}