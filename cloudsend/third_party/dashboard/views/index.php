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
<div class="container" id="dashboard">
    <div class="row">
        <div class="span12">
	    <div class="page-header">
		<h3><?php echo __('dash_head_dashboard') ?></h3>
	    </div>
        </div>
    </div>
    
    <div id="infobox" class="row">
        <div class="span3">
            <div class="box">
                <h2><?php echo $regUser->total ?></h2>
                <span><?php echo __('dash_lbl_usersregistered') ?></span>
                <?php if( $regUserBar != false ): ?><div class="sparkline"><?php echo implode( ',', $regUserBar ) ?></div><?php endif; ?>
                <div class="clear"></div>
            </div>
        </div>
        <div class="span3">
            <div class="box">
                <h2><?php echo $totalFiles->total ?></h2>
                <span><?php echo __('dash_lbl_filesin',stripslashes( mGlobal::getConfig('PRODUCT_NAME')->configVal )) ?></span>
                <?php if( $totalFilesBar != false ): ?><div class="sparkline"><?php echo implode( ',', $totalFilesBar ) ?></div><?php endif; ?>
                <div class="clear"></div>
            </div>
        </div>
        <div class="span3">
            <div class="box">
                <h2><?php echo roundsize( $totalFileSize->total ) ?></h2>
                <span><?php echo __('dash_lbl_totalsize') ?></span>
                <?php if( $totalFileSizeBar != false ): ?><div class="sparkline"><?php echo implode( ',', $totalFileSizeBar ) ?></div><?php endif; ?>
               <div class="clear"></div>
            </div>
        </div>
        <div class="span3">
            <div class="box">
                <h2><?php echo roundsize( $downFileSize->total ) ?></h2>
                <span><?php echo __('dash_lbl_totaldownload') ?></span>
                <?php if( $downFileSizeBar != false ): ?><div class="sparkline"><?php echo implode( ',', $downFileSizeBar ) ?></div><?php endif; ?>
               <div class="clear"></div>
            </div>
        </div>
    </div>
    
    <div class="row" id="dashboardOverview">
	<div class="span9">
	    <?php if( $errortype ): ?>
	    <div class="alert alert-<?php echo $errortype ?>">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?php echo $errormsg ?>
	    </div>
	    <?php endif; ?>	    
	    <?php if( $files != false ): ?>
	    <table class="table table-condensed">
		<thead>
		    <tr>
			<th></th>
			<th><?php echo __('dash_lsttit_file') ?></th>
			<th><?php echo __('dash_lsttit_size') ?></th>
			<th><?php echo __('dash_lsttit_sender') ?></th>
			<th><?php echo __('dash_lsttit_sendet') ?></th>
		    </tr>
		</thead>
		<tbody>
		    <?php 
			foreach( $files AS $file ): 
		    ?>
		    <tr data-file-id="<?php echo $file->fileUniqueID ?>">
            <td><?php if( is_image( $file->fileNewName ) ): ?><a href="<?php echo site_url( 'admin/files/preview/full/' . $file->fileNewName ) ?>" rel="colorbox" title="<?php echo $file->fileName ?>"><?php endif; ?><img src="<?php echo site_url( 'admin/files/preview/icon/'.$file->fileNewName ) ?>" /><?php if( is_image( $file->fileNewName ) ): ?></a><?php endif; ?></td>
			<td>
				<a href="<?php echo site_url( 'admin/files/details?entry='.$file->fileUniqueID ) ?>" title="<?php echo $file->fileName ?>" data-file-id="<?php echo $file->fileUniqueID ?>"><?php echo shorten_string( $file->fileName ) ?></a> 
				<div class="buttonline">
					<a href="<?php echo site_url( 'admin/files/download/'.$file->fileUniqueID ) ?>" class="btn btn-mini icon-cloud-download"></a> 
					<a href="javascript:void(0);" data-toggle="modal" class="btn btn-mini icon-pencil rename" data-name="<?php echo $file->fileName ?>" data-id="<?php echo $file->fileUniqueID ?>"></a>
					<a href="#" class="btn btn-mini icon-trash trash" data-id="<?php echo $file->fileUniqueID ?>"></a>
				</div>
				<?php if( !empty( $file->fileMD5 ) ): ?><br /><span class="md5">MD5: <?php echo $file->fileMD5 ?></span><?php endif; ?></td>
			<td><?php echo roundsize( $file->fileSize ) ?></td>
			<td>
			    <?php 
			    if ( empty( $file->uploadRequest ) ) {
				$_user = mUser::getUser($file->fileUploadBy)->companyName;
				if( isset( $_user ) && !empty( $_user ) ) {
				    echo $_user;
				} else {
				    echo 'n/a';
				}
			    } else {
				echo __('dash_txt_uprequest');
			    }
			    ?>
			</td>
			<td><?php echo cvTZ( $file->fileTime ) ?></td>
		    </tr>
		    <?php endforeach; ?>
		</tbody>
	    </table>
	    <?php else: ?>
	    <div class="alert">
		<?php echo __('dash_msg_noopenfiles') ?>
	    </div>
	<?php endif; ?>
	</div>
	
	<div class="span3">
	    <div id="diskinfo">
		<div class="page-header">
		    <h3><?php echo __('dash_head_freespace') ?></h3>
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
		<div class="tac"><?php echo __('dash_txt_freespace',array(roundsize( $disktotal-$diskfree ),roundsize( $disktotal ),roundsize( $diskfree ))) ?></div>
	    </div>
	</div>
    </div>    
</div>
<script src="<?php echo base_url() ?>assets/scripts/libs/jquery.sparkline.js"></script>
<script>
$(document).ready(function() {
    $('.sparkline').sparkline('html', {type: 'bar', barColor: '#395D8D' } );
});
</script>