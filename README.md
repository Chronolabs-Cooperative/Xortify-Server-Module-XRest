# Xortify Server 5
## Module: XRest
## Author: Simon Antony Roberts <wishcraft@users.sourceforge.net>

This module is for the xortify.com server banning module, this is for operations with the open honeypot see: http://sourceforge.net/projects/xortify

# Rewrite: SEO Friendly URLS [.htaccess]

The following goes in the .htaccess if your running apache2 in the XOOPS_ROOT_PATH

    RewriteEngine On
    RewriteRule ^api/(.*?)$ ./modules/xrest/$1 [L,NC,QSA]
