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

/** Bootstrap Typeahead extension - thanks to @jcroll - http://stackoverflow.com/a/18471203 **/
 $.fn.typeahead.Constructor.prototype.select = function() {
    var val = this.$menu.find('.active').attr('data-value');
    if (val) {
        this.$element
            .val(this.updater(val))
            .change();
    }
    return this.hide()
};
var newRender = function(items) {
    var that = this

    items = $(items).map(function (i, item) {
        i = $(that.options.item).attr('data-value', item);
        i.find('a').html(that.highlighter(item));
        return i[0];
    });

    this.$menu.html(items);
    return this;
};
$.fn.typeahead.Constructor.prototype.render = newRender;

/** CloudSend application scripts **/
$(document).ready(function() {
    
    /** Scroll to top **/
    $('a[href=#top]').click(function(){
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });   
    
    /** Colorbox **/
    $('a[rel="colorbox"]').colorbox();
    
    /** Open link in new tab **/
    $('a[rel="newtab"]').click(function() {
        $(this).target = "_blank";
        window.open($(this).prop('href'));
        return false;
    });

    /** set publishing **/
    $('a.publish').click(function(e) {
	e.preventDefault();
	var $this = $(this);
	var link = $this.attr('href');
	
	$.getJSON( link, function( result ) {
	    if( result.type == 'success' ) {
		$this.html('').html('<i class="'+result.icon+'"></i>');
	    } else {
		alert( result.message );
	    }
	});
	
    });

    /** set autodelete **/
    $('a.autodelete').click(function(e) {
	e.preventDefault();
	var $this = $(this);
	var link = $this.attr('href');
	
	$.getJSON( link, function( result ) {
	    if( result.type == 'success' ) {
		$this.html('').html('<i class="'+result.icon+'"></i>');
		$this.removeAttr('title').attr("title",result.info);
	    } else {
		alert( result.message );
	    }
	});
	
    });
   
});
