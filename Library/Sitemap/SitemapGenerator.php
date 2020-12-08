<?php
    error_reporting(0);
    function AptSitmapGenerator($Data = array()){
        foreach ($Data as $key => $value) {
            ${$key} = $value;
        }
        if($DomainName == null || $DomainName == ''){
            if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) {
                $HeaderSecureType = "https://";
            }else{
                $HeaderSecureType = "http://";
            }
            ${'DomainName'} = $HeaderSecureType.$_SERVER['HTTP_HOST'];
        }

        if(gettype($Ignore) != 'array'){
            $Ignore = array('../../Dashboard','../../Library','../../Category/index.php','../../img','../../Pages/index.php');
        }
        if(gettype($Allow) != 'array'){
            $Allow = array('Article','Category','Pages','Category','../../index.php','../../favicon.ico');
        }
        
        $Result = AptSitmapGeneratorGetTypeInFolder(['dir'=>"../../",'Ignore'=>$Ignore,'Allow'=>$Allow])['msg'];
        $string = '';
        foreach ($Result as $key => $value) {
            $string .= "<url>\n" .
            "    <loc>" . htmlentities($value['url']) ."</loc>\n" .
            "    <lastmod>".$value['mod']."</lastmod>\n" .
            "    <changefreq>".$value['changefreq']."</changefreq>\n" .
            "    <priority>".$value['priority']."</priority>\n" .
            " </url>\n";
        }
        $SitemapFile = fopen ('../../Library/Sitemap/TmpSitemap.xml', "w");
        if (!$SitemapFile) {
            return ["status"=>"Error","msg"=>"Sitemap can not created [AptGetTypeInFolder]",'code'=>400];
        }
        $text =  "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" .
                 "<?xml-stylesheet type=\"text/xsl\" href=\"../../../../Library/Sitemap/sitemap.xsl\"?>\n" .
                 "<!-- Created with Topicster XML Sitemap Generator " . VERSION . " http://iprodev.com -->\n" .
                 "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"\n" .
                 "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n" .
                 "xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9\n" .
                 "http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n" .
                 "$string".
                 "</urlset>";

        if(!fwrite($SitemapFile, $text)){
            fclose($SitemapFile);
            return ["status"=>"Error","msg"=>"Sitemap can not created [AptGetTypeInFolder]",'code'=>400];
        }else{
            fclose($SitemapFile);
            if(rename("../../Library/Sitemap/sitemap.xml","../../Library/Sitemap/OldSitemap.xml") || !file_exists("../../Library/Sitemap/sitemap.xml")){
                if(rename("../../Library/Sitemap/TmpSitemap.xml","../../Library/Sitemap/sitemap.xml")){
                    if(unlink("../../Library/Sitemap/OldSitemap.xml") || !file_exists("../../Library/Sitemap/OldSitemap.xml")){
                        return ["status"=>"Error","msg"=>"Sitemap created successfully [AptGetTypeInFolder]",'code'=>200];
                    }else{
                        unlink("../../Library/Sitemap/OldSitemap.xml");
                    }
                }else{
                    rename("../../Library/Sitemap/OldSitemap.xml","../../Library/Sitemap/sitemap.xml");
                    unlink("../../Library/Sitemap/TmpSitemap.xml");
                }
            }else{
                unlink("../../Library/Sitemap/OldSitemap.xml");
            }
            return ["status"=>"Error","msg"=>"Sitemap can not created [rename] [AptGetTypeInFolder]",'code'=>400];
        }
    }
    function AptSitmapGeneratorGetTypeInFolder($Data){
        if(gettype($Data) != 'array'){
            return ["status"=>"Error","msg"=>"Invalid Data format detect [AptGetTypeInFolder]",'code'=>400];
        }
        foreach ($Data as $key => $value) {
            ${$key} = $value;
        }

        if(!is_dir($dir)){
            return ["status"=>"Error","msg"=>"Invalid Data format detect [AptGetTypeInFolder]",'code'=>400];
        }
        if(gettype($Ignore) != 'array'){
            $Ignore = array();
        }
        if(gettype($Allow) != 'array'){
            $Allow = array('*');
        }

        $FileStore = array();
        $temp = array();
        $files = scandir($dir);
        $Dir = trim($dir,'/').'/';
        
        // Deleting all the files in the list 
        foreach($files as $file) {
            if($file != '.' && $file != '..'){
                if(is_file($Dir.$file)){
                    $IsValid = 1;
                    foreach ($Ignore as $key => $value) {
                        if(strpos($Dir.$file, $value) !== false){
                            $IsValid = 0;
                        }
                    }
                    if($IsValid == 1){
                        foreach ($Allow as $key => $value) {
                            if(strpos($Dir.$file, $value) !== false || $value == '*'){
                                $IsValid = 1;
                                break;
                            }else{
                                $IsValid = 0;
                            }
                        }
                        if(stripos($Dir.$file, 'article') !== false and stripos($Dir.$file, 'index.php') !== false){
                             $IsValid = 0;
                        }
                    }
                    if($IsValid == 1){
                        if($Dir.$file == '../../index.php'){
                            $priority = '1.0';
                            $changefreq = 'always';
                        }else if(strpos($Dir.$file, '/Category/')){
                            $priority = '0.7';
                            $changefreq = 'daily';
                        }else if(strpos($Dir.$file, '/Article/')){
                            $priority = '0.8';
                            $changefreq = 'hourly';
                        }else{
                            $priority = '0.8';
                            $changefreq = 'daily';
                        }
                    }
                    if($IsValid == 1){
                        $FilePath = str_replace('../../', 'http://topicster.live/', $Dir.$file);
                        $FileMod = time();
                        array_push($FileStore, ['url'=>$FilePath,'priority'=>$priority,'changefreq'=>$changefreq,'mod'=>gmdate(DATE_W3C, mktime(date("H",$FileMod) , date("i",$FileMod), date("s",$FileMod), date("m",$FileMod), date("d",$FileMod), date("Y",$FileMod)))]);
                    }
                }else if(is_dir($Dir.$file)){
                    $IsValid = 1;
                    foreach ($Ignore as $key => $value) {
                        if(strpos($Dir.$file, $value) !== false){
                            $IsValid = 0;
                        }
                    }

                    if($IsValid == 1){
                        $Result = AptSitmapGeneratorGetTypeInFolder(['dir'=>$Dir.$file.'/','Ignore'=>$Ignore,'Allow'=>$Allow])['msg'];
                        foreach ($Result as $key => $value) {
                            array_push($FileStore, $value);
                        }
                    }
                }
            }
        }
        return ["status"=>"Success","msg"=>$FileStore,'code'=>200];
    }
    echo AptSitmapGenerator()['msg'];
?>