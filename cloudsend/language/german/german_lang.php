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
$lang['glob_backtotop']		    = 'nach oben';
$lang['copy_to_clipboard']	    = 'In die Zwischenablage';
$lang['copy_to_clipboard_copied']   = 'Kopiert!';
$lang['new_cloudsend_version']	    = 'A new CloudSend version ( %s ) has been released. Please update for getting new exciting functions.'; // UPDATE 1.2

// system navigation
$lang['sys_navi_dashboard']	    = 'Dashboard';
$lang['sys_navi_files']		    = 'Dateien';
$lang['sys_navi_files_cat']	    = 'Kategorien'; // UPDATE 1.4
$lang['sys_navi_files_folder']	    = 'Ordner'; // UPDATE 1.4
$lang['sys_navi_upload']	    = 'Upload';
$lang['sys_navi_newupload']	    = 'Neuer Upload';
$lang['sys_navi_lastupload']	    = 'Letzter Upload';
$lang['sys_navi_public']	    = 'Public';
$lang['sys_navi_pubupload']	    = 'Upload Request'; // UPDATE 1.3
$lang['sys_navi_import']	    = 'Ordner Import'; // UPDATE 1.3
$lang['sys_navi_user']		    = 'Zugriffe';
$lang['sys_navi_settings']	    = 'Einstellungen';
$lang['sys_navi_myaccount']	    = 'Mein Account';
$lang['sys_navi_log']		    = 'Log'; // UPDATE 1.3
$lang['sys_navi_logout']	    = 'Logout';

// frontend controller
$lang['front_title_welcome']	    = 'Willkommen';
$lang['front_title_404notfound']    = '404 - Nicht Gefunden';
$lang['front_title_login']	    = 'Login';
$lang['front_title_publicdownloads']= 'Öffentliche Downloads';
$lang['front_title_userdownloads']  = 'Benutzerdownloads';
$lang['front_title_myuploads']	    = 'Meine Uploads';

$lang['front_lbl_password']	    = 'Passwort';
$lang['front_lbl_user']		    = 'Benutzer';

$lang['front_btn_login']	    = 'Login';

$lang['front_msg_novalidpassword']  = 'Passwort ungültig. Bitte versuchen Sie es erneut';

$lang['front_head_dashboard']	    = 'Dashboard';
$lang['front_head_error']	    = '404';
$lang['front_head_notfound']	    = '404 Nicht gefunden!';
$lang['front_head_welcome']	    = 'Willkommen';

$lang['front_desc_dashboard']	    = 'Bitte wählen Sie die Dateien für den Upload per "Datei auswählen" aus. Bei neueren Browsern ( z.B. Firefox oder Chrome ) können Sie die Dateien auch per Drag & Drop in das Browserfenster ziehen um den Upload zu starten.<br /><br />Maximale Uploadgröße: %s';
$lang['front_desc_error']	    = 'Es trat ein Fehler auf, kontaktieren Sie bitte den Administrator der Website.';
$lang['front_desc_notfound']	    = 'Ihre Anfrage konnte leider nicht bearbeitet werden. Bitte kontaktieren Sie den Administrator der Website.';
$lang['front_desc_filelist']	    = 'Folgende Dateien sind freigegeben. Klicken Sie auf die Dateinamen oder das Icon und den Download zu starten.';
$lang['front_desc_myuploads']	    = 'Folgende Dateien wurden von Ihnen bereits hochgeladen. Vielen Dank!';
$lang['front_desc_welcome']	    = 'Bitte kontaktieren Sie den Anbieter um einen Zugriff zu erhalten.';

$lang['front_btn_choosefile']	    = 'Datei auswählen';
$lang['front_btn_startupload']	    = 'Upload starten';
$lang['front_btn_cancelupload']	    = 'Upload abbrechen';

$lang['front_msg_uploadsuccess']    = 'Der Upload war erfolgreich.';
$lang['front_msg_nofilesfound']	    = 'Es konnten keine gültigen Dateien gefunden werden. Es liegt entweder ein Fehler vor, oder die Dateien sind bereits abgelaufen.';

$lang['front_lsttit_number']	    = '#';
$lang['front_lsttit_file']	    = 'Datei';
$lang['front_lsttit_date']	    = 'Hochgeladen';
$lang['front_lsttit_size']	    = 'Größe';
$lang['front_lsttit_available']	    = 'Verfügbar';

$lang['front_navi_dashboard']	    = 'Dashboard';
$lang['front_navi_downloads']	    = 'Downloads';
$lang['front_navi_uploads']	    = 'Meine Uploads';
$lang['front_navi_public']	    = 'Öffentlich';
$lang['front_navi_user']	    = 'Benutzer';
$lang['front_navi_settings']	    = 'Einstellungen';
$lang['front_navi_logout']	    = 'Logout';

// public link controller
$lang['public_title_publiclink']    = 'Öffentlicher Link';
$lang['public_title_linklogin']	    = 'Öffentlicher Link - Login';
$lang['public_title_login']	    = 'Login';

$lang['public_lbl_password']	    = 'Passwort';
$lang['public_lbl_link']	    = 'Link';

$lang['public_btn_login']	    = 'Login';

$lang['public_msg_novalidpassword'] = 'Passwort ungültig. Bitte versuchen Sie es erneut.';

$lang['public_head_dashboard']	    = 'Dashboard';
$lang['public_head_error']	    = '404';
$lang['public_head_forbidden']	    = '403 Nicht erlaubt!';
$lang['public_head_public']	    = 'Öffentliche Downloads';

$lang['public_desc_dashboard']	    = 'Bitte wählen Sie die Dateien für den Upload per "Datei auswählen" aus. Bei neueren Browsern ( z.B. Firefox oder Chrome ) können Sie die Dateien auch per Drag & Drop in das Browserfenster ziehen um den Upload zu starten.';
$lang['public_desc_error']	    = 'Es trat ein Fehler auf, kontaktieren Sie bitte den Administrator der Website.';
$lang['public_desc_forbidden']	    = 'Leider haben Sie keinen Zugriff auf die angeforderte Ressource. Sollte dieser Fehler ein Missverständnis sein, kontaktieren Sie bitte den Sender des Links.';
$lang['public_desc_filelist']	    = 'Folgende Dateien sind unter dem öffentlichen Link freigegeben. Klicken Sie auf die Dateinamen oder das Icon und den Download zu starten.';

$lang['public_msg_nofilesfound']    = 'Es konnten keine gültigen Dateien für diesen öffentlichen Link gefunden werden. Es liegt entweder ein Fehler vor, oder die Dateien sind abgelaufen.';

$lang['public_lsttit_number']	    = '#';
$lang['public_lsttit_file']	    = 'Datei';
$lang['public_lsttit_size']	    = 'Größe';
$lang['public_lsttit_available']    = 'Verfügbar';


// login screen
$lang['account_title_login']	    = 'Login';

$lang['account_head_login']	    = 'Admin Login';

$lang['account_lbl_email']	    = 'Ihre Email';
$lang['account_lbl_password']	    = 'Ihr Passwort';

$lang['account_btn_signin']	    = 'Login';

$lang['account_msg_login']	    = 'Bitte geben Sie nachstehend Ihre Login Daten ein:';
$lang['account_msg_loginerror']	    = 'Benutzername/Kennwort konnte nicht verifiziert werden. Bitte versuchen Sie es erneut.';

// dashboard
$lang['dash_title_dashboard']	    = 'Dashboard';
$lang['dash_title_restricted']	    = 'Begrenzter Zugriff';

$lang['dash_head_forbidden']	    = '403 Forbidden';
$lang['dash_head_dashboard']	    = 'Dashboard';
$lang['dash_head_freespace']	    = 'Freier Speicherplatz';

$lang['dash_lbl_usersregistered']   = 'Benutzer registriert'; // UPDATE 1.4
$lang['dash_lbl_filesin']           = 'Dateien in %s'; // UPDATE 1.4
$lang['dash_lbl_totalsize']         = 'Gesamtgröße Dateien'; // UPDATE 1.4
$lang['dash_lbl_totaldownload']     = 'Downloadgröße Gesamt'; // UPDATE 1.4

$lang['dash_desc_forbidden']	    = 'Leider haben Sie keinen Zugriff auf die angeforderte Ressource. Sollte dieser Fehler ein Missverständnis sein, kontaktieren Sie bitte Ihren Administrator.';
$lang['dash_desc_dashboard']	    = 'Das Dashboard zeigt die letzten hochgeladenen Dateien von Kunden sowie eventuell ausstehende Anfragen.';

$lang['dash_lsttit_count']	    = '#';
$lang['dash_lsttit_file']	    = 'Datei';
$lang['dash_lsttit_size']	    = 'Größe';
$lang['dash_lsttit_sender']	    = 'Sender';
$lang['dash_lsttit_sendet']	    = 'Gesendet';

$lang['dash_link_overview']	    = 'Zur Übersicht';

$lang['dash_txt_freespace']	    = '%s von %s genutzt, <strong>%s frei</strong>';
$lang['dash_txt_uprequest']	    = 'via Upload Request'; // UPDATE 1.3

$lang['dash_msg_noopenfiles']	    = 'Hurra! Es gibt keine offenen Anfragen oder neue Dokumente.';

// files
$lang['files_title_files']	    = 'Dateien';
$lang['files_title_details']        = 'Dateiinfo';
$lang['files_title_cats']	    = 'Kategorien'; // UPDATE 1.2

$lang['files_head_files']	    = 'Alle Dateien';
$lang['files_head_sendemail']	    = 'Email versenden';
$lang['files_head_publiclink']	    = 'Öffentlichen Link erstellen';
$lang['files_head_releaseuser']	    = 'Benutzer freigeben';
$lang['files_head_delete']	    = 'Löschen?';
$lang['files_head_details']         = 'Datei Informationen';
$lang['files_head_userfiles']	    = 'Benutzerdateien'; // UPDATE 1.3
$lang['files_head_rename']	    = 'Umbenennen'; // UPDATE 1.4
$lang['files_head_zip']			= 'ZIP Archiv erstellen'; // UPDATE 1.4

$lang['files_desc_files']	    = 'Nachfolgende Dateien wurden bereits hochgeladen und befinden sich im System. Sie können diese per Drag&Drop kategorisieren.';
$lang['files_desc_sendemail']	    = 'Bitte geben Sie den Empfänger und die Nachricht an:';
$lang['files_desc_publiclink']	    = 'Bitte wählen Sie die Optionen für den Link aus:';
$lang['files_desc_releaseuser']	    = 'Bitte wählen Sie nachstehend den / die Benutzer aus, die die Datei sehen / downloaden dürfen:<br /><small>( mit STRG + Klick mehrere auswählen! )</small>';
$lang['files_desc_delete']	    = 'Soll die Auswahl wirklich gelöscht werden?';
$lang['files_desc_details']         = 'Folgende Informationen sind über die Datei gespeichert:';
$lang['fiels_desc_userfiles']	    = 'Die folgenden Dateien sind mit dem Benutzer geteilt:'; // UPDATE 1.3
$lang['files_desc_rename']	    = 'Dateiname bearbeiten und speichern.'; // UPDATE 1.4

$lang['files_lsttit_file']	    = 'Datei';
$lang['files_lsttit_size']	    = 'Größe';
$lang['files_lsttit_uploaded']	    = 'Hochgeladen';
$lang['files_lsttit_downloads']	    = 'Downloads';
$lang['files_lsttit_public']	    = 'Öffentlich';
$lang['files_lsttit_count']	    = '#';
$lang['files_lsttit_user']	    = 'Benutzer';
$lang['files_lsttit_publiclinks']   = 'Öffentlicher Link';

$lang['files_lnk_allfiles']	    = 'Alle Dateien'; // UDPATE 1.2

$lang['files_lbl_selected']	    = 'Markierte:';
$lang['files_lbl_recipient']	    = 'Empfänger:';
$lang['files_lbl_message']	    = 'Nachricht';
$lang['files_lbl_password']	    = 'Passwort';
$lang['files_lbl_validity']	    = 'Gültigkeit';
$lang['files_lbl_limit']	    = 'Limit';
$lang['files_lbl_user']		    = 'User:';
$lang['files_lbl_informuser']	    = 'Benutzer per Email über neue Dateien informieren?';
$lang['files_lbl_download']	    = 'Download:';
$lang['files_lbl_size']		    = 'Größe:';
$lang['files_lbl_uploadon']	    = 'Hochgeladen am:';
$lang['files_lbl_uploadby']	    = 'Hochgeladen von:';
$lang['files_lbl_ispublic']	    = 'Öffentlich ?';
$lang['files_lbl_downloads']	    = 'Downloads:';
$lang['files_lbl_yes']		    = 'Ja';
$lang['files_lbl_no']		    = 'Nein';
$lang['files_lbl_mime']		    = 'Dateityp:';
$lang['files_lbl_user']		    = 'Für Benutzer:';
$lang['files_lbl_publiclinks']	    = 'Per Link:';
$lang['files_lbl_preview']	    = 'Vorschau';
$lang['files_lbl_description']	    = 'Dateibeschreibung';
$lang['files_lbl_tags']		    = 'Tags'; // UPDATE 1.2
$lang['files_lbl_md5']              = 'MD5'; // UDPATE 1.4
$lang['files_lbl_ddl']              = 'Direkter Download statt Anhang<br /><small>( erstellt automatisch einen Public-Link )</small>'; // UDPATE 1.4

$lang['files_txt_uploadrequest']    = 'Upload Request'; // UPDATE 1.3

$lang['files_ph_recipient']	    = 'Email Adresse';
$lang['files_ph_message']	    = 'Bitte geben Sie Ihre Nachricht ein';

$lang['files_sel_pleasechoose']	    = 'Bitte wählen...';
$lang['files_sel_sendbyemail']	    = 'Emailversand';
$lang['files_sel_createpubliclink'] = 'öffentl. Link erstellen';
$lang['files_sel_releaseforcust']   = 'Mit Benutzer teilen';
$lang['files_sel_delete']	    = 'Löschen';
$lang['files_sel_del_sharing']	    = 'Nicht mehr teilen';
$lang['files_sel_category']	    = 'Kategorie auswählen'; // UPDATE 1.3
$lang['files_sel_createzip']	= 'Archiv erstellen'; // UPDATE 1.4

$lang['files_btn_cancel']	    = 'Abbrechen';
$lang['files_btn_sendemail']	    = 'Email senden';
$lang['files_btn_createlink']	    = 'Link erstellen';
$lang['files_btn_release']	    = 'Freigeben';
$lang['files_btn_delete']	    = 'Löschen';
$lang['files_btn_close']	    = 'Schließen';
$lang['files_btn_back']             = 'Zurück';
$lang['files_btn_save']             = 'Speichern';
$lang['files_btn_rename']	    = 'Umbenennen'; // UPDATE 1.4

$lang['files_msg_fileupdatesuccess']= 'Die Datei wurde erfolgreich upgedated.';
$lang['files_msg_fileupdateerror']  = 'Es trat ein Fehler beim Update auf. Bitte versuchen Sie es erneut!';
$lang['files_msg_filenotfound']	    = 'Die angeforderte Datei konnte nicht gefunden werden!'; 
$lang['files_msg_fileproblem']	    = 'Es gibt ein Problem mit der Datei.';
$lang['files_msg_noajaxrequest']    = 'Kein Ajax Request';
$lang['files_msg_accesssuccess']    = 'Die Dateifreigabe wurde erfolgreich eingerichtet.';
$lang['files_msg_successnoemail']   = 'Die Dateifreigabe wurde erfolgreich eingerichtet, aber die Emails konnten nicht gesendet werden.';
$lang['files_msg_transmitproblem']  = 'Es gibt ein Problem bei der Übergabe der Daten...';
$lang['files_msg_dbremovefailed']   = '%s konnte nicht aus der Datenbank gelöscht werden! Aktion abgebrochen';
$lang['files_msg_unlinkfailed']	    = '%s konnte nicht gelscht werden. Aktion abgebrochen';
$lang['files_msg_notexists']	    = '%s existiert nicht auf dem Server! Aktion abgebrochen!';
$lang['files_msg_notfoundindb']	    = 'Die Datei konnte nicht in der DB gefunden werden!';
$lang['files_msg_deleteproblems']   = 'Es traten Probleme beim löschen auf:<br />%s';
$lang['files_msg_deletesuccess']    = 'Die Dateien wurden erfolgreich gelöscht.';
$lang['files_msg_emailsendsuccess'] = 'Die Email wurde erfolgreich versendet.';
$lang['files_msg_emailsenderror']   = 'Die Email konnte nicht gesendet werden.';
$lang['files_msg_releaseproblems']  = 'Es traten Probleme beim freigeben der Dateien für den öffentlichen Link auf.';
$lang['files_msg_pubcreateproblems']= 'Der Public Link konnte nicht erstellt werden. Bitte versuchen Sie es erneut.';
$lang['files_msg_pubcreatesuccess'] = '<strong>Der öffentliche Link wurde erfolgreich erstellt</strong>:<br /><br /><a href="%s">%s</a>';
$lang['files_msg_nofilesinsystem']  = 'Es sind noch keine Dateien im System.';
$lang['files_msg_addthefirst']	    = 'Fügen Sie die Ersten hinzu.';
$lang['files_msg_emailtoobig']	    = 'Die Anhänge sind größer als <strong>%size%</strong>. Der Versand per Email könnte Probleme geben! Nutzen Sie stattdessen lieber einen öffentlichen Link.'; // you have to add %size% - this value is replaced by javascript with the actual size of all files!
$lang['files_msg_nouser']	    = 'Der User wurde nicht angegeben!';
$lang['files_msg_nopreview']	    = 'Kein Preview verfügbar';
$lang['files_msg_noajax']	    = 'Kein Ajax Request. Aktion abgebrochen';
$lang['files_msg_descsuccess']	    = 'Beschreibung wurde erfolgreich upgedated.';
$lang['files_msg_descerror']	    = 'Es trat ein Fehler beim Update auf.';
$lang['files_msg_tags']		    = 'mit komma (,) trennen - tags werden automatisch gespeichert'; // UPDATE 1.2
$lang['files_msg_parammissing']	    = 'Mindestens ein Parameter fehlt.'; // UPDATE 1.4
$lang['files_msg_renamesuccess']    = 'Datei erfolgreich umbenannt.'; // UPDATE 1.4
$lang['files_msg_renameerror']	    = 'Es trat ein Fehler beim umbenennen auf.'; // UPDATE 1.4
$lang['files_msg_pleasewait']		= 'Bitte warten...'; // UPDATE 1.4
$lang['files_msg_zipfolderexists']	= 'Der temporäre Ordner existiert bereits. Bitte versuchen Sie es erneut.'; // UPDATE 1.4
$lang['files_msg_zipnotcreated']	= 'Das Archiv konnte nicht erstellt werden.'; // UPDATE 1.4
$lang['files_msg_zipfoldcreate']	= 'Der ZIP Ordner konnte nicht erstellt werden.'; // UPDATE 1.4
$lang['files_msg_ziperrorfound']	= 'Es trat ein Fehler während des archivierens auf. Bitte versuchen Sie es erneut.'; // UPDATE 1.4
$lang['files_msg_zipnotadded']		= 'Die folgenden Dateien konnten dem ZIP Archiv nicht hinzugefügt werden:<br />%s'; // UPDATE 1.4

$lang['files_tab_general']	    = 'Allgemein';
$lang['files_tab_preview']	    = 'Vorschau';
$lang['files_tab_sharing']	    = 'Veröffentlicht';
$lang['files_tab_description']	    = 'Beschreibung';

// Folder
$lang['folder_title_files']	    = 'Alle Dateien';
$lang['folder_title_add']		= 'Ordner hinzufügen';

$lang['folder_head_files']	    = 'Alle Dateien';
$lang['folder_head_add']		= 'Ordner hinzufügen';
$lang['folder_head_move']		= 'Verschieben';
$lang['folder_head_trash']		= 'Löschen';
$lang['folder_head_rename']		= 'Ordner umbenennen';

$lang['folder_desc_files']	    = 'Die folgenden Dateien wurden hochgeladen:';
$lang['folder_desc_add']		= 'Bitte wählen Sie einen Titel und Ordner:';
$lang['folder_desc_move']		= 'Bitte wählen Sie den Ordner, in den die Dateien verschoben werden sollen:';
$lang['folder_desc_trash']		= 'Möchten Sie die Auswahl wirklich löschen?';
$lang['folder_desc_rename']	    = 'Bearbeiten Sie den Ordner und speichern.'; // UPDATE 1.4

$lang['folder_btn_addfolder']	= 'Ordner hinzufügen';
$lang['folder_btn_cancel']		= 'Abbrechen';
$lang['folder_btn_move']		= 'In Ordner verschieben';
$lang['folder_btn_trash']		= 'Löschen';

$lang['folder_mnu_delete']		= 'Ordner löschen';
$lang['folder_mnu_open']		= 'Ordner öffnen';
$lang['folder_mnu_rename']		= 'Ordner umbenennen';

$lang['folder_lsttit_name']	    = 'Title';
$lang['folder_lsttit_size']	    = 'Größe';
$lang['folder_lsttit_date']	    = 'Datum';
$lang['folder_lsttit_actions']	= 'Aktionen';

$lang['folder_lbl_title']		= 'Title';
$lang['folder_lbl_parent']		= 'Übergeordnet';
$lang['folder_lbl_noparent']	= 'Keinen ( root )';
$lang['folder_lbl_root']		= 'ROOT';

$lang['folder_msg_noobjects']	= 'Keine Dateien im Ordner';
$lang['folder_msg_objectsfound']= '%s Dateien in Ordner';
$lang['folder_msg_noajax']		= 'Kein Ajax Request. Bitte versuchen Sie es erneut.';
$lang['folder_msg_nochange']	= 'Kann den Ordner nicht wechseln. Bitte versuchen Sie es erneut.';
$lang['folder_msg_notfound']	= 'Keine Objekte im Ordner gefunden.';
$lang['folder_msg_notchosen']	= 'Bitte wählen Sie zuerst einen Ordner.';
$lang['folder_msg_valerror']	= 'Es trat ein Fehler auf. Bitte versuchen Sie es erneut.';
$lang['folder_msg_addok']		= 'Der Ordner wurde erfolgreich erstellt.';
$lang['folder_msg_parammissing']	    = 'Mindestens ein Parameter fehlt.'; // UPDATE 1.4
$lang['folder_msg_renamesuccess']    = 'Ordner wurde erfolgreich umbenannt.'; // UPDATE 1.4
$lang['folder_msg_renameerror']	    = 'Es trat ein Fehler auf. Bitte versuchen sie es erneut.'; // UPDATE 1.4

// search - UPDATE 1.2
$lang['srch_title_results']	    = 'Suchergebnisse';

$lang['srch_head_results']	    = 'Suchergebnisse';

$lang['srch_desc_results']	    = 'Die nachfolgenden Dateien wurden zu Ihrem Suchbegriff "<strong>%s</strong>" gefunden';

$lang['srch_lsttit_file']	    = 'Datei';
$lang['srch_lsttit_size']	    = 'Größe';
$lang['srch_lsttit_uploaded']	    = 'Hochgeladen von';
$lang['srch_lsttit_downloads']	    = 'Downloads';
$lang['srch_lsttit_public']	    = 'Öffentlich';

$lang['srch_msg_noresults']	    = 'Keine Einträge zum gesuchten Begriff gefunden.';

// categories - UPDATE 1.2
$lang['cats_title_categories']	    = 'Kategorien';
$lang['cats_title_addcategory']	    = 'Kategorie hinzufügen';
$lang['cats_title_editcategory']    = 'Kategorie bearbeiten';

$lang['cats_head_addcategory']	    = 'Kategorie hinzufügen';
$lang['cats_head_editcategory']	    = 'Alle Kategorien';
$lang['cats_head_allcategory']	    = 'Kategorie bearbeiten';
$lang['cats_head_deletecategory']   = 'Kategorie löschen?';

$lang['cats_desc_addcategory']	    = 'Bitte geben Sie den Titel an. Alle Felder sind obligatorisch.';
$lang['cats_desc_editcategory']	    = 'Die nachfolgenden Daten sind über die Kategorie gespeichert. Alle Felder sind obligatorisch.';
$lang['cats_desc_allcategory']	    = 'Die folgenden Kategorien wurden bereits erstellt. Um eine Kategorie hinzuzufügen, klicken Sie auf "Neue Kategorie".';
$lang['cats_desc_deletecategory']   = 'Soll die Kategorie wirklich gelöscht werden?';

$lang['cats_lsttit_count']	    = '#';
$lang['cats_lsttit_name']	    = 'Titel';
$lang['cats_lsttit_actions']	    = 'Aktion';

$lang['cats_lbl_title']		    = 'Titel';
$lang['cats_lbl_remallfiles']	    = 'auch Dateien der Kategorie löschen?';

$lang['cats_btn_save']		    = 'Speichern';
$lang['cats_btn_edit']		    = 'Bearbeiten';
$lang['cats_btn_cancel']	    = 'Abbrechen';
$lang['cats_btn_delete']	    = 'Löschen';
$lang['cats_btn_close']		    = 'Schließen';
$lang['cats_btn_add']		    = 'Neue Kategorie';

$lang['cats_msg_nocatsfound']	    = 'Keine Kategorien gefunden.';
$lang['cats_msg_createthefirst']    = 'Erstellen Sie die Erste...';
$lang['cats_msg_catsuccessadded']   = 'Kategorie erfolgreich hinzugefügt.';
$lang['cats_msg_catsuccessupdated'] = 'Kategorie erfolgreich aktualisiert.';
$lang['cats_msg_catsuccessremove']  = 'Kategorie erfolgreich gelöscht.';
$lang['cats_msg_filesuccessadded']  = 'Die Datei wurde erfolgreich der Kategorie hinzugefügt.';
$lang['cats_msg_filesuccessrem']    = 'Die Datei wurde erfolgreich aus der Kategorie entfernt.';
$lang['cats_msg_erroradding']	    = 'Fehler beim hinzufügen der Kategorie. Bitte versuchen Sie es erneut.';
$lang['cats_msg_errorupdating']	    = 'Fehler beim aktualisieren der Kategorie. Bitte versuchen Sie es erneut.';
$lang['cats_msg_errorremoving']	    = 'Fehler beim löschen der Kategorie. Bitte versuchen Sie es erneut.';
$lang['cats_msg_catnotfound']	    = 'Die angeforderte Kategorie konnte nicht gefunden werden. Bitte versuchen Sie es erneut.';
$lang['cats_msg_fileincategory']    = 'Die Datei existiert bereits in der Kategorie.';
$lang['cats_msg_filenotincategory'] = 'Die Datei existiert nicht in der Kategorie!';
$lang['cats_msg_parametererror']    = 'Parameter Fehler. Bitte versuchen Sie es erneut.';
$lang['cats_msg_noajaxrequest']	    = 'Keine AJAX Anfrage. Abgebrochen.';
$lang['cats_msg_dberror']	    = 'Es scheint, als würde ein Datenbankfehler vorliegen.';

// publinks
$lang['pub_title_publiclinks']	    = 'Öffentliche Links';
$lang['pub_title_editpublink']	    = 'Öffentlicher Link bearbeiten';

$lang['pub_head_publiclinks']	    = 'Öffentliche Links';
$lang['pub_head_publicdetails']	    = 'Öffentlicher Link Details';

$lang['pub_desc_publiclinks']	    = 'Folgende öffentliche Links wurden bereits angelegt:';
$lang['pub_desc_publicdetails']	    = 'Folgende Daten sind über den Link gespeichert:';

$lang['pub_lsttit_count']	    = '#';
$lang['pub_lsttit_link']	    = 'Link';
$lang['pub_lsttit_created']	    = 'Erstellt von';
$lang['pub_lsttit_password']	    = 'Passwort';
$lang['pub_lsttit_limit']	    = 'Zeitlimit';
$lang['pub_lsttit_release']	    = 'Freigabe';
$lang['pub_lsttit_actions']	    = 'Aktionen';
$lang['pub_lsttit_file']	    = 'Datei';
$lang['pub_lsttit_available']	    = 'Verfügbar';
$lang['pub_lsttit_downloaded']	    = 'Geladen';

$lang['pub_txt_files']		    = 'Dateien:';
$lang['pub_txt_passyes']	    = 'gesetzt';
$lang['pub_txt_passno']		    = 'n/a';
$lang['pub_txt_delete']		    = 'Löschen?';
$lang['pub_txt_sure']		    = 'Sicher?';
$lang['pub_txt_yes']		    = 'Ja';
$lang['pub_txt_no']		    = 'Nein';
$lang['pub_txt_none']		    = 'Nicht gesetzt';
$lang['pub_txt_notset']		    = 'n/a';

$lang['pub_lbl_link']		    = 'Link';
$lang['pub_lbl_created']	    = 'Erstellt von';
$lang['pub_lbl_message']	    = 'Nachricht';
$lang['pub_lbl_password']	    = 'Passwort';
$lang['pub_lbl_available']	    = 'Gültig bis';
$lang['pub_lbl_files']		    = 'Dateien';
$lang['pub_lbl_share']		    = 'Teilen'; // UPDATE 1.3

$lang['pub_btn_cancel']		    = 'Abbrechen';

$lang['pub_msg_entryremovesuccess'] = 'Eintrag erfolgreich gelöscht';
$lang['pub_msg_dberrror']	    = 'Es trat ein Datenbankfehler auf. Bitte versuchen Sie es erneut.';
$lang['pub_msg_argumenterror']	    = 'Es trat ein Argumentsfehler auf.';
$lang['pub_msg_statuschangesuccess']= 'Der Status wurde erfolgreich geändert.';
$lang['pub_msg_statuschangeerror']  = 'Der Status konnte nicht geändert werden.';
$lang['pub_msg_erroroccured']	    = 'Es trat ein Fehler auf. Bitte versuchen Sie es erneut.';
$lang['pub_msg_nolinksfound']	    = 'Keine öffentlichen Links gefunden.';

// settings
$lang['set_title_settings']	    = 'Einstellungen';

$lang['set_head_settings']	    = 'Einstellungen';

$lang['set_desc_settings']	    = 'Bitte ändern Sie Systemeinstellungen mit größter Sorgfalt. Falsche Eingaben können dazu führen, dass das System nicht mehr stabil arbeitet. ';

$lang['set_lbl_product_name']	    = 'Produktbezeichnung';
$lang['set_lbl_email_protocol']	    = 'Protocol';
$lang['set_lbl_email_host']	    = 'Server';
$lang['set_lbl_email_user']	    = 'Benutzer';
$lang['set_lbl_email_pass']	    = 'Passwort';
$lang['set_lbl_email_port']	    = 'Port';
$lang['set_lbl_email_type_smtp']    = 'SMTP';
$lang['set_lbl_email_type_send']    = 'Sendmail';
$lang['set_lbl_email_type_mail']    = 'PHP Mail()';
$lang['set_lbl_sendmail_path']	    = 'Sendmail Pfad';
$lang['set_lbl_add_user_email']	    = 'Email an neuen Benutzer';
$lang['set_lbl_send_files_cust']    = 'Kunde hat neue Dateien hochgeladen';
$lang['set_lbl_send_files_email']   = 'Dateien per Email versenden';
$lang['set_lbl_add_files_email']    = 'Freigabe neuer Dateien';
$lang['set_lbl_system_language']    = 'System Sprache:';
$lang['set_lbl_add_user_subject']   = 'Email Betreff';
$lang['set_lbl_send_files_csubject']= 'Email Betreff';
$lang['set_lbl_send_files_subject'] = 'Email Betreff';
$lang['set_lbl_add_files_subject']  = 'Email Betreff';
$lang['set_lbl_enable_support']	    = 'Support Tab';
$lang['set_lbl_enable_support_yes'] = 'anzeigen';
$lang['set_lbl_enable_support_no']  = 'ausblenden';
$lang['set_lbl_google_analytics']   = 'Google Analytics'; // UPDATE 1.2
$lang['set_lbl_thumb_x']	    = 'Breite'; // UPDATE 1.2
$lang['set_lbl_thumb_y']	    = 'Höhe'; // UPDATE 1.2
$lang['set_lbl_image_library']	    = 'Bildbibiliothek'; // UPDATE 1.2
$lang['set_lbl_imglib_type_gd']	    = 'GD'; // UPDATE 1.2
$lang['set_lbl_imglib_type_gd2']    = 'GD2'; // UPDATE 1.2
$lang['set_lbl_imglib_type_imagemagick'] = 'ImageMagick'; // UPDATE 1.2
$lang['set_lbl_image_library_path'] = 'ImageMagick Pfad'; // UPDATE 1.2
$lang['set_lbl_enable_userupload']  = 'Benutzer kann hochladen'; // UPDATE 1.3
$lang['set_lbl_show_freespace_user']= 'Freier Speicher dem Benutzer anzeigen'; // UPDATE 1.3
$lang['set_lbl_download_type']	    = 'Download Typ'; // UPDATE 1.3
$lang['set_lbl_chunked_size']	    = 'Chunk Size'; // UPDATE 1.3
$lang['set_lbl_download_type_normal']	= 'Normal'; // UPDATE 1.3
$lang['set_lbl_download_type_chunked']	= 'Chunked'; // UPDATE 1.3
$lang['set_lbl_enable_userupload_yes']	= 'Ja'; // UPDATE 1.3
$lang['set_lbl_enable_userupload_no']	= 'Nein'; // UPDATE 1.3
$lang['set_lbl_show_freespace_user_yes']    = 'Ja'; // UPDATE 1.3
$lang['set_lbl_show_freespace_user_no']	    = 'Nein'; // UPDATE 1.3
$lang['set_lbl_send_files_reqsubject']	= 'Request Betreff'; // UPDATE 1.3
$lang['set_lbl_send_files_request'] = 'Upload via Request'; // UPDATE 1.3
$lang['set_lbl_show_index']			= 'Index zeigen<br />( oder weiterleiten )?'; // UPDATE 1.4
$lang['set_lbl_show_index_yes']		= 'Ja'; // UPDATE 1.4
$lang['set_lbl_show_index_no']		= 'Nein'; // UPDATE 1.4
$lang['set_lbl_show_catfolder']		= 'Standard Dateiansicht'; // UPDATE 1.4
$lang['set_lbl_show_catfolder_cat']	= 'Kategorienansicht'; // UPDATE 1.4
$lang['set_lbl_show_catfolder_fold'] = 'Ordneransicht'; // UPDATE 1.4
$lang['set_lbl_show_catfolder_both'] = 'Beide ( wählen )'; // UPDATE 1.4

$lang['set_btn_save']		    = 'Speichern';
$lang['set_btn_cancel']		    = 'Abbrechen';

$lang['set_nav_general']	    = 'Allgemein';
$lang['set_nav_email']		    = 'Email';
$lang['set_nav_templates']	    = 'Templates';
$lang['set_nav_thumbnails']	    = 'Thumbnails';
$lang['set_nav_downloads']  	    = 'Downloads';

$lang['set_msg_editsuccess']	    = 'Die Einträge wurden erfolgreich upgedated.';
$lang['set_msg_editerror']	    = 'Es trat ein Fehler beim Update auf. Bitte versuchen Sie es erneut.';
$lang['set_msg_nosettingsfound']    = 'Es konnten keine Einstellungen gefunden werden';

// uploads
$lang['up_title_uploads']	    = 'Uploads';
$lang['up_title_lastupload']	    = 'Letzter Upload';

$lang['up_head_fileupload']	    = 'Dateiupload';
$lang['up_head_latestupload']	    = 'Neuster Upload';

$lang['up_desc_fileupload']	    = 'Bitte wählen Sie die Dateien für den Upload per "Datei auswählen" aus. Bei neueren Browsern ( z.B. Firefox oder Chrome ) können Sie die Dateien auch per Drag & Drop in das Browserfenster ziehen um den Upload zu starten.<br /><br />Maximale Uploadgröße: %s';
$lang['up_desc_latestupload']	    = 'Folgende Dateien wurden zuletzt hochgeladen:';

$lang['up_btn_selectfile']	    = 'Dateien auswählen';
$lang['up_btn_startupload']	    = 'Upload starten';
$lang['up_btn_cancelupload']	    = 'Upload abbrechen';
$lang['up_btn_refresh']		    = 'Neuer Upload';
$lang['up_btn_overview']	    = 'Letzter Upload';

$lang['up_txt_userremoved']	    = 'Benutzer gelöscht';
$lang['up_txt_uprequest']	    = 'Upload Request'; // UPDATE 1.3

$lang['up_lsttit_file']		    = 'Datei';
$lang['up_lsttit_size']		    = 'Größe';
$lang['up_lsttit_uploaded']	    = 'Hochgeladen';
$lang['up_lsttit_downloads']	    = 'Downloads';
$lang['up_lsttit_public']	    = 'Öffentlich';

$lang['up_msg_nofilesinsystem']	    = 'Es sind noch keine Dateien im System.';
$lang['up_msg_addthefirst']	    = 'Fügen Sie die Ersten hinzu.';

// user
$lang['user_title_user']	    = 'Benutzer';
$lang['user_title_adduser']	    = 'Benutzer hinzufügen';
$lang['user_title_edituser']	    = 'Benutzer bearbeiten';

$lang['user_head_adduser']	    = 'Neuer Benutzer';
$lang['user_head_edituser']	    = 'Benutzer bearbeiten';
$lang['user_head_alluser']	    = 'Alle Benutzer';
$lang['user_head_infobgimage']	    = 'Hintergrund Abbildung';
$lang['user_head_url']		    = 'URL';
$lang['user_head_emailrecipient']   = 'Email Empfänger';
$lang['user_head_accepted']	    = 'Akzeptierte Dateien';

$lang['user_desc_adduser']	    = 'Bitte füllen Sie nachfolgendes Formular aus, um einen neuen Benutzer anzulegen. Alle Felder sind obligatorisch.';
$lang['user_desc_edituser']	    = 'Nachfolgende Daten sind über den Benutzer gespeichert. Alle Felder sind obligatorisch.';
$lang['user_desc_alluser']	    = 'Folgende Benutzer sind bereits im System angelegt. Um einen neuen Benutzer anzulegen, klicken Sie auf "Neuer Benutzer".';
$lang['user_desc_infobgimage']	    = '<p>Die Hintergrund Abbildung ist die Abbildung, die dem Benutzer als Vollbild beim Login gezeigt wird. 
Diese wird nicht beim Administratoren/Superadministratoren Login gezeigt, sondern ausschließlich beim Frontend Login.</p>
<p style="color:red;font-weight:bold;">Die Abbildung sollte folgende Eigenschaften besitzen:
    <ul>
	<li>1920x1060 Pixel</li>
	<li>JPEG</li>
	<li>max. 500 KB groß</li>
    </ul>
</p>';
$lang['user_desc_url']		    = '<p>Jeder Benutzer des Systems ( ausgeschlossen Administrator/Superadministratoren ) erhält eine eigene URL.</p>
<p>Über diese URL kann er sich mit seinem Passwort für den Up-/Download einloggen.</p>
<p class="color:red;font-weight:bold;">Benutzer haben keinen Zugriff auf das Administrationssystem</p>
<p><strong>Erlaubte Zeichen: A bis Z, 0 bis 9 sowie -</strong></p>';
$lang['user_desc_emailrecipient']   = '<p>Beim Email Empfänger geben Sie an, welcher Benutzer nach dem Upload im Frontend eine Bestätigungsemail erhalten soll.</p>';
$lang['user_desc_accepted']	    = '<p>Möchten Sie z.B. nur ZIP oder JPG akzeptieren, geben Sie bitte "zip|ZIP|jpg|JPG" an. Trennen Sie die zu akzeptierenden Dateiendungen mit einem "|". Sollen alle Dateitypen akzeptiert werden, lassen Sie das Feld leer.</p>';

$lang['user_lbl_user']		    = 'Benutzer';
$lang['user_lbl_name']		    = 'Name';
$lang['user_lbl_email']		    = 'Email';
$lang['user_lbl_password']	    = 'Passwort';
$lang['user_lbl_passwordagain']	    = 'Passwort wdh.';
$lang['user_lbl_timezone']	    = 'Zeitzone';
$lang['user_lbl_dateformat']	    = 'Datumsformat';
$lang['user_lbl_level']		    = 'Benutzerlevel';
$lang['user_lbl_background']	    = 'Hintergrund';
$lang['user_lbl_recipient']	    = 'Email Empf.';
$lang['user_lbl_sendregemail']	    = 'Reg. Email senden';
$lang['user_lbl_url']		    = 'URL';
$lang['user_lbl_maxsize']	    = 'Max. Dateigröße';
$lang['user_lbl_maxfiles']	    = 'Max. Anzahl Dateien';
$lang['user_lbl_accepttypes']	    = 'Akzeptierte Dateitypen';
$lang['user_lbl_canupload']	    = 'Benutzer kann hochladen'; // UPDATE 1.3
$lang['user_lbl_candownload']	    = 'Benutzer kann herunterladen'; // UPDATE 1.3
$lang['user_lbl_folder']            = 'Standardordner'; // UPDATE 1.4

$lang['user_btn_generate']	    = 'Generate';
$lang['user_btn_save']		    = 'Speichern';
$lang['user_btn_edit']		    = 'Bearbeiten';
$lang['user_btn_cancel']	    = 'Abbrechen';
$lang['user_btn_adduser']	    = 'Neuer Benutzer';
$lang['user_btn_close']		    = 'Schließen';

$lang['user_sel_levelsuperadmin']   = 'Superadministrator ( Vollzugriff auf Admin )';
$lang['user_sel_leveladmin']	    = 'Administrator ( Zugriff auf Admin / nicht auf Einstellungen )';
$lang['user_sel_leveluser']	    = 'Benutzer ( Nur Frontend Zugriff )';

$lang['user_txt_passonlyenterif']   = 'Passwort nur eingeben, wenn es geändert werden soll!';
$lang['user_txt_levelsuperadmin']   = 'Superadmin';
$lang['user_txt_leveladmin']	    = 'Admin';
$lang['user_txt_leveluser']	    = 'Benutzer';
$lang['user_txt_sure']		    = 'Sicher?';
$lang['user_txt_yes']		    = 'Ja';
$lang['user_txt_no']		    = 'Nein';
$lang['user_txt_delete']	    = 'Löschen?';
$lang['user_txt_files']		    = 'Dateien';
$lang['user_txt_file']		    = 'Datei';
$lang['user_txt_nofiles']	    = 'Keine Dateien';

$lang['user_lsttit_count']	    = '#';
$lang['user_lsttit_name']	    = 'Name';
$lang['user_lsttit_email']	    = 'Email';
$lang['user_lsttit_level']	    = 'Level';
$lang['user_lsttit_sharing']	    = 'Freigaben';
$lang['user_lsttit_access']	    = 'Zugriff';
$lang['user_lsttit_actions']	    = 'Aktionen';

$lang['user_msg_addok']		    = 'Eintrag erfolgreich hinzugefügt.';
$lang['user_msg_addoknoemail']	    = 'Eintrag angelegt, aber Email konnte nicht gesendet werden.';
$lang['user_msg_addoknoback']	    = 'Eintrag angelegt, aber Hintergrundbild konnte nicht hochgeladen werden.';
$lang['user_msg_addoknobackemail']  = 'Eintrag angelegt, aber Emailversand und Bildupload waren nicht erfolgreich.';
$lang['user_msg_editok']	    = 'Eintrag erfolgreich bearbeitet.';
$lang['user_msg_editoknoemail']	    = 'Eintrag bearbeitet, aber Email konnte nicht gesendet werden.';
$lang['user_msg_editoknoback']	    = 'Eintrag bearbeitet, aber Hintergrundbild konnte nicht hochgeladen werden.';
$lang['user_msg_editoknobackemail'] = 'Eintrag bearbeitet, aber Emailversand und Bildupload waren nicht erfolgreich.';
$lang['user_msg_editerror']	    = 'Der Eintrag konnte nicht bearbeitet werden.';
$lang['user_msg_deletesuccess']	    = 'Eintrag wurde erfolgreich gelöscht.';
$lang['user_msg_deletedberror']	    = 'Es trat ein Datenbankfehler auf. Bitte versuchen Sie es erneut.';
$lang['user_msg_deleteargerror']    = 'Es trat ein Argumentsfehler auf.';
$lang['user_msg_statussuccess']	    = 'Der Status wurde erfolgreich geändert.';
$lang['user_msg_statuserror']	    = 'Der Status konnte nicht geändert werden.';
$lang['user_msg_statusnotavailable']= 'Es trat ein Fehler auf. Bitte versuchen Sie es erneut.';
$lang['user_msg_seofielderror']	    = 'Das %s Feld darf nur die Zeichen a bis z, 0 bis 9 sowie - enthalten.';
$lang['user_msg_urlnotavailable']   = 'Die gewünschte URL ist leider schon vergeben. Bitte wählen Sie eine neue!';
$lang['user_msg_needtorelogin']	    = 'Sollten Sie Änderungen vornehmen, müssen Sie sich neu einloggen, damit die Änderungen wirksam werden.';
$lang['user_msg_nouserfound']	    = 'Keine Benutzer gefunden.';
$lang['user_msg_createthefirst']    = 'Erstellen Sie den Ersten.';
$lang['user_msg_emailalreadyreg']   = 'Die Emailadresse ist bereits registriert. Bitte versuchen Sie es erneut!';
$lang['user_msg_emailexists']	    = 'Diese Emailadresse ist registriert. Bitte wählen Sie eine andere.';
$lang['user_msg_lastsuperadmin']	= 'Sorry, Sie versuchen den Superadmin zu löschen - das ist nicht möglich.'; // UPDATE 1.4


// upload request
$lang['uploads_head_alluploads']    = 'Upload Request'; // UPDATE 1.3
$lang['uploads_head_add']	    = 'Neuer Upload Request'; // UPDATE 1.3
$lang['uploads_head_edit']	    = 'Upload Request bearbeiten'; // UPDATE 1.3

$lang['uploads_title_alluploads']   = 'Upload Requests'; // UPDATE 1.3
$lang['uploads_title_add']	    = 'Neuer Request'; // UPDATE 1.3
$lang['uploads_title_editupload']   = 'Request bearbeiten'; // UPDATE 1.3

$lang['uploads_desc_alluploads']    = 'Sie können einen Upload Request mit einer speziell generierten URL an Ihren Kunden senden.'; // UPDATE 1.3
$lang['uploads_desc_add']	    = 'Sie können eine Beschreibung der Anfrage hinzufügen. Diese wird im Upload Bereich angezeigt.'; // UPDATE 1.3
$lang['uploads_desc_edit']	    = 'Hier können Sie den Upload Request bearbeiten.'; // UPDATE 1.3

$lang['uploads_lsttit_count']	    = '#'; // UPDATE 1.3
$lang['uploads_lsttit_link']	    = 'Link'; // UPDATE 1.3
$lang['uploads_lsttit_created']	    = 'Erstellt'; // UPDATE 1.3
$lang['uploads_lsttit_release']	    = 'Freigegeben'; // UPDATE 1.3
$lang['uploads_lsttit_actions']	    = 'Aktionen'; // UPDATE 1.3

$lang['uploads_lbl_desc']	    = 'Beschreibung'; // UPDATE 1.3

$lang['uploads_btn_add']	    = 'Neuer Request'; // UPDATE 1.3
$lang['uploads_btn_create']	    = 'Neuer Request'; // UPDATE 1.3
$lang['uploads_btn_edit']	    = 'Request bearbeiten'; // UPDATE 1.3
$lang['uploads_btn_cancel']	    = 'Abbrechen'; // UPDATE 1.3

$lang['uploads_msg_statuschangesuccess']= 'Der Status wurde erfolgreich geändert.'; // UPDATE 1.3
$lang['uploads_msg_statuschangeerror']	= 'Es trat ein Fehler beim ändern des Status auf.'; // UPDATE 1.3
$lang['uploads_msg_addedsuccess']   = 'Der Request wurde erfolgreich erstellt.'; // UPDATE 1.3
$lang['uploads_msg_addederror']	    = 'Es trat ein Fehler beim erstellen des Requests auf.'; // UPDATE 1.3
$lang['uploads_msg_modsuccess']	    = 'Request wurde erfolgreich bearbeitet.'; // UPDATE 1.3
$lang['uploads_msg_moderror']	    = 'Es trat ein Fehler beim bearbeiten des Requests auf.'; // UPDATE 1.3
$lang['uploads_msg_argumenterror']  = 'Es trat ein Argumentenfehler auf. Bitte versuchen Sie es erneut.'; // UPDATE 1.3
$lang['uploads_msg_entryremovesuccess']= 'Eintrag wurde erfolgreich entfernt.'; // UPDATE 1.3
$lang['uploads_msg_dberrror']	    = 'Es trat ein Datenbankfehler auf. Bitte versuchen Sie es erneut.'; // UPDATE 1.3
$lang['uploads_msg_nolinksfound']   = 'Keine Upload Requests gefunden.'; // UPDATE 1.3.1

$lang['uploads_txt_sure']	    = 'Sicher?'; // UPDATE 1.3
$lang['uploads_txt_yes']	    = 'Ja'; // UPDATE 1.3
$lang['uploads_txt_no']		    = 'Nein'; // UPDATE 1.3


// log
$lang['log_head_overview']	    = 'Log'; // UPDATE 1.3
$lang['log_head_delete']	    = 'Löschen'; // UPDATE 1.3

$lang['log_title_log']		    = 'Log'; // UPDATE 1.3

$lang['log_desc_overview']	    = 'Die folgenden Einträge wurde erstellt:'; // UPDATE 1.3
$lang['log_desc_delete']	    = 'Sind Sie sicher?'; // UPDATE 1.3

$lang['log_lsttit_time']	    = 'Datum'; // UPDATE 1.3
$lang['log_lsttit_file']	    = 'Beschreibung'; // UPDATE 1.3
$lang['log_lsttit_size']	    = 'Größe'; // UPDATE 1.3

$lang['log_msg_na']		    = 'n/a'; // UPDATE 1.3
$lang['log_msg_deleteproblems']	    = 'Es trat ein Fehler während des löschens auf.'; // UPDATE 1.3
$lang['log_msg_deletesuccess']	    = 'Die gewählten Einträge wurden erfolgreich gelöscht.'; // UPDATE 1.3
$lang['log_msg_requesterror']	    = 'Es trat ein Fehler in der Anfrage auf. Bitte versuchen Sie es erneut.'; // UPDATE 1.3
$lang['log_msg_noajaxrequest']	    = 'Sorry, keine Ajax Anfrage. Bitte versuchen Sie es erneut...'; // UPDATE 1.3

$lang['log_lbl_selected']	    = 'Ausgewählte'; // UPDATE 1.3

$lang['log_sel_pleasechoose']	    = 'Bitte wählen...'; // UPDATE 1.3
$lang['log_sel_delete']		    = 'Löschen'; // UPDATE 1.3

$lang['log_btn_cancel']		    = 'Nein'; // UPDATE 1.3
$lang['log_btn_delete']		    = 'Ja'; // UPDATE 1.3


// import
$lang['import_head_import']	    = 'Import'; // UPDATE 1.3

$lang['import_title_import']	    = 'Import'; // UPDATE 1.3

$lang['import_desc_import']	    = 'Hier können Sie Dateien vom "data/import" Verzeichnis einlesen.'; // UPDATE 1.3

$lang['import_msg_nofilesfound']    = 'Keine Dateien gefunden!'; // UPDATE 1.3
$lang['import_msg_successfiles']    = 'Dateien wurden erfolgreich importiert.'; // UPDATE 1.3
$lang['import_msg_errorfiles']	    = 'Die folgenden Dateien konnten nicht importiert werden: '; // UPDATE 1.3
$lang['import_msg_nofilesto']	    = 'Keine Dateien gefunden.'; // UPDATE 1.3

$lang['import_lsttit_file']	    = 'Datei'; // UPDATE 1.3
$lang['import_lsttit_size']	    = 'Größe'; // UPDATE 1.3

$lang['import_btn_import']	    = 'Import'; // UPDATE 1.3


// request frontend
$lang['request_head_dashboard']	    = 'Dateien hochladen'; // UPDATE 1.3
$lang['request_head_freespace']	    = 'Freier Speicher'; // UPDATE 1.3
$lang['request_head_uprequest']	    = 'Upload Request'; // UPDATE 1.3
$lang['request_head_error']	    = 'Upload Request Fehler'; // UPDATE 1.3.1

$lang['request_title_publicupload'] = 'Upload Request'; // UPDATE 1.3
$lang['request_title_error']	    = 'Upload Request Fehler'; // UPDATE 1.3.1

$lang['request_desc_dashboard']	    = 'Sie können Dateien über "Dateien auswählen" oder per Drag&Drop hochladen.'; // UPDATE 1.3
$lang['request_desc_error']	    = 'Sie verfügen nicht über die notwendigen Rechte auf diese Resource zuzugreifen.'; // UPDATE 1.3.1

$lang['request_txt_freespace']	    = '%s von %s genutzt, <strong>%s frei</strong>'; // UPDATE 1.3

$lang['request_btn_choosefile']	    = 'Dateien wählen'; // UPDATE 1.3
$lang['request_btn_startupload']    = 'Upload'; // UPDATE 1.3
$lang['request_btn_cancelupload']   = 'Upload abbrechen'; // UPDATE 1.3
$lang['request_btn_refresh']	    = 'Neuer Upload'; // UPDATE 1.3


/*
 * jQuery Datatables
 */

$lang['datatbl_sProcessing']	    = 'Bitte warten...';
$lang['datatbl_sLengthMenu']	    = '_MENU_ Einträge anzeigen';
$lang['datatbl_sZeroRecords']	    = 'Keine Einträge vorhanden.';
$lang['datatbl_sInfo']		    = '_START_ bis _END_ von _TOTAL_ Einträgen';
$lang['datatbl_sInfoEmpty']	    = '0 bis 0 von 0 Einträgen';
$lang['datatbl_sInfoFiltered']	    = '(gefiltert von _MAX_  Einträgen)';
$lang['datatbl_sInfoPostFix']	    = '';
$lang['datatbl_sSearch']	    = 'Suchen';
$lang['datatbl_sFirst']		    = 'Erster';
$lang['datatbl_sPrevious']	    = 'Zurück';
$lang['datatbl_sNext']		    = 'Nächster';
$lang['datatbl_sLast']		    = 'Letzter';