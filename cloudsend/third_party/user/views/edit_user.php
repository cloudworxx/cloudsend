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

    <form name="addaccount" id="addaccount" action="<?php echo site_url( 'admin/user/change_user' ) ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
	<input type="hidden" name="user" value="<?php echo $details->userUniqueID ?>" />
	
	<div class="control-group">
	    <label class="control-label" for="inputName"><?php echo __('user_lbl_name') ?></label>
	    <div class="controls">
		<input type="text" id="inputName" name="inputName" value="<?php echo set_value( 'inputName', stripslashes( $details->companyName ) ) ?>" />
	    </div>
	</div>

	<div class="control-group">
	    <label class="control-label" for="inputEmail"><?php echo __('user_lbl_email') ?></label>
	    <div class="controls">
		<input type="text" id="inputEmail" name="inputEmail" value="<?php echo set_value( 'inputEmail', $details->emailAddress ) ?>" />
	    </div>
	</div>

	<hr />
	<p><?php echo __('user_txt_passonlyenterif') ?></p>
	<div class="control-group">
	    <label class="control-label" for="inputPassword"><?php echo __('user_lbl_password') ?></label>
	    <div class="controls">
		<input type="password" id="inputPassword" name="inputPassword" value="<?php echo set_value( 'inputPassword' ) ?>" />
		<button type="button" class="btn" id="generate"><i class="icon-refresh"></i> <?php echo __('user_btn_generate') ?></button>
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
		<?php echo timezone_select(set_value( 'inputTimezone', $details->timeZone ),'','inputTimezone','inputTimezone') ?>
	    </div>
	</div>

	<div class="control-group">
	    <label class="control-label" for="inputDateformat"><?php echo __('user_lbl_dateformat') ?></label>
	    <div class="controls">
		<select name="inputDateformat" id="inputDateformat">
		    <option value="d.m.Y" <?php echo set_select( 'inputDateformat', 'd.m.Y', ( $details->timeFormat == 'd.m.Y') ? true : false ) ?>><?php echo date('d.m.Y') ?></option>
		    <option value="d.m.Y H:i" <?php echo set_select( 'inputDateformat', 'd.m.Y H:i', ( $details->timeFormat == 'd.m.Y H:i') ? true : false ) ?>><?php echo date('d.m.Y H:i') ?></option>
		    <option value="Y-m-d" <?php echo set_select( 'inputDateformat', 'Y-m-d', ( $details->timeFormat == 'Y-m-d') ? true : false ) ?>><?php echo date('Y-m-d') ?></option>
		    <option value="Y-m-d h:i a" <?php echo set_select( 'inputDateformat', 'Y-m-d h:i a', ( $details->timeFormat == 'Y-m-d h:i a') ? true : false ) ?>><?php echo date('Y-m-d g:i a') ?></option>
		    <option value="D, j. M. Y" <?php echo set_select( 'inputDateformat', 'D, j. M. Y', ( $details->timeFormat == 'D, j. M. Y') ? true : false ) ?>><?php echo date('D, j. M. Y') ?></option>
		    <option value="D, j. M. Y H:i" <?php echo set_select( 'inputDateformat', 'D, j. M. Y H:i', ( $details->timeFormat == 'D, j. M. Y H:i') ? true : false ) ?>><?php echo date('D, j. M. Y H:i') ?></option>
		    <option value="D, j. M. Y h:i a" <?php echo set_select( 'inputDateformat', 'D, j. M. Y h:i a', ( $details->timeFormat == 'D, j. M. Y h:i a') ? true : false ) ?>><?php echo date('D, j. M. Y g:i a') ?></option>
		</select>
	    </div>
	</div>

	<?php if( $details->level <= '2' ) : ?>
	<input type="hidden" name="inputLevel" value="<?php echo $details->level ?>" />
	<?php else: ?>
	<hr />
	<div class="control-group">
	    <label class="control-label" for="inputLevel"><?php echo __('user_lbl_level') ?></label>
	    <div class="controls">
		<select name="inputLevel" id="inputLevel" class="span3">
		    <option value="1" <?php echo set_select( 'inputLevel', '1', ( $details->level == '1') ? true : false ) ?>><?php echo __('user_sel_levelsuperadmin') ?></option>
		    <option value="2" <?php echo set_select( 'inputLevel', '2', ( $details->level == '2') ? true : false ) ?>><?php echo __('user_sel_leveladmin') ?></option>
		    <option value="3" <?php echo set_select( 'inputLevel', '3', ( $details->level == '3') ? true : false ) ?>><?php echo __('user_sel_leveluser') ?></option>
		</select>
	    </div>
	</div>
	<?php endif; ?>
	<hr class="hidden useUser" />
	<div class="control-group hidden useUser">
	    <label class="control-label" for="inputCanUpload"><?php echo __('user_lbl_canupload') ?></label>
	    <div class="controls">
		<input type="checkbox" id="inputCanUpload" name="inputCanUpload" value="1" <?php echo set_checkbox('inputCanUpload', '1', ( $details->userCanUpload == '1' ) ? true : false ); ?> /> 
	    </div>
	</div>	
	<div class="control-group hidden useUser">
	    <label class="control-label" for="inputCanDownload"><?php echo __('user_lbl_candownload') ?></label>
	    <div class="controls">
		<input type="checkbox" id="inputCanDownload" name="inputCanDownload" value="1" <?php echo set_checkbox('inputCanDownload', '1', ( $details->userCanDownload == '1' ) ? true : false ); ?> /> 
	    </div>
	</div>	
	<div class="control-group hidden useUser">
	    <label class="control-label" for="inputMaxSize"><?php echo __('user_lbl_maxsize') ?></label>
	    <div class="controls">
		<input type="text" id="inputMaxSize" name="inputMaxSize" value="<?php echo set_value( 'inputMaxSize', $details->userMaxFileSize ) ?>" class="span1" /> in Bytes ( <strong>php.ini:</strong> <?php echo roundsize( convertBytes( ini_get('upload_max_filesize') ) ) ?> )
	    </div>
	</div>	
	<div class="control-group hidden useUser">
	    <label class="control-label" for="inputMaxFiles"><?php echo __('user_lbl_maxfiles') ?></label>
	    <div class="controls">
		<input type="text" id="inputMaxFiles" name="inputMaxFiles" value="<?php echo set_value( 'inputMaxFiles', $details->userMaxNumFiles ) ?>" class="span1" />
	    </div>
	</div>	
	<div class="control-group hidden useUser">
	    <label class="control-label" for="inputAcceptTypes"><?php echo __('user_lbl_accepttypes') ?> <a href="#acceptedTypes" data-toggle="modal"><i class="icon-info-sign"></i></a></label>
	    <div class="controls">
		<input type="text" id="inputAcceptTypes" name="inputAcceptTypes" value="<?php echo set_value( 'inputAcceptTypes', stripslashes( $details->userAcceptTypes )  ) ?>" />
	    </div>
	</div>	
	<div class="control-group hidden useUser">
	    <label class="control-label" for="inputFolder"><?php echo __('user_lbl_folder') ?></label>
	    <div class="controls">
		<?php echo $folder ?>
	    </div>
	</div>	
	
	<hr class="hidden useUser" />
	<div class="control-group hidden useUser">
	    <label class="control-label" for="inputBackground"><?php echo __('user_lbl_background') ?> <a href="#bgImage" data-toggle="modal"><i class="icon-info-sign"></i></a></label>
	    <div class="controls">
		<input type="file" id="inputBackground" name="userfile" />
	    </div>
	</div>
	
	<div class="control-group hidden useUser">
	    <label class="control-label" for="inputURL"><?php echo __('user_lbl_url') ?> <a href="#userURL" data-toggle="modal"><i class="icon-info-sign"></i></a></label>
	    <div class="input-prepend inputURL">
		<span class="add-on"><?php echo site_url( '/' ) ?></span>
		<input type="text" id="inputURL" name="inputURL" value="<?php echo set_value( 'inputURL', $details->userURL ) ?>" />
	    </div>
	</div>	
	
	<div class="control-group hidden useUser">
	    <label class="control-label" for="inputEmailReceive"><?php echo __('user_lbl_recipient') ?> <a href="#emailReceive" data-toggle="modal"><i class="icon-info-sign"></i></a></label>
	    <div class="controls">
		<select name="inputEmailReceive" id="inputEmailReceive" class="span5">
		    <?php foreach( $admins AS $admin ): ?>
		    <option value="<?php echo $admin->userUniqueID ?>" <?php echo set_select( 'inputEmailReceive', $admin->userUniqueID,  ( $details->userReceiveNot ==  $admin->userUniqueID) ? true : false  ) ?>><?php echo $admin->companyName ?> ( <?php echo $admin->emailAddress ?> )</option>
		    <?php endforeach; ?>
		</select>
	    </div>
	</div>
	
	<hr class="hidden regEmail" />
	<div class="control-group hidden regEmail">
	    <label class="control-label" for="inputSendEmail"><?php echo __('user_lbl_sendregemail') ?></label>
	    <div class="controls">
		<input type="checkbox" id="inputSendEmail" name="inputSendEmail" value="sendEmail" />
	    </div>
	</div>
	
	<div class="form-actions">
	    <button type="submit" class="btn btn-primary"><?php echo __('user_btn_edit') ?></button>
	    <button type="button" class="btn" onClick="location.href='<?php echo site_url( 'admin/user/all_entries' ) ?>';" ><?php echo __('user_btn_cancel') ?></button>
	</div>	
    </form>
</div>

<?php echo $this->load->view('user/modal') ?>

<script type="text/javascript">
$(function(){
    $('#generate').click(function() {
	var allowed = 'ABCDEFGHKLMNPQRSTUVWXYZabcdefghklmnpqrstuvwxyz123456789';
	var generated = '';
	
	for ( i = 0; i < 8; i++ ) {
	    generated += allowed.charAt(Math.floor(Math.random()*allowed.length));
	}
	    
	$('.password').html('').html( generated );
	$('#inputPassword,#inputPassword2').val( generated );
	changeRegEmail();
    });
    
    $('#inputLevel').change(function() {
	changeSelect();
    });
        
    changeSelect();
    
    function changeSelect() {
	var val = $('#inputLevel').val();
	
	if( val == '3' ) {
	    $('.useUser').removeClass('hidden');
	} else {
	    $('.useUser').removeClass('hidden').addClass('hidden');
	}
    }
    
    function changeRegEmail() {
	var passlength = $('#inputPassword').val().length;
	
	if( passlength >= 6 ) {
	    $('.regEmail').removeClass('hidden');
	} else {
	    $('.regEmail').removeClass('hidden').addClass('hidden');
	}
    }
    
    changeRegEmail();
    
    $("#inputPassword").bind("keyup input paste", function() {
	changeRegEmail();
    });
});   
</script>