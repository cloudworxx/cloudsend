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

<div class="container" id="editpublic">
    <div class="page-header">
	<h3><?php echo __('pub_head_publicdetails') ?></h3>
    </div>
    <blockquote>
	<p><?php echo __('pub_desc_publicdetails') ?></p>
    </blockquote>
    <br />

    <?php if( $errortype ): ?>
    <div class="alert alert-<?php echo $errortype ?>">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<?php echo $errormsg ?>
    </div>
    <?php endif; ?>

    <form class="form-horizontal">	
	<div class="control-group">
	    <label class="control-label"><?php echo __('pub_lbl_link') ?></label>
	    <div class="controls">
		<p>
		    <a href="<?php echo site_url( 'public/'.$details->publicUUID ) ?>"><?php echo site_url( 'public/'.$details->publicUUID ) ?></a><br />
		    <small><a id="copy-button" data-clipboard-text="<?php echo site_url( 'public/'.$details->publicUUID ) ?>" title="<?php echo __('copy_to_clipboard') ?>"><?php echo __('copy_to_clipboard') ?></a></small>
		</p>
	    </div>
	</div>

	<div class="control-group">
	    <label class="control-label"><?php echo __('pub_lbl_created') ?></label>
	    <div class="controls">
		<p><?php echo mUser::getUser( $details->userUniqueID )->companyName ?></p>
	    </div>
	</div>

	<div class="control-group">
	    <label class="control-label"><?php echo __('pub_lbl_message') ?></label>
	    <div class="controls">
		<p><?php echo ( $details->publicMessage != NULL ) ? nl2br( stripslashes( $details->publicMessage ) ) : __('pub_txt_none') ?></p>
	    </div>
	</div>

	<div class="control-group">
	    <label class="control-label"><?php echo __('pub_lbl_password') ?></label>
	    <div class="controls">
		<p><?php echo ( $details->publicPassword != NULL ) ? __('pub_txt_yes') : __('pub_txt_no') ?></p>
	    </div>
	</div>

	<div class="control-group">
	    <label class="control-label"><?php echo __('pub_lbl_available') ?></label>
	    <div class="controls">
		<p><?php echo ( $details->publicLimit != NULL ) ? cvTZ( $details->publicLimit ) : __('pub_txt_no') ?></p>
	    </div>
	</div>
	
	<div class="control-group">
	    <label class="control-label"><?php echo __('pub_lbl_share') ?></label>
	    <div class="controls">
		<p>
		   <a class="btn btn-mini" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( site_url( 'public/'.$details->publicUUID ) ) ?>" rel="newtab"><span class="icon-facebook"></span></a>
		   <a class="btn btn-mini" href="https://twitter.com/intent/tweet?url=<?php echo urlencode( site_url( 'public/'.$details->publicUUID ) ) ?>" rel="newtab"><span class="icon-twitter"></span></a>
		   <a class="btn btn-mini" href="https://plus.google.com/share?url=<?php echo urlencode( site_url( 'public/'.$details->publicUUID ) ) ?>" rel="newtab"><span class="icon-google-plus"></span></a>
		</p>
	    </div>
	</div>
	
	<?php if( $files != false ): ?>
	<div class="control-group">
	    <label class="control-label"><?php echo __('pub_lbl_files') ?></label>
	    <div class="controls">
		<table class="table table-condensed span6" style="margin-left:0px;">
		    <colgroup>
			<col style="width:5%" />
			<col style="width:75%" />
			<col style="width:10%" />
			<col style="width:10%" />
		    </colgroup>
		    <thead>
			<tr>
			    <th><?php echo __('pub_lsttit_count') ?></th>
			    <th><?php echo __('pub_lsttit_file') ?></th>
			    <th><?php echo __('pub_lsttit_available') ?></th>
			    <th><?php echo __('pub_lsttit_downloaded') ?></th>
			</tr>
		    </thead>
		    <tbody>
			<?php $_count = 1; ?>
			<?php foreach( $files AS $_file ): ?>
			<tr>
			    <td><?php echo $_count ?></td>
			    <td><?php echo $_file->fileName ?></td>
			    <td><center><?php echo ( empty( $_file->allowedCount ) ) ? __('pub_txt_notset') : $_file->allowedCount ?></center></td>
			    <td><center><?php echo ( empty( $_file->downloadCount ) ) ? 0 : $_file->downloadCount ?></center></td>
			</tr>
			<?php $_count++; ?>
			<?php endforeach; ?>
			
		    </tbody>

		</table>
	    </div>
	</div>
	<?php endif; ?>
	<div class="form-actions">
	    <button type="button" class="btn" onClick="location.href='<?php echo site_url( 'admin/publinks/all_entries' ) ?>';" ><?php echo __('pub_btn_cancel') ?></button>
	</div>	
    </form>
</div>
<script src="<?php echo base_url() ?>assets/scripts/libs/zeroclipboard.min.js"></script>
<script>
var cpyClip = new ZeroClipboard( document.getElementById("copy-button"), {
    moviePath: "<?php echo base_url() ?>assets/scripts/libs/ZeroClipboard.swf"
});   

cpyClip.on( 'complete', function( client, args ) {
    this.innerHTML = '<?php echo __('copy_to_clipboard_copied') ?>';
});
</script>