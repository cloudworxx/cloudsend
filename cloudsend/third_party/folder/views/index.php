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
<div class="container" id="folderList">
    <div class="row" id="folderOverview">
	<div class="span12">
	    <div class="page-header">
		<h3><?php echo __('folder_head_files') ?></h3>
		<button class="btn btn-primary" onClick="location.href='<?php echo site_url( 'admin/folder/add_folder' ) ?>';"><span class="icon-plus icon-white"></span> <?php echo __('folder_btn_addfolder') ?></button>
	    </div>
	    <br />
	    <?php if( $errortype ): ?>
	    <div class="alert alert-<?php echo $errortype ?>">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?php echo $errormsg ?>
	    </div>
	    <?php endif; ?>
	    <?php echo $breadcrumb ?>
	    <form class="form-horizontal" id="fileForm">
		<fieldset>

	    <table class="table table-condensed">
		<colgroup>
		    <col style="width:5%" />
		    <col style="width:5%" />
		    <col style="width:65%" />
		    <col style="width:10%" />
		    <col style="width:10%" />
		    <col style="width:5%" />
		</colgroup>
		<thead>
		    <tr>
                        <th><center><input type="checkbox" class="checkall" /></center></th>
                        <th></th>
                        <th><?php echo __('folder_lsttit_name') ?></th>
                        <th><?php echo __('folder_lsttit_size') ?></th>
                        <th class="tac"><?php echo __('folder_lsttit_date') ?></th>
                        <th class="tac"></th>
		    </tr>
		</thead>
		<tbody>
		<?php if( $files != false OR $folders != false ): ?>
		<?php if( $folders != false ): ?>
		<?php foreach( $folders AS $folder ): ?>
                    <?php 
                        $_filesFound = mFolder::countFilesInFolder( $folder->folderUniqueID ); 
                        $_folderFound = mFolder::getFolder( $folder->folderUniqueID );
                    ?>
		    <tr data-folder-id="<?php echo $folder->folderUniqueID ?>">
                        <td></td>
                        <td><img src="<?php echo base_url() ?>assets/images/32px/folder.png" /></td>
                        <td><a href="#" class="changefolder" data-folder-id="<?php echo $folder->folderUniqueID ?>" data-folder-title="<?php echo $folder->folderUniqueID ?>"><?php echo stripslashes( $folder->folderTitle ) ?></a><br /><span class="small"><?php echo ( $_filesFound == 0 OR empty( $_filesFound ) ) ? __('folder_msg_noobjects') : __( 'folder_msg_objectsfound', $_filesFound ) ?></span></td>
                        <td>n/a</td>
                        <td><?php echo cvTZ( $folder->folderTime ) ?></td>
                        <td class="tac">
                            <div class="btn-group">
                                <a class="btn btn-mini" href="#"><i class="icon-folder-open"></i></a>
                                <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" class="changefolder" data-folder-id="<?php echo $folder->folderUniqueID ?>"><i class="icon-folder-open"></i> Open</a></li>
                                    <li class="divider"></li>
                                    <?php if( $_filesFound == 0 AND empty( $_filesFound ) AND $_folderFound == false ): ?>
                                    <li><a href="#" class="deleteFolder" data-folder-name="<?php echo $folder->folderTitle ?>" data-folder-id="<?php echo $folder->folderUniqueID ?>"><i class="icon-trash"></i> Delete</a></li>
                                        <?php endif; ?>
                                    <li><a href="#" class="renamefolder" data-folder-name="<?php echo $folder->folderTitle ?>" data-folder-id="<?php echo $folder->folderUniqueID ?>"><i class="icon-edit"></i> Rename</a></li>
                                </ul>
                            </div>
                        </td>
		    </tr>
		<?php endforeach; ?>
		<?php endif; ?>
		    
		<?php if( $files != false ): ?>
		<?php foreach( $files AS $file ): ?>
		    <tr data-file-id="<?php echo $file->fileUniqueID ?>">
				<td><center><input type="checkbox" name="onefile[]" data-size="<?php echo $file->fileSize ?>" value="<?php echo $file->fileUniqueID ?>" class="onefile" /></center></td>
	            <td><?php if( is_image( $file->fileNewName ) ): ?><a href="<?php echo site_url( 'admin/files/preview/full/' . $file->fileNewName ) ?>" rel="colorbox" title="<?php echo $file->fileName ?>"><?php endif; ?><img src="<?php echo site_url( 'admin/files/preview/icon/'.$file->fileNewName ) ?>" /><?php if( is_image( $file->fileNewName ) ): ?></a><?php endif; ?></td>
				<td>
					<a href="<?php echo site_url( 'admin/files/details?entry='.$file->fileUniqueID ) ?>" data-file-id="<?php echo $file->fileUniqueID ?>"><?php echo shorten_string( stripslashes( $file->fileName ), 80 ) ?></a>  
					<div class="buttonline">
						<a href="<?php echo site_url( 'admin/files/download/'.$file->fileUniqueID ) ?>" class="btn btn-mini icon-cloud-download"></a> 
						<a href="javascript:void(0);" data-toggle="modal" class="btn btn-mini icon-pencil rename" data-name="<?php echo $file->fileName ?>" data-id="<?php echo $file->fileUniqueID ?>"></a> 
						<a href="#" class="btn btn-mini icon-trash trash" data-id="<?php echo $file->fileUniqueID ?>"></a> 
						<a href="<?php echo site_url( 'admin/files/move/'.$file->fileUniqueID ) ?>" class="btn btn-mini icon-move move" data-id="<?php echo $file->fileUniqueID ?>"></a>
					</div>
					<?php if( !empty( $file->fileMD5 ) ): ?><br /><span class="md5">MD5: <?php echo $file->fileMD5 ?></span><?php endif; ?></td>
				<td><?php echo roundsize( $file->fileSize ) ?></td>
				<td><?php echo cvTZ( $file->fileTime ) ?></td>
				<td class="tac"></td>
		    </tr>
		<?php endforeach; ?>
		<?php endif; ?>	
		<?php else: ?>
		    <tr>
			<td colspan="5" class="tac"><?php echo __('folder_msg_notfound') ?></td>
		    </tr>
		<?php endif; ?>
		</tbody>
	    </table>
	    <?php echo $this->load->view('files/modal_actions') ?>
		</fieldset>
		</form>
	</div>
    </div>
</div>
<div class="modal hide" id="renameFolder">
    <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h3><?php echo __('folder_head_rename') ?></h3>
    </div>
    <div class="modal-body">
	<div class="alert alert-error hidden"></div>			    
	<p><?php echo __('folder_desc_rename') ?></p><br />
	<div class="control-group">
	    <div class="controls">
		<input type="text" name="folderNewName" id="folderNewName" class="span4" value="">
		<input type="hidden" name="folderOldName" id="folderOldName" value="" />
		<input type="hidden" name="folderRenameUnique" id="folderRenameUnique" value="" />
	    </div>
	</div>
    </div>
    <div class="modal-footer">
	<span class="mod-left hidden"></span>
	<a href="#" class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('files_btn_cancel') ?></a>
	<a href="#" class="btn btn-danger" id="btnRenameFolder"><?php echo __('files_btn_rename') ?></a>
    </div>
</div>		    

<div class="modal hide" id="move">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?php echo __('folder_head_move') ?></h3>
    </div>
    <div class="modal-body">
		<div class="alert alert-error hidden"></div>			    
		<p><?php echo __('folder_desc_move') ?></p><br />
		<div class="control-group">
		    <div class="controls">
		    	<?php echo $folderList ?>
		    </div>
		</div>
    </div>
    <div class="modal-footer">
		<span class="mod-left hidden"></span>
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('folder_btn_cancel') ?></a>
		<a href="#" class="btn btn-danger" id="moveFiles"><?php echo __('folder_btn_move') ?></a>
    </div>
</div>		    

<?php echo $this->load->view('javascripts') ?>
<script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/jquery.confirm.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('a.confirm').click(function(event) {
        location.href = $(this).attr('href');
    }).confirm({
        msg: '<?php echo __('user_txt_sure') ?><br />',
        buttons: {
            ok: '<?php echo __('user_txt_yes') ?>',
            cancel: '<?php echo __('user_txt_no') ?>',
            separator: ' / '	    
        }
    }); 
    
    $('a.renamefolder').click(function(e) {
        e.preventDefault();
        var _this = $(this);
        var _folder = _this.attr('data-folder-name');
        var _dataID = _this.attr('data-folder-id');

        $('#renameFolder #folderNewName').val('').val( _folder );
        $('#renameFolder #folderOldName').val('').val( _folder );
        $('#renameFolder #folderRenameUnique').val('').val( _dataID );
        $('#renameFolder').modal('show');
    });
    
    $('#btnRenameFolder').click(function(e) {
        e.preventDefault();
        var _newFolderName = $('#folderNewName').val();
        var _oldFolderName = $('#folderOldName').val();
        var _folderID = $('#folderRenameUnique').val();

        if( _newFolderName != _oldFolderName ) {
            $.post( '<?php echo site_url( 'admin/folder/rename' ) ?>', { folderID: _folderID, oldName: _oldFolderName, newName: _newFolderName }, function( data ) {
                if( data.type == 'success' ) {
                    $( 'a[data-folder-title="'+_folderID+'"]' ).html('').html( _newFolderName );
                    $( 'a[data-folder-id="'+_folderID+'"]' ).attr( 'data-name', _newFolderName );
                } else {
                    alert('ERROR!');
                }
            }, 'json');
        }

        $('#renameFolder').modal('hide');
    });


    $('.changefolder').click(function() {
    	var $_this = $(this);
    	var $_folderID = $_this.attr('data-folder-id');

    	$.post('<?php echo site_url( 'admin/folder/change' ) ?>', { folderUnique: $_folderID }, function( data ) {
            if( data.type == 'success' ) {
                var $_href = '<?php echo site_url( 'admin/folder/index' ) ?>';
            } else {
                var $_href = '<?php echo site_url( 'admin/folder/index' ) ?>?errortype='+data.type+'&errormsg='+data.message;
            }

            document.location.href=$_href;
            location.href=$_href;
    	},'json');
    });

    $('a.move').click(function(e) {
    	e.preventDefault();
    	var _this = $(this);

    	$('#move').append('<input type="hidden" name="moving[]" value="'+_this.attr('data-id')+'" />');
    	$('#move').modal('show');
    });

    $('#moveFiles').click(function(e) {
        e.preventDefault();
        var _this = $(this);
        var _files = $("#move input[name='moving\\[\\]']").map(function(){return $(this).val();}).get();
        var _folder = $("#move select#inputParent").val();

        if( !$('#move .alert').hasClass('hidden') ) $('#move .alert').html('').addClass('hidden');

        if( _folder == '' || _folder === undefined || _folder == null) {
            $('#move .alert').html('').html('<?php echo __('folder_msg_notchosen') ?>').removeClass('hidden');
        } else {
            $.post('<?php echo site_url( 'admin/folder/move_files' ) ?>', { folder: _folder, files: _files.toString() }, function(data) {
                if( data.type == 'success' ) {
                    if( data.files != '' && data.files !== undefined && data.files != null ) {
                        var _filesArray = data.files.toString().split(',');
                        $.each(_filesArray,function( fileID ) {
                            $("tr[data-file-id='"+_filesArray[fileID]+"']").remove();
                        });
                    }
                    $('#move').modal('hide');					
                } else {
                    $('#move .alert').html('').html(data.message).removeClass('hidden');
                }
            }, 'json');
        }
    });  

    $('#move').on('hide',function() {
        $("#move input[name='moving\\[\\]']").remove();
    });

});  
</script>