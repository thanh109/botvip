<meta http-equiv='refresh' content='1'>
<title>Vip User Running...</title>
<!-- xml version="1.0" encoding="utf-8" -->
<?php
//set_time_limit(0);
echo "<center><font color=purple size=8><b>VIP USER CHATTING</b></font></center>";

echo "<center><font color=purple size=5><b>Vip User Started! Do not close the Tab<br>Close the tab to stop Vip User</b></font></center>";

//Include acc
include_once('config.php');
include_once('functions.php');
include_once('cmd.php');
$cboxurl = $cbox_url . "&sec=main";
echo "<br>Cbox: " . $cboxurl;
$arr     = "";
$arrid   = "";
$a       = file_get_contents($cboxurl);
$matches = explode('<tr id=', $a);
for ($i = 2; $i < 15; $i++) {
    $mess = $matches[$i];
    
    //Get ID User
    preg_match('%"(.*)">%U', $mess, $id);
    $id_user       = $id[1];
    $arrid[$i - 3] = $id_user;
    
    //Get User Name
    preg_match('%<b class="(.*)">(.*)</b>%U', $mess, $mem);
    $name        = $mem[2];
    $arr[$i - 3] = $name;
    
    //Get Chat
    preg_match('%</b>:(.*?)</td></tr>%U', $mess, $chat);
    $chat = $chat[1];
    
    //Get Date
    preg_match('%<div class="(.*)">%U', $mess, $dc);
    preg_match('%<div class="' . $dc[1] . '">(.*)</div>%U', $mess, $date);
    $date  = $date[1];
    $date2 = date('d/m/Y, H:i:s');
    
    //Make userfile
    $user_file  = "chat/" . md5($name) . ".txt"; //make chat post
    $user_file2 = "AUTOPOST.txt"; //make notification
    
    //Check Bot, Bots, Media
    if (preg_match('/\[media](.*)\[\/media]/', $mess) /* Skip bbcode [media] */ || Check_Bot($bots, $name) == true || strcmp($name, $Bot_Name) == 0); //Neu la Bot, Bots thi ko tra loi
    
    else { //Neu khong phai la Bot, Bots, Media
        //Kiem tra post cua user co chua link down hay ko?
        $link = explode('<a class="autoLink" href="', $chat);
        $link = explode('"', $link[1]);
        $link = $link[0];
        if (!$link) { 
				
			
            if ($bot_talk == true) { //Neu bot talk on
                $check = Check_Chat($chat, $user_file, $id_user);
                if ($check == true);
                else {
                    if (strpos(strtolower($chat), 'vip') != 0 && strpos(strtolower($chat), ':tim') != 0) {
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[b][color=blue]" . $name . "[/color], i'm here[/b] :toiha ";
                        post_cbox($mess);
                    } elseif (strpos(strtolower($chat), 'cho mình hỏi') != 0 || strpos(strtolower($chat), 'tớ hỏi chút') != 0) {
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess1 = "[b][color=blue]" . $name . "[/b][/color] cứ hỏi đi không ai trả lời đâu hehe ";
                        $mess2 = "[b][color=blue]" . $name . "[/b][/color] vạch đầu gối lên mà hỏi cho nhanh ";
                        $mess3 = "[b][color=blue]" . $name . "[/b][/color] lấy thang không? cho mượn cái thang lên mà hỏi ông trời ý ";
                        $mess4 = "[b][color=blue]" . $name . "[/b][/color] biết nhưng đếch nói đấy :he ";
                        
                        $mesall = array(
                            $mess1,
                            $mess2,
                            $mess3,
                            $mess4
                        );
                        $mess   = $mesall[rand(0, count($mesall) - 1)];
                       // post_cbox($mess);
                    } elseif (strpos(strtolower($chat), 'magnet') != 0 || strpos(strtolower($chat), 'torrent') != 0) {
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[b][color=blue]" . $name . "  [/color][color=red]Torent for V.I.P member. if u'r V.I.P  click here : [/color][url=http://torrent.vnz-leech.com/]http://torrent.vnz-leech.com/[/url][/b] ";
                        post_cbox($mess);
                    } elseif (strpos($chat, 'thank') != 0 || strpos($chat, 'Thanks') != 0 || strpos(strtolower($chat), 'cam on') != 0 || strpos(strtolower($chat), 'cám on') != 0 || strpos(strtolower($chat), 'cảm ơn') != 0) {
                        if (Check_Vip($viplist, $name) == true|| Check_Vip2($viplist2, $name) == true) {
						//Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = '[b][color=blue]' . $name . '[/color][/b] : You are welcome :D';
                        	post_cbox($mess);
						}
                    } elseif (strpos(strtolower($chat), 'check sp') != 0 || strpos(strtolower($chat), 'check support') != 0) {
                        if (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true || Check_Vip($viplist, $name) == true|| Check_Vip2($viplist2, $name) == true) {
                         //Luu file + time
                            $data = $id_user . '|';
							Write_File($user_file, $data, 'a', 1);
							$numhost = explode(",",$bot_support);
							$numhost = count($numhost);
							$mess = "[b][color=blue]".$name."[/color] :chi [center][color=purple]I only support [la][big](".$numhost." Host)[/big][/mau] for VIP Member:[/color][br][color=green]".$bot_support."[/color][/center][/b]";
							post_cbox($mess);
                        }
                    }
                }
            }
            
            
            
            
            
            if (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) { //Lenh danh cho tat ca super admin, admin va manager
                
                if (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true) {
                    //Lenh chi danh cho ca super admin va admin
                    
                    //Check Super Admin
                    $chat = trim($chat);
                    if (count(explode($check_superadmin, strtolower($chat))) > 1) {
                        $command = $check_superadmin;
                        Del_Mess_One($name, $command);
                        $check = Check_Chat($chat, $user_file, $id_user);
                        if ($check == true);
                        else {
                            //Luu file + time
                             $log = fopen($user_file,"a",1);
						$data = $id_user.'|';
						fwrite($log, $data);
						fclose($log);
                            $sadm = "";
                            for ($i = 0; $i < count($superadmin); $i++) {
                                $sadm .= $superadmin->name[$i] . ', ';
                            }
                            $mess = "[center][b][color=green]Chủ tịch hội đồng quản trị hiện tại gồm có:[/color][color=red] " . $sadm . " [/color][/b][br][img]http://i.imgur.com/klhSesH.gif[/img][/center]";
                            post_cbox($mess);
                        }
                    }
                    
                    
                    //Add sper admin
                    $chat = trim($chat);
                    if (count(explode($add_superadmin, strtolower($chat))) > 1) {
                        $command = $add_superadmin;
                        Del_Mess_One($name, $command);
                        //Get name to add
                        preg_match("%'(.*)'%U", $chat, $nick);
                        $nick  = $nick[1];
                        $check = Check_Chat($chat, $user_file, $id_user);
                        if ($check == true);
                        else {
                            //Luu file + time
                             $log = fopen($user_file,"a",1);
						$data = $id_user.'|';
						fwrite($log, $data);
						fclose($log);
                            
                            if ($nick != "") {
                                //Kiem tra nick nguoi ra lenh co la super admin hay khong?
                                if (Check_SuperAdmin($superadmin, $name) == true) {
                                    
                                    //Kiem tra xem nick da co trong list super admin chua?
                                    if (Check_SuperAdmin($superadmin, $nick) == true) {
                                        $mess = "[center][b][color=red]" . $nick . "[/color][color=red]" . $phrase['superadmin_exist'] . "[/color][/b][/center]";
                                    }
                                    //Kiem tra xem nick da co trong list admin chua?
                                    elseif (Check_Admin($adminlist, $nick) == true) {
                                        $mess = "[center][b][color=red]" . $nick . "[/color] [color=red]" . $phrase['admin_exist'] . "[/color][/b][/center]";
                                    }
                                    //Kiem tra xem nick da co trong list manager chua?
                                        elseif (Check_Manager($manager, $nick) == true) {
                                        $mess = "[center][b][color=blue]" . $nick . "[/color] [color=red]" . $phrase['manager_exist'] . "[/color][/b][/center]";
                                    }
                                    //Kiem tra xem nick da co trong list vip chua?
                                        elseif (Check_Vip($viplist, $nick) == true) {
                                        $mess = "[center][b][color=purple]" . $nick . "[/color] [color=red]" . $phrase['vip_exist'] . "[/color][/b][/center]";
                                    }
                                     //Kiem tra xem nick da co trong list vip chua?
                                        elseif (Check_Vip2($viplist2, $nick) == true) {
                                        $mess = "[center][b][color=purple]" . $nick . "[/color] [color=red]" . $phrase['vip_exist'] . "[/color][/b][/center]";
                                    }
                                    //Kiem tra xem nick da co trong list bots chua?
                                        elseif (Check_Bot($bots, $nick) == true) {
                                        $mess = "[center][b][color=magenta]" . $nick . "[/color] [color=red]" . $phrase['bots_exist'] . "[/color][/b][/center]";
                                    }
                                    //Kiem tra xem nick da co trong blacklist chua?
                                        elseif (Check_Blacklist($blacklist, $nick) == true) {
                                        $mess = "[center][b][color=maroon]" . $nick . "[/color] [color=red]" . $phrase['blacklist_exist'] . "[/color][/b][/center]";
                                    } else {
                                        //Add
                                        $superadmin = simplexml_load_file($config['superadmin']);
                                        $superadmin->addChild('name', $nick);
                                        $superadmin->asXML($config['superadmin']);
                                        $mess = "[center][b][img]http://i.imgur.com/XYl8P0p.gif[/img] Đã thêm[color=red] " . $nick . " [/color]vào danh sách chủ tịch hội đồng quản trị[/b] [img]http://i.imgur.com/HGr45JV.gif[img][/center]";
                                    }
                                    post_cbox($mess);
                                } else {
                                    post_cbox("[center][b]Xin lỗi, chỉ có duy nhất chủ tịch mới có thể thêm chủ tịch hội đồng quản trị[/b] :2cuoi [/center]");
                                }
                            }
                        }
                    }
                    
                    //Remove super admin
                    $chat = trim($chat);
                    if (count(explode($remove_superadmin, strtolower($chat))) > 1) {
                        $command = $remove_superadmin;
                        Del_Mess_One($name, $command);
                        //Get name to add
                        preg_match("%'(.*)'%U", $chat, $nick);
                        $nick  = $nick[1];
                        $check = Check_Chat($chat, $user_file, $id_user);
                        if ($check == true);
                        else {
                            //Luu file + time
                             $log = fopen($user_file,"a",1);
						$data = $id_user.'|';
						fwrite($log, $data);
						fclose($log);
                            
                            if ($nick != "") {
                                //Kiem tra nick nguoi ra lenh co la super admin hay khong?
                                if (Check_SuperAdmin($superadmin, $name) == true) {
                                    
                                    //Kiem tra xem nick da co trong list super admin chua?
                                    if (Check_SuperAdmin($superadmin, $nick) == true) {
                                        for ($i = 0; $i < count($superadmin); $i++) {
                                            if ($superadmin->name[$i] == $nick) {
                                                unset($superadmin->name[$i]);
                                                $superadmin->asXML($config['superadmin']);
                                            }
                                        }
                                        $mess = "[center][b][img]http://i.imgur.com/JJqal6O.gif[/img] Đã xóa[color=red] " . $nick . " [/color]khỏi danh sách chủ tịch hội đồng quản trị[/b] [img]http://i.imgur.com/HGr45JV.gif[img][/center]";
                                        post_cbox($mess);
                                    } else {
                                        post_cbox("[center][b]Không tìm thấy [color=red]" . $nick . "[/color] trong danh sách chủ tịch hội đồng quản trị[/b] :dauhang [/center]");
                                    }
                                } else {
                                    post_cbox("[center][b]Bạn chưa đủ trình xóa chủ tịch hội đồng quản trị[/b] [img]http://i.imgur.com/lnT5ZUb.gif[/img][/center]");
                                }
                            }
                        }
                    }
                    
                    
                    //Check Admin
                    $chat = trim($chat);
                    if (count(explode($check_admin, strtolower($chat))) > 1) {
                        $command = $check_admin;
                        Del_Mess_One($name, $command);
                        $check = Check_Chat($chat, $user_file, $id_user);
                        if ($check == true);
                        else {
                            //Luu file + time
                             $log = fopen($user_file,"a",1);
						$data = $id_user.'|';
						fwrite($log, $data);
						fclose($log);
                            $adm = "";
                            for ($i = 0; $i < count($adminlist); $i++) {
                                $adm .= $adminlist->name[$i] . ', ';
                            }
                            $mess = "[center][b][color=green]Hội đồng quản trị hiện tại gồm có:[/color][color=red] " . $adm . " [/color][/b][br][img]http://i.imgur.com/9WgDclP.gif[/img][/center]";
                            post_cbox($mess);
                        }
                    }
                    
                    //Add admin
                    $chat = trim($chat);
                    if (count(explode($add_admin, strtolower($chat))) > 1) {
                        $command = $add_admin;
                        Del_Mess_One($name, $command);
                        //Get name to add
                        preg_match("%'(.*)'%U", $chat, $nick);
                        $nick  = $nick[1];
                        $check = Check_Chat($chat, $user_file, $id_user);
                        if ($check == true);
                        else {
                            //Luu file + time
                             $log = fopen($user_file,"a",1);
						$data = $id_user.'|';
						fwrite($log, $data);
						fclose($log);
                            
                            if ($nick != "") {
                                //Kiem tra nick nguoi ra lenh co la super admin hay khong?
                                if (Check_SuperAdmin($superadmin, $name) == true) {
                                    
                                    //Kiem tra xem nick da co trong list super admin chua?
                                    if (Check_SuperAdmin($superadmin, $nick) == true) {
                                        $mess = "[center][b][color=red]" . $nick . "[/color] [color=red]" . $phrase['superadmin_exist'] . "[/color][/b][/center]";
                                    }
                                    //Kiem tra xem nick da co trong list admin chua?
                                    elseif (Check_Admin($adminlist, $nick) == true) {
                                        $mess = "[center][b][color=red]" . $nick . "[/color] [color=red]" . $phrase['admin_exist'] . "[/color][/b][/center]";
                                    }
                                    //Kiem tra xem nick da co trong list manager chua?
                                        elseif (Check_Manager($manager, $nick) == true) {
                                        $mess = "[center][b][color=blue]" . $nick . "[/color] [color=red]" . $phrase['manager_exist'] . "[/color][/b][/center]";
                                    }
                                    //Kiem tra xem nick da co trong list vip chua?
                                        elseif (Check_Vip($viplist, $nick) == true) {
                                        $mess = "[center][b][color=purple]" . $nick . "[/color] [color=red]" . $phrase['vip_exist'] . "[/color][/b][/center]";
                                    }
                                     //Kiem tra xem nick da co trong list vip chua?
                                        elseif (Check_Vip2($viplist2, $nick) == true) {
                                        $mess = "[center][b][color=purple]" . $nick . "[/color] [color=red]" . $phrase['vip_exist'] . "[/color][/b][/center]";
                                    }
                                    //Kiem tra xem nick da co trong list bots chua?
                                        elseif (Check_Bot($bots, $nick) == true) {
                                        $mess = "[center][b][color=magenta]" . $nick . "[/color] [color=red]" . $phrase['bots_exist'] . "[/color][/b][/center]";
                                    }
                                    //Kiem tra xem nick da co trong blacklist chua?
                                        elseif (Check_Blacklist($blacklist, $nick) == true) {
                                        $mess = "[center][b][color=maroon]" . $nick . "[/color] [color=red]" . $phrase['blacklist_exist'] . "[/color][/b][/center]";
                                    } else {
                                        //Add
                                        $adminlist = simplexml_load_file($config['admin']);
                                        $adminlist->addChild('name', $nick);
                                        $adminlist->asXML($config['admin']);
                                        $mess = "[center][b][img]http://i.imgur.com/XYl8P0p.gif[/img] Đã thêm[color=red] " . $nick . " [/color]vào danh sách hội đồng quản trị[/b] [img]http://i.imgur.com/Qh1TchB.gif[/img][/center]";
                                    }
                                    post_cbox($mess);
                                } else {
                                    post_cbox("[center][b]Xin lỗi, chỉ có duy nhất chủ tịch mới có thể thêm thành viên hội đồng quản trị[/b] :he [/center]");
                                }
                            }
                        }
                    }
                    
                    //Remove admin
                    $chat = trim($chat);
                    if (count(explode($remove_admin, strtolower($chat))) > 1) {
                        $command = $remove_admin;
                        Del_Mess_One($name, $command);
                        //Get name to add
                        preg_match("%'(.*)'%U", $chat, $nick);
                        $nick  = $nick[1];
                        $check = Check_Chat($chat, $user_file, $id_user);
                        if ($check == true);
                        else {
                            //Luu file + time
                             $log = fopen($user_file,"a",1);
						$data = $id_user.'|';
						fwrite($log, $data);
						fclose($log);
                            
                            if ($nick != "") {
                                //Kiem tra nick nguoi ra lenh co la super admin hay khong?
                                if (Check_SuperAdmin($superadmin, $name) == true) {
                                    
                                    //Kiem tra xem nick da co trong list admin chua?
                                    if (Check_Admin($adminlist, $nick) == true) {
                                        for ($i = 0; $i < count($adminlist); $i++) {
                                            if ($adminlist->name[$i] == $nick) {
                                                unset($adminlist->name[$i]);
                                                $adminlist->asXML($config['admin']);
                                            }
                                        }
                                        $mess = "[center][b][img]http://i.imgur.com/JJqal6O.gif[/img] Đã xóa[color=red] " . $nick . " [/color]khỏi danh sách thành viên hội đồng quản trị[/b] [img]http://i.imgur.com/Qh1TchB.gif[/img][/center]";
                                        post_cbox($mess);
                                    } else {
                                        post_cbox("[center][b]Không tìm thấy[color=red] " . $nick . " [/color]trong danh sách thành viên hội đồng quản trị[/b] :dauhang [/center]");
                                    }
                                } else {
                                    post_cbox("[center][b]Bạn chưa đủ trình xóa thành viên hội đồng quản trị[/b] [img]http://i.imgur.com/lnT5ZUb.gif[/img][/center]");
                                }
                            }
                        }
                    }
                }
                
                
                //Start Bot
                $chat = trim($chat);
                if (count(explode($start_bot, strtolower($chat))) > 1) {
                    $command = $start_bot;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $info = simplexml_load_file($config['cbox_info']);
                        unset($info->work);
                        $info->addChild('work', "true");
                        $info->asXML($config['cbox_info']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b][color=blue]Bắt đầu get link![/color][br][color=green]Được kích hoạt bởi[/color][color=red] " . $name . " [/color][/b] [/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop Bot
                $chat = trim($chat);
                if (count(explode($stop_bot, strtolower($chat))) > 1) {
                    $command = $stop_bot;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
				
                    if ($check == true);
                    else {
						if (Check_SuperAdmin($superadmin, $name) == true) {
							//Set option stop
							$info = simplexml_load_file($config['cbox_info']);
							unset($info->work);
							$info->addChild('work', "false");
							$info->asXML($config['cbox_info']);
							
							//Luu file + time
							$log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
							$mess = "[center][b][color=blue]Đã tắt getlink [/color][/b] bye [/center]";
							post_cbox($mess);
						}else {
							$mess = "[center][b][color=blue]Không Tắt !!! [/color][/b] :2haha [/center]";
							post_cbox($mess);
						}
					}
                }
                
                //Start Bot multi
                $chat = trim($chat);
                if (count(explode($start_bot_multi, strtolower($chat))) > 1) {
                    $command = $start_bot_multi;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $info = simplexml_load_file($config['cbox_info']);
                        unset($info->multiwork);
                        $info->addChild('multiwork', "true");
                        $info->asXML($config['cbox_info']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b][color=blue]Bắt đầu get link Multi/Folder![/color][br][color=green]Được kích hoạt bởi[/color][color=red] " . $name . " [/color][/b] [/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop Bot multi
                $chat = trim($chat);
                if (count(explode($stop_bot_multi, strtolower($chat))) > 1) {
                    $command = $stop_bot_multi;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
				
                    if ($check == true);
                    else {
						if (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) {
							//Set option stop
							$info = simplexml_load_file($config['cbox_info']);
							unset($info->multiwork);
							$info->addChild('multiwork', "false");
							$info->asXML($config['cbox_info']);
							
							//Luu file + time
							$log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
							$mess = "[center][b][color=blue]Đã tắt getlink Multi/Folder![/color][/b] bye [/center]";
							post_cbox($mess);
						}else {
							$mess = "[center][b][color=blue]Không Tắt !!! [/color][/b] :2haha [/center]";
							post_cbox($mess);
						}
					}
                }                
                
                //Start bot notify
                $chat = trim($chat);
                if (count(explode($start_notify, strtolower($chat))) > 1) {
                    $command = $start_notify;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $info = simplexml_load_file($config['cbox_info']);
                        unset($info->notify);
                        $info->addChild('notify', "true");
                        $info->asXML($config['cbox_info']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b][color=blue]Vâng thưa sếp[/color][color=red] " . $name . " [/color][br][color=blue]Bắt đầu thông báo cho thành viên[/color][/b] :phe [/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop bot notify
                $chat = trim($chat);
                if (count(explode($stop_notify, strtolower($chat))) > 1) {
                    $command = $stop_notify;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $info = simplexml_load_file($config['cbox_info']);
                        unset($info->notify);
                        $info->addChild('notify', "false");
                        $info->asXML($config['cbox_info']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b][color=blue]Vâng thưa sếp[/color][color=red] " . $name . " [/color][br][color=blue]Dừng thông báo cho thành viên[/color][/b] :w8 [/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start bot chat
                $chat = trim($chat);
                if (count(explode($start_chat, strtolower($chat))) > 1) {
                    $command = $start_chat;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $info = simplexml_load_file($config['cbox_info']);
                        unset($info->chat);
                        $info->addChild('chat', "true");
                        $info->asXML($config['cbox_info']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b][color=blue]Vâng thưa sếp[/color][color=red] " . $name . " [/color][br][color=blue]Kích hoạt chế độ giải trí - xả stress[/color][/b] :2do [/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop bot chat
                $chat = trim($chat);
                if (count(explode($stop_chat, strtolower($chat))) > 1) {
                    $command = $stop_chat;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $info = simplexml_load_file($config['cbox_info']);
                        unset($info->chat);
                        $info->addChild('chat', "false");
                        $info->asXML($config['cbox_info']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b][color=blue]Vâng thưa sếp[/color][color=red] " . $name . " [/color][br][color=blue]Ngừng chế độ giải trí - xả stress[/color][/b] :3bye [/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start bot talk
                $chat = trim($chat);
                if (count(explode($start_talk, strtolower($chat))) > 1) {
                    $command = $start_talk;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $info = simplexml_load_file($config['cbox_info']);
                        unset($info->talk);
                        $info->addChild('talk', "true");
                        $info->asXML($config['cbox_info']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b][color=blue]Vâng thưa sếp[/color][color=red] " . $name . " [/color][br][color=blue]Khởi động skill chém gió thành bão[/color][/b] :mm [/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop bot talk
                $chat = trim($chat);
                if (count(explode($stop_talk, strtolower($chat))) > 1) {
                    $command = $stop_talk;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $info = simplexml_load_file($config['cbox_info']);
                        unset($info->talk);
                        $info->addChild('talk', "false");
                        $info->asXML($config['cbox_info']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b][color=blue]Vâng thưa sếp[/color][color=red] " . $name . " [/color][br][color=blue]Tạm ngưng chém gió quy ẩn giang hồ[/color][/b] :siunhan [/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start ZIP link
                $chat = trim($chat);
                
                if (count(explode($start_ziplink, strtolower($chat))) > 1) {
                    $command = $start_ziplink;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $info = simplexml_load_file($config['cbox_info']);
                        unset($info->ziplink);
                        $info->addChild('ziplink', "true");
                        $info->asXML($config['cbox_info']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b][color=blue]Vâng thưa sếp[/color][color=red] " . $name . " [/color][br][color=green]Bắt đầu ZipLink tất cả các link sẽ get![/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop ZIP link
                $chat = trim($chat);
                if (count(explode($stop_ziplink, strtolower($chat))) > 1) {
                    $command = $stop_ziplink;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $info = simplexml_load_file($config['cbox_info']);
                        unset($info->ziplink);
                        $info->addChild('ziplink', "false");
                        $info->asXML($config['cbox_info']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b][color=blue]Vâng thưa sếp[/color][color=red] " . $name . " [/color][br][color=green]Đã dừng Ziplink các link sẽ get[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Check manager
                $chat = trim($chat);
                if (count(explode($check_manager, strtolower($chat))) > 1) {
                    $command = $check_manager;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mod = "";
                        for ($i = 0; $i < count($manager); $i++) {
                            $mod .= $manager->name[$i] . ', ';
                        }
                        $mess = "[center][b][color=green]Quản trị viên hiện tại gồm có:[/color][color=blue] " . $mod . " [/color][/b][br][img]http://i.imgur.com/43pEcbA.gif[/img][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Add manager
                $chat = trim($chat);
                if (count(explode($add_manager, strtolower($chat))) > 1) {
                    $command = $add_manager;
                    Del_Mess_One($name, $command);
                    //Get name to add
                    preg_match("%'(.*)'%U", $chat, $nick);
                    $nick  = $nick[1];
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        
                        if ($nick != "") {
                            //Kiem tra nick nguoi ra lenh la admin tro len hay khong?
                            if (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true) {
                                
                                //Kiem tra xem nick da co trong list super admin chua?
                                if (Check_SuperAdmin($superadmin, $nick) == true) {
                                    $mess = "[center][b][color=red]" . $nick . "[/color] [color=red]" . $phrase['superadmin_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong list admin chua?
                                elseif (Check_Admin($adminlist, $nick) == true) {
                                    $mess = "[center][b][color=red]" . $nick . "[/color] [color=red]" . $phrase['admin_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong list manager chua?
                                    elseif (Check_Manager($manager, $nick) == true) {
                                    $mess = "[center][b][color=blue]" . $nick . "[/color] [color=red]" . $phrase['manager_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong list vip chua?
                                    elseif (Check_Vip2($viplist2, $nick) == true) {
                                    $mess = "[center][b][color=purple]" . $nick . "[/color] [color=red]" . $phrase['vip_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong list bots chua?
                                    elseif (Check_Bot($bots, $nick) == true) {
                                    $mess = "[center][b][color=magenta]" . $nick . "[/color] [color=red]" . $phrase['bots_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong blacklist chua?
                                    elseif (Check_Blacklist($blacklist, $nick) == true) {
                                    $mess = "[center][b][color=maroon]" . $nick . "[/color] [color=red]" . $phrase['blacklist_exist'] . "[/color][/b][/center]";
                                } else {
                                    //Add
                                    $manager = simplexml_load_file($config['cbox_manager']);
                                    $manager->addChild('name', $nick);
                                    $manager->asXML($config['cbox_manager']);
                                    $mess = "[center][b][img]http://i.imgur.com/XYl8P0p.gif[/img] Đã thêm[color=blue] " . $nick . " [/color]vào danh sách quản trị viên[/b] [img]http://i.imgur.com/2IpjDaj.gif[/img][/center]";
                                }
                                post_cbox($mess);
                            } else {
                                post_cbox("[center][b]Xin lỗi, chỉ thành viên hội đồng quản trị mới có thể thêm quản trị viên[/b] :hoho [/center]");
                            }
                        }
                    }
                }
                
                //Remove manager
                $chat = trim($chat);
                if (count(explode($remove_manager, strtolower($chat))) > 1) {
                    $command = $remove_manager;
                    Del_Mess_One($name, $command);
                    //Get name to add
                    preg_match("%'(.*)'%U", $chat, $nick);
                    $nick  = $nick[1];
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        
                        if ($nick != "") {
                            //Kiem tra nick nguoi ra lenh la admin tro len hay khong?
                            if (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true) {
                                
                                //Kiem tra xem nick da co trong list manager chua?
                                if (Check_Manager($manager, $nick) == true) {
                                    for ($i = 0; $i < count($manager); $i++) {
                                        if ($manager->name[$i] == $nick) {
                                            unset($manager->name[$i]);
                                            $manager->asXML($config['cbox_manager']);
                                        }
                                    }
                                    $mess = "[center][b][img]http://i.imgur.com/JJqal6O.gif[/img] Đã xóa[color=blue] " . $nick . " [/color]khỏi danh sách quản trị viên[/b] [img]http://i.imgur.com/2IpjDaj.gif[/img][/center]";
                                    post_cbox($mess);
                                } else {
                                    post_cbox("[center][b]Không tìm thấy[color=blue] " . $nick . " [/color]trong danh sách quản trị viên[/b] :dauhang [/center]");
                                }
                            } else {
                                post_cbox("[center][b]Bạn chưa đủ trình xóa quản trị viên[/b] [img]http://i.imgur.com/lnT5ZUb.gif[/img][/center]");
                            }
                        }
                    }
                }
                
                
                //Check bots
                $chat = trim($chat);
                if (count(explode($check_bot, strtolower($chat))) > 1) {
                    $command = $check_bot;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $bot = "";
                        for ($i = 0; $i < count($bots); $i++) {
                            $bot .= $bots->name[$i] . ', ';
                        }
                        $mess = "[center][b][color=green]Danh sách cộng tác viên gồm có:[/color][color=magenta] " . $bot . " [/color][/b][br][img]http://i.imgur.com/aQdd56m.gif[/img][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Add bots
                $chat = trim($chat);
                if (count(explode($add_bot, strtolower($chat))) > 1) {
                    $command = $add_bot;
                    Del_Mess_One($name, $command);
                    //Get name to add
                    preg_match("%'(.*)'%U", $chat, $nick);
                    $nick  = $nick[1];
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        
                        if ($nick != "") {
                            //Kiem tra nick nguoi ra lenh la manager tro len hay khong?
                            if (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) {
                                
                                //Kiem tra xem nick da co trong list super admin chua?
                                if (Check_SuperAdmin($superadmin, $nick) == true) {
                                    $mess = "[center][b][color=red]" . $nick . "[/color] [color=red]" . $phrase['superadmin_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong list admin chua?
                                elseif (Check_Admin($adminlist, $nick) == true) {
                                    $mess = "[center][b][color=red]" . $nick . "[/color] [color=red]" . $phrase['admin_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong list manager chua?
                                    elseif (Check_Manager($manager, $nick) == true) {
                                    $mess = "[center][b][color=blue]" . $nick . "[/color] [color=red]" . $phrase['manager_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong list vip chua?
                                    elseif (Check_Vip($viplist, $nick) == true) {
                                    $mess = "[center][b][color=purple]" . $nick . "[/color] [color=red]" . $phrase['vip_exist'] . "[/color][/b][/center]";
                                }
                                
                                //Kiem tra xem nick da co trong list vip chua?
                                    elseif (Check_Vip2($viplist2, $nick) == true) {
                                    $mess = "[center][b][color=purple]" . $nick . "[/color] [color=red]" . $phrase['vip_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong list bots chua?
                                    elseif (Check_Bot($bots, $nick) == true) {
                                    $mess = "[center][b][color=magenta]" . $nick . "[/color] [color=red]" . $phrase['bots_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong blacklist chua?
                                    elseif (Check_Blacklist($blacklist, $nick) == true) {
                                    $mess = "[center][b][color=maroon]" . $nick . "[/color] [color=red]" . $phrase['blacklist_exist'] . "[/color][/b][/center]";
                                } else {
                                    //Add
                                    $bots = simplexml_load_file($config['bots']);
                                    $bots->addChild('name', $nick);
                                    $bots->asXML($config['bots']);
                                    $mess = "[center][b][img]http://i.imgur.com/XYl8P0p.gif[/img] Đã thêm[color=magenta] " . $nick . " [/color]vào danh sách cộng tác viên[/b] [img]http://i.imgur.com/aQdd56m.gif[/img][/center]";
                                }
                                post_cbox($mess);
                            } else {
                                post_cbox("[center][b]Chỉ có quản trị viên trở lên mới được quyền thêm thành viên vào danh sách cộng tác viên[/b] :haha [/center]");
                            }
                        }
                    }
                }
                
                //Remove bots
                $chat = trim($chat);
                if (count(explode($remove_bot, strtolower($chat))) > 1) {
                    $command = $remove_bot;
                    Del_Mess_One($name, $command);
                    //Get name to add
                    preg_match("%'(.*)'%U", $chat, $nick);
                    $nick  = $nick[1];
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        
                        if ($nick != "") {
                            //Kiem tra nick nguoi ra lenh la manager tro len hay khong?
                            if (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) {
                                
                                //Kiem tra xem nick da co trong list bots chua?
                                if (Check_Bot($bots, $nick) == true) {
                                    for ($i = 0; $i < count($bots); $i++) {
                                        if ($bots->name[$i] == $nick) {
                                            unset($bots->name[$i]);
                                            $bots->asXML($config['bots']);
                                        }
                                    }
                                    $mess = "[center][b][img]http://i.imgur.com/JJqal6O.gif[/img] Đã xóa[color=magenta] " . $nick . " [/color]khỏi danh sách cộng tác viên[/b] [img]http://i.imgur.com/aQdd56m.gif[/img][/center]";
                                    post_cbox($mess);
                                } else {
                                    post_cbox("[center][b]Không tìm thấy[color=magenta] " . $nick . " [/color]trong danh sách cộng tác viên[/b] :dauhang [/center]");
                                }
                            } else {
                                post_cbox("[center][b]Bạn chưa đủ trình xóa thành viên khỏi danh sách cộng tác viên[/b] [img]http://i.imgur.com/lnT5ZUb.gif[/img][/center]");
                            }
                        }
                    }
                }
                
                
                //Add Vip
                $chat = trim($chat);
                if (count(explode($add_vip, strtolower($chat))) > 1) {
                    $command = $add_vip;
                    Del_Mess_One($name, $command);
                    //Get name to add
                    preg_match("%'(.*)'%U", $chat, $nick);
                    $nick  = $nick[1];
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        
                        if ($nick != "") {
                            //Kiem tra nick nguoi ra lenh la manager tro len hay khong?
                            if (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) {
                                
                                //Kiem tra xem nick da co trong list super admin chua?
                                if (Check_SuperAdmin($superadmin, $nick) == true) {
                                    $mess = "[center][b][color=red]" . $nick . "[/color] [color=red]" . $phrase['superadmin_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong list admin chua?
                                elseif (Check_Admin($adminlist, $nick) == true) {
                                    $mess = "[center][b][color=red]" . $nick . "[/color] [color=red]" . $phrase['admin_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong list manager chua?
                                    elseif (Check_Manager($manager, $nick) == true) {
                                    $mess = "[center][b][color=blue]" . $nick . "[/color] [color=red]" . $phrase['manager_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong list vip chua?
                                    elseif (Check_Vip($viplist, $nick) == true) {
                                    $mess = "[center][b][color=purple]" . $nick . "[/color] [color=red]" . $phrase['vip_exist'] . "[/color][/b][/center]";
                                }
                                
                                //Kiem tra xem nick da co trong list vip chua?
                                    elseif (Check_Vip2($viplist2, $nick) == true) {
                                    $mess = "[center][b][color=purple]" . $nick . "[/color] [color=red]" . $phrase['vip_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong list bots chua?
                                    elseif (Check_Bot($bots, $nick) == true) {
                                    $mess = "[center][b][color=magenta]" . $nick . "[/color] [color=red]" . $phrase['bots_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong blacklist chua?
                                    elseif (Check_Blacklist($blacklist, $nick) == true) {
                                    $mess = "[center][b][color=maroon]" . $nick . "[/color] [color=red]" . $phrase['blacklist_exist'] . "[/color][/b][/center]";
                                } else {
                                    //Add
                                    $viplist2 = simplexml_load_file($config['cbox_vip']);
                                    $viplist2->addChild('name', $nick);
                                    $viplist2->asXML($config['cbox_vip']);
                                    $mess = "[center][b][img]http://i.imgur.com/XYl8P0p.gif[/img] Đã thêm thành viên[color=purple] " . $nick . " [/color]vào danh sách Vip[/b] [img]http://i.imgur.com/q8UtyEQ.gif[/img][/center]";
                                }
                                post_cbox($mess);
                            } else {
                                post_cbox("[center][b]Chỉ có quản trị viên trở lên mới được quyền thêm thành viên vào danh sách Vip[/b] :cuoi [/center]");
                            }
                        }
                    }
                }
                
                //Remove vip
                $chat = trim($chat);
                if (count(explode($remove_vip, strtolower($chat))) > 1) {
                    $command = $remove_vip;
                    Del_Mess_One($name, $command);
                    //Get name to add
                    preg_match("%'(.*)'%U", $chat, $nick);
                    $nick  = $nick[1];
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        
                        if ($nick != "") {
                            //Kiem tra nick nguoi ra lenh la manager tro len hay khong?
                            if (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) {
                                
                                //Kiem tra xem nick da co trong list vip chua?
                                if (Check_Vip2($viplist2, $nick) == true) {
                                    for ($i = 0; $i < count($viplist); $i++) {
                                        if ($viplist2->name[$i] == $nick) {
                                            unset($viplist2->name[$i]);
                                            $viplist2->asXML($config['cbox_vip']);
                                        }
                                    }
                                    $mess = "[center][b][img]http://i.imgur.com/JJqal6O.gif[/img] Thành viên[color=purple] " . $nick . " [/color]đã bị xóa khỏi danh sách Vip[/b] [img]http://i.imgur.com/q8UtyEQ.gif[/img][/center]";
                                    post_cbox($mess);
                                } else {
                                    post_cbox("[center][b]Không tìm thấy[color=purple] " . $nick . " [/color]trong danh sách Vip[/b] :dauhang [/center]");
                                }
                            } else {
                                post_cbox("[center][b]Bạn chưa đủ trình xóa thành viên khỏi danh sách Vip[/b] [img]http://i.imgur.com/lnT5ZUb.gif[/img][/center]");
                            }
                        }
                    }
                }
                
                
                //Check blacklist
                $chat = trim($chat);
                if (count(explode($check_blackList, strtolower($chat))) > 1) {
                    $command = $check_blackList;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $bl = "";
                        for ($i = 0; $i < count($blacklist); $i++) {
                            $bl .= $blacklist->name[$i] . ', ';
                        }
                        $mess = "[center][b][color=green]Danh sách đen gồm có:[/color][color=maroon] " . $bl . " [/color][/b][br][img]http://i.imgur.com/pttUUJU.gif[/img][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Add blacklist
                $chat = trim($chat);
                if (count(explode($add_blacklist, strtolower($chat))) > 1) {
                    $command = $add_blacklist;
                    Del_Mess_One($name, $command);
                    $time_banned = "";
                    //Get name to add
                    preg_match("%'(.*)'%U", $chat, $nick);
                    $nick = $nick[1];
                    
                    //Phan tich lay ra thoi gian banned
                    $t      = explode(',', $nick);
                    $nick   = $t[0];
                    $time   = $t[1];
                    $reason = $t[2];
                    if (count($t) > 1) {
                        $time_banned = urlencode($time);
                    } else { //Mac dinh  == > banned 7 days vidu:  banned 'zet'
                        $time_banned = urlencode('7 days');
                    }
                    if (count($t) > 2) {
                        $reason = urlencode($reason);
                    } else { //Mac dinh  == > banned 7 days vidu:  banned 'zet'
                        $reason = urlencode('Post Porn');
                    }
                    
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        
                        if ($nick != "") {
                            //Kiem tra nick nguoi ra lenh la manager tro len hay khong?
                            if (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) {
                                
                                //Kiem tra xem nick da co trong list super admin chua?
                                if (Check_SuperAdmin($superadmin, $nick) == true) {
                                    $mess = "[center][b][color=red]" . $nick . "[/color] [color=red]" . $phrase['superadmin_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong list admin chua?
                                elseif (Check_Admin($adminlist, $nick) == true) {
                                    $mess = "[center][b][color=red]" . $nick . "[/color] [color=red]" . $phrase['admin_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong list manager chua?
                                    elseif (Check_Manager($manager, $nick) == true) {
                                    $mess = "[center][b][color=blue]" . $nick . "[/color] [color=red]" . $phrase['manager_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong list vip chua?
                                    elseif (Check_Vip1($viplist, $nick) == false) {
                                    $mess = "[center][b][color=purple]" . $nick . "[/color] [color=red]" . $phrase['vip_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong list bots chua?
                                    elseif (Check_Bot1($bots, $nick) == true) {
                                    $mess = "[center][b][color=magenta]" . $nick . "[/color] [color=red]" . $phrase['bots_exist'] . "[/color][/b][/center]";
                                }
                                //Kiem tra xem nick da co trong blacklist chua?
                                    elseif (Check_Blacklist($blacklist, $nick) == true) {
                                    $mess       = "[center][b][color=maroon]" . $nick . "[/color] [color=red]" . $phrase['blacklist_exist'] . "[/color][/b][/center]";
                                    //Luu file + info
                                    $user_file3 = "banned/" . $nick . ".txt";
                                    $log        = fopen($user_file3, "a", 1);
                                    $data       = $date2 . '-' . $time_banned . '-' . $reason . '|';
                                    fwrite($log, $data);
                                    fclose($log);
                                } else {
                                    //Add
                                    $bl = simplexml_load_file($config['blacklist']);
                                    $bl->addChild('name', $nick);
                                    $bl->asXML($config['blacklist']);
                                    $mess       = "[center][b][img]http://i.imgur.com/XYl8P0p.gif[/img] Thêm [color=maroon] " . $nick . " [/color]vào danh sách đen trong [color=red] " . $time_banned . " [/color]với lý do[color=green] " . $reason . " [/color][/b] [img]http://i.imgur.com/pttUUJU.gif[/img][/center]";
                                    //Luu file + info
                                    $user_file3 = "banned/" . $nick . ".txt";
                                    $log        = fopen($user_file3, "a", 1);
                                    $data       = $date2 . '-' . $time_banned . '-' . $reason . '|';
                                    fwrite($log, $data);
                                    fclose($log);
                                }
                                post_cbox($mess);
                            } else {
                                post_cbox("[center][b]Chỉ có quản trị viên trở lên mới được quyền thêm thành viên vào danh sách đen[/b] :suong [/center]");
                            }
                        }
                    }
                }
                
                //Remove blacklist
                $chat = trim($chat);
                if (count(explode($remove_blacklist, strtolower($chat))) > 1) {
                    $command = $remove_blacklist;
                    Del_Mess_One($name, $command);
                    //Get name to add
                    preg_match("%'(.*)'%U", $chat, $nick);
                    $nick  = $nick[1];
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        
                        if ($nick != "") {
                            //Kiem tra nick nguoi ra lenh la manager tro len hay khong?
                            if (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true || Check_Manager($manager, $name) == true) {
                                
                                //Kiem tra xem nick da co trong blacklist chua?
                                if (Check_Blacklist($blacklist, $nick) == true) {
                                    for ($i = 0; $i < count($blacklist); $i++) {
                                        if ($blacklist->name[$i] == $nick) {
                                            unset($blacklist->name[$i]);
                                            $blacklist->asXML($config['blacklist']);
                                        }
                                    }
                                    $mess = "[center][b][img]http://i.imgur.com/JJqal6O.gif[/img] Đã xóa[color=maroon] " . $nick . " [/color]khỏi danh sách đen[/b] [img]http://i.imgur.com/pttUUJU.gif[/img][/center]";
                                    post_cbox($mess);
                                    //Xoa file + info
                                    $user_file3 = "banned/" . $nick . ".txt";
                                    unlink($user_file3);
                                } else {
                                    post_cbox("[center][b]Không tìm thấy[color=maroon] " . $nick . " [/color]trong danh sách đen[/b] :dauhang [/center]");
                                }
                            } else {
                                post_cbox("[center][b]Bạn chưa đủ trình xóa thành viên khỏi danh sách đen[/b] [img]http://i.imgur.com/lnT5ZUb.gif[/img][/center]");
                            }
                        }
                    }
                }
                
                
                //Banned User
                $chat = trim($chat);
                if (count(explode($ban_user, strtolower($chat))) > 1) {
                    $command = $ban_user;
                    Del_Mess_One($name, $command);
                    $time_banned = "";
                    //Get name to add
                    preg_match("%'(.*)'%U", $chat, $nick);
                    $nick = $nick[1];
                    
                    //Phan tich lay ra thoi gian banned
                    $t      = explode(',', $nick);
                    $nick   = $t[0];
                    $time   = $t[1];
                    $reason = $t[2];
                    if (count($t) > 1) {
                        $time_banned = urlencode($time);
                    } else { //Mac dinh  == > banned 7 days vidu:  banned 'zet'
                        $time_banned = urlencode('7 days');
                    }
                    if (count($t) > 2) {
                        $reason = urlencode($reason);
                    } else { //Mac dinh  == > banned 7 days vidu:  banned 'zet'
                        $reason = urlencode('Post Porn');
                    }
                    
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        
                        if ($nick != "") {
                            
                            if (strcmp($nick, $Bot_Name) == 0) { // Neu nick can banned la bot
                                $nick        = $name;
                                $time_banned = urlencode('100 days');
                                $check       = Banned_User($nick, $time_banned);
                                if ($check == true) {
                                    $mess = " :ban  [b][color=red]BANNED[/color][color=green] " . $nick . " [/color][/b][color=red][b] " . $time_banned . " [/b][/color][b][color=blue]Reason:[/color][color=black] Chống à [/color][/b] :thodai ";
                                    post_cbox("[center]" . $mess . "[/center]");
                                }
                            }
                            
                            //Kiem tra xem nick co phai la super admin, admin hay manager ko?
                            elseif (Check_SuperAdmin($superadmin, $nick) == true || Check_Admin($adminlist, $nick) == true) {
                                post_cbox("[center][b]Em sợ đại ca[color=blue] " . $nick . " [/color]chém em lắm[/b] :so [/center]");
                            }
                            
                            else {
                                $check = Banned_User($nick, $time_banned);
                                if ($check == true) {
                                    $mess = " :ban  [b][color=red]BANNED[/color][color=green] " . $nick . " [/color][/b]";
                                    $mess .= "[color=red][b] " . $time_banned . " [/b][/color] ";
                                    if ($reason)
                                        $mess .= "[b][color=blue]Reason:[/color][color=black] " . $reason . " [/color][/b] [img]http://i.imgur.com/3dXswYN.gif[/img]";
                                    post_cbox("[center]" . $mess . "[/center]");
                                    
                                    //Add blacklist
                                    if (Check_Blacklist($blacklist, $nick) == false) {
                                        //Kiem tra xem nick da co trong list vip chua?
                                        if (Check_Vip21($viplist2, $nick) == true) {
                                            $mess = "[center][b][color=purple]" . $nick . "[/color] [color=red]" . $phrase['vip_exist'] . "[/color][/b][/center]";
                                        }
                                        //Kiem tra xem nick da co trong list bots chua?
                                        elseif (Check_Bot1($bots, $nick) == true) {
                                            $mess = "[center][b][color=magenta]" . $nick . "[/color] [color=red]" . $phrase['bots_exist'] . "[/color][/b][/center]";
                                        } else {
                                            $bl = simplexml_load_file($config['blacklist']);
                                            $bl->addChild('name', $nick);
                                            $bl->asXML($config['blacklist']);
                                            $mess       = "[center][b][img]http://i.imgur.com/9UqC0yY.gif[/img] Thêm[color=blue] " . $nick . " [/color]vào danh sách đen trong [color=red] " . $time_banned . " [/color]với lý do[color=green] " . $reason . " [/color][/b] bye [/center]";
                                            //Luu file + info
                                            $user_file3 = "banned/" . $nick . ".txt";
                                            $log        = fopen($user_file3, "a", 1);
                                            $data       = $date2 . '-' . $time_banned . '-' . $reason . '|';
                                            fwrite($log, $data);
                                            fclose($log);
                                        }
                                        post_cbox($mess);
                                    } else { //Neu da co trong danh sach den
                                        post_cbox("[center][b]Thành viên[color=blue] " . $nick . " [/color]đã có trong danh sách đen[/b] [img]http://i.imgur.com/lN1HSDq.gif[/img][/center]");
                                        //Luu file + info
                                        $user_file3 = "banned/" . $nick . ".txt";
                                        $log        = fopen($user_file3, "a", 1);
                                        $data       = $date2 . '-' . $time_banned . '-' . $reason . '|';
                                        fwrite($log, $data);
                                        fclose($log);
                                    }
                                } else {
                                    post_cbox("[center][b]Không tìm thấy[color=blue] " . $nick . " [/color]trong Cbox [br][tim]Lệnh ban : vip-ban 'nick,so ngay ban, ly do ban'[/mau][/b][/center]");
                                }
                            }
                        }
                    }
                }
                
                
                //Del mess
                $chat = trim($chat);
                if (count(explode($delete_message, strtolower($chat))) > 1) {
                    $command = $delete_message;
                    Del_Mess_One($name, $command);
                    //Get name to del messs
                    preg_match("%'(.*)'%U", $chat, $nick);
                    $nick  = $nick[1];
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        
                        if ($nick != "") {
                            $total = Del_Mess_Nick($nick);
                            if ($total > 0) {
                                $mess = "[center][b]Đã xóa[color=green] " . $total . " [/color]messages của [color=blue] " . $nick . " [/color][/b][/center]";
                                post_cbox($mess);
                            }
                            if ($total == 0) {
                                $mess = "[center][b]Không tìm thấy[color=blue] " . $nick . " [/color]trong cBox[/b][/center]";
                                post_cbox($mess);
                            }
                        }
                    }
                }
                
                //Del mess all
                $chat = trim($chat);
                if (count(explode($delete_message_all, strtolower($chat))) > 1) {
                    $command = $delete_message_all;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        
                        //Kiem tra nick nguoi ra lenh la super admin hay admin khong?
                        if (Check_SuperAdmin($superadmin, $name) == true || Check_Admin($adminlist, $name) == true) {
                            $totals = Del_Mess_All();
                            if ($totals > 0) {
                                $mess = "[center] :3:ngau [b][color=green]Đã dọn dẹp sạch sẽ hoàn toàn Cbox[/color][/b] :ngau [/center]";
                                post_cbox($mess);
                            }
                            if ($totals == 0) {
                                $mess = "[center][b]Không có dòng chat nào trong cBox thì dọn dẹp cái gì?[/b] :ginua [/center]";
                                post_cbox($mess);
                            }
                        } else {
                            post_cbox("[center][b]Chỉ thành viên hội đồng quản trị mới được quyền xóa toàn bộ chat của thành viên[/b] :venh [/center]");
                        }
                    }
                }
                
                
                
                //Check support
                $chat = trim($chat);
                if (count(explode($check_support, strtolower($chat))) > 1) {
                    $command = $check_support;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b][color=Green]Support/Hỗ trợ:[/color][color=Purple] " . $bot_support . " [/color][br][color=Green]Not Support/Không hỗ trợ:[/color][color=Purple] " . $bot_not_support . " [/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                
                //Start fshare
                $chat = trim($chat);
                if (count(explode($fshare_on, strtolower($chat))) > 1) {
                    $command = $fshare_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->fshare->work);
                        $host->fshare->addChild('work', "yes");
                        $host->fshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Fshare.Vn[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop fshare
                $chat = trim($chat);
                if (count(explode($fshare_off, strtolower($chat))) > 1) {
                    $command = $fshare_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->fshare->work);
                        $host->fshare->addChild('work', "no");
                        $host->fshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Fshare.vn[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
				
                //Start kingfiles
                $chat = trim($chat);
                if (count(explode($kingfiles_on, strtolower($chat))) > 1) {
                    $command = $kingfiles_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->kingfiles->work);
                        $host->kingfiles->addChild('work', "yes");
                        $host->kingfiles->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Kingfiles.net[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop kingfiles
                $chat = trim($chat);
                if (count(explode($kingfiles_off, strtolower($chat))) > 1) {
                    $command = $kingfiles_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->kingfiles->work);
                        $host->kingfiles->addChild('work', "no");
                        $host->kingfiles->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Kingfiles.net[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
				//Start wushare
                $chat = trim($chat);
                if (count(explode($wushare_on, strtolower($chat))) > 1) {
                    $command = $wushare_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->wushare->work);
                        $host->wushare->addChild('work', "yes");
                        $host->wushare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Wushare.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop wushare
                $chat = trim($chat);
                if (count(explode($wushare_off, strtolower($chat))) > 1) {
                    $command = $wushare_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->wushare->work);
                        $host->wushare->addChild('work', "no");
                        $host->wushare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Wushare.com[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
				//Start Filespace.com
                $chat = trim($chat);
                if (count(explode($filespace_on, strtolower($chat))) > 1) {
                    $command = $filespace_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->filespace->work);
                        $host->filespace->addChild('work', "yes");
                        $host->filespace->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Filespace.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop filespace
                $chat = trim($chat);
                if (count(explode($filespace_off, strtolower($chat))) > 1) {
                    $command = $filespace_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->filespace->work);
                        $host->filespace->addChild('work', "no");
                        $host->filespace->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Filespace.com[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
				//Start subyshare
                $chat = trim($chat);
                if (count(explode($subyshare_on, strtolower($chat))) > 1) {
                    $command = $subyshare_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->subyshare->work);
                        $host->subyshare->addChild('work', "yes");
                        $host->subyshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]subyshare.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop subyshare
                $chat = trim($chat);
                if (count(explode($subyshare_off, strtolower($chat))) > 1) {
                    $command = $subyshare_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->subyshare->work);
                        $host->subyshare->addChild('work', "no");
                        $host->subyshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]subyshare.com[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
				
				//Start soundcloud
                $chat = trim($chat);
                if (count(explode($soundcloud_on, strtolower($chat))) > 1) {
                    $command = $soundcloud_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->soundcloud->work);
                        $host->soundcloud->addChild('work', "yes");
                        $host->soundcloud->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]soundcloud.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop soundcloud
                $chat = trim($chat);
                if (count(explode($soundcloud_off, strtolower($chat))) > 1) {
                    $command = $soundcloud_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->soundcloud->work);
                        $host->soundcloud->addChild('work', "no");
                        $host->soundcloud->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]soundcloud.com[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
               //Start filesflash
                $chat = trim($chat);
                if (count(explode($filesflash_on, strtolower($chat))) > 1) {
                    $command = $filesflash_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->filesflash->work);
                        $host->filesflash->addChild('work', "yes");
                        $host->filesflash->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]filesflash.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop filesflash
                $chat = trim($chat);
                if (count(explode($filesflash_off, strtolower($chat))) > 1) {
                    $command = $filesflash_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->filesflash->work);
                        $host->filesflash->addChild('work', "no");
                        $host->filesflash->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]filesflash.com[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
               //Start hugefiles
                $chat = trim($chat);
                if (count(explode($hugefiles_on, strtolower($chat))) > 1) {
                    $command = $hugefiles_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->hugefiles->work);
                        $host->hugefiles->addChild('work', "yes");
                        $host->hugefiles->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]hugefiles.net[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop hugefiles
                $chat = trim($chat);
                if (count(explode($hugefiles_off, strtolower($chat))) > 1) {
                    $command = $hugefiles_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->hugefiles->work);
                        $host->hugefiles->addChild('work', "no");
                        $host->hugefiles->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]hugefiles.net[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
               //Start scribd
                $chat = trim($chat);
                if (count(explode($scribd_on, strtolower($chat))) > 1) {
                    $command = $scribd_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->scribd->work);
                        $host->scribd->addChild('work', "yes");
                        $host->scribd->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]scribd.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop scribd
                $chat = trim($chat);
                if (count(explode($scribd_off, strtolower($chat))) > 1) {
                    $command = $scribd_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->scribd->work);
                        $host->scribd->addChild('work', "no");
                        $host->scribd->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]scribd.com[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
               //Start tusfiles
                $chat = trim($chat);
                if (count(explode($tusfiles_on, strtolower($chat))) > 1) {
                    $command = $tusfiles_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->tusfiles->work);
                        $host->tusfiles->addChild('work', "yes");
                        $host->tusfiles->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]tusfiles.net[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop tusfiles
                $chat = trim($chat);
                if (count(explode($tusfiles_off, strtolower($chat))) > 1) {
                    $command = $tusfiles_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->tusfiles->work);
                        $host->tusfiles->addChild('work', "no");
                        $host->tusfiles->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]tusfiles.net[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
               //Start speedyshare
                $chat = trim($chat);
                if (count(explode($speedyshare_on, strtolower($chat))) > 1) {
                    $command = $speedyshare_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->speedyshare->work);
                        $host->speedyshare->addChild('work', "yes");
                        $host->speedyshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]speedyshare.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop speedyshare
                $chat = trim($chat);
                if (count(explode($speedyshare_off, strtolower($chat))) > 1) {
                    $command = $speedyshare_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->speedyshare->work);
                        $host->speedyshare->addChild('work', "no");
                        $host->speedyshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]speedyshare.com[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
               //Start ul.to
                $chat = trim($chat);
                if (count(explode($ulto_on, strtolower($chat))) > 1) {
                    $command = $ulto_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->ulto->work);
                        $host->ulto->addChild('work', "yes");
                        $host->ulto->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]ul.to[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop ulto
                $chat = trim($chat);
                if (count(explode($ulto_off, strtolower($chat))) > 1) {
                    $command = $ulto_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->ulto->work);
                        $host->ulto->addChild('work', "no");
                        $host->ulto->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]ul.to[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
               //Start datafile
                $chat = trim($chat);
                if (count(explode($datafile_on, strtolower($chat))) > 1) {
                    $command = $datafile_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->datafile->work);
                        $host->datafile->addChild('work', "yes");
                        $host->datafile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]datafile.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop datafile
                $chat = trim($chat);
                if (count(explode($datafile_off, strtolower($chat))) > 1) {
                    $command = $datafile_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->datafile->work);
                        $host->datafile->addChild('work', "no");
                        $host->datafile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]datafile.com[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
               //Start filesmonster
                $chat = trim($chat);
                if (count(explode($filesmonster_on, strtolower($chat))) > 1) {
                    $command = $filesmonster_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->filesmonster->work);
                        $host->filesmonster->addChild('work', "yes");
                        $host->filesmonster->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]filesmonster.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop filesmonster
                $chat = trim($chat);
                if (count(explode($filesmonster_off, strtolower($chat))) > 1) {
                    $command = $filesmonster_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->filesmonster->work);
                        $host->filesmonster->addChild('work', "no");
                        $host->filesmonster->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]filesmonster.com[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
               //Start depfile
                $chat = trim($chat);
                if (count(explode($depfile_on, strtolower($chat))) > 1) {
                    $command = $depfile_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->depfile->work);
                        $host->depfile->addChild('work', "yes");
                        $host->depfile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]depfile.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop depfile
                $chat = trim($chat);
                if (count(explode($depfile_off, strtolower($chat))) > 1) {
                    $command = $depfile_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->depfile->work);
                        $host->depfile->addChild('work', "no");
                        $host->depfile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]depfile.com[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
               //Start uploading
                $chat = trim($chat);
                if (count(explode($uploading_on, strtolower($chat))) > 1) {
                    $command = $uploading_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->uploading->work);
                        $host->uploading->addChild('work', "yes");
                        $host->uploading->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]uploading.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop uploading
                $chat = trim($chat);
                if (count(explode($uploading_off, strtolower($chat))) > 1) {
                    $command = $uploading_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->uploading->work);
                        $host->uploading->addChild('work', "no");
                        $host->uploading->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]uploading.com[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
               //Start vipfile
                $chat = trim($chat);
                if (count(explode($vipfile_on, strtolower($chat))) > 1) {
                    $command = $vipfile_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->vipfile->work);
                        $host->vipfile->addChild('work', "yes");
                        $host->vipfile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]vip-file.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop vipfile
                $chat = trim($chat);
                if (count(explode($vipfile_off, strtolower($chat))) > 1) {
                    $command = $vipfile_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->vipfile->work);
                        $host->vipfile->addChild('work', "no");
                        $host->vipfile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]vip-file.com[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
               //Start nowdownload.ch
                $chat = trim($chat);
                if (count(explode($nowdownload_on, strtolower($chat))) > 1) {
                    $command = $nowdownload_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->nowdownload->work);
                        $host->nowdownload->addChild('work', "yes");
                        $host->nowdownload->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]nowdownload.ch[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop nowdownload
                $chat = trim($chat);
                if (count(explode($nowdownload_off, strtolower($chat))) > 1) {
                    $command = $nowdownload_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->nowdownload->work);
                        $host->nowdownload->addChild('work', "no");
                        $host->nowdownload->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]nowdownload.ch[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
               //Start shareflare.com
                $chat = trim($chat);
                if (count(explode($shareflare_on, strtolower($chat))) > 1) {
                    $command = $shareflare_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->shareflare->work);
                        $host->shareflare->addChild('work', "yes");
                        $host->shareflare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]shareflare.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop shareflare
                $chat = trim($chat);
                if (count(explode($shareflare_off, strtolower($chat))) > 1) {
                    $command = $shareflare_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->shareflare->work);
                        $host->shareflare->addChild('work', "no");
                        $host->shareflare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]shareflare.com[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Start yunfile.com
                $chat = trim($chat);
                if (count(explode($yunfile_on, strtolower($chat))) > 1) {
                    $command = $yunfile_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->yunfile->work);
                        $host->yunfile->addChild('work', "yes");
                        $host->yunfile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]yunfile.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop yunfile
                $chat = trim($chat);
                if (count(explode($yunfile_off, strtolower($chat))) > 1) {
                    $command = $yunfile_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->yunfile->work);
                        $host->yunfile->addChild('work', "no");
                        $host->yunfile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]yunfile.com[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
               //Start yunfile.com
                $chat = trim($chat);
                if (count(explode($yunfilecom_on, strtolower($chat))) > 1) {
                    $command = $yunfilecom_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->yunfile->work);
                        $host->yunfile->addChild('work', "yes");
                        $host->yunfile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]yunfile.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop yunfile
                $chat = trim($chat);
                if (count(explode($yunfilecom_off, strtolower($chat))) > 1) {
                    $command = $yunfilecom_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->yunfile->work);
                        $host->yunfile->addChild('work', "no");
                        $host->yunfile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]yunfile.com[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
               //Start sendspace.com
                $chat = trim($chat);
                if (count(explode($sendspacecom_on, strtolower($chat))) > 1) {
                    $command = $sendspacecom_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->sendspace->work);
                        $host->sendspace->addChild('work', "yes");
                        $host->sendspace->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]sendspace.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop sendspace
                $chat = trim($chat);
                if (count(explode($sendspacecom_off, strtolower($chat))) > 1) {
                    $command = $sendspacecom_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->sendspace->work);
                        $host->sendspace->addChild('work', "no");
                        $host->sendspace->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]sendspace.com[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
               //Start onefichier.com
                $chat = trim($chat);
                if (count(explode($onefichiercom_on, strtolower($chat))) > 1) {
                    $command = $onefichiercom_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->onefichier->work);
                        $host->onefichier->addChild('work', "yes");
                        $host->onefichier->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]1fichier.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop onefichier
                $chat = trim($chat);
                if (count(explode($onefichiercom_off, strtolower($chat))) > 1) {
                    $command = $onefichiercom_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->onefichier->work);
                        $host->onefichier->addChild('work', "no");
                        $host->onefichier->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]1fichier.com[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
               //Start littlebyte.net
                $chat = trim($chat);
                if (count(explode($littlebyte_on, strtolower($chat))) > 1) {
                    $command = $littlebyte_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->littlebyte->work);
                        $host->littlebyte->addChild('work', "yes");
                        $host->littlebyte->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]littlebyte.net[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Stop littlebyte
                $chat = trim($chat);
                if (count(explode($littlebyte_off, strtolower($chat))) > 1) {
                    $command = $littlebyte_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->littlebyte->work);
                        $host->littlebyte->addChild('work', "no");
                        $host->littlebyte->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]littlebyte.net[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
               
                
                //Start share-oneline
                $chat = trim($chat);
                if (count(explode($shareonline_on, strtolower($chat))) > 1) {
                    $command = $shareonline_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->shareonline->work);
                        $host->shareonline->addChild('work', "yes");
                        $host->shareonline->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Share-Online.Biz[/color] [/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop shareonline
                $chat = trim($chat);
                if (count(explode($shareonline_off, strtolower($chat))) > 1) {
                    $command = $shareonline_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->shareonline->work);
                        $host->shareonline->addChild('work', "no");
                        $host->shareonline->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Share-Online.Biz[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start nitroflare 
                $chat = trim($chat);
                if (count(explode($nitroflare_on, strtolower($chat))) > 1) {
                    $command = $nitroflare_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->nitroflare->work);
                        $host->nitroflare->addChild('work', "yes");
                        $host->nitroflare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Nitroflare.com[/color] [color=red] " . $proxyfs . " [/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop nitroflare 
                $chat = trim($chat);
                if (count(explode($nitroflare_off, strtolower($chat))) > 1) {
                    $command = $nitroflare_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->nitroflare->work);
                        $host->nitroflare->addChild('work', "no");
                        $host->nitroflare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]NitroFlare.com[/color] [color=red] " . $proxyfs . " [/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                                
                //Start secureupload
                $chat = trim($chat);
                if (count(explode($secureupload_on, strtolower($chat))) > 1) {
                    $command = $secureupload_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->secureupload->work);
                        $host->secureupload->addChild('work', "yes");
                        $host->secureupload->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Secureupload.eu[/color] [color=red] " . $proxyfs . " [/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop secureupload 
                $chat = trim($chat);
                if (count(explode($secureupload_off, strtolower($chat))) > 1) {
                    $command = $secureupload_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->secureupload->work);
                        $host->secureupload->addChild('work', "no");
                        $host->secureupload->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Secureupload.eu[/color] [color=red] " . $proxyfs . " [/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                                
                //Start salefiles
                $chat = trim($chat);
                if (count(explode($salefiles_on, strtolower($chat))) > 1) {
                    $command = $salefiles_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->salefiles->work);
                        $host->salefiles->addChild('work', "yes");
                        $host->salefiles->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Salefiles.com[/color] [color=red] " . $proxyfs . " [/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop salefiles 
                $chat = trim($chat);
                if (count(explode($salefiles_off, strtolower($chat))) > 1) {
                    $command = $salefiles_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->salefiles->work);
                        $host->salefiles->addChild('work', "no");
                        $host->salefiles->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Salefiles.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start 4sharevn
                $chat = trim($chat);
                if (count(explode($foursharevn_on, strtolower($chat))) > 1) {
                    $command = $foursharevn_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->foursharevn->work);
                        $host->foursharevn->addChild('work', "yes");
                        $host->foursharevn->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]4share.vn[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop 4sharevn
                $chat = trim($chat);
                if (count(explode($foursharevn_off, strtolower($chat))) > 1) {
                    $command = $foursharevn_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->foursharevn->work);
                        $host->foursharevn->addChild('work', "no");
                        $host->foursharevn->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]4share.vn[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start 4sharevn member
                $chat = trim($chat);
                if (count(explode($foursharemember_on, strtolower($chat))) > 1) {
                    $command = $foursharemember_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->foursharemember->work);
                        $host->foursharemember->addChild('work', "yes");
                        $host->foursharemember->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        //	$mess = "[center][b] [color=red]".$name."[/color][br][color=green]Bắt đầu get link[/color] [color=blue]4share.vn[/color] [color=red] ".$proxy4s." [/color][/b][/center]";
                        //	post_cbox($mess);
                    }
                }
                
                //Stop 4sharevn member
                $chat = trim($chat);
                if (count(explode($foursharemember_off, strtolower($chat))) > 1) {
                    $command = $foursharemember_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->foursharemember->work);
                        $host->foursharemember->addChild('work', "no");
                        $host->foursharemember->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        //	$mess = "[center][b] [color=red]".$name."[/color][br][color=green]Đã dừng get link[/color] [color=blue]4share.vn[/color] [color=red] ".$proxy4s." [/color][/b][/center]";
                        //	post_cbox($mess);
                    }
                }
                
                
                //Start sharevnn
                $chat = trim($chat);
                if (count(explode($sharevnn_on, strtolower($chat))) > 1) {
                    $command = $sharevnn_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->sharevnn->work);
                        $host->sharevnn->addChild('work', "yes");
                        $host->sharevnn->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Share.vnn.vn[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop sharevnn
                $chat = trim($chat);
                if (count(explode($sharevnn_off, strtolower($chat))) > 1) {
                    $command = $sharevnn_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->sharevnn->work);
                        $host->sharevnn->addChild('work', "no");
                        $host->sharevnn->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Share.vnn.vn[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start tenluavn
                $chat = trim($chat);
                if (count(explode($tenluavn_on, strtolower($chat))) > 1) {
                    $command = $tenluavn_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->tenluavn->work);
                        $host->tenluavn->addChild('work', "yes");
                        $host->tenluavn->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Tenlua.vn[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop tenluavn
                $chat = trim($chat);
                if (count(explode($tenluavn_off, strtolower($chat))) > 1) {
                    $command = $tenluavn_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->tenluavn->work);
                        $host->tenluavn->addChild('work', "no");
                        $host->tenluavn->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Tenlua.vn[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start upfilevn
                $chat = trim($chat);
                if (count(explode($upfilevn_on, strtolower($chat))) > 1) {
                    $command = $upfilevn_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->upfilevn->work);
                        $host->upfilevn->addChild('work', "yes");
                        $host->upfilevn->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Upfile.vn[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop upfilevn
                $chat = trim($chat);
                if (count(explode($upfilevn_off, strtolower($chat))) > 1) {
                    $command = $upfilevn_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->upfilevn->work);
                        $host->upfilevn->addChild('work', "no");
                        $host->upfilevn->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Upfile.vn[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start mediafire
                $chat = trim($chat);
                if (count(explode($mediafire_on, strtolower($chat))) > 1) {
                    $command = $mediafire_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->mediafire->work);
                        $host->mediafire->addChild('work', "yes");
                        $host->mediafire->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Mediafire.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop mediafire
                $chat = trim($chat);
                if (count(explode($mediafire_off, strtolower($chat))) > 1) {
                    $command = $mediafire_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->mediafire->work);
                        $host->mediafire->addChild('work', "no");
                        $host->mediafire->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Mediafire.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start netload
                $chat = trim($chat);
                if (count(explode($netload_on, strtolower($chat))) > 1) {
                    $command = $netload_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->netload->work);
                        $host->netload->addChild('work', "yes");
                        $host->netload->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Netload.in[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop netload
                $chat = trim($chat);
                if (count(explode($netload_off, strtolower($chat))) > 1) {
                    $command = $netload_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->netload->work);
                        $host->netload->addChild('work', "no");
                        $host->netload->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Netload.in[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start uploaded
                $chat = trim($chat);
                if (count(explode($uploaded_on, strtolower($chat))) > 1) {
                    $command = $uploaded_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->uploaded->work);
                        $host->uploaded->addChild('work', "yes");
                        $host->uploaded->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Uploaded.net[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop uploaded
                $chat = trim($chat);
                if (count(explode($uploaded_off, strtolower($chat))) > 1) {
                    $command = $uploaded_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->uploaded->work);
                        $host->uploaded->addChild('work', "no");
                        $host->uploaded->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Uploaded.net[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start rapidgator
                $chat = trim($chat);
                if (count(explode($rapidgator_on, strtolower($chat))) > 1) {
                    $command = $rapidgator_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->rapidgator->work);
                        $host->rapidgator->addChild('work', "yes");
                        $host->rapidgator->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Rapidgator.net[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop rapidgator
                $chat = trim($chat);
                if (count(explode($rapidgator_off, strtolower($chat))) > 1) {
                    $command = $rapidgator_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->rapidgator->work);
                        $host->rapidgator->addChild('work', "no");
                        $host->rapidgator->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Rapidgator.net[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                               
                //Start hitfile
                $chat = trim($chat);
                if (count(explode($hitfile_on, strtolower($chat))) > 1) {
                    $command = $hitfile_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->hitfile->work);
                        $host->hitfile->addChild('work', "yes");
                        $host->hitfile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Hitfile.net[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop hitfile
                $chat = trim($chat);
                if (count(explode($hitfile_off, strtolower($chat))) > 1) {
                    $command = $hitfile_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->hitfile->work);
                        $host->hitfile->addChild('work', "no");
                        $host->hitfile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Hitfile.net[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start letitbit
                $chat = trim($chat);
                if (count(explode($letitbit_on, strtolower($chat))) > 1) {
                    $command = $letitbit_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->letitbit->work);
                        $host->letitbit->addChild('work', "yes");
                        $host->letitbit->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Letitbit.net[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop letitbit
                $chat = trim($chat);
                if (count(explode($letitbit_off, strtolower($chat))) > 1) {
                    $command = $letitbit_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->letitbit->work);
                        $host->letitbit->addChild('work', "no");
                        $host->letitbit->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Letitbit.net[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                             
                //Start novafile
                $chat = trim($chat);
                if (count(explode($novafile_on, strtolower($chat))) > 1) {
                    $command = $novafile_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->novafile->work);
                        $host->novafile->addChild('work', "yes");
                        $host->novafile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Novafile.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop novafile
                $chat = trim($chat);
                if (count(explode($novafile_off, strtolower($chat))) > 1) {
                    $command = $novafile_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->novafile->work);
                        $host->novafile->addChild('work', "no");
                        $host->novafile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Novafile.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start turbobit
                $chat = trim($chat);
                if (count(explode($turbobit_on, strtolower($chat))) > 1) {
                    $command = $turbobit_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->turbobit->work);
                        $host->turbobit->addChild('work', "yes");
                        $host->turbobit->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Turbobit.net[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop turbobit
                $chat = trim($chat);
                if (count(explode($turbobit_off, strtolower($chat))) > 1) {
                    $command = $turbobit_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->turbobit->work);
                        $host->turbobit->addChild('work', "no");
                        $host->turbobit->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Turbobit.net[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start ryushare
                $chat = trim($chat);
                if (count(explode($ryushare_on, strtolower($chat))) > 1) {
                    $command = $ryushare_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->ryushare->work);
                        $host->ryushare->addChild('work', "yes");
                        $host->ryushare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Ryushare.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop ryushare
                $chat = trim($chat);
                if (count(explode($ryushare_off, strtolower($chat))) > 1) {
                    $command = $ryushare_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->ryushare->work);
                        $host->ryushare->addChild('work', "no");
                        $host->ryushare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Ryushare.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start filefactory
                $chat = trim($chat);
                if (count(explode($filefactory_on, strtolower($chat))) > 1) {
                    $command = $filefactory_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->filefactory->work);
                        $host->filefactory->addChild('work', "yes");
                        $host->filefactory->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Filefactory.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop filefactory
                $chat = trim($chat);
                if (count(explode($filefactory_off, strtolower($chat))) > 1) {
                    $command = $filefactory_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->filefactory->work);
                        $host->filefactory->addChild('work', "no");
                        $host->filefactory->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Filefactory.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start filepost
                $chat = trim($chat);
                if (count(explode($filepost_on, strtolower($chat))) > 1) {
                    $command = $filepost_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->filepost->work);
                        $host->filepost->addChild('work', "yes");
                        $host->filepost->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Filepost.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop filepost
                $chat = trim($chat);
                if (count(explode($filepost_off, strtolower($chat))) > 1) {
                    $command = $filepost_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->filepost->work);
                        $host->filepost->addChild('work', "no");
                        $host->filepost->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Filepost.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start fourshared
                $chat = trim($chat);
                if (count(explode($fourshared_on, strtolower($chat))) > 1) {
                    $command = $fourshared_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->fourshared->work);
                        $host->fourshared->addChild('work', "yes");
                        $host->fourshared->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]4shared.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop fourshared
                $chat = trim($chat);
                if (count(explode($fourshared_off, strtolower($chat))) > 1) {
                    $command = $fourshared_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->fourshared->work);
                        $host->fourshared->addChild('work', "no");
                        $host->fourshared->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]4shared.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start depositfiles
                $chat = trim($chat);
                if (count(explode($depositfiles_on, strtolower($chat))) > 1) {
                    $command = $depositfiles_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->depositfiles->work);
                        $host->depositfiles->addChild('work', "yes");
                        $host->depositfiles->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Depositfiles.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop depositfiles
                $chat = trim($chat);
                if (count(explode($depositfiles_off, strtolower($chat))) > 1) {
                    $command = $depositfiles_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->depositfiles->work);
                        $host->depositfiles->addChild('work', "no");
                        $host->depositfiles->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Depositfiles.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start terafile
                $chat = trim($chat);
                if (count(explode($terafile_on, strtolower($chat))) > 1) {
                    $command = $terafile_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->terafile->work);
                        $host->terafile->addChild('work', "yes");
                        $host->terafile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Terafile.co[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop terafile
                $chat = trim($chat);
                if (count(explode($terafile_off, strtolower($chat))) > 1) {
                    $command = $terafile_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->terafile->work);
                        $host->terafile->addChild('work', "no");
                        $host->terafile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Terafile.co[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start oboom
                $chat = trim($chat);
                if (count(explode($oboom_on, strtolower($chat))) > 1) {
                    $command = $oboom_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->oboom->work);
                        $host->oboom->addChild('work', "yes");
                        $host->oboom->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Oboom.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop oboom
                $chat = trim($chat);
                if (count(explode($oboom_off, strtolower($chat))) > 1) {
                    $command = $oboom_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->oboom->work);
                        $host->oboom->addChild('work', "no");
                        $host->oboom->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Oboom.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start bitshare
                $chat = trim($chat);
                if (count(explode($bitshare_on, strtolower($chat))) > 1) {
                    $command = $bitshare_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->bitshare->work);
                        $host->bitshare->addChild('work', "yes");
                        $host->bitshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Bitshare.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop bitshare
                $chat = trim($chat);
                if (count(explode($bitshare_off, strtolower($chat))) > 1) {
                    $command = $bitshare_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->bitshare->work);
                        $host->bitshare->addChild('work', "no");
                        $host->bitshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Bitshare.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start uptobox
                $chat = trim($chat);
                if (count(explode($uptobox_on, strtolower($chat))) > 1) {
                    $command = $uptobox_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->uptobox->work);
                        $host->uptobox->addChild('work', "yes");
                        $host->uptobox->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Uptobox.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop uptobox
                $chat = trim($chat);
                if (count(explode($uptobox_off, strtolower($chat))) > 1) {
                    $command = $uptobox_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->uptobox->work);
                        $host->uptobox->addChild('work', "no");
                        $host->uptobox->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Uptobox.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start extmatrix
                $chat = trim($chat);
                if (count(explode($extmatrix_on, strtolower($chat))) > 1) {
                    $command = $extmatrix_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->extmatrix->work);
                        $host->extmatrix->addChild('work', "yes");
                        $host->extmatrix->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Extmatrix.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop extmatrix
                $chat = trim($chat);
                if (count(explode($extmatrix_off, strtolower($chat))) > 1) {
                    $command = $extmatrix_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->extmatrix->work);
                        $host->extmatrix->addChild('work', "no");
                        $host->extmatrix->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Extmatrix.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start megaconz
                $chat = trim($chat);
                if (count(explode($megaconz_on, strtolower($chat))) > 1) {
                    $command = $megaconz_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->megaconz->work);
                        $host->megaconz->addChild('work', "yes");
                        $host->megaconz->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Mega.co.nz[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop megaconz
                $chat = trim($chat);
                if (count(explode($megaconz_off, strtolower($chat))) > 1) {
                    $command = $megaconz_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->megaconz->work);
                        $host->megaconz->addChild('work', "no");
                        $host->megaconz->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Mega.co.nz[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start freakshare
                $chat = trim($chat);
                if (count(explode($freakshare_on, strtolower($chat))) > 1) {
                    $command = $freakshare_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->freakshare->work);
                        $host->freakshare->addChild('work', "yes");
                        $host->freakshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Freakshare.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop freakshare
                $chat = trim($chat);
                if (count(explode($freakshare_off, strtolower($chat))) > 1) {
                    $command = $freakshare_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->freakshare->work);
                        $host->freakshare->addChild('work', "no");
                        $host->freakshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Freakshare.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start firedrive
                $chat = trim($chat);
                if (count(explode($firedrive_on, strtolower($chat))) > 1) {
                    $command = $firedrive_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->firedrive->work);
                        $host->firedrive->addChild('work', "yes");
                        $host->firedrive->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Firedrive.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop firedrive
                $chat = trim($chat);
                if (count(explode($firedrive_off, strtolower($chat))) > 1) {
                    $command = $firedrive_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->firedrive->work);
                        $host->firedrive->addChild('work', "no");
                        $host->firedrive->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Firedrive.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start uploadable
                $chat = trim($chat);
                if (count(explode($uploadable_on, strtolower($chat))) > 1) {
                    $command = $uploadable_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->uploadable->work);
                        $host->uploadable->addChild('work', "yes");
                        $host->uploadable->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Uploadable.ch[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop uploadable
                $chat = trim($chat);
                if (count(explode($uploadable_off, strtolower($chat))) > 1) {
                    $command = $uploadable_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->uploadable->work);
                        $host->uploadable->addChild('work', "no");
                        $host->uploadable->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Uploadable.ch[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start zippyshare
                $chat = trim($chat);
                if (count(explode($zippyshare_on, strtolower($chat))) > 1) {
                    $command = $zippyshare_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->zippyshare->work);
                        $host->zippyshare->addChild('work', "yes");
                        $host->zippyshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Zippyshare.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop zippyshare
                $chat = trim($chat);
                if (count(explode($zippyshare_off, strtolower($chat))) > 1) {
                    $command = $zippyshare_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->zippyshare->work);
                        $host->zippyshare->addChild('work', "no");
                        $host->zippyshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Zippyshare.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start keep2share
                $chat = trim($chat);
                if (count(explode($keep2share_on, strtolower($chat))) > 1) {
                    $command = $keep2share_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->keeptwoshare->work);
                        $host->keeptwoshare->addChild('work', "yes");
                        $host->keeptwoshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Keep2share.cc[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop keep2share
                $chat = trim($chat);
                if (count(explode($keep2share_off, strtolower($chat))) > 1) {
                    $command = $keep2share_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->keeptwoshare->work);
                        $host->keeptwoshare->addChild('work', "no");
                        $host->keeptwoshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Keep2share.cc[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start megashares
                $chat = trim($chat);
                if (count(explode($megashares_on, strtolower($chat))) > 1) {
                    $command = $megashares_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->megashares->work);
                        $host->megashares->addChild('work', "yes");
                        $host->megashares->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Megashares.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop megashares
                $chat = trim($chat);
                if (count(explode($megashares_off, strtolower($chat))) > 1) {
                    $command = $megashares_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->megashares->work);
                        $host->megashares->addChild('work', "no");
                        $host->megashares->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Megashares.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start youtube
                $chat = trim($chat);
                if (count(explode($youtube_on, strtolower($chat))) > 1) {
                    $command = $youtube_on;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->youtube->work);
                        $host->youtube->addChild('work', "yes");
                        $host->youtube->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]Youtube.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop youtube
                $chat = trim($chat);
                if (count(explode($youtube_off, strtolower($chat))) > 1) {
                    $command = $youtube_off;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->youtube->work);
                        $host->youtube->addChild('work', "no");
                        $host->youtube->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]Youtube.com[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                
                //Start All Host
                $chat = trim($chat);
                if (count(explode($start_allhost, strtolower($chat))) > 1) {
                    $command = $start_allhost;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option start
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->fshare->work);
                        $host->fshare->addChild('work', "yes");
                        $host->fshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->nitroflare->work);
                        $host->nitroflare->addChild('work', "yes");
                        $host->nitroflare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->foursharevn->work);
                        $host->foursharevn->addChild('work', "yes");
                        $host->foursharevn->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->foursharemember->work);
                        $host->foursharemember->addChild('work', "yes");
                        $host->foursharemember->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->sharevnn->work);
                        $host->sharevnn->addChild('work', "yes");
                        $host->sharevnn->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->upfilevn->work);
                        $host->upfilevn->addChild('work', "yes");
                        $host->upfilevn->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->tenluavn->work);
                        $host->tenluavn->addChild('work', "yes");
                        $host->tenluavn->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->mediafire->work);
                        $host->mediafire->addChild('work', "yes");
                        $host->mediafire->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->netload->work);
                        $host->netload->addChild('work', "yes");
                        $host->netload->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->uploaded->work);
                        $host->uploaded->addChild('work', "yes");
                        $host->uploaded->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->rapidgator->work);
                        $host->rapidgator->addChild('work', "yes");
                        $host->rapidgator->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->letitbit->work);
                        $host->letitbit->addChild('work', "yes");
                        $host->letitbit->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->novafile->work);
                        $host->novafile->addChild('work', "yes");
                        $host->novafile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->turbobit->work);
                        $host->turbobit->addChild('work', "yes");
                        $host->turbobit->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->ryushare->work);
                        $host->ryushare->addChild('work', "yes");
                        $host->ryushare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->filefactory->work);
                        $host->filefactory->addChild('work', "yes");
                        $host->filefactory->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->filepost->work);
                        $host->filepost->addChild('work', "yes");
                        $host->filepost->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->fourshared->work);
                        $host->fourshared->addChild('work', "yes");
                        $host->fourshared->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->depositfiles->work);
                        $host->depositfiles->addChild('work', "yes");
                        $host->depositfiles->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->terafile->work);
                        $host->terafile->addChild('work', "yes");
                        $host->terafile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->oboom->work);
                        $host->oboom->addChild('work', "yes");
                        $host->oboom->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->bitshare->work);
                        $host->bitshare->addChild('work', "yes");
                        $host->bitshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->uptobox->work);
                        $host->uptobox->addChild('work', "yes");
                        $host->uptobox->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->extmatrix->work);
                        $host->extmatrix->addChild('work', "yes");
                        $host->extmatrix->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->megaconz->work);
                        $host->megaconz->addChild('work', "yes");
                        $host->megaconz->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->freakshare->work);
                        $host->freakshare->addChild('work', "yes");
                        $host->freakshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->firedrive->work);
                        $host->firedrive->addChild('work', "yes");
                        $host->firedrive->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->uploadable->work);
                        $host->uploadable->addChild('work', "yes");
                        $host->uploadable->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->zippyshare->work);
                        $host->zippyshare->addChild('work', "yes");
                        $host->zippyshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->keeptwoshare->work);
                        $host->keeptwoshare->addChild('work', "yes");
                        $host->keeptwoshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->megashares->work);
                        $host->megashares->addChild('work', "yes");
                        $host->megashares->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->youtube->work);
                        $host->youtube->addChild('work', "yes");
                        $host->youtube->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Bắt đầu get link[/color] [color=blue]tất cả các File Host[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
                
                //Stop all Host
                $chat = trim($chat);
                if (count(explode($stop_allhost, strtolower($chat))) > 1) {
                    $command = $stop_allhost;
                    Del_Mess_One($name, $command);
                    $check = Check_Chat($chat, $user_file, $id_user);
                    if ($check == true);
                    else {
                        //Set option stop
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->fshare->work);
                        $host->fshare->addChild('work', "no");
                        $host->fshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->nitroflare->work);
                        $host->nitroflare->addChild('work', "no");
                        $host->nitroflare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->foursharevn->work);
                        $host->foursharevn->addChild('work', "no");
                        $host->foursharevn->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->foursharemember->work);
                        $host->foursharemember->addChild('work', "no");
                        $host->foursharemember->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->sharevnn->work);
                        $host->sharevnn->addChild('work', "no");
                        $host->sharevnn->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->upfilevn->work);
                        $host->upfilevn->addChild('work', "no");
                        $host->upfilevn->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->tenluavn->work);
                        $host->tenluavn->addChild('work', "no");
                        $host->tenluavn->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->mediafire->work);
                        $host->mediafire->addChild('work', "no");
                        $host->mediafire->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->netload->work);
                        $host->netload->addChild('work', "no");
                        $host->netload->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->uploaded->work);
                        $host->uploaded->addChild('work', "no");
                        $host->uploaded->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->rapidgator->work);
                        $host->rapidgator->addChild('work', "no");
                        $host->rapidgator->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        unset($host->letitbit->work);
                        $host->letitbit->addChild('work', "no");
                        $host->letitbit->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->novafile->work);
                        $host->novafile->addChild('work', "no");
                        $host->novafile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->turbobit->work);
                        $host->turbobit->addChild('work', "no");
                        $host->turbobit->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->ryushare->work);
                        $host->ryushare->addChild('work', "no");
                        $host->ryushare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->filefactory->work);
                        $host->filefactory->addChild('work', "no");
                        $host->filefactory->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->filepost->work);
                        $host->filepost->addChild('work', "no");
                        $host->filepost->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->fourshared->work);
                        $host->fourshared->addChild('work', "no");
                        $host->fourshared->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->depositfiles->work);
                        $host->depositfiles->addChild('work', "no");
                        $host->depositfiles->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->terafile->work);
                        $host->terafile->addChild('work', "no");
                        $host->terafile->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->oboom->work);
                        $host->oboom->addChild('work', "no");
                        $host->oboom->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->bitshare->work);
                        $host->bitshare->addChild('work', "no");
                        $host->bitshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->uptobox->work);
                        $host->uptobox->addChild('work', "no");
                        $host->uptobox->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->extmatrix->work);
                        $host->extmatrix->addChild('work', "no");
                        $host->extmatrix->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->megaconz->work);
                        $host->megaconz->addChild('work', "no");
                        $host->megaconz->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->freakshare->work);
                        $host->freakshare->addChild('work', "no");
                        $host->freakshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->firedrive->work);
                        $host->firedrive->addChild('work', "no");
                        $host->firedrive->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->uploadable->work);
                        $host->uploadable->addChild('work', "no");
                        $host->uploadable->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->zippyshare->work);
                        $host->zippyshare->addChild('work', "no");
                        $host->zippyshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->keeptwoshare->work);
                        $host->keeptwoshare->addChild('work', "no");
                        $host->keeptwoshare->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->megashares->work);
                        $host->megashares->addChild('work', "no");
                        $host->megashares->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        $host = simplexml_load_file($config['hostlist']);
                        unset($host->youtube->work);
                        $host->youtube->addChild('work', "no");
                        $host->youtube->asXML($config['hostlist']);
                        $host->asXML($config['hostlist']);
                        
                        //Luu file + time
                        $log = fopen($user_file,"a",1);
							$data = $id_user.'|';
							fwrite($log, $data);
							fclose($log);
                        $mess = "[center][b] [color=red]" . $name . "[/color][br][color=green]Đã dừng get link[/color] [color=blue]tất cả các File Host[/color][/b][/center]";
                        post_cbox($mess);
                    }
                }
            }
        }
    }
}




?>