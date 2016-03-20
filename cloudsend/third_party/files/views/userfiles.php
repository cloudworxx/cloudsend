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
<div class="container" id="files">
    <div class="row" id="filesOverview">
	<div class="span12">
	    <div class="page-header">
		<h3><?php echo __('files_head_userfiles') ?></h3>
	    </div>
	    <blockquote>
		<p><?php echo __('fiels_desc_userfiles') ?></p>
	    </blockquote>
	    <br />
	<?php if( $files != false ): ?>
    	    <form class="form-horizontal" id="fileForm">
		<fieldset>
	    
		    <table class="table table-striped table-condensed" id="fileTable">
			<thead>
			    <tr>
				<th><center><input type="checkbox" class="checkall" /></center></th>
				<th></th>
				<th><?php echo __('up_lsttit_file') ?></th>
				<th><?php echo __('up_lsttit_size') ?></th>
				<th><?php echo __('up_lsttit_uploaded') ?></th>
			    </tr>
			</thead>
			<tbody>
			    <?php foreach( $files AS $file ): ?>
			    <tr>
				<td><center><input type="checkbox" name="onefile[]" value="<?php echo $file->f2uUniqueID ?>" class="onefile" /></center></td>
                                <td><img src="<?php echo site_url( 'admin/files/preview/icon/'.$file->fileNewName ) ?>" /></td>
				<td><a href="<?php echo site_url( 'admin/files/details?entry='.$file->fileUniqueID ) ?>"><?php echo $file->fileName ?></a> <a href="<?php echo site_url( 'admin/files/download/'.$file->fileUniqueID ) ?>" class="btn btn-mini icon-cloud-download downbutton"></a><?php if( !empty( $file->fileMD5 ) ): ?><br /><span class="md5">MD5: <?php echo $file->fileMD5 ?></span><?php endif; ?></td>
				<td><?php echo roundsize($file->fileSize) ?></td>
				<td><?php echo cvTZ($file->fileTime) ?></td>
			    </tr>
			    <?php endforeach; ?>
			</tbody>
		    </table>
                    <div class='markedFiles'></div>
		    <div class="markcontrols" style="margin-top:30px;">
			<div class="control-group">
			    <label class="control-label" for="doAction" style="text-align:left;width:65px;"><?php echo __('files_lbl_selected') ?></label>
			    <div class="controls" style="margin-left:80px;">
				<select name="doAction" id="doAction" disabled="disabled">
				    <option value="none"><?php echo __('files_sel_pleasechoose') ?></option>
				    <option value="delete"><?php echo __('files_sel_del_sharing') ?></option>
				</select>
			    </div>
			</div>
		    </div>
		</fieldset>
	    </form>
	<?php else: ?>
	    <div class="alert">
		<?php echo __('up_msg_nofilesinsystem') ?> <a href="<?php echo site_url( 'admin/uploads/index' ) ?>"><?php echo __('up_msg_addthefirst') ?></a>
	    </div>
	<?php endif; ?>
	</div>
	
    </div>    
</div>	    
<div class="modal hide" id="deleteEntries">
    <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h3><?php echo __('files_head_delete') ?></h3>
    </div>
    <div class="modal-body">
	<div class="alert alert-error hidden"></div>			    
	<p><?php echo __('files_desc_delete') ?></p>
    </div>
    <div class="modal-footer">
	<span class="mod-left hidden"></span>
	<a href="#" class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('files_btn_cancel') ?></a>
	<a href="#" class="btn btn-danger" id="deleteFiles"><?php echo __('files_btn_delete') ?></a>
    </div>
</div>		    

<script src="<?php echo base_url() ?>assets/scripts/libs/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {    
    $('.checkall').click(function () {
        $(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
    });
    
    var oTable = $('#fileTable').dataTable({
	"aaSorting" : [[ 1, 'asc' ]],
	"bFilter": false,"bInfo": false,
	"bLengthChange": false,
	"oLanguage" : {
	    "sProcessing":   "<?php echo str_replace("'", "\'",__('datatbl_sProcessing')) ?>",
	    "sLengthMenu":   "<?php echo str_replace("'", "\'",__('datatbl_sLengthMenu')) ?>",
	    "sZeroRecords":  "<?php echo str_replace("'", "\'",__('datatbl_sZeroRecords')) ?>",
	    "sInfo":         "<?php echo str_replace("'", "\'",__('datatbl_sInfo')) ?>",
	    "sInfoEmpty":    "<?php echo str_replace("'", "\'",__('datatbl_sInfoEmpty')) ?>",
	    "sInfoFiltered": "<?php echo str_replace("'", "\'",__('datatbl_sInfoFiltered')) ?>",
	    "sInfoPostFix":  "<?php echo str_replace("'", "\'",__('datatbl_sInfoPostFix')) ?>",
	    "sSearch":       "<?php echo str_replace("'", "\'",__('datatbl_sSearch')) ?>",
	    "oPaginate": {
		"sFirst":    "<?php echo str_replace("'", "\'",__('datatbl_sFirst')) ?>",
		"sPrevious": "<?php echo str_replace("'", "\'",__('datatbl_sPrevious')) ?>",
		"sNext":     "<?php echo str_replace("'", "\'",__('datatbl_sNext')) ?>",
		"sLast":     "<?php echo str_replace("'", "\'",__('datatbl_sLast')) ?>"
	    }
	}
    }); 
    
    $('.onefile,.checkall').click(function() {
	setMarked();
    });
        
    function setMarked() {
        var oneMarked = false;
        
        $('.markedFiles').html('');
        
        $(".onefile", oTable.fnGetNodes()).each(function(){
            if( $(this).is(':checked') ) {
                oneMarked = true;
                $('.markedFiles').append('<input type="hidden" name="mFile[]" value="'+$(this).val()+'" />');
            }
        });

	if( oneMarked ) {
	    $('#doAction').removeAttr('disabled');
	} else {
	    $('#doAction').removeAttr('disabled').attr('disabled','disabled').val('none');
	}
    }
    

    $('#doAction').change(function(e) {
	e.preventDefault();
	var val = $(this).val();
	if( val == 'delete' ) {
	    $('#deleteEntries').modal('show');
	}
	$(this).val('none');
    });
        
    $('#deleteFiles').click(function(e) {
	e.preventDefault();
	var data = $('#fileForm').serialize();
	
	$.getJSON( '<?php echo site_url( 'admin/files/delf2u' ) ?>', data, function( info ) {
	    if( info.type == 'success' ) {
		$('.onefile').each(function() {
		    if( $(this).is(':checked') ) {
			var row = $(this).closest("tr").get(0);
			oTable.fnDeleteRow(oTable.fnGetPosition(row));
		    }
		});	
		setMarked();
	    }
	    infoWindow( 'deleteEntries', info );
	} );
    });
    
    function infoWindow( id, info ) {
	$('#'+id).modal('hide');
	$('#infoWindow .modal-header h3').html('').html( info.type );
	$('#infoWindow .modal-body p').html('').html( info.message );
	$('#infoWindow').modal('show');   
    }
    
    setMarked();
});  
</script>