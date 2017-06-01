<meta http-equiv='refresh' content='2'>
<title>Vip User Running...</title>
<!-- xml version="1.0" encoding="utf-8" -->

<html>
<style>
div {
	background-color:transparent;
	}
	</style>
	<body>
	<div><center><font color=green size=8><b>VIP USER GET LINK Multi - Folder</b></font>
<br/>
<br/>
<font color=purple size=5><b>Vip User Started! Do not close the Tab<br>Close the tab to stop Vip User</b></font></center></div>
</html>
<?php
set_time_limit(0);


//Include acc
include_once('config.php');
include_once('functions.php');
$cboxurl = $cbox_url . "&sec=main";
echo "<br>Cbox: " . $cboxurl;
$a       = file_get_contents($cboxurl);
$matches = explode('<tr id=', $a);
for ($i = 2; $i < 15; $i++) {
    $mess = $matches[$i];
    
    //Get ID User
    preg_match('%"(.*)">%U', $mess, $id);
    $id_user = $id[1];
    
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
    $user_filefolder  = "userfolder/" . $name . ".txt"; //make link post
    $user_file        = "user/" . $name . ".txt"; //make link post
    $user_filefolder2 = "timefolder/" . $name . ".txt"; //make time post
    $user_file2       = "time/" . $name . ".txt"; //make time post
    $time_ip          = "timeip/" . md5($name) . ".txt";
    $download_file1   = md5($name) . "-" . md5($id_user) . "-" . time(); // make link multi or folder
    $download_file    = "download/" . base64_encode($download_file1);
    $download_file2   = "redir/" . base64_encode($download_file1);
    //Check Bot, Bots, Media
    
    if (preg_match('/\[media](.*)\[\/media]/', $mess) /* Skip bbcode [media] */ || Check_Bot($bots, $name) == true || strcmp($name, $Bot_Name) == 0); //Neu la Bot, Bots thi ko tra loi
    
    else { //Neu khong phai la Bot, Bots, Media
        //Kiem tra post cua user co chua link down hay ko?
        
        $link = explode('<a class="autoLink" href="', $chat);
        $link = explode('"', $link[1]);
        $link = $link[0] . '';
        $link = array_unique(explode(' ', $link));
        $link = implode(' ', $link);
        $link = str_replace("ul.to", "uploaded.net/file", $link);
        //debug($link.'\n');
        
        
        
        if ($link != '') { //Neu co chua' link down
            $link       = str_replace("ul.to", "uploaded.net/file", $link);
            $link       = str_replace("//uploaded.to", "//uploaded.net", $link);
            $link       = str_replace("//depositfile.org", "//depositfile.com", $link);
            $link       = str_replace("//u26006872.letitbit.net", "//letitbit.net", $link);
            $link       = str_replace("//rg.to", "//rapidgator.net", $link);
            $link       = str_replace("//4share.vn", "//up.4share.vn", $link);
            $link       = str_replace(array(
                '//k2s.cc',
                '//keep2s.cc'
            ), '//keep2share.cc', $link);
            $link       = str_replace('//m.turbobit.net', '//turbobit.net', $link);
            $link       = str_replace('%7C', '|', $link); //Link have pass
            $link_data  = str_replace('|', "_", $link);
            $host_check = strtolower(parse_url($link, PHP_URL_HOST));
            $host_check = str_replace('www.', '', $host_check);
            
            
            $iconf   = '[img]https://www.google.com/s2/favicons?domain=' . strtolower($host_check) . '[/img]';
            /* CHECK ALL CONDITION */
            $kiemtra = true; //<= First is true, then if wrong condition, it says false
            
            if (Check_Support($bot_support, $link) == true) {
                //Get FileSize
                preg_match('%<span class="bbColor" style="color:#000000"><b>(.*)</b>%U', $chat, $match);
                $filesize = str_replace(",", ".", $match[1]);
                $filesize = strtolower(trim($filesize));
                ##################
                ###real size ###
                
                
                //Check link da duoc get chua
                $check = Check_Link($user_filefolder, $id_user);
                if ($check == true);
                else //Neu link chua get
                    {
                    //Luu link xuong
                    $log  = fopen($user_filefolder, "a", 1);
                    $data = $id_user . '|';
                    fwrite($log, $data);
                    fclose($log);
                    
                    
                    echo '<br/>';
                    echo $link . ' = <b><font color=red>' . $filesize . '</b></font>';
                    
                    
                    /*  // Check Vip IP Time Post 
                    if (Check_Vip($viplist, $name) == true || Check_Vip2($viplist2, $name) == true) {
                    if (Check_VIP_IP_Time_Post($id_user, $name)) {
                    if (Check_Time_IP2($time_ip, time())) {
                    $ip =  Check_IP($name);
                    $mess = '[b][vang]@' . $name . '[/mau]        [/b]: [center][b][vang]Cảnh báo Share Nick!!! Thành viên:[/mau][big][luc] ' . $name . '[/mau][/big][vang] đang sử dụng nhiều hơn 1 IP trong vòng ' . $limit_timeip . ' phút!! [/mau][br][vang]Share Nick Warning!!! Members:[/mau][big][luc] ' .$name . '[/mau][/big][vang] are using more than one IP within ' . $limit_timeip . ' minutes !! [/mau][br][tim]' . $ip_diff . '[/mau] and [tim]' . $ip . '[/mau][/b][/center]';
                    post_cbox($mess);
                    $kiemtra = false;
                    //	Write_File($vip_file, $ip, 'w');
                    } else
                    Write_File($vip_file, $ip_diff, 'w');
                    }
                    // Check Vip IP Time Post 
                    } */
                    
                    /* CHECK ALL CONDITION */
                    if ($kiemtra == true) {
                        if ($bot_multi_start == true) {
                            if (Check_Vip($viplist, $name) == true || Check_Vip2($viplist2, $name) == true || Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) {
                                
                                
                                if (count(explode('fshare.vn/folder/', $link)) > 1) {
                                    
                                    $listlink = array();
                                    
                                    /* Get Link Form Folder */
                                    $data = file_get_contents($link);
                                    preg_match_all('/href="(.*)" title="/U', $data, $data);
                                    for ($i = 0; $i < count($data[1]); $i++)
                                        $data[1][$i] = str_replace('" data-placement="top', '', $data[1][$i]);
                                    $listlink = $data[1];
                                    /* Get Link Form Folder */
                                    
                                    $listlink = array_unique($listlink);
                                    $solink   = count($listlink);
                                    
                                    if ($solink > $limitlinkfolder) {
                                        
                                        //$iconf  = '[img]http://i.imgur.com/xc9QnrH.png[/img]';
                                        $so_sv = $fsvn[2] + 1;
                                        $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] Để đám bảo tốc độ tải. chúng tôi từ chối xử lý folder lớn hơn ' . $limitlinkfolder . ' file! [/mau][/mau][br][vang]số file\'s của bạn là:[/mau][color=red][big] ' . $solink . '[/big] [/color] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                        post_cbox($mess);
                                        
                                        
                                    } elseif (empty($solink)) {
                                        //$iconf  = '[img]http://i.imgur.com/xc9QnrH.png[/img]';
                                        $so_sv = $fsvn[2] + 1;
                                        $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] Folder của bạn không có link nào ! [/mau] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                        post_cbox($mess);
                                        
                                    } else {
                                        
                                        $entry = Get_Link_Host_Multi($listlink, $fsvn[0], $fsvn[1], $download_file, $ipmem, $download_file2);
                                        //$iconf  = '[img]http://i.imgur.com/xc9QnrH.png[/img]';
                                        $so_sv = $fsvn[2] + 1;
                                        
                                    }
                                    
                                } elseif (count(explode('4share.vn/d/', $link)) > 1) {
                                    $listlink = array();
                                    
                                    /* Get Link Form Folder */
                                    $data = file_get_contents($link);
                                    preg_match('/display: none\'>(.+)<\/div>/U', $data, $data);
                                    $temp = explode('<br/>', $data[1]);
                                    array_pop($temp);
                                    for ($i = 0; $i < count($temp); $i++)
                                        $listlink[$i] = str_replace('//4share.vn', '//up.4share.vn', $temp[$i]);
                                    preg_match('/\<tittle\>(.+)\<\/tittle\>/U', $data, $data1);
                                    
                                    $folder = $data1[1];
                                    /* Get Link Form Folder */
                                    if ($listlink != '') {
                                        
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        
                                        if ($solink > $limitlinkfolder) {
                                            //$iconf  = '[img]http://i.imgur.com/8mqBD6E.png[/img]';
                                            $so_sv = $foursvn[2] + 1;
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý folder lớn hơn ' . $limitlinkfolder . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } elseif (empty($solink)) {
                                            //$iconf  = '[img]http://i.imgur.com/8mqBD6E.png[/img]';
                                            $mess = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] Folder của bạn không có link nào ! [/mau] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            
                                            
                                            $entry = Get_Link_Host_Multi($listlink, $foursvn[0], $foursvn[1], $download_file, $ipmem, $download_file2);
                                            //$iconf  = '[img]http://i.imgur.com/8mqBD6E.png[/img]';
                                            $so_sv = $foursvn[2] + 1;
                                        }
                                    }
                                    
                                    
                                    
                                    
                                } elseif (count(explode('tenlua.vn/fm/folder', $link)) > 1) {
                                    $listlink = array();
                                    
                                    /* Get Link Form Folder */
                                    $id   = explode('/', $link);
                                    $id   = $id[5];
                                    $data = curl_bot('https://api2.tenlua.vn/', '', '[{"a":"filemanager_gettree","p":"' . $id . '","download":1}]', 0);
                                    $page = json_decode($data, true);
                                    unset($page[0]['f'][0]);
                                    $lik = "";
                                    foreach ($page[0]['f'] as $v)
                                        $lik .= 'https://www.tenlua.vn/download/' . $v['h'] . '/' . $v['ns'] . '-|-';
                                    $listlink = explode('-|-', substr($lik, 0, -3));
                                    
                                    
                                    /* Get Link Form Folder */
                                    if ($listlink != '') {
                                        
                                        $listlink = array_unique($listlink);
                                        
                                        $solink = count($listlink);
                                        
                                        if ($solink > $limitlinkfolder) {
                                            //$iconf  = '[img]http://i.imgur.com/ir6RDW2.png[/img]';
                                            $mess = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý folder lớn hơn ' . $limitlinkfolder . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } elseif (empty($solink)) {
                                            //$iconf  = '[img]http://i.imgur.com/ir6RDW2.png[/img]';
                                            
                                            $mess = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] Folder của bạn không có link nào ! [/mau] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            
                                            
                                            $entry = Get_Link_Host_Multi($listlink, $tlvn[0], $tlvn[1], $download_file, $ipmem, $download_file2);
                                            //$iconf  = '[img]http://i.imgur.com/ir6RDW2.png[/img]';
                                            
                                        }
                                    }
                                    
                                    
                                    
                                    
                                } elseif (count(explode('notepad.cc', $link)) > 1) {
                                    $listlink = array();
                                    /* Get Link From NoTePad.Cc */
                                    $data     = Get_Link($link, 0);
                                    preg_match('/<textarea name="contents" id="contents" class="contents " spellcheck="true">(.*)<\/textarea>/is', $data, $content);
                                    preg_match_all('/((?:(?:https?):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|])/i', $content[0], $listdata);
                                    /* Get Link From NoTePad.Cc */
                                    
                                    if (empty($listdata) == false) {
                                        
                                        
                                        foreach ($listdata as $temp) {
                                            /* Decode Link */
                                            $temp = str_replace('//ul.to', '//uploaded.net/file', $temp);
                                            
                                            $temp = str_replace('//uploaded.to', '//uploaded.net', $temp);
                                            $temp = str_replace('//d01.megashares.com', '//megashares.com', $temp);
                                            $temp = str_replace('//share-online.biz', '//share-online.biz', $temp);
                                            $temp = str_replace('//megairon.net', '//megairon.net', $temp);
                                            $temp = str_replace('//depositfile.org', '//depositfile.com', $temp);
                                            $temp = str_replace('//u26006872.letitbit.net', 'letitbit.net', $temp);
                                            $temp = str_replace('//rg.to', '//rapidgator.net', $temp);
                                            $temp = str_replace('//4share.vn', '//up.4share.vn', $temp);
                                            $temp = str_replace('//www45.zippyshare.com', '//zippyshare.com', $temp);
                                            $temp = str_replace(array(
                                                '//k2s.cc',
                                                '//keep2s.cc'
                                            ), '//keep2share.cc', $temp);
                                            
                                            $temp = str_replace('//dfiles.eu', '//depositfiles.com', $temp);
                                            $temp = str_replace('//filesflash.net', '//filesflash.com', $temp);
                                            $temp = str_replace('%7C', '|', $temp);
                                            
                                            
                                            /* Decode Link */
                                            
                                            for ($i = 0; $i < count($temp); $i++)
                                                $listlink[$i] = $temp[$i];
                                            
                                        }
                                        
                                    }
                                    if ($listlink != '') {
                                        
                                        $listlink = array_unique($listlink);
                                        
                                        $solink = count($listlink);
                                        
                                        if ($solink > $limitmulti) {
                                            //$iconf  = '[img]http://notepad.cc/images/favicon.gif[/img]';
                                            $so_sv = $notepad[2] + 1;
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } elseif ($solink <= 2) {
                                            //$iconf  = '[img]http://notepad.cc/images/favicon.gif[/img]';
                                            $so_sv = $notepad[2] + 1;
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] Notepad.cc của bạn có nhỏ hơn 3 link! Vui lòng Post luôn lên cbox[br]Your Notepad.cc less than 3 links! Please Post on Cbox[/mau] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } elseif (empty($solink)) {
                                            //$iconf  = '[img]http://notepad.cc/images/favicon.gif[/img]';
                                            $so_sv = $notepad[2] + 1;
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] Notepad.cc của bạn không có link nào ! [/mau] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            
                                            
                                            $entry = Get_Link_Host_AIO($listlink, $notepad[0], $notepad[1], $download_file, $ipmem, $download_file2);
                                            //$iconf  = '[img]http://notepad.cc/images/favicon.gif[/img]';
                                            $so_sv = $notepad[2] + 1;
                                        }
                                    }
                                    
                                } elseif (count(explode('4share.vn/f/', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        //	$listlink = $temp[1];
                                        for ($i = 0; $i < count($temp[1]); $i++)
                                            $listlink[$i] = str_replace('//4share.vn', '//up.4share.vn', $temp[1][$i]);
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        
                                        
                                        if ($solink > $limitmulti) {
                                            //$iconf  = '[img]http://i.imgur.com/8mqBD6E.png[/img]';
                                            $so_sv = $foursvn[2] + 1;
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            $entry = Get_Link_Host_Multi($listlink, $foursvn[0], $foursvn[1], $download_file, $ipmem, $download_file2);
                                            //$iconf  = '[img]http://i.imgur.com/8mqBD6E.png[/img]';
                                            $so_sv = $foursvn[2] + 1;
                                        }
                                    }
                                    
                                } elseif (count(explode('keep2share.cc', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $mess = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center] [den]' . $host_check . '[/mau] [color=blue] Không hỗ trợ get Multi![/color][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                        post_cbox($mess);
                                    }
                                    
                                } elseif (count(explode('nitroflare.com', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $mess = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center] [den]' . $host_check . '[/mau] [color=blue] Không hỗ trợ get Multi![/color][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                        post_cbox($mess);
                                    }
                                    
                                } elseif (count(explode('rapidgator.net', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $mess = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center] [den]' . $host_check . '[/mau] [color=blue] Không hỗ trợ get Multi![/color][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                        post_cbox($mess);
                                    }
                                    
                                } elseif (count(explode('turbobit.net', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $mess = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center] [den]' . $host_check . '[/mau] [color=blue] Không hỗ trợ get Multi![/color][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                        post_cbox($mess);
                                    }
                                    
                                } elseif (count(explode('fboom.com', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $mess = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center] [den]' . $host_check . '[/mau] [color=blue] Không hỗ trợ get Multi![/color][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                        post_cbox($mess);
                                    }
                                    
                                } elseif (count(explode('tenlua.vn/download/', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $listlink = $temp[1];
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        
                                        
                                        if ($solink > $limitmulti) {
                                            //$iconf  = '[img]http://i.imgur.com/ir6RDW2.png[/img]';
                                            $mess = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            $entry = Get_Link_Host_Multi($listlink, $tlvn[0], $tlvn[1], $download_file, $ipmem, $download_file2);
                                            //$iconf  = '[img]http://i.imgur.com/ir6RDW2.png[/img]';
                                        }
                                    }
                                    
                                } elseif (count(explode('fshare.vn/file/', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $listlink = $temp[1];
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        
                                        if ($solink > $limitmulti) {
                                            //$iconf  = '[img]http://i.imgur.com/xc9QnrH.png[/img]';
                                            $so_sv = $foursvn[2] + 1;
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            $entry = Get_Link_Host_Multi($listlink, $fsvn[0], $fsvn[1], $download_file, $ipmem, $download_file2);
                                            //$iconf  = '[img]http://i.imgur.com/xc9QnrH.png[/img]';
                                            $so_sv = $fsvn[2] + 1;
                                        }
                                    }
                                    
                                } elseif (count(explode('uploadable.ch', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $listlink = $temp[1];
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        if ($solink > $limitmulti) {
                                            //$iconf  = '[img]http://i.imgur.com/5Jc3h2d.png[/img]';
                                            $so_sv = $foursvn[2] + 1;
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            $entry = Get_Link_Host_Multi($listlink, $uab[0], $uab[1], $download_file, $ipmem, $download_file2);
                                            //$iconf  = '[img]http://i.imgur.com/5Jc3h2d.png[/img]';
                                            $so_sv = $uab[2] + 1;
                                        }
                                    }
                                    
                                } elseif (count(explode('bigfile.to', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $listlink = $temp[1];
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        if ($solink > $limitmulti) {
                                            //$iconf  = '[img]http://i.imgur.com/5Jc3h2d.png[/img]';
                                            $so_sv = $foursvn[2] + 1;
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            $entry = Get_Link_Host_Multi($listlink, $uab[0], $uab[1], $download_file, $ipmem, $download_file2);
                                            //$iconf  = '[img]http://i.imgur.com/5Jc3h2d.png[/img]';
                                            $so_sv = $uab[2] + 1;
                                        }
                                    }
                                    
                                } elseif (count(explode('alfafile.net', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $listlink = $temp[1];
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        if ($solink > $limitmulti) {
                                            //$iconf  = '[img]http://i.imgur.com/5Jc3h2d.png[/img]';
                                            $so_sv = $alfafile[2] + 1;
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            $entry = Get_Link_Host_Multi($listlink, $alfafile[0], $alfafile[1], $download_file, $ipmem, $download_file2);
                                            //$iconf  = '[img]http://i.imgur.com/5Jc3h2d.png[/img]';
                                            $so_sv = $alfafile[2] + 1;
                                        }
                                    }
                                    
                                } elseif (count(explode('upstore.net', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $listlink = $temp[1];
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        if ($solink > $limitmulti) {
                                            //$iconf  = '[img]http://i.imgur.com/5Jc3h2d.png[/img]';
                                            $so_sv = $upstore[2] + 1;
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            $entry = Get_Link_Host_Multi($listlink, $upstore[0], $upstore[1], $download_file, $ipmem, $download_file2);
                                            //$iconf  = '[img]http://i.imgur.com/5Jc3h2d.png[/img]';
                                            $so_sv = $upstore[2] + 1;
                                        }
                                    }
                                    
                                } /* elseif (count(explode('rapidgator.net', $chat)) > 1 || count(explode('rg.to', $chat)) > 1) {
                                if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1) ) {
                                $listlink = $temp[1];
                                $listlink = array_unique($listlink);
                                $solink = count($listlink);
                                if ( $solink > $limitmulti ){
                                //$iconf  = '[img]http://i.imgur.com/nJAgza0.png[/img]';
                                $so_sv  = $foursvn[2] + 1;
                                $mess = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn '.$limitmulti.' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] '.$solink.' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                post_cbox($mess);
                                
                                }else{
                                $entry = Get_Link_Host_Multi($listlink, $rg[0], $rg[1], $download_file, $ipmem, $download_file2);
                                //$iconf  = '[img]http://i.imgur.com/nJAgza0.png[/img]';
                                $so_sv  = $rg[2] + 1;
                                }
                                }
                                
                                }  */ elseif (count(explode('zippyshare.com', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $listlink = $temp[1];
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        if ($solink > $limitmulti) {
                                            //$iconf  = '[img]http://i.imgur.com/nJAgza0.png[/img]';
                                            $so_sv = $zps[2] + 1;
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            $entry = Get_Link_Host_Multi($listlink, $zps[0], $zps[1], $download_file, $ipmem, $download_file2);
                                            //$iconf  = '[img]http://i.imgur.com/nJAgza0.png[/img]';
                                            $so_sv = $zps[2] + 1;
                                        }
                                    } else {
                                    }
                                    
                                } elseif (count(explode('uploaded.net', $chat)) > 1 || count(explode('ul.to', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $listlink = $temp[1];
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        if ($solink > $limitmulti) {
                                            //$iconf  = '[img]http://i.imgur.com/DK7USZK.png[/img]';
                                            $so_sv = $foursvn[2] + 1;
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            $entry = Get_Link_Host_Multi($listlink, $ul[0], $ul[1], $download_file, $ipmem, $download_file2);
                                            //$iconf  = '[img]http://i.imgur.com/DK7USZK.png[/img]';
                                            $so_sv = $ul[2] + 1;
                                        }
                                    }
                                    
                                } elseif (count(explode('datafile.com', $chat)) > 1) {
                                    /* if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $listlink = $temp[1];
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        if ($solink > $limitmulti) {
                                            //$iconf  = '[img]http://i.imgur.com/lRYTqgB.png[/img]';
                                            $so_sv = $foursvn[2] + 1;
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            $entry = Get_Link_Host_Multi($listlink, $datafile[0], $datafile[1], $download_file, $ipmem, $download_file2);
                                            //$iconf  = '[img]http://i.imgur.com/lRYTqgB.png[/img]';
                                            $so_sv = $datafile[2] + 1;
                                        }
                                    } */
									 if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $mess = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center] [den]' . $host_check . '[/mau] [color=blue] Không hỗ trợ get Multi![/color][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                        post_cbox($mess);
                                    }
                                    
                                } elseif (count(explode('ul.to', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $listlink = $temp[1];
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        if ($solink > $limitmulti) {
                                            //$iconf  = '[img]http://i.imgur.com/DK7USZK.png[/img]';
                                            $so_sv = $foursvn[2] + 1;
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            $entry = Get_Link_Host_Multi($listlink, $ul[0], $ul[1], $download_file, $ipmem, $download_file2);
                                            //$iconf  = '[img]http://i.imgur.com/DK7USZK.png[/img]';
                                            $so_sv = $ul[2] + 1;
                                        }
                                    }
                                    
                                } elseif (count(explode('filefactory.com', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $listlink = $temp[1];
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        if ($solink > $limitmulti) {
                                            //$iconf  = '[img]http://i.imgur.com/HR1GIC0.png[/img]';
                                            $so_sv = $foursvn[2] + 1;
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            $entry = Get_Link_Host_Multi($listlink, $ff[0], $ff[1], $download_file, $ipmem, $download_file2);
                                            //$iconf  = '[img]http://i.imgur.com/HR1GIC0.png[/img]';
                                            $so_sv = $ff[2] + 1;
                                        }
                                    }
                                    
                                } elseif (count(explode('uptobox.com', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $listlink = $temp[1];
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        if ($solink > $limitmulti) {
                                            //$iconf  = '[img]http://i.imgur.com/0XgnmIB.png[/img]';
                                            $so_sv = $foursvn[2] + 1;
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            $entry = Get_Link_Host_Multi($listlink, $utb[0], $utb[1], $download_file, $ipmem, $download_file2);
                                            //$iconf  = '[img]http://i.imgur.com/0XgnmIB.png[/img]';
                                            $so_sv = $utb[2] + 1;
                                        }
                                    }
                                    
                                } /* elseif (count(explode('turbobit.net', $chat)) > 1) {
                                if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1) ) {
                                $listlink = $temp[1];
                                $listlink = array_unique($listlink);
                                $solink = count($listlink);
                                if ( $solink > $limitmulti ){
                                //$iconf  = '[img]http://i.imgur.com/S9l2MmX.png[/img]';
                                $so_sv  = $foursvn[2] + 1;
                                $mess = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn '.$limitmulti.' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] '.$solink.' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                post_cbox($mess);
                                
                                }else{
                                $entry = Get_Link_Host_Multi($listlink, $tbb[0], $tbb[1], $download_file, $ipmem, $download_file2);
                                //$iconf  = '[img]http://i.imgur.com/S9l2MmX.png[/img]';
                                $so_sv  = $tbb[2] + 1;
                                }
                                }
                                
                                } */ elseif (count(explode('depositfiles.com', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $listlink = $temp[1];
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        if ($solink > $limitmulti) {
                                            //$iconf  = '[img]http://www.zevera.com/images/hostericons/depositfiles.png[/img]';
                                            $so_sv = $foursvn[2] + 1;
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            $entry = Get_Link_Host_Multi($listlink, $df[0], $df[1], $download_file, $ipmem, $download_file2);
                                            //$iconf  = '[img]http://www.zevera.com/images/hostericons/depositfiles.png[/img]';
                                            $icon  = '[img]http://i.imgur.com/sEPTKOc.png[/img]';
                                            $so_sv = $df[2] + 1;
                                        }
                                    }
                                    
                                } elseif (count(explode('littlebyte.net', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $listlink = $temp[1];
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        if ($solink > $limitmulti) {
                                            // $icon = '[img]http://littlebyte.net/images/logo.gif[/img]';
                                            //$iconf  = '[img]http://i.imgur.com/eSOjnhV.png[/img]';
                                            $so_sv = $lttb[2] + 1;
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            $entry = Get_Link_Host_Multi($listlink, $lttb[0], $lttb[1], $download_file, $ipmem, $download_file2);
                                            // $icon = '[img]http://littlebyte.net/images/logo.gif[/img]';
                                            //$iconf  = '[img]http://i.imgur.com/eSOjnhV.png[/img]';
                                            $so_sv = $lttb[2] + 1;
                                        }
                                    }
                                    
                                } elseif (count(explode('mega.nz', $chat)) > 1 || count(explode('mega.co.nz', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $listlink = $temp[1];
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        if ($solink > $limitmulti) {
                                            // $icon = '[img]http://i.imgur.com/8hUx7mx.png[/img]';
                                            //$iconf  = '[img]http://i.imgur.com/21MKu1g.png[/img]';
                                            $so_sv = $mcn[2] + 1;
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            $entry = Get_Link_Host_Multi($listlink, $mcn[0], $mcn[1], $download_file, $ipmem, $download_file2);
                                            // $icon = '[img]http://i.imgur.com/8hUx7mx.png[/img]';
                                            //$iconf  = '[img]http://i.imgur.com/21MKu1g.png[/img]';
                                            $so_sv = $mcn[2] + 1;
                                        }
                                    }
                                    
                                } elseif (count(explode('share.vnn.vn', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $listlink = $temp[1];
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        if ($solink > $limitmulti) {
                                            //	$icon   = '[img]http://i.imgur.com/Ld0LH3J.png[/img]';
                                            //$iconf  = '[img]http://i.imgur.com/IZkNxV0.png[/img]';
                                            $mess = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            $entry = Get_Link_Host_Multi($listlink, $svnn[0], $svnn[1], $download_file, $ipmem, $download_file2);
                                            //	$icon   = '[img]http://i.imgur.com/Ld0LH3J.png[/img]';
                                            //$iconf  = '[img]http://i.imgur.com/IZkNxV0.png[/img]';
                                        }
                                    }
                                    
                                } elseif (count(explode('filespace.com', $chat)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $listlink = $temp[1];
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        if ($solink > $limitmulti) {
                                            $so_sv = $filespace[2] + 1;
                                            //$iconf  = '[img]http://www.premiumax.net/assets/images/hosts/filespace.png[/img]';
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            $entry = Get_Link_Host_Multi($listlink, $filespace[0], $filespace[1], $download_file, $ipmem, $download_file2);
                                            //$iconf  = '[img]http://www.premiumax.net/assets/images/hosts/filespace.png[/img]';
                                            $so_sv = $filespace[2] + 1;
                                        }
                                    }
                                    
                                } elseif (count(explode('speedyshare.com', $link)) > 1 || count(explode('speedy.sh', $link)) > 1) {
                                    if (preg_match_all('/<a class="autoLink" href="(.*?)" rel="noopener noreferrer" target="_blank">/i', $chat, $temp, PREG_PATTERN_ORDER) && (count($temp[1]) > 1)) {
                                        $listlink = $temp[1];
                                        $listlink = array_unique($listlink);
                                        $solink   = count($listlink);
                                        if ($solink > $limitmulti) {
                                            $so_sv = $spds[2] + 1;
                                            //$iconf  = '[img]http://i.imgur.com/MLdIP4K.png[/img]';
                                            $mess  = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center][den] để đám bảo tốc độ tải. chúng tôi từ chối xử lý Multilink lớn hơn ' . $limitmulti . ' file! [/mau][br][vang]số file\'s của bạn là:[/mau][big][color=red] ' . $solink . ' [/color][/big] [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                            post_cbox($mess);
                                            
                                        } else {
                                            $entry = Get_Link_Host_Multi($listlink, $spds[0], $spds[1], $download_file, $ipmem, $download_file2);
                                            //$iconf  = '[img]http://i.imgur.com/MLdIP4K.png[/img]';
                                            $so_sv = $spds[2] + 1;
                                        }
                                    }
                                    
                                }
                                
                                
                                
                                
                                
                                
                            }
                        }
                        $iconf = '[img]https://www.google.com/s2/favicons?domain=' . strtolower($host_check) . '[/img]';
                        if (strcmp($entry, "") != 0) {
                            
                            if (Check_SuperAdmin($superadmin, $name) == true) {
                                if (preg_match("/@(.*?):/", $chat, $nem)) {
                                    //	$command = "info '";
                                    //	Del_Mess_One($name, $command);
                                    //Luu file + time
                                    $log  = fopen($user_filefolder, "a", 1);
                                    $data = $id_user . '|';
                                    fwrite($log, $data);
                                    fclose($log);
                                    $ten = $nem[1];
                                    
                                    //    $mess = '' . $iconf . ' [img]http://191.233.40.227/img2.php?hitpro=' . $name . '[/img][img]http://i.imgur.com/qTUG3QK.gif[/img][right]' . $icon . '[/right][br][br][center] ' . $entry . '[br] [img]http://i.imgur.com/Hngm0CB.png[/img][br][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                    $mess = '' . $iconf . '[big][tim][b]@ ' . $ten . ' [/b][/mau][/big] :tim [den]nhận hàng nè [/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center] ' . $entry . ' [br][br][b] link get by [color=green]' . $name . '[/color] for [color=red]' . $ten . '[/color][/b][br][b][color=red]' . $ten . '[/color] hãy nhớ cảm ơn  [color=green]' . $name . '[/color] nhé! [/b][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                } else {
                                    $mess = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][right]' . $icon . '[/right][br][center] ' . $entry . ' [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                    
                                }
                            } elseif (Check_Admin($adminlist, $name) == true) {
                                if (preg_match("/@(.*?):/", $chat, $nem)) {
                                    //	$command = "info '";
                                    //	Del_Mess_One($name, $command);
                                    //Luu file + time
                                    $log  = fopen($user_filefolder, "a", 1);
                                    $data = $id_user . '|';
                                    fwrite($log, $data);
                                    fclose($log);
                                    $ten = $nem[1];
                                    
                                    //    $mess = '' . $iconf . ' [img]http://191.233.40.227/img2.php?hitpro=' . $name . '[/img][img]http://i.imgur.com/qTUG3QK.gif[/img][right]' . $icon . '[/right][br][br][center] ' . $entry . '[br] [img]http://i.imgur.com/Hngm0CB.png[/img][br][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                    $mess    = '' . $iconf . '[big][tim][b]@ ' . $ten . ' [/b][/mau][/big] :tim [den]nhận hàng nè [/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center] ' . $entry . ' [br][br][b] link get by [color=green]' . $name . '[/color] for [color=red]' . $ten . '[/color][/b][br][b][color=red]' . $ten . '[/color] hãy nhớ cảm ơn  [color=green]' . $name . '[/color] nhé! [/b][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                    $command = "@ " . $ten;
                                    Del_Mess_One($name, $command);
                                } else {
                                    $mess = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][right]' . $icon . '[/right][br][center] ' . $entry . ' [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                    
                                }
                            } elseif (Check_Manager($manager, $name) == true) {
                                if (preg_match("/@(.*?):/", $chat, $nem)) {
                                    
                                    //Luu file + time
                                    $log  = fopen($user_filefolder, "a", 1);
                                    $data = $id_user . '|';
                                    fwrite($log, $data);
                                    fclose($log);
                                    $ten = $nem[1];
                                    
                                    //    $mess = '' . $iconf . ' [img]http://191.233.40.227/img2.php?hitpro=' . $name . '[/img][img]http://i.imgur.com/qTUG3QK.gif[/img][right]' . $icon . '[/right][br][br][center] ' . $entry . '[br] [img]http://i.imgur.com/Hngm0CB.png[/img][br][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                    $mess    = '' . $iconf . '[big][tim][b]@ ' . $ten . ' [/b][/mau][/big] :tim [den]nhận hàng nè [/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][br][center] ' . $entry . ' [br][b][color=red]' . $ten . '[/color] hãy nhớ cảm ơn  [color=green]' . $name . '[/color] nhé! [/b][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                    $command = $ten;
                                    Del_Mess_One($name, $command);
                                } else {
                                    $mess = '' . $iconf . '[vang][b]@ ' . $name . ' [/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][right]' . $icon . '[/right][br][center] ' . $entry . ' [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                    
                                }
                            } elseif (Check_Vip($viplist, $name) == true || Check_Vip2($viplist2, $name) == true || Check_Blacklist($blacklist, $nick) == false) {
                                $mess = '' . $iconf . '[cam][color=white][b][big]@ ' . $name . ' [/big][/b][/color][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][right]' . $icon . '[/right][br][br][center] ' . $entry . '[/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                //    $mess = '' . $iconf . ' [img]http://191.233.40.227/img2.php?hitpro=' . $name . '[/img][img]http://i.imgur.com/qTUG3QK.gif[/img][right]' . $icon . '[/right][br][br][center] ' . $entry . '[br][/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                                //$mess='[cam][b][big]@ '.$name.' [/big][/b][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][right]'.$icon.'[/right][br][center] '.$entry.'[/center][center][br] [img]http://i.imgur.com/PJs1KBw.gif[/img][/center]';
                            } else {
                                //    $mess = '' . $iconf . '[den][color=white][b]@ ' . $name . ' [/b][/color][/mau][img]http://i.imgur.com/qTUG3QK.gif[/img][right]' . $icon . '[/right][br][center] ' . $entry . ' [/center][sub](sent from [Host Vip - Sever: ' . $so_sv . '])[/sub]';
                            }
                            post_cbox($mess);
                            
                        } else {
                            break;
                        }
                        //Luu time post
                        $log  = fopen($user_filefolder2, "a", 1);
                        $data = $date . '|';
                        fwrite($log, $data);
                        fclose($log);
						break;
                    }
                }
            }
            
        }
    }
    
    
}
?>
