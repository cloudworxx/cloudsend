<?php  if ( ! defined('INSTALLER')) exit('No direct script access allowed');
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

$_error = array();

$_configPerm = substr(sprintf('%o', fileperms('cloudsend/config')), -3);
$_bgData = substr(sprintf('%o', fileperms('data/backgrounds')), -3);
$_filesData = substr(sprintf('%o', fileperms('data/files')), -3);
$_thumbsData = substr(sprintf('%o', fileperms('data/thumbs')), -3);
$_importData = substr(sprintf('%o', fileperms('data/import')), -3);
$_tmpData = substr(sprintf('%o', fileperms('data/tmp')), -3);

if( (int)$_configPerm != 777 ) $_error[] = 'Check permission: <strong>cloudsend/config</strong> is not writable.';
if( (int)$_bgData != 777 ) $_error[] = 'Check permission: <strong>data/backgrounds</strong> is not writable.';
if( (int)$_filesData != 777 ) $_error[] = 'Check permission: <strong>data/files</strong> is not writable.';
if( (int)$_thumbsData != 777 ) $_error[] = 'Check permission: <strong>data/thumbs</strong> is not writable.';
if( (int)$_importData != 777 ) $_error[] = 'Check permission: <strong>data/import</strong> is not writable.';
if( (int)$_tmpData != 777 ) $_error[] = 'Check permission: <strong>data/tmp</strong> is not writable.';
if ( version_compare(PHP_VERSION, '5.0.0', '<') ) $_error[] = 'You need at least PHP 5.0 - your version is '.PHP_VERSION;

if( count( $_error ) != 0 ) {
    $_links = '<a class="btn fl" href="install.php">&laquo; Previous</a>';
    $_links .= '<a class="btn fr" href="install.php?step=step1">Check again</a>';
} else {
    $_links = '<a class="btn fl" href="install.php">&laquo; Previous</a>';
    $_links .= '<a class="btn fr" href="install.php?step=step2">Next &raquo;</a>';
}
?>    
    <?php if( isset( $_error ) && count( $_error ) != 0 ): ?>
    <div class="alert alert-error"><?php echo implode('<br />',$_error) ?></div>
    <?php endif; ?>

    <h2>Server Checks</h2>

    <table>
	<thead>
	    <tr>
		<th><strong>Folder Permissions</strong></th>
		<th><strong>Your Config</strong></th>
		<th><strong>Needed Config</strong></th>
	    </tr>
	</thead>
	<tbody>
	    <tr>
		<td>cloudsend/config <strong style="color:red;">(only folder - no files !!)</strong></td>
		<td><?php echo substr(sprintf('%o', fileperms('cloudsend/config')), -3); ?></td>
		<td>777</td>
	    </tr>
	    <tr>
		<td>data/backgrounds</td>
		<td><?php echo substr(sprintf('%o', fileperms('data/backgrounds')), -3); ?></td>
		<td>777</td>
	    </tr>
	    <tr>
		<td>data/files</td>
		<td><?php echo substr(sprintf('%o', fileperms('data/files')), -3); ?></td>
		<td>777</td>
	    </tr>
	    <tr>
		<td>data/thumbs</td>
		<td><?php echo substr(sprintf('%o', fileperms('data/thumbs')), -3); ?></td>
		<td>777</td>
	    </tr>
	    <tr>
		<td>data/import</td>
		<td><?php echo substr(sprintf('%o', fileperms('data/import')), -3); ?></td>
		<td>777</td>
	    </tr>
	    <tr>
		<td>data/tmp</td>
		<td><?php echo substr(sprintf('%o', fileperms('data/tmp')), -3); ?></td>
		<td>777</td>
	    </tr>
	    <tr>
		<td colspan="3"><p>&nbsp;</p><strong>PHP Version</strong></td>
	    </tr>
	    <tr>
		<td>Version</td>
		<td><?php echo PHP_VERSION; ?></td>
		<td>5.0</td>
	    </tr>
	</tbody>
    </table>
