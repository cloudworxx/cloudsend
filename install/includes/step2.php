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

$pageURL = 'http';
if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
$pageURL .= "://";
if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443") {
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} else {
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}
$pageURL = str_replace( 'install.php?step=step2', '', $pageURL );

if( isset( $_POST['type'] ) && $_POST['type'] == 'check' ) {
    $_error = array();
    
    if( isset( $_POST['inst_app_name'] ) && empty( $_POST['inst_app_name'] ) ) $_error[] = 'Please enter Application Name';
    if( isset( $_POST['inst_app_domain'] ) && empty( $_POST['inst_app_domain'] ) ) $_error[] = 'Please enter Domain';
    
    if( count( $_error ) == 0 ) $_success = '<strong>SUCCESS</strong> All checks ok! Click "Next &raquo;"';
}

if( isset( $_POST['type'] ) && $_POST['type'] == 'save' ) {
    $_SESSION['inst_app_name'] = $_POST['inst_app_name'];
    $_SESSION['inst_app_domain'] = $_POST['inst_app_domain'];
    $_SESSION['inst_nice_urls'] = $_POST['inst_nice_urls'];
    $_SESSION['inst_language'] = $_POST['inst_language'];
    
    echo '<script type="text/javascript">window.location="install.php?step=step3";window.location.href="install.php?step=step3";</script>';
    exit;
}

if( !isset( $_error ) OR count( $_error ) != 0 ) {
    $_links = '<a class="btn fl" href="install.php?step=step1">&laquo; Previous</a>';
    $_links .= '<a class="btn fr" href="javascript:$(\'#savestep\').submit();">Check Settings</a>';
} else {
    $_type = 'save';
    
    $_links = '<a class="btn fl" href="install.php?step=step1">&laquo; Previous</a>';
    $_links .= '<a class="btn fr" href="javascript:$(\'#savestep\').submit();">Next &raquo;</a>';
}

?>
<?php if( isset( $_error ) && count( $_error ) != 0 ): ?>
<div class="alert alert-error"><?php echo implode('<br />',$_error) ?></div>
<?php endif; ?>
<?php if( isset( $_success ) && !empty( $_success ) ): ?>
<div class="alert alert-success"><?php echo $_success ?></div>
<?php endif; ?>

<form name="savestep" id="savestep" action="install.php?step=step2" method="post">
<input type="hidden" name="type" value="<?php echo $_type ?>" />

    <h2>General settings</h2>
    <div class="box">
	<div class="field">
	    <label>Application name</label>
	    <input type="text" name="inst_app_name" value="<?php echo ( isset( $_POST['inst_app_name'] ) ) ? $_POST['inst_app_name'] : 'CloudSend' ?>"/>
	</div>
	<div class="field">
	    <label>Domain</label>
	    <input type="text" name="inst_app_domain" value="<?php echo ( isset( $_POST['inst_app_domain'] ) ) ? $_POST['inst_app_domain'] : $pageURL ?>"/>
	    <span>eg: http://www.yourdomain.com/</span>
	</div>
	<div class="field">
	    <label>Nice URLs?</label>
	    <select name="inst_nice_urls">
		<option value="index.php"<?php echo ( isset( $_POST['inst_nice_urls'] ) && $_POST['inst_nice_urls'] == 'index.php' ) ? ' selected="selected"' : '' ?>>No</option>
		<option value=""<?php echo ( isset( $_POST['inst_nice_urls'] ) && $_POST['inst_nice_urls'] == '' ) ? ' selected="selected"' : '' ?>>Yes</option>
	    </select>
	    <span>needs Apache mod_rewrite</span>
	</div>
	<div class="field">
	    <label>System Language</label>
	    <select name="inst_language">
		<option value="english"<?php echo ( isset( $_POST['inst_language'] ) && $_POST['inst_language'] == 'english' ) ? ' selected="selected"' : '' ?>>English</option>
		<option value="german"<?php echo ( isset( $_POST['inst_language'] ) && $_POST['inst_language'] == 'german' ) ? ' selected="selected"' : '' ?>>German</option>
		<option value="dutch"<?php echo ( isset( $_POST['inst_language'] ) && $_POST['inst_language'] == 'dutch' ) ? ' selected="selected"' : '' ?>>Dutch</option>
		<option value="french"<?php echo ( isset( $_POST['inst_language'] ) && $_POST['inst_language'] == 'french' ) ? ' selected="selected"' : '' ?>>French</option>
		<option value="spanish"<?php echo ( isset( $_POST['inst_language'] ) && $_POST['inst_language'] == 'spanish' ) ? ' selected="selected"' : '' ?>>Spanish</option>
		<option value="portuguese"<?php echo ( isset( $_POST['inst_language'] ) && $_POST['inst_language'] == 'spanish' ) ? ' selected="selected"' : '' ?>>Portuguese</option>
	    </select>
	    <span>English, German, Dutch, French, Spanish and Portuguese included</span>
	</div>
    </div>			
</form>