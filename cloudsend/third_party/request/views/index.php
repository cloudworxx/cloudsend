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
  
  if( $showfree == 'yes' ) {
      $_span = 9;
  } else {
      $_span = 12;
  }
?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/styles/jquery.fileupload-ui.css">
<!-- Shim to make HTML5 elements usable in older Internet Explorer versions -->
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<div class="container">
    <div class="row">
	<div class="span<?php echo $_span ?>">
    
	    <div class="page-header">
		<h3><?php echo __('request_head_dashboard') ?></h3>
	    </div>
	    <blockquote>
		<?php if( !empty( $details->uploadMessage  ) ): ?>
		<p><?php echo stripslashes( $details->uploadMessage ) ?></p>
		<?php else: ?>
		<p><?php echo __('request_desc_dashboard') ?></p>
		<?php endif; ?>
	    </blockquote>
	    
	</div>
	
	<?php if( $showfree == 'yes' ): ?>
	<div class="span3">
	    <div id="diskinfo">
		<div class="page-header">
		    <h3><?php echo __('request_head_freespace') ?></h3>
		</div>

		<?php
		    $_calculate = $diskfree / $disktotal * 100;
		    $_full = 100 - $_calculate;

		    $_style = '';

		    if( $_calculate <= 20 ) {
			$_style = ' progress-warning';
		    } else if( $_calculate <= 10 ) {
			$_style = ' progress-danger';
		    } else {
			$_style = ' progress-success';
		    }
		?>

		<div class="progress<?php echo $_style ?>">
		    <div class="bar" style="width: <?php echo sprintf('%01.2f',$_full) ?>%;"></div>
		</div>		
		<div class="tac"><?php echo __('request_txt_freespace',array(roundsize( $disktotal-$diskfree ),roundsize( $disktotal ),roundsize( $diskfree ))) ?></div>
	    </div>
	</div>
	<?php endif; ?>
	
    </div>
    <?php if( $errortype != false ): ?>
    <br />
    <div class="alert alert-<?php echo $errortype ?>">
	<?php echo $errormsg ?>
    </div>
    <?php endif; ?>
    <br />
    <form id="fileupload" action="<?php echo site_url( 'request/upload' ) ?>" method="POST" enctype="multipart/form-data">
	<div class="row fileupload-buttonbar">
	    <div class="span7">
		<span class="dsbl btn fileinput-button">
		    <i class="icon-plus"></i>
		    <span><?php echo __('request_btn_choosefile') ?></span>
		    <input type="file" name="files[]" multiple>
		</span>
		<button type="submit" class="dsbl btn start">
		    <i class="icon-upload"></i>
		    <span><?php echo __('request_btn_startupload') ?></span>
		</button>
		<button type="reset" class="btn cancel">
		    <i class="icon-ban-circle"></i>
		    <span><?php echo __('request_btn_cancelupload') ?></span>
		</button>
		<button type="button" class="btn restart hidden" onClick="location.href='<?php echo site_url( 'request/'.$request ) ?>';">
		    <i class="icon-retweet"></i>
		    <span><?php echo __('request_btn_refresh') ?></span>
		</button>
	    </div>
	    <div class="span5 fileupload-progress fade">
		<div class="progress progress-success progress-striped active">
		    <div class="bar" style="width:0%;"></div>
		</div>
		<div class="progress-extended">&nbsp;</div>
	    </div>
	</div>
	<div class="fileupload-loading"></div>
	<br>
	<table class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
    </form>
    <br>
    
</div>

<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        <td class="description"><textarea name="filedesc[]" placeholder="Description"></textarea></td>
        {% if (file.error) { %}
            <td class="error" colspan="3"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
            <td>
                <div class="progress progress-success progress-striped active"><div class="bar" style="width:0%;"></div></div>
                <input type="hidden" name="filefolder[]" value="<?php echo $folder ?>">
            </td>
            <td class="start">{% if (!o.options.autoUpload) { %}
                <button class="btn">
                    <i class="icon-upload"></i>
                    <span>{%=locale.fileupload.start%}</span>
                </button>
            {% } %}</td>
        {% } else { %}
            <td colspan="2"></td>
        {% } %}
        <td class="cancel">{% if (!i) { %}
            <button class="btn">
                <i class="icon-ban-circle"></i>
                <span>{%=locale.fileupload.cancel%}</span>
            </button>
        {% } %}</td>
    </tr>
{% } %}
</script>
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        {% if (file.error) { %}
            <td></td>
            <td class="name"><span>{%=file.name%}</span></td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
        {% } else { %}
	    <td></td>
            <td class="preview">{% if (file.thumbnail_url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
            {% } %}</td>
            <td class="name">
               {%=file.name%}
            </td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% } %}
    </tr>
{% } %}
</script>
<script src="<?php echo base_url() ?>assets/scripts/libs/fileupload/vendor/jquery.ui.widget.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/libs/jquery.tmpl.min.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/libs/loadimage.min.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/libs/canvastoblob.min.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/libs/fileupload/jquery.iframe-transport.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/libs/fileupload/jquery.fileupload.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/libs/fileupload/jquery.fileupload-fp.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/libs/fileupload/jquery.fileupload-ui.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/libs/fileupload/locale.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    
    var fileResult = new Array();
    
    $('button.cancel, button.dsbl').attr('disabled','disabled');

    $('#fileupload').fileupload({
        progress: function (e, data) {
            var progress = parseInt(data.loaded / (data.total*1.1) * 100, 10);
            var bar = data.context.children().children(".progress");
            $(bar).css("width", progress + "%");
        }	
    });

    $('#fileupload') 
	.bind('fileuploadadd', function( e, data ) {
	    $('button.cancel, button.dsbl').removeAttr('disabled');
	})
	.bind('fileuploadstart', function( e, data ) {
	    $('span.dsbl, button.dsbl').attr('disabled','disabled');
	})
	.bind('fileuploaddone', function( e, data ) {
	    if( typeof( data.result[0].error ) == 'undefined' ) {
		fileResult.push(data.result[0].name+"|"+data.result[0].size);
	    }
	})
	.bind('fileuploadstop', function( e ) {
	    $('.dsbl,.btn.cancel').remove();
	    $('button.restart').removeClass('hidden');
	    $.post('<?php echo site_url( 'request/finished' ) ?>', { 'data': fileResult } );
	    $('#fileupload').fileupload({
		dropZone: false
	    });
        })
        .bind('fileuploadsubmit', function (e, data) {
		var myDescs = data.context.find('textarea');
		var myFolder = data.context.find(':input');
			
		if (myDescs.filter(function () {
				return !this.value && $(this).prop('required');
			}).first().focus().length) {
			data.context.find('button').prop('disabled', false);
			return false;
		}
		if (myFolder.filter(function () {
				return !this.value && $(this).prop('required');
			}).first().focus().length) {
			data.context.find('button').prop('disabled', false);
			return false;
		}
		var myDescsSerialized = myDescs.serializeArray();
		var myFolderSerialized = myFolder.serializeArray();
		var finalData = myDescsSerialized.concat(myDescsSerialized, myFolderSerialized);
		data.formData = finalData;        
        })

});    
</script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]><script src="<?php echo base_url() ?>assets/scripts/libs/fileupload/cors/jquery.xdr-transport.js"></script><![endif]-->