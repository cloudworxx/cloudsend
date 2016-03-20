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

<div class="container" id="topoverview">
    <div class="row" id="dashboardOverview">
	<div class="span12">
	    <div class="page-header">
		<h3><?php echo $headtitle ?></h3>
	    </div>
	    <blockquote>
		<p><?php echo __('front_desc_filelist') ?></p>
	    </blockquote>
	    <br />
	    <?php if( $files != false ): ?>
	    <table class="table table-condensed">
		<colgroup>
		    <col style="width:5%" />
		    <col style="width:35%" />
		    <col style="width:46%" />
		    <col style="width:7%" />
		    <col style="width:7%" />
		</colgroup>
		<thead>
		    <tr>
			<th></th>
			<th><?php echo __('front_lsttit_file') ?></th>
			<th></th>
			<th><?php echo __('front_lsttit_size') ?></th>
			<th><center><?php echo __('front_lsttit_available') ?></center></th>
		    </tr>
		</thead>
		<tbody>
		    <?php $_count = 1; ?>
		    <?php foreach( $files AS $_file ): ?>
		    <tr>
                        <td><?php if( is_image( $_file->fileNewName ) ): ?><a href="<?php echo site_url( $user->userURL.'/preview/full/'.$_file->fileNewName ) ?>" rel="colorbox"><?php endif; ?><img src="<?php echo site_url( $user->userURL.'/preview/icon/'.$_file->fileNewName ) ?>" /><?php if( is_image( $_file->fileNewName ) ): ?></a><?php endif; ?></td>
			<td><a href="<?php echo site_url( $user->userURL.'/download/'.$_file->fileUniqueID ) ?>"><?php echo $_file->fileName ?></a><?php if( !empty( $_file->fileMD5 ) ): ?><br /><span class="md5">MD5: <?php echo $_file->fileMD5 ?></span><?php endif; ?></td>
			<td><?php if( !empty( $_file->fileDescription ) ) echo stripslashes( $_file->fileDescription ) ?></td>
			<td><?php echo roundsize( $_file->fileSize ) ?></td>
			<td><center><a href="<?php echo site_url( $user->userURL.'/download/'.$_file->fileUniqueID ) ?>" class="btn btn-mini"><i class="icon-download-alt"></i></a></center></td>
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