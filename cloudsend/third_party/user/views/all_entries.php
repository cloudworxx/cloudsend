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
		<h3><?php echo __('user_head_alluser') ?></h3>
		<button class="btn btn-primary" onClick="location.href='<?php echo site_url( 'admin/user/add_user' ) ?>';"><span class="icon-plus icon-white"></span> <?php echo __('user_btn_adduser') ?></button>
	    </div>
	    <blockquote>
		<p><?php echo __('user_desc_alluser') ?></p>
	    </blockquote>
	    <br />
	    <?php if( $errortype ): ?>
	    <div class="alert alert-<?php echo $errortype ?>">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?php echo $errormsg ?>
	    </div>
	    <?php endif; ?>
	    <table class="table table-bordered table-condensed">
		<colgroup>
		    <col style="width:5%" />
		    <col style="width:25%" />
		    <col style="width:44%" />
		    <col style="width:10%" />
		    <col style="width:10%" />
		    <col style="width:8%" />
		    <col style="width:8%" />
		</colgroup>
		<thead>
		    <tr>
			<th class="tac"><?php echo __('user_lsttit_count') ?></th>
			<th><?php echo __('user_lsttit_name') ?></th>
			<th><?php echo __('user_lsttit_email') ?></th>
			<th><?php echo __('user_lsttit_level') ?></th>
			<th><?php echo __('user_lsttit_sharing') ?></th>
			<th class="tac"><?php echo __('user_lsttit_access') ?></th>
			<th class="tac"><?php echo __('user_lsttit_actions') ?></th>
		    </tr>
		</thead>
		<tbody>
		<?php if( $items != false ): ?>
		<?php $i = 0; ?>
		<?php foreach( $items AS $item ): ?>
		<?php
		    switch( $item->level ):
			case '1':
			    $_level = __('user_txt_levelsuperadmin');
			    break;
			case '2':
			    $_level = __('user_txt_leveladmin');
			    break;
			default:
			    $_level = __('user_txt_leveluser');
			    break;
		    endswitch;	
		    
		    $_totalFiles = $this->mFiles->getUserFiles( $item->userUniqueID );
		?>
		    <tr>
			<td class="tac"><?php echo $i+1 ?></td>
			<td><a href="<?php echo site_url( 'admin/user/edit_user?user='.$item->userUniqueID ) ?>"><?php echo stripslashes( $item->companyName ) ?></a></td>
			<td><?php echo stripslashes( $item->emailAddress ) ?></td>
			<td><?php echo $_level ?></td>
			<td><?php echo ( $_totalFiles != false ) ? '<a href="'.site_url( 'admin/files/user/'. $item->userUniqueID ).'">'.count( $_totalFiles ).' '.( count( $_totalFiles == 1 ) ? __('user_txt_file') : __('usr_txt_files')).'</a>' : __('user_txt_nofiles') ?></td>
			<td class="tac">
			    <a href="<?php echo site_url( 'admin/user/published_user?is='.$item->published.'&user='.$item->userUniqueID ) ?>">
				<i class="icon-<?php echo ($item->published == 1 ) ? 'ok' : 'remove' ?>"></i>
			    </a>
			</td>
			<td class="tac">
			    <a href="<?php echo site_url( 'admin/user/delete_user?user='.$item->userUniqueID ) ?>" class="tip confirm" title="<?php echo __('user_txt_delete') ?>">
				<i class="icon-remove"></i>
			    </a>
			</td>
		    </tr>
		    <?php $i++; ?>
		<?php endforeach; ?>
		<?php else: ?>
		    <tr>
			<td colspan="7" class="tac"><?php echo __('user_msg_nouserfound') ?> <a href="<?php echo site_url( 'admin/user/add_user' ) ?>"><?php echo __('user_msg_createthefirst') ?></a></td>
		    </tr>
		<?php endif; ?>
		</tbody>
	    </table>
	</div>
    </div>
</div>
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
});  
</script>