<?php
require "vendor/autoload.php";
require "inc/config.php";


class hit
{
	
	
	
	
    function gethost($sever, $so){
		global $config;
		$obj = new hit();
		//$sever = str_replace("_",".",$sever);
		$host = $obj->load_json($config['filehost']);
		if (!empty($so))
		{
			$host = $host[$sever]['sv'][$so];
			list($host, $pass) = explode('|', $host);
			$host = array(
		"sv" => $host,
		"pass" => $pass
		
		);
		
		return $host;
		}
		
		elseif (count($host[$sever]['sv']) > 0)
		{ 
		$host = $host[$sever]['sv'][rand(0, count($host[$sever]['sv']) - 1) ];
		list($host, $pass) = explode('|', $host);
		$host = array(
		"sv" => $host,
		"pass" => $pass
		
		);
		
		return $host;
		}
		else return true;
		
	}
    
    function getlink($host, $pass, $link)
    {
        $curl = new Curl\Curl();
        $curl->setOpt(CURLOPT_RETURNTRANSFER, TRUE);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, FALSE);
        $curl->setOpt(CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.12) Gecko/20101026 Firefox/3.6.12');
        $curl->setCookie('secureid', $pass);
        $curl->post($host, array(
            'secureid' => $pass,
            'urllist' => $link
        ));
        if ($curl->error) {
            return $curl->error_code;
        } else {
            return $curl->response;
        }
		$curl->close();
    }
function getcboxchat($url)
{
	
	$curl = new Curl\Curl();
$curl->setBasicAuthentication('username', 'password');
$curl->setUserAgent('Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.12) Gecko/20101026 Firefox/3.6.12');
$curl->setReferrer($url);
$curl->setOpt(CURLOPT_SSL_VERIFYPEER, FALSE);
$curl->setHeader('X-Requested-With', 'XMLHttpRequest');
$curl->setCookie('key', 'value');
$curl->get($url);

if ($curl->error) {
    return $curl->error_code;
}
else {
    return $curl->response;
}
$curl->close();
}
    function load_json($file)
    {
        $hash              = substr($file, 1);
        $json[$hash] = @file_get_contents($file);
        $data              = @json_decode($json[$hash], true);
        if (!is_array($data)) {
            $data              = array();
            $json[$hash] = 'default';
        }
        return $data;
    }
    function save_json($file, $data)
    {
        $tmp  = json_encode($data);
        $hash = substr($file, 1);
        if ($tmp !== $this->json[$hash]) {
            $this->json[$hash] = $tmp;
            $fh = fopen($this->fileinfo_dir . $file, 'w') or die('<CENTER><font color=red size=3>Could not open file ! Try to chmod the folder "<B>' . $this->fileinfo_dir . '</B>" to 777</font></CENTER>');
            fwrite($fh, $this->json[$hash]) or die('<CENTER><font color=red size=3>Could not write file ! Try to chmod the folder "<B>' . $this->fileinfo_dir . '</B>" to 777</font></CENTER>');
            fclose($fh);
            @chmod($this->fileinfo_dir . $file, 0666);
            return true;
        }
    }
    
    
    
    
}
class check extends hit
{
    function Check_SuperAdmin($superadmin, $name)
    {
        for ($i = 0; $i < count($superadmin); $i++) {
            if ($name == $superadmin->name[$i])
                return true;
        }
        return false;
    }
    
    function Check_Admin($adminlist, $name)
    {
        for ($i = 0; $i < count($adminlist); $i++) {
            if ($name == $adminlist->name[$i])
                return true;
        }
        return false;
    }
    
    function Check_Manager($manager, $name)
    {
        for ($i = 0; $i < count($manager); $i++) {
            if ($name == $manager->name[$i])
                return true;
        }
        return false;
    }
    
    function List_Vip()
    {
        $ch = curl_init();
        //	curl_setopt($ch, CURLOPT_URL, "http://191.233.40.227/vip.php");
        curl_setopt($ch, CURLOPT_URL, "http://vnz-leech.com/vip/group.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $b = curl_exec($ch);
        //	$data = curl_exec($ch);
        curl_close($ch);
        preg_match_all('/\[(|(.*?))];/', $b, $matches);
        //	preg_match('/var\s*?gvip1\s*?=(.*?);/i', $data, $list_vip);
        //	$vip = str_replace('"','',strtolower($list_vip[1]));
        $vip  = str_replace('"', '', strtolower($matches[1][3]));
        $nick = explode(',', $vip);
        return $nick;
    }
    
    function Check_Vip($viplist, $name)
    {
        for ($i = 0; $i < count($viplist); $i++) {
            if (strtolower($name) == $viplist[$i])
                return true;
            //	if (stristr($viplist,$name)) 
            
        }
        return false;
    }
    
    function Check_Vip2($viplist2, $name)
    {
        for ($i = 0; $i < count($viplist2); $i++) {
            if (strtolower($name) == $viplist2->name[$i])
                return true;
            
        }
        return false;
    }
    
    function Save_List_Vip()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://vnz-leech.com/vip/group.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $b = curl_exec($ch);
        curl_close($ch);
        preg_match_all('/\[(|(.*?))];/', $b, $matches);
        //	$vip = str_replace('"','',$matches[2][3]);
        $vip     = str_replace('"', '', strtolower($matches[2][3]));
        $nick    = explode(',', $vip);
        $viplist = simplexml_load_file('xml/vip.xml');
        if ($viplist->name)
            unset($viplist->name);
        for ($i = 0; $i < count($nick); $i++)
            $viplist->addChild('name', $nick[$i]);
        $viplist->asXML('xml/vip.xml');
    }
    
    function Check_Bot($bots, $name)
    {
        for ($i = 0; $i < count($bots); $i++) {
            if ($name == $bots->name[$i])
                return true;
        }
        return false;
    }
    
    function Check_BlackList($blacklist, $name)
    {
        for ($i = 0; $i < count($blacklist); $i++) {
            if ($name == $blacklist->name[$i])
                return true;
        }
        return false;
    }
    
}



?>