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
?>

<div class="container" id="accountadd">
    <div class="page-header">
	<h3><?php echo __('user_head_edituser') ?></h3>
    </div>
    <blockquote>
	<p><?php echo __('user_desc_edituser') ?></p>
    </blockquote>
    <br />

    <?php if( $errortype ): ?>
    <div class="alert alert-<?php echo $errortype ?>">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<?php echo $errormsg ?>
    </div>
    <?php else: ?>
    <div class="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<?php echo __('user_msg_needtorelogin') ?>
    </div>    
    <?php endif; ?>

    <form name="addaccount" id="addaccount" action="<?php echo site_url( $user->userURL.'/save_settings' ) ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
	<input type="hidden" name="user" value="<?php echo $user->userUniqueID ?>" />
	
	<div class="control-group">
	    <label class="control-label" for="inputName"><?php echo __('user_lbl_name') ?></label>
	    <div class="controls">
		<input type="text" id="inputName" name="inputName" value="<?php echo set_value( 'inputName', stripslashes( $user->companyName ) ) ?>" />
	    </div>
	</div>

	<div class="control-group">
	    <label class="control-label" for="inputEmail"><?php echo __('user_lbl_email') ?></label>
	    <div class="controls">
		<input type="text" id="inputEmail" name="inputEmail" value="<?php echo set_value( 'inputEmail', $user->emailAddress ) ?>" />
	    </div>
	</div>

	<hr />
	<p><?php echo __('user_txt_passonlyenterif') ?></p>
	<div class="control-group">
	    <label class="control-label" for="inputPassword"><?php echo __('user_lbl_password') ?></label>
	    <div class="controls">
		<input type="password" id="inputPassword" name="inputPassword" value="<?php echo set_value( 'inputPassword' ) ?>" />
		<br /><small class="password"></small>
	    </div>
	</div>

	<div class="control-group">
	    <label class="control-label" for="inputPassword2"><?php echo __('user_lbl_passwordagain') ?></label>
	    <div class="controls">
		<input type="password" id="inputPassword2" name="inputPassword2" value="<?php echo set_value( 'inputPassword2' ) ?>" />
	    </div>
	</div>

	<hr />
	<div class="control-group">
	    <label class="control-label" for="inputTimezone"><?php echo __('user_lbl_timezone') ?></label>
	    <div class="controls">
		<?php echo timezone_select(set_value( 'inputTimezone', $user->timeZone ),'','inputTimezone','inputTimezone') ?>
	    </div>
	</div>

	<div class="control-group">
	    <label class="control-label" for="inputDateformat"><?php echo __('user_lbl_dateformat') ?></label>
	    <div class="controls">
		<select name="inputDateformat" id="inputDateformat">
		    <option value="d.m.Y" <?php echo set_select( 'inputDateformat', 'd.m.Y', ( $user->timeFormat == 'd.m.Y') ? true : false ) ?>><?php echo date('d.m.Y') ?></option>
		    <option value="d.m.Y H:i" <?php echo set_select( 'inputDateformat', 'd.m.Y H:i', ( $user->timeFormat == 'd.m.Y H:i') ? true : false ) ?>><?php echo date('d.m.Y H:i') ?></option>
		    <option value="Y-m-d" <?php echo set_select( 'inputDateformat', 'Y-m-d', ( $user->timeFormat == 'Y-m-d') ? true : false ) ?>><?php echo date('Y-m-d') ?></option>
		    <option value="Y-m-d h:i a" <?php echo set_select( 'inputDateformat', 'Y-m-d h:i a', ( $user->timeFormat == 'Y-m-d h:i a') ? true : false ) ?>><?php echo date('Y-m-d g:i a') ?></option>
		    <option value="D, j. M. Y" <?php echo set_select( 'inputDateformat', 'D, j. M. Y', ( $user->timeFormat == 'D, j. M. Y') ? true : false ) ?>><?php echo date('D, j. M. Y') ?></option>
		    <option value="D, j. M. Y H:i" <?php echo set_select( 'inputDateformat', 'D, j. M. Y H:i', ( $user->timeFormat == 'D, j. M. Y H:i') ? true : false ) ?>><?php echo date('D, j. M. Y H:i') ?></option>
		    <option value="D, j. M. Y h:i a" <?php echo set_select( 'inputDateformat', 'D, j. M. Y h:i a', ( $user->timeFormat == 'D, j. M. Y h:i a') ? true : false ) ?>><?php echo date('D, j. M. Y g:i a') ?></option>
		</select>
	    </div>
	</div>
	
	<div class="form-actions">
	    <button type="submit" class="btn btn-primary"><?php echo __('user_btn_edit') ?></button>
	    <button type="button" class="btn" onClick="location.href='<?php echo site_url( 'admin/user/all_entries' ) ?>';" ><?php echo __('user_btn_cancel') ?></button>
	</div>	
    </form>
</div>