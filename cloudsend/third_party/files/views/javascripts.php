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
<script src="<?php echo base_url() ?>assets/scripts/libs/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/libs/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/libs/zeroclipboard.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var $_lang = new Array();
    $_lang['msgBigger'] = '<?php echo str_replace("'", "\'",__('files_msg_emailtoobig')) ?>';
    
    $('.checkall').live('click',function () {
        $(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
    });
    
    var oTable = $('#fileTable').dataTable({
        "aaSorting" : [[ 1, 'asc' ]],
        "bFilter": false,
        "oLanguage" : {
            "sProcessing":   "<?php echo str_replace("'", "\'",__('datatbl_sProcessing')) ?>",
            "sLengthMenu":   "<?php echo str_replace("'", "\'",__('datatbl_sLengthMenu')) ?>",
            "sZeroRecords":  "<?php echo str_replace("'", "\'",__('datatbl_sZeroRecords')) ?>",
            "sInfo":         "<?php echo str_replace("'", "\'",__('datatbl_sInfo')) ?>",
            "sInfoEmpty":    "<?php echo str_replace("'", "\'",__('datatbl_sInfoEmpty')) ?>",
            "sInfoFiltered": "<?php echo str_replace("'", "\'",__('datatbl_sInfoFiltered')) ?>",
            "sInfoPostFix":  "<?php echo str_replace("'", "\'",__('datatbl_sInfoPostFix')) ?>",
            "sSearch":       "<?php echo str_replace("'", "\'",__('datatbl_sSearch')) ?>",
            "oPaginate": {
                "sFirst":    "<?php echo str_replace("'", "\'",__('datatbl_sFirst')) ?>",
                "sPrevious": "<?php echo str_replace("'", "\'",__('datatbl_sPrevious')) ?>",
                "sNext":     "<?php echo str_replace("'", "\'",__('datatbl_sNext')) ?>",
                "sLast":     "<?php echo str_replace("'", "\'",__('datatbl_sLast')) ?>"
            }
        }
    }); 
    <?php if( $site == 'files/index' ): ?>

    $('#navigationTable .nav-header, a.settings')
        .mouseover(function() {
            $('a.settings').removeClass('hidden');
        })
        .mouseout(function() {
            $('a.settings').addClass('hidden');
    });

    $(oTable.fnGetNodes()).draggable({
        opacity: 0.7,
        helper: 'clone',
        connectToSortable: 'ul.nav'
    });    
    
    $('#navigationTable ul.nav li').droppable({
        tolerance: "intersect",
        accept: function( drop ) {
            if( drop.hasClass('selectable') ) return true;
        },
        drop: function( event, ui ) {
            var thisID = $(this).attr('data-cat-id');
            var id = ui.draggable.attr('data-file-id');
            if( typeof id != 'undefined' ) {
                $('#navigationTable ul.nav li.nav-header').append('<img src="<?php echo base_url() ?>assets/images/progress.gif" width="15" />');
                if( thisID != 'all' ) {
                    $.post('<?php echo site_url( 'admin/categories/file2cat' ) ?>', { file: id, cat: thisID }, function( data ) {
                        (function (el) {
                            setTimeout(function () {
                                $('div#addalert').remove();
                            }, 5000);
                        }($('#filesOverview').after('<div id="addalert" class="alert alert-'+data.type+'">'+data.message+'</div>')));		    
                    }, 'json');
                } else {
                    <?php if( isset( $catdetail ) && $catdetail != false ): ?>
                    $.post('<?php echo site_url( 'admin/categories/filedelcat' ) ?>', { file: id, cat: '<?php echo $catdetail->categoryUniqueID ?>' }, function( data ) {
                        if( data.type == 'success' ) {
                            oTable.fnDeleteRow( $('tr[data-file-id="'+id+'"]', oTable.fnGetNodes()) );
                        }
                        (function (el) {
                            setTimeout(function () {
                                $('div#remalert').remove();
                            }, 5000);
                        }($('#filesOverview').after('<div id="remalert" class="alert alert-'+data.type+'">'+data.message+'</div>')));		    
                    }, 'json');
                    <?php endif; ?>
                }
                $('#navigationTable ul.nav li.nav-header img').remove();
            }
        }
    });
    <?php endif; ?>
    
    $('.onefile,.checkall').live('click',function() {
        setMarked();
    });
    
    $('#createPublic input[type=checkbox]').click(function() {
        var $_id = $(this).attr('data-id');
        $('#'+$_id).toggleClass('hidden');
    });
    
    function setMarked() {
        var oneMarked = false;
        var total = 0;
        
        $('.markedFiles').html('');
        
        $(".onefile", oTable.fnGetNodes()).each(function(){
            if( $(this).is(':checked') ) {
                oneMarked = true;
                $('.markedFiles').append('<input type="hidden" name="mFile[]" value="'+$(this).val()+'" />');
                total += parseFloat( $(this).attr('data-size') );
            }
        });
        
        $('#totalsize').val( total );
        
        if( total > 10000000 ) {
            var msg = $_lang['msgBigger'].replace(/%size%/, bytesToSize(total));
            $('#sendFileEmail .modal-body .alert').removeClass('hidden').html('').html(msg);
        } else {
            $('#sendFileEmail .modal-body .alert').removeClass('hidden').addClass('hidden').html('');
        }


	if( oneMarked ) {
	    $('#doAction').removeAttr('disabled');
	} else {
	    $('#doAction').removeAttr('disabled').attr('disabled','disabled').val('none');
	    $('#totalsize').val('0');
	}
    }
    

    $('#doAction').change(function(e) {
        e.preventDefault();
        var val = $(this).val();
        if( val == 'sendEmail' ) {
            $('#sendFileEmail').modal('show');
        } else if( val == 'addCustomer' ) {
            $('#freeUser').modal('show');
        } else if( val == 'delete' ) {
            $('#deleteEntries').modal('show');
        } else if( val == 'publicLink' ) {
            $('#createPublic').modal('show');
        } else if( val == 'createzip' ) {
        $('#ziparchive .pleaseWait').removeClass('hidden');
        $('#ziparchive .downArchive').removeClass('hidden').addClass('hidden');			
        $('#ziparchive .modal-footer .btn').removeClass('hidden').addClass('hidden');
                $('#ziparchive').modal({ backdrop: 'static' },'show');
                generateArchive();
        }

        $(this).val('none');
    });

    function generateArchive() {
    	var data = $('#fileForm').serialize();
    	
    	$.post('<?php echo site_url( 'admin/files/create_archive' ) ?>', data, function( info ) {
            if( info.type == 'success' ) {
                $('#ziparchive .pleaseWait').addClass('hidden');
                $('#ziparchive .downArchive').removeClass('hidden').find('span').html('').html(info.download);
                $('#ziparchive .modal-footer .btn.hidden').removeClass('hidden');
                $('input.downfolder').remove();
                $('body').prepend('<input type="hidden" name="downfolder" value="'+info.downfolder+'" class="downfolder">');
            } else {
                infoWindow('ziparchive',info);
            }
    	});
    }

    $('#ziparchive').on('hide',function() {
    	var zipfile = $('input.downfolder').val();
        
        $.post('<?php echo site_url( 'admin/files/remove_archive' ) ?>', { zipfile: zipfile }, function( data ) {
            if( data.type == 'success' ) {
                $('input.downfolder').remove();
            }
        });
    });
    
    function bytesToSize(bytes) {
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (bytes == 0) return 'n/a';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
    }; 
	    
    $('#freeForUser').click(function(e) {
        e.preventDefault();
        var data = $('#fileForm').serialize();
        var selected = $('#inputUser option:selected').length;

        if( selected != 0 ) {
            $.getJSON( '<?php echo site_url( 'admin/files/setrights' ) ?>', data, function( info ) {
                infoWindow( 'freeUser', info );
            } );
        }
    });
    
    $('#deleteFiles').click(function(e) {
        e.preventDefault();
        var data = $('#fileForm').serialize();

        $.getJSON( '<?php echo site_url( 'admin/files/deletefiles' ) ?>', data, function( info ) {
            if( info.type == 'success' ) {
                $(".onefile", oTable.fnGetNodes()).each(function(){
                    if( $(this).is(':checked') ) {
                        var row = $(this).closest("tr").get(0);
                        oTable.fnDeleteRow(oTable.fnGetPosition(row));
                        $(this).removeAttr('checked');
                    }
                });
                setMarked();
            }
            infoWindow( 'deleteEntries', info );
        } );
    });
    
    $('#sendByEmail').click(function(e) {
        e.preventDefault();
        var data = $('#fileForm').serialize();

        $.getJSON( '<?php echo site_url( 'admin/files/sendbyemail' ) ?>', data, function( info ) {
            if( info.type == 'success' ) {
                $('#inputEmail,#inputMessage').val('');
            }
            infoWindow( 'sendFileEmail', info );
        } );
    });
    
    $('#createPublicLink').click(function(e) {
        e.preventDefault();
        var data = $('#fileForm').serialize();

        $.getJSON( '<?php echo site_url( 'admin/files/createpublic' ) ?>', data, function( info ) {
            if( info.type == 'success' ) {
                $('#inputPublicPassword,#inputPublicLimit').val('');
                $('#inputPublicDay').val('<?php echo date('j') ?>');
                $('#inputPublicMonth').val('<?php echo date('n') ?>');
                $('#inputPublicYear').val('<?php echo date('Y') ?>');
                $('#createPublic input[type=checkbox]').removeAttr('checked');
                $('#createPublic .controls').removeClass('hidden').addClass('hidden');
            }
            infoWindow( 'createPublic', info );
        } );	
    });
    
    function infoWindow( id, info ) {
        $('#'+id).modal('hide');
        $('#infoWindow .modal-header h3').html('').html( info.type );
        $('#infoWindow .modal-body p').html('').html( info.message );
        var cpyClip = new ZeroClipboard( document.getElementById("copy-button"), {
            moviePath: "<?php echo base_url() ?>assets/scripts/libs/ZeroClipboard.swf"
        });   

        cpyClip.on( 'complete', function( client, args ) {
            this.innerHTML = '<?php echo __('copy_to_clipboard_copied') ?>';
        });

        $('#infoWindow').modal('show');   
    }   

    setMarked();
});  
</script>