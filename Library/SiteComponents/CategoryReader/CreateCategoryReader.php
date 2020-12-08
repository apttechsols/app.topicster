<?php
	error_reporting(0);
	if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
		$HeaderSecureType = 'https://';
	}else{
		$HeaderSecureType = 'http://';
	}
	define('DomainName',  $HeaderSecureType.$_SERVER['HTTP_HOST']);
	header("Location: " . DomainName."/Library/SiteComponents/PageNotFound/index.php");
	die();	
	exit();
	define('RootPath',  '../../../');
	define('DatabaseAccessCode', 'T@6Ug5t_u56t*P_B&B@Kl7U_v8N_xN7b_Z&B@Kl75t_u56@6Ug5t_u56t*P_B&Ap');
	define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
	$EPass ='T@K2YeD*4s_4q-F5m&R6@Wp7Wu2Xw#_-qJ8c^?#h6v_hW-3uY3q%h&4N#hV8k@Ca';
	require_once (RootPath."Library/Apt/Php/AptPrint/index.php");
	require_once (RootPath."Library/Apt/Php/Script/AptPhpScriptDirDelete/index.php");
	$DefinedSubCategory = ['Entertainment'=>['Music','TV Show','TV series','Movie','celebs&gossip','Celebs Fashion'],'Sports'=>['Cricket','Wrestling','Hockey','Football','Badminton','Table Tennis','Car race','Basketball','Boxing','Tennis'],'Society'=>['Crime','Environment','Livelihood','Custom'],'Politics'=>['Election','Political parties','Politics government','Law','Military'],'Lifestyle'=>['Health','Travel','Food','Fashion','Relationship','Beauty & Male Grooming','Myth'],'Tech'=>['Phone','Games','Software','Cutting edge technologies','Digital product','Communications industry','Internet service'],'Auto'=>['Car','Motocycle','Software','Cutting edge technologies','Digital product','Communications industry','Internet service'],'Education'=>['CBSE','RBSE','BTECH','MBA','JEE','Other'],'Religion'=>['Festivals','Religious places','Religions in india','Pilgrimage trips'],'Economics'=>['Advertising','Marketing','Stock','Budget','Infrastructure','Insurance','Agriculture','Telecom','Energy','Manufacturing','Industry','Tax','Retail','Company','Commodity','Real estate'],'Jobs'=>['PSU','Defence','UPSC','SSC','Railway job','Bank job','Government job']];

	foreach ($DefinedSubCategory as $key => $value) {
		CreateCategoryReader($DefinedSubCategory,$key,null);
	}

	function CreateCategoryReader($Category,$catName,$ParentCat=null){
		if(is_array($Category)){
			if(is_array($Category) and array_key_exists($catName, $Category)){
				if(is_array($Category[$catName]) and is_numeric(array_key_first($Category[$catName]))){
					if($ParentCat != ''){
						$ParentCat = $ParentCat.'>'.$catName;
					}else{
						$ParentCat = $catName;
					}
					foreach ($Category[$catName] as $key => $value) {
						if(is_array($value)){
							CreateCategoryReader($Category[$catName],$value,$ParentCat);
						}else{
							CreateCategory($ParentCat.'>'.$value);
						}
					}
				}else if(is_array($Category[$catName])){
					if($ParentCat != ''){
						$ParentCat = $ParentCat.'>'.$catName;
					}else{
						$ParentCat = $catName;
					}
					foreach ($Category[$catName] as $key => $value) {
						if(is_array($value)){
							CreateCategoryReader($Category[$catName],$key,$ParentCat);
						}else{
							CreateCategory($ParentCat.'>'.$value);
						}
					}
				}else{
					if($ParentCat != ''){
						CreateCategory( $ParentCat.'>'.$Category[$catName]);
					}else{
						CreateCategory($Category[$catName]);
					}
				}
			}else if(is_array($Category) and in_array($catName, $Category)){
				if(is_array($Category) and is_numeric(array_key_first($Category))){
					if($ParentCat != ''){
						$ParentCat = $ParentCat.'>'.$catName;
					}else{
						$ParentCat = $catName;
					}
					foreach ($Category as $key => $value) {
						if(is_array($value)){
							CreateCategoryReader($value,$value,$ParentCat);
						}else{
							CreateCategory($ParentCat.'>'.$value);
						}
					}
				}else if(is_array($Category[$catName])){
					if($ParentCat != ''){
						$ParentCat = $ParentCat.'>'.$catName;
					}else{
						$ParentCat = $catName;
					}
					foreach ($Category[$catName] as $key => $value) {
						if(is_array($value)){
							CreateCategoryReader($value,$key,$ParentCat);
						}else{
							CreateCategory($ParentCat.'>'.$value);
						}
					}
				}else{
					if($ParentCat != ''){
						CreateCategory($ParentCat.'>'.$catName);
					}else{
						CreateCategory($catName);
					}
				}
			}else{
				if($ParentCat != ''){
					CreateCategory($ParentCat.'>'.$Category);
				}else{
					CreateCategory($Category);
				}
			}
		}
	}

	function CreateCategory($Dir){
		$LastDir='';
		$TempCategory = '';
		$TempDir = explode('>', $Dir);
		foreach ($TempDir as $key => $value) {
			if(!is_dir(RootPath.'/Category/'.$LastDir.$value)){
				if(!mkdir(RootPath.'/Category/'.$LastDir.$value)){
					foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
					AptPrint(['msg'=>'Dir can not created [CreateCategory]','status'=>'Error']); exit();
				}
			}
			$LastDir .= $value.'/';
			if($TempCategory != ''){
				$TempCategory .= '>'.$value;
			}else{
				$TempCategory = $value;
			}
			$TempRootPath = '../';
			$i=0;
			while($i<=$key){
				$TempRootPath .= '../';
				$i++;
			}
			if(!file_exists(RootPath.'/Category/'.$LastDir.'index.php')){
				if(!($File = fopen(RootPath.'/Category/'.$LastDir.'index.php', "w"))){
					foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
					AptPrint(['msg'=>'File can not created [CreateCategory]','status'=>'Error']); exit();
				}
				
				$text = '<?php error_reporting(0); if ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") || $_SERVER["SERVER_PORT"] == 443) { $HeaderSecureType = "https://"; }else{ $HeaderSecureType = "http://"; } define("DomainName",  $HeaderSecureType.$_SERVER["HTTP_HOST"]); define("RootPath",  "'.$TempRootPath.'"); define("Category","'.$TempCategory.'"); require_once(RootPath."Library/SiteComponents/CategoryReader/index.php"); ?>';
				
				if(!fwrite($File, $text)){
					foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
					AptPrint(['msg'=>'File can not created [CreateCategory]','status'=>'Error']); exit();
				}
				fclose($File);
			}
		}
	}
?>