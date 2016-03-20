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

<div class="container" id="login">
    <div class="row">
	<div class="page-header span7 offset2">
	    <h3><?php echo __('account_head_login') ?> <?php echo stripslashes( mGlobal::getConfig('PRODUCT_NAME')->configVal ) ?></h3>
	</div>

	<div class="span7 offset2">
	    <form name="loginForm" action="<?php echo site_url('admin/account/validate') ?>" method="post" class="form-horizontal" autocomplete="off">
		<div class="alert alert-<?php echo $errortype ?>">
		    <?php echo $errormsg ?>
		</div>
		<div class="control-group">
		    <label class="control-label" for="inputEmail"><?php echo __('account_lbl_email') ?></label>
		    <div class="controls">
			<input type="text" id="inputEmail" autocomplete="off" name="inputEmail" placeholder="<?php echo __('account_lbl_email') ?>" value="<?php echo set_value('inputEmail') ?>" />
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label" for="inputPassword"><?php echo __('account_lbl_password') ?></label>
		    <div class="controls">
			<input type="password" id="inputPassword" name="inputPassword" placeholder="<?php echo __('account_lbl_password') ?>" value="<?php echo set_value('inputPassword') ?>" />
		    </div>
		</div>
		<div class="control-group">
		    <div class="controls">
			<button type="submit" class="btn"><i class="icon-user"></i> <?php echo __('account_btn_signin' ) ?></button>
		    </div>
		</div>
	    </form>	
	</div>
    </div>
</div>
