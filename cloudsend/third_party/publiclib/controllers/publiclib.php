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
 
class Publiclib extends CWX_Controller {
    
    public function index() {
	
	$_uuid = $this->uri->segment(2);
	$_data['title'] = __('public_title_publiclink');
	
	if( isset( $_uuid ) && !empty( $_uuid ) && strlen( $_uuid ) == 36 ) {
	    
	    $_public = $this->mPubliclib->getEntry( $_uuid );

	    if( $_public != false ) {

		if( !empty( $_public->publicPassword ) AND ( !isset( $this->session->userdata['publogin'] ) OR !isset( $this->session->userdata['pubfile'] ) OR $this->session->userdata['publogin'] != true OR $this->session->userdata['pubfile'] != $_uuid  ) ) {	   
		    redirect( 'public/login/'.$_uuid );
		} else {
		    $this->mGlobal->log( array( 'type' => "info", 'message' => "Public link '{$_uuid}' accessed.", 'size' => NULL ) );

		    $_files = $this->mPubliclib->getEntryFiles( $_public->publicUniqueID );

		    if( $_files != false ) {
			
			$_session = array(
			    'publogin' => true,
			    'pubfile' => $_public->publicUUID
			);

			$this->session->set_userdata( $_session );
			
			$_data['site'] = 'publiclib/list';
			$_data['public'] = $_public;
			$_data['files'] = $_files;
			$this->load->view( 'public', $_data );
		    } else {
			redirect( 'public/error' );
		    }
		    
		}
	    } else {
		redirect( 'public/error' );
	    }
	} else {
	    $_data['site'] = 'public/noaccess';
	    $this->load->view( 'public', $_data );	
	}
	
    }
  
    
    public function login() {
	$_uuid = $this->uri->segment(3);
	
	if( isset( $this->session->userdata['publogin'] ) && $this->session->userdata['publogin'] == true && $this->session->userdata['pubfile'] == $_uuid ) {
	    redirect( 'public/'.$_uuid );
	} else {
	    
	    $this->session->unset_userdata('publogin');
	    $this->session->unset_userdata('pubfile');
	    
	    $_data = array(
		'title' => __('public_title_linklogin'),
		'site' => 'publiclib/login'
	    );

	    $this->load->view( 'public', $_data );	
	}
    }
    
    public function verify() {
	$this->load->helper( array('form') );
	$this->load->library('form_validation');
	
	$config = array(
	    array( 'field' => 'inputPassword',	'label' => __('public_lbl_password'),	'rules' => 'trim|required' ),
	    array( 'field' => 'linkid',		'label' => __('public_lbl_link'),	'rules' => 'trim|required|alpha_dash')
	);
	
	$this->form_validation->set_rules( $config );
	
	if( $this->form_validation->run() == false ) {
	    $_return = array(
		'type' => 'error',
		'message' => validation_errors( ' ', '<br />' )
	    );
	} else {
	    $_verified = $this->mPubliclib->verifyPassword();
	    
	    if( $_verified != false ) {
		$_session = array(
		    'publogin' => true,
		    'pubfile' => $this->input->post('linkid')
		);
		
		$this->session->set_userdata( $_session );
		
		$_return = array(
		    'type' => 'success'
		);
	    } else {
		$_return = array(
		    'type' => 'error',
		    'message' => __('public_msg_novalidpassword')
		);
	    }
	}	
	
	$this->output
		->set_status_header( '200' )
		->set_content_type( 'application/json' )
		->set_output( json_encode( $_return ) );
	
    }
    
    public function download() {
	$_uuid = $this->uri->segment(3);
	$_fileUniqueID = $this->uri->segment(4);
	
        $_public = $this->mPubliclib->getEntry( $_uuid );
        $_pub2file = $this->mPubliclib->getEntryFilesDownload( $_fileUniqueID, $_public->publicUniqueID );

        if( $_public != false && $_pub2file != false ) {

            $_details = $this->mPubliclib->fileDetails( $_fileUniqueID );
            $_ext = pathinfo( $_details->fileName, PATHINFO_EXTENSION );
            $_ext = strtolower( $_ext );

            $file = FCPATH.'data/files/'.$_details->fileNewName;

            if( file_exists( $file ) ) {
                $_downType = $this->mGlobal->getConfig('DOWNLOAD_TYPE')->configVal;

                if( $_downType == 'normal' ) {
                    header('Content-type: '.$_details->fileType);
                    header('Content-Disposition: attachment; filename="' . $_details->fileName . '"');
                    header('Content-Transfer-Encoding: binary');
                    header('Content-Length: ' . filesize($file));
                    header('Accept-Ranges: bytes');

                    @readfile( $file );
                } else {
                    $_chunkSize = (int)$this->mGlobal->getConfig('CHUNKED_SIZE')->configVal;

                    header('Content-type: '.$_details->fileType);
                    header('Content-Disposition: attachment; filename="' . $_details->fileName . '"');
                    header('Content-Transfer-Encoding: binary');
                    header('Content-Length: ' . filesize( $file ) );
                    header('Connection: Keep-Alive');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                    header('Accept-Ranges: bytes');

                    ob_clean();
                    $handle = fopen($file, "rb");
                    $chunksize=(filesize($file)/$_chunkSize);

                    set_time_limit(0);
                    while (!feof($handle)) {
                        echo fgets($handle, $chunksize);
                        flush();
                    }
                    fclose($handle);
                }

                $this->mPubliclib->updateFileCount( $_fileUniqueID );
                $this->mGlobal->log( array( 'type' => "down", 'message' => "File '{$_details->fileName}' downloaded by public link '{$this->session->userdata('pubfile')}'.", 'size' => $_details->fileSize ) );
                $this->mPubliclib->updateFileCount( $_fileUniqueID, 'public2file', 'downloadCount' );
            } else {
                $this->mGlobal->log( array( 'type' => "error", 'message' => "Public link '{$this->session->userdata('pubfile')}' tried to download file '{$_details->fileName}' but does not exist on server.", 'size' => $_details->fileSize ) );
            }

        }
	    
    }
    
    public function error() {

	$_data = array(
	    'title' => __('public_title_publiclink'),
	    'site' => 'publiclib/error'
	);

	$this->load->view( 'public', $_data );
    }
    
    public function preview() {
	$this->load->library('image_lib');
	
	$_file = $this->uri->segment(4);
	$_type = $this->uri->segment(3);
	
	$_fileName = pathinfo( $_file,  PATHINFO_FILENAME );
	$_fileExt = pathinfo( $_file, PATHINFO_EXTENSION );
	$_fileExt = strtolower( $_fileExt );

	$_fileIcon = 'data'.DS.'thumbs'.DS.$_fileName.'_32x32.jpg';
	$_fileAsset = 'assets'.DS.'images'.DS.'32px'.DS.strtolower($_fileExt).'.png';
	$_fileBlank = 'assets'.DS.'images'.DS.'32px'.DS.'_blank.png';

	if( file_exists( FCPATH . $_fileIcon ) ) {
	    $_path = $_fileIcon;
	} else {	    
	    if( file_exists( FCPATH . $_fileAsset ) ) {
		$_path = $_fileAsset;
	    } else {
		if( file_exists( FCPATH . $_fileBlank ) ) {
		    $_path = $_fileBlank;
		}
	    }
	}

	$imageinit['width']             = '32';
	$imageinit['height']            = '32';
	$imageinit['dynamic_output']    = true;     // set to true to generate it dynamically
	$imageinit['source_image']	= FCPATH . $_path;
	$imageinit['maintain_ratio']    = true;
	
	$this->image_lib->initialize($imageinit);
	$this->image_lib->resize();
    }   
    
} 