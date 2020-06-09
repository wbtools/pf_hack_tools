<?php
/**
 * Created by PhpStorm.
 * User: PFinal南丞
 * Email: Lampxiezi@163.com
 * Date: 2020/6/9
 * Time: 15:25
 */
error_reporting(0);
set_time_limit(0);
banner();
function banner()
{
    echo "
  _____  ______ _             _ 
 |  __ \|  ____(_)           | |
 | |__) | |__   _ _ __   __ _| |
 |  ___/|  __| | | '_ \ / _` | |
 | |    | |    | | | | | (_| | |
 |_|    |_|    |_|_| |_|\__,_|_| v0.1
                                
	[+] Autor: PFinal南丞
	[+] Data: 2020/6/9
	[+] Name: pf_admin_scanner
	[+] Ajuda: pf_admin_scanner.php -h
";
}

if ($argv[1] == "-h" or $argv[1] == "-help") {
    echo "
OPTIONS[-i, -p, -h]
  -u    要扫描的目标url
  -h    帮助信息
 exemplos:
   pf_admin_scanner.php -u https://friday-go.cc/ 
   pf_admin_scanner.php -h
\n";
}

if ($argv[1] == "-u" && isset($argv[2])) {
    $location = array('admin/login', 'admin.php', 'admin/', 'administrator/', 'moderator/', 'webadmin/', 'adminarea/', 'bb-admin/', 'adminLogin/',
        'admin_area/', 'panel-administracion/', 'instadmin/', 'memberadmin/', 'administratorlogin/', 'adm/',
        'admin/account.php', 'admin/index.php', 'admin/login.php', 'admin/admin.php', 'admin/account.php',
        'joomla/administrator', 'login.php', 'admin_area/admin.php', 'admin_area/login.php', 'siteadmin/login.php',
        'siteadmin/index.php', 'siteadmin/login.html', 'admin/account.html', 'admin/index.html', 'admin/login.html',
        'admin/admin.html', 'admin_area/index.php', 'bb-admin/index.php', 'bb-admin/login.php', 'bb-admin/admin.php',
        'admin/home.php', 'admin_area/login.html', 'admin_area/index.html', 'admin/controlpanel.php', 'admincp/index.asp',
        'admincp/login.asp', 'admincp/index.html', 'admin/account.html', 'adminpanel.html', 'webadmin.html', 'webadmin/index.html',
        'webadmin/admin.html', 'webadmin/login.html', 'admin/admin_login.html', 'admin_login.html', 'panel-administracion/login.html',
        'admin/cp.php', 'cp.php', 'administrator/index.php', 'administrator/login.php', 'nsw/admin/login.php', 'webadmin/login.php',
        'admin/admin_login.php', 'admin_login.php', 'administrator/account.php', 'administrator.php', 'admin_area/admin.html',
        'pages/admin/admin-login.php', 'admin/admin-login.php', 'admin-login.php', 'bb-admin/index.html', 'bb-admin/login.html',
        'bb-admin/admin.html', 'admin/home.html', 'modelsearch/login.php', 'moderator.php', 'moderator/login.php', 'moderator/admin.php',
        'account.php', 'pages/admin/admin-login.html', 'admin/admin-login.html', 'admin-login.html', 'controlpanel.php', 'admincontrol.php',
        'admin/adminLogin.html', 'adminLogin.html', 'admin/adminLogin.html', 'home.html', 'rcjakar/admin/login.php', 'adminarea/index.html',
        'adminarea/admin.html', 'webadmin.php', 'webadmin/index.php', 'webadmin/admin.php', 'admin/controlpanel.html', 'admin.html',
        'admin/cp.html', 'cp.html', 'adminpanel.php', 'moderator.html', 'administrator/index.html', 'administrator/login.html',
        'user.html', 'administrator/account.html', 'administrator.html', 'login.html', 'modelsearch/login.html',
        'moderator/login.html', 'adminarea/login.html', 'panel-administracion/index.html', 'panel-administracion/admin.html',
        'modelsearch/index.html', 'modelsearch/admin.html', 'admincontrol/login.html', 'adm/index.html', 'adm.html',
        'moderator/admin.html', 'user.php', 'account.html', 'controlpanel.html', 'admincontrol.html',
        'panel-administracion/login.php', 'wp-login.php', 'adminLogin.php', 'admin/adminLogin.php', 'home.php',
        'adminarea/index.php', 'adminarea/admin.php', 'adminarea/login.php', 'panel-administracion/index.php',
        'panel-administracion/admin.php', 'modelsearch/index.php', 'modelsearch/admin.php', 'admincontrol/login.php',
        'adm/admloginuser.php', 'admloginuser.php', 'admin2.php', 'admin2/login.php', 'admin2/index.php', 'adm/index.php',
        'adm.php', 'affiliate.php', 'adm_auth.php', 'memberadmin.php');
    ob_implicit_flush(true);
    ob_end_flush();
    foreach ($location as $adminlocation) {
        $headers = get_headers("$argv[2]$adminlocation");
        if (!$headers) {
            echo "Please put http:// on your url";
            exit;
        } else {
            if (preg_match('/\s+200/', $headers[0])) {
                echo "$argv[2]$adminlocation   【success】\n";
                return;
            } else {
                echo "$argv[2]$adminlocation  【error】\n";
            }
        }
        sleep(1);
    }
} else {
    echo "Syntax : php $argv[0] -u https://friday-go.cc/  \n";
    exit;
}
