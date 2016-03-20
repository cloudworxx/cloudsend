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
 
 
class Uploads extends CWX_Controller {
    
    public function index() {
        require APPPATH.'libraries/csfolder.php';
	$this->load->model('categories/mCategories');
	
	$_imp = uniqid( 'imp_', true );
        $_folder = new csFolder();

	$this->session->set_userdata('importUnique',$_imp);

	$_data = array(
	    'site' => 'uploads/index',
	    'title' => __('up_title_uploads'),
	    'categories' => $this->mCategories->getCategories(),
            'folders' => $_folder->getSelect( 0, 1, NULL, 'filefolder[]', 'span2', '' )
	);	
		
        $this->load->view( 'master', $_data );
    }
    
    
    public function upload() {
        $this->load->helper("upload.class");

        $upload_handler = new UploadHandler();

        header('Pragma: no-cache');
        header('Vary: accept');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Content-Disposition: inline; filename="files.json"');
        header('X-Content-Type-Options: nosniff');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT');
        header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'OPTIONS':
                break;
            case 'HEAD':
            case 'GET':
                $upload_handler->get();
                break;
            case 'POST':
                if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
                    $upload_handler->delete();
                } else {
                    $upload_handler->post();
                }
                break;
            case 'DELETE':
                $upload_handler->delete();
                break;
            default:
                header('HTTP/1.1 405 Method Not Allowed');
        }

    }
    
    public function latest() {
	$this->load->model('user/mUser');
	$_latestID = $this->input->post('fileImportID');
	
	if( !isset( $_latestID ) || empty( $_latestID ) ) { 
	    $_latestID = $this->mUploads->latestImportID()->fileImportID;
	}
	
	$_data = array(
	    'title' => __('up_title_lastupload'),
	    'site' => 'uploads/latest',
	    'files' => $this->mUploads->latestFiles( $_latestID ),
	    'imports' => $this->mUploads->getImports(),
	    'latest' => $_latestID,
	    'users' => $this->mUser->getAllStdUser()
	);
    
	$this->load->view( 'master', $_data );	
    }
}