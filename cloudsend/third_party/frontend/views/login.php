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

<div id="login">
    <div class="header">
	<h3><?php echo __('front_head_welcome') ?>, <small><?php echo $user->companyName ?></small></h3>
    </div>

    <div class="box">
	<form name="loginForm" action="<?php echo site_url( $user->userURL.'/verify') ?>" method="post" class="form-horizontal">
	    <input type="hidden" name="userID" value="<?php echo $user->userUniqueID ?>" />
	    <div class="control-group">
		<label class="control-label" for="inputPassword"><?php echo __('front_lbl_password') ?></label>
		<div class="controls">
		    <input type="password" id="inputPassword" name="inputPassword" />
		</div>
	    </div>
	    <div class="control-group">
		<div class="controls">
		    <button type="submit" class="btn"><i class="icon-user"></i> <?php echo __('front_btn_login') ?></button>
		</div>
	    </div>
	</form>	
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {    
    <?php if( !empty( $user->userFile ) && file_exists( FCPATH.'data'.DS.'backgrounds'.DS.$user->userFile ) ): ?> 
    $.supersized({  
	slides  :  [ { image : '<?php echo site_url( 'stream/'.$user->userFile ) ?>' } ]
    });
    <?php elseif( file_exists( FCPATH.'data'.DS.'backgrounds'.DS.'default_1.4.jpg' ) ) : ?>
    $.supersized({  
	slides  :  [ { image : '<?php echo site_url( 'stream/default_1.4.jpg' ) ?>' } ]
    });
    <?php endif; ?>
    $('button.btn').click(function(e) {
	e.preventDefault();
	$('form div.alert').remove();
	$.post( $('form[name=loginForm]').attr('action'), $('form[name=loginForm]').serialize(), function( e ) {
	   if( e.type == 'error' ) {
	       $('form').prepend('<div class="alert alert-error">'+e.message+'</div>');
	   } else {
	       location.reload();
	       window.location.reload(true);
	   }
	},'json');
    });
    
});  
</script>