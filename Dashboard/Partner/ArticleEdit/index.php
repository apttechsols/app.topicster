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
define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
require(RootPath."Library/SiteComponents/BackEndControlPage/index.php");
require(RootPath."Library/SiteComponents/FrontAndBackEndControlPage/index.php");
header("Location: " . RootPath); die(); exit();
// Get all requested data
if(isset($_POST['Url']) && isset($_POST['ArticleTitle']) && isset($_POST['ArticleDescription']) && isset($_POST['Category']) && isset($_POST['SubCategory']) && isset($_POST['Keyword1']) && isset($_POST['Keyword2']) && isset($_POST['Keyword3']) && isset($_POST['Keyword4']) && isset($_POST['Keyword5']) && isset($_POST['Token_CSRF']) && isset($_POST['BrowserClientId1']) && isset($_POST['BrowserClientId2'])){

	// Verify data send from same page or not
	if($_SERVER['HTTP_REFERER'] === DomainName ."/Dashboard/Partner/ArticleEdit/ckeditor/index.php?url=".$_POST['Url']){
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
						if($key != 'Url' && $key != 'ArticleTitle' && $key != 'ArticleDescription' && $key != 'Category' && $key != 'SubCategory' && $key != 'Keyword1' && $key != 'Keyword2' && $key != 'Keyword3' && $key != 'Keyword4' && $key != 'Keyword5' && $key != 'Token_CSRF' && $key != 'BrowserClientId1' && $key != 'BrowserClientId2'){
							unset($key);
						}else{
							if($key == 'ArticleDescription' or $key == 'ArticleTitle'){
								${$key} = $value;
								continue;
							}else if($key == 'Keyword1' or $key == 'Keyword2' or $key == 'Keyword3' or $key == 'Keyword4' or $key == 'Keyword5'){
								$result = AptSafeText(['Str'=>$value,'EWords'=>['$','=','(',')','[',']','?','*','/','{','}','<','>']]);
						 		if($result['code'] != 200){
						 			foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
									AptPrint(['msg'=>'Keyword not process successfully [AptSafeText1]']); exit();
						 		}
								${$key} = $result['msg'];
								continue;
							}

							${$key} = preg_replace('!\s+!', ' ',strip_tags($value));
						}
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

					if(mb_strlen(strip_tags($ArticleDescription)) < 10 or mb_strlen(strip_tags($ArticleDescription)) > 15000){
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

					$IgnoreKeyword = ['&nbsp'];

					$TmpKeyword = array();
					$Keywords = [$Keyword1,$Keyword2,$Keyword3,$Keyword4,$Keyword5];
					$keyword = '';
					$PKeyword = ', ';

					foreach ($Keywords as $value){
					 	if (mb_strlen($value) > 0 && !in_array($value, $TmpKeyword) && !in_array($value, $IgnoreKeyword)){
					 		if(strpos($value, ',') !== false){
					 			foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Comma [,] can not be used in Keyword [AptSafeText]']); exit();
					 		}
					 		$result = AptSafeText(['Str'=>$value,'EWords'=>['$','=','(',')','[',']','?','*','/','{','}','<','>']]);
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

					$result = AptSafeText(['Str'=>strip_tags($ArticleDescription),'EWords'=>['$','=','(',')','[',']','?','*','/','{','}','<','>']]);
			 		if($result['code'] != 200){
			 			foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Keyword not process successfully [AptSafeText3]']); exit();
			 		}
					$str = $result['msg'];
					foreach ($IgnoreKeyword as $key => $value) {
						$str = str_replace($value, ' ', $str);
					}

					for ($j = 7-$i; $j > 0; $j--){
						$words  = explode(' ', $str);
						$longestWordLength = 0;
						$longestWord = '';
						foreach ($words as $word) {
						   if (mb_strlen($word) > $longestWordLength) {
						      $longestWordLength = mb_strlen($word);
						      $longestWord = $word;
						   }
						}
						$longestWord = strtolower($longestWord);
						if(mb_strlen($longestWord) >= 4 && !in_array($longestWord, $TmpKeyword) && !in_array($longestWord, $IgnoreKeyword) && strpos($longestWord, ',') === false){
							$i += 1;
							$keyword .= $longestWord.', ';
							array_push($TmpKeyword, $longestWord);
						}

						$str = str_replace($longestWord, ' ', $str);
					}

					$result = AptSafeText(['Str'=>$ArticleTitle,'EWords'=>['$','=','(',')','[',']','?','*','/','{','}','<','>']]);
			 		if($result['code'] != 200){
			 			foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Keyword not process successfully [AptSafeText4]']); exit();
			 		}
					$str = strip_tags($result['msg']);
					foreach ($IgnoreKeyword as $key => $value) {
						$str = str_replace($value, ' ', $str);
					}
					for ($j = 8-$i; $j > 0; $j--){
						$words  = explode(' ',$str);
						$longestWordLength = 0;
						$longestWord = '';
						foreach ($words as $word) {
						   if (mb_strlen($word) > $longestWordLength) {
						      $longestWordLength = mb_strlen($word);
						      $longestWord = $word;
						   }
						}
						$longestWord = strtolower($longestWord);
						if(mb_strlen($longestWord) >= 4 && !in_array($longestWord, $TmpKeyword) && !in_array($longestWord, $IgnoreKeyword) && strpos($longestWord, ',') === false){
							$i += 1;
							$keyword .= $longestWord.', ';
							array_push($TmpKeyword, $longestWord);
						}
						$str = str_replace($longestWord, '', $str);
					}

					if($i < 5){
						$i += 1;
						$keyword .= $Category.', ';
					}
					if($i < 5 and $SubCategory != ''){
						$i += 1;
						$keyword .= $SubCategory.', ';
					}

					if($keyword != ''){
						$keyword = ', '.$keyword;
					}
					
					WriteArticle::EncryptData($Url,$ArticleTitle,$ArticleDescription,$Category,$SubCategory,$keyword,$PKeyword,$BrowserClientId1,$BrowserClientId2);
				}
				private static function EncryptData($Url,$ArticleTitle,$ArticleDescription,$Category,$SubCategory,$keyword,$PKeyword,$BrowserClientId1,$BrowserClientId2){

					$EPass ='T@K2YeD*4s_4q-F5m&R6@Wp7Wu2Xw#_-qJ8c^?#h6v_hW-3uY3q%h&4N#hV8k@Ca';

					WriteArticle::CkeckLoginAndAuthenticate($Url,$ArticleTitle,$ArticleDescription,$Category,$SubCategory,$keyword,$PKeyword,$BrowserClientId1,$BrowserClientId2,$EPass);
				}

				private static function CkeckLoginAndAuthenticate($Url,$ArticleTitle,$ArticleDescription,$Category,$SubCategory,$keyword,$PKeyword,$BrowserClientId1,$BrowserClientId2,$EPass){

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

					WriteArticle::DoWriteArticle($Url,$ArticleTitle,$ArticleDescription,$Category,$SubCategory,$keyword,$PKeyword,$EPass,$PdoTopicsterMain,$PdoTopicsterPartner,$PdoTopicsterUserActivity,$PdoTopicsterPostData,$IsLogin);
				}

				private static function DoWriteArticle($Url,$ArticleTitle,$ArticleDescription,$Category,$SubCategory,$keyword,$PKeyword,$EPass,$PdoTopicsterMain,$PdoTopicsterPartner,$PdoTopicsterUserActivity,$PdoTopicsterPostData,$IsLogin){
					date_default_timezone_set('Asia/Kolkata');
					$CurrentTime = time();

					$ValidArticleId = AptPdoFetchWithAes(['Condtion'=> "Url::::$Url" ,'FetchData'=>'FUrl::::Description::::Title::::Category::::PKeyword', 'DbCon'=> $PdoTopicsterPostData, 'TbName'=> 'post', 'EPass'=> $EPass]);

					if($ValidArticleId['code'] != 200){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Invalid Url detect [WriteArticle]','status'=>'Error']); exit();
					}

					$ArticleId = $Url;
					$ArticleUrl = $ValidArticleId['msg']->FUrl;

					AptPrint(['msg'=>json_encode($ArticleDescription == $ValidArticleId['msg']->ArticleDescription)]);

					if(!file_exists(RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/index.php')){
						if(!($ArticleIndex = fopen(RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/index.php', "w"))){
							unlink(RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/index.php');
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Article file can not created [WriteArticle]','status'=>'Error']); exit();
						}
						
						$text = '<?php error_reporting(0); if ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") || $_SERVER["SERVER_PORT"] == 443) { $HeaderSecureType = "https://"; }else{ $HeaderSecureType = "http://"; } define("DomainName",  $HeaderSecureType.$_SERVER["HTTP_HOST"]); header("Location: " . DomainName); die(); ?>';

						if(!fwrite($ArticleIndex, $text)){
							unlink(RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/index.php');
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Article file can not created [WriteArticle]','status'=>'Error']); exit();
						}
						fclose($ArticleIndex);
					}

					if (!file_exists(RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/'.$ArticleId)){
						mkdir(RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/'.$ArticleId);
						if(!($ArticleDir = fopen(RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/'.$ArticleId.'/index.php', "w"))){
							AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/'.$ArticleUrl]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Article file can not created [WriteArticle]','status'=>'Error']); exit();
						}
						
						$text = '<?php error_reporting(0); if ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") || $_SERVER["SERVER_PORT"] == 443) { $HeaderSecureType = "https://"; }else{ $HeaderSecureType = "http://"; } define("DomainName",  $HeaderSecureType.$_SERVER["HTTP_HOST"]); header("Location: " . DomainName); die(); ?>';

						if(!fwrite($ArticleDir, $text)){
							AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/'.$ArticleId]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Article file can not created [WriteArticle]','status'=>'Error']); exit();
						}
						fclose($ArticleDir);
						if(!($ArticleDir = fopen(RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/'.$ArticleId.'/'.$ArticleUrl.'.php', "w"))){
							AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/'.$ArticleId]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Article file can not created [WriteArticle]','status'=>'Error']); exit();
						}
						
						$text = '<?php error_reporting(0); if ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") || $_SERVER["SERVER_PORT"] == 443) { $HeaderSecureType = "https://"; }else{ $HeaderSecureType = "http://"; } define("RootPath", "../../../../"); define("DomainName",  $HeaderSecureType.$_SERVER["HTTP_HOST"]); define("PostUrl", '.$ArticleId.'); define("PostFUrl", '.$ArticleUrl.'); require_once(RootPath."Library/SiteComponents/ArticleReader/index.php"); foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal); ?>';

						if(!fwrite($ArticleDir, $text)){
							AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/'.$ArticleId]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Article file can not created [WriteArticle]','status'=>'Error']); exit();
						}
						fclose($ArticleDir);
						if(!mkdir(RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/'.$ArticleId.'/Media')){
							AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/'.$ArticleId.'/Media']);
							AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/'.$ArticleId]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Media file can not created [WriteArticle]','status'=>'Error']); exit();
						}
						if(!($ArticleDir = fopen(RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/'.$ArticleId.'/Media/index.php', "w"))){
							AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/'.$ArticleId.'/Media']);
							AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/'.$ArticleId]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Article file can not created [WriteArticle]','status'=>'Error']); exit();
						}
						
						$text = '<?php error_reporting(0); if ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") || $_SERVER["SERVER_PORT"] == 443) { $HeaderSecureType = "https://"; }else{ $HeaderSecureType = "http://"; } define("DomainName",  $HeaderSecureType.$_SERVER["HTTP_HOST"]); header("Location: " . DomainName); die(); ?>';

						if(!fwrite($ArticleDir, $text)){
							AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/'.$ArticleId.'/Media']);
							AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/'.$ArticleId]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Article file can not created [WriteArticle]','status'=>'Error']); exit();
						}
						fclose($ArticleDir);
						$GLOBALS['ArticleMediaDir'] = RootPath.'Partner/'.$IsLogin['LMAN'].'/ArticleEdit/'.$ArticleId.'/Media/';
						$GLOBALS['ArticleMediaDirByHttp'] = 'http://localhost<YourDomainName>.com//Partner/'.$IsLogin['LMAN'].'/ArticleEdit/'.$ArticleId.'/Media/';
					}else{
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Article file can not created [WriteArticle]','status'=>'Error']); exit();
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
					    $content["post_content"] = preg_replace_callback('~<(img\s[^>]+)>~isU', "AncorLinkMakwFollowOrNoFollow_cb2", $content["post_content"]);
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
								$MoveImgUrl = $GLOBALS['ArticleMediaDir'].$ImgPath;
								$MoveImgUrlByHttp = $GLOBALS['ArticleMediaDirByHttp'].$ImgPath;
								if (!file_exists($MoveImgUrl)){
									break;
								}else if($i > 5){
									AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/Article/'.$ArticleId.'/Media']);
									AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/Article/'.$ArticleId]);
									foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
									AptPrint(['msg'=>'Media can not uploaded [WriteArticle]','status'=>'Error']); exit();
								}
								$i++;
							}
							$ImgPath = base64ToImg(substr($original,5,-1),$MoveImgUrl);
							array_push($GLOBALS['ImageUrl'], $MoveImgUrlByHttp);
							return 'src="'.$MoveImgUrlByHttp.'"';
						}else{
							$ImgUrl = substr($original,5,-1);
							$IsImage = validImage($ImgUrl);
							if(!$IsImage['image']){
								AptPrint(['msg'=>$ImgUrl,'status'=>'Error']);
								foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Invalid image type found [WriteArticle]','status'=>'Error']); exit();
							}else{
								$i = 1;
								while(true){
									$ImgPath = 't'.rand_string(9).'.'.$IsImage['extension'];
									$MoveImgUrl = $GLOBALS['ArticleMediaDir'].$ImgPath;
									$MoveImgUrlByHttp = $GLOBALS['ArticleMediaDirByHttp'].$ImgPath;
									if (!file_exists($MoveImgUrl)){
										break;
									}else if($i > 5){
										AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/Article/'.$ArticleId.'/Media']);
										AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/Article/'.$ArticleId]);
										foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
										AptPrint(['msg'=>'Media can not uploaded [WriteArticle]','status'=>'Error']); exit();
									}
									$i++;
								}
								file_put_contents($MoveImgUrl, file_get_contents($ImgUrl));
								array_push($GLOBALS['ImageUrl'], $MoveImgUrlByHttp);
								return 'src="'.$MoveImgUrlByHttp.'"';
							}
						}
					}

					function validImage($file) {
					   	$size = getimagesize($file);
					    preg_match('/^(.*)\/(.*)/', $size['mime'], $match);

					    return [
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

					    return $output_file; 
					}

					$ArticleDescription = ImgSrcToNewImg(['post_content'=>$ArticleDescription]);
				  	
				  	$Meta = AptSafeText(['Str'=>substr(strip_tags($ArticleDescription),0,250),'EWords'=>['$','=','(',')','[',']','?','*','/','{','}','<','>']]);
				  	if($Meta['code'] != 200 || strlen($Meta['msg']) <= 0){
				  		AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/Article/'.$ArticleUrl.'/Media']);
						AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/Article/'.$ArticleUrl]);
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'An technical error occur [AptEncodeAndEncryptWithAes] [AptSafeText]','status'=>'Error']); exit();
					}
					$Meta = $Meta['msg'];

				  	$ImageCount = -1; $VideoCount = -1; $DefinedWatchTime = -1; $Author = $IsLogin['msg']['UserUrl'];
				  	$Category = "||$Category||$SubCategory||";

				  	$EArticleTitle = AptSafeText(['Str'=>$ArticleTitle,'EWords'=>['$','=','(',')','[',']','?','*','/','{','}','<','>']]);
				  	if($EArticleTitle['code'] != 200 || strlen($EArticleTitle['msg']) <= 0){
				  		AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/Article/'.$ArticleUrl.'/Media']);
						AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/Article/'.$ArticleUrl]);
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'An technical error occur [AptEncodeAndEncryptWithAes] [AptSafeText]','status'=>'Error']); exit();
					}
					$EArticleTitle = $EArticleTitle['msg'];

					$EArticleDescription = AptSafeText(['Str'=>$ArticleDescription,'EWords'=>['$','=','(',')','[',']','?','*','/','{','}','<','>']]);
				  	if($EArticleDescription['code'] != 200 || strlen($EArticleDescription['msg']) <= 0){
				  		AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/Article/'.$ArticleUrl.'/Media']);
						AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/Article/'.$ArticleUrl]);
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'An technical error occur [AptEncodeAndEncryptWithAes] [AptSafeText]','status'=>'Error']); exit();
					}
					$EArticleDescription = $EArticleDescription['msg'];
					
				  	$Insert = "Status::::UnderReview::,::Url::::$ArticleId::,::FUrl::::$ArticleUrl::,::Title::::$EArticleTitle::,::Description::::$EArticleDescription::,::Keyword::::$keyword::,::PKeyword::::$PKeyword::,::Meta::::$Meta::,::CreateTime::::$CurrentTime::,::UpdateTime::::$CurrentTime::,::ViewCount::::0::,::CommentCount::::0::,::ShareCount::::0::,::ImageCount::::$ImageCount::,::VideoCount::::$VideoCount::,::WatchTime::::0::,::LinkCount::::".$GLOBALS['LinkCount']."::,::InternalLinkCount::::".$GLOBALS['InternalLinkCount']."::,::InternalLinkForSelf::::".$GLOBALS['InternalLinkForSelf']."::,::InternalLinkForOther::::".$GLOBALS['InternalLinkForOther']."::,::ExternalLinkCount::::".$GLOBALS['ExternalLinkCount']."::,::Ranking::::0::,::Performance::::0::,::DefinedWatchTime::::$DefinedWatchTime::,::UniqueViews::::0::,::VerifyedViews::::0::,::LikeCount::::0::,::DislikeCount::::0::,::ReportCount::::0::,::Author::::$Author::,::Category::::$Category::,::ImageUrl::::".serialize($GLOBALS['ImageUrl'])."::,::ShowAdCount::::0::,::RequestAdCount::::0::,::ClickAdCount::::0::,::Revenue::::0::,::AgeRestriction::::0::,::BestForGender::::0::,::SubscriberGainOrDrop::::0::,::DonateAmount::::0::,::Availability::::Free::,::Price::::0::,::PublishTime::::0";
				  	
				  	$InsertInAccount = AptPdoInsertWithAes(['InsertData'=>$Insert,'DbCon'=>$PdoTopicsterPostData,'TbName'=> 'post', 'EPass'=> $EPass]);
				  	
					if($InsertInAccount['code'] === 200){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['status'=>'Success','msg'=>'Post submit successfully','code'=>200]);
					}
					AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/Article/'.$ArticleUrl.'/Media']);
					AptPhpScriptDirDelete(['Dir'=>RootPath.'Partner/'.$IsLogin['LMAN'].'/Article/'.$ArticleUrl]);
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