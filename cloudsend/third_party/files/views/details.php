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


 $_tags = stripslashes( $details->fileTags );
 if( empty( $_tags ) ) {
     $_show_tags = false;
 } else {
     $_show_tags = true;
     $_taglist = explode(',', $_tags);
     for( $i = 0; $i < count( $_taglist ); $i++ ) {
	 $_taglist[$i] = '"'.trim( $_taglist[$i] ).'"';
     }
 }
?>

<div class="container" id="editpublic">
    <div class="page-header">
	<h3><?php echo __('files_head_details') ?></h3>
    </div>
    <blockquote>
	<p><?php echo __('files_desc_details') ?></p>
    </blockquote>
    <br />

    <?php if( $errortype ): ?>
    <div class="alert alert-<?php echo $errortype ?>">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<?php echo $errormsg ?>
    </div>
    <?php endif; ?>

    <div class="tabbable">
	<ul id="detailTab" class="nav nav-tabs">
	    <li class="active"><a href="#general"><?php echo __('files_tab_general') ?></a></li>
	    <li><a href="#description"><?php echo __('files_tab_description') ?></a></li>
	    <li><a href="#preview"><?php echo __('files_tab_preview') ?></a></li>
	    <?php if( $userfiles != false OR $publicfiles != false ): ?><li><a href="#shared"><?php echo __('files_tab_sharing') ?></a></li><?php endif; ?>
	</ul>
    </div>
    
    <div class="tab-content">
	<div id="general" class="tab-pane active">
	    <form class="form-horizontal">	
		<div class="control-group">
		    <label class="control-label"><?php echo __('files_lbl_download') ?></label>
		    <div class="controls">
			<p><a href="<?php echo site_url( 'admin/files/download/'. $details->fileUniqueID ) ?>"><?php echo $details->fileName ?></a></p>
		    </div>
		</div>

		<div class="control-group">
		    <label class="control-label"><?php echo __('files_lbl_size') ?></label>
		    <div class="controls">
			<p><?php echo roundsize( $details->fileSize ) ?></p>
		    </div>
		</div>
				
		<?php if( !empty( $details->fileMD5 ) ): ?>
		<div class="control-group">
		    <label class="control-label"><?php echo __('files_lbl_md5') ?></label>
		    <div class="controls">
			<p><?php echo $details->fileMD5 ?></p>
		    </div>
		</div>
		<?php endif; ?>

		<div class="control-group">
		    <label class="control-label"><?php echo __('files_lbl_mime') ?></label>
		    <div class="controls">
			<p><?php echo get_mime_by_extension( $details->fileName ) ?></p>
		    </div>
		</div>

		<div class="control-group">
		    <label class="control-label"><?php echo __('files_lbl_downloads') ?></label>
		    <div class="controls">
			<p><?php echo $details->fileCounter ?></p>
		    </div>
		</div>

		<div class="control-group">
		    <label class="control-label"><?php echo __('files_lbl_ispublic') ?></label>
		    <div class="controls">
			<p><?php echo ( $details->filePublic != 0 ) ? __('files_lbl_yes') : __('files_lbl_no') ?></p>
		    </div>
		</div>

		<div class="control-group">
		    <label class="control-label"><?php echo __('files_lbl_uploadon') ?></label>
		    <div class="controls">
			<p><?php echo cvTZ( $details->fileTime ) ?></p>
		    </div>
		</div>

		<div class="control-group">
		    <label class="control-label"><?php echo __('files_lbl_uploadby') ?></label>
		    <div class="controls">
			<?php if( $details->fileUploadBy == 'UPLOADREQUEST'): ?>
			<p><?php echo __('files_txt_uploadrequest').' ('.$details->uploadRequest.')' ?></p>
			<?php else: ?>
			<p><?php echo mUser::getUser( $details->fileUploadBy )->companyName ?></p>
			<?php endif; ?>
		    </div>
		</div>
		
		<div class="control-group">
		    <label class="control-label"><?php echo __('files_lbl_tags') ?></label>
		    <div class="controls">
			<input type="text" name="tags" placeholder="Tag" class="tagManager span1" /><br /><br />
			<small><?php echo __('files_msg_tags') ?></small>
		    </div>
		</div>
		
		<div class="form-actions">
		    <button type="button" class="btn" onClick="location.href='<?php echo site_url( 'admin/files/index' ) ?>';" ><?php echo __('files_btn_back') ?></button>
		</div>			
	    </form>
	</div>
	
	<div id="description" class="tab-pane">
	    <form class="form-horizontal ajaxForm" action="<?php echo site_url( 'admin/files/save' ) ?>">
		<input type="hidden" name="inputFile" value="<?php echo $details->fileUniqueID ?>" />
		<div class="control-group">
		    <label class="control-label" for="inputDescription"><?php echo __('files_lbl_description') ?></label>
		    <div class="controls">
			<textarea name="inputDescription" id="inputDescription" class="span8" rows="8"><?php echo stripslashes( $details->fileDescription ) ?></textarea>
		    </div>
		</div>
		<div class="form-actions white">
		    <button type="submit" class="btn btn-primary"><?php echo __('files_btn_save') ?></button>
		    <button type="button" class="btn" onClick="location.href='<?php echo site_url( 'admin/files/index' ) ?>';" ><?php echo __('files_btn_back') ?></button>
		</div>	
	    </form>
	</div>

	<?php
	    $_dataName = pathinfo( $details->fileNewName, PATHINFO_FILENAME );
	    $_dataExt = pathinfo( $details->fileNewName, PATHINFO_EXTENSION );
            $_dataExtChk = strtolower( $_dataExt );
	    $_previewFile = FCPATH.'data'.DS.'thumbs'.DS.$_dataName.'.jpg';
	    $_videos = array( 'mp4','flv' );
	    $_audio = array( 'mp3', 'ogg' );
            $_text = array( 'txt', 'php', 'html', 'py', 'cgi', 'phps', 'php5', 'sh', 'css', 'js', 'xml' );
            $_pdf = array( 'pdf' );
	?>
	<div id="preview" class="tab-pane">
	    <form class="form-horizontal">
		<div class="control-group">
		    <label class="control-label"><?php echo __('files_lbl_preview') ?></label>
		    <div class="controls">
			<?php if( file_exists( $_previewFile ) ): // image preview ?>
                        
			<p><img src="<?php echo site_url( 'admin/files/preview/full/' . $details->fileNewName ) ?>" /></p>
                        
			<?php elseif( function_exists('zip_open') && function_exists('zip_read') && $_dataExtChk == 'zip' && file_exists( FCPATH.'data'.DS.'files'.DS.$details->fileNewName ) ): // zip preview ?>
			<p>
			<?php
			    if ( ( $zip = zip_open( realpath( FCPATH.'data'.DS.'files'.DS.$details->fileNewName ) ) ) )
			    {
				while ( ( $zip_entry = zip_read( $zip ) ) )
				{
				    $path = zip_entry_name( $zip_entry );
				    echo $path.'<br />'."\n";
				}
				zip_close($zip);
			    }			
			?>
			</p>
                        
			<?php elseif( in_array( $_dataExtChk, $_pdf ) && file_exists( FCPATH.'data'.DS.'files'.DS.$details->fileNewName ) ): // pdf preview ?>
                        <script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/pdfjs/src/shared/util.js"></script>
                        <script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/pdfjs/src/shared/colorspace.js"></script>
                        <script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/pdfjs/src/shared/function.js"></script>
                        <script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/pdfjs/src/shared/annotation.js"></script>
                        <script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/pdfjs/src/display/api.js"></script>
                        <script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/pdfjs/src/display/metadata.js"></script>
                        <script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/pdfjs/src/display/canvas.js"></script>
                        <script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/pdfjs/src/display/webgl.js"></script>
                        <script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/pdfjs/src/display/pattern_helper.js"></script>
                        <script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/pdfjs/src/display/font_loader.js"></script>                        
                        <script type="text/javascript">
                          PDFJS.workerSrc = '<?php echo base_url() ?>assets/scripts/libs/pdfjs/src/worker_loader.js';
                        </script>
                        
                        <script type="text/javascript">
                            'use strict';

                            PDFJS.getDocument('<?php echo site_url( 'admin/files/stream_video?file='.$details->fileNewName ) ?>').then(function(pdf) {
                              pdf.getPage(1).then(function(page) {
                                var scale = 1;
                                var viewport = page.getViewport(scale);

                                var canvas = document.getElementById('the-canvas');
                                var context = canvas.getContext('2d');
                                canvas.height = viewport.height;
                                canvas.width = viewport.width;

                                var renderContext = {
                                  canvasContext: context,
                                  viewport: viewport
                                };
                                page.render(renderContext);
                              });
                            });
                        </script>
  
                        <canvas id="the-canvas" style="border:1px solid black;"/>
                        
			<?php elseif( in_array( $_dataExtChk, $_text ) && file_exists( FCPATH.'data'.DS.'files'.DS.$details->fileNewName ) ): // text preview ?>
                        
                        <?php $_txtContent = file_get_contents(FCPATH.'data'.DS.'files'.DS.$details->fileNewName); ?>
                        <script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/syntaxhighlighter/scripts/shCore.js"></script>
                        
                        <script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/syntaxhighlighter/scripts/shBrushBash.js"></script>
                        <script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/syntaxhighlighter/scripts/shBrushCss.js"></script>
                        <script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/syntaxhighlighter/scripts/shBrushJScript.js"></script>
                        <script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/syntaxhighlighter/scripts/shBrushPerl.js"></script>
                        <script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/syntaxhighlighter/scripts/shBrushPhp.js"></script>
                        <script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/syntaxhighlighter/scripts/shBrushPlain.js"></script>
                        <script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/syntaxhighlighter/scripts/shBrushPython.js"></script>
                        <script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/syntaxhighlighter/scripts/shBrushXml.js"></script>
                        
                        <link href="<?php echo base_url() ?>assets/scripts/libs/syntaxhighlighter/styles/shCore.css" rel="stylesheet" type="text/css" />
                        <link href="<?php echo base_url() ?>assets/scripts/libs/syntaxhighlighter/styles/shThemeDefault.css" rel="stylesheet" type="text/css" />
                        <pre class="brush: <?php echo $_dataExt ?>"><?php echo htmlentities( $_txtContent ); ?></pre>
                        <script type="text/javascript">
                            SyntaxHighlighter.all()
                       </script>
			
                        <?php elseif( in_array( $_dataExtChk, $_videos ) && file_exists( FCPATH.'data'.DS.'files'.DS.$details->fileNewName ) ): // video preview ?>
			
                        <link href="http://vjs.zencdn.net/4.0/video-js.css" rel="stylesheet">
			<script src="http://vjs.zencdn.net/4.0/video.js"></script>
			<p>
			    <video id="video_1" class="video-js vjs-default-skin"
			      controls preload="auto" width="500" height="264"
			      data-setup='{"controls":true, "preload": "auto"}'>
			     <source src="<?php echo site_url( 'admin/files/stream_video?file='.$details->fileNewName ) ?>" type='video/<?php echo strtolower( $_dataExt ) ?>' />
			    </video>			    
			</p>
                        
			<?php elseif( in_array( $_dataExtChk, $_audio ) && file_exists( FCPATH.'data'.DS.'files'.DS.$details->fileNewName ) ): ?>
			
                        <style type="text/css">
			    .audiojs { height: 22px; background: #404040;
			      background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #444), color-stop(0.5, #555), color-stop(0.51, #444), color-stop(1, #444));
			      background-image: -moz-linear-gradient(center top, #444 0%, #555 50%, #444 51%, #444 100%);
			      -webkit-box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.3); -moz-box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.3);
			      -o-box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.3); box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.3); }
			    .audiojs .play-pause { width: 15px; height: 20px; padding: 0px 8px 0px 0px; }
			    .audiojs p { width: 25px; height: 20px; margin: -3px 0px 0px -1px; }
			    .audiojs .scrubber { background: #5a5a5a; width: 310px; height: 10px; margin: 5px; }
			    .audiojs .progress { height: 10px; width: 0px; background: #ccc;
			      background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #ccc), color-stop(0.5, #ddd), color-stop(0.51, #ccc), color-stop(1, #ccc));
			      background-image: -moz-linear-gradient(center top, #ccc 0%, #ddd 50%, #ccc 51%, #ccc 100%); }
			    .audiojs .loaded { height: 10px; background: #000;
			      background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #222), color-stop(0.5, #333), color-stop(0.51, #222), color-stop(1, #222));
			      background-image: -moz-linear-gradient(center top, #222 0%, #333 50%, #222 51%, #222 100%); }
			    .audiojs .time { float: left; height: 25px; line-height: 25px; }
			    .audiojs .error-message { height: 24px;line-height: 24px; }

			    .track-details { clear: both; height: 20px; width: 448px; padding: 1px 6px; background: #eee; color: #222; font-family: monospace; font-size: 11px; line-height: 20px;
			      -webkit-box-shadow: inset 1px 1px 5px rgba(0, 0, 0, 0.15); -moz-box-shadow: inset 1px 1px 5px rgba(0, 0, 0, 0.15); }
			    .track-details:before { content: '♬ '; }
			    .track-details em { font-style: normal; color: #999; }			    
			</style>			
			<script src="<?php echo base_url() ?>assets/scripts/libs/audiojs/audiojs/audio.min.js"></script>
			<script>
			  audiojs.events.ready(function() {
			    var as = audiojs.createAll();
			  });
			</script>			
			<p>
			    <audio preload="auto" src="<?php echo site_url( 'admin/files/stream_audio?file='.$details->fileNewName ) ?>" />
			</p>
			<?php else: ?>
			<p><?php echo __('files_msg_nopreview') ?></p>
			<?php endif ?>
		    </div>
		</div>
		<div class="form-actions">
		    <button type="button" class="btn" onClick="location.href='<?php echo site_url( 'admin/files/index' ) ?>';" ><?php echo __('files_btn_back') ?></button>
		</div>			
	    </form>
	</div>
	
	<?php if( $userfiles != false OR $publicfiles != false ): ?>
	<div id="shared" class="tab-pane">
	    <form class="form-horizontal">
		<?php if( $userfiles != false ): ?>
		<p>&nbsp;</p>
		<div class="control-group">
		    <label class="control-label"><?php echo __('files_lbl_user') ?></label>
		    <div class="controls">
			<table class="table table-condensed span6" style="margin-left:0px;">
			    <colgroup>
				<col style="width:5%" />
				<col style="width:80%" />
				<col style="width:15%" />
			    </colgroup>
			    <thead>
				<tr>
				    <th><?php echo __('files_lsttit_count') ?></th>
				    <th><?php echo __('files_lsttit_user') ?></th>
				    <th></th>
				</tr>
			    </thead>
			    <tbody>
				<?php $_count = 1; ?>
				<?php foreach( $userfiles AS $_file ): ?>
				<tr>
				    <td><?php echo $_count ?></td>
				    <td><?php echo $_file->companyName ?></td>
				    <td><center><a href="<?php echo site_url( 'admin/files/user/'.$_file->userUniqueID ) ?>"><?php echo __('files_lnk_allfiles') ?></a></center></td>
				</tr>
				<?php $_count++; ?>
				<?php endforeach; ?>
			    </tbody>

			</table>
		    </div>
		</div>
		<?php endif; ?>

		<?php if( $publicfiles != false ): ?>
		<p>&nbsp;</p>
		<div class="control-group">
		    <label class="control-label"><?php echo __('files_lbl_publiclink') ?></label>
		    <div class="controls">
			<table class="table table-condensed span6" style="margin-left:0px;">
			    <colgroup>
				<col style="width:5%" />
				<col style="width:80%" />
				<col style="width:15%" />
			    </colgroup>
			    <thead>
				<tr>
				    <th><?php echo __('files_lsttit_count') ?></th>
				    <th><?php echo __('files_lsttit_publiclinks') ?></th>
				    <th></th>
				</tr>
			    </thead>
			    <tbody>
				<?php $_count = 1; ?>
				<?php foreach( $publicfiles AS $_file ): ?>
				<tr>
				    <td><?php echo $_count ?></td>
				    <td><?php echo $_file->publicUUID ?></td>
				    <td><center><a href="<?php echo site_url( 'admin/publinks/edit_entry?entry='.$_file->publicUniqueID  ) ?>"><?php echo __('files_lnk_allfiles') ?></a></center></td>
				</tr>
				<?php $_count++; ?>
				<?php endforeach; ?>
			    </tbody>

			</table>
		    </div>
		</div>
		<?php endif; ?>	
		<div class="form-actions">
		    <button type="button" class="btn" onClick="location.href='<?php echo site_url( 'admin/files/index' ) ?>';" ><?php echo __('files_btn_back') ?></button>
		</div>			
	    </form>
	</div>
	<?php endif; ?>
    </div>
</div>
<script src="<?php echo base_url() ?>assets/scripts/libs/wysihtml5-0.3.0.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/libs/bootstrap-wysihtml5-0.0.2.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/libs/bootstrap-tagmanager.js"></script>	
<script type="text/javascript">
$(document).ready(function() {
    $('#inputDescription').wysihtml5({'image': 'false'});
    
    $('#detailTab a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
    });
    
    $('.tagManager').tagsManager({
	<?php if( $_show_tags ): ?> prefilled: [<?php echo implode(',',$_taglist) ?>], <?php echo "\n"; endif; ?>
	preventSubmitOnEnter: false,
	AjaxPush: '<?php echo site_url( 'admin/files/save_tags?file='.$details->fileUniqueID ) ?>'
    });
    
    $('#description .btn-primary').click(function(e) {
	e.preventDefault();
	var $this = $(this);
	$this.attr('disabled','disabled');
	$.post( $('.ajaxForm').attr('action'), $('.ajaxForm').serialize(), function( data ) {
	    $('#description .alert').remove();
	    $('#description').prepend('<div class="alert alert-'+data.type+'">'+data.message+'</div>');
	    $this.removeAttr('disabled');
	},'json');
    });
    
});
</script>