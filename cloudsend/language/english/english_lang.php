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

// global
$lang['glob_backtotop']		    = 'to top';
$lang['copy_to_clipboard']	    = 'Copy to Clipboard';
$lang['copy_to_clipboard_copied']   = 'Copied to Clipboard';
$lang['new_cloudsend_version']	    = 'A new CloudSend version ( %s ) has been released. Please update for getting new exciting functions.'; // UPDATE 1.2

// system navigation
$lang['sys_navi_dashboard']	    = 'Dashboard';
$lang['sys_navi_files']		    = 'Files';
$lang['sys_navi_files_cat']	    = 'Category View'; // UPDATE 1.4
$lang['sys_navi_files_folder']	    = 'Folder View'; // UPDATE 1.4
$lang['sys_navi_upload']	    = 'Upload';
$lang['sys_navi_newupload']	    = 'New Upload';
$lang['sys_navi_lastupload']	    = 'Latest Upload';
$lang['sys_navi_public']	    = 'Public';
$lang['sys_navi_pubupload']	    = 'Upload Request'; // UPDATE 1.3
$lang['sys_navi_import']	    = 'Folder Import'; // UPDATE 1.3
$lang['sys_navi_user']		    = 'Access';
$lang['sys_navi_settings']	    = 'Settings';
$lang['sys_navi_myaccount']	    = 'My Account';
$lang['sys_navi_log']		    = 'Log'; // UPDATE 1.3
$lang['sys_navi_logout']	    = 'Logout';

// frontend controller
$lang['front_title_welcome']	    = 'Welcome';
$lang['front_title_404notfound']    = '404 Not Found';
$lang['front_title_login']	    = 'Login';
$lang['front_title_publicdownloads']= 'Public Downloads';
$lang['front_title_userdownloads']  = 'User Downloads';
$lang['front_title_myuploads']	    = 'My Uploads';

$lang['front_lbl_password']	    = 'Password';
$lang['front_lbl_user']		    = 'User';

$lang['front_btn_login']	    = 'Login';

$lang['front_msg_novalidpassword']  = 'Password invalid. Please try again';

$lang['front_head_dashboard']	    = 'Dashboard';
$lang['front_head_error']	    = '404';
$lang['front_head_notfound']	    = '404 Not Found!';
$lang['front_head_welcome']	    = 'Welcome';

$lang['front_desc_dashboard']	    = 'Please choose a file by clicking "Choose File". You are also able to use Drag&Drop with the latest Firefox, Chrome or IE.<br /><br />Max. upload size: %s';
$lang['front_desc_error']	    = 'An error occured. Please contact the administrator of the website.';
$lang['front_desc_notfound']	    = 'Your request couldn\'t be completed. Please contact the administrator of the website.';
$lang['front_desc_filelist']	    = 'These files are shared. Click on the filename or the icon to start the download.';
$lang['front_desc_myuploads']	    = 'The following files are already uploaded by you. Thank you.';
$lang['front_desc_welcome']	    = 'Please contact the administrator to ask for access.';

$lang['front_btn_choosefile']	    = 'Choose File';
$lang['front_btn_startupload']	    = 'Start Upload';
$lang['front_btn_cancelupload']	    = 'Cancel Upload';

$lang['front_msg_uploadsuccess']    = 'The Upload was successfull.';
$lang['front_msg_nofilesfound']	    = 'No valid files found. Perhaps an error occured or the download has expired.';

$lang['front_lsttit_number']	    = '#';
$lang['front_lsttit_file']	    = 'File';
$lang['front_lsttit_date']	    = 'Uploaded';
$lang['front_lsttit_size']	    = 'Size';
$lang['front_lsttit_available']	    = 'Available';

$lang['front_navi_dashboard']	    = 'Dashboard';
$lang['front_navi_downloads']	    = 'Downloads';
$lang['front_navi_uploads']	    = 'My Uploads';
$lang['front_navi_public']	    = 'Public';
$lang['front_navi_user']	    = 'User';
$lang['front_navi_settings']	    = 'Settings';
$lang['front_navi_logout']	    = 'Logout';

// public link controller
$lang['public_title_publiclink']    = 'Public Link';
$lang['public_title_linklogin']	    = 'Public Link - Login';
$lang['public_title_login']	    = 'Login';

$lang['public_lbl_password']	    = 'Password';
$lang['public_lbl_link']	    = 'Link';

$lang['public_btn_login']	    = 'Login';

$lang['public_msg_novalidpassword'] = 'Passwort invalid. Please try again.';

$lang['public_head_dashboard']	    = 'Dashboard';
$lang['public_head_error']	    = '404';
$lang['public_head_forbidden']	    = '403 Forbidden';
$lang['public_head_public']	    = 'Public Downloads';

$lang['public_desc_dashboard']	    = 'Please choose a file by clicking "Choose File". You are also able to use Drag&Drop with the latest Firefox, Chrome or IE.';
$lang['public_desc_error']	    = 'An error occured. Please contact the administrator of the website.';
$lang['public_desc_forbidden']	    = 'Your request couldn\'t be completed. Please contact the sender of the link.';
$lang['public_desc_filelist']	    = 'The following files are shared by a public link. Click on the filename or the icon to start the download.';

$lang['public_msg_nofilesfound']    = 'No valid files found for these public link. Perhaps an error occured or the download has expired.';

$lang['public_lsttit_number']	    = '#';
$lang['public_lsttit_file']	    = 'File';
$lang['public_lsttit_size']	    = 'Size';
$lang['public_lsttit_available']    = 'Available';


// login screen
$lang['account_title_login']	    = 'Login';

$lang['account_head_login']	    = 'Admin Login';

$lang['account_lbl_email']	    = 'Your Email';
$lang['account_lbl_password']	    = 'Your Password';

$lang['account_btn_signin']	    = 'Login';

$lang['account_msg_login']	    = 'Please enter your account credentials.';
$lang['account_msg_loginerror']	    = 'Username/Password combination not found. Please try again.';

// dashboard
$lang['dash_title_dashboard']	    = 'Dashboard';
$lang['dash_title_restricted']	    = 'Restricted Access';

$lang['dash_head_forbidden']	    = '403 Forbidden';
$lang['dash_head_dashboard']	    = 'Dashboard';
$lang['dash_head_freespace']	    = 'Free Space';

$lang['dash_lbl_usersregistered']   = 'Users Registered'; // UPDATE 1.4
$lang['dash_lbl_filesin']           = 'Files in %s'; // UPDATE 1.4
$lang['dash_lbl_totalsize']         = 'Total Size of Files'; // UPDATE 1.4
$lang['dash_lbl_totaldownload']     = 'Total Download Size'; // UPDATE 1.4

$lang['dash_desc_forbidden']	    = 'Sorry, you don\'t have access to the requested resource. Please contact the administrator of the website.';
$lang['dash_desc_dashboard']	    = 'The dashboard shows the latest uploaded files from your users.';

$lang['dash_lsttit_count']	    = '#';
$lang['dash_lsttit_file']	    = 'File';
$lang['dash_lsttit_size']	    = 'Size';
$lang['dash_lsttit_sender']	    = 'Sender';
$lang['dash_lsttit_sendet']	    = 'Sent by';

$lang['dash_link_overview']	    = 'Back to Overview';

$lang['dash_txt_freespace']	    = '%s of %s used, <strong>%s free</strong>';
$lang['dash_txt_uprequest']	    = 'by Upload Request'; // UPDATE 1.3

$lang['dash_msg_noopenfiles']	    = 'No files uploaded by users.';
    
// files
$lang['files_title_files']	    = 'Files';
$lang['files_title_details']        = 'Fileinfo';
$lang['files_title_cats']	    = 'Categories'; // UPDATE 1.2

$lang['files_head_files']	    = 'All Files';
$lang['files_head_sendemail']	    = 'Send Email';
$lang['files_head_publiclink']	    = 'Create Public Link';
$lang['files_head_releaseuser']	    = 'Share with User';
$lang['files_head_delete']	    = 'Delete?';
$lang['files_head_details']         = 'File Information';
$lang['files_head_userfiles']	    = 'Userfiles'; // UPDATE 1.3
$lang['files_head_rename']	    = 'Rename'; // UPDATE 1.4
$lang['files_head_zip']			= 'Create ZIP Archive'; // UPDATE 1.4

$lang['files_desc_files']	    = 'The following files are already uploaded to the system. You can categorize by Drag&Drop.';
$lang['files_desc_sendemail']	    = 'Please enter the recipient:';
$lang['files_desc_publiclink']	    = 'Please choose an option for the link:';
$lang['files_desc_releaseuser']	    = 'Please select the user to share the file with:<br /><small>( you can choose more than one by CTRL + Click )</small>';
$lang['files_desc_delete']	    = 'The selected file(s) will be deleted? Are you sure?';
$lang['files_desc_details']         = 'The following information is saved for the file:';
$lang['fiels_desc_userfiles']	    = 'The following files are shared with the user.'; // UPDATE 1.3
$lang['files_desc_rename']	    = 'Just modify the filename and save.'; // UPDATE 1.4

$lang['files_lsttit_file']	    = 'File';
$lang['files_lsttit_size']	    = 'Size';
$lang['files_lsttit_uploaded']	    = 'Uploaded';
$lang['files_lsttit_downloads']	    = 'Downloads';
$lang['files_lsttit_public']	    = 'Public';
$lang['files_lsttit_count']	    = '#';
$lang['files_lsttit_user']	    = 'User';
$lang['files_lsttit_publiclinks']   = 'Public Link';

$lang['files_lnk_allfiles']	    = 'All Files'; // UDPATE 1.2

$lang['files_lbl_selected']	    = 'Selected:';
$lang['files_lbl_recipient']	    = 'Recipient:';
$lang['files_lbl_message']	    = 'Message';
$lang['files_lbl_password']	    = 'Password';
$lang['files_lbl_validity']	    = 'Valid until';
$lang['files_lbl_limit']	    = 'Limit';
$lang['files_lbl_user']		    = 'User:';
$lang['files_lbl_informuser']	    = 'Inform user by email about new files?';
$lang['files_lbl_download']	    = 'Download:';
$lang['files_lbl_size']		    = 'Filesize:';
$lang['files_lbl_uploadon']	    = 'Uploaded on:';
$lang['files_lbl_uploadby']	    = 'Uploaded by:';
$lang['files_lbl_ispublic']	    = 'Public ?';
$lang['files_lbl_downloads']	    = 'Downloads:';
$lang['files_lbl_yes']		    = 'Yes';
$lang['files_lbl_no']		    = 'No';
$lang['files_lbl_mime']		    = 'Filetype:';
$lang['files_lbl_user']		    = 'Shared for user:';
$lang['files_lbl_publiclink']	    = 'Shared by public link:';
$lang['files_lbl_preview']	    = 'Preview';
$lang['files_lbl_description']	    = 'File description';
$lang['files_lbl_tags']		    = 'Tags'; // UPDATE 1.2
$lang['files_lbl_md5']              = 'MD5'; // UDPATE 1.4
$lang['files_lbl_ddl']              = 'Direct Download instead of attachment<br /><small>( it automatically creates a public link )</small>'; // UDPATE 1.4

$lang['files_txt_uploadrequest']    = 'Upload Request'; // UPDATE 1.3

$lang['files_ph_recipient']	    = 'Email Address';
$lang['files_ph_message']	    = 'Please enter your Message';

$lang['files_sel_pleasechoose']	    = 'Please choose...';
$lang['files_sel_sendbyemail']	    = 'Send by Email';
$lang['files_sel_createpubliclink'] = 'Create Public Link';
$lang['files_sel_releaseforcust']   = 'Share with user';
$lang['files_sel_delete']	    = 'Delete';
$lang['files_sel_del_sharing']	    = 'Remove Sharing';
$lang['files_sel_category']	    = 'Select Category'; // UPDATE 1.3
$lang['files_sel_createzip']	= 'Create Archive'; // UPDATE 1.4

$lang['files_btn_cancel']	    = 'Cancel';
$lang['files_btn_sendemail']	    = 'Send Email';
$lang['files_btn_createlink']	    = 'Create Link';
$lang['files_btn_release']	    = 'Share';
$lang['files_btn_delete']	    = 'Delete';
$lang['files_btn_close']	    = 'Close';
$lang['files_btn_back']             = 'Go Back';
$lang['files_btn_save']             = 'Save';
$lang['files_btn_rename']	    = 'Rename'; // UPDATE 1.4

$lang['files_msg_fileupdatesuccess']= 'The file was updated successfully.';
$lang['files_msg_fileupdateerror']  = 'An error occured. Please try again!';
$lang['files_msg_filenotfound']	    = 'The file could not be found!'; 
$lang['files_msg_fileproblem']	    = 'There\'s a problem with the file.';
$lang['files_msg_noajaxrequest']    = 'No Ajax Request';
$lang['files_msg_accesssuccess']    = 'Sharing was created successfully.';
$lang['files_msg_successnoemail']   = 'Sharing was created successfully, but the email couldn\'t be sent.';
$lang['files_msg_transmitproblem']  = 'A problem with the transfer occured...';
$lang['files_msg_dbremovefailed']   = '%s could not be removed from database. Action cancelled.';
$lang['files_msg_unlinkfailed']	    = '%s could not be deleted. Action cancelled';
$lang['files_msg_notexists']	    = '%s does not exist. Action cancelled!';
$lang['files_msg_notfoundindb']	    = 'The file could not be found in the database!';
$lang['files_msg_deleteproblems']   = 'Some problems occured while trying to delete the files<br />%s';
$lang['files_msg_deletesuccess']    = 'Files deleted successfully.';
$lang['files_msg_emailsendsuccess'] = 'The email was sent successfully.';
$lang['files_msg_emailsenderror']   = 'The email could not be sent.';
$lang['files_msg_releaseproblems']  = 'Some problems occured while creating the public sharing link.';
$lang['files_msg_pubcreateproblems']= 'The public link couldn\'t be created. Please try again.';
$lang['files_msg_pubcreatesuccess'] = '<strong>The public link was created successfully</strong>:<br /><br /><a href="%s">%s</a>';
$lang['files_msg_nofilesinsystem']  = 'There are no files in the system.';
$lang['files_msg_addthefirst']	    = 'Add the first.';
$lang['files_msg_emailtoobig']	    = 'The attachment is bigger than <strong>%size%</strong>. There could be problems with sending the email! Please use a public link.'; // you have to add %size% - this value is replaced by javascript with the actual size of all files!
$lang['files_msg_nouser']	    = 'The user was not added to the request!';
$lang['files_msg_nopreview']	    = 'No preview available.';
$lang['files_msg_noajax']	    = 'Not an ajax request. Cancelled.';
$lang['files_msg_descsuccess']	    = 'Description successfully updated.';
$lang['files_msg_descerror']	    = 'An error occured while trying to update.';
$lang['files_msg_tags']		    = 'Seperate Tags by comma (,) - tags saved automatically'; // UPDATE 1.2
$lang['files_msg_parammissing']	    = 'At least one parameter is missing.'; // UPDATE 1.4
$lang['files_msg_renamesuccess']    = 'File successfully renamed.'; // UPDATE 1.4
$lang['files_msg_renameerror']	    = 'An error occured while trying to rename the file.'; // UPDATE 1.4
$lang['files_msg_pleasewait']		= 'Please wait...'; // UPDATE 1.4
$lang['files_msg_zipfolderexists']	= 'The temporary folder exists. Please try again.'; // UPDATE 1.4
$lang['files_msg_zipnotcreated']	= 'The ZIP file could not be created.'; // UPDATE 1.4
$lang['files_msg_zipfoldcreate']	= 'The ZIP folder could not be created.'; // UPDATE 1.4
$lang['files_msg_ziperrorfound']	= 'An error occured during ZIP creation. Please try again.'; // UPDATE 1.4
$lang['files_msg_zipnotadded']		= 'The following files could not be added to the ZIP archive:<br />%s'; // UPDATE 1.4

$lang['files_tab_general']	    = 'General';
$lang['files_tab_preview']	    = 'Preview';
$lang['files_tab_sharing']	    = 'Sharing';
$lang['files_tab_description']	    = 'Description';

// Folder
$lang['folder_title_files']	    = 'All Files';
$lang['folder_title_add']		= 'Add Folder';

$lang['folder_head_files']	    = 'All Files';
$lang['folder_head_add']		= 'Add Folder';
$lang['folder_head_move']		= 'Move';
$lang['folder_head_trash']		= 'Delete';
$lang['folder_head_rename']		= 'Rename Folder';

$lang['folder_desc_files']	    = 'The following files are uploaded to the system:';
$lang['folder_desc_add']		= 'Please choose a title and parent folder:';
$lang['folder_desc_move']		= 'Please select the folder to move the files to:';
$lang['folder_desc_trash']		= 'Do you really want to delete the selection?';
$lang['folder_desc_rename']	    = 'Just modify the folder and save.'; // UPDATE 1.4

$lang['folder_btn_addfolder']	= 'Add Folder';
$lang['folder_btn_cancel']		= 'Cancel';
$lang['folder_btn_move']		= 'Move to Folder';
$lang['folder_btn_trash']		= 'Delete';

$lang['folder_mnu_delete']		= 'Delete Folder';
$lang['folder_mnu_open']		= 'Open Folder';
$lang['folder_mnu_rename']		= 'Rename Folder';

$lang['folder_lsttit_name']	    = 'Title';
$lang['folder_lsttit_size']	    = 'Size';
$lang['folder_lsttit_date']	    = 'Date';
$lang['folder_lsttit_actions']	= 'Actions';

$lang['folder_lbl_title']		= 'Title';
$lang['folder_lbl_parent']		= 'Parent';
$lang['folder_lbl_noparent']	= 'None ( root )';
$lang['folder_lbl_root']		= 'ROOT';

$lang['folder_msg_noobjects']	= 'No files in folder';
$lang['folder_msg_objectsfound']= '%s files in folder';
$lang['folder_msg_noajax']		= 'Not an ajax request. Please try again.';
$lang['folder_msg_nochange']	= 'Could not change folder. Please try again.';
$lang['folder_msg_notfound']	= 'No objects found in folder.';
$lang['folder_msg_notchosen']	= 'Please select a folder first.';
$lang['folder_msg_valerror']	= 'A validation error occured. Please try again.';
$lang['folder_msg_addok']		= 'The folder was successfully created.';
$lang['folder_msg_parammissing']	    = 'At least one parameter is missing.'; // UPDATE 1.4
$lang['folder_msg_renamesuccess']    = 'Folder successfully renamed.'; // UPDATE 1.4
$lang['folder_msg_renameerror']	    = 'An error occured while trying to rename the folder.'; // UPDATE 1.4

// search - UPDATE 1.2
$lang['srch_title_results']	    = 'Search results';

$lang['srch_head_results']	    = 'Search results';

$lang['srch_desc_results']	    = 'The following files were found for your search phrase "<strong>%s</strong>"';

$lang['srch_lsttit_file']	    = 'File';
$lang['srch_lsttit_size']	    = 'Size';
$lang['srch_lsttit_uploaded']	    = 'Uploaded';
$lang['srch_lsttit_downloads']	    = 'Downloads';
$lang['srch_lsttit_public']	    = 'Public';

$lang['srch_msg_noresults']	    = 'Sorry, no entry\'s matching your search criteria.';

// categories - UPDATE 1.2
$lang['cats_title_categories']	    = 'Categories';
$lang['cats_title_addcategory']	    = 'Add Category';
$lang['cats_title_editcategory']    = 'Edit Category';

$lang['cats_head_addcategory']	    = 'Add Category';
$lang['cats_head_editcategory']	    = 'All Categories';
$lang['cats_head_allcategory']	    = 'Edit Category';
$lang['cats_head_deletecategory']   = 'Delete Category?';

$lang['cats_desc_addcategory']	    = 'Please enter the category title. All fields are mandantory.';
$lang['cats_desc_editcategory']	    = 'The following information is saved about the category. All fields are mandantory.';
$lang['cats_desc_allcategory']	    = 'The following categories are already created. To add a new one, click on "New Category".';
$lang['cats_desc_deletecategory']   = 'Should the category really be removed?';

$lang['cats_lsttit_count']	    = '#';
$lang['cats_lsttit_name']	    = 'Title';
$lang['cats_lsttit_actions']	    = 'Actions';

$lang['cats_lbl_title']		    = 'Title';
$lang['cats_lbl_remallfiles']	    = 'Remove all files in the category also';

$lang['cats_btn_save']		    = 'Save';
$lang['cats_btn_edit']		    = 'Edit';
$lang['cats_btn_cancel']	    = 'Cancel';
$lang['cats_btn_delete']	    = 'Delete';
$lang['cats_btn_close']		    = 'Close';
$lang['cats_btn_add']		    = 'Add Category';

$lang['cats_msg_nocatsfound']	    = 'No categories found.';
$lang['cats_msg_createthefirst']    = 'Create the first...';
$lang['cats_msg_catsuccessadded']   = 'Category was successfully added';
$lang['cats_msg_catsuccessupdated'] = 'Category was successfully updated';
$lang['cats_msg_catsuccessremove']  = 'Category was successfully removed';
$lang['cats_msg_filesuccessadded']  = 'The file was successfully added to the category.';
$lang['cats_msg_filesuccessrem']    = 'The file was successfully removed from the category.';
$lang['cats_msg_erroradding']	    = 'Error adding category. Please try again.';
$lang['cats_msg_errorupdating']	    = 'Error updating category. Please try again.';
$lang['cats_msg_errorremoving']	    = 'Error removing category. Please try again.';
$lang['cats_msg_catnotfound']	    = 'Could not find the category requested. Please try again.';
$lang['cats_msg_fileincategory']    = 'The file already exists in this category.';
$lang['cats_msg_filenotincategory'] = 'The file does not exist in this category!';
$lang['cats_msg_parametererror']    = 'Parameter error. Please try again.';
$lang['cats_msg_noajaxrequest']	    = 'Not an ajax request. Cancelled.';
$lang['cats_msg_dberror']	    = 'It seems like a database error occured.';

// publinks
$lang['pub_title_publiclinks']	    = 'Public Links';
$lang['pub_title_editpublink']	    = 'Edit Public Link';

$lang['pub_head_publiclinks']	    = 'Public Links';
$lang['pub_head_publicdetails']	    = 'Public Link Details';

$lang['pub_desc_publiclinks']	    = 'Available Public Links:';
$lang['pub_desc_publicdetails']	    = 'Public Link Details:';

$lang['pub_lsttit_count']	    = '#';
$lang['pub_lsttit_link']	    = 'Link';
$lang['pub_lsttit_created']	    = 'Created by';
$lang['pub_lsttit_password']	    = 'Password';
$lang['pub_lsttit_limit']	    = 'Valid until';
$lang['pub_lsttit_release']	    = 'Release';
$lang['pub_lsttit_actions']	    = 'Actions';
$lang['pub_lsttit_file']	    = 'File';
$lang['pub_lsttit_available']	    = 'Available';
$lang['pub_lsttit_downloaded']	    = 'Downloaded';

$lang['pub_txt_files']		    = 'Files:';
$lang['pub_txt_passyes']	    = 'set';
$lang['pub_txt_passno']		    = 'n/a';
$lang['pub_txt_delete']		    = 'Delete?';
$lang['pub_txt_sure']		    = 'Sure?';
$lang['pub_txt_yes']		    = 'Yes';
$lang['pub_txt_no']		    = 'No';
$lang['pub_txt_none']		    = 'Not available';
$lang['pub_txt_notset']		    = 'Not set';
$lang['pub_txt_more']		    = '... and %s more.';

$lang['pub_lbl_link']		    = 'Link';
$lang['pub_lbl_created']	    = 'Created by';
$lang['pub_lbl_message']	    = 'Message';
$lang['pub_lbl_password']	    = 'Password';
$lang['pub_lbl_available']	    = 'Valid until';
$lang['pub_lbl_files']		    = 'Files';
$lang['pub_lbl_share']		    = 'Share'; // UPDATE 1.3

$lang['pub_btn_cancel']		    = 'Cancel';

$lang['pub_msg_entryremovesuccess'] = 'Entry deleted successfully.';
$lang['pub_msg_dberrror']	    = 'A database error occured. Please try again.';
$lang['pub_msg_argumenterror']	    = 'An argument error occured.';
$lang['pub_msg_statuschangesuccess']= 'The status was changed successfully.';
$lang['pub_msg_statuschangeerror']  = 'The status couldn\'t be changed.';
$lang['pub_msg_erroroccured']	    = 'An error occured. Please try again.';
$lang['pub_msg_nolinksfound']	    = 'No public links found.';

// settings
$lang['set_title_settings']	    = 'Settings';

$lang['set_head_settings']	    = 'Settings';

$lang['set_desc_settings']	    = 'Please change the system settings carefully. Changes can make the system unstable.';

$lang['set_lbl_product_name']	    = 'Product Title';
$lang['set_lbl_email_protocol']	    = 'Protocol';
$lang['set_lbl_email_host']	    = 'Server';
$lang['set_lbl_email_user']	    = 'User';
$lang['set_lbl_email_pass']	    = 'Password';
$lang['set_lbl_email_port']	    = 'Port';
$lang['set_lbl_email_type_smtp']    = 'SMTP';
$lang['set_lbl_email_type_send']    = 'Sendmail';
$lang['set_lbl_email_type_mail']    = 'PHP Mail()';
$lang['set_lbl_sendmail_path']	    = 'Sendmail Path';
$lang['set_lbl_add_user_email']	    = 'Email new User';
$lang['set_lbl_send_files_cust']    = 'Customer has uploaded files';
$lang['set_lbl_send_files_email']   = 'Sending files by email';
$lang['set_lbl_add_files_email']    = 'Sharing new files';
$lang['set_lbl_system_language']    = 'System Language:';
$lang['set_lbl_add_user_subject']   = 'Email Subject';
$lang['set_lbl_send_files_csubject']= 'Email Subject';
$lang['set_lbl_send_files_subject'] = 'Email Subject';
$lang['set_lbl_add_files_subject']  = 'Email Subject';
$lang['set_lbl_enable_support']	    = 'Support Tab';
$lang['set_lbl_enable_support_yes'] = 'show';
$lang['set_lbl_enable_support_no']  = 'hide';
$lang['set_lbl_google_analytics']   = 'Google Analytics'; // UPDATE 1.2
$lang['set_lbl_thumb_x']	    = 'Width'; // UPDATE 1.2
$lang['set_lbl_thumb_y']	    = 'Height'; // UPDATE 1.2
$lang['set_lbl_image_library']	    = 'Image library'; // UPDATE 1.2
$lang['set_lbl_imglib_type_gd']	    = 'GD'; // UPDATE 1.2
$lang['set_lbl_imglib_type_gd2']    = 'GD2'; // UPDATE 1.2
$lang['set_lbl_imglib_type_imagemagick'] = 'ImageMagick'; // UPDATE 1.2
$lang['set_lbl_image_library_path'] = 'ImageMagick Path'; // UPDATE 1.2
$lang['set_lbl_enable_userupload']  = 'Enable user uploads'; // UPDATE 1.3
$lang['set_lbl_show_freespace_user']= 'Show free space on user login'; // UPDATE 1.3
$lang['set_lbl_download_type']	    = 'Download Type'; // UPDATE 1.3
$lang['set_lbl_chunked_size']	    = 'Chunk Size'; // UPDATE 1.3
$lang['set_lbl_download_type_normal']	= 'Normal'; // UPDATE 1.3
$lang['set_lbl_download_type_chunked']	= 'Chunked'; // UPDATE 1.3
$lang['set_lbl_enable_userupload_yes']	= 'Yes'; // UPDATE 1.3
$lang['set_lbl_enable_userupload_no']	= 'No'; // UPDATE 1.3
$lang['set_lbl_show_freespace_user_yes']    = 'Yes'; // UPDATE 1.3
$lang['set_lbl_show_freespace_user_no']	    = 'No'; // UPDATE 1.3
$lang['set_lbl_send_files_reqsubject']	= 'Request Subject'; // UPDATE 1.3
$lang['set_lbl_send_files_request'] = 'Upload by request'; // UPDATE 1.3
$lang['set_lbl_show_index']			= 'Show index <br />( or redirect )?'; // UPDATE 1.4
$lang['set_lbl_show_index_yes']		= 'Yes'; // UPDATE 1.4
$lang['set_lbl_show_index_no']		= 'No'; // UPDATE 1.4
$lang['set_lbl_show_catfolder']		= 'Default file view'; // UPDATE 1.4
$lang['set_lbl_show_catfolder_cat']	= 'Category View'; // UPDATE 1.4
$lang['set_lbl_show_catfolder_fold'] = 'Folder View'; // UPDATE 1.4
$lang['set_lbl_show_catfolder_both'] = 'Both ( select )'; // UPDATE 1.4

$lang['set_btn_save']		    = 'Save';
$lang['set_btn_cancel']		    = 'Cancel';

$lang['set_nav_general']	    = 'General';
$lang['set_nav_email']		    = 'Email';
$lang['set_nav_templates']	    = 'Templates';
$lang['set_nav_thumbnails']	    = 'Thumbnails';
$lang['set_nav_downloads']  	    = 'Downloads';

$lang['set_msg_editsuccess']	    = 'The entries are successfully updated.';
$lang['set_msg_editerror']	    = 'An error occured. Please try again.';
$lang['set_msg_nosettingsfound']    = 'No settings could be found.';

// uploads
$lang['up_title_uploads']	    = 'Uploads';
$lang['up_title_lastupload']	    = 'Latest Upload';

$lang['up_head_fileupload']	    = 'Upload';
$lang['up_head_latestupload']	    = 'Latest Upload';

$lang['up_desc_fileupload']	    = 'Please choose a file by clicking "Choose File". You are also able to use drag & drop with the latest Firefox, Chrome or IE.<br /><br />Max. upload size: %s';
$lang['up_desc_latestupload']	    = 'Latest file uploads:';

$lang['up_btn_selectfile']	    = 'Choose File';
$lang['up_btn_startupload']	    = 'Start Upload';
$lang['up_btn_cancelupload']	    = 'Cancel Upload';
$lang['up_btn_refresh']		    = 'New Upload';
$lang['up_btn_overview']	    = 'Latest Upload';

$lang['up_txt_userremoved']	    = 'User deleted';
$lang['up_txt_uprequest']	    = 'Upload Request'; // UPDATE 1.3

$lang['up_lsttit_file']		    = 'File';
$lang['up_lsttit_size']		    = 'Size';
$lang['up_lsttit_uploaded']	    = 'Uploaded';
$lang['up_lsttit_downloads']	    = 'Downloads';
$lang['up_lsttit_public']	    = 'Public';

$lang['up_msg_nofilesinsystem']	    = 'No files uploaded so far.';
$lang['up_msg_addthefirst']	    = 'Upload the first one.';

// user
$lang['user_title_user']	    = 'User';
$lang['user_title_adduser']	    = 'Add User';
$lang['user_title_edituser']	    = 'Edit User';

$lang['user_head_adduser']	    = 'New User';
$lang['user_head_edituser']	    = 'Edit User';
$lang['user_head_alluser']	    = 'All User';
$lang['user_head_infobgimage']	    = 'Background Image';
$lang['user_head_url']		    = 'URL';
$lang['user_head_emailrecipient']   = 'Email Recipient';
$lang['user_head_accepted']	    = 'Accepted Types';

$lang['user_desc_adduser']	    = 'Please fill in all fields to create a new user. All fields are mandantory.';
$lang['user_desc_edituser']	    = 'The following information is saved about the user. All fields are mandantory.';
$lang['user_desc_alluser']	    = 'The following user are already created. To add a new one, click on "New User".';
$lang['user_desc_infobgimage']	    = '<p>The background image is the image that is shown to the user in full screen at login. 
This is not shown in the Administrators / Super Administrators Login, but solely with the Frontend Login.</p>
<p style="color:red;font-weight:bold;">The image should have the following properties:
    <ul>
	<li>1920x1060 Pixel</li>
	<li>JPEG</li>
	<li>max. 500 KB in file size</li>
    </ul>
</p>';
$lang['user_desc_url']		    = '<p>Each user of the system ( excluding Administrator / Super Administrators ) gets its own URL.</p>
<p>With this URL, the user can log in with a password to Up-/Download.</p>
<p class="color:red;font-weight:bold;">Users can not access the administration system.</p>
<p><strong>Allowed characters: A to Z, 0 to 9 and - (dash)</strong></p>';
$lang['user_desc_emailrecipient']   = '<p>Here you set the user who will receive a confirmation email after the frontend upload.</p>';
$lang['user_desc_accepted']	    = '<p>If you would like to accept e.g. ZIP and JPG files, please enter "zip|ZIP|jpg|JPG". Please split accepted extensions with a "|". If you would like to accept all types of files, leave this field empty.</p>';

$lang['user_lbl_user']		    = 'User';
$lang['user_lbl_name']		    = 'Name';
$lang['user_lbl_email']		    = 'Email';
$lang['user_lbl_password']	    = 'Password';
$lang['user_lbl_passwordagain']	    = 'Password again';
$lang['user_lbl_timezone']	    = 'Timezone';
$lang['user_lbl_dateformat']	    = 'Date Format';
$lang['user_lbl_level']		    = 'Userlevel';
$lang['user_lbl_background']	    = 'Background';
$lang['user_lbl_recipient']	    = 'Email Recipient';
$lang['user_lbl_sendregemail']	    = 'Send Reg. Email';
$lang['user_lbl_url']		    = 'URL';
$lang['user_lbl_maxsize']	    = 'Max. Filesize';
$lang['user_lbl_maxfiles']	    = 'Max. Count Files';
$lang['user_lbl_accepttypes']	    = 'Accepted Types';
$lang['user_lbl_canupload']	    = 'User can upload'; // UPDATE 1.3
$lang['user_lbl_candownload']	    = 'User can download'; // UPDATE 1.3
$lang['user_lbl_folder']            = 'Default Folder'; // UPDATE 1.4

$lang['user_btn_generate']	    = 'Generate';
$lang['user_btn_save']		    = 'Save';
$lang['user_btn_edit']		    = 'Edit';
$lang['user_btn_cancel']	    = 'Cancel';
$lang['user_btn_adduser']	    = 'New User';
$lang['user_btn_close']		    = 'Close';

$lang['user_sel_levelsuperadmin']   = 'Superadministrator ( Full Admin Access )';
$lang['user_sel_leveladmin']	    = 'Administrator ( Admin Access / No Settings Access )';
$lang['user_sel_leveluser']	    = 'User ( Only Frontend Access )';

$lang['user_txt_passonlyenterif']   = 'Enter the password only, if it has to be changed!';
$lang['user_txt_levelsuperadmin']   = 'Superadmin';
$lang['user_txt_leveladmin']	    = 'Admin';
$lang['user_txt_leveluser']	    = 'User';
$lang['user_txt_sure']		    = 'Sure?';
$lang['user_txt_yes']		    = 'Yes';
$lang['user_txt_no']		    = 'No';
$lang['user_txt_delete']	    = 'Delete?';
$lang['user_txt_files']		    = 'Files';
$lang['user_txt_file']		    = 'File';
$lang['user_txt_nofiles']	    = 'No Files';

$lang['user_lsttit_count']	    = '#';
$lang['user_lsttit_name']	    = 'Name';
$lang['user_lsttit_email']	    = 'Email';
$lang['user_lsttit_level']	    = 'Level';
$lang['user_lsttit_sharing']	    = 'Shared';
$lang['user_lsttit_access']	    = 'Access';
$lang['user_lsttit_actions']	    = 'Actions';

$lang['user_msg_addok']		    = 'Entry added succesfully.';
$lang['user_msg_addoknoemail']	    = 'Entry added, but the email couldn\'t be sent.';
$lang['user_msg_addoknoback']	    = 'Entry added, but the background couldn\'t be uploaded successfully.';
$lang['user_msg_addoknobackemail']  = 'Entry added, but email sending and background upload failed.';
$lang['user_msg_editok']	    = 'Entry edited successfully.';
$lang['user_msg_editoknoemail']	    = 'Entry edited, but the email couldn\'t be sent.';
$lang['user_msg_editoknoback']	    = 'Entry edited, but the background image couldn\'t be uploaded.';
$lang['user_msg_editoknobackemail'] = 'Entry edited, but the email couldn\'t be sent and the background wasn\'t uploaded.';
$lang['user_msg_editerror']	    = 'The entry couldn\'t be edited.';
$lang['user_msg_deletesuccess']	    = 'Entry was deleted successfully.';
$lang['user_msg_deletedberror']	    = 'A database error occured. Please try again.';
$lang['user_msg_deleteargerror']    = 'An argument error occured.';
$lang['user_msg_statussuccess']	    = 'The status was changed successfully.';
$lang['user_msg_statuserror']	    = 'The status couldn\'t be changed.';
$lang['user_msg_statusnotavailable']= 'An error occured. Please try again.';
$lang['user_msg_seofielderror']	    = 'The %s field may only contain letters from a to z, numbers from 0 to 9 and a - (dash).';
$lang['user_msg_urlnotavailable']   = 'The entered url is already taken. Please choose a new one!';
$lang['user_msg_needtorelogin']	    = 'If you make any changes, you have to login again.';
$lang['user_msg_nouserfound']	    = 'No user found.';
$lang['user_msg_createthefirst']    = 'Create the first one.';
$lang['user_msg_emailalreadyreg']   = 'This email address is already registered. Please try again!';
$lang['user_msg_emailexists']	    = 'This email address is already registered. Please choose another one.';
$lang['user_msg_lastsuperadmin']	= 'Sorry, you try to disable/remove the last superadmin. That\'s not possible.'; // UPDATE 1.4

// upload request
$lang['uploads_head_alluploads']    = 'Upload Request'; // UPDATE 1.3
$lang['uploads_head_add']	    = 'Add Upload Request'; // UPDATE 1.3
$lang['uploads_head_edit']	    = 'Edit Upload Request'; // UPDATE 1.3

$lang['uploads_title_alluploads']   = 'Upload Requests'; // UPDATE 1.3
$lang['uploads_title_add']	    = 'Add Request'; // UPDATE 1.3
$lang['uploads_title_editupload']   = 'Edit Request'; // UPDATE 1.3

$lang['uploads_desc_alluploads']    = 'You can send upload requests with a special URL to your customers.'; // UPDATE 1.3
$lang['uploads_desc_add']	    = 'You can add a description for the upload request. This will be shown on the upload form.'; // UPDATE 1.3
$lang['uploads_desc_edit']	    = 'Here you can edit your upload request.'; // UPDATE 1.3

$lang['uploads_lsttit_count']	    = '#'; // UPDATE 1.3
$lang['uploads_lsttit_link']	    = 'Link'; // UPDATE 1.3
$lang['uploads_lsttit_created']	    = 'Created'; // UPDATE 1.3
$lang['uploads_lsttit_release']	    = 'Release'; // UPDATE 1.3
$lang['uploads_lsttit_actions']	    = 'Actions'; // UPDATE 1.3

$lang['uploads_lbl_desc']	    = 'Description'; // UPDATE 1.3
$lang['uploads_lbl_folder']	    = 'Default Folder'; // UPDATE 1.4

$lang['uploads_btn_add']	    = 'Add Request'; // UPDATE 1.3
$lang['uploads_btn_create']	    = 'Add Request'; // UPDATE 1.3
$lang['uploads_btn_edit']	    = 'Edit Request'; // UPDATE 1.3
$lang['uploads_btn_cancel']	    = 'Cancel'; // UPDATE 1.3

$lang['uploads_msg_statuschangesuccess']= 'Status was changed successfully.'; // UPDATE 1.3
$lang['uploads_msg_statuschangeerror']	= 'An error occured while trying to change the status.'; // UPDATE 1.3
$lang['uploads_msg_addedsuccess']   = 'The request was successfully added.'; // UPDATE 1.3
$lang['uploads_msg_addederror']	    = 'An error occured while trying to add the request'; // UPDATE 1.3
$lang['uploads_msg_modsuccess']	    = 'Request modification successfull.'; // UPDATE 1.3
$lang['uploads_msg_moderror']	    = 'An error occured while trying to edit the request'; // UPDATE 1.3
$lang['uploads_msg_argumenterror']  = 'An argument error occured. Please try again.'; // UPDATE 1.3
$lang['uploads_msg_entryremovesuccess']= 'Entry removed successfully.'; // UPDATE 1.3
$lang['uploads_msg_dberrror']	    = 'A Database error occured. Please try again.'; // UPDATE 1.3
$lang['uploads_msg_nolinksfound']   = 'No upload requests found.'; // UPDATE 1.3.1

$lang['uploads_txt_sure']	    = 'Sure?'; // UPDATE 1.3
$lang['uploads_txt_yes']	    = 'Yes'; // UPDATE 1.3
$lang['uploads_txt_no']		    = 'No'; // UPDATE 1.3


// log
$lang['log_head_overview']	    = 'Log'; // UPDATE 1.3
$lang['log_head_delete']	    = 'Delete'; // UPDATE 1.3

$lang['log_title_log']		    = 'Log'; // UPDATE 1.3

$lang['log_desc_overview']	    = 'The following log entries were created:'; // UPDATE 1.3
$lang['log_desc_delete']	    = 'Are you sure?'; // UPDATE 1.3

$lang['log_lsttit_time']	    = 'Date'; // UPDATE 1.3
$lang['log_lsttit_file']	    = 'Description'; // UPDATE 1.3
$lang['log_lsttit_size']	    = 'Size'; // UPDATE 1.3

$lang['log_msg_na']		    = 'n/a'; // UPDATE 1.3
$lang['log_msg_deleteproblems']	    = 'A problem occured while trying to delete entries.'; // UPDATE 1.3
$lang['log_msg_deletesuccess']	    = 'The selected entries were deleted successfully.'; // UPDATE 1.3
$lang['log_msg_requesterror']	    = 'A request error occured. Please try again.'; // UPDATE 1.3
$lang['log_msg_noajaxrequest']	    = 'Sorry, not an ajax request. Cancelling...'; // UPDATE 1.3

$lang['log_lbl_selected']	    = 'Selected'; // UPDATE 1.3

$lang['log_sel_pleasechoose']	    = 'Please choose...'; // UPDATE 1.3
$lang['log_sel_delete']		    = 'Delete'; // UPDATE 1.3

$lang['log_btn_cancel']		    = 'No'; // UPDATE 1.3
$lang['log_btn_delete']		    = 'Yes'; // UPDATE 1.3


// import
$lang['import_head_import']	    = 'Import'; // UPDATE 1.3

$lang['import_title_import']	    = 'Import'; // UPDATE 1.3

$lang['import_desc_import']	    = 'Here you can import files uploaded to the "data/import" directory.'; // UPDATE 1.3

$lang['import_msg_nofilesfound']    = 'No files found!'; // UPDATE 1.3
$lang['import_msg_successfiles']    = 'Files imported successfully.'; // UPDATE 1.3
$lang['import_msg_errorfiles']	    = 'The following files could not be imported: '; // UPDATE 1.3
$lang['import_msg_nofilesto']	    = 'No files found.'; // UPDATE 1.3

$lang['import_lsttit_file']	    = 'File'; // UPDATE 1.3
$lang['import_lsttit_size']	    = 'Size'; // UPDATE 1.3

$lang['import_btn_import']	    = 'Import'; // UPDATE 1.3


// request frontend
$lang['request_head_dashboard']	    = 'Upload Files'; // UPDATE 1.3
$lang['request_head_freespace']	    = 'Free Space'; // UPDATE 1.3
$lang['request_head_uprequest']	    = 'Upload Request'; // UPDATE 1.3
$lang['request_head_error']	    = 'Upload Request Error'; // UPDATE 1.3.1

$lang['request_title_publicupload'] = 'Upload Request'; // UPDATE 1.3
$lang['request_title_error']	    = 'Upload Request Error'; // UPDATE 1.3.1

$lang['request_desc_dashboard']	    = 'Upload files by Drag&Drop or choose "Select Files"'; // UPDATE 1.3
$lang['request_desc_error']	    = 'You do not have the right to access this resource.'; // UPDATE 1.3.1

$lang['request_txt_freespace']	    = '%s of %s used, <strong>%s free</strong>'; // UPDATE 1.3

$lang['request_btn_choosefile']	    = 'Select Files'; // UPDATE 1.3
$lang['request_btn_startupload']    = 'Upload'; // UPDATE 1.3
$lang['request_btn_cancelupload']   = 'Cancel Upload'; // UPDATE 1.3
$lang['request_btn_refresh']	    = 'New Upload'; // UPDATE 1.3


/*
 * jQuery Datatables
 */

$lang['datatbl_sProcessing']	    = 'Processing...';
$lang['datatbl_sLengthMenu']	    = 'Show _MENU_ entries';
$lang['datatbl_sZeroRecords']	    = 'No matching records found';
$lang['datatbl_sInfo']		    = 'Showing _START_ to _END_ of _TOTAL_ entries';
$lang['datatbl_sInfoEmpty']	    = 'Showing 0 to 0 of 0 entries';
$lang['datatbl_sInfoFiltered']	    = '(filtered from _MAX_ total entries)';
$lang['datatbl_sInfoPostFix']	    = '';
$lang['datatbl_sSearch']	    = 'Search';
$lang['datatbl_sFirst']		    = 'First';
$lang['datatbl_sPrevious']	    = 'Previous';
$lang['datatbl_sNext']		    = 'Next';
$lang['datatbl_sLast']		    = 'Last';