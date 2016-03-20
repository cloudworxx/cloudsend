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

if(!function_exists('timezone_select')) {
	
	function timezone_select($selected = '', $class = '', $name = 'timezone', $id = 'timezone') {
		# Output option list, HTML.
		$opt = '<select name="'.$name.'" id="'.$id.'"';
		if(!empty($class)) $opt .= ' class="'.$class.'"';
		$opt .= '>'."\n";
		
		$regions = array('Africa', 'America', 'Antarctica', 'Arctic', 'Asia', 'Atlantic', 'Australia', 'Europe', 'Indian', 'Pacific');
		$tzs = timezone_identifiers_list();
		$optgroup = '';
		sort($tzs);
		foreach ($tzs as $tz) {
		    $z = explode('/', $tz, 2);
		    # timezone_identifiers_list() returns a number of
		    # backwards-compatibility entries. This filters them out of the 
		    # list presented to the user.
		    if (count($z) != 2 || !in_array($z[0], $regions)) continue;
		    if ($optgroup != $z[0]) {
		        if ($optgroup !== '') $opt .= '</optgroup>';
		        $optgroup = $z[0];
		        $opt .= "\n\t".'<optgroup label="' . htmlentities($z[0]) . '">'."\n";
		    }
		    $opt .= "\t\t".'<option value="' . htmlentities($tz) . '" label="' . htmlentities(str_replace('_', ' ', $z[1])) . '"';
		    if(isset($selected) && !empty($selected) && $selected != NULL) {
		    	if(htmlentities($tz) == $selected) $opt .= ' selected="selected" ';
		    }
		    $opt .= '>' . htmlentities(str_replace('_', ' ', $tz)) . '</option>'."\n";
		}
		if ($optgroup !== '') $opt .= "\t\t".'</optgroup>'."\n".'</select>';
		
		echo $opt;
	}
	
}


if( !function_exists('cvTZ') ) {
    
    function cvTZ( $timestamp = 0, $timezone = NULL, $dateformat = NULL ) {
        if( $timestamp != 0 ) {
            if( $timezone == NULL ) {
                $_ci =& get_instance();
                $timezone = $_ci->session->userdata('timeZone');
            }
	    
	    date_default_timezone_set( $timezone );
            
            if( $dateformat == NULL ) {
                $_ci =& get_instance();
                $dateformat = $_ci->session->userdata('timeFormat');
            }
            
            $date = new DateTime("@".$timestamp);  // will snap to UTC because of the "@timezone" syntax
            $date->setTimezone(new DateTimeZone( $timezone ));  
            $_return = $date->format( $dateformat );
            return $_return;
        } else {
            return false;
        }
    }
    
}
