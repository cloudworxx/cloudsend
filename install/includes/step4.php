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
require 'cloudsend/helpers/datetime_helper.php';

$_type = 'check';

if( isset( $_POST['type'] ) && $_POST['type'] == 'check' ) {
    $_error = array();
    
    if( $_POST['inst_admin_pass'] == $_POST['inst_admin_pass2'] ) {
	if( !empty( $_POST['inst_admin_user'] ) && !empty( $_POST['inst_admin_email'] ) && !empty( $_POST['inst_admin_pass'] ) ) {
	} else {
	    $_error[] = 'You have to fill out all fields.';
	}
    } else {
	$_error[] = '<strong>ERROR:</strong> Passwords do not match.';
    }
    
    if( count( $_error ) == 0 ) $_success = '<strong>SUCCESS</strong> All checks ok! Click "Next &raquo;"';
}

if( isset( $_POST['type'] ) && $_POST['type'] == 'save' ) {
    $_SESSION['inst_admin_user'] = $_POST['inst_admin_user'];
    $_SESSION['inst_admin_email'] = $_POST['inst_admin_email'];
    $_SESSION['inst_admin_pass'] = $_POST['inst_admin_pass'];
    $_SESSION['inst_admin_timezone'] = $_POST['inst_admin_timezone'];
    $_SESSION['inst_admin_dateformat'] = $_POST['inst_admin_dateformat'];

    echo '<script type="text/javascript">window.location="install.php?step=final";window.location.href="install.php?step=final";</script>';
    exit;
}

if( !isset( $_error ) OR count( $_error ) != 0 ) {
    $_links = '<a class="btn fl" href="install.php?step=step3">&laquo; Previous</a>';
    $_links .= '<a class="btn fr" href="javascript:$(\'#savestep\').submit();">Check Settings</a>';
} else {
    $_type = 'save';
    
    $_links = '<a class="btn fl" href="install.php?step=step3">&laquo; Previous</a>';
    $_links .= '<a class="btn fr" href="javascript:$(\'#savestep\').submit();">Final &raquo;</a>';
}

?>
<?php if( isset( $_error ) && count( $_error ) != 0 ): ?>
<div class="alert alert-error"><?php echo implode('<br />',$_error) ?></div>
<?php endif; ?>
<?php if( isset( $_success ) && !empty( $_success ) ): ?>
<div class="alert alert-success"><?php echo $_success ?></div>
<?php endif; ?>

<form name="savestep" id="savestep" action="install.php?step=step4" method="post">
<input type="hidden" name="type" value="<?php echo $_type ?>" />
    <h2>Admin Account</h2>
    <p>Please enter your details for creating the administration account.</p>
    <p>&nbsp;</p>
    <div class="box">
	<div class="field">
	    <label>Your Name / Company</label>
	    <input type="text" name="inst_admin_user" value="<?php if( isset( $_POST['inst_admin_user'] ) ) echo $_POST['inst_admin_user'] ?>"/>
	    <span>e.g. cloudworxx.us</span>
	</div>
	<div class="field">
	    <label>Email</label>
	    <input type="text" name="inst_admin_email" value="<?php if( isset( $_POST['inst_admin_email'] ) ) echo $_POST['inst_admin_email'] ?>"/>
	    <span>is also your login</span>
	</div>
	<div class="field">
	    <label>Password</label>
	    <input type="password" name="inst_admin_pass" value="<?php if( isset( $_POST['inst_admin_pass'] ) ) echo $_POST['inst_admin_pass'] ?>"/>
	</div>
	<div class="field">
	    <label>Password again</label>
	    <input type="password" name="inst_admin_pass2" value="<?php if( isset( $_POST['inst_admin_pass2'] ) ) echo $_POST['inst_admin_pass2'] ?>"/>
	</div>
	<hr />
	<div class="field">
	    <label>Timezone</label>
	    <?php echo timezone_select(((isset( $_POST['inst_admin_timezone'] ) ? $_POST['inst_admin_timezone'] : 'America/Los_Angeles')),'','inst_admin_timezone') ?>
	</div>
	<div class="field">
	    <label>Date Format</label>
	    <select name="inst_admin_dateformat">
		<option value="d.m.Y"><?php echo date('d.m.Y') ?></option>
		<option value="d.m.Y H:i"><?php echo date('d.m.Y H:i') ?></option>
		<option value="Y-m-d"><?php echo date('Y-m-d') ?></option>
		<option value="Y-m-d h:i a"><?php echo date('Y-m-d g:i a') ?></option>
		<option value="D, j. M. Y"><?php echo date('D, j. M. Y') ?></option>
		<option value="D, j. M. Y H:i"><?php echo date('D, j. M. Y H:i') ?></option>
		<option value="D, j. M. Y h:i a"><?php echo date('D, j. M. Y g:i a') ?></option>
	    </select>
	</div>
    </div>
</form>