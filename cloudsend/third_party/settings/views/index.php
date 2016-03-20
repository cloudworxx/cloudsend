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
<form name="settings" id="settings" action="<?php echo site_url( 'admin/settings/verify' ) ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="container" id="settings">
    <div class="row">
	<div class="span12">
	    <div class="page-header">
		<h3><?php echo __('set_head_settings') ?></h3>
	    </div>
	    <blockquote>
		<?php echo __('set_desc_settings') ?>
	    </blockquote>
	    <br />
	    <?php if( $errortype ): ?>
	    <div class="alert alert-<?php echo $errortype ?>">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?php echo $errormsg ?>
	    </div>
	    <?php endif; ?>	    	    
	</div>
    </div>
    <div class="row">
	
	<div class="span2">
	    <div class="tabbable tabs-left">
		<?php $this->load->view('settings/navigation') ?>
	    </div>
	</div>

	<div class="span10">	   
	    <input type="hidden" name="section" value="<?php echo $section ?>" />
		<?php if( is_array( $settings ) ): ?>
		<?php foreach( $settings AS $_entry ): ?>
		<div class="control-group <?php echo $_entry->configSection ?><?php if( !empty( $_entry->configClass ) ) echo ' '.$_entry->configClass ?>">
		    <label class="control-label" for="inputSetting<?php echo $_entry->id ?>"><?php echo __( 'set_lbl_'.strtolower( $_entry->configVar ) ) ?></label>
		    <div class="controls">
			<?php if( $_entry->configFieldType == 'textarea' ): ?>
			<textarea id="inputSetting<?php echo $_entry->id ?>" name="inputSetting[<?php echo $_entry->configVar ?>]" class="span7<?php if( !empty( $_entry->configInputClass ) ) echo ' '.$_entry->configInputClass ?>" rows="10"><?php echo set_value( 'inputSetting['.$_entry->configVar.']', $_entry->configVal ) ?></textarea>			
			
			<?php elseif( $_entry->configFieldType == 'select' ): ?>
			<?php
			    $_pos_vals = json_decode( stripslashes( $_entry->configPossibleVal ) );
			    if( is_object( $_pos_vals ) ):
			?>
			<select id="inputSetting<?php echo $_entry->id ?>" name="inputSetting[<?php echo $_entry->configVar ?>]"<?php if( !empty( $_entry->configInputClass ) ) echo ' class="'.$_entry->configInputClass.'"' ?>>
			    <?php foreach( $_pos_vals AS $_key => $_value ): ?>
			    <option value="<?php echo $_value ?>"<?php echo set_select( 'inputSetting['.$_entry->configVar.']', $_value, ( $_entry->configVal == $_value ) ? true : false ) ?>><?php echo __( 'set_lbl_'.strtolower( $_key ) ) ?></option>
			    <?php endforeach; ?>
			</select>
			<?php endif; ?>
			<?php elseif( $_entry->configFieldType == 'folderlist' ):   // UPDATE: v 1.2 ?>
			<?php $_path = directory_map( FCPATH. $_entry->configPossibleVal, 1 ); ?>
			<?php if( count( $path )  != 0 ): ?>
			<select id="inputSetting<?php echo $_entry->id ?>" name="inputSetting[<?php echo $_entry->configVar ?>]"<?php if( !empty( $_entry->configInputClass ) ) echo ' class="'.$_entry->configInputClass.'"' ?>>
			    <?php for( $i = 0; $i < count( $_path ); $i++ ): ?>
			    <option value="<?php echo $_path[$i] ?>"<?php echo set_select( 'inputSetting['.$_entry->configVar.']', $_path[$i], ( $_entry->configVal == $_path[$i] ) ? true : false ) ?>><?php echo ucfirst( $_path[$i] ) ?></option>
			    <?php endfor; ?>
			</select>
			<?php endif; ?>
			
			<?php elseif( $_entry->configFieldType == 'text' OR $_entry->configFieldType == 'password' ):    // UPDATE: v 1.2 ?>
			<input type="<?php echo $_entry->configFieldType ?>" id="inputSetting<?php echo $_entry->id ?>" name="inputSetting[<?php echo $_entry->configVar ?>]" value="<?php if ($_entry->configFieldType != 'password' ) echo set_value( 'inputSetting['.$_entry->configVar.']', $_entry->configVal ) ?>"<?php if( !empty( $_entry->configInputClass ) ) echo ' class="'.$_entry->configInputClass.'"' ?> />
			<?php endif; ?>
		    </div>
		</div>
		<?php endforeach; ?>
		<?php else: // if( is_array( $settings ) ): ?>
		<div class="alert alert-info">
		    <?php echo __('set_msg_nosettingsfound') ?>
		</div>
		<?php endif; // if( is_array( $settings ) ): ?>
	    	    
	</div>
	
    </div>  
    
    <div class="row">
	<div class="form-actions">
	    <button type="submit" class="btn btn-primary"><?php echo __('set_btn_save') ?></button>
	    <button type="button" class="btn" onClick="location.href='<?php echo site_url( 'admin/dashboard/index' ) ?>';" ><?php echo __('set_btn_cancel') ?></button>
	</div>		    
    </div>
</div>
</form>
<script src="<?php echo base_url() ?>assets/scripts/libs/wysihtml5-0.3.0.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/libs/bootstrap-wysihtml5-0.0.2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.protocol').click(function() {
	changeValue();
    });
    
    $('.imagelib').click(function() {
	changeImage();
    });
    
    $('.downloads').click(function() {
	changeDownload();
    });
    <?php foreach( $settings AS $_entry ): ?>
	<?php if( $_entry->configSection == 'templates' && $_entry->configFieldType == 'textarea' ): ?>
    $('#inputSetting<?php echo $_entry->id ?>').wysihtml5();
	<?php endif;?>
    <?php endforeach; ?>
    
    function changeValue() {
	var $protValue = $('.protocol select').val();
	$('.protval').removeClass('hidden').addClass('hidden');
	$('.'+$protValue).removeClass('hidden');
    }
    function changeImage() {
	var $imglibValue = $('.imagelib select').val();
	$('.imgval').removeClass('hidden').addClass('hidden');
	$('.'+$imglibValue).removeClass('hidden');
    }
    function changeDownload() {
	var $downValue = $('.downloads select').val();
	$('.chunked').removeClass('hidden').addClass('hidden');
	$('.'+$downValue).removeClass('hidden');
    }
    
    changeValue();
    changeImage();
    changeDownload();
});    
</script>