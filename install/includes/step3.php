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

$_type = 'check';

if( isset( $_POST['type'] ) && $_POST['type'] == 'check' ) {
    $_error = array();
    
    if( !isset( $_POST['inst_db_prefix'] ) OR empty( $_POST['inst_db_prefix'] ) ) {
    	$_error[] = '<strong>ERROR:</strong> Please choose a db prefix, otherwise the system will not work.';
    } else {
	    $connID = mysql_connect( $_POST['inst_db_host'], $_POST['inst_db_user'], $_POST['inst_db_pass'] );
	    
	    if( $connID ) {
		$selectDB = mysql_select_db( $_POST['inst_db_data'], $connID );
		
		if( !$selectDB ) $_error[] = '<strong>ERROR:</strong> Cannot select the database provided.<br />MySQL Error: '.mysql_error();
	    } else {
			$_error[] = '<strong>ERROR:</strong> Could not connect to the database server.<br />MySQL Error: '.mysql_error();
	    }
	    
	    if( count( $_error ) == 0 ) $_success = '<strong>SUCCESS</strong> All checks ok! Click "Next &raquo;"';
	}
}

if( isset( $_POST['type'] ) && $_POST['type'] == 'save' ) {
    $_SESSION['inst_db_host'] = $_POST['inst_db_host'];
    $_SESSION['inst_db_user'] = $_POST['inst_db_user'];
    $_SESSION['inst_db_pass'] = $_POST['inst_db_pass'];
    $_SESSION['inst_db_data'] = $_POST['inst_db_data'];
    $_SESSION['inst_db_prefix'] = $_POST['inst_db_prefix'];
    
    echo '<script type="text/javascript">window.location="install.php?step=step4";window.location.href="install.php?step=step4";</script>';
    exit;
}

if( !isset( $_error ) OR count( $_error ) != 0 ) {
    $_links = '<a class="btn fl" href="install.php?step=step2">&laquo; Previous</a>';
    $_links .= '<a class="btn fr" href="javascript:$(\'#savestep\').submit();">Check Connection</a>';
} else {
    $_type = 'save';
    
    $_links = '<a class="btn fl" href="install.php?step=step2">&laquo; Previous</a>';
    $_links .= '<a class="btn fr" href="javascript:$(\'#savestep\').submit();">Next &raquo;</a>';
}

?>
<?php if( isset( $_error ) && count( $_error ) != 0 ): ?>
<div class="alert alert-error"><?php echo implode('<br />',$_error) ?></div>
<?php endif; ?>
<?php if( isset( $_success ) && !empty( $_success ) ): ?>
<div class="alert alert-success"><?php echo $_success ?></div>
<?php endif; ?>

<form name="savestep" id="savestep" action="install.php?step=step3" method="post">
<input type="hidden" name="type" value="<?php echo $_type ?>" />
    <h2>Database settings</h2>
    <p>Below you should enter your database connection details. If you're not sure about these, contact your host.</p>
    <p>&nbsp;</p>
    <div class="box">
	<div class="field">
	    <label>Hostname</label>
	    <input type="text" name="inst_db_host" value="<?php if( isset( $_POST['inst_db_host'] ) ) echo $_POST['inst_db_host'] ?>"/>
	    <span>server hostname</span>
	</div>
	<div class="field">
	    <label>Username</label>
	    <input type="text" name="inst_db_user" value="<?php if( isset( $_POST['inst_db_user'] ) ) echo $_POST['inst_db_user'] ?>"/>
	    <span>your MYSQL username</span>
	</div>
	<div class="field">
	    <label>Password</label>
	    <input type="password" name="inst_db_pass" value="<?php if( isset( $_POST['inst_db_pass'] ) ) echo $_POST['inst_db_pass'] ?>"/>
	    <span>and your MYSQL password</span>
	</div>
	<div class="field">
	    <label>Database</label>
	    <input type="text" name="inst_db_data" value="<?php if( isset( $_POST['inst_db_data'] ) ) echo $_POST['inst_db_data'] ?>"/>
	    <span>MYSQL database</span>
	</div>
	<div class="field">
	    <label>Table Prefix</label>
	    <input type="text" name="inst_db_prefix" value="<?php echo ( isset( $_POST['inst_db_prefix'] ) ) ? $_POST['inst_db_prefix'] : 'cloud_' ?>"/>
	    <span>MYSQL table prefix</span>
	</div>
    </div>
</form>