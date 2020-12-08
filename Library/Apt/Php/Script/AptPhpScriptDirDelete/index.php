<?php
    /*

    *@filename AptPhpScriptDirDelete/index.php
    *@des ---
    *@Author Arpit sharma
    */

    // Not show any error
    error_reporting(0);
    // Get server port type (exampale - http:// or https://)
    if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
        $HeaderSecureType = "https://";
    }else{
        $HeaderSecureType = "http://";
    }
    // Create Domain name and save it in const variable
    define("DomainName",  $HeaderSecureType.$_SERVER['HTTP_HOST']);

   if($FileAccessCode != 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl' && FileAccessCode != 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl'){
        header("Location: " . RootPath . "Library/SiteComponents/PageNotFound/index.php"); die();
        exit();
    }

    function AptPhpScriptDirDeleteInside($Data = array()){
        foreach ($Data as $key => $value) {
            ${$key} = $value;
        }
        
        if(!isset($Dir) || $Dir == ''){
            return ["status"=>"Error","msg"=>"Invalid Data format detect [Apt Php Script Dir Delete]"]; exit();
        }

        if (!is_dir($Dir)) {
            return ["status"=>"Error","msg"=>"$Dir is not foud [Apt Php Script Dir Delete]","code"=>400]; exit();
        }
        if (is_dir($Dir)) {
            $objects = scandir($Dir);
            foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (filetype($Dir."/".$object) == "dir") 
                AptPhpScriptDirDeleteInside(['Dir'=>$Dir."/".$object]); 
                else unlink   ($Dir."/".$object);
            }
            }
            reset($objects);
            rmdir($Dir);
        }
    }

    function AptPhpScriptDirDelete($Data = array()){
        foreach ($Data as $key => $value) {
            ${$key} = $value;
        }
        
        if(!isset($Dir) || $Dir == ''){
            return ["status"=>"Error","msg"=>"Invalid Data format detect [Apt Php Script Dir Delete]"]; exit();
        }

        if (!is_dir($Dir)) {
            return ["status"=>"Error","msg"=>"$Dir is not foud [Apt Php Script Dir Delete]","code"=>400]; exit();
        }
        if (is_dir($Dir)) {
            $objects = scandir($Dir);
            foreach ($objects as $object) {
              if ($object != "." && $object != "..") {
                if (filetype($Dir."/".$object) == "dir") 
                AptPhpScriptDirDeleteInside(['Dir'=>$Dir."/".$object]); 
                else unlink   ($Dir."/".$object);
              }
            }
            reset($objects);
            rmdir($Dir);
        }
        return ["status"=>"Success","msg"=>"Given directory delete successfully","code"=>200];
    }
?>