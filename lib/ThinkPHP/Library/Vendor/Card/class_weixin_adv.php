<?php

/**
 * 微信SDK
 * pan041ymail@gmail.com
 */

class class_weixin_adv
{
    var $appid = "wx4ffb8db4b04b5bf7";
    var $appsecret = "df7305324d2a3550bf6f21b804cd95bb";
  //构造函数，获取Access Token
    public function __construct($appid = NULL, $appsecret = NULL){
        if($appid){
            $this->appid = $appid;
        }
        if($appsecret){
            $this->appsecret = $appsecret;
        }
  
        /*$data = json_decode(trim(substr(file_get_contents("access_token.php"), 15)),true);
        //var_dump($data['expire_time']);exit;
        if ($data['expire_time'] < time()) {
          //echo "2";exit;
          $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->appsecret;
          $res = $this->https_request($url);
          $result = json_decode($res, true);
          $content['access_token']=$result['access_token'];
          $content['expire_time']=7000+time();
          $content=json_encode($content);
          $fp = fopen("access_token.php", "w");
          fwrite($fp, "<?php exit();?>" . $content);
          fclose($fp);
        }else{
          $this->access_token=$data['access_token'];
        }*/
    }

//获取用户基本信息
    /*public function get_user_info($openid)
    {
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token='.$this->access_token.'&openid='.$openid.'&lang=zh_CN";
        $res = $this->https_request($url);
        return json_decode($res, true);
    }*/

//https请求
    public function https_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}