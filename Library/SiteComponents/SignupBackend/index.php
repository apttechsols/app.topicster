<?php 
/*
*@FileName SignupBackend
*@Des Upload data to server for create user
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

// Get all requested data
if(isset($_POST['AccountType']) && isset($_POST['AccountName']) && isset($_POST['DisplayName']) && isset($_POST['FullName']) && isset($_POST['Gender']) && isset($_POST['MobileNo']) && isset($_POST['Email']) && isset($_POST['City']) && isset($_POST['Pincode']) && isset($_POST['State']) && isset($_POST['Country']) && isset($_POST['Address']) && isset($_POST['Password']) && isset($_POST['SecurityCode']) && isset($_POST['Bio']) && isset($_POST['MobileOTP']) && isset($_POST['EmailOTP']) && ($_POST['AccountType'] == 'Subscriber' || isset($_FILES['ProfileImage'])) && isset($_POST['Token_CSRF']) && isset($_POST['BrowserClientId1']) && isset($_POST['BrowserClientId2'])){
	
	// Verify data send from same page or not
	if(str_replace('www.','',DomainName) === $HeaderSecureType.HostedDomainName){
		session_start();
		if($_POST['Token_CSRF'] === $_SESSION['Token_CSRF']){
			
			$GLOBALS['ProfileImage'] = $_FILES['ProfileImage'];
			$GLOBALS['ProfileImage_tmp'] = $_FILES['ProfileImage']['tmp_name'];
			$_POST['ProfileImageSize'] = round($_FILES['ProfileImage']['size'] / 1024, 2);
			$_POST['ProfileImageExt'] = pathinfo($_FILES['ProfileImage']['name'], PATHINFO_EXTENSION);

			class Signup{
				/*
				*@Method name - ValidateData
				*@Des - ValidateData all input data
				*/
				public static function ValidateData($ValidateDataArray = array()){

					# Offical accounts List
					$OfficalAccount['7597078875'] = 'topicster@gmail.com';
					$OfficalAccount['topicster_Article@gmail.com'] = '8619993142';
					$OfficalAccount['topicster_offical@gmail.com'] = '8619993142';

					foreach ($ValidateDataArray as $key => $value) {
						if($key != 'AccountType' && $key != 'AccountName' && $key != 'DisplayName' && $key != 'FullName' && $key != 'Gender' && $key != 'MobileNo' && $key != 'Email' && $key != 'City' && $key != 'Pincode' && $key != 'State' && $key != 'Country' && $key != 'Address' && $key != 'Password' && $key != 'SecurityCode' && $key != 'Bio' && $key != 'MobileOTP' && $key != 'EmailOTP' && $key != 'ProfileImageSize' && $key != 'ProfileImageExt' && $key != 'BrowserClientId1' && $key != 'BrowserClientId2'){
							unset($key);
						}else{
							${$key} = preg_replace('!\s+!', ' ',strip_tags($value));
							if($key != 'Password' && $key != 'Bio'){
								if(stripos(preg_replace("/[^A-Za-z]/","",strtolower($value)),"topics        ter") !== false){
									if(($OfficalAccount[$ValidateDataArray['MobileNo']] == $ValidateDataArray['Email'] && $ValidateDataArray['Email'] != '') || ($OfficalAccount[$ValidateDataArray['Email']] == $ValidateDataArray['MobileNo'] && $ValidateDataArray['MobileNo'] != '') || $OfficalAccount[$ValidateDataArray['MobileNo']] == 'all' || $OfficalAccount[$ValidateDataArray['Email']] == 'all'){
										continue;
									}
									foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
									AptPrint(['msg'=>"You can not use topicster in any field excluding password and Bio"]);
								}
							}
						}
					}
					AptPrint(['msg'=>'This feature may unlock soon','status'=>'Comming soon','code'=>204]); exit();
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

					// AccountType Validate in backend
					if($AccountType != 'Partner' && $AccountType != 'Subscriber'){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Invalid Account Type detect [Signup]']); exit();

					}

					if($AccountType != 'Subscriber'){

						// AccountName Validate in backend
						if($AccountName != preg_replace("/[^a-z0-9_]/","",$AccountName)){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account Name contains invalid characters [Signup]']); exit();

						}else if(strlen($AccountName) < 5 || strlen($AccountName) > 18){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account Name name must be between 5 and 18 characters long [Signup]']); exit();
						}

						// DisplayName Validate in backend
						if($DisplayName != preg_replace("/[^A-Za-z- _:)('|&@!]/","",$DisplayName)){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Display Name contains invalid characters [Signup]']); exit();

						}else if(strlen($DisplayName) < 2 || strlen($DisplayName) > 30){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Display Name name must be between 2 and 30 characters long [Signup]']); exit();
						}

						// FullName Validate in backend
						if($FullName != preg_replace("/[^A-Za-z ]/","", preg_replace("/^[ ]/"," ",$FullName))){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'FullName contains invalid characters [Signup]']); exit();

						}else if(substr($FullName,0,1) != preg_replace("/[^A-Z]/","", substr($FullName,0,1))){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'FullName first letter must be capital [Signup]']); exit();

						}else if(strlen($FullName) < 6 || strlen($FullName) > 30){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'FullName name must be between 6 and 30 characters long [Signup]']); exit();

						}else if(strlen(explode(" ",$FullName)[0]) == 0){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'FullName look like first name [Signup]']); exit();

						}else if(strlen(explode(" ",$FullName)[1]) == 0){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'FullName look like first name [Signup]']); exit();
						}
						
						// Gender Validate in backend
						if($Gender != "Male" && $Gender != "Female" && $Gender != "Other"){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Gender contains invalid characters [Signup]']); exit();
						}
						
						// MobileNo  Validate in backend
						if($MobileNo != preg_replace("/[^0-9]/","",$MobileNo)){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Mobile number contains invalid characters [Signup]']); exit();

						}else if(strlen($MobileNo) != 10){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Mobile number must be 10 digit long [Signup]']); exit();
						}

						if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Invalid email id detect [Signup]']); exit();
						}
						
						// City Validate in backend
						if($City != preg_replace("/[^A-Za-z0-9 ]/","",preg_replace("/^[ ]/", ' ',$City))){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'City name contains invalid characters [Signup]']); exit();

						}else if(substr($City,0,1) != preg_replace("/[^A-Z]/","",substr($City,0,1))){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'City name first letter must be capital [Signup]']); exit();

						}else if(strlen($City) < 2 || strlen($City) > 50){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'City name must be between 2 and 50 characters long [Signup]']); exit();
						}

						// State Validate in backend
						if($State != preg_replace("/[^A-Za-z ]/","",preg_replace("/^[ ]/", ' ',$State))){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'State name contains invalid characters [Signup]']); exit();

						}else if(substr($State,0,1) != preg_replace("/[^A-Z]/","",substr($State,0,1))){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'State name first letter must be capital [Signup]']); exit();

						}else if(strlen($State) < 2 || strlen($State) > 50){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'State name must be between 2 and 50 characters long [Signup]']); exit();
						}

						// Pincode Validate in backend
						if($Pincode != preg_replace("/[^0-9]/","",$Pincode)){
							#foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Pincode contains invalid characters [Signup]']); exit();

						}else if(strlen($Pincode) != 6){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Pincode must be 6 digit long [Signup]']); exit();
						}

						// Address Validate in backend
						if($Address != preg_replace("/[^A-Za-z0-9- _.,]/","",preg_replace("/^[-]/", '-',preg_replace("/^[_]/", '_',preg_replace("/^[.]/", '.',preg_replace("/^[ ]/", ' ',preg_replace("/^[,]/", ',',$Address))))))){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Address name contains invalid characters [Signup]']); exit();
						}else if(strlen($Address) < 3 || strlen($Address) > 50){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Address must be between 3 and 50 characters long [Signup]']); exit();
						}

						// Password Validate in backend
						if(strlen($Password) < 8 || strlen($Password) > 40){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Password must be between 8 and 40 characters long [Signup]']); exit();

						}

						// SecurityCode Validate in backend
						if($SecurityCode != preg_replace("/[^0-9]/","",$SecurityCode)){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Security code contains invalid characters [Signup]']); exit();

						}else if(strlen($SecurityCode) < 4 || strlen($SecurityCode) > 8){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Security code must be between 4 and 8 digit long [Signup]']); exit();
						}

						// Bio Validate in backend
						if($Bio != preg_replace("/[^A-Za-z- _,:.&)('@!|]/","",$Bio)){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Security code contains invalid characters [Signup]']); exit();

						}else if(substr($Bio,0,1) != preg_replace("/[^A-Z0-9]/","",substr($Bio,0,1))){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Bio first letter must be capital or Number [Signup]']); exit();

						}else if(strlen($Bio) < 40 || strlen($Bio) > 150){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Bio must be between 40 and 150 characters long [Signup]']); exit();
						}

						// ProfileImageSize validation
						if($ProfileImageSize > 2048){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Profile image size must be under 2Mb [Signup]']); exit();

						}else if($ProfileImageSize <= 0){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Profile image not found [Signup]']); exit();
						}

						if($MobileOTP != '123456'){
							AptPrint(['msg'=>'Invalid Mobile detect [Signup]']);
						}

						if($EmailOTP != '123456'){
							AptPrint(['msg'=>'Invalid Email detect [Signup]']);
						}

					}else{

						# AccountName Use as email or mobile for Subscriber
						if($Email == preg_replace("/[^0-9]/","",$Email)){
							$MobileNo = $Email; 
							$Email = '';
							// MobileNo  Validate in backend
							if($MobileNo != preg_replace("/[^0-9]/","",$MobileNo)){
								foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Mobile number contains invalid characters [Signup]']); exit();

							}else if(strlen($MobileNo) != 10){
								foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Mobile number must be 10 digit long [Signup]']); exit();
							}

							if($MobileOTP != '123456'){
								AptPrint(['msg'=>'Invalid Mobile detect [Signup]']);
							}
							$FullName = substr($MobileNo, 0, 30);
						}else{
							if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
								foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Invalid email id detect [Signup]']); exit();
							}

							if($EmailOTP != '123456'){
								AptPrint(['msg'=>'Invalid Email detect [Signup]']);
							}
							$FullName = substr($Email, 0, 30);
						}
						
						// Password Validate in backend
						if(strlen($Password) < 8 || strlen($Password) > 40){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Password must be between 8 and 40 characters long [Signup]']); exit();

						}
						
						$Gender = 'Unknown';

					}

					if($MobileNo == '7597078875' || $Email == 'topicster@gmail.com'){
						if($MobileNo != '7597078875' || $Email != 'topicster@gmail.com' || $AccountType != 'Partner'){
							if($MobileNo == '7597078875'){
								AptPrint(['msg'=>"You can not use this mobile number [Signup]"]); exit();
							}else if($Email == 'topicster@gmail.com'){
								AptPrint(['msg'=>"You can not use this email id [Signup]"]); exit();
							}else if($AccountType == 'Partner'){
								AptPrint(['msg'=>"Invalid Account Type detect [Signup]"]); exit();
							}
						}
						$AccountType = 'Main';
					} 

					Signup::EncryptData($AccountType,$AccountName,$DisplayName,$FullName,$Gender,$MobileNo,$Email,$City,$Pincode,$State,$Country,$Address,$Password,$SecurityCode,$Bio,$ProfileImageSize,$ProfileImageExt,$BrowserClientId1,$BrowserClientId2);
				}
				private static function EncryptData($AccountType,$AccountName,$DisplayName,$FullName,$Gender,$MobileNo,$Email,$City,$Pincode,$State,$Country,$Address,$Password,$SecurityCode,$Bio,$ProfileImageSize,$ProfileImageExt,$BrowserClientId1,$BrowserClientId2){

					$EPass ='T@K2YeD*4s_4q-F5m&R6@Wp7Wu2Xw#_-qJ8c^?#h6v_hW-3uY3q%h&4N#hV8k@Ca';

					// Create Hash Password
					$Password = hash_hmac("sha256",hash_hmac("sha512",$Password,$EPass,true),$EPass,false);

					// Create Hash Password
					$SecurityCode =  hash_hmac("sha256",hash_hmac("sha512",$SecurityCode,$EPass,true),$EPass,false);

					if($AccountType == 'Subscriber'){
						Signup::CkeckLoginAndAuthenticate($AccountType,$AccountName,$DisplayName,$FullName,$Gender,$MobileNo,$Email,$City,$Pincode,$State,$Country,$Address,$Password,$SecurityCode,$Bio,$ProfileImageSize,$ProfileImageExt,$BrowserClientId1,$BrowserClientId2,$EPass,$ResizeImageUploadMethod,$ResizeImageTargetLayer);
					}else{
						// Call profile_imageResize function
						Signup::profile_imageResize($AccountType,$AccountName,$DisplayName,$FullName,$Gender,$MobileNo,$Email,$City,$Pincode,$State,$Country,$Address,$Password,$SecurityCode,$Bio,$ProfileImageSize,$ProfileImageExt,$BrowserClientId1,$BrowserClientId2,$EPass);
					}
				}
				private static function profile_imageResize($AccountType,$AccountName,$DisplayName,$FullName,$Gender,$MobileNo,$Email,$City,$Pincode,$State,$Country,$Address,$Password,$SecurityCode,$Bio,$ProfileImageSize,$ProfileImageExt,$BrowserClientId1,$BrowserClientId2,$EPass){
					
					// Resize image function
					function imageResize($imageResourceId,$width,$height) {
						$targetWidth =200;
						$targetHeight =200;
						$targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
						imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);
						return $targetLayer;
					}
					
					// Validate and resize Signup image
					$sourceProperties = getimagesize($GLOBALS['ProfileImage_tmp']);
					$fileNewName = time();
					$folderPath = "upload/";
					$imageType = $sourceProperties[2];
					switch ($imageType) {
						
						case IMAGETYPE_PNG:  // If Signup image is PNG
							$imageResourceId = imagecreatefrompng($GLOBALS['ProfileImage_tmp']); 
							$ResizeImageUploadMethod = imagepng; // What type of method use to upload this type og image
							break;


						case IMAGETYPE_GIF:  // If Signup image is GIF
							$imageResourceId = imagecreatefromgif($GLOBALS['ProfileImage_tmp']);
							$ResizeImageUploadMethod = imagegif; // What type of method use to upload this type og image
							break;


						case IMAGETYPE_JPEG:  // If Signup image is JPEG
							$imageResourceId = imagecreatefromjpeg($GLOBALS['ProfileImage_tmp']);
							$ResizeImageUploadMethod = imagejpeg; // What type of method use to upload this type og image
							break;


						default:  // If Signup image is Not PNG, JPEG, GIF
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>"Invalid Image type detect [Signup]"]);
							break;
					}
					$ResizeImageTargetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);

					Signup::CkeckLoginAndAuthenticate($AccountType,$AccountName,$DisplayName,$FullName,$Gender,$MobileNo,$Email,$City,$Pincode,$State,$Country,$Address,$Password,$SecurityCode,$Bio,$ProfileImageSize,$ProfileImageExt,$BrowserClientId1,$BrowserClientId2,$EPass,$ResizeImageUploadMethod,$ResizeImageTargetLayer);
				}

				private static function CkeckLoginAndAuthenticate($AccountType,$AccountName,$DisplayName,$FullName,$Gender,$MobileNo,$Email,$City,$Pincode,$State,$Country,$Address,$Password,$SecurityCode,$Bio,$ProfileImageSize,$ProfileImageExt,$BrowserClientId1,$BrowserClientId2,$EPass,$ResizeImageUploadMethod,$ResizeImageTargetLayer){
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


					/******************************  Apt Library *******************************/
					require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoFetchWithAes/index.php");
					require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoUpdateWithAes/index.php");
					require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoDeleteWithAes/index.php");
					require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoInsertWithAes/index.php");
					require_once (RootPath."Library/Apt/Php/Script/AptPhpScriptDirDelete/index.php");
					require_once (RootPath."Library/Apt/Php/Script/AptPhpScriptDeleteTable/index.php");
					require_once (RootPath."Library/SiteComponents/IsLogin/index.php");
					
					# Is User Login
					$IsLogin = IsLogin(['PdoTopicsterMain'=>$PdoTopicsterMain,'PdoTopicsterPartner'=>$PdoTopicsterPartner,'EPass'=>$EPass,'CheckType'=>'ClientAndServer','LClientId1'=>$BrowserClientId1,'LClientId2'=>$BrowserClientId2]);
					
					if($IsLogin['code'] == 200){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Client Already Login [Already] [Login]','status'=>'warning']); exit();
					}
					
					Signup::DoSignup($AccountType,$AccountName,$DisplayName,$FullName,$Gender,$MobileNo,$Email,$City,$Pincode,$State,$Country,$Address,$Password,$SecurityCode,$Bio,$ProfileImageSize,$ProfileImageExt,$EPass,$ResizeImageUploadMethod,$ResizeImageTargetLayer,$PdoTopicsterMain,$PdoTopicsterPartner,$PdoTopicsterUserActivity);
				}

				private static function DoSignup($AccountType,$AccountName,$DisplayName,$FullName,$Gender,$MobileNo,$Email,$City,$Pincode,$State,$Country,$Address,$Password,$SecurityCode,$Bio,$ProfileImageSize,$ProfileImageExt,$EPass,$ResizeImageUploadMethod,$ResizeImageTargetLayer,$PdoTopicsterMain,$PdoTopicsterPartner,$PdoTopicsterUserActivity){
					date_default_timezone_set('Asia/Kolkata');
					$CurrentTime = time();

					// $Rejected = AptPdoFetchWithAes(['Condtion'=> "AccountType::::Partner::,::Status::::Reject::,::UpdateTime::::".($CurrentTime-86400)."::::Lower",'FetchData'=>'UserUrl::::UpdateTime::::AccountName', 'DbCon'=> $PdoTopicsterMain, 'TbName'=> 'account', 'EPass'=> $EPass,'FetchRowNo'=>'All']);
					// if($Rejected['code'] == 200){
					// 	foreach ($Rejected['msg'] as $key => $value){
					// 		$TmpUserUrl = $value->UserUrl;
					// 		$TmpAccountName = $value->AccountName;
					// 		$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$TmpUserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
					// 		$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$TmpUserUrl",'DbCon'=>$PdoTopicsterPartner,'DbName'=>DatabaseNamePrefix.'topicster_partner','DefaultCheckType'=>'ValLike']);
					// 		$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$TmpUserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
					// 		$DeletePartnerProfile = AptPhpScriptDirDelete(['Dir'=PartnerDir.$TmpAccountName"]);
					// 		$DeletePartnerFolder= AptPhpScriptDirDelete(['Dir'=>RootPath."Partner/$TmpAccountName"]);
					// 	}
					// }
					
					if($AccountType == 'Main'){
						$ValidateAccountType = AptPdoFetchWithAes(['Condtion'=> "AccountType::::Main", 'DbCon'=> $PdoTopicsterMain, 'TbName'=> 'account', 'EPass'=> $EPass]);

						if($ValidateAccountType['code'] == 200 || $ValidateAccountType['code'] == 404){
							if($ValidateAccountType['code'] == 200){
								foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'You can not use this mobile and email id [Signup]']); exit();
							}
						}else{
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error Code -0.1 [Signup]']); exit();
						}
					}

					/* 
					*@Method name rand_string
					*@Des Rndom string genrater
					*/
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
					
					if($AccountType != 'Subscriber'){
						$Number1 = floor((20 - strlen($CurrentTime))/2);
						$Number2 = (20 - strlen($CurrentTime)) - $Number1;
						while (true) {
							$UserUrl = "t".rand_string($Number1).$CurrentTime.rand_string($Number2);
							$UserUrl = $UserUrl.'_'.$UserUrl;
							$IsExistUserUrl = AptPdoFetchWithAes(['Condtion'=> "UserUrl::::$UserUrl::,::AccountName::::$AccountName", 'FetchData'=>'AccountName','DbCon'=> $PdoTopicsterMain, 'TbName'=> 'account', 'EPass'=> $EPass,'DefaultCheckFor'=>'Any']);

							if($IsExistUserUrl['code'] == 200 || $IsExistUserUrl['code'] == 404){
								if($IsExistUserUrl['code'] == 200){
									if($IsExistUserUrl['msg']->AccountName == $AccountName){
										foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
										AptPrint(['msg'=>'This Account Name already exist [Signup]']); exit();
										break;
									}
									continue;
								}
							}else{
								AptPrint(['msg'=>'Account Not Created Due to technical error Code -0 [Signup]']);
							}
							break;
						}
						
						$Profile = $UserUrl.'.'.$ProfileImageExt;

						if($AccountType == 'Main'){
						 	$IsVerifyed = "IsVerifyed::::true";
						 	$AccountAs = "AccountAs::::Main";
						}else if($AccountType == 'Main'){
							$IsVerifyed = "IsVerifyed::::false";
						 	$AccountAs = "AccountAs::::Partner";
						}else{
							$IsVerifyed = "IsVerifyed::::false";
						 	$AccountAs = "AccountAs::::Subscriber";
						}

						$InsertInAccount = AptPdoInsertWithAes(['InsertData'=>"Status::::Creating::,::UserUrl::::$UserUrl::,::AccountType::::$AccountType::,::AccountName::::$AccountName::,::$IsVerifyed::,::$AccountAs::,::Bio::::$Bio::,::CreateTime::::$CurrentTime::,::UpdateTime::::$CurrentTime::,::CreateDtls::::".serialize(['By'=>'Main','Rank'=>'1','Position'=>'Owner','Time'=>$CurrentTime])."::,::UpdateDtls::::".serialize(['By'=>'Main','Rank'=>'1','Position'=>'Owner','Time'=>$CurrentTime])."::,::Setting::::".serialize(['GeneralSetting'=>['DoComment'=>true,'PostWordLimit'=>'150-1200','CommentLimit'=>10,'PostLimit'=>'10/1']]),'DbCon'=>$PdoTopicsterMain,'TbName'=> 'account', 'EPass'=> $EPass]);
						if($InsertInAccount['code'] != 200){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error Code -1 [Signup]']);
						}
					}

					if($AccountType == 'Partner'){

						$PatnerAccountCreateTbName = $UserUrl."_account";
						$PatnerAccountCreate = $PdoTopicsterPartner->prepare("CREATE TABLE $PatnerAccountCreateTbName (Status VARCHAR(100) NOT NULL, UserUrl VARCHAR(100) NOT NULL PRIMARY KEY, FullName VARCHAR(100) NOT NULL, Email VARCHAR(100) NULL UNIQUE, Mobile VARCHAR(100) NOT NULL UNIQUE, Gender VARCHAR(100) NOT NULL, SocialAccount TEXT NULL, VerifyedAccount TEXT NULL, Position VARCHAR(100) NOT NULL, Profile VARCHAR(120) NOT NULL UNIQUE, Address VARCHAR(200) NOT NULL, Pincode VARCHAR(100) NOT NULL, City VARCHAR(100) NOT NULL, State VARCHAR(100) NOT NULL, Country VARCHAR(100) NOT NULL, CreateTime VARCHAR(100) NOT NULL, UpdateTime VARCHAR(100) NOT NULL, CreateDtls TEXT NOT NULL, UpdateDtls TEXT NOT NULL, OtpData TEXT NULL, SecurityCode VARCHAR(300) NOT NULL, Password VARCHAR(300) NOT NULL, ActiveTime VARCHAR(100) NULL, LoginTime VARCHAR(100) NULL, PassUpdateTime VARCHAR(100) NOT NULL, LoginData TEXT NULL, USetting VARCHAR(600) NULL UNIQUE, Setting MEDIUMTEXT NULL, StatusReason TEXT NULL, Signature VARCHAR(300) NULL UNIQUE)");
						if(!$PatnerAccountCreate->execute()){
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error  Code -2 [Signup]']);

						}

						$PatnerActivityForPartnerCreateTbName = $UserUrl."_activity_for_partner";
						$PatnerActivityForPartnerCreate = $PdoTopicsterPartner->prepare("CREATE TABLE $PatnerActivityForPartnerCreateTbName (Status VARCHAR(100) NOT NULL, ActivityId VARCHAR(100) NOT NULL PRIMARY KEY, Name VARCHAR(100) NOT NULL, Data VARCHAR(500) NOT NULL, UData VARCHAR(500) NULL UNIQUE, ActivityTime VARCHAR(100) NOT NULL,  USetting VARCHAR(600) NULL UNIQUE, Setting TEXT NULL, Signature VARCHAR(300) NULL UNIQUE)");
						if(!$PatnerActivityForPartnerCreate->execute()){
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterPartner,'DbName'=>DatabaseNamePrefix.'topicster_partner','DefaultCheckType'=>'ValLike']);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error  Code -3 [Signup]']);

						}

						$PatnerSettingCreateTbName = $UserUrl."_setting";
						$PatnerSettingCreate = $PdoTopicsterPartner->prepare("CREATE TABLE $PatnerSettingCreateTbName (Ukey VARCHAR(400) NULL UNIQUE, USetting VARCHAR(600) NULL UNIQUE, SKey TEXT NULL, Setting TEXT NULL)");
						if(!$PatnerSettingCreate->execute()){
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterPartner,'DbName'=>DatabaseNamePrefix.'topicster_partner','DefaultCheckType'=>'ValLike']);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error  Code -3 [Signup]']);

						}

						$UserActivityCreateTbName = $UserUrl."_activity";
						$UserActivityCreate = $PdoTopicsterUserActivity->prepare("CREATE TABLE $UserActivityCreateTbName (Status VARCHAR(100) NOT NULL, ActivityId VARCHAR(100) NOT NULL PRIMARY KEY, Name VARCHAR(100) NOT NULL, Data VARCHAR(500) NOT NULL, UData VARCHAR(500) NULL UNIQUE, ActivityTime VARCHAR(100) NOT NULL,  USetting VARCHAR(600) NULL UNIQUE, Setting TEXT NULL, Signature VARCHAR(300) NULL UNIQUE)");
						if(!$UserActivityCreate->execute()){
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterPartner,'DbName'=>DatabaseNamePrefix.'topicster_partner','DefaultCheckType'=>'ValLike']);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error  Code -3 [Signup]']);

						}
						
						$InsertInPartnerAccount = AptPdoInsertWithAes(['InsertData'=>"Status::::Active::,::UserUrl::::$UserUrl::,::FullName::::$FullName::,::Email::::$Email::,::Mobile::::$MobileNo::,::Gender::::$Gender::,::Position::::Owner::,::Profile::::$Profile::,::Address::::$Address::,::Pincode::::$Pincode::,::City::::$City::,::State::::$State::,::Country::::$Country::,::CreateTime::::$CurrentTime::,::UpdateTime::::$CurrentTime::,::CreateDtls::::".serialize(['By'=>$UserUrl,'Rank'=>'1','Position'=>'Owner','Time'=>$CurrentTime])."::,::UpdateDtls::::".serialize(['By'=>$UserUrl,'Rank'=>'1','Position'=>'Owner','Time'=>$CurrentTime])."::,::SecurityCode::::$SecurityCode::,::Password::::$Password::,::PassUpdateTime::::$CurrentTime",'DbCon'=>$PdoTopicsterPartner,'TbName'=> $PatnerAccountCreateTbName, 'EPass'=> $EPass]);
						if($InsertInPartnerAccount['code'] != 200){
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterPartner,'DbName'=>DatabaseNamePrefix.'topicster_partner','DefaultCheckType'=>'ValLike']);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error Code -4 [Signup]']);
						}

						if(!is_dir(PartnerDir)){
							if(!mkdir(PartnerDir)){
								$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
								$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterPartner,'DbName'=>DatabaseNamePrefix.'topicster_partner','DefaultCheckType'=>'ValLike']);
								$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
								foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Account can not create due to technical error  Code -4.01 [Signup]']);
							}
						}
						
						if(!file_exists(PartnerDir."index.php")){
							$PartnerDir = fopen(PartnerDir."index.php", "w");
							if(!$PartnerDir){
								$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
								$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterPartner,'DbName'=>DatabaseNamePrefix.'topicster_partner','DefaultCheckType'=>'ValLike']);
								$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
								$DeletePartnerProfile = AptPhpScriptDirDelete(['Dir'=>PartnerDir."index.php"]);
								foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Account can not create due to technical error  Code -4.02 [Signup]']);
							}
							$text = '<?php error_reporting(0); if ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") || $_SERVER["SERVER_PORT"] == 443) { $HeaderSecureType = "https://"; }else{ $HeaderSecureType = "http://"; } define("DomainName",  $HeaderSecureType.$_SERVER["HTTP_HOST"]); define("RootPath",  "../../"); define("PartnerUrl","'.$UserUrl.'"); require_once(RootPath."Library/SiteComponents/PartnerHomePage/index.php"); ?>';

							if(!fwrite($PartnerDir, $text)){
								$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
								$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterPartner,'DbName'=>DatabaseNamePrefix.'topicster_partner','DefaultCheckType'=>'ValLike']);
								$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
								$DeletePartnerProfile = AptPhpScriptDirDelete(['Dir'=>PartnerDir."index.php"]);
								foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Account can not create due to technical error  Code -4.03 [Signup]']);
							}
							fclose($PartnerDir);
						}
					
						$DeletePartnerProfile = AptPhpScriptDirDelete(['Dir'=>PartnerDir."$AccountName"]);
						if(!mkdir(PartnerDir."$AccountName")){
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterPartner,'DbName'=>DatabaseNamePrefix.'topicster_partner','DefaultCheckType'=>'ValLike']);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
							$DeletePartnerProfile = AptPhpScriptDirDelete(['Dir'=>PartnerDir."$AccountName"]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error  Code -4.4 [Signup]']);
						}
						
						$PartnerDir = fopen(PartnerDir."$AccountName/index.php", "w");
						if(!$PartnerDir){
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterPartner,'DbName'=>DatabaseNamePrefix.'topicster_partner','DefaultCheckType'=>'ValLike']);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
							$DeletePartnerProfile = AptPhpScriptDirDelete(['Dir'=>PartnerDir."$AccountName"]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error  Code -4.5 [Signup]']);
						}
						$text = '<?php error_reporting(0); if ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") || $_SERVER["SERVER_PORT"] == 443) { $HeaderSecureType = "https://"; }else{ $HeaderSecureType = "http://"; } define("DomainName",  $HeaderSecureType.$_SERVER["HTTP_HOST"]); define("RootPath",  "../../"); define("PartnerUrl","'.$UserUrl.'"); require_once(RootPath."Library/SiteComponents/PartnerHomePage/index.php"); ?>';

						if(!fwrite($PartnerDir, $text)){
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterPartner,'DbName'=>DatabaseNamePrefix.'topicster_partner','DefaultCheckType'=>'ValLike']);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
							$DeletePartnerProfile = AptPhpScriptDirDelete(['Dir'=>PartnerDir."$AccountName"]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error  Code -4.6 [Signup]']);
						}
						fclose($PartnerDir);
						
						if(!mkdir(PartnerDir."$AccountName/ProfileImage/")){
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterPartner,'DbName'=>DatabaseNamePrefix.'topicster_partner','DefaultCheckType'=>'ValLike']);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
							$DeletePartnerProfile = AptPhpScriptDirDelete(['Dir'=>PartnerDir."$AccountName"]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error  Code -4.7 [Signup]']);
						}
						$PartnerDir = fopen(PartnerDir."$AccountName/ProfileImage/index.php", "w");
						if(!$PartnerDir){
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterPartner,'DbName'=>DatabaseNamePrefix.'topicster_partner','DefaultCheckType'=>'ValLike']);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
							$DeletePartnerProfile = AptPhpScriptDirDelete(['Dir'=>PartnerDir."$AccountName"]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error  Code -4.8 [Signup]']);
						}
						$text = '<?php error_reporting(0); if ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") || $_SERVER["SERVER_PORT"] == 443) { $HeaderSecureType = "https://"; }else{ $HeaderSecureType = "http://"; } define("DomainName",  $HeaderSecureType.$_SERVER["HTTP_HOST"]); header("Location: " . DomainName); die(); exit();?>';

						if(!fwrite($PartnerDir, $text)){
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterPartner,'DbName'=>DatabaseNamePrefix.'topicster_partner','DefaultCheckType'=>'ValLike']);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
							$DeletePartnerProfile = AptPhpScriptDirDelete(['Dir'=>PartnerDir."$AccountName"]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error  Code -4.9 [Signup]']);
						}
						fclose($PartnerDir);

						if(!($ResizeImageUploadMethod($ResizeImageTargetLayer,PartnerDir."$AccountName/ProfileImage/$Profile"))){
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterPartner,'DbName'=>DatabaseNamePrefix.'topicster_partner','DefaultCheckType'=>'ValLike']);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
							$DeletePartnerProfile = AptPhpScriptDirDelete(['Dir'=>PartnerDir."$AccountName"]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error  Code -4.10 [Signup]']);
						}

						$UpdateAccountStatus = AptPdoUpdateWithAes(['Update'=>"Status::::Review",'Condtion'=>"UserUrl::::$UserUrl",'DbCon'=>$PdoTopicsterMain,'TbName'=>'account','EPass'=>$EPass]);
						if($UpdateAccountStatus['code'] == 200){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account create successfully [Signup]','status'=>'Success','code'=>200]);
						}else{
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterPartner,'DbName'=>DatabaseNamePrefix.'topicster_partner','DefaultCheckType'=>'ValLike']);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
							$DeletePartnerProfile = AptPhpScriptDirDelete(['Dir'=>PartnerDir."$AccountName"]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error  Code -5 [Signup]']);
						}
					
					}else if($AccountType == 'Main'){
						$InsertInMainAccount = AptPdoInsertWithAes(['InsertData'=>"Status::::Active::,::UserUrl::::$UserUrl::,::FullName::::$FullName::,::Email::::$Email::,::Mobile::::$MobileNo::,::Gender::::$Gender::,::Position::::Owner::,::Profile::::$Profile::,::Address::::$Address::,::Pincode::::$Pincode::,::City::::$City::,::State::::$State::,::Country::::$Country::,::CreateTime::::$CurrentTime::,::UpdateTime::::$CurrentTime::,::CreateDtls::::".serialize(['By'=>$UserUrl,'Rank'=>'1','Position'=>'Owner','Time'=>$CurrentTime])."::,::UpdateDtls::::".serialize(['By'=>$UserUrl,'Rank'=>'1','Position'=>'Owner','Time'=>$CurrentTime])."::,::SecurityCode::::$SecurityCode::,::Password::::$Password::,::PassUpdateTime::::$CurrentTime",'DbCon'=>$PdoTopicsterMain,'TbName'=> 'main_account', 'EPass'=> $EPass]);
						if($InsertInMainAccount['code'] != 200){
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error Code -7 [Signup]']);
						}

						$UserActivityCreateTbName = $UserUrl."_activity";
						$UserActivityCreate = $PdoTopicsterUserActivity->prepare("CREATE TABLE $UserActivityCreateTbName (Status VARCHAR(100) NOT NULL, ActivityId VARCHAR(100) NOT NULL PRIMARY KEY, Name VARCHAR(100) NOT NULL, Data VARCHAR(500) NOT NULL, UData VARCHAR(500) NULL UNIQUE, ActivityTime VARCHAR(100) NOT NULL,  USetting VARCHAR(600) NULL UNIQUE, Setting TEXT NULL, Signature VARCHAR(300) NULL UNIQUE)");
						if(!$UserActivityCreate->execute()){
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'main_account', 'EPass'=> $EPass]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error  Code -3 [Signup]']);

						}
						// Library/SiteComponents/AccountData/Profile/Main/
						if(!is_dir(MainDir)){
							if(!mkdir(MainDir)){
								$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
								$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'main_account', 'EPass'=> $EPass]);
								$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
								foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Account can not create due to technical error  Code -3.01 [Signup]']);
							}
						}
						
						if(!file_exists(MainDir."index.php")){
							$PartnerDir = fopen(MainDir."index.php", "w");
							if(!$PartnerDir){
								$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
								$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'main_account', 'EPass'=> $EPass]);
								$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
								$DeletePartnerProfile = AptPhpScriptDirDelete(['Dir'=>MainDir."index.php"]);
								foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Account can not create due to technical error  Code -3.02 [Signup]']);
							}
							$text = '<?php error_reporting(0); if ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") || $_SERVER["SERVER_PORT"] == 443) { $HeaderSecureType = "https://"; }else{ $HeaderSecureType = "http://"; } define("DomainName",  $HeaderSecureType.$_SERVER["HTTP_HOST"]); define("RootPath",  "../../"); define("PartnerUrl","'.$UserUrl.'"); require_once(RootPath."Library/SiteComponents/PartnerHomePage/index.php"); ?>';

							if(!fwrite($PartnerDir, $text)){
								$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
								$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'main_account', 'EPass'=> $EPass]);
								$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
								$DeletePartnerProfile = AptPhpScriptDirDelete(['Dir'=>MainDir."index.php"]);
								foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Account can not create due to technical error  Code -3.03 [Signup]']);
							}
							fclose($PartnerDir);
						}
						if(!is_dir(MainDir."ProfileImage/")){
							if(!mkdir(MainDir."ProfileImage/")){
								$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
								$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'main_account', 'EPass'=> $EPass]);
								$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
								foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Account can not create due to technical error  Code -3.04 [Signup]']);
							}
						}
						if(!file_exists(MainDir."ProfileImage/index.php")){
							$PartnerDir = fopen(MainDir."ProfileImage/index.php", "w");
							if(!$PartnerDir){
								$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
								$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'main_account', 'EPass'=> $EPass]);
								$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
								$DeletePartnerProfile = AptPhpScriptDirDelete(['Dir'=>MainDir."ProfileImage/index.php"]);
								foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Account can not create due to technical error  Code -3.05 [Signup]']);
							}
							$text = '<?php error_reporting(0); if ((!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") || $_SERVER["SERVER_PORT"] == 443) { $HeaderSecureType = "https://"; }else{ $HeaderSecureType = "http://"; } define("DomainName",  $HeaderSecureType.$_SERVER["HTTP_HOST"]); header("Location: " . DomainName); die(); exit();?>';

							if(!fwrite($PartnerDir, $text)){
								$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
								$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'main_account', 'EPass'=> $EPass]);
								$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
								$DeletePartnerProfile = AptPhpScriptDirDelete(['Dir'=>MainDir."ProfileImage/index.php"]);
								foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Account can not create due to technical error  Code -3.06 [Signup]']);
							}
							fclose($PartnerDir);
						}

						if(!($ResizeImageUploadMethod($ResizeImageTargetLayer,MainDir."ProfileImage/$Profile"))){
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'main_account', 'EPass'=> $EPass]);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
							$DeletePartnerProfile = AptPhpScriptDirDelete(['Dir'=>MainDir."ProfileImage/$Profile"]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error  Code -3.07 [Signup]']);
						}

						$UpdateAccountStatus = AptPdoUpdateWithAes(['Update'=>"Status::::Active",'Condtion'=>"UserUrl::::$UserUrl",'DbCon'=>$PdoTopicsterMain,'TbName'=>'account','EPass'=>$EPass]);
						if($UpdateAccountStatus['code'] == 200){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account create successfully [Signup]','status'=>'Success','code'=>200]);
						}else{
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'main_account', 'EPass'=> $EPass]);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
							$DeletePartnerProfile = AptPhpScriptDirDelete(['Dir'=>MainDir."ProfileImage/$Profile"]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error  Code -8 [Signup]']);
						}
					}else if($AccountType == 'Subscriber'){
						if($Email != ''){
							$InsertInSubscriberAccount = "Email::::$Email::,::";
							$TmpChk = 'Email'; $TmpChkVal = $Email;
						}else if($MobileNo != ''){
							$InsertInSubscriberAccount = "Mobile::::$MobileNo::,::";
							$TmpChk = 'Mobile'; $TmpChkVal = $MobileNo;
						}else{
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error  Code -10 [Signup]']);
						}
						$Number1 = floor((32 - strlen($CurrentTime))/2);
						$Number2 = (32 - strlen($CurrentTime)) - $Number1;
						
						while (true) {
							$UserUrl = "subscriber_".rand_string($Number1).$CurrentTime.rand_string($Number2);
							$IsAccountExist = AptPdoFetchWithAes(['Condtion'=> $InsertInSubscriberAccount."UserUrl::::$UserUrl", 'FetchData'=>$TmpChk,'DbCon'=> $PdoTopicsterMain, 'TbName'=> 'subscriber_account', 'EPass'=> $EPass,'DefaultCheckFor'=>'Any']);
							if($IsAccountExist['code'] == 200 || $IsAccountExist['code'] == 404){
								if($IsAccountExist['code'] == 200){
									if($IsAccountExist['msg']->$TmpChk == $TmpChkVal){
										foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ if($SetVarKey != 'TmpChk' && $SetVarKey != 'TmpChkVal'){ unset($$SetVarKey); }} unset($SetVarKey,$SetVarVal);
										AptPrint(['msg'=>"$TmpChk ($TmpChkVal) already exist [Signup]"]); exit();
										break;
									}
									continue;
								}
							}else{
								AptPrint(['msg'=>'Account Not Created Due to technical error Code -11 [Signup]']);
							}
							break;
						}
						$InsertInSubscriberAccount = AptPdoInsertWithAes(['InsertData'=> $InsertInSubscriberAccount."Status::::Pending::,::UserUrl::::$UserUrl::,::FullName::::$FullName::,::Gender::::$Gender::,::CreateTime::::$CurrentTime::,::UpdateTime::::$CurrentTime::,::CreateDtls::::".serialize(['By'=>'Main','Rank'=>'1','Position'=>'Owner','Time'=>$CurrentTime])."::,::UpdateDtls::::".serialize(['By'=>'Main','Rank'=>'1','Position'=>'Owner','Time'=>$CurrentTime])."::,::Password::::$Password::,::PassUpdateTime::::$CurrentTime",'DbCon'=>$PdoTopicsterMain,'TbName'=> 'subscriber_account', 'EPass'=> $EPass]);
						#AptPrint(['msg'=>json_encode($InsertInSubscriberAccount)]);
						if($InsertInSubscriberAccount['code'] != 200){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error Code -12 [Signup]']);
						}

						$UserActivityCreateTbName = $UserUrl."_activity";
						$UserActivityCreate = $PdoTopicsterUserActivity->prepare("CREATE TABLE $UserActivityCreateTbName (Status VARCHAR(100) NOT NULL, ActivityId VARCHAR(100) NOT NULL PRIMARY KEY, Name VARCHAR(100) NOT NULL, Data VARCHAR(500) NOT NULL, UData VARCHAR(500) NULL UNIQUE, ActivityTime VARCHAR(100) NOT NULL,  USetting VARCHAR(600) NULL UNIQUE, Setting TEXT NULL, Signature VARCHAR(300) NULL UNIQUE)");
						if(!$UserActivityCreate->execute()){
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
							$DeleteInSubscriberAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'subscriber_account', 'EPass'=> $EPass]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error  Code -3 [Signup]']);

						}

						$UpdateAccountStatus = AptPdoUpdateWithAes(['Update'=>"Status::::Active",'Condtion'=>"UserUrl::::$UserUrl",'DbCon'=>$PdoTopicsterMain,'TbName'=>'subscriber_account','EPass'=>$EPass]);
						if($UpdateAccountStatus['code'] == 200){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account create successfully [Signup]','status'=>'Success','code'=>200]);
						}else{
							$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
							$DeleteInSubscriberAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'subscriber_account', 'EPass'=> $EPass]);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$UserUrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account can not create due to technical error  Code -8 [Signup]']);
						}
					}else{
						$DeleteInAccount = AptPdoDeleteWithAes(['Condtion'=> "UserUrl::::$UserUrl", 'DbCon'=> $PdoTopicsterMain, 'TbName'=>'account', 'EPass'=> $EPass]);
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Invalid Account Type detect Code -13 [Signup]']);
					}
				}
			}
			
			// Call classname public function 
			Signup::ValidateData($_POST);
		}else{
			foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
			AptPrint(['msg'=>'Invalid Token! Please refresh page to regenerate Token [Signup]']);
		}
	}else{
		AptPrint(['msg'=>'Authentication failed [Signup]']);
		header("Location: " . RootPath . "Library/SiteComponents/PageNotFound/index.php"); die();
	}
}else{
	AptPrint(['msg'=>'Invalid data sent [Signup]']);
	header("Location: " . RootPath . "Library/SiteComponents/PageNotFound/index.php"); die();
}	
?>