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

<div class="container myuploads" id="topoverview">
    <div class="row" id="dashboardOverview">
	<div class="span12">
	    <div class="page-header">
		<h3><?php echo $headtitle ?></h3>
	    </div>
	    <blockquote>
		<p><?php echo __('front_desc_myuploads') ?></p>
	    </blockquote>
	    <br />
	    <?php if( $files != false ): ?>
	    <table class="table table-condensed" id="fileTable">
		<colgroup>
		    <col style="width:5%" />
		    <col style="wdith:7%" />
		    <col style="width:66%" />
		    <col style="width:7%" />
		    <col style="width:15%" />
		</colgroup>
		<thead>
		    <tr>
			<th><?php echo __('front_lsttit_number') ?></th>
			<th></th>
			<th><?php echo __('front_lsttit_file') ?></th>
			<th><?php echo __('front_lsttit_size') ?></th>
			<th><center><?php echo __('front_lsttit_date') ?></center></th>
		    </tr>
		</thead>
		<tbody>
		    <?php $_count = 1; ?>
		    <?php foreach( $files AS $_file ): ?>
		    <tr>
			<td><?php echo $_count ?></td>
                        <td><?php if( is_image( $_file->fileNewName ) ): ?><a href="<?php echo site_url( $user->userURL.'/preview/full/'.$_file->fileNewName ) ?>" rel="colorbox"><?php endif; ?><img src="<?php echo site_url( $user->userURL.'/preview/icon/'.$_file->fileNewName ) ?>" /><?php if( is_image( $_file->fileNewName ) ): ?></a><?php endif; ?></td>
			<td><?php if( $user->userCanDownload == '1' ): ?><a href="<?php echo site_url( $user->userURL.'/download/'.$_file->fileUniqueID ) ?>"><?php endif; ?><?php echo shorten_string( $_file->fileName ) ?><?php if( $user->userCanDownload == '1' ): ?></a><?php endif; ?><?php if( !empty( $_file->fileMD5 ) ): ?><br /><span class="md5">MD5: <?php echo $_file->fileMD5 ?></span><?php endif; ?></td>
			<td><?php echo roundsize( $_file->fileSize ) ?></td>
			<td><center><?php echo cvTZ( $_file->fileTime, $user->timeZone, $user->timeFormat ) ?></center></td>
		    </tr>
		    <?php $_count++; ?>
		    <?php endforeach; ?>
		</tbody>
	    </table>
	    <?php else: ?>
	    <div class="alert alert-error">
		<?php echo __('front_msg_nofilesfound') ?>
	    </div>
	    <?php endif; ?>
	</div>
    </div>
</div>
<script src="<?php echo base_url() ?>assets/scripts/libs/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    var oTable = $('#fileTable').dataTable({
	"aaSorting" : [[ 1, 'asc' ]],
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
});  
</script>