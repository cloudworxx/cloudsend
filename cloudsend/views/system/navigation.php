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
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
	 <div class="container">  
	     
	 <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
	 <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	 <span class="icon-bar"></span>
	 <span class="icon-bar"></span>
	 <span class="icon-bar"></span>
	 </a>	
	 
          <a class="brand" href="<?php echo site_url( 'admin/dashboard/index' ) ?>"><?php echo stripslashes( mGlobal::getConfig('PRODUCT_NAME')->configVal ) ?></a>
	  <?php if( $this->session->userdata('is_logged_in') == true ): ?>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="<?php echo uri_is( 'admin/dashboard/index' ) ?>"><a href="<?php echo site_url( 'admin/dashboard/index' ) ?>"><?php echo __('sys_navi_dashboard') ?></a></li>
              <?php if( mGlobal::getConfig('SHOW_CATFOLDER')->configVal == 'category' ): ?>
              <li class="<?php echo uri_is( 'admin/files/index' ) ?>"><a href="<?php echo site_url( 'admin/files/index' ) ?>"><?php echo __('sys_navi_files') ?></a></li>
              <?php elseif( mGlobal::getConfig('SHOW_CATFOLDER')->configVal == 'folder' ): ?>
              <li class="<?php echo uri_is( 'admin/folder/index' ) ?>"><a href="<?php echo site_url( 'admin/folder/index' ) ?>"><?php echo __('sys_navi_files') ?></a></li>
          	  <?php else: ?>
              <li class="dropdown">
			  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			      <?php echo __('sys_navi_files') ?>
			      <b class="caret"></b>
			  </a>
			  <ul class="dropdown-menu">
			      <li><a href="<?php echo site_url( 'admin/files/index' ) ?>"><?php echo __('sys_navi_files_cat') ?></a></li>
			      <li class="divider"></li>
			      <li><a href="<?php echo site_url( 'admin/folder/index' ) ?>"><?php echo __('sys_navi_files_folder') ?></a></li>
			  </ul>
		      </li>
		  	  <?php endif; ?>
              <li class="dropdown">
		  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
		      <?php echo __('sys_navi_upload') ?>
		      <b class="caret"></b>
		  </a>
		  <ul class="dropdown-menu">
		      <li><a href="<?php echo site_url( 'admin/uploads/index' ) ?>"><?php echo __('sys_navi_newupload') ?></a></li>
		      <li class="divider"></li>
		      <li><a href="<?php echo site_url( 'admin/uploads/latest' ) ?>"><?php echo __('sys_navi_lastupload') ?></a></li>
		      <li class="divider"></li>
		      <li><a href="<?php echo site_url( 'admin/import' ) ?>"><?php echo __('sys_navi_import') ?></a></li>
		  </ul>
	      </li>
              <li class="<?php echo uri_is( 'admin/publinks/all_entries' ) ?>"><a href="<?php echo site_url( 'admin/publinks/index' ) ?>"><?php echo __('sys_navi_public') ?></a></li>
              <li class="<?php echo uri_is( 'admin/pubuploads/all_entries' ) ?>"><a href="<?php echo site_url( 'admin/pubuploads/index' ) ?>"><?php echo __('sys_navi_pubupload') ?></a></li>
	      <?php if( $this->session->userdata['level'] == '1' ): ?>
              <li class="<?php echo uri_is( 'admin/user/all_entries' ) ?>"><a href="<?php echo site_url( 'admin/user/index' ) ?>"><?php echo __('sys_navi_user') ?></a></li>
	      <li>
		<form action="<?php echo site_url( 'admin/search/' ) ?>" class="navbar-form pull-left" method="post">
		    <input type="hidden" name="redirect" value="<?php echo current_url() ?>" />
		    <input type="hidden" name="limit" value="8" />
		    <input type="text" name="query" id="query" value="<?php echo set_value('query') ?>" placeholder="Search..." class="span2 typeahead" autocomplete="off">
		    <button type="submit" class="btn">Search</button>
		</form>		  
	      </li>
	      <?php endif; ?>
	    </ul>
	    <ul class="nav pull-right">
		<li class="dropdown">
		    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			<i class="icon-cog icon-white icon-large"></i>
			<b class="caret"></b>
		    </a>
		    <ul class="dropdown-menu">
			<?php if( $this->session->userdata['level'] == '1' ): ?>
			<li><a href="<?php echo site_url( 'admin/settings/index' ) ?>"><?php echo __('sys_navi_settings') ?></a></li>
			<li class="divider"></li>
			<li><a href="<?php echo site_url( 'admin/log' ) ?>"><?php echo __('sys_navi_log') ?></a></li>
			<li class="divider"></li>
			<?php endif; ?>
			<li><a href="<?php echo site_url( 'admin/user/edit_user' ) ?>"><?php echo __('sys_navi_myaccount') ?></a></li>
			<li class="divider"></li>
			<li><a href="<?php echo site_url( 'admin/account/logout' ) ?>"><?php echo __('sys_navi_logout') ?></a></li>
		    </ul>
		</li>		
	    </ul>   
          </div>
	  <?php endif; ?>
        </div>
      </div>
    </div>
<script>
$(document).ready(function() {
   $('.typeahead').typeahead({
        source: function( query, process ) {
	    $.post( '<?php echo site_url( 'admin/search/typeahead/' ) ?>', { query: query }, function( data ) {      
		process( data );
	    },'json');
        },
	matcher: function() {
	    return true;
	}
    }); 
});  
</script>