<?php
    error_reporting(0);
	if(!defined('RootPath')){
		define('RootPath','../../../../');
	}

	if($FileAccessCode != 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl' && FileAccessCode != 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl'){
		if(!defined('DomainName')){
			if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) {
				$HeaderSecureType = "https://";
			}else{
				$HeaderSecureType = "http://";
			}
			define("DomainName",  $HeaderSecureType.$_SERVER['HTTP_HOST']);
		}
		header("Location:".DomainName); exit();
    }
    
    require_once (RootPath.'Library/Php/Script/GoogleTranslater/vendor/autoload.php');
    use Stichoza\GoogleTranslate\GoogleTranslate;

    function GoogleTranslate($Data = array()){
        $Source = null; $Target = 'en';
        foreach($Data as $key => $value){
            ${$key} = $value;
        }
        if(!isset($Target) || $Target == '' || !isset($String) || $String == ''){
            return ['status'=>'Error','msg'=>'Invalid data format detect [GoogleTranslate]','code'=>400];
        }
        if(strpos($String, '&') !== false){
            $String = str_replace('&','<&>',$String);
        }
        if(strpos($String, '#') !== false){
            $String = str_replace('#','<#>',$String);
        }

        $GoogleTranslateObj = new GoogleTranslate(); // Translates into English
        $Result = unserialize($GoogleTranslateObj->setSource($Source)->setTarget($Target)->translate($String));
        if($Result['code'] == 400){
            if($Result['ecode'] == 408){
                 return ['status'=>'Error','msg'=>$Result['msg'].' [GoogleTranslate]','code'=>400,'ecode'=>$Result['ecode']];
            }
            return ['status'=>'Error','msg'=>$Result['msg'].' [GoogleTranslate]','code'=>400];
        }else if($Result['code'] == 404){
            if(strpos($Result['translate'], '<&>') !== false){
                $Result['mstranslateg'] = str_replace('<&>','&',$Result['translate']);
            }
            if(strpos($Result['translate'], '<#>') !== false){
                $Result['translate'] = str_replace('<#>','#',$Result['translate']);
            }
            return ['status'=>'Error','msg'=>$Result['translate'],'dslang'=> $Result['dslang'],'reason'=>$Result['msg'].' [GoogleTranslate]','code'=>404];
        }else{
            if(strpos($Result['translate'], '<&>') !== false){
                $Result['translate'] = str_replace('<&>','&',$Result['translate']);
            }
            if(strpos($Result['translate'], '<#>') !== false){
                $Result['translate'] = str_replace('<#>','#',$Result['translate']);
            }
            return ['status'=>'Success','msg'=>$Result['translate'],'dslang'=> $Result['dslang'],'code'=>200];
        }
    }
?>