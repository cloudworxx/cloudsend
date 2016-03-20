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
	<h3><?php echo __('uploads_head_edit') ?></h3>
    </div>
    <blockquote>
	<p><?php echo __('uploads_desc_edit') ?></p>
    </blockquote>
    <br />

    <?php if( $errortype ): ?>
    <div class="alert alert-<?php echo $errortype ?>">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<?php echo $errormsg ?>
    </div>
    <?php endif; ?>

    <form name="editupload" id="editupload" action="<?php echo site_url( 'admin/pubuploads/edit_upload' ) ?>" method="post" class="form-horizontal">
	<input type="hidden" name="entry" value="<?php echo $entry ?>" />
	
	<div class="control-group">
	    <label class="control-label"><?php echo __('pub_lbl_link') ?></label>
	    <div class="controls">
		<p>
		    <a href="<?php echo site_url( 'request/'.$details->uploadUUID ) ?>"><?php echo site_url( 'request/'.$details->uploadUUID ) ?></a><br />
		    <small><a id="copy-button" data-clipboard-text="<?php echo site_url( 'request/'.$details->uploadUUID ) ?>" title="<?php echo __('copy_to_clipboard') ?>"><?php echo __('copy_to_clipboard') ?></a></small>
		</p>
	    </div>
	</div>	
	
	<div class="control-group">
	    <label class="control-label" for="inputDescription"><?php echo __('uploads_lbl_desc') ?></label>
	    <div class="controls">
		<textarea id="inputDescription" name="inputDescription" class="span7" rows="10"><?php echo set_value( 'inputDescription', stripslashes( $details->uploadMessage ) ) ?></textarea>			
	    </div>
	</div>

	<div class="control-group">
	    <label class="control-label" for="inputDefaultFolder"><?php echo __('uploads_lbl_folder') ?></label>
	    <div class="controls">
		<?php echo $folders ?>
	    </div>
        </div>        
        
	<div class="form-actions">
	    <button type="submit" class="btn btn-primary"><?php echo __('uploads_btn_edit') ?></button>
	    <button type="button" class="btn" onClick="location.href='<?php echo site_url( 'admin/pubuploads/all_entries' ) ?>';" ><?php echo __('uploads_btn_cancel') ?></button>
	</div>	
    </form>
</div>

<script src="<?php echo base_url() ?>assets/scripts/libs/wysihtml5-0.3.0.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/libs/bootstrap-wysihtml5-0.0.2.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/libs/zeroclipboard.min.js"></script>
<script type="text/javascript">
var cpyClip = new ZeroClipboard( document.getElementById("copy-button"), {
    moviePath: "<?php echo base_url() ?>assets/scripts/libs/ZeroClipboard.swf"
});   

cpyClip.on( 'complete', function( client, args ) {
    this.innerHTML = '<?php echo __('copy_to_clipboard_copied') ?>';
});

$(function(){
    $('#inputDescription').wysihtml5({
        "font-styles": false,
        "image": false	
    });
});   
</script>