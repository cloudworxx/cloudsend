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

if( !function_exists('__')) {
		
	function __( $line, $sprintf = '', $language = NULL ) {
		$CI =& get_instance();			
		if( empty( $language ) ) $language = $CI->mGlobal->getConfig('SYSTEM_LANGUAGE')->configVal;
		$CI->lang->load($language,$language);
			
		if(empty($sprintf)) {
			$return = $CI->lang->line( $line ); 
		} else {
			$content = $CI->lang->line( $line );
			$return = vsprintf( $content, $sprintf );
		}
			
		if(empty($return)) {
			$std_language = APPPATH.'language/'.trim($language).'/'.$language.'_lang.php';

			if(file_exists($std_language)) {
				require $std_language;
				
				if(array_key_exists($line ,$lang)) {
					if(empty($sprintf)) {
						$return = $lang[$line];
					} else {
						$return = vsprintf( $lang[$line], $sprintf );
					}
				} else {
					$return = $line;
				}
			} else {
				$return = $line;
			}
		}
		
		return $return;
	
	}
		
}
?>