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

		    <div class="markcontrols" style="margin-top:30px;">
			<div class="control-group">
			    <label class="control-label" for="doAction" style="text-align:left;width:65px;"><?php echo __('files_lbl_selected') ?></label>
			    <div class="controls" style="margin-left:80px;">
				<select name="doAction" id="doAction" disabled="disabled">
				    <option value="none"><?php echo __('files_sel_pleasechoose') ?></option>
				    <option value="sendEmail"><?php echo __('files_sel_sendbyemail') ?></option>
				    <option value="publicLink"><?php echo __('files_sel_createpubliclink') ?></option>
				    <?php if( is_array( $users ) ): ?><option value="addCustomer"><?php echo __('files_sel_releaseforcust') ?></option><?php endif; ?>
				    <option value="delete"><?php echo __('files_sel_delete') ?></option>
				    <?php if( class_exists('ZipArchive') ): ?><option value="createzip"><?php echo __('files_sel_createzip') ?></option><?php endif; ?>
				</select>
			    </div>
			</div>
		    </div>
		    
		    <div class="modal hide" id="sendFileEmail">
			<div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			    <h3><?php echo __('files_head_sendemail') ?></h3>
			</div>
			<div class="modal-body">
			    <div class="alert alert-error hidden"></div>			    
			    <p><?php echo __('files_desc_sendemail') ?></p><br />
			    <div class="control-group">
				<label class="control-label" for="inputEmail"><?php echo __('files_lbl_recipient') ?></label>
				<div class="controls">
				    <input type="text" name="inputEmail" id="inputEmail" class="span4" placeholder="<?php echo __('files_ph_recipient') ?>">
				</div>
			    </div>
			    <div class="control-group">
				<label class="control-label" for="inputMessage"><?php echo __('files_lbl_message') ?></label>
				<div class="controls">
				    <textarea id="inputMessage" name="inputMessage" class="span4" rows="8" placeholder="<?php echo __('files_ph_message') ?>"></textarea>
				</div>
			    </div>
                            <div class="control-group">
                                <div class="controls">
                                    <label class="checkbox" for="inputDirectDownload"><input type="checkbox" name="inputDirectDownload" value="yes"> <?php echo __('files_lbl_ddl') ?></label>
                                </div>
                            </div>
			</div>
			<div class="modal-footer">
			    <span class="mod-left hidden"></span>
			    <a href="#" class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('files_btn_cancel') ?></a>
			    <a href="#" class="btn btn-primary" id="sendByEmail"><?php echo __('files_btn_sendemail') ?></a>
			</div>
		    </div>		    
		    
		    <div class="modal hide" id="createPublic">
			<div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			    <h3><?php echo __('files_head_publiclink') ?></h3>
			</div>
			<div class="modal-body">
			    <div class="alert alert-error hidden"></div>			    
			    <p><?php echo __('files_desc_publiclink') ?></p><br />
			    <div class="control-group">
				<label class="checkbox span2" for="inputPublicPassword"><input type="checkbox" name="optPubPassword" data-id="inputPublicPass" value="activate"> <?php echo __('files_lbl_password') ?></label>
				<div class="controls hidden" id="inputPublicPass">
				    <input type="password" name="inputPublicPassword" id="inputPublicPassword" class="span3">
				</div>
			    </div>
			    <div class="control-group">
				<label class="checkbox span2" for="inputPublicOpen"><input type="checkbox" name="optPubOpen" data-id="inputPublicAv" value="activate"> <?php echo __('files_lbl_validity') ?></label>
				<div class="controls hidden" id="inputPublicAv">
				    <select name="inputPublicDay" id="inputPublicDay" class="span1">
					<?php for( $d = 1; $d <= 31; $d++ ): ?>
					<option value="<?php echo $d ?>"<?php if( date('j') == $d ) echo ' selected="selected"'; ?>><?php echo $d ?></option>
					<?php endfor; ?>
				    </select>
				    <select name="inputPublicMonth" id="inputPublicMonth" class="span1">
					<?php for( $m = 1; $m <= 12; $m++ ): ?>
					<option value="<?php echo $m ?>"<?php if( date('n') == $m ) echo ' selected="selected"'; ?>><?php echo $m ?></option>
					<?php endfor; ?>					
				    </select>
				    <select name="inputPublicYear" id="inputPublicYear" class="span1">
					<?php for( $y = date('Y'); $y <= date('Y')+5; $y++ ): ?>
					<option value="<?php echo $y ?>"<?php if( date('Y') == $y ) echo ' selected="selected"'; ?>><?php echo $y ?></option>
					<?php endfor; ?>					
				    </select>
				</div>
			    </div>
			    <div class="control-group">
				<label class="checkbox span2" for="inputPublicLimit"><input type="checkbox" name="optPubLimit" data-id="inputPublicLim" value="activate"> <?php echo __('files_lbl_limit') ?></label>
				<div class="controls hidden" id="inputPublicLim">
				    <input type="text" name="inputPublicLimit" id="inputPublicLimit" class="span1" maxlength="4">
				</div>
			    </div>
			    <div class="control-group">
				<label class="checkbox span2" for="inputPublicMessage"><input type="checkbox" name="optPubMessage" data-id="inputPublicMsg" value="activate"> <?php echo __('files_lbl_message') ?></label>
				<div class="controls hidden" id="inputPublicMsg">
				    <textarea name="inputPublicMessage" id="inputPublicMessage" style="width:300px;height:100px;"></textarea>
				</div>
			    </div>
			</div>
			<div class="modal-footer">
			    <a href="#" class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('files_btn_cancel') ?></a>
			    <a href="#" class="btn btn-primary" id="createPublicLink"><?php echo __('files_btn_createlink') ?></a>
			</div>
		    </div>		    
		    <?php if( is_array( $users ) ): ?>
		    <div class="modal hide" id="freeUser">
			<div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			    <h3><?php echo __('files_head_releaseuser') ?></h3>
			</div>
			<div class="modal-body">
			    <div class="alert alert-error hidden"></div>			    
			    <p><?php echo __('files_desc_releaseuser') ?></p>
			    <div class="control-group">
				<label class="control-label" for="inputUser"><?php echo __('files_lbl_user') ?></label>
				<div class="controls">
				    <?php if( $users != false ): ?>
				    <select name="freeUser[]" id="inputUser" size="10" multiple="multiple">
					<?php foreach( $users AS $user ): ?>
					<option value="<?php echo $user->userUniqueID ?>"><?php echo $user->companyName ?></option>
					<?php endforeach; ?>
				    </select>
				    <?php endif; ?>
				</div>
			    </div>
			    <div class="control-group">
				<div class="controls">
				    <label class="checkbox">
					<input type="checkbox" name="informUser" value="inform"><?php echo __('files_lbl_informuser') ?>
				    </label>
				</div>
			    </div>			    
			</div>
			
			<div class="modal-footer">
			    <span class="mod-left hidden"></span>
			    <a href="#" class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('files_btn_cancel') ?></a>
			    <a href="#" class="btn btn-primary" id="freeForUser"><?php echo __('files_btn_release') ?></a>
			</div>
		    </div>		    
		    <?php endif; ?>
		    <div class="modal hide" id="deleteEntries">
			<div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			    <h3><?php echo __('files_head_delete') ?></h3>
			</div>
			<div class="modal-body">
			    <div class="alert alert-error hidden"></div>			    
			    <p><?php echo __('files_desc_delete') ?></p>
			</div>
			<div class="modal-footer">
			    <span class="mod-left hidden"></span>
			    <a href="#" class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('files_btn_cancel') ?></a>
			    <a href="#" class="btn btn-danger" id="deleteFiles"><?php echo __('files_btn_delete') ?></a>
			</div>
		    </div>		    
		    <input type="hidden" name="totalsize" id="totalsize" value="0" />
		    
		    <div class="modal hide" id="infoWindow">
			<div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			    <h3 style="text-transform:uppercase;"></h3>
			</div>
			<div class="modal-body">
			    <p></p>
			</div>
			<div class="modal-footer">
			    <span class="mod-left hidden"></span>
			    <a href="#" class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('files_btn_close') ?></a>
			</div>
		    </div>		

		    <div class="modal hide" id="ziparchive">
			<div class="modal-header">
			    <h3><?php echo __('files_head_zip') ?></h3>
			</div>
			<div class="modal-body">
                            <p>&nbsp;</p>
			    <p class="pleaseWait hidden" align="center"><img src="<?php echo base_url() ?>assets/images/progress.gif" /><br /><?php echo __('files_msg_pleasewait') ?></p>
			    <p class="downArchive hidden" align="center"><img src="<?php echo base_url() ?>assets/images/zip.png" /><br /><span><a href=""></a></span></p>
			</div>
			<div class="modal-footer">
			    <span class="mod-left hidden"></span>
			    <a href="#" class="btn hidden" data-dismiss="modal" aria-hidden="true"><?php echo __('files_btn_close') ?></a>
			</div>
		    </div>		    

		    