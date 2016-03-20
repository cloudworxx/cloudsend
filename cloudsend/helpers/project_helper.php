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
 
 if( !function_exists( 'uri_is' ) ) {
     
     function uri_is( $url = '', $return = 'active' ) {
		 if( isset( $url ) ) {
		    $CI =& get_instance();
		    $_uri_string = $CI->uri->uri_string();
		    
		    if( $_uri_string == $url ) {
			return $return;
		    }
		 }	 
     }
     
 }
 
 if( !function_exists( 'roundsize' ) ) {
     
    function roundsize($size){
		$i = 0;
		$iec = array( "B", "KB", "MB", "GB", "TB" );
		
		while( ( $size/1024 ) > 1 ) {
		    $size = $size / 1024;
		    $i++;
		}
		
		return( round( $size, 1 )." ".$iec[$i] );
    }
    
 } 
 
 if( !function_exists( 'convertBytes' ) ) {
    /**
    * Convert a shorthand byte value from a PHP configuration directive to an integer value
    * 
    * by http://www.php.net/manual/en/faq.using.php#faq.using.shorthandbytes
    * 
    * @param    string   $value
    * @return   int
    */
    function convertBytes( $value ) {
		if ( is_numeric( $value ) ) {
		    return $value;
		} else {
		    $value_length = strlen( $value );
		    $qty = substr( $value, 0, $value_length - 1 );
		    $unit = strtolower( substr( $value, $value_length - 1 ) );
		    switch ( $unit ) {
			case 'k':
			    $qty *= 1024;
			    break;
			case 'm':
			    $qty *= 1048576;
			    break;
			case 'g':
			    $qty *= 1073741824;
			    break;
		    }
		    return $qty;
		}
    }    
 }
 
 
 if( !function_exists( 'shorten_string' ) ) {
     
     function shorten_string( $_string = NULL, $_length = '40', $_inner = '...' ) {
		 if( !empty( $_string ) ) {
		     if(strlen($_string)>$_length) {
			 return substr($_string,0,$_length-10).$_inner.substr($_string,-10);
		     }
		     
		     return $_string;
		 }
		 
		 return false;
     }
     
 }
 
 if( !function_exists('is_image') ) { // UPDATE: v 1.2
     
     function is_image( $_file = NULL ) {
		 if( !empty( $_file ) ) {
		     $_type = pathinfo( $_file, PATHINFO_EXTENSION );
		     $_type = strtolower( $_type );
		     
		     $_images = array( 'jpg', 'jpeg', 'gif', 'jpg', 'png' );
		     
		     if( in_array( $_type, $_images ) ) {
			 return true;
		     }
		 }
		 
		 return false;
     }
     
 } 