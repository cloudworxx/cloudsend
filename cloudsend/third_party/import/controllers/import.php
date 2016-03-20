<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
class Import extends CWX_Controller {
    
    public function index() {	
	$this->load->helper('directory');
	
	$errortype = isset($_GET['errortype']) ? $_GET['errortype'] : false;
	$errormsg = isset($_GET['errormsg']) ? urldecode( $_GET['errormsg'] ) : '';
		
        $_data = array(
	    'errortype' => $errortype,
	    'errormsg' => $errormsg,
	    'title' => __('import_title_import'),
	    'site' => 'import/index',
	    'files' => directory_map(FCPATH.'data'.DS.'import',1)
	);
    
	$this->load->view( 'master', $_data );	
    }
    
    public function import_files() {
	$this->load->helper(array('directory','file'));

	$_files = directory_map(FCPATH.'data'.DS.'import',1);
	$_importUnique = uniqid('imp_',true);
	$_errorFiles = array();
	
	if( count( $_files ) != 0 ) {
	    for( $i = 0; $i < count( $_files ); $i++ ) {
		$_ext = pathinfo( $_files[$i], PATHINFO_EXTENSION );
		$_ext = strtolower( $_ext );
		$_fileName = pathinfo( $_files[$i], PATHINFO_BASENAME );
		$_uniqueFile = uniqid('data_',true);

		$_source = FCPATH.'data'.DS.'import'.DS.$_files[$i];
		$_destination = FCPATH.'data'.DS.'files'.DS.$_uniqueFile.'.'.$_ext;
		$_thumbsFolder = FCPATH.'data'.DS.'thumbs'.DS;
		
		if( rename( $_source, $_destination ) ) {
		    
		    $_options = array(
			'id' => NULL,
			'fileUniqueID' => uniqid('file_',true),
			'fileName' => $_files[$i],
			'fileType' => get_mime_by_extension($_files[$i]),
			'fileSize' => filesize( $_destination ),
			'fileTime' => time(),
			'fileUploadBy' => $this->session->userdata['userUnique'],
			'fileByCustomer' => '0',
			'fileNewName' => $_uniqueFile.'.'.$_ext,
			'fileMD5' => md5_file( $_destination ),
			'fileCounter' => 0,
			'filePublic' => '0',
			'fileImportID' => $_importUnique
		    );
		    
		    $_import = $this->mImport->importFiles( $_options );
		    
		    if( $_import ) {
			$this->mGlobal->log( array( 'type' => "info", 'message' => "File {$_files[$i]} was imported successfully.", 'size' => filesize( $_destination ) ) );
			
			$this->load->library('image_lib');

			$config = array(
				'source_image' => $_destination,
				'new_image' => $_thumbsFolder.$_uniqueFile.'.jpg',
				'maintain_ratio' => true,
				'width' => $this->mGlobal->getConfig('THUMB_X')->configVal,
				'height' => $this->mGlobal->getConfig('THUMB_Y')->configVal
			);

			$this->image_lib->initialize( $config );
			$this->image_lib->resize();		
			$this->image_lib->clear();

			$config32 = array(
				'source_image' => $_destination,
				'new_image' => $_thumbsFolder.$_uniqueFile.'_32x32.jpg',
				'maintain_ratio' => true,
				'width' => '32',
				'height' => '32'
			);

			$this->image_lib->initialize( $config32 );
			$this->image_lib->resize();		
			$this->image_lib->clear();
			
		    } else {
			$this->mGlobal->log( array( 'type' => "error", 'message' => "File {$_files[$i]} could not be added to database.", 'size' => filesize( $_destination ) ) );
			$_errorFiles[] = $_files[$i];
		    }
		} else {
		    $this->mGlobal->log( array( 'type' => "error", 'message' => "File {$_files[$i]} could not be imported.", 'size' => filesize( $_destination ) ) );
		    $_errorFiles[] = $_files[$i];
		}
	    }
	    
	    if( count( $_errorFiles ) == 0 ) {
		$_errortype = 'success';
		$_errormsg = __('import_msg_successfiles');
	    } else {		
		$_errortype = 'error';
		$_errormsg = __('import_msg_errorfiles',array(implode(',',$_errorFiles)));
	    }
	} else {
	    $_errortype = 'error';
	    $_errormsg = __('import_msg_nofilesto');
	}
	
	redirect('admin/import?errortype='.$_errortype.'&errormsg='.urlencode( $_errormsg ) );
    }
    
}