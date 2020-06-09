<?php
/**
 * Created by PhpStorm.
 * User: PFinal南丞
 * Email: Lampxiezi@163.com
 * Date: 2020/6/9
 * Time: 10:24
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
	[+] Name: pf_posts_sacn
	[+] Ajuda: ports_canner.php -h
";
}

if ($argv[1] == "-h" or $argv[1] == "-help") {
    echo "
OPTIONS[-i, -p, -h]
  -i    要扫描的目标ip
  -p    要扫描的目标端口
  -h    帮助信息
 exemplos:
   ports_canner.php -i 127.0.0.1 
   ports_canner.php -i 127.0.0.1 -p 80
   ports_canner.php -h
\n";
}
$ports = [21, 22, 23, 80, 8080, 443, 3306, 3389];
if ($argv[1] == "-i") {
    if (!is_null($argv[2])) {
        $host = $argv[2];
        if ($argv[3] == "-p") {
            if (!is_null($argv[4])) {
                if (strpos($argv[4], ",")) {
                    $ports = explode(",", $argv[4]);
                } else {
                    $ports = [$argv[4]];
                }
            } else {
                echo "Syntax : php $argv[0] -i 127.0.0.1 -p 8080\n";
                exit;
            }
        }
        check_postrs($host, $ports);
    } else {
        echo "Syntax : php $argv[0] -i 127.0.0.1 \n";
        exit;
    }
}

function check_postrs($host, $ports)
{
    foreach ($ports as $port) {
        $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if (socket_connect($sock, $host, $port)) {
            echo "port $port is open.\n";
            socket_close($sock);
        } else {
            echo "port $port is closed.\n";
            socket_close($sock);
        }
    }
}



