<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * CloudSend
 *
 * @package    CloudSend
 * @author     codingking.co
 * @copyright  Copyright (c) 2013 codingking.co - all rights reserved
 * @license    Commercial
 * @link       http://www.codingking.co/
 * 
 * 
 * This source file is distributed in the hope that it will be useful, but 
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY 
 * or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.
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

	<link rel="stylesheet" href="<?php echo base_url() ?>assets/styles/bootstrap.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/styles/bootstrap-responsive.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/styles/font-awesome.min.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/font-face/opensans.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/styles/colorbox.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/styles/cloudsend.css" />
	<?php if( file_exists( FCPATH.'assets'.DS.'styles'.DS.'application.css' )): ?>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/styles/application.css" />	
	<?php endif; ?>	

	<script src="<?php echo base_url() ?>assets/scripts/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>
	<script src="<?php echo base_url() ?>assets/scripts/libs/jquery-1.7.2.min.js"></script>
	<script src="<?php echo base_url() ?>assets/scripts/libs/jquery.colorbox-min.js"></script>
	<script src="<?php echo base_url() ?>assets/scripts/libs/bootstrap.js"></script>
	<script>
	    $(function() {
		$('a[rel="colorbox"]').colorbox();
	    });
	</script>
</head>
<body>


