### CloudSend. The easiest way to send files.

CloudSend was created for companies such as agencies that must constantly send files to the same customers or receive files from the same customers. The employee can upload files from the administration system and share it with it’s customers or create a public link for one time customers. Every customer can have it’s own URL with a full screen background image and login system to fit it’s CI. In this area, the customer can upload files directly to the company’s server or download files provided by company.


### Features

- FREE and Open Source [MIT License](https://opensource.org/licenses/MIT)
- Completely template-based for easy design modifications
- **Multilanguage:** English/German Version 1.4 ( Dutch/French/Portuguese/Spanish Version 1.3 ) already added ( easily adding more languages )
- Created with HMVC PHP ( CodeIgniter ) and the amazing Twitter Bootstrap – easy to modify and to understand
- Full Source Code
- SMTP / SENDMAIL / PHP MAIL() Support
- Files renamed for security reasons. Original filename restored while dowloading.
- Apache .htaccess Support for nice URLs
- Easy to use Step-By-Step installer


### Installation

- Clone the repo
- Upload all files to your webserver
- Point your browser to the upload, e.g. http://www.myinstallation.com/
- The installer starts automatically
- Follow the installer and enter the information requested
- Installation Done!

If you have chosen to use nice URL's, your webserver has to support .htaccess files like e.g. Apache with enabled mod_rewrite.
Create a .htaccess file with a text editor like Notepad++ (WIN) or TextWrangler (MAC) in the root path of your installation with the following content:

```TXT
RewriteEngine On
# If you have installed in a subfolder like mydomain.com/subfolder
# then change RewriteBase / to RewriteBase /subfolder
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [NC,L,QSA]		
```

For security reasons, it's the best idea to create a .htaccess file (if your webserver supports) with a text editor like Notepad++ (WIN) or TextWrangler (MAC) inside the "data" directory with the following content:

```TXT
deny from all
```

### Created by
CloudSend was created by [cloudworxx.us](http://www.cloudworxx.us). We do not provide Support at the moment. Later CloudSend will get it's own Website, Forum & more. Stay tuned.

### System Requirements

- Webserver *nix or Windows
- PHP 5
- MySQL 5 Datatabase
- at least 10 MB of free space
- Apache mod_rewrite enabled ( optional )

### Thanks to
CloudSend was created with the latest OpenSource Technology available on the market. We would like to thank

- Twitter for it’s amazing [Twitter Bootstrap](http://getbootstrap.com/)
- EllisLab for [CodeIgniter](http://ellislab.com/codeigniter)
- The jQuery Foundation for [jQuery](http://jquery.com/)
- Build Internet for it’s amazing [Supersized Fullscreen Background](http://buildinternet.com/project/supersized/)
- blueimp for it’s wonderful [jQuery Ajax Upload](http://blueimp.github.io/jQuery-File-Upload/)
- [Bootstrap WYSIHTML5](http://jhollingworth.github.io/bootstrap-wysihtml5/)
- [Zero Clipboard](http://jonrohan.github.io/ZeroClipboard/)