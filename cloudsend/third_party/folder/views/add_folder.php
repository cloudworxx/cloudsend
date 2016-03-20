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

<div class="container" id="folderadd">
    <div class="page-header">
		<h3><?php echo __('folder_head_add') ?></h3>
    </div>
    <blockquote>
		<p><?php echo __('folder_desc_add') ?></p>
    </blockquote>
    <br />

    <?php if( $errortype ): ?>
    <div class="alert alert-<?php echo $errortype ?>">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?php echo $errormsg ?>
    </div>
    <?php endif; ?>

    <form name="addfolder" id="addfolder" action="<?php echo site_url( 'admin/folder/verify_folder' ) ?>" method="post" class="form-horizontal">
		<div class="control-group">
		    <label class="control-label" for="inputTitle"><?php echo __('folder_lbl_title') ?></label>
		    <div class="controls">
				<input type="text" id="inputTitle" name="inputTitle" value="<?php echo set_value( 'inputTitle' ) ?>" />
		    </div>
		</div>

		<div class="control-group">
		    <label class="control-label" for="inputParent"><?php echo __('folder_lbl_parent') ?></label>
		    <div class="controls">
		    	<?php echo $folderTag ?>
		    </div>
		</div>
		
		<div class="form-actions">
		    <button type="submit" class="btn btn-primary"><?php echo __('folder_btn_addfolder') ?></button>
		    <button type="button" class="btn" onClick="location.href='<?php echo site_url( 'admin/folder/index' ) ?>';" ><?php echo __('folder_btn_cancel') ?></button>
		</div>	
    </form>
</div>