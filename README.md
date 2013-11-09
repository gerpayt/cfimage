CFImage
=======

CFImage is an OpenSource personal image manage system using yii and bootstrap.

###Requirements###
php >=5.1.0
yii >1.1.0
mysql >5.1

###Configuration###

##Import database##
Import cfimage to your database

##Edit configuration files##
Open index.php
Modify $yii and $config

Open protected/config/main.php
Modify database host,username,password,basename,prefix..
Modify sitename
Modify admin username and password

##Change permission##
Make these dirs writable
/assets
/protected/runtime
/upload

Changelog
---------
1.change order by createtime to id
2.check permission when download a image
