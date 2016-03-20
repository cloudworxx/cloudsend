<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * jQuery File Upload Plugin PHP Class 5.11
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

class UploadHandler
{
    protected $options;
   
    function __construct($options=null) {
    	$CI =& get_instance();
    	$CI->load->model('user/mUser');
    	$_userDetails = $CI->mUser->getUser( $CI->session->userdata['userUnique'] );
    	
    	if( $_userDetails != false ) {
    	    if( $_userDetails->level == 3 ) {
                $_max_file_size = ( (int)$_userDetails->userMaxFileSize > 0 ) ? $_userDetails->userMaxFileSize : null;
                $_accept_file_types = (( $_userDetails->userAcceptTypes != NULL && !empty( $_userDetails->userAcceptTypes ) ) ? '/('.$_userDetails->userAcceptTypes.')/i' : '/.+$/i');
                $_max_number_of_files = ( (int)$_userDetails->userMaxNumFiles > 0 ) ? $_userDetails->userMaxNumFiles : null; 		
    	    } else {
                $_max_file_size = null;
                $_accept_file_types = '/.+$/i';
                $_max_number_of_files = null;
    	    }  
    	} else {
    	    $_request = $CI->session->userdata['fileByRequest'];
    	    if( isset( $_request ) && !empty( $_request ) && $_request == '1' ) {
                $_max_file_size = null;
                $_accept_file_types = '/.+$/i';
                $_max_number_of_files = null;		
    	    } else {
                return false;
    	    }
    	}
	
        $this->options = array(
            'script_url' => $this->getFullUrl().'/',
            'upload_dir' => FCPATH.'data'.DS.'files'.DS,
            'thumb_dir' => FCPATH.'data'.DS.'thumbs'.DS,
            'upload_url' => '#',
            'param_name' => 'files',
            'max_file_size' => $_max_file_size, // in bytes
            'min_file_size' => 1,
            'accept_file_types' => $_accept_file_types,
            'max_number_of_files' => $_max_number_of_files,
            'discard_aborted_uploads' => true
        );
    }

    protected function getFullUrl() {
      	return
	    (isset($_SERVER['HTTPS']) ? 'https://' : 'http://').
	    (isset($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
	    (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
	    (isset($_SERVER['HTTPS']) && $_SERVER['SERVER_PORT'] === 443 ||
	    $_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT']))).
	    substr($_SERVER['SCRIPT_NAME'],0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
    }

    protected function get_file_object($file_name) {
        $file_path = $this->options['upload_dir'].$file_name;
        if (is_file($file_path) && $file_name[0] !== '.') {
            $file = new stdClass();
            $file->name = $file_name;
            $file->size = filesize($file_path);
            $file->url = $this->options['upload_url'].rawurlencode($file->name);
            return $file;
        }
        return null;
    }

    protected function get_file_objects() {
        return array_values(array_filter(array_map(
            array($this, 'get_file_object'),
            scandir($this->options['upload_dir'])
        )));
    }

    protected function validate($uploaded_file, $file, $error, $index) {
        if ($error) {
            $file->error = $error;
            return false;
        }
        if (!$file->name) {
            $file->error = 'missingFileName';
            return false;
        }
        if (!preg_match($this->options['accept_file_types'], $file->name)) {
            $file->error = 'acceptFileTypes';
            return false;
        }
        if ($uploaded_file && is_uploaded_file($uploaded_file)) {
            $file_size = filesize($uploaded_file);
        } else {
            $file_size = $_SERVER['CONTENT_LENGTH'];
        }
        if ($this->options['max_file_size'] && (
                $file_size > $this->options['max_file_size'] ||
                $file->size > $this->options['max_file_size'])
            ) {
            $file->error = 'maxFileSize';
            return false;
        }
        if ($this->options['min_file_size'] &&
            $file_size < $this->options['min_file_size']) {
            $file->error = 'minFileSize';
            return false;
        }
        if (is_int($this->options['max_number_of_files']) && (
                count($this->get_file_objects()) >= $this->options['max_number_of_files'])
            ) {
            $file->error = 'maxNumberOfFiles';
            return false;
        }
        return true;
    }

    protected function upcount_name_callback($matches) {
        $index = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
        $ext = isset($matches[2]) ? $matches[2] : '';
        return ' ('.$index.')'.$ext;
    }

    protected function upcount_name($name) {
        return preg_replace_callback(
            '/(?:(?: \(([\d]+)\))?(\.[^.]+))?$/',
            array($this, 'upcount_name_callback'),
            $name,
            1
        );
    }

    protected function trim_file_name($name, $type, $index) {
        // Remove path information and dots around the filename, to prevent uploading
        // into different directories or replacing hidden system files.
        // Also remove control characters and spaces (\x00..\x20) around the filename:
        $file_name = trim(basename(stripslashes($name)), ".\x00..\x20");
        // Add missing file extension for known image types:
        if (strpos($file_name, '.') === false &&
            preg_match('/^image\/(gif|jpe?g|png)/', $type, $matches)) {
            $file_name .= '.'.$matches[1];
        }
        if ($this->options['discard_aborted_uploads']) {
            while(is_file($this->options['upload_dir'].$file_name)) {
                $file_name = $this->upcount_name($file_name);
            }
        }
        return $file_name;
    }

    protected function handle_form_data($file, $index) {
    }

    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error, $index) {
        $file = new stdClass();
        $file->name = $this->trim_file_name($name, $type, $index);
	$_ext = pathinfo( $file->name, PATHINFO_EXTENSION );
	$_uniqueName = uniqid('data_',true);
	$file->rand = $_uniqueName;
	$file->uniq = $_uniqueName.'.'.strtolower( $_ext );
        $file->size = intval($size);
        $file->type = $type;
        if ($this->validate($uploaded_file, $file, $error, $index)) {
            $this->handle_form_data($file, $index);
            $file_path = $this->options['upload_dir'].$file->uniq;  
            $append_file = !$this->options['discard_aborted_uploads'] &&
                is_file($file_path) && $file->size > filesize($file_path);
            clearstatcache();
            if ($uploaded_file && is_uploaded_file($uploaded_file)) {
                // multipart/formdata uploads (POST method uploads)
                if ($append_file) {
                    file_put_contents(
                        $file_path,
                        fopen($uploaded_file, 'r'),
                        FILE_APPEND
                    );
                } else {
                    move_uploaded_file($uploaded_file, $file_path);
                }
            } else {
                // Non-multipart uploads (PUT method support)
                file_put_contents(
                    $file_path,
                    fopen('php://input', 'r'),
                    $append_file ? FILE_APPEND : 0
                );
            }
            $file_size = filesize( $file_path );
	    $file_md5 = md5_file( $file_path );
            if ($file_size === $file->size) {
                $file->url = $this->options['upload_url'].rawurlencode($file->name);		
            } else if ($this->options['discard_aborted_uploads']) {
                unlink($file_path);
                $file->error = 'abort';
            }
            $file->size = $file_size;
	    $file->md5 = $file_md5;
        } else {
	    $file->errormsg = 'error';
	}
        return $file;
    }

    public function get() {
        $file_name = isset($_REQUEST['file']) ?
            basename(stripslashes($_REQUEST['file'])) : null;
        if ($file_name) {
            $info = $this->get_file_object($file_name);
        } else {
            $info = $this->get_file_objects();
        }
        header('Content-type: application/json');
        echo json_encode($info);
    }

    public function post() {
        $upload = isset($_FILES[$this->options['param_name']]) ?
            $_FILES[$this->options['param_name']] : null;
        $info = array();
        if ($upload && is_array($upload['tmp_name'])) {
            foreach ($upload['tmp_name'] as $index => $value) {
                $info[] = $this->handle_file_upload(
                    $upload['tmp_name'][$index],
                    isset($_SERVER['HTTP_X_FILE_NAME']) ?
                        $_SERVER['HTTP_X_FILE_NAME'] : $upload['name'][$index],
                    isset($_SERVER['HTTP_X_FILE_SIZE']) ?
                        $_SERVER['HTTP_X_FILE_SIZE'] : $upload['size'][$index],
                    isset($_SERVER['HTTP_X_FILE_TYPE']) ?
                        $_SERVER['HTTP_X_FILE_TYPE'] : $upload['type'][$index],
                    $upload['error'][$index],
                    $index
                );
            }
        } elseif ($upload || isset($_SERVER['HTTP_X_FILE_NAME'])) {
            // param_name is a single object identifier like "file",
            // $_FILES is a one-dimensional array:
            $info[] = $this->handle_file_upload(
                isset($upload['tmp_name']) ? $upload['tmp_name'] : null,
                isset($_SERVER['HTTP_X_FILE_NAME']) ?
                    $_SERVER['HTTP_X_FILE_NAME'] : (isset($upload['name']) ?
                        $upload['name'] : null),
                isset($_SERVER['HTTP_X_FILE_SIZE']) ?
                    $_SERVER['HTTP_X_FILE_SIZE'] : (isset($upload['size']) ?
                        $upload['size'] : null),
                isset($_SERVER['HTTP_X_FILE_TYPE']) ?
                    $_SERVER['HTTP_X_FILE_TYPE'] : (isset($upload['type']) ?
                        $upload['type'] : null),
                isset($upload['error']) ? $upload['error'] : null
            );
        }
        header('Vary: Accept');
	
	// save information to database
	$CI =& get_instance();
	
	$_fileList = array();
	$_frontLogin = ( isset( $CI->session->userdata['frontlogin'] ) ) ? $CI->session->userdata['frontlogin'] : false;
	$_byRequest = ( isset( $CI->session->userdata['fileByRequest'] ) && $CI->session->userdata['fileByRequest'] == '1' ) ? true : false;

	if( isset( $_frontLogin ) && $_frontLogin == true ) {
	    $_fileByCustomer = '1';
	} else {
	    $_fileByCustomer = '0';
	}
	
	if( $_byRequest ) $_fileByCustomer = '0';
		
	for( $i = 0; $i < count( $info ); $i++ ) {
	    if( !isset( $info[$i]->error ) ) {
		$_fileList[] = $info[$i]->name;
		$_fileUniqueID = uniqid('file_',true);
		
		$_insert = array(
		    'id' => NULL,
		    'fileUniqueID' => $_fileUniqueID,
		    'fileName' => $info[$i]->name,
		    'fileType' => $info[$i]->type,
		    'fileSize' => $info[$i]->size,
		    'fileTime' => time(),
		    'fileUploadBy' => ( $_byRequest ) ? 'UPLOADREQUEST' : $CI->session->userdata['userUnique'],
		    'fileByCustomer' => $_fileByCustomer,
		    'fileNewName' => $info[$i]->uniq,
		    'fileMD5' => $info[$i]->md5,
		    'fileCounter' => 0,
		    'filePublic' => '0',
		    'fileImportID' => $CI->session->userdata['importUnique'],
		);
		
		if( isset( $_REQUEST['filedesc'][$i] ) && !empty( $_REQUEST['filedesc'][$i] ) ) $_insert['fileDescription'] = $_REQUEST['filedesc'][$i];
		if( isset( $_REQUEST['filefolder'][$i] ) && !empty( $_REQUEST['filefolder'][$i] ) && $_REQUEST['filefolder'][$i] != '0' ) $_insert['folderUniqueID'] = $_REQUEST['filefolder'][$i];
		if( isset( $_REQUEST['tags'][$i] ) && !empty( $_REQUEST['tags'][$i] ) ) $_insert['fileTags'] = $_REQUEST['tags'][$i];
		if( $_byRequest ) $_insert['uploadRequest'] = $CI->session->userdata['requestID'];
		
		$CI->db->insert('files', $_insert);
		
		if( isset( $_REQUEST['filecats'][$i] ) && !empty( $_REQUEST['filecats'][$i] ) ) {
		    $_insertCat = array(
			'id' => NULL,
			'fileUniqueID' => $_fileUniqueID,
			'categoryUniqueID' => $_REQUEST['filecats'][$i]
		    );
		    
		    $CI->db->insert( 'files2cats', $_insertCat );
		}
		
		$_user = $CI->mUser->getUser( $CI->session->userdata['userUnique'] )->companyName;
		
		if( $_fileByCustomer == '1' ) {
		    $CI->mGlobal->log( array( 'type' => "info", 'message' => "Frontend user '{$_user}' uploaded file {$info[$i]->name}", 'size' => $info[$i]->size ) );
		} else {
		    $CI->mGlobal->log( array( 'type' => "info", 'message' => "User '{$_user}' uploaded file {$info[$i]->name}", 'size' => $info[$i]->size ) );
		}
		
		if( $_byRequest ) $CI->mGlobal->log( array( 'type' => "info", 'message' => "File uploaded by request '{$CI->session->userdata['requestID']}'", 'size' => $info[$i]->size ) );
		
		$CI->load->library('image_lib');
		
		$config = array(
			'source_image' => $this->options['upload_dir'].$info[$i]->uniq,
			'new_image' => $this->options['thumb_dir'].$info[$i]->rand.'.jpg',
			'maintain_ratio' => true,
			'width' => $CI->mGlobal->getConfig('THUMB_X')->configVal,
			'height' => $CI->mGlobal->getConfig('THUMB_Y')->configVal
		);

		$CI->image_lib->initialize( $config );
		$CI->image_lib->resize();		
		$CI->image_lib->clear();
		
		$config32 = array(
			'source_image' => $this->options['upload_dir'].$info[$i]->uniq,
			'new_image' => $this->options['thumb_dir'].$info[$i]->rand.'_32x32.jpg',
			'maintain_ratio' => true,
			'width' => '32',
			'height' => '32'
		);

		$CI->image_lib->initialize( $config32 );
		$CI->image_lib->resize();		
		$CI->image_lib->clear();
	    }
	}
		
        $json = json_encode($info);
        $redirect = isset($_REQUEST['redirect']) ?
            stripslashes($_REQUEST['redirect']) : null;
        if ($redirect) {
            header('Location: '.sprintf($redirect, rawurlencode($json)));
            return;
        }
        if (isset($_SERVER['HTTP_ACCEPT']) && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }
        echo $json;
    }
    
}
