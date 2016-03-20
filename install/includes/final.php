<?php  if ( ! defined('INSTALLER')) exit('No direct script access allowed');
/**
 * CloudSend
 *
 * CloudSend was created for companies such as agencies that must constantly send files to the same customers or receive files from the same customers.
 *
 * @package    CloudSend installer
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
error_reporting(0);

if( isset( $_POST['do']) && $_POST['do'] == 'install' ) {
    $_error = array();
    
    
    $_contentConfig = file_get_contents( 'install/files/config.php' );
    $_contentDatabase = file_get_contents( 'install/files/database.php' );
    
    foreach( $_SESSION AS $key => $value ) {
	$_contentConfig = str_replace( '{'.$key.'}', $value, $_contentConfig );
	$_contentDatabase = str_replace( '{'.$key.'}', $value, $_contentDatabase );
    }
    
    $_writeConfig = file_put_contents( 'cloudsend/config/config.php', $_contentConfig );
    if( !$_writeConfig ) $_error[] = 'File cloudsend/config/config.php could not be created!';
    
    $_writeDatabase = file_put_contents( 'cloudsend/config/database.php', $_contentDatabase );
    if( !$_writeDatabase ) $_error[] = 'File cloudsend/config/database.php could not be created!';

    $_connID = mysql_connect( $_SESSION['inst_db_host'], $_SESSION['inst_db_user'], $_SESSION['inst_db_pass'] );
    
    if( $_connID ) {
	$_dataSelect = mysql_select_db( $_SESSION['inst_db_data'], $_connID );
	
	if( $_dataSelect ) {
	    $_sqlContent = file( 'install/files/cloudsend.sql' );
	    
	    $query = "";
	    foreach( $_sqlContent AS $_sqlLine ){
		if( trim( $_sqlLine ) != "" && strpos( $_sqlLine, "--" ) === false ){
		    $query .= $_sqlLine;
		    if (substr( rtrim( $query ), -1 ) == ';' ) {
			foreach( $_SESSION AS $_key => $_value ) {
			    $query = str_replace( '{'.$_key.'}', $_value, $query );
			}
			$_querySql = mysql_query( $query );
			if( !$_querySql ) $_error[] = 'SQL query error: '.mysql_error();
			$query = "";
		    }
		}
	     }    	    
	} else {
	    $_error[] = 'Database selection was not possible.';
	}
    } else {
	$_error[] = 'Connection to database server was not possible.';
    }
    
    if( count( $_error ) == 0 ) {
	$_return = array(
	    'status' => 'success'
	);
    } else {
	$_return = array(
	    'status' => 'error',
	    'message' => implode( '<br />', $_error )
	);
    }
    
    header('Content-Type: application/json');
    echo json_encode( $_return );
    exit;
}

function encryption_key($length = 90) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $count = strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= substr($chars, $index, 1);
    }

    return $result;
}

$_SESSION['inst_user_unique'] = uniqid( 'usr_', true );
$_SESSION['inst_time_created'] = time();
$_SESSION['inst_admin_md5pass'] = md5( $_SESSION['inst_admin_pass'] );
$_SESSION['inst_encryption_key'] = encryption_key();
?>
<h2 class="finalheader">Install</h2>
<p>All necessary information collected. Press the button to start installation:</p>	
<p>&nbsp;</p>
<button class="btn" href="#" id="doinstall"> Install CloudSend</button>
<p>&nbsp;</p>
<?php if( empty( $_SESSION['inst_nice_urls'] ) ): ?>
<p>You have chosen to use nice URLs. To make them work, you have to create a .htaccess in the root of your CloudSend installation with the following content:</p>
<div id="htaccess" class="box">RewriteEngine On<br />
RewriteBase <?php echo str_replace('install.php?step=final','',$_SERVER['REQUEST_URI']) ?><br />
<br />
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f<br />
RewriteCond %{REQUEST_FILENAME} !-d<br />
RewriteRule ^(.*)$ index.php?/$1 [L]<br /><br /></div>
<?php endif; ?>
<script type="text/javascript">
$(document).ready(function() {
    $('#doinstall').click(function() {
	$('<span>').addClass('icon-spinner icon-spin').prependTo('button.btn');
	$('button.btn').attr('disabled','disabled');
	
	$.post( 'install.php?step=final&nohead', { do: 'install' }, function( data ) {
	    if( data.status == 'success' ) {
		$('#navigation').html('<a class="btn fr" href="<?php echo $_SESSION['inst_app_domain'].( ( !empty( $_SESSION['inst_nice_urls']) ) ? $_SESSION['inst_nice_urls'].'/' : '' ).'admin/account/login' ?>">Login to admin &raquo;</a>');
		$('#doinstall').html('CloudSend successfully installed');
	    } else {
		$('.finalheader').append('<div class="alert alert-error">'+data.message+'</div>');
		$('button.btn').find('span').remove();
		$('button.btn').removeAttr('disabled');
	    }
	},'json');
    });
});  
</script>
