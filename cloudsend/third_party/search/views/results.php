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
		<h3><?php echo __('srch_head_results') ?></h3>
	    </div>
	    <blockquote>
		<p><?php echo __('srch_desc_results', $search) ?></p>
	    </blockquote>
	    <br />
    	    <form class="form-horizontal" id="fileForm">
		<fieldset>
	    
		    <table class="table table-striped table-condensed" id="fileTable">
			<thead>
			    <tr>
				<th><center><input type="checkbox" class="checkall" /></center></th>
				<th></th>
				<th><?php echo __('srch_lsttit_file') ?></th>
				<th><?php echo __('srch_lsttit_size') ?></th>
				<th><?php echo __('srch_lsttit_uploaded') ?></th>
				<th><center><?php echo __('srch_lsttit_downloads') ?></center></th>
				<th style="width:80px;"><center><?php echo __('srch_lsttit_public') ?></center></th>
			    </tr>
			</thead>
			<tbody>
			    <?php foreach( $files AS $file ): ?>
			    <?php
				if( $file->filePublic == '0' ) {
				    $_icon = 'icon-lock icon-large';
				} else {
				    $_icon = 'icon-unlock icon-large';
				}
			    ?>
			    <tr>
				<td><center><input type="checkbox" name="onefile[]" data-size="<?php echo $file->fileSize ?>" value="<?php echo $file->fileUniqueID ?>" class="onefile" /></center></td>
				<td><?php if( is_image( $file->fileNewName ) ): ?><a href="<?php echo site_url( 'admin/files/preview/full/' . $file->fileNewName ) ?>" rel="colorbox" title="<?php echo $file->fileName ?>"><?php endif; ?><img src="<?php echo site_url( 'admin/files/preview/icon/'.$file->fileNewName ) ?>" /><?php if( is_image( $file->fileNewName ) ): ?></a><?php endif; ?></td>
				<td><a href="<?php echo site_url( 'admin/files/details?entry='.$file->fileUniqueID ) ?>" data-file-id="<?php echo $file->fileUniqueID ?>"><?php echo $file->fileName ?></a>  <div class="buttonline"><a href="<?php echo site_url( 'admin/files/download/'.$file->fileUniqueID ) ?>" class="btn btn-mini icon-cloud-download"></a> <a href="javascript:void(0);" data-toggle="modal" data-name="<?php echo $file->fileName ?>" data-id="<?php echo $file->fileUniqueID ?>" class="btn btn-mini icon-pencil rename"></a></div><?php if( !empty( $file->fileMD5 ) ): ?><br /><span class="md5">MD5: <?php echo $file->fileMD5 ?></span><?php endif; ?></td>
				<td><?php echo roundsize($file->fileSize) ?></td>
				<td><?php echo cvTZ($file->fileTime) ?></td>
				<td><center><?php echo $file->fileCounter ?></center></td>
				<td><center><a href="<?php echo site_url( 'admin/files/published/'.$file->fileUniqueID ) ?>" class="publish"><i class="<?php echo $_icon ?>"></i></a></center></td>
			    </tr>
			    <?php endforeach; ?>
			</tbody>
		    </table>
                    <div class='markedFiles'></div>
		    <?php echo $this->load->view('files/modal_actions') ?>
		</fieldset>
	    </form>
	</div>
	
    </div>    
</div>	    

<?php echo $this->load->view('files/javascripts') ?>