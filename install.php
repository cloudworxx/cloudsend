<?php
/**
 * CloudSend
 *
 * CloudSend was created for companies such as agencies that must constantly send files to the same customers or receive files from the same customers.
 *
 * @package    CloudSend installer
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

error_reporting(0);
session_start();

define('INSTALLER',true);
define('BASEPATH',true);

if( file_exists( 'cloudsend/config/config.php' ) OR file_exists( 'cloudsend/config/database.php' ) ) {
    die( 'CloudSend: Installer not necessary.' );
}

require 'cloudsend/helpers/project_helper.php';

if( !isset( $_GET['step'] ) ) {
    $_step = 'welcome';
} else {
    $_step = $_GET['step'];
}
$_head = true;
if( isset( $_GET['nohead'] ) ) $_head = false;
if( $_head ):
?>
<?php require 'install/includes/header.php'; ?>
   <div id="install">
        <div class="inner" id="steps">
		<img src="//cwx-ci-data.s3.amazonaws.com/cloudworxx/cloudworxx.180x46.png" />
                <h2 class="title fr">CloudSend Installer</h2>
<?php endif; ?>		
		<?php require 'install/includes/'.$_step.'.php'; ?>	
<?php if( $_head ): ?>
        </div>
	<p>&nbsp;</p>
	<div id="navigation" class="inner"><?php echo $_links ?></div>
    </div>
<?php require 'install/includes/footer.php'; ?>
<?php endif; ?>