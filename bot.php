﻿﻿﻿<meta http-equiv='refresh' content='1'>
<title>Vip User Running...</title>
<!-- xml version="1.0" encoding="utf-8" -->

<html>
<style>
div {
	background-color:transparent;
	}
	</style>
	<body>
	<div><center><font color=green size=8><b>VIP USER GET LINK</b></font>
<br/>
<br/>
<font color=purple size=5><b>Vip User Started! Do not close the Tab<br>Close the tab to stop Vip User</b></font></center></div>
</html>
<?php
if (file_get_contents("time_clean.txt") <= (time() - 6 * 60)) {
    @file_get_contents("http://hitpro2.cloudapp.net/botvip/xoa.php");
    @file_get_contents("https://huyenthoai.pro/xoa.php");
    @file_put_contents("time_clean.txt", time());
}
//Include acc
include_once('config.php');
include_once('functions.php');
$cboxurl = $cbox_url . "&sec=main";
echo "<br>Cbox: " . $cboxurl;
$a       = file_get_contents($cboxurl);
$matches = explode('<tr id=', $a);
for ($i = 1; $i < 15; $i++) {
    $mess = $matches[$i];
    //Get ID User
    preg_match('%"(.*)">%U', $mess, $id);
    $id_user = $id[1];
    $ipp     = _Get($cbox_url . '&sec=getip&n=' . $Bot_Name . '&k=' . $Bot_Key . '&i=' . $id_user);
    $ipp1    = substr($ipp, 1, strlen($ipp));
    //Get User Name
    preg_match('%<b class="(.*)">(.*)</b>%U', $mess, $mem);
    $name = $mem[2];
    
    //Get Chat
    preg_match('%</b>:(.*)</td></tr>%U', $mess, $chat);
    $chat = $chat[1];
    
    
    ///Get Date
    $date = date('d/m/Y, H:i:s');
    // Get IP Post
    if ((Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) && preg_match("/@(.*?):/", $chat)) {
        preg_match("/@(.*?):/", $chat, $nem);
        $tag   = trim($nem[1]);
        $ipmem = Check_IP($tag);
        $ipmem = substr($ipmem, 1, strlen($ipmem));
    } else {
        $ipmem = Check_IP($name);
        $ipmem = substr($ipmem, 1, strlen($ipmem));
    }
    //Make userfile
    $user_file      = "user/" . md5($name) . ".txt"; //make link post
    $user_file2     = "time/" . md5($name) . ".txt"; //make time post
    $time_ip        = "timeip/" . md5($name) . ".txt";
    $link_rg        = 'http://vnz-leech.co/rg/';
    $link_fs        = 'http://file.itsuck.net/fs/';
    //   $download_file  = "download/" . md5($name) . "-" . base64_encode($id_user); // make link multi or folder
    $download_file1 = md5($name) . "==" . md5($id_user); // make link multi or folder
    $download_file2 = "redir/" . $download_file1;
    $noticemulti    = '[tim]Lưu ý : VIP member có thể Post Multi Link (Note: VIP members can Post Multi Link) [/mau]';
    $noticefolder   = '[tim]Lưu ý : VIP member có thể Post Link Folder và Multi Link (Note: VIP members can Post Link Folder and Multi Link) [/mau]';
    //Check Bot, Bots, Media
    if (preg_match('/\[media](.*)\[\/media]/', $mess) /* Skip bbcode [media] */ || Check_Bot($bots, $name) == true || strcmp($name, $Bot_Name) == 0); //Neu la Bot, Bots thi ko tra loi
    if (Check_SuperAdmin($superadmin, $name) == false && Check_Admin($adminlist, $name) == false && Check_Manager($manager, $name) == false && Check_Vip($viplist, $name) == false && Check_Vip2($viplist2, $name) == false) {
        
    } elseif (preg_match_all('/<a class="autoLink" href="(.*?)" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
        
    }
    
    else { //Neu khong phai la Bot, Bots, Media
        //Kiem tra post cua user co chua link down hay ko?
        //if (Check_SuperAdmin($superadmin, $name) == true && Check_Admin($adminlist, $name) == true && Check_Manager($manager, $name) == true && Check_Vip($viplist, $name) == true && Check_Vip2($viplist2, $name) == true){
        
        $link = explode('<a class="autoLink" href="', $chat);
        $link = explode('"', $link[1]);
        $link = $link[0] . '';
        
        
        
        
        
        if ($link != '') { //Neu co chua' link down
            $link       = str_replace("//ul.to", "//uploaded.net/file", $link);
            $link       = str_replace("//uploaded.to", "//uploaded.net", $link);
            $link       = str_replace("//oboom.com", "//oboom.com", $link);
            $link       = str_replace("//depositfile.org", "//depositfile.com", $link);
            $link       = str_replace("//1fichier.com", "//1fichier.com", $link);
            $link       = str_replace("//u26006872.letitbit.net", "//letitbit.net", $link);
            $link       = str_replace("//rg.to", "//rapidgator.net", $link);
            $link       = str_replace("//4share.vn", "//up.4share.vn", $link);
            $link       = str_replace("//extmatrix.com", "//extmatrix.com", $link);
            $link       = str_replace("//datafile.com", "//datafile.com", $link);
            $link       = str_replace("//www45.zippyshare.com", "//zippyshare.com", $link);
            $link       = str_replace("//mediafire.com", "//mediafire.com", $link);
            $link       = str_replace(array(
                '//k2s.cc',
                '//keep2s.cc'
            ), '//keep2share.cc', $link);
            $link       = str_replace('//m.turbobit.net', '//turbobit.net', $link);
            $link       = str_replace('%7C', '|', $link);
            $link_data  = str_replace('|', "_", $link);
            $host_check = strtolower(parse_url($link, PHP_URL_HOST));
            $host_check = str_replace('www.', '', $host_check);
            $host_check = ucwords($host_check);
            $iconf      = '[img]https://www.google.com/s2/favicons?domain=' . strtolower($host_check) . '[/img]';
            $size_file  = 'size/' . urlencode($name) . '-' . $host_check . '.txt';
            /* CHECK ALL CONDITION */
            $kiemtra    = true; //<= First is true, then if wrong condition, it says false
            
            if (Check_Support($bot_support, $link) == true) {
                //Get FileSize
                //    		preg_match('%<span style="color:#000000"><b>(.*)</b>%U', $chat, $match);
                //    		$filesize = str_replace(",",".",$match[1]);
                //    		$filesize = strtolower(trim($filesize));				
                ##################
                ###real size ###
                
                
                //Check link da duoc get chua
                $check = Check_Link($user_file, $id_user);
                if ($check == true);
                else //Neu link chua get
                    {
                    //Luu link xuong
                    $log  = fopen($user_file, "a", 1);
                    $data = $id_user . '|';
                    fwrite($log, $data);
                    fclose($log);
                    
                    $realcheck = "http://vnz-leech.com/checker/check.php?soigia2=ok&links=" . $link;
                    // $realcheck3 = "http://vnz-leech.com/checker/check.php?soigia2=ok&links=" . $link;
                    //  $realcheck2 = "http://getlink4u.com/checker/check.php?yyq1mw2=ok&links=" . $link;
                    // $realcheck4 = "http://getlink4u.com/checker/check.php?yyq1mw2=ok&links=" . $link;
                    
                    $randreal = array(
                        // $realcheck2,
                        $realcheck1,
                        // $realcheck4,
                        $realcheck3
                    );
                    //  $realcheck = $randreal[rand(0, count($randreal) - 1)];
                    
                    
                    $data = file_get_contents($realcheck);
                    
                    if (mb_detect_encoding($data) == 'UTF-8')
                        $data = preg_replace('/[^(\x20-\x7F)]*/', '', $data);
                    $sizereal = json_decode(substr($data, 1, strlen($data) - 2), true);
                    $filesize = $sizereal['filesize'];
                    $filesize = str_replace(" ", "", $filesize);
                    
                    $filename = $sizereal['filename'];
                    $checkten = $sizereal['filename'];
                    $status   = $sizereal['status'];
                    // format filename
                    $filename = str_replace(" ", "_", $filename);
                    $filename = str_replace("[", "_", $filename);
                    $filename = str_replace("www.", "w-w-w.", $filename);
                    $filename = str_replace("]", "_", $filename);
                    $filename = str_replace("\\", "_", $filename);
                    $filename = str_replace("@", "_", $filename);
                    $filename = str_replace('&#039;', "_", $filename);
                    $filename = str_replace('"', "_", $filename);
                    $filename = str_replace('$', "_", $filename);
                    $filename = str_replace('%', "_", $filename);
                    $filename = str_replace('&', "_", $filename);
                    
                    $filesize = strtolower(trim($filesize));
                    
                    
                    $filesize = strtolower(trim($filesize));
                    
                    /*  if ($status == "bad_link") {
                    // $kiemtra = false;
                    //  die();
                    } */
                    echo '<br/>';
                    echo $link . ' = <b><font color=red>' . $filesize . '</b></font>';
                    //}
                    
                    /* Check Vip IP Time Post */
                    if (Check_Vip($viplist, $name) == true || Check_Vip2($viplist2, $name) == true) {
                        if (Check_VIP_IP_Time_Post($id_user, $name)) {
                            if (Check_Time_IP2($time_ip, time())) {
                                $ip   = Read_File($vip_file);
                                $mess = '[b][vang]@' . $name . '[/mau]        [/b]: [center][b][vang]Cảnh báo Share Nick!!! Thành viên:[/mau][big][luc] ' . $name . '[/mau][/big][vang] đang sử dụng nhiều hơn 1 IP trong vòng ' . $limit_timeip . ' phút!! [/mau][br][vang]Share Nick Warning!!! Members:[/mau][big][luc] ' . $name . '[/mau][/big][vang] are using more than one IP within ' . $limit_timeip . ' minutes !! [/mau][br][br][tim]' . $ip_diff . '[/mau] and [tim]' . $ip . '[/mau][/b][/center]';
                                $messhtml .= '<!DOCTYPE HTML>
<html lang="vi" dir="ltr">
<head>
<title>' . $name . ' - Vi Phạm  - VNZ-LEECH.COM</title>
<meta charset="UTF-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
		body
		{
			background-color: #000000;
			font-size: 9pt;
			font-family:Verdana;
			line-height:12pt;
		}
		body,td,th {
			color: #cccccc;
		}
		h2
		{
			color: #FFCC00;
		}
</style>
</head>';
                                $messhtml .= '<center><b>Cảnh báo Share Nick!!! Thành viên: ' . $name . ' đang sử dụng nhiều hơn 1 IP trong vòng ' . $limit_timeip . ' phút!! <br><font color=\'red\'>' . $date . '</font><br>' . $ip_diff . ' and ' . $ip . '</b></center><hr>';
                                Write_File("log/" . urlencode($name) . ".html", $messhtml, 'a');
                                post_cbox($mess);
                                $kiemtra = true;
                                Write_File($vip_file, $ip, 'w');
                            } else
                                Write_File($vip_file, $ip_diff, 'w');
                        }
                        /* Check Vip IP Time Post */
                    }
                    
                    /* CHECK ALL CONDITION */
                    if ($kiemtra == true) {
                        if ($bot_start == true) {
                            if (Check_Vip($viplist, $name) == true || Check_Vip2($viplist2, $name) == true || Check_Admin($adminlist, $name) == true || Check_SuperAdmin($superadmin, $name) == true || Check_Manager($manager, $name) == true) {
                                if (count(explode('fshare.vn/file/', $link)) > 1) {
                                    
                                    if ($dunghostfs == true) {
                                        
                                        $link = file_get_contents($link_fs . 'post.php?apikey=vnz-team&file=' . $download_file . '&data=' . $link);
                                        //	$entry = $link_download . 'index.php?apikey=happy&file=' . $download_file;
                                        
                                        
                                        
                                        
                                        $array_atb = array(
                                            "[hong] VNZ.TEAM [/mau]",
                                            "[vang] VNZ.TEAM [/mau]",
                                            "[vang] Vip User [/mau]",
                                            "[den]Vip User[/mau]"
                                        );
                                        $atb       = $array_atb[rand(0, count($array_atb) - 1)];
                                        
                                        $entry1 = '[b][url=' . urlencode($link) . '][img]http://i.imgur.com/USblb4z.png[/img][br]' . $atb . ' |[color=DarkSlateGray] ' . $filename . ' [/color][color=brown] (' . strtoupper($filesize) . ') [/color][br][color=red][img]http://i.imgur.com/46bwxV8.png[/img][/color][/url][/b]';
                                        //$iconf  = [img]http://i.imgur.com/nJAgza0.png[/img]';
                                        $so_sv  = $fsvn[2] + 1;
                                    } else {
                                        
                                        
                                        
                                        
                                        $entry1 = Get_Link_Host($link, $fsvn[0], $fsvn[1], $download_file2, $ipmem);
                                        // $icon = '[img]http://i.imgur.com/nilYHA3.png[/img]';
                                        //$iconf  = [img]http://i.imgur.com/nJAgza0.png[/img]';
                                        $so_sv  = $fsvn[2] + 1;
                                        
                                    }
                                } elseif (count(explode('4share.vn/f/', $link)) > 1) {
                                    
                                    
                                    $entry1 = Get_Link_Host($link, $foursvn[0], $foursvn[1], $download_file2, $ipmem);
                                    
                                    // $icon = '[img]http://i.imgur.com/xJEW2Ny.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/8mqBD6E.png[/img]';
                                    $so_sv = $foursvn[2] + 1;
                                    
                                } /* 
                                elseif (count(explode('up.4share.vn', $link))>1) {
                                $entry1 = Get_Link_Host($link, $foursvn[0], $foursvn[1], $download_file2, $ipmem);
                                // $icon = '[img]http://i.imgur.com/xJEW2Ny.png[/img]';
                                $iconf = '[img]http://i.imgur.com/8mqBD6E.png[/img]';
                                } */ elseif (count(explode('share.vnn.vn', $link)) > 1) {
                                    
                                    
                                    $entry1 = Get_Link_Host($link, $svnn[0], $svnn[1], $download_file2, $ipmem);
                                    
                                    //	$icon   = '[img]http://i.imgur.com/Ld0LH3J.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/IZkNxV0.png[/img]';
                                    
                                } /*  elseif (count(explode('depfile.com', $link)) > 1) {
                                
                                
                                $entry1 = Get_Link_Host($link, $depfile[0], $depfile[1], $download_file2, $ipmem);
                                //$iconf  = [img]http://i.imgur.com/T5zBkOy.png[/img]';
                                $so_sv  = $depfile[2] + 1;
                                
                                } */ elseif (count(explode('depfile.com', $link)) > 1) {
                                    if (Check_Vip($viplist, $name) == true || Check_Vip2($viplist2, $name) == true) {
                                        if ($bot_bw == 'true') {
                                            $limit = "10 GB";
                                            
                                            $bandwith = Check_Bandwith($size_file, convert_size_bw($filesize), $limit);
                                            if ($bandwith != false) {
                                                if (strpos($filesize, 'kb') != 0) {
                                                    $entry1 .= Get_Link_Host($link, $depfile[0], $depfile[1], $download_file2, $ipmem);
                                                    if (stristr($entry1, "Please try again")) {
                                                    } else {
                                                        $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                        Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                    }
                                                    $so_sv = $depfile[2] + 1;
                                                } elseif (strpos($filesize, 'mb') != 0) {
                                                    $size      = explode(".", $filesize);
                                                    $filesizes = trim($size[0]);
                                                    if ($filesize > 10250) {
                                                        $entry1 = '' . $iconf . '[b][big]  [den]' . $host_check . '[/mau][vang] limit  10 GB [/mau] [br][color=purple] Link của bạn có size là [den](' . strtoupper($filesize) . ')  [/mau] [/big][/color] [/b]';
                                                        if (stristr($entry1, "Please try again")) {
                                                        } else {
                                                            $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                    } else {
                                                        $entry1 .= Get_Link_Host($link, $depfile[0], $depfile[1], $download_file2, $ipmem);
                                                        if (stristr($entry1, "Please try again")) {
                                                        } else {
                                                            $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                        $so_sv = $depfile[2] + 1;
                                                    }
                                                } elseif (strpos($filesize, 'gb') != 0) {
                                                    $size      = explode(".", $filesize);
                                                    $filesizes = trim($size[0]);
                                                    if ($filesize > 10) {
                                                        $entry1 = '' . $iconf . '[b][big]  [den]' . $host_check . '[/mau][vang] limit  5 GB [/mau] [br][color=purple] Link của bạn có size là [den](' . strtoupper($filesize) . ')  [/mau] [/big][/color] [/b]';
                                                        if (stristr($entry1, "Please try again")) {
                                                        } else {
                                                            $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                    } else {
                                                        $entry1 .= Get_Link_Host($link, $depfile[0], $depfile[1], $download_file2, $ipmem);
                                                        if (stristr($entry1, "Please try again")) {
                                                        } else {
                                                            $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                        $so_sv = $depfile[2] + 1;
                                                    }
                                                } else {
                                                    $entry1 .= Get_Link_Host($link, $depfile[0], $depfile[1], $download_file2, $ipmem);
                                                    if (stristr($entry1, "Please try again")) {
                                                    } else {
                                                        $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                        Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                    }
                                                    $so_sv = $depfile[2] + 1;
                                                }
                                            } else {
                                                $entry1 .= '[b][color=green] You\'ve used up ' . $limit . ' for ' . $host_check . ' today. [/color]  [br] [color=blue] Bạn đã sử dụng hết ' . $limit . ' băng thông ' . $host_check . ' trong hôm nay. [/color] [/b]';
                                                
                                            }
                                        }
                                    } elseif (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) {
                                        
                                        $entry1 = Get_Link_Host($link, $depfile[0], $depfile[1], $download_file2, $ipmem);
                                        $so_sv  = $depfile[2] + 1;
                                    }
                                    
                                } elseif (count(explode('filesmonster.com', $link)) > 1) {
                                    
                                    
                                    $entry1 = Get_Link_Host($link, $filesmonster[0], $filesmonster[1], $download_file2, $ipmem);
                                    //$iconf  = [img]http://cdn.alldebrid.com/lib/images/hosts/filesmonster.png[/img]';
                                    $so_sv  = $filesmonster[2] + 1;
                                    
                                } elseif (count(explode('datafile.com', $link)) > 1) {
                                    if (Check_Vip($viplist, $name) == true || Check_Vip2($viplist2, $name) == true) {
                                        if ($bot_bw == 'true') {
                                            $limit    = "50 GB";
                                            $bandwith = Check_Bandwith($size_file, convert_size_bw($filesize), $limit);
                                            if ($bandwith != false) {
                                                
                                                $entry1 .= Get_Link_Host($link, $datafile[0], $datafile[1], $download_file2, $ipmem);
                                                if (stristr($entry1, "Please try again")) {
                                                } else {
                                                    $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                    Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                }
                                                $so_sv = $datafile[2] + 1;
                                                
                                            } else {
                                                $entry1 .= '[b][color=green] You\'ve used up ' . $limit . ' for ' . $host_check . ' today. [/color]  [br] [color=blue] Bạn đã sử dụng hết ' . $limit . ' băng thông ' . $host_check . ' trong hôm nay. [/color] [/b]';
                                                
                                            }
                                        }
                                    } elseif (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) {
                                        
                                        $entry1 = Get_Link_Host($link, $datafile[0], $datafile[1], $download_file2, $ipmem);
                                        $so_sv  = $datafile[2] + 1;
                                    }
                                    
                                } elseif (count(explode('ul.to', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $ul[0], $ul[1], $download_file2, $ipmem);
                                    
                                    //$iconf  = [img]http://i.imgur.com/td1N5Fb.png[/img]';
                                    $so_sv = $ul[2] + 1;
                                    
                                } elseif (count(explode('rarefile.net', $link)) > 1) {
                                    
                                    
                                    $entry1 = Get_Link_Host($link, $rarefile[0], $rarefile[1], $download_file2, $ipmem);
                                    //$iconf  = [img]http://www.rarefile.net/favicon.ico[/img]';
                                    $so_sv  = $rarefile[2] + 1;
                                    
                                } elseif (count(explode('tusfiles.net', $link)) > 1) {
                                    
                                    
                                    $entry1 = Get_Link_Host($link, $tusfiles[0], $tusfiles[1], $download_file2, $ipmem);
                                    
                                    //    $entry1 = '11111111111111111111111';
                                    //$iconf  = [img]http://debriditalia.com/images/TF.png[/img]';
                                    $so_sv = $tusfiles[2] + 1;
                                    
                                } elseif (count(explode('\/\/uploading.com', $link)) > 1) {
                                    
                                    
                                    $entry1 = Get_Link_Host($link, $uld[0], $uld[1], $download_file2, $ipmem);
                                    //$iconf  = [img]http://i.imgur.com/aCixJg9.png[/img]';
                                    $so_sv  = $uld[2] + 1;
                                    
                                } elseif (count(explode('nowdownload', $link)) > 1) {
                                    
                                    
                                    $entry1 = Get_Link_Host($link, $nowdownload[0], $nowdownload[1], $download_file2, $ipmem);
                                    //$iconf  = [img]http://i.imgur.com/c1HXRdT.png[/img]';
                                    $so_sv  = $nowdownload[2] + 1;
                                    
                                } elseif (count(explode('vip-file.com', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $vipfile[0], $vipfile[1], $download_file2, $ipmem);
                                    //$iconf  = [img]http://i.imgur.com/NtzJOQf.png[/img]';
                                    
                                } elseif (count(explode('upfile.vn', $link)) > 1) {
                                    //    if(Check_SuperAdmin($superadmin, $name)==true || Check_Admin($adminlist, $name)==true || Check_Manager($manager, $name)==true || Check_Vip($viplist, $name)==true) {
                                    //    $entry1 = Get_Link_Host($link, $ufvn[0], $ufvn[1], $download_file2, $ipmem);
                                    $entry1 = ' [big][b][color=green] Đối với link  [/color][color=purple]upfile.vn [/color][color=green]các bạn đăng ký miễn phí và tải maxspeed nhé( [/color][color=blue] cbox không hỗ trợ host này[/color][color=green] )  [/color][/b][/big][img]http://smiles.vinaget.us/loa_loa.gif[/img]';
                                    // $icon = '[img]http://i.imgur.com/4Odwddz.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/8DPJR9X.png[/img]';
                                }
                                //    }
                                    elseif (count(explode('tenlua.vn/download/', $link)) > 1) {
                                    
                                    //    $entry1 = '[big][b][color=green] Tài khoản VIP host[/color] [color=purple]tenlua.vn[/color] [color=green]là[/color]: [color=blue]jambrucklee@gmail.com[/color] [br] [color=green]password[/color]: [color=blue]vnzleech[/color][br][color=red]Lấy link xong nhớ thoát ra - Đừng đổi mật khẩu vô ích![/color][/b][/big]';
                                    $entry1 = Get_Link_Host($link, $tlvn[0], $tlvn[1], $download_file2, $ipmem);
                                    
                                    // $icon = '[img]http://i.imgur.com/d61PrKw.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/ir6RDW2.png[/img]';
                                    
                                } elseif (count(explode('mediafire.com', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $mf[0], $mf[1], $download_file2, $ipmem);
                                    
                                    // $icon = '[img]http://i.imgur.com/nXqKXQr.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/I1h7TRN.png[/img]';
                                    $so_sv = $mf[2] + 1;
                                    
                                } elseif (count(explode('netload.in', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $nl[0], $nl[1], $download_file2, $ipmem);
                                    // $icon = '[img]http://i.imgur.com/fmm1Wzj.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/28C90E2.png[/img]';
                                    $so_sv  = $nl[2] + 1;
                                    
                                } elseif (count(explode('uploaded.net', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $ul[0], $ul[1], $download_file2, $ipmem);
                                    
                                    // $icon = '[img]http://i.imgur.com/BQbnZlV.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/DK7USZK.png[/img]';
                                    $so_sv = $ul[2] + 1;
                                    
                                } /*  elseif (count(explode('rapidgator.net', $link)) > 1) {
                                if ($dunghostrg == true) {
                                
                                $link = file_get_contents($link_rg . 'post.php?apikey=vnz-team&file=' . $download_file . '&data=' . $link);
                                //	$entry = $link_download . 'index.php?apikey=happy&file=' . $download_file;
                                
                                
                                
                                
                                $array_atb = array(
                                "[hong] VNZ.TEAM [/mau]",
                                "[vang] VNZ.TEAM [/mau]",
                                "[vang] Vip User [/mau]",
                                "[den]Vip User[/mau]"
                                );
                                $atb       = $array_atb[rand(0, count($array_atb) - 1)];
                                
                                $entry1 = '[b][url=' . urlencode($link) . '][img]http://i.imgur.com/USblb4z.png[/img][br]' . $atb . ' |[color=DarkSlateGray] ' . $filename . ' [/color][color=brown] (' . strtoupper($filesize) . ') [/color][br][color=red][img]http://i.imgur.com/46bwxV8.png[/img][/color][/url][/b]';
                                //$iconf  = [img]http://i.imgur.com/nJAgza0.png[/img]';
                                $so_sv  = $rg[2] + 1;
                                } else {
                                
                                
                                
                                
                                $entry1 = Get_Link_Host($link, $rg[0], $rg[1], $download_file2, $ipmem);
                                // $icon = '[img]http://i.imgur.com/nilYHA3.png[/img]';
                                //$iconf  = [img]http://i.imgur.com/nJAgza0.png[/img]';
                                $so_sv  = $rg[2] + 1;
                                
                                }
                                }  */ elseif (count(explode('rapidgator.net', $link)) > 1) {
                                    if (Check_Vip($viplist, $name) == true || Check_Vip2($viplist2, $name) == true) {
                                        if ($bot_bw == 'true') {
                                            $limit = "10 GB";
                                            
                                            $bandwith = Check_Bandwith($size_file, convert_size_bw($filesize), $limit);
                                            if ($bandwith != false) {
                                                
                                                $entry1 .= Get_Link_Host($link, $rg[0], $rg[1], $download_file2, $ipmem);
                                                if (stristr($entry1, "Please try again")) {
                                                } else {
                                                    $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                    Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                }
                                                $so_sv = $rg[2] + 1;
                                                
                                            } else {
                                                $entry1 .= '[b][color=green] You\'ve used up ' . $limit . ' for ' . $host_check . ' today. [/color]  [br] [color=blue] Bạn đã sử dụng hết ' . $limit . ' băng thông ' . $host_check . ' trong hôm nay. [/color] [/b]';
                                                
                                            }
                                        }
                                    } elseif (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) {
                                        
                                        $entry1 = Get_Link_Host($link, $rg[0], $rg[1], $download_file2, $ipmem);
                                        $so_sv  = $rg[2] + 1;
                                    }
                                    
                                } elseif (count(explode('hitfile.net', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $hitfile[0], $hitfile[1], $download_file2, $ipmem);
                                    // $icon = '[img]http://i.imgur.com/nilYHA3.png[/img]';
                                    //$iconf  = [img]https://linksnappy.com/templates/images/filehosts/small/hitfile.net.png[/img]';
                                    $so_sv  = $hitfile[2] + 1;
                                    
                                } elseif (count(explode('letitbit.net', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $ltb[0], $ltb[1], $download_file2, $ipmem);
                                    // $icon = '[img]http://i.imgur.com/bKiXadj.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/bjnfppa.png[/img]';
                                    $so_sv  = $ltb[2] + 1;
                                    
                                } elseif (count(explode('novafile.com', $link)) > 1) {
                                    if (Check_Vip($viplist, $name) == true || Check_Vip2($viplist2, $name) == true) {
                                        if ($bot_bw == 'true') {
                                            $limit    = "5 GB";
                                            $bandwith = Check_Bandwith($size_file, convert_size_bw($filesize), $limit);
                                            if ($bandwith != false) {
                                                if (strpos($filesize, 'kb') != 0) {
                                                    $entry1 .= Get_Link_Host($link, $nvf[0], $nvf[1], $download_file2, $ipmem);
                                                    
                                                    if (stristr($entry1, "Please try again")) {
                                                    } else {
                                                        $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                        Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                    }
                                                    $so_sv = $nvf[2] + 1;
                                                } elseif (strpos($filesize, 'gb') != 0) {
                                                    $size      = explode(".", $filesize);
                                                    $filesizes = trim($size[0]);
                                                    if ($filesize > 50) {
                                                        $entry1 = '' . $iconf . '[b][big]  [den]' . $host_check . '[/mau][vang] limit  5 GB [/mau] [br][color=purple] Link của bạn có size là [den](' . strtoupper($filesize) . ')  [/mau] [/big][/color] [/b]';
                                                        if (stristr($entry1, "Please try again")) {
                                                        } else {
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                    } else {
                                                        $entry1 .= Get_Link_Host($link, $nvf[0], $nvf[1], $download_file2, $ipmem);
                                                        if (stristr($entry1, "Please try again")) {
                                                        } else {
                                                            $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                        $so_sv = $nvf[2] + 1;
                                                    }
                                                } else {
                                                    $entry1 .= Get_Link_Host($link, $nvf[0], $nvf[1], $download_file2, $ipmem);
                                                    if (stristr($entry1, "Please try again")) {
                                                    } else {
                                                        $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                        Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                    }
                                                    $so_sv = $nvf[2] + 1;
                                                }
                                            } else {
                                                $entry1 .= '[b][color=green] You\'ve used up ' . $limit . ' for ' . $host_check . ' today. [/color]  [br] [color=blue] Bạn đã sử dụng hết ' . $limit . ' băng thông ' . $host_check . ' trong hôm nay. [/color] [/b]';
                                                
                                            }
                                        }
                                    } elseif (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) {
                                        
                                        $entry1 = Get_Link_Host($link, $nvf[0], $nvf[1], $download_file2, $ipmem);
                                        $so_sv  = $nvf[2] + 1;
                                    }
                                    
                                } elseif (count(explode('turbobit.net', $link)) > 1) {
                                    if (Check_Vip($viplist, $name) == true || Check_Vip2($viplist2, $name) == true) {
                                        if ($bot_bw == 'true') {
                                            $limit    = "5 GB";
                                            $bandwith = Check_Bandwith($size_file, convert_size_bw($filesize), $limit);
                                            if ($bandwith != false) {
                                                if (strpos($filesize, 'kb') != 0) {
                                                    $entry1 .= Get_Link_Host($link, $tbb[0], $tbb[1], $download_file2, $ipmem);
                                                    
                                                    if (stristr($entry1, "Please try again")) {
                                                    } else {
                                                        $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                        Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                    }
                                                    $so_sv = $tbb[2] + 1;
                                                } elseif (strpos($filesize, 'mb') != 0) {
                                                    $size      = explode(".", $filesize);
                                                    $filesizes = trim($size[0]);
                                                    if ($filesize > 102500) {
                                                        $entry1 = '' . $iconf . '[b][big]  [den]' . $host_check . '[/mau][vang] limit  1023 MB [/mau] [br][color=purple] Link của bạn có size là [den](' . strtoupper($filesize) . ')  [/mau] [/big][/color] [/b]';
                                                        if (stristr($entry1, "Please try again")) {
                                                        } else {
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                    } else {
                                                        $entry1 .= Get_Link_Host($link, $tbb[0], $tbb[1], $download_file2, $ipmem);
                                                        if (stristr($entry1, "Please try again")) {
                                                        } else {
                                                            $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                        $so_sv = $tbb[2] + 1;
                                                    }
                                                } else {
                                                    $entry1 .= Get_Link_Host($link, $tbb[0], $tbb[1], $download_file2, $ipmem);
                                                    if (stristr($entry1, "Please try again")) {
                                                    } else {
                                                        $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                        Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                    }
                                                    $so_sv = $tbb[2] + 1;
                                                }
                                            } else {
                                                $entry1 = '[b][color=green] You\'ve used up ' . $limit . ' for ' . $host_check . ' today. [/color]  [br] [color=blue] Bạn đã sử dụng hết ' . $limit . ' băng thông ' . $host_check . ' trong hôm nay. [/color] [br][tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                
                                            }
                                        }
                                    } elseif (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) {
                                        
                                        $entry1 = Get_Link_Host($link, $tbb[0], $tbb[1], $download_file2, $ipmem);
                                        $so_sv  = $tbb[2] + 1;
                                    }
                                    
                                } elseif (count(explode('keep2share.cc', $link)) > 1) {
                                    if (Check_Vip($viplist, $name) == true || Check_Vip2($viplist2, $name) == true) {
                                        if ($bot_bw == 'true') {
                                            $limit = "5 GB";
                                            
                                            $bandwith = Check_Bandwith($size_file, convert_size_bw($filesize), $limit);
                                            if ($bandwith != false) {
                                                if (strpos($filesize, 'kb') != 0) {
                                                    $entry1 .= Get_Link_Host($link, $k2s[0], $k2s[1], $download_file2, $ipmem);
                                                    if (stristr($entry1, "Please try again")) {
                                                    } else {
                                                        $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                        Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                    }
                                                    $so_sv = $k2s[2] + 1;
                                                } elseif (strpos($filesize, 'mb') != 0) {
                                                    $size      = explode(".", $filesize);
                                                    $filesizes = trim($size[0]);
                                                    if ($filesize > 10250) {
                                                        $entry1 = '' . $iconf . '[b][big]  [den]' . $host_check . '[/mau][vang] limit  5 GB [/mau] [br][color=purple] Link của bạn có size là [den](' . strtoupper($filesize) . ')  [/mau] [/big][/color] [/b]';
                                                        if (stristr($entry1, "Please try again")) {
                                                        } else {
                                                            $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                    } else {
                                                        $entry1 .= Get_Link_Host($link, $k2s[0], $k2s[1], $download_file2, $ipmem);
                                                        if (stristr($entry1, "Please try again")) {
                                                        } else {
                                                            $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                        $so_sv = $k2s[2] + 1;
                                                    }
                                                } elseif (strpos($filesize, 'gb') != 0) {
                                                    $size      = explode(".", $filesize);
                                                    $filesizes = trim($size[0]);
                                                    if ($filesize > 20) {
                                                        $entry1 = '' . $iconf . '[b][big]  [den]' . $host_check . '[/mau][vang] limit  5 GB [/mau] [br][color=purple] Link của bạn có size là [den](' . strtoupper($filesize) . ')  [/mau] [/big][/color] [/b]';
                                                        if (stristr($entry1, "Please try again")) {
                                                        } else {
                                                            $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                    } else {
                                                        $entry1 .= Get_Link_Host($link, $k2s[0], $k2s[1], $download_file2, $ipmem);
                                                        if (stristr($entry1, "Please try again")) {
                                                        } else {
                                                            $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                        $so_sv = $k2s[2] + 1;
                                                    }
                                                } else {
                                                    $entry1 .= Get_Link_Host($link, $k2s[0], $k2s[1], $download_file2, $ipmem);
                                                    if (stristr($entry1, "Please try again")) {
                                                    } else {
                                                        $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                        Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                    }
                                                    $so_sv = $k2s[2] + 1;
                                                }
                                            } else {
                                                $entry1 .= '[b][color=green] You\'ve used up ' . $limit . ' for ' . $host_check . ' today. [/color]  [br] [color=blue] Bạn đã sử dụng hết ' . $limit . ' băng thông ' . $host_check . ' trong hôm nay. [/color] [/b]';
                                                
                                            }
                                        }
                                    } elseif (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) {
                                        
                                        $entry1 = Get_Link_Host($link, $k2s[0], $k2s[1], $download_file2, $ipmem);
                                        $so_sv  = $k2s[2] + 1;
                                    }
                                    
                                } elseif (count(explode('filefactory.com', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $ff[0], $ff[1], $download_file2, $ipmem);
                                    
                                    $so_sv = $ff[2] + 1;
                                    
                                } elseif (count(explode('filepost.com', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $fp[0], $fp[1], $download_file2, $ipmem);
                                    
                                    // $icon = '[img]http://i.imgur.com/9QVVfz4.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/gUX8lIe.png[/img]';
                                    $so_sv = $fp[2] + 1;
                                    
                                } elseif (count(explode('4shared.com', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $foursed[0], $foursed[1], $download_file2, $ipmem);
                                    
                                    // $icon = '[img]http://i.imgur.com/A2Z21Rb.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/ZOCDiN1.png[/img]';
                                    $so_sv = $foursed[2] + 1;
                                    
                                } elseif (count(explode('depositfiles.com', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $df[0], $df[1], $download_file2, $ipmem);
                                    
                                    //$iconf  = [img]http://www.zevera.com/images/hostericons/depositfiles.png[/img]';
                                    // $icon = '[img]http://i.imgur.com/sEPTKOc.png[/img]';
                                    $so_sv = $df[2] + 1;
                                    
                                } elseif (count(explode('terafile.co', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $tf[0], $tf[1], $download_file2, $ipmem);
                                    // $icon = '[img]http://i.imgur.com/iDKopkz.png[/img]';
                                    $so_sv  = $tf[2] + 1;
                                    
                                } elseif (count(explode('oboom.com', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $ob[0], $ob[1], $download_file2, $ipmem);
                                    
                                    // $icon = '[img]http://i.imgur.com/M5HEMvt.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/vakxOd5.png[/img]';
                                    $so_sv = $ob[2] + 1;
                                    
                                } elseif (count(explode('bitshare.com', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $bs[0], $bs[1], $download_file2, $ipmem);
                                    // $icon = '[img]http://i.imgur.com/uBWw2Ji.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/jTxWJvJ.png[/img]';
                                    $so_sv  = $bs[2] + 1;
                                    
                                } elseif (count(explode('uptobox.com', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $utb[0], $utb[1], $download_file2, $ipmem);
                                    
                                    // $icon = '[img]http://i.imgur.com/n4lhiOM.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/0XgnmIB.png[/img]';
                                    $so_sv = $utb[2] + 1;
                                    
                                } elseif (count(explode('extmatrix.com', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $exm[0], $exm[1], $download_file2, $ipmem);
                                    
                                    // $icon = '[img]http://i.imgur.com/GxcNBgE.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/iZQm3Xi.png[/img]';
                                    $so_sv = $exm[2] + 1;
                                    
                                } elseif (count(explode('mega.co.nz', $link)) > 1 || count(explode('mega.nz', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $mcn[0], $mcn[1], $download_file2, $ipmem);
                                    
                                    // $icon = '[img]http://i.imgur.com/8hUx7mx.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/21MKu1g.png[/img]';
                                    $so_sv = $mcn[2] + 1;
                                    
                                } elseif (count(explode('freakshare.com', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $frs[0], $frs[1], $download_file2, $ipmem);
                                    // $icon = '[img]http://i.imgur.com/8NrCjcL.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/nVGLoDT.png[/img]';
                                    
                                } elseif (count(explode('firedrive.com', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $fd[0], $fd[1], $download_file2, $ipmem);
                                    // $icon = '[img]http://i.imgur.com/qleIz6i.png[/img]';
                                    $so_sv  = $fd[2] + 1;
                                    
                                } elseif (count(explode('zippyshare.com', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $zps[0], $zps[1], $download_file2, $ipmem);
                                    
                                    // $icon = '[img]http://i.imgur.com/aJKHII2.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/TiWmjl7.png[/img]';
                                    $so_sv = $zps[2] + 1;
                                    
                                } elseif (count(explode('crocko.com', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $crk[0], $crk[1], $download_file2, $ipmem);
                                    // $icon = '[img]http://i.imgur.com/Cfx0pwf.png[/img]';
                                    $so_sv  = $crk[2] + 1;
                                    
                                } elseif (count(explode('megashares.com', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $mgs[0], $mgs[1], $download_file2, $ipmem);
                                    
                                    // $icon = '[img]http://i.imgur.com/j1kaGbt.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/BZRWXyF.png[/img]';
                                    $so_sv = $mgs[2] + 1;
                                    
                                } elseif (count(explode('youtube.com', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $ytb[0], $ytb[1], $download_file2, $ipmem);
                                    //     $icon = '[img]http://i.imgur.com/6NxtEQD.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/qII26m4.png[/img]';
                                    $so_sv  = $ytb[2] + 1;
                                    
                                } elseif (count(explode('littlebyte.net', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $lttb[0], $lttb[1], $download_file2, $ipmem);
                                    
                                    // $icon = '[img]http://littlebyte.net/images/logo.gif[/img]';
                                    //$iconf  = [img]http://i.imgur.com/eSOjnhV.png[/img]';
                                    $so_sv = $lttb[2] + 1;
                                    
                                } elseif (count(explode('share-online.biz', $link)) > 1) {
                                    
                                    $entry1 = Get_Link_Host($link, $sob[0], $sob[1], $download_file2, $ipmem);
                                    //$iconf  = [img]http://www.debriditalia.com/images/SO.png[/img]';
                                    // $icon = '[img]http://i.imgur.com/6d2oFZW.png[/img]';
                                    $so_sv  = $sob[2] + 1;
                                    
                                } elseif (count(explode('subyshare.com', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/15A5l8D.jpg[/img]';
                                    //$iconf  = [img]http://i.imgur.com/eaYm5ye.gif[/img]';
                                    $entry1 = Get_Link_Host($link, $subyshare[0], $subyshare[1], $download_file2, $ipmem);
                                    $so_sv  = $subyshare[2] + 1;
                                    
                                } elseif (count(explode('uploadable.ch', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/JhRgXwv.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/5Jc3h2d.png[/img]';
                                    $entry1 = Get_Link_Host($link, $uab[0], $uab[1], $download_file2, $ipmem);
                                    
                                    $so_sv = $uab[2] + 1;
                                    
                                } elseif (count(explode('bigfile.to', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/JhRgXwv.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/5Jc3h2d.png[/img]';
                                    $entry1 = Get_Link_Host($link, $uab[0], $uab[1], $download_file2, $ipmem);
                                    
                                    $so_sv = $uab[2] + 1;
                                    
                                } elseif (count(explode('uloz.to', $link)) > 1) {
                                    // $icon = '[img]http://i.imgur.com/LLMV59i.png[/img]';
                                    $iconf  = '[img]http://uloz.to/favicon.ico[/img]';
                                    $entry1 = Get_Link_Host($link, $uloz[0], $uloz[1], $download_file2, $ipmem);
                                    
                                    $so_sv = $uloz[2] + 1;
                                } elseif (count(explode('speedyshare.com', $link)) > 1 || count(explode('speedy.sh', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/LLMV59i.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/MLdIP4K.png[/img]';
                                    $entry1 = Get_Link_Host($link, $spds[0], $spds[1], $download_file2, $ipmem);
                                    
                                    $so_sv = $spds[2] + 1;
                                    
                                } elseif (count(explode('upstore.net', $link)) > 1 || count(explode('upsto.re', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/LLMV59i.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/MLdIP4K.png[/img]';
                                    $entry1 = Get_Link_Host($link, $upstore[0], $upstore[1], $download_file2, $ipmem);
                                    
                                    $so_sv = $upstore[2] + 1;
                                    
                                } elseif (count(explode('nitroflare.com', $link)) > 1) {
                                    if (Check_Vip($viplist, $name) == true || Check_Vip2($viplist2, $name) == true) {
                                        if ($bot_bw == 'true') {
                                            $limit    = "5 GB";
                                            $bandwith = Check_Bandwith($size_file, convert_size_bw($filesize), $limit);
                                            if ($bandwith != false) {
                                                if (strpos($filesize, 'kb') != 0) {
                                                    $entry1 .= Get_Link_Host($link, $nitro[0], $nitro[1], $ipp1);
                                                    
                                                    if (stristr($entry1, "Please try again")) {
                                                    } elseif (stristr($entry1, "Link Dead")) {
                                                    } else {
                                                        $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                        Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                    }
                                                    $so_sv = $nitro[2] + 1;
                                                } elseif (strpos($filesize, 'mb') != 0) {
                                                    $size      = explode(".", $filesize);
                                                    $filesizes = trim($size[0]);
                                                    if ($filesize > 20480) {
                                                        $entry1 = '' . $iconf . '[b][big]  [den]' . $host_check . '[/mau][vang] limit  5 GB [/mau] [br][color=purple] Link của bạn có size là [den](' . strtoupper($filesize) . ')  [/mau] [/big][/color] [/b]';
                                                        if (stristr($entry1, "Please try again")) {
                                                        } else {
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                    } else {
                                                        $entry1 .= Get_Link_Host($link, $nitro[0], $nitro[1], $download_file2, $ipmem);
                                                        if (stristr($entry1, "Please try again")) {
                                                        } elseif (stristr($entry1, "Link Dead")) {
                                                        } else {
                                                            $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                        $so_sv = $nitro[2] + 1;
                                                    }
                                                } elseif (strpos($filesize, 'gb') != 0) {
                                                    $size      = explode(".", $filesize);
                                                    $filesizes = trim($size[0]);
                                                    if ($filesize > 20) {
                                                        $entry1 = '' . $iconf . '[b][big]  [den]' . $host_check . '[/mau][vang] limit  5 GB [/mau] [br][color=purple] Link của bạn có size là [den](' . strtoupper($filesize) . ')  [/mau] [/big][/color] [/b]';
                                                        if (stristr($entry1, "Please try again")) {
                                                        } elseif (stristr($entry1, "Link Dead")) {
                                                        } else {
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                    } else {
                                                        $entry1 .= Get_Link_Host($link, $nitro[0], $nitro[1], $ipp1);
                                                        if (stristr($entry1, "Please try again")) {
                                                        } else {
                                                            $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                        $so_sv = $nitro[2] + 1;
                                                    }
                                                } else {
                                                    $entry1 .= Get_Link_Host($link, $nitro[0], $nitro[1], $ipp1);
                                                    if (stristr($entry1, "Please try again")) {
                                                    } else {
                                                        $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                        Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                    }
                                                    $so_sv = $nitro[2] + 1;
                                                }
                                            } else {
                                                $entry1 .= '[b][color=green] You\'ve used up ' . $limit . ' for ' . $host_check . ' today. [/color]  [br] [color=blue] Bạn đã sử dụng hết ' . $limit . ' băng thông ' . $host_check . ' trong hôm nay. [/color] [/b]';
                                                
                                            }
                                        }
                                    } elseif (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) {
                                        
                                        $entry1 = Get_Link_Host($link, $nitro[0], $nitro[1], $ipp1);
                                        $so_sv  = $nitro[2] + 1;
                                    }
                                    
                                } elseif (count(explode('filenext.com', $link)) > 1) {
                                    if (Check_Vip($viplist, $name) == true || Check_Vip2($viplist2, $name) == true) {
                                        if ($bot_bw == 'true') {
                                            $limit    = "3 GB";
                                            $bandwith = Check_Bandwith($size_file, convert_size_bw($filesize), $limit);
                                            if ($bandwith != false) {
                                                if (strpos($filesize, 'kb') != 0) {
                                                    $entry1 .= Get_Link_Host($link, $filenext[0], $filenext[1], $ipp1);
                                                    
                                                    if (stristr($entry1, "Please try again")) {
                                                    } elseif (stristr($entry1, "Link Dead")) {
                                                    } else {
                                                        $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                        Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                    }
                                                    $so_sv = $filenext[2] + 1;
                                                } elseif (strpos($filesize, 'mb') != 0) {
                                                    $size      = explode(".", $filesize);
                                                    $filesizes = trim($size[0]);
                                                    if ($filesize > 20480) {
                                                        $entry1 = '' . $iconf . '[b][big]  [den]' . $host_check . '[/mau][vang] limit  5 GB [/mau] [br][color=purple] Link của bạn có size là [den](' . strtoupper($filesize) . ')  [/mau] [/big][/color] [/b]';
                                                        if (stristr($entry1, "Please try again")) {
                                                        } else {
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                    } else {
                                                        $entry1 .= Get_Link_Host($link, $filenext[0], $filenext[1], $download_file2, $ipmem);
                                                        if (stristr($entry1, "Please try again")) {
                                                        } elseif (stristr($entry1, "Link Dead")) {
                                                        } else {
                                                            $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                        $so_sv = $filenext[2] + 1;
                                                    }
                                                } elseif (strpos($filesize, 'gb') != 0) {
                                                    $size      = explode(".", $filesize);
                                                    $filesizes = trim($size[0]);
                                                    if ($filesize > 20) {
                                                        $entry1 = '' . $iconf . '[b][big]  [den]' . $host_check . '[/mau][vang] limit  5 GB [/mau] [br][color=purple] Link của bạn có size là [den](' . strtoupper($filesize) . ')  [/mau] [/big][/color] [/b]';
                                                        if (stristr($entry1, "Please try again")) {
                                                        } elseif (stristr($entry1, "Link Dead")) {
                                                        } else {
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                    } else {
                                                        $entry1 .= Get_Link_Host($link, $filenext[0], $filenext[1], $ipp1);
                                                        if (stristr($entry1, "Please try again")) {
                                                        } else {
                                                            $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                        $so_sv = $filenext[2] + 1;
                                                    }
                                                } else {
                                                    $entry1 .= Get_Link_Host($link, $filenext[0], $filenext[1], $ipp1);
                                                    if (stristr($entry1, "Please try again")) {
                                                    } else {
                                                        $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                        Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                    }
                                                    $so_sv = $filenext[2] + 1;
                                                }
                                            } else {
                                                $entry1 .= '[b][color=green] You\'ve used up ' . $limit . ' for ' . $host_check . ' today. [/color]  [br] [color=blue] Bạn đã sử dụng hết ' . $limit . ' băng thông ' . $host_check . ' trong hôm nay. [/color] [/b]';
                                                
                                            }
                                        }
                                    } elseif (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) {
                                        
                                        $entry1 = Get_Link_Host($link, $filenext[0], $filenext[1], $ipp1);
                                        $so_sv  = $filenext[2] + 1;
                                    }
                                    
                                } elseif (count(explode('scribd.com', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/S0n99jw.png[/img]';
                                    $entry1 = Get_Link_Host($link, $scribd[0], $scribd[1], $download_file2, $ipmem);
                                    $so_sv  = $scribd[2] + 1;
                                    
                                } elseif (count(explode('hugefiles.net', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/ikAspmL.png[/img]';
                                    $entry1 = Get_Link_Host($link, $hugefiles[0], $hugefiles[1], $download_file2, $ipmem);
                                    
                                    $so_sv = $hugefiles[2] + 1;
                                    
                                } elseif (count(explode('filesflash.com', $link)) > 1 || count(explode('filesflash.net', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/bQUBbuH.png[/img]';
                                    $entry1 = Get_Link_Host($link, $filesflash[0], $filesflash[1], $download_file2, $ipmem);
                                    
                                    $so_sv = $filesflash[2] + 1;
                                    
                                } elseif (count(explode('shareflare', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/BT7tKbT.png[/img]';
                                    $entry1 = Get_Link_Host($link, $shareflare[0], $shareflare[1], $download_file2, $ipmem);
                                    //$so_sv = $filesflash[2]+1;
                                    
                                } elseif (count(explode('soundcloud.com', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/VDdHL5X.png[/img]';
                                    $entry1 = Get_Link_Host($link, $soundcloud[0], $soundcloud[1], $download_file2, $ipmem);
                                    
                                    $so_sv = $soundcloud[2] + 1;
                                    
                                } elseif (count(explode('.1fichier.com', $link)) > 1 || count(explode('1fichier.com', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = '[img]https://cdn.realdebrid.xtnetwork.fr/0469/images/hosters/1fichier.png[/img]';
                                    $entry1 = Get_Link_Host($link, $onefichier[0], $onefichier[1], $download_file2, $ipmem);
                                    
                                    $so_sv = $onefichier[2] + 1;
                                    
                                } elseif (count(explode('sendspace.com', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/L36Z9wK.png[/img]';
                                    $entry1 = Get_Link_Host($link, $sendspace[0], $sendspace[1], $download_file2, $ipmem);
                                    $so_sv  = $sendspace[2] + 1;
                                    
                                } elseif (count(explode('yunfile.com', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/OylZ7Dh.png[/img]';
                                    $entry1 = Get_Link_Host($link, $yunfile[0], $yunfile[1], $download_file2, $ipmem);
                                    
                                    $so_sv = $yunfile[2] + 1;
                                    
                                } elseif (count(explode('secureupload.eu', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://jetdebrid.com/images/hosts/secureupload.png[/img]';
                                    $entry1 = Get_Link_Host($link, $secureuploadeu[0], $secureuploadeu[1], $download_file2, $ipmem);
                                    $so_sv  = $secureuploadeu[2] + 1;
                                    
                                } elseif (count(explode('salefiles', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://jetdebrid.com/images/hosts/salefiles.png[/img]';
                                    $entry1 = Get_Link_Host($link, $salefiles[0], $salefiles[1], $download_file2, $ipmem);
                                    
                                    $so_sv = $salefiles[2] + 1;
                                    
                                } elseif (count(explode('openload', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://jetdebrid.com/images/hosts/salefiles.png[/img]';
                                    $entry1 = Get_Link_Host($link, $openload[0], $openload[1], $download_file2, $ipmem);
                                    
                                    $so_sv = $openload[2] + 1;
                                    
                                } elseif (count(explode('24upload', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://jetdebrid.com/images/hosts/24uploading.png[/img]';
                                    $entry1 = Get_Link_Host($link, $haibonuld[0], $haibonuld[1], $download_file2, $ipmem);
                                    $so_sv  = $haibonuld[2] + 1;
                                    
                                } elseif (count(explode('filespace', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://jetdebrid.com/images/hosts/filespace.png[/img]';
                                    $entry1 = Get_Link_Host($link, $filespace[0], $filespace[1], $download_file2, $ipmem);
                                    $so_sv  = $filespace[2] + 1;
                                    
                                } elseif (count(explode('upload.cd', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://jetdebrid.com/images/hosts/upload.png[/img]';
                                    $entry1 = Get_Link_Host($link, $uploadcd[0], $uploadcd[1], $download_file2, $ipmem);
                                    $so_sv  = $uploadcd[2] + 1;
                                    
                                } elseif (count(explode('wushare', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://jetdebrid.com/images/hosts/wushare.png[/img]';
                                    $entry1 = Get_Link_Host($link, $wushare[0], $wushare[1], $download_file2, $ipmem);
                                    $so_sv  = $wushare[2] + 1;
                                    
                                } elseif (count(explode('kingfiles', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://jetdebrid.com/images/hosts/kingfiles.png[/img]';
                                    $entry1 = Get_Link_Host($link, $kingfiles[0], $kingfiles[1], $download_file2, $ipmem);
                                    $so_sv  = $kingfiles[2] + 1;
                                    
                                } elseif (count(explode('uploadrocket', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://jetdebrid.com/images/hosts/uploadrocket.png[/img]';
                                    $entry1 = Get_Link_Host($link, $uploadrocket[0], $uploadrocket[1], $download_file2, $ipmem);
                                    $so_sv  = $uploadrocket[2] + 1;
                                    
                                } elseif (count(explode('uplea', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://jetdebrid.com/images/hosts/uplea.png[/img]';
                                    $entry1 = Get_Link_Host($link, $uplea[0], $uplea[1], $download_file2, $ipmem);
                                    $so_sv  = $uplea[2] + 1;
                                } elseif (count(explode('easybytez.com', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/FOtkbUJ.png[/img]';
                                    $entry1 = Get_Link_Host($link, $easybytez[0], $easybytez[1], $download_file2, $ipmem);
                                    $so_sv  = $easybytez[2] + 1;
                                } elseif (count(explode('alfafile.net', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]https://alfafile.net/img/sep5.png[/img]';
                                    $entry1 = Get_Link_Host($link, $alfafile[0], $alfafile[1], $download_file2, $ipmem);
                                    $so_sv  = $alfafile[2] + 1;
                                } elseif (count(explode('filejoker.net', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://i.imgur.com/qZYMESx.png[/img]';
                                    $entry1 = Get_Link_Host($link, $filejoker[0], $filejoker[1], $download_file2, $ipmem);
                                    $so_sv  = $filejoker[2] + 1;
                                } elseif (count(explode('userscloud.com', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://debriditalia.com/images/UC.png[/img]';
                                    $entry1 = Get_Link_Host($link, $userscloud[0], $userscloud[1], $download_file2, $ipmem);
                                    $so_sv  = $userscloud[2] + 1;
                                } elseif (count(explode('clicknupload', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://debriditalia.com/images/UC.png[/img]';
                                    $entry1 = Get_Link_Host($link, $userscloud[0], $userscloud[1], $download_file2, $ipmem);
                                    $so_sv  = $userscloud[2] + 1;
                                } elseif (count(explode('faststore', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://debriditalia.com/images/UC.png[/img]';
                                    $entry1 = Get_Link_Host($link, $userscloud[0], $userscloud[1], $download_file2, $ipmem);
                                    $so_sv  = $userscloud[2] + 1;
                                } elseif (count(explode('2shared.com', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://debriditalia.com/images/SHH.png[/img]';
                                    $entry1 = Get_Link_Host($link, $twoshared[0], $twoshared[1], $download_file2, $ipmem);
                                    $so_sv  = $twoshared[2] + 1;
                                } elseif (count(explode('inclouddrive.com', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://debriditalia.com/images/ID.png[/img]';
                                    $entry1 = Get_Link_Host($link, $inclouddrive[0], $inclouddrive[1], $download_file2, $ipmem);
                                    $so_sv  = $inclouddrive[2] + 1;
                                } elseif (count(explode('filespace.com', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://www.premiumax.net/assets/images/hosts/filespace.png[/img]';
                                    $entry1 = Get_Link_Host($link, $filespace[0], $filespace[1], $download_file2, $ipmem);
                                    $so_sv  = $filespace[2] + 1;
                                } elseif (count(explode('redtube.com', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]https://cdn.realdebrid.xtnetwork.fr/0469/images/hosters/redtube.png[/img]';
                                    $entry1 = Get_Link_Host($link, $redtube[0], $redtube[1], $download_file2, $ipmem);
                                    $so_sv  = $redtube[2] + 1;
                                } elseif (count(explode('mediafree.co', $link)) > 1) {
                                    
                                    // $icon = '[img]http://i.imgur.com/1GvSftn.png[/img]';
                                    //$iconf  = [img]http://file.itsuck.net/icons/mediafree.co.png[/img]';
                                    $entry1 = Get_Link_Host($link, $mediafree[0], $mediafree[1], $download_file2, $ipmem);
                                    $so_sv  = $mediafree[2] + 1;
                                } elseif (count(explode('fboom.me', $link)) > 1) {
                                    if (Check_Vip($viplist, $name) == true || Check_Vip2($viplist2, $name) == true) {
                                        if ($bot_bw == 'true') {
                                            $limit    = "5 GB";
                                            $bandwith = Check_Bandwith($size_file, convert_size_bw($filesize), $limit);
                                            if ($bandwith != false) {
                                                if (strpos($filesize, 'kb') != 0) {
                                                    $entry1 .= Get_Link_Host($link, $fboom[0], $fboom[1], $download_file2, $ipmem);
                                                    if (stristr($entry1, "Please try again")) {
                                                    } else {
                                                        $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                        Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                    }
                                                    $so_sv = $fboom[2] + 1;
                                                } elseif (strpos($filesize, 'gb') != 0) {
                                                    $size      = explode(".", $filesize);
                                                    $filesizes = trim($size[0]);
                                                    if ($filesize > 20) {
                                                        $entry1 = '' . $iconf . '[b][big]  [den]' . $host_check . '[/mau][vang] limit  5 GB [/mau] [br][color=purple] Link của bạn có size là [den](' . strtoupper($filesize) . ')  [/mau] [/big][/color] [/b]';
                                                        if (stristr($entry1, "Please try again")) {
                                                        } else {
                                                            $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                    } else {
                                                        $entry1 .= Get_Link_Host($link, $fboom[0], $fboom[1], $download_file2, $ipmem);
                                                        if (stristr($entry1, "Please try again")) {
                                                        } else {
                                                            $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                            Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                        }
                                                        $so_sv = $fboom[2] + 1;
                                                    }
                                                } else {
                                                    $entry1 .= Get_Link_Host($link, $fboom[0], $fboom[1], $download_file2, $ipmem);
                                                    if (stristr($entry1, "Please try again")) {
                                                    } else {
                                                        $entry1 .= '[br][br] [b][color=blue] Bandwidth[den] ' . $host_check . '[/mau] Used: [/color] [tim] ' . $bandwith['used'] . ' [/mau]    [color=blue] Bandwidth[den] ' . $host_check . '[/mau] Left: [/color] [tim] ' . $bandwith['remain'] . ' [/mau][/b]';
                                                        Write_File($size_file, date('d/m/Y') . '|' . $bandwith['save'], 'w');
                                                    }
                                                    $so_sv = $fboom[2] + 1;
                                                }
                                            } else {
                                                $entry1 .= '[b][color=green] You\'ve used up ' . $limit . ' for ' . $host_check . ' today. [/color]  [br] [color=blue] Bạn đã sử dụng hết ' . $limit . ' băng thông ' . $host_check . ' trong hôm nay. [/color] [/b]';
                                                
                                            }
                                        }
                                    } elseif (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) {
                                        
                                        $entry1 = Get_Link_Host($link, $fboom[0], $fboom[1], $download_file2, $ipmem);
                                        $so_sv  = $fboom[2] + 1;
                                    }
                                    
                                }
                                
                                
                                /* elseif (count(explode('ieech.tk', $link)) > 1 || count(explode('getl11.tk', $link)) > 1 || count(explode('getl9.tk', $link)) > 1 || count(explode('getl8.tk', $link)) > 1) {
                                Del_Mess_Blacklist($name);
                                }   */
                            }
                        }
                        if (strcmp($entry1, "") != 0) {
                            /*                             //Check and get info about IP
                            $ip = Check_IP($name);
                            if ($ip) {
                            $ip      = substr($ip, 1);
                            $tracker = "http://www.ip-tracker.org/locator/ip-lookup.php?ip=" . $ip;
                            $infos   = file_get_contents($tracker);
                            if (!empty($infos)) {
                            $info = explode('<div id="maincontent">', $infos);
                            if (!empty($info[1])) {
                            $location = explode("<td class='vazno'>", $info[1]);
                            if (!empty($location[1])) {
                            $cities = explode('</td></tr><tr><th>', $location[1]);
                            if (!empty($cities[0])) {
                            $city = urlencode($cities[0]);
                            }
                            }
                            $locations = explode("<td class='tracking lessimpt'>", $info[1]);
                            if (!empty($locations[1])) {
                            $states = explode('</td></tr><tr><th>', $locations[1]);
                            if (!empty($states[0])) {
                            $state = urlencode($states[0]);
                            }
                            }
                            $contiment = explode('</tr><tr><th>Country:</th><td>', $info[1]);
                            if (!empty($contiment[1])) {
                            $countries = explode(" &nbsp;&nbsp;", $contiment[1]);
                            if (!empty($countries[0])) {
                            $country = urlencode($countries[0]);
                            }
                            }
                            $capital = explode("<img src='", $info[1]);
                            if (!empty($capital[1])) {
                            $flags = explode("'> (", $capital[1]);
                            if (!empty($flags[0])) {
                            $flag = "http://www.ip-tracker.org/" . $flags[0];
                            }
                            }
                            }
                            }
                            } */
                            
                            //$arrow = $array_arrow[rand(0, count($array_arrow)-1)];
                            if (Check_SuperAdmin($superadmin, $name) == true) {
                                if (preg_match("/@(.*?):/", $chat, $nem)) {
                                    //	$command = "info '";
                                    //	Del_Mess_One($name, $command);
                                    //Luu file + time
                                    $data = $id_user . '|';
                                    Write_File($user_file, $data, 'a', 1);
                                    $ten = $nem[1];
                                    if (strcmp($name, "Happy") == 0)
                                        $name = "Hap-py";
                                    //    $mess = '' . $iconf . ' [img]http://191.233.40.227/img2.php?hitpro=' . $name . '[/img][img]http://i.imgur.com/qTUG3QK.gif[/img][right]' . $icon . '[/right][br][br][center] ' . $entry1 . '[br] [img]http://i.imgur.com/Hngm0CB.png[/img][br][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                    $mess = '' . $iconf . '[big][tim][b]@ ' . $ten . ' [/b][/mau][/big] :tim [den]nhận hàng nè [/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center] ' . $entry1 . ' [br][br][b][color=red]' . $ten . '[/color] hãy nhớ cảm ơn  [color=green]' . $name . '[/color] nhé! [/b][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                } else {
                                    if (strcmp($name, "Happy") == 0)
                                        $name = "Hap-py";
                                    $mess = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][right]' . $icon . '[/right][br][center] ' . $entry1 . ' [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                    
                                }
                            } elseif (Check_Admin($adminlist, $name) == true) {
                                if (preg_match("/@(.*?):/", $chat, $nem)) {
                                    //	$command = "info '";
                                    //	Del_Mess_One($name, $command);
                                    //Luu file + time
                                    $log  = fopen($user_file, "a", 1);
                                    $data = $id_user . '|';
                                    fwrite($log, $data);
                                    fclose($log);
                                    $ten = $nem[1];
                                    
                                    //    $mess = '' . $iconf . ' [img]http://191.233.40.227/img2.php?hitpro=' . $name . '[/img][img]http://i.imgur.com/qTUG3QK.gif[/img][right]' . $icon . '[/right][br][br][center] ' . $entry1 . '[br] [img]http://i.imgur.com/Hngm0CB.png[/img][br][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                    $mess    = '' . $iconf . '[big][tim][b]@ ' . $ten . ' [/b][/mau][/big] :tim [den]nhận hàng nè [/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center] ' . $entry1 . ' [br][br][b] link get by [color=green]' . $name . '[/color] for [color=red]' . $ten . '[/color][/b][br][b][color=red]' . $ten . '[/color] hãy nhớ cảm ơn  [color=green]' . $name . '[/color] nhé! [/b][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                    $command = "@ " . $ten;
                                    Del_Mess_One($name, $command);
                                } else {
                                    
                                    $mess = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][right]' . $icon . '[/right][br][center] ' . $entry1 . ' [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                    
                                }
                            } elseif (Check_Manager($manager, $name) == true) {
                                if (preg_match("/@(.*?):/", $chat, $nem)) {
                                    
                                    //Luu file + time
                                    $log  = fopen($user_file, "a", 1);
                                    $data = $id_user . '|';
                                    fwrite($log, $data);
                                    fclose($log);
                                    $ten = $nem[1];
                                    
                                    //    $mess = '' . $iconf . ' [img]http://191.233.40.227/img2.php?hitpro=' . $name . '[/img][img]http://i.imgur.com/qTUG3QK.gif[/img][right]' . $icon . '[/right][br][br][center] ' . $entry1 . '[br] [img]http://i.imgur.com/Hngm0CB.png[/img][br][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                    $mess    = '' . $iconf . '[big][tim][b]@ ' . $ten . ' [/b][/mau][/big] :tim [den]nhận hàng nè [/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center] ' . $entry1 . ' [br][br][b] link get by [color=green]' . $name . '[/color] for [color=red]' . $ten . '[/color][/b][br][b][color=red]' . $ten . '[/color] hãy nhớ cảm ơn  [color=green]' . $name . '[/color] nhé! [/b][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                    $command = $ten;
                                    Del_Mess_One($name, $command);
                                } else {
                                    $mess = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][right]' . $icon . '[/right][br][center] ' . $entry1 . ' [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                    
                                }
                            } elseif (Check_Vip($viplist, $name) == true || Check_Vip2($viplist2, $name) == true || Check_Blacklist($blacklist, $nick) == false) {
                                $timepre = "";
                                $timepre = file_get_contents("http://vnz-leech.com/mobilepay/check_vip.php?apikey=vnzleech_vip_checker&user=" . urlencode($name));
                                if (is_numeric($timepre)) {
                                    $time_premium = gmdate('d/m/Y - H:i', $timepre); // ngày hết hạn
                                    $timepremium  = intval(abs($timepre - time()) / 86400);
                                    $timecount    = $timepremium . " Days"; // số ngày còn lại
                                } else {
                                    $timecount = " Can't Check ";
                                }
                                
                                
                                /*  $imgran       = array(
                                '[img]http://i.imgur.com/z4JcwRD.png[/img]',
                                '[img]http://i.imgur.com/z4JcwRD.png[/img]'
                                );
                                $img          = $imgran[rand(0, count($imgran) - 1)]; */
                                
                                // $mess = '' . $iconf . '[cam][color=white][b][big]@ ' . $name . ' [/big][/b][/color][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][right]' . $icon . '[/right][br][br][center] ' . $entry1 . '[br] [color=blue]Vip Status :[/color][den] '.$timecount.' [/mau][color=blue]Days left[/color][br][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                $mess = '' . $iconf . '[cam][color=white][b][big]@ ' . $name . ' [/big][/b][/color][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][center] ' . $entry1 . '[br][/center][sub](sent from [[color=blue]VIP STATUS : ' . $timecount . '[br] Expired on:' . $time_premium . '[/color]][br])[/sub]';
                                // Write_File("logget/" . urlencode($name) . ".txt", $date . "\n" . urldecode($entry1) . "\n" . $link, 'a');
                                
                                /* [br][img]http://i.imgur.com/z4JcwRD.png[/img] */
                            } else {
                                break;
                                //    $mess = '' . $iconf . '[den][color=white][b]@ ' . $name . ' [/b][/color][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][right]' . $icon . '[/right][br][center] ' . $entry1 . ' [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                            }
                            post_cbox($mess);
                            break;
                        } else {
                            return false;
                        }
                        //Luu time post
                        $log  = fopen($user_file2, "a", 1);
                        $data = $date . '|';
                        fwrite($log, $data);
                        fclose($log);
                        Write_File($time_ip, time(), 'w');
                        break;
                    }
                }
            }
            //hitpro
            elseif (strpos($link, 'http') != 0) {
            } else {
                $check = Check_Link($user_file, $id_user);
                if ($check == true);
                else //Neu link chua get
                    {
                    if ($bot_chat == true);
                    //Luu link xuong
                    $log  = fopen($user_file, "a", 1);
                    $data = $id_user . '|';
                    fwrite($log, $data);
                    fclose($log);
                    if (Check_Vip($viplist, $name) == true || Check_Vip2($viplist2, $name) == true) {
                        
                        $mess = '' . $iconf . '[luc][b][big]@ ' . $name . ' [/b][/big][/mau][br][center][color=red] Sorry [/color][luc][big]V.I.P[/big][/mau][color=red]! We don\'t Support [vang]' . $host_check . '[/mau] at this time ! [/color][br][color=green]We will try\'in support in the next time[/color] [br][color=blue] Type: \' check sp \' to check are supported. [/color][/center][sub](sent from [Host Vip - Sever: Not Support])[/sub]';
                        if ($bot_talk == true) {
                            post_cbox($mess);
                        }
                    }
                    
                    elseif (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) {
                        
                        $mess = '' . $iconf . '[la][b][big]@ ' . $name . ' [/b][/big][/mau][center][color=red] Sorry [/color][la][big]Manager[/big][/mau][color=red]! We don\'t Support [vang]' . $host_check . '[/mau] at this time ! [/color][br][color=green]We will try\'in support in the next time[/color] [br][color=blue] Type: \' check sp \' to check are supported. [/color][/center][sub](sent from [Host Vip - Sever: Not Support])[/sub]';
                        if ($bot_talk == true) {
                            post_cbox($mess);
                        }
                    } else {
                        break;
                    }
                    
                    
                    
                }
            }
        } else
            die();
    }
}

?>