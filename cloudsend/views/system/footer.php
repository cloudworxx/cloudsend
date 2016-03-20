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
      <footer class="footer">
	  <div class="container">
	    <p class="pull-right"><a href="#top"><?php echo __('glob_backtotop') ?></a></p>
	    <p>&copy; <?php echo date('Y') ?> <?php echo stripslashes( mGlobal::getConfig('PRODUCT_NAME')->configVal ) ?> - all rights reserved.</p>
	    <p><small>developed by <a href="http://www.cloudworxx.us">cloudworxx.us</a></small></p>
	  </div>
      </footer>

<?php if( isset( $this->session->userdata['is_logged_in'] ) && $this->session->userdata['is_logged_in'] ): ?>
<div class="modal hide" id="rename">
    <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h3><?php echo __('files_head_rename') ?></h3>
    </div>
    <div class="modal-body">
	<div class="alert alert-error hidden"></div>			    
	<p><?php echo __('files_desc_rename') ?></p><br />
	<div class="control-group">
	    <div class="controls">
		<input type="text" name="inputNewName" id="inputNewName" class="span4" value="">
		<input type="hidden" name="inputOldName" id="inputOldName" value="" />
		<input type="hidden" name="inputRenameUnique" id="inputRenameUnique" value="" />
	    </div>
	</div>
    </div>
    <div class="modal-footer">
	<span class="mod-left hidden"></span>
	<a href="#" class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('files_btn_cancel') ?></a>
	<a href="#" class="btn btn-danger" id="renameFiles"><?php echo __('files_btn_rename') ?></a>
    </div>
</div>		    

<div class="modal hide" id="trash">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?php echo __('folder_head_trash') ?></h3>
    </div>
    <div class="modal-body">
        <div class="alert alert-error hidden"></div>			    
        <p><?php echo __('folder_desc_trash') ?></p>
    </div>
    <div class="modal-footer">
        <span class="mod-left hidden"></span>
        <a href="#" class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('folder_btn_cancel') ?></a>
        <a href="#" class="btn btn-danger" id="trashFiles"><?php echo __('folder_btn_trash') ?></a>
    </div>
</div>		    

<div class="modal hide" id="trashFolder">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?php echo __('folder_head_trash') ?></h3>
    </div>
    <div class="modal-body">
        <div class="alert alert-error hidden"></div>			    
        <p><?php echo __('folder_desc_trash') ?></p>
    </div>
    <div class="modal-footer">
        <span class="mod-left hidden"></span>
        <a href="#" class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('folder_btn_cancel') ?></a>
        <a href="#" class="btn btn-danger" id="btnTrashFolder"><?php echo __('folder_btn_trash') ?></a>
    </div>
</div>		    

<script>
$(document).ready(function() {
    $('a.rename').click(function(e) {
        e.preventDefault();
        var _this = $(this);
        var _file = _this.attr('data-name');
        var _dataID = _this.attr('data-id');

        $('#rename #inputNewName').val('').val( _file );
        $('#rename #inputOldName').val('').val( _file );
        $('#rename #inputRenameUnique').val('').val( _dataID );
        $('#rename').modal('show');
    });
    
    $('a.deleteFolder').click(function(e) {
        e.preventDefault();
        var _this = $(this);

        $('#trashFolder .hiddenFolder').remove();
        $('#trashFolder').append('<input type="hidden" name="trash" value="'+_this.attr('data-folder-id')+'" class="hiddenFolder" />');
        $('#trashFolder').modal('show');
    });
    
    $('#renameFiles').click(function(e) {
        e.preventDefault();
        var _newFileName = $('#inputNewName').val();
        var _oldFileName = $('#inputOldName').val();
        var _fileID = $('#inputRenameUnique').val();

        if( _newFileName != _oldFileName ) {
            $.post( '<?php echo site_url( 'admin/files/rename' ) ?>', { fileID: _fileID, oldName: _oldFileName, newName: _newFileName }, function( data ) {
                if( data.type == 'success' ) {
                    $( 'a[data-file-id="'+_fileID+'"]' ).html('').html( _newFileName );
                    $( 'a[data-id="'+_fileID+'"]' ).attr( 'data-name', _newFileName );
                } else {
                    alert('ERROR!');
                }
            }, 'json');
        }

        $('#rename').modal('hide');
    });

    $('.trash').live('click',function(e) {
        e.preventDefault();
        var _this = $(this);

        $('#trash').append('<input type="hidden" name="trash[]" value="'+_this.attr('data-id')+'" />');
        $('#trash').modal('show');
    });

    $('#trash').on('hide',function() {
        $("#trash input[name='trash\\[\\]']").remove();
    });

    $('#trashFiles').click(function(e) {
        e.preventDefault();
        var _this = $(this);
        var _files = $("#trash input[name='trash\\[\\]']").map(function(){return $(this).val();}).get();

        if( !$('#trash .alert').hasClass('hidden') ) $('#trash .alert').html('').addClass('hidden');

        $.post('<?php echo site_url( 'admin/files/delete_ajax' ) ?>', { files: _files.toString() }, function(data) {
            if( data.type == 'success' ) {
                if( data.files != '' && data.files !== undefined && data.files != null ) {
                    var _filesArray = data.files.toString().split(',');
                    $.each(_filesArray,function( fileID ) {
                            $("tr[data-file-id='"+_filesArray[fileID]+"']").remove();
                    });
                }
                $('#trash').modal('hide');					
            } else {
                $('#trash .alert').html('').html(data.message).removeClass('hidden');
            }
        }, 'json');
    });  

    $('#btnTrashFolder').click(function(e) {
        e.preventDefault();
        var _this = $(this);
        var _folder = $("#trashFolder input[name='trash']").val();

        if( !$('#trashFolder .alert').hasClass('hidden') ) $('#trashFolder .alert').html('').addClass('hidden');

        $.post('<?php echo site_url( 'admin/folder/delete_ajax' ) ?>', { folder: _folder }, function(data) {
            if( data.type == 'success' ) {
                $("tr[data-folder-id='"+_folder+"']").remove();
                $('#trashFolder').modal('hide');					
            } else {
                $('#trashFolder .alert').html('').html(data.message).removeClass('hidden');
            }
        }, 'json');
    });  

});  
</script>
<?php endif; ?>
<?php if( !empty( mGlobal::getConfig('GOOGLE_ANALYTICS')->configVal ) ): ?>
<script type=”text/javascript”>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo mGlobal::getConfig('GOOGLE_ANALYTICS')->configVal ?>']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php endif; ?>
<!-- Page rendered in {elapsed_time} seconds -->
</body>
</html>