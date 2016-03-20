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
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php echo ( isset( $title ) && !empty( $title ) ) ? $title . ' // ' : ''; echo stripslashes( mGlobal::getConfig('PRODUCT_NAME')->configVal ) ?></title>
	<meta name="creator" value="CloudSend by cloudworxx.us" />
	<meta name="robots" content="noindex, nofollow" />

	<meta name="viewport" content="width=device-width">

	<link rel="stylesheet" href="<?php echo base_url() ?>assets/font-face/opensans.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/styles/supersized.core.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/styles/colorbox.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/styles/frontend.css" />
	<?php if( file_exists( FCPATH.'assets'.DS.'styles'.DS.'application.css' )): ?>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/styles/application.css" />	
	<?php endif; ?>	

	<script src="<?php echo base_url() ?>assets/scripts/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>
	<script src="<?php echo base_url() ?>assets/scripts/libs/jquery-1.7.2.min.js"></script>
	<script src="<?php echo base_url() ?>assets/scripts/libs/bootstrap.js"></script>
	<script src="<?php echo base_url() ?>assets/scripts/libs/jquery.colorbox-min.js"></script>
	<script src="<?php echo base_url() ?>assets/scripts/libs/supersized.core.3.2.1.min.js"></script>
	<script>
	    $(function() {
		$('a[rel="colorbox"]').colorbox();
	    });
	</script>
</head>
<body>


