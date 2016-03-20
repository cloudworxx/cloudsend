<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
	    <?php if( $errortype ): ?>
	    <div class="alert alert-<?php echo $errortype ?>">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?php echo $errormsg ?>
	    </div>
	    <?php endif; ?>
	    <div class="page-header">
		<h3><?php echo __('import_head_import') ?> <small>( <?php echo (is_array( $files )) ? count( $files ) : '0' ?> )</small></h3>
		<?php if( count( $files ) != 0 ): ?><button class="btn btn-primary" onClick="location.href='<?php echo site_url( 'admin/import/import_files' ) ?>';"><span class="icon-cloud-upload icon-white"></span> <?php echo __('import_btn_import') ?></button><?php endif; ?>	
	    </div>
	    <blockquote>
		<p><?php echo __('import_desc_import') ?></p>
	    </blockquote>
	</div>
	
    </div>
    
    <div class="row">
	<div class="span12">
	<?php if( $files != false AND count( $files ) != 0 ): ?>
	    <form class="form-horizontal" id="fileForm">
		<fieldset>
		    <table class="table table-striped table-condensed" id="fileTable">
			<thead>
			    <tr>
				<th><?php echo __('import_lsttit_file') ?></th>
				<th><?php echo __('import_lsttit_size') ?></th>
			    </tr>
			</thead>
			<tbody>
			    <?php for( $i = 0; $i < count( $files ); $i++ ): ?>
			    <tr >
				<td><?php echo $files[$i] ?></td>
				<td><?php echo roundsize( filesize( FCPATH.'data'.DS.'import'.DS.$files[$i] ) ) ?></td>
			    </tr>
			    <?php endfor; ?>
			</tbody>
		    </table>		    
		</fieldset>
	    </form>
	<?php else: ?>
	    <div class="alert alert-info">
		<?php echo __('import_msg_nofilesfound') ?>
	    </div>
	<?php endif; ?>
	</div>	
    </div>
</div>
<script src="<?php echo base_url() ?>assets/scripts/libs/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {    
    var oTable = $('#fileTable').dataTable({
	"aaSorting" : [[ 1, 'asc' ]],
	"bFilter": false,
	"oLanguage" : {
	    "sProcessing":   "<?php echo __('datatbl_sProcessing') ?>",
	    "sLengthMenu":   "<?php echo __('datatbl_sLengthMenu') ?>",
	    "sZeroRecords":  "<?php echo __('datatbl_sZeroRecords') ?>",
	    "sInfo":         "<?php echo __('datatbl_sInfo') ?>",
	    "sInfoEmpty":    "<?php echo __('datatbl_sInfoEmpty') ?>",
	    "sInfoFiltered": "<?php echo __('datatbl_sInfoFiltered') ?>",
	    "sInfoPostFix":  "<?php echo __('datatbl_sInfoPostFix') ?>",
	    "sSearch":       "<?php echo __('datatbl_sSearch') ?>",
	    "oPaginate": {
		"sFirst":    "<?php echo __('datatbl_sFirst') ?>",
		"sPrevious": "<?php echo __('datatbl_sPrevious') ?>",
		"sNext":     "<?php echo __('datatbl_sNext') ?>",
		"sLast":     "<?php echo __('datatbl_sLast') ?>"
	    }
	}
    }); 
    
    $('.btn-primary').click(function() {
	var $_std = 'icon-cloud-upload';
	var $_this = $(this);
	if( $_this.find('span').hasClass($_std) ) {
	    $_this.find('span').removeClass($_std).addClass('icon-spinner icon-spin');
	} else {
	    $_this.find('span').removeClass('icon-spinner icon-spin').addClass($_std);
	}
    });    
});  
</script>