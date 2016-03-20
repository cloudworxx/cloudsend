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

<?php if( isset( $this->session->userdata['frontlogin'] ) && $this->session->userdata['frontlogin'] == true && isset( $this->session->userdata['frontuser'] ) ): ?>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">	  
	 <div class="container">
	    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    </a>		  
	     
	    <a href="javascript:void(0);" class="brand"><?php echo stripslashes( mGlobal::getConfig('PRODUCT_NAME')->configVal ) ?></a>
	    <div class="nav-collapse collapse">
		<ul class="nav">
		<?php if( $user->userCanUpload == '1' ): ?>
		<li class="<?php echo uri_is( $user->userURL ) ?>"><a href="<?php echo site_url( $user->userURL ) ?>"><?php echo __('front_navi_dashboard') ?></a></li>
		<?php endif; ?>
		<li class="dropdown">
		    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			<?php echo __('front_navi_downloads') ?>
			<b class="caret"></b>
		    </a>
		    <ul class="dropdown-menu">
			<li><a href="<?php echo site_url( $user->userURL.'/publicfiles' ) ?>"><?php echo __('front_navi_public') ?></a></li>
			<li class="divider"></li>
			<li><a href="<?php echo site_url( $user->userURL.'/userfiles' ) ?>"><?php echo __('front_navi_user') ?></a></li>
		    </ul>
		</li>
		<?php if( $user->userCanUpload == '1' ): ?>
		<li class="<?php echo uri_is( $user->userURL.'/uploads' ) ?>"><a href="<?php echo site_url( $user->userURL.'/uploads' ) ?>"><?php echo __('front_navi_uploads') ?></a></li>
		<?php endif; ?>
		</ul>
		<ul class="nav pull-right">
		    <li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
			    <i class="icon-cog icon-white icon-large"></i>
			    <b class="caret"></b>
			</a>
			<ul class="dropdown-menu">
			    <li><a href="<?php echo site_url( $user->userURL.'/settings' ) ?>"><?php echo __('front_navi_settings') ?></a></li>
			    <li class="divider"></li>
			    <li><a href="<?php echo site_url( $user->userURL.'/logout' ) ?>"><?php echo __('front_navi_logout') ?></a></li>
			</ul>
		    </li>		
		</ul>
	    </div>
         </div>
      </div>
    </div>
<?php endif; ?>