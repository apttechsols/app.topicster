<?php 
/*
*@FileName WriteArticle.php
*@Des ---
*@Author arpit sharma
*/

// Not show any error
error_reporting(0);
// Get server port type (exampale - http:// or https://)
if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) {
	$HeaderSecureType = "https://";
}else{
	$HeaderSecureType = "http://";
}
// Create Domain name and save it in const variable
define("DomainName",  $HeaderSecureType.$_SERVER['HTTP_HOST']);
define("RootPath", "../../../");
define('PredifinePartnerMediaFilePath', RootPath.'PartnerMedia/');
define('PredifinePartnerArticleFilePath', RootPath.'Article/');
define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
require(RootPath."Library/SiteComponents/BackEndControlPage/index.php");
require(RootPath."Library/SiteComponents/FrontAndBackEndControlPage/index.php");
/******************************  Php Library *******************************/
require_once (RootPath."Library/Php/Script/GoogleTranslater/index.php");

// Get all requested data
if(isset($_POST['EArticleTitle']) && isset($_POST['EArticleDescription']) && isset($_POST['ArticleTitle']) && isset($_POST['ArticleDescription']) && isset($_POST['Category']) && isset($_POST['SubCategory']) && isset($_POST['Keyword1']) && isset($_POST['Keyword2']) && isset($_POST['Keyword3']) && isset($_POST['Keyword4']) && isset($_POST['Keyword5']) && isset($_POST['Token_CSRF']) && isset($_POST['BrowserClientId1']) && isset($_POST['BrowserClientId2'])){

	// Verify data send from same page or not
	if($_SERVER['HTTP_REFERER'] === DomainName ."/Dashboard/Partner/WriteArticle/ckeditor/index.php"){
		session_start();
		if($_POST['Token_CSRF'] === $_SESSION['Token_CSRF']){
			class WriteArticle{
				/*
				*@Method name - ValidateData
				*@Des - ValidateData all input data
				*/
				public static function ValidateData($ValidateDataArray = array()){
					require_once (RootPath."Library/Apt/Php/Script/AptUtf8EncodeAndDecode/index.php");
					define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
					require_once (RootPath."Library/Apt/Php/Script/AptSafeText/index.php");

					foreach ($ValidateDataArray as $key => $value) {
						if($key != 'ArticleTitle' && $key != 'ArticleDescription' && $key != 'EArticleTitle' && $key != 'EArticleDescription' && $key != 'Category' && $key != 'SubCategory' && $key != 'Keyword1' && $key != 'Keyword2' && $key != 'Keyword3' && $key != 'Keyword4' && $key != 'Keyword5' && $key != 'Token_CSRF' && $key != 'BrowserClientId1' && $key != 'BrowserClientId2'){
							unset($key);
						}else{
							if($key == 'Keyword1' or $key == 'Keyword2' or $key == 'Keyword3' or $key == 'Keyword4' or $key == 'Keyword5'){
								
								$result = AptSafeText(['Str'=>urldecode($value),'EWords'=>AptSafeTextDecodeEWordsAllEncode]);
						 		if($result['code'] != 200){
						 			foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
									AptPrint(['msg'=>'Keyword not processed [AptSafeText]']); exit();
						 		}
								${$key} = $result['msg'];
								continue;
							}else if($key == 'ArticleDescription' || $key == 'ArticleTitle'){
								${$key} = $value;
								continue;
							}else if($key == 'EArticleDescription' || $key == 'EArticleTitle'){
								$result = AptSafeText(['Str'=>urldecode($value),'EWords'=>AptSafeTextDecodeEWordsAllEncode]);
						 		if($result['code'] != 200){
						 			foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
									AptPrint(['msg'=>'Keyword not processed [AptSafeText]']); exit();
						 		}
								${$key} = $result['msg'];
								$result = AptSafeText(['Str'=>strip_tags(urldecode($value)),'EWords'=>AptSafeTextDecodeEWordsAllEncode]);
						 		if($result['code'] != 200){
						 			foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
									AptPrint(['msg'=>'Keyword not processed [AptSafeText]']); exit();
						 		}
								${'Strip'.$key} = $result['msg'];
								continue;
							}

							${$key} = preg_replace('!\s+!', ' ',strip_tags($value));
						}
					}
					function multiexplode ($delimiters,$string) {
						$ready = str_replace($delimiters, $delimiters[0], $string);
						$launch = explode($delimiters[0], $ready);
						return $launch;
					}
					
					if(strlen($BrowserClientId1) < 130 || strlen($BrowserClientId2) < 130){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Oops! we can not recognize client [System][0.1]']); exit();
					}else{

						$ExtBrowserClientId1 = str_replace($_SESSION['RandomPass2'], '', str_replace($_SESSION['RandomPass1'], '', $BrowserClientId1));						
						$ExtBrowserClientId2 = str_replace($_SESSION['RandomPass4'], '', str_replace($_SESSION['RandomPass3'], '', $BrowserClientId2));

						if(strlen($ExtBrowserClientId1) != 128 || strlen($ExtBrowserClientId2) != 128){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Oops! we can not recognize client [System][0.2]']); exit();
						}

						$BrowserClientId1 = hash_hmac("sha512",$ExtBrowserClientId1,'Tm2M@#Wv4rt!U2aO!5h^8rA4e+$wY2_aK!yQ'.$ExtBrowserClientId1);

						$BrowserClientId2 = hash_hmac("sha512",$ExtBrowserClientId2,'TpK_W94aPIy3fC6cuKoMt8_yC*E4x*!7eQ8L$re'.$ExtBrowserClientId2);
					}
					
					if(mb_strlen($ArticleTitle) < 10 or mb_strlen($ArticleTitle) > 150){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Article Title must be 10 to 150 characters long [WriteArticle]']); exit();
					}

					if(mb_strlen(strip_tags($ArticleDescription)) < 10 or mb_strlen(strip_tags($ArticleDescription)) > 100000){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Article Title must be 10 to 15000 characters long [WriteArticle]']); exit();
					}

					$DefinedCategory = ['Entertainment','Sports','Society','Politics','Offbeat','Humor','Lifestyle','Tech','Auto','Education','Inspirational','History','Science','Religion','Economics','Jobs'];

					if(in_array($Category, $DefinedCategory) != true){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Invalid Category detect [WriteArticle]']); exit();
					}

					$DefinedSubCategory = ['Entertainment'=>['Music','TV Show','TV series','Movie','celebs&gossip','Celebs Fashion'],'Sports'=>['Cricket','Wrestling','Hockey','Football','Badminton','Table Tennis','Car race','Basketball','Boxing','Tennis'],'Society'=>['Crime','Environment','Livelihood','Custom'],'Politics'=>['Election','Political parties','Politics government','Law','Military'],'Lifestyle'=>['Health','Travel','Food','Fashion','Relationship','Beauty & Male Grooming','Myth'],'Tech'=>['Phone','Games','Software','Cutting edge technologies','Digital product','Communications industry','Internet service'],'Auto'=>['Car','Motocycle','Software','Cutting edge technologies','Digital product','Communications industry','Internet service'],'Education'=>['CBSE','RBSE','BTECH','MBA','JEE','Other'],'Religion'=>['Festivals','Religious places','Religions in india','Pilgrimage trips'],'Economics'=>['Advertising','Marketing','Stock','Budget','Infrastructure','Insurance','Agriculture','Telecom','Energy','Manufacturing','Industry','Tax','Retail','Company','Commodity','Real estate'],'Jobs'=>['PSU','Defence','UPSC','SSC','Railway job','Bank job','Government job']];

					if($DefinedSubCategory[$Category] != $SubCategory and in_array($SubCategory, $DefinedSubCategory[$Category]) != true){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Invalid Sub Category detect [WriteArticle]']); exit();
					}

					$ModTitle =  GoogleTranslate(['Target'=>'en','String'=>$ArticleTitle]);
					if($ModTitle['code'] == 200 || $ModTitle['code'] == 404){
						$ModTitleSource = $ModTitle['dslang'];
						$ModTitle = $ModTitle['msg'];
					}else{
						if($ModTitle['ecode'] == 408){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Internet connection is not connected [WriteArticle]','status'=>'Error']); exit();
						}
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Title can not coverted due to technical error [WriteArticle]','status'=>'Error']); exit();
					}

					$StripEModTitle =  GoogleTranslate(['Target'=>'en','String'=>$StripEArticleTitle]);
					if($StripEModTitle['code'] == 200 || $StripEModTitle['code'] == 404){
						$StripEModTitleSource = $StripEModTitle['dslang'];
						$StripEModTitle = $StripEModTitle['msg'];
					}else{
						if($StripEModTitle['ecode'] == 408){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Internet connection is not connected [WriteArticle]','status'=>'Error']); exit();
						}
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Strip Title can not coverted due to technical error [WriteArticle]','status'=>'Error']); exit();
					}

					$IgnoreKeyword = [' ','&nbsp;','&nbsp','| ',' |','. ',' .',', ',' ,','\r\n'];
					$Result = AptSafeText(['Str'=>'|','EWords'=>['|']]);
					if($result['code'] != 200){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
					   AptPrint(['msg'=>'Ignore Keyword list not processed [AptSafeText]']); exit();
					}
					
					array_push($IgnoreKeyword,$Result['msg'].' ');
					array_push($IgnoreKeyword,' '.$Result['msg']);

					$Result = AptSafeText(['Str'=>'.','EWords'=>['.']]);
					if($result['code'] != 200){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
					   AptPrint(['msg'=>'Ignore Keyword list not processed [AptSafeText]']); exit();
					}
					array_push($IgnoreKeyword,$Result['msg'].' ');
					array_push($IgnoreKeyword,' '.$Result['msg']);

					$Result = AptSafeText(['Str'=>',','EWords'=>[',']]);
					if($result['code'] != 200){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
					   AptPrint(['msg'=>'Ignore Keyword list not processed [AptSafeText]']); exit();
					}
					array_push($IgnoreKeyword,$Result['msg'].' ');
					array_push($IgnoreKeyword,' '.$Result['msg']);

					$TmpKeyword = array();
					$Keywords = [$Keyword1,$Keyword2,$Keyword3,$Keyword4,$Keyword5];
					
					$keyword = '';
					$PKeyword = ', ';
					$i = 0;
					foreach ($Keywords as $value){
					 	if (mb_strlen($value) > 0 && !in_array($value, $TmpKeyword) && !in_array($value, $IgnoreKeyword)){
					 		if(strpos($value, ',') !== false){
					 			foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Comma [,] can not be used in Keyword [AptSafeText]']); exit();
					 		}
					 		$result = AptSafeText(['Str'=>$value,'EWords'=>AptSafeTextDecodeEWordsAllEncode]);
					 		if($result['code'] != 200){
					 			foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Keyword not process successfully [AptSafeText2]']); exit();
					 		}
						 	$keyword .= $result['msg'].', ';
							 array_push($TmpKeyword, $value);
						 	$i++;
						}
					}
					if($keyword != ''){
						$PKeyword = $keyword;
					}
					
					
					$words  = multiexplode($IgnoreKeyword,$EArticleTitle);
					$longestWord = array();
					foreach ($words as $word){
						if (mb_strlen($word) > 0) {
							array_push($longestWord,strtolower($word));
						}
					}
					
					array_multisort(array_map('strlen', $longestWord), $longestWord);
					$longestWord = array_reverse($longestWord);
					foreach($longestWord as $key => $value){
						if(mb_strlen($value) >= 4 && !in_array($value, $TmpKeyword) && !in_array($value, $IgnoreKeyword)){
							$i += 1;
							$keyword .= $value.', ';
							array_push($TmpKeyword, $value);
						}
						if($i >= 7){
							break;
						}
					}

					$str=str_replace(array("\n", "\r"), '', $StripEArticleDescription);
					$words  = multiexplode($IgnoreKeyword,$str);
					$longestWord = array();
					foreach ($words as $word){
						if (mb_strlen($word) > 0) {
							array_push($longestWord,strtolower($word));
						}
					}
					array_multisort(array_map('strlen', $longestWord), $longestWord);
					$longestWord = array_reverse($longestWord);
					foreach($longestWord as $key => $value){
						if(mb_strlen($value) >= 4 && !in_array($value, $TmpKeyword) && !in_array($value, $IgnoreKeyword)){
							$i += 1;
							$keyword .= $value.', ';
							array_push($TmpKeyword, $value);
						}
						if($i >= 10){
							break;
						}
					}

					if($ModTitleSource != 'en'){
						if($i < 8){
							$i = 0;
							$str=str_replace(array("\n", "\r"), '', $StripEModTitle);
							$words  = multiexplode($IgnoreKeyword,$str);
							$longestWord = array();
							foreach ($words as $word){
								if (mb_strlen($word) > 0) {
									array_push($longestWord,strtolower($word));
								}
							}
							array_multisort(array_map('strlen', $longestWord), $longestWord);
							$longestWord = array_reverse($longestWord);
							foreach($longestWord as $key => $value){
								if(mb_strlen($value) >= 4 && !in_array($value, $TmpKeyword) && !in_array($value, $IgnoreKeyword)){
									$i += 1;
									$keyword .= $value.', ';
									array_push($TmpKeyword, $value);
								}
								if($i >= 2){
									break;
								}
							}
						}else{
							$TmpI = 0;
							$str=str_replace(array("\n", "\r"), '', $StripEModTitle);
							$words  = multiexplode($IgnoreKeyword,$str);
							$longestWord = array();
							foreach ($words as $word){
								if (mb_strlen($word) > 0) {
									array_push($longestWord,strtolower($word));
								}
							}
							array_multisort(array_map('strlen', $longestWord), $longestWord);
							$longestWord = array_reverse($longestWord);
							foreach($longestWord as $key => $value){
								if(mb_strlen($value) >= 4 && !in_array($value, $TmpKeyword) && !in_array($value, $IgnoreKeyword)){
									$TmpI += 1;
									$keyword .= $value.', ';
									array_push($TmpKeyword, $value);
								}
								if($TmpI >= 2){
									break;
								}
							}
						}
					}
					
					if($i < 10){
						$i += 1;
						$keyword .= $Category.', ';
					}
					if($i < 10 and $SubCategory != ''){
						$i += 1;
						$keyword .= $SubCategory.', ';
					}

					if($keyword != ''){
						$keyword = ', '.$keyword;
					}
					$keyword = preg_replace('!\s+!',' ',$keyword);

					WriteArticle::EncryptData($ArticleTitle,$ModTitle,$ArticleDescription,$EArticleTitle,$EArticleDescription,$StripEArticleDescription,$Category,$SubCategory,$keyword,$PKeyword,$BrowserClientId1,$BrowserClientId2);
				}
				private static function EncryptData($ArticleTitle,$ModTitle,$ArticleDescription,$EArticleTitle,$EArticleDescription,$StripEArticleDescription,$Category,$SubCategory,$keyword,$PKeyword,$BrowserClientId1,$BrowserClientId2){

					$EPass ='T@K2YeD*4s_4q-F5m&R6@Wp7Wu2Xw#_-qJ8c^?#h6v_hW-3uY3q%h&4N#hV8k@Ca';

					WriteArticle::CkeckLoginAndAuthenticate($ArticleTitle,$ModTitle,$ArticleDescription,$EArticleTitle,$EArticleDescription,$StripEArticleDescription,$Category,$SubCategory,$keyword,$PKeyword,$BrowserClientId1,$BrowserClientId2,$EPass);
				}

				private static function CkeckLoginAndAuthenticate($ArticleTitle,$ModTitle,$ArticleDescription,$EArticleTitle,$EArticleDescription,$StripEArticleDescription,$Category,$SubCategory,$keyword,$PKeyword,$BrowserClientId1,$BrowserClientId2,$EPass){

					/************************************* File Access Code ***********************************/
					define('DatabaseAccessCode', 'T@6Ug5t_u56t*P_B&B@Kl7U_v8N_xN7b_Z&B@Kl75t_u56@6Ug5t_u56t*P_B&Ap');
					define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
					
					/****************************** Database Connections *******************************/

					// DbCon -> ($PdoTopicsterMain)
					require_once (RootPath."Library/Database/SQL/Pdo/topicster_main.php");

					// DbCon -> ($PdoTopicsterPartner)
					require_once (RootPath."Library/Database/SQL/Pdo/topicster_partner.php");

					// DbCon -> ($PdoTopicsterUserActivity)
					require_once (RootPath."Library/Database/SQL/Pdo/topicster_user_activity.php");

					// DbCon -> ($PdoTopicsterPostData)
					require_once (RootPath."Library/Database/SQL/Pdo/topicster_post_data.php");


					/******************************  Apt Library *******************************/
					require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoInsertWithAes/index.php");
					require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoFetchWithAes/index.php");
					require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoUpdateWithAes/index.php");
					require_once (RootPath."Library/Apt/Php/Script/AptPhpScriptDirDelete/index.php");
					require_once (RootPath."Library/Apt/Php/Script/EncodeAndEncrypt/AptEncodeAndEncryptWithAes.php");
					require_once (RootPath."Library/SiteComponents/IsLogin/index.php");
					
					# Is User WriteArticle
					$IsLogin = IsLogin(['PdoTopicsterMain'=>$PdoTopicsterMain,'PdoTopicsterPartner'=>$PdoTopicsterPartner,'EPass'=>$EPass,'CheckType'=>'ClientAndServer','LClientId1'=>$BrowserClientId1,'LClientId2'=>$BrowserClientId2]);
					if($IsLogin['code'] != 200){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Client not logined [WriteArticle]','status'=>'Error']); exit();
					}else if($IsLogin['LAS'] != 'Partner'){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'You are not authenticat for write Article [WriteArticle]','status'=>'Error']); exit();
					} 

					WriteArticle::DoWriteArticle($ArticleTitle,$ModTitle,$ArticleDescription,$EArticleTitle,$EArticleDescription,$StripEArticleDescription,$Category,$SubCategory,$keyword,$PKeyword,$EPass,$PdoTopicsterMain,$PdoTopicsterPartner,$PdoTopicsterUserActivity,$PdoTopicsterPostData,$IsLogin);
				}

				private static function DoWriteArticle($ArticleTitle,$ModTitle,$ArticleDescription,$EArticleTitle,$EArticleDescription,$StripEArticleDescription,$Category,$SubCategory,$keyword,$PKeyword,$EPass,$PdoTopicsterMain,$PdoTopicsterPartner,$PdoTopicsterUserActivity,$PdoTopicsterPostData,$IsLogin){
					date_default_timezone_set('Asia/Kolkata');
					$CurrentTime = time();

					function rand_string( $length ) {  
						$RandStr = "";
						//$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
						$chars = "abcdefghijklmnopqrstuvwxyz0123456789abcdefghijklmnopqrstuvwxyz";
						$size = strlen( $chars ); 
						for( $i = 0; $i < $length; $i++ ) {  
						$RandStr = $RandStr . "" . $chars[ rand( 0, $size - 1 ) ];   
						} 
						return $RandStr;
					}

					$Number1 = floor((14 - mb_strlen($CurrentTime))/2);
					$Number2 = (14 - mb_strlen($CurrentTime)) - $Number1;

					$i = 1;
					while(true){
						$ArticleId = "t".rand_string($Number1).$CurrentTime.rand_string($Number2);
						$ValidArticleId = AptPdoFetchWithAes(['Condtion'=> "Url::::$ArticleId", 'DbCon'=> $PdoTopicsterPostData, 'TbName'=> 'post', 'EPass'=> $EPass]);
						if($ValidArticleId['code'] == 404){
							break;
						}else if($i > 5){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Url can not create! Try again [WriteArticle]','status'=>'Error']); exit();
						}
						$i++;
					}

					
					$ArticleUrl = "T=".urlencode($ModTitle)."&P=".$IsLogin['LMAN']."&url=$ArticleId";

					if (!file_exists(PredifinePartnerMediaFilePath)){
						if(!mkdir(PredifinePartnerMediaFilePath)){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Media file can not created [WriteArticle]','status'=>'Error']); exit();
						}
					}
					if (!file_exists(PredifinePartnerMediaFilePath.'index.php')){
						$MediaDir = fopen(PredifinePartnerMediaFilePath.'index.php', "w");
						if(!$MediaDir){
							$files = scandir(PredifinePartnerMediaFilePath);
							$CanDelDir = true;
							foreach($files as $file) {
								if($file != '.' && $file != '..' && $file != 'index.php'){
									$CanDelDir = false;
									break;
								}
							}
							if($CanDelDir == true){
								AptPhpScriptDirDelete(['Dir'=>PredifinePartnerMediaFilePath]);
							}
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Media file can not created [WriteArticle]','status'=>'Error']); exit();
						}
						$text = '<?php error_reporting(0); if ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") || $_SERVER["SERVER_PORT"] == 443) { $HeaderSecureType = "https://"; }else{ $HeaderSecureType = "http://"; } define("DomainName",  $HeaderSecureType.$_SERVER["HTTP_HOST"]); header("Location: " . DomainName); die(); ?>';
    
						if(!fwrite($MediaDir, $text)){
							unlink(PredifinePartnerMediaFilePath.'index.php');
							$files = scandir(PredifinePartnerMediaFilePath);
							$CanDelDir = true;
							foreach($files as $file) {
								if($file != '.' && $file != '..' && $file != 'index.php'){
									$CanDelDir = false;
									break;
								}
							}
							if($CanDelDir == true){
								AptPhpScriptDirDelete(['Dir'=>PredifinePartnerMediaFilePath]);
							}
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Media file can not created [WriteArticle]','status'=>'Error']); exit();
						}
						fclose($MediaDir);
					}
					if (!file_exists(PredifinePartnerMediaFilePath.$IsLogin['LMAN'])){
						if(!mkdir(PredifinePartnerMediaFilePath.$IsLogin['LMAN'])){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Media file can not created [WriteArticle]','status'=>'Error']); exit();
						}
					}
					if (!file_exists(PredifinePartnerMediaFilePath.$IsLogin['LMAN'].'/index.php')){
						$MediaDir = fopen(PredifinePartnerMediaFilePath.$IsLogin['LMAN'].'/index.php', "w");
						if(!$MediaDir){
							$files = scandir(PredifinePartnerMediaFilePath.$IsLogin['LMAN']);
							$CanDelDir = true;
							foreach($files as $file) {
								if($file != '.' && $file != '..' && $file != 'index.php'){
									$CanDelDir = false;
									break;
								}
							}
							if($CanDelDir == true){
								AptPhpScriptDirDelete(['Dir'=>PredifinePartnerMediaFilePath.$IsLogin['LMAN']]);
							}
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Media file can not created [WriteArticle]','status'=>'Error']); exit();
						}
						$text = '<?php error_reporting(0); if ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") || $_SERVER["SERVER_PORT"] == 443) { $HeaderSecureType = "https://"; }else{ $HeaderSecureType = "http://"; } define("DomainName",  $HeaderSecureType.$_SERVER["HTTP_HOST"]); header("Location: " . DomainName); die(); ?>';
    
						if(!fwrite($MediaDir, $text)){
							$files = scandir(PredifinePartnerMediaFilePath.$IsLogin['LMAN']);
							$CanDelDir = true;
							foreach($files as $file) {
								if($file != '.' && $file != '..' && $file != 'index.php'){
									$CanDelDir = false;
									break;
								}
							}
							if($CanDelDir == true){
								AptPhpScriptDirDelete(['Dir'=>PredifinePartnerMediaFilePath.$IsLogin['LMAN']]);
							}
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Media file can not created [WriteArticle]','status'=>'Error']); exit();
						}
						fclose($MediaDir);
					}

					if (!file_exists(PredifinePartnerMediaFilePath.$IsLogin['LMAN'].'/'.$ArticleId)){
						if(!mkdir(PredifinePartnerMediaFilePath.$IsLogin['LMAN'].'/'.$ArticleId)){
							AptPhpScriptDirDelete(['Dir'=>PredifinePartnerMediaFilePath.$IsLogin['LMAN'].'/'.$ArticleId]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Media file can not created [WriteArticle]','status'=>'Error']); exit();
						}
					}else{
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Media file can not created [WriteArticle]','status'=>'Error']); exit();
					}

					$MediaDir = fopen(PredifinePartnerMediaFilePath.$IsLogin['LMAN'].'/'.$ArticleId.'/index.php', "w");
					if(!$MediaDir){
						AptPhpScriptDirDelete(['Dir'=>PredifinePartnerMediaFilePath.$IsLogin['LMAN'].'/'.$ArticleId]);
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Media file can not created [WriteArticle]','status'=>'Error']); exit();
					}
					
					$text = '<?php error_reporting(0); if ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") || $_SERVER["SERVER_PORT"] == 443) { $HeaderSecureType = "https://"; }else{ $HeaderSecureType = "http://"; } define("DomainName",  $HeaderSecureType.$_SERVER["HTTP_HOST"]); header("Location: " . DomainName); die(); ?>';

					if(!fwrite($MediaDir, $text)){
						AptPhpScriptDirDelete(['Dir'=>PredifinePartnerMediaFilePath.$IsLogin['LMAN'].'/'.$ArticleId]);
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Media file can not created [WriteArticle]','status'=>'Error']); exit();
					}
					fclose($MediaDir);
					
					$GLOBALS['ArticleMediaFilePath'] = $IsLogin['LMAN'].'/'.$ArticleId.'/';
					$GLOBALS['ArticleMediaDir'] = PredifinePartnerMediaFilePath.$IsLogin['LMAN'].'/'.$ArticleId.'/';
					$GLOBALS['ArticleMediaDirByHttp'] = '<PredifineKeyword>PredifinePartnerMediaFilePath<PredifineKeyword>'.$IsLogin['LMAN'].'/'.$ArticleId.'/';

					if(preg_match('~<(img\s[^>]+)>~isU',($ArticleDescription))){
						if (!file_exists($GLOBALS['ArticleMediaDir'].'Image/')){
							if(!mkdir($GLOBALS['ArticleMediaDir'].'Image/')){
								AptPhpScriptDirDelete(['Dir'=>$GLOBALS['ArticleMediaDir']]);
								foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Media file can not created [WriteArticle]','status'=>'Error']); exit();
							}
						}else{
							AptPhpScriptDirDelete(['Dir'=>$GLOBALS['ArticleMediaDir']]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Media file can not created [WriteArticle]','status'=>'Error']); exit();
						}
	
						$MediaDir = fopen($GLOBALS['ArticleMediaDir'].'Image/'.'index.php', "w");
						if(!$MediaDir){
							AptPhpScriptDirDelete(['Dir'=>$GLOBALS['ArticleMediaDir']]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Media file can not created [WriteArticle]','status'=>'Error']); exit();
						}
						
						$text = '<?php error_reporting(0); if ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") || $_SERVER["SERVER_PORT"] == 443) { $HeaderSecureType = "https://"; }else{ $HeaderSecureType = "http://"; } define("DomainName",  $HeaderSecureType.$_SERVER["HTTP_HOST"]); header("Location: " . DomainName); die(); ?>';
	
						if(!fwrite($MediaDir, $text)){
							AptPhpScriptDirDelete(['Dir'=>$GLOBALS['ArticleMediaDir']]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Media file can not created [WriteArticle]','status'=>'Error']); exit();
						}
						fclose($MediaDir);
					}


					function MulStrPos($data=[]){
						if($data['str'] == '' or $data['substr'] == ''){
							return ['status'=>'error','msg'=>'Invalid data format detect [MulStrPos]','code'=>400];
						}
						$lastPos = 0;
						$positions = array();
						while (($lastPos = strpos($data['str'], $data['substr'], $lastPos))!== false) {
						    $positions[] = $lastPos;
						    $lastPos = $lastPos + mb_strlen($data['substr']);
						}
						return ['status'=>'success','msg'=>$positions,'code'=>200];
					}

					function FindSubString($data=[]){
						if($data['str'] == '' or $data['start'] == '' or $data['end'] == ''){
							return ['status'=>'error','msg'=>'Invalid data format detect [FindSubString]','code'=>400];
						}

						$tmpstr = $data['str'];
						$SubStrs = [];
						
						$StartPos = MulStrPos(['str'=>$tmpstr, 'substr'=>$data['start']]);
						$EndPos = MulStrPos(['str'=>$tmpstr, 'substr'=>$data['end']]);

						if($data['return_onnotfound'] != true){
							if(mb_strlen($StartPos['msg']) == 0 or $StartPos['code'] != 200 or mb_strlen($EndPos['msg']) == 0 or $EndPos['code'] != 200){
								return ['status'=>'success','msg'=>$SubStrs,'code'=>200];
							}
						}
						// continue from here [incomplete]
						if($StartPos['code'] != 200 or $EndPos['code'] != 200){
							return ['status'=>'error','msg'=>'An technical error occur [MulStrPos]','code'=>400];
						}else{
							$StartPos = $StartPos['msg'];
							$EndPos = $EndPos['msg'];
						}

						if($data['start_include'] != true and mb_strlen($StartPos) !== false){
							$StartPos += mb_strlen($data['start']);
						}

						if ($data['start_include'] != true and mb_strlen($StartPos) !== false and mb_strlen($EndPos) !== false){
							$EndPos -= mb_strlen($data['start']);
						}

						if($data['end_include'] == true and mb_strlen($EndPos) !== false){
							$EndPos += mb_strlen($data['end']);
						}

						if($StartPos == false and $EndPos == false){
							$SubStr = $tmpstr;
						}else if($StartPos == false){
							$SubStr = substr($tmpstr, 0, $EndPos);
						}else if($EndPos == false){
							$SubStr = substr($tmpstr, $StartPos, -1);
						}else{
							$SubStr = substr($tmpstr, $StartPos, $EndPos);
						}

						$tmpstr = substr($tmpstr, $EndPos, -1);
						array_push($SubStrs, $SubStr);
						if($StartPos == false or $EndPos == false){
							return ['status'=>'success','msg'=>$SubStrs,'code'=>200];
						}		
					}

					$GLOBALS['ImageUrl'] = array();
					$GLOBALS['LinkCount'] = 0;
					$GLOBALS['InternalLinkCount'] = 0;
					$GLOBALS['ExternalLinkCount'] = 0;
					$GLOBALS['InternalLinkForSelf'] = 0;
					$GLOBALS['InternalLinkForOther'] = 0;
					function AncorLinkMakwFollowOrNoFollow($content) {
					    $content["post_content"] = preg_replace_callback('~<(a\s[^>]+)>~isU', "AncorLinkMakwFollowOrNoFollow_cb2", $content["post_content"]);
					    return $content;
					}

					$GLOBALS['IsLogin_LMAN'] = $IsLogin['LMAN'];
					function AncorLinkMakwFollowOrNoFollow_cb2($match) {
					    list($original, $tag) = $match;	// regex match groups
					    $GLOBALS['LinkCount'] += 1;
					    $AllowedDir =  ['/'.$GLOBALS['IsLogin_LMAN'].'/'];	// re-add quirky config here
					    $AllowedDomain = [DomainName.'/'];

					    $IsAllowedDir = false;
				    	foreach($AllowedDir as $value){
				    		if(strpos($tag, $value) !== false){
				    			$IsAllowedDir = true; break;
				    		}
				    	}

				    	$IsAllowedDomain = false;
				    	foreach($AllowedDomain as $value){
				    		if(strpos($tag, $value) !== false){
				    			$IsAllowedDomain = true;  break;
				    		}
				    	}

				    	if($IsAllowedDomain == true){
				    		$GLOBALS['InternalLinkCount'] += 1;
				    		if($IsAllowedDir == true){
					    		$GLOBALS['InternalLinkForSelf'] += 1;
					    	}else{
					    		$GLOBALS['InternalLinkForOther'] += 1;
					    	}
				    	}else{
				    		$GLOBALS['ExternalLinkCount'] += 1;
				    	}

					    if (strpos($tag, "nofollow")) {
					        return $original;
					    } else {
					    	if($IsAllowedDir != true or $IsAllowedDomain != true){
					    		 return "<$tag rel='nofollow'>";
					    	}else{
					    		return $original;
					    	}
					    	
					    }
					}

					$AncorLinkMakwFollowOrNoFollow = AncorLinkMakwFollowOrNoFollow(['post_content'=>$ArticleDescription]);
				  	$ArticleDescription = $AncorLinkMakwFollowOrNoFollow['post_content'];

					function ImgSrcToNewImg($content) {
					    $content["post_content"] = preg_replace_callback('~<(img\s[^>]+)>~isU', "ImgSrcToNewImgProcess", $content["post_content"]);
					    return $content["post_content"];
					}

					function ImgSrcToNewImgProcess($match) {
					    list($original, $tag) = $match;	// regex match groups
					    if (strpos($original, 'src="') !== false) {
					    	$ImgSrc = preg_replace_callback('~(src="[^>]+)"~isU', "ImgSrcToNewImgProcess2", $original);
					    }else{
					    	$ImgSrc = preg_replace_callback("~(src='[^>]+)'~isU", "ImgSrcToNewImgProcess2", $original);
					    }
					    return $ImgSrc;
					}

					function ImgSrcToNewImgProcess2($match){
						list($original, $tag) = $match;	// regex match groups
						if(substr(substr($original,5,-1),0,5) == 'data:'){
							$ImgType = getMimeTypeFromBase64(substr($original,5,-1))['extension'];
							if($ImgType == ''){
								foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Invalid image type found [WriteArticle]','status'=>'Error']); exit();
							}
							$i = 1;
							while(true){
								$ImgPath = 't'.rand_string(9).'.'.$ImgType;
								$MoveImgUrl = $GLOBALS['ArticleMediaDir'].'Image/'.$ImgPath;
								$MoveImgUrlByHttp = $GLOBALS['ArticleMediaDirByHttp'].'Image/'.$ImgPath;
								if (!file_exists($MoveImgUrl)){
									break;
								}else if($i > 5){
									AptPhpScriptDirDelete(['Dir'=>$GLOBALS['ArticleMediaDir']]);
									foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
									AptPrint(['msg'=>'Media can not uploaded [WriteArticle]','status'=>'Error']); exit();
								}
								$i++;
							}
							$ImgPath = base64ToImg(substr($original,5,-1),$MoveImgUrl);
							if($ImgPath['reason'] == 'type'){
								AptPhpScriptDirDelete(['Dir'=>$GLOBALS['ArticleMediaDir']]);
    							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){if($SetVarKey != 'ImgPath'){ unset($$SetVarKey); }} unset($SetVarKey,$SetVarVal);
    							AptPrint(['msg'=>$ImgPath['msg'],'status'=>'Error']); exit();
							}
							array_push($GLOBALS['ImageUrl'], $MoveImgUrlByHttp);
							return 'src="'.$MoveImgUrlByHttp.'"';
						}else{
							$ImgUrl = substr($original,5,-1);
							$IsImage = validImage($ImgUrl);
							if($IsImage['image'] != true || $IsImage['type'] != 'image' || $IsImage['width'] <= 0 || $IsImage['height'] <= 0 || ($IsImage['extension'] !=  'png' && $IsImage['extension'] !=  'jpeg' && $IsImage['extension'] !=  'jpg' && $IsImage['extension'] !=  'gif' && $IsImage['extension'] !=  'webp')){
								AptPhpScriptDirDelete(['Dir'=>$GLOBALS['ArticleMediaDir']]);
								foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Only png, jpeg, jpg, gif and webp image file supported now [WriteArticle]','status'=>'Error']); exit();
							}else{
								$i = 1;
								while(true){
									$ImgPath = 't'.rand_string(9).'.'.$IsImage['extension'];
									$MoveImgUrl = $GLOBALS['ArticleMediaDir'].'Image/'.$ImgPath;
									$MoveImgUrlByHttp = $GLOBALS['ArticleMediaDirByHttp'].'Image/'.$ImgPath;
									if (!file_exists($MoveImgUrl)){
										break;
									}else if($i > 5){
										AptPhpScriptDirDelete(['Dir'=>$GLOBALS['ArticleMediaDir']]);
										foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
										AptPrint(['msg'=>'Media can not uploaded [WriteArticle]','status'=>'Error']); exit();
									}
									$i++;
								}
								file_put_contents($MoveImgUrl, file_get_contents($ImgUrl));
								array_push($GLOBALS['ImageUrl'], $MoveImgUrlByHttp);
								$IsImage = validImage($MoveImgUrl);
								if($IsImage['bytes'] <= 0 || ($IsImage['bytes']/(1024*1024)) > 5){
									AptPhpScriptDirDelete(['Dir'=>$GLOBALS['ArticleMediaDir']]);
									foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){if($SetVarKey != 'ImgPath'){ unset($$SetVarKey); }} unset($SetVarKey,$SetVarVal);
									AptPrint(['msg'=>'Image size must be under 5 mb image file supported now [Valided Image]','status'=>'Error']); exit();
								}
								return 'src="'.$MoveImgUrlByHttp.'"';
							}
						}
					}

					function validImage($file) {
						   $size = getimagesize($file);
					    preg_match('/^(.*)\/(.*)/', $size['mime'], $match);

					    return [
							'width' => $size[0],
							'height' => $size[1],
							'bytes' => filesize($file),
					    	'image' => ($match[1] == 'image' ? true : false),
					        'type' => $match[1],
					        'extension' => $match[2],
					    ];
					}

					function getMimeTypeFromBase64($string){
					    $string = explode(
					        ';base64,',
					        stristr($string, ';base64,', true)
					    );

					    if(empty($string[0])){
					        return false;
					    }

					    preg_match('/^data:(.*)\/(.*)/', $string[0], $match);

					    return [
					        'type' => $match[1],
					        'extension' => $match[2],
					    ];
					}

					function base64ToImg($base64_string, $output_file) {
					    // open the output file for writing
					    $ifp = fopen( $output_file, 'wb' ); 

					    // split the string on commas
					    // $data[ 0 ] == "data:image/png;base64"
					    // $data[ 1 ] == <actual base64 string>
					    $data = explode( ',', $base64_string );

					    // we could add validation here with ensuring count( $data ) > 1
					    fwrite( $ifp, base64_decode( $data[ 1 ] ) );

					    // clean up the file resource
						fclose( $ifp );
				        $TmpImgDtls = validImage($output_file);
						if($TmpImgDtls['image'] != true || $TmpImgDtls['type'] != 'image' || $TmpImgDtls['width'] <= 0 || $TmpImgDtls['height'] <= 0 || ($TmpImgDtls['extension'] !=  'png' && $TmpImgDtls['extension'] !=  'jpeg' && $TmpImgDtls['extension'] !=  'jpg' && $TmpImgDtls['extension'] !=  'gif' && $TmpImgDtls['extension'] !=  'webp')){
					        unlink($output_file);
					        return ['msg'=>'Error','msg'=>'Only png, jpeg, jpg, gif and webp image file supported now [Valided Image]','code'=>400,'reason'=>'type'];
						}else if($TmpImgDtls['bytes'] <= 0 || ($TmpImgDtls['bytes']/(1024*1024)) > 5){
							unlink($output_file);
							return ['msg'=>'Error','msg'=>'Image size must be under 5 mb image file supported now [Valided Image]','code'=>400,'reason'=>'type'];
						}

					    return $output_file; 
					}

					$ArticleDescription = ImgSrcToNewImg(['post_content'=>$ArticleDescription]);

				  	$ImageCount = -1; $VideoCount = -1; $DefinedWatchTime = -1; $Author = $IsLogin['msg']['UserUrl'];
				  	if($SubCategory != ''){
				  		$Category = "||$Category||$SubCategory||";
				  	}else{
				  		$Category = "||$Category||";
				  	}
				  	
				  	$TmpMetaDescription  = multiexplode(array(' '),mb_substr($StripEArticleDescription,0,250));
					$MetaDescription = '';
					foreach ($TmpMetaDescription as $word){
						if (mb_strlen($word) > 0) {
							$MetaDescription .= $word.' ';
						}
						if(mb_strlen($MetaDescription) >= 250){
							break;
						}
					}
					$MetaDescription = trim(preg_replace('!\s+!', ' ',$MetaDescription.'...'),' ');

					$EnMetaDescription =  GoogleTranslate(['Target'=>'en','String'=>$MetaDescription]);
					if($EnMetaDescription['code'] == 200 || $EnMetaDescription['code'] == 404){
						$EnMetaDescription = $EnMetaDescription['msg'];
					}else{
						AptPhpScriptDirDelete(['Dir'=>$GLOBALS['ArticleMediaDir']]);
						if($ModTitle['ecode'] == 408){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Internet connection is not connected [WriteArticle]','status'=>'Error']); exit();
						}
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Meta description can not coverted due to technical error [WriteArticle]','status'=>'Error']); exit();
					}
					if($EnMetaDescription['dslang'] != 'en'){
						$MetaDescription .= ' , English : '.$EnMetaDescription;
					}
					  
				  	$E2ArticleTitle = AptSafeText(['Str'=>$ArticleTitle,'EWords'=>AptSafeTextDecodeEWordsAllEncode]);
				  	if($E2ArticleTitle['code'] != 200 || strlen($E2ArticleTitle['msg']) <= 0){
				  		AptPhpScriptDirDelete(['Dir'=>$GLOBALS['ArticleMediaDir']]);
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'An technical error occur [ArticleTitle] [AptEncodeAndEncryptWithAes] [AptSafeText]','status'=>'Error']); exit();
					}
					$E2ArticleTitle = $E2ArticleTitle['msg'];

					$EModTitle = AptSafeText(['Str'=>$ModTitle,'EWords'=>AptSafeTextDecodeEWordsAllEncode]);
				  	if($EModTitle['code'] != 200 || strlen($EModTitle['msg']) <= 0){
				  		AptPhpScriptDirDelete(['Dir'=>$GLOBALS['ArticleMediaDir']]);
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'An technical error occur [ModTitle] [AptEncodeAndEncryptWithAes] [AptSafeText]','status'=>'Error']); exit();
					}
					$EModTitle = $EModTitle['msg'];

					$E2ArticleDescription = AptSafeText(['Str'=>$ArticleDescription,'EWords'=>AptSafeTextDecodeEWordsAllEncode]);
				  	if($E2ArticleDescription['code'] != 200 || strlen($E2ArticleDescription['msg']) <= 0){
				  		AptPhpScriptDirDelete(['Dir'=>$GLOBALS['ArticleMediaDir']]);
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'An technical error occur [ArticleDescription] [AptEncodeAndEncryptWithAes] [AptSafeText]','status'=>'Error']); exit();
					}
					$E2ArticleDescription = $E2ArticleDescription['msg'];
					
				  	$Insert = "Status::::UnderReview::,::Url::::$ArticleId::,::FUrl::::$ArticleUrl::,::Title::::$E2ArticleTitle::,::ModTitle::::$EModTitle::,::Description::::$E2ArticleDescription::,::Keyword::::$keyword::,::PKeyword::::$PKeyword::,::MetaDescription::::$MetaDescription::,::CreateTime::::$CurrentTime::,::UpdateTime::::$CurrentTime::,::ViewCount::::0::,::CommentCount::::0::,::ShareCount::::0::,::ImageCount::::$ImageCount::,::VideoCount::::$VideoCount::,::WatchTime::::0::,::LinkCount::::".$GLOBALS['LinkCount']."::,::InternalLinkCount::::".$GLOBALS['InternalLinkCount']."::,::InternalLinkForSelf::::".$GLOBALS['InternalLinkForSelf']."::,::InternalLinkForOther::::".$GLOBALS['InternalLinkForOther']."::,::ExternalLinkCount::::".$GLOBALS['ExternalLinkCount']."::,::Ranking::::0::,::Performance::::0::,::DefinedWatchTime::::$DefinedWatchTime::,::UniqueViews::::0::,::VerifyedViews::::0::,::LikeCount::::0::,::DislikeCount::::0::,::ReportCount::::0::,::Author::::$Author::,::Category::::$Category::,::ImageUrl::::".serialize($GLOBALS['ImageUrl'])."::,::MediaFilePath::::".$GLOBALS['ArticleMediaFilePath']."::,::ShowAdCount::::0::,::RequestAdCount::::0::,::ClickAdCount::::0::,::Revenue::::0::,::AgeRestriction::::0::,::BestForGender::::0::,::SubscriberGainOrDrop::::0::,::DonateAmount::::0::,::Availability::::Free::,::Price::::0::,::PublishTime::::0";
				  	
				  	$InsertInAccount = AptPdoInsertWithAes(['InsertData'=>$Insert,'DbCon'=>$PdoTopicsterPostData,'TbName'=> 'post', 'EPass'=> $EPass]);
				  	
					if($InsertInAccount['code'] === 200){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['status'=>'Success','msg'=>'Post submit successfully','code'=>200]);
					}
					AptPhpScriptDirDelete(['Dir'=>$GLOBALS['ArticleMediaDir']]);
					foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
					AptPrint(['msg'=>'Post can not submit due to technical error occur! Try again [WriteArticle]']);
				}
			}

			WriteArticle::ValidateData($_POST);
		}else{
			foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
			AptPrint(['msg'=>'Invalid Token! Please refresh page to regenerate Token [WriteArticle]']);
		}
	}else{
		AptPrint(['msg'=>'Authentication failed [WriteArticle]']); exit();
		header("Location: " . RootPath . "Library/SiteComponents/PageNotFound/index.php"); die();
	}
}else{
	AptPrint(['msg'=>'Invalid data sent [WriteArticle]']); exit();
	header("Location: " . RootPath . "Library/SiteComponents/PageNotFound/index.php"); die();
}
?>  