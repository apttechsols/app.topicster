<?php
   define('RootPath', '../../../');
   //header("Location: " . RootPath . "Library/SiteComponents/PageNotFound/index.php"); die();
   require_once (RootPath."Library/Apt/Php/AptPrint/index.php");
   //AptPrint(['msg'=>'Authentication failed [Lab]']); exit();
   define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
   define('DatabaseAccessCode', 'T@6Ug5t_u56t*P_B&B@Kl7U_v8N_xN7b_Z&B@Kl75t_u56@6Ug5t_u56t*P_B&Ap');
   $EPass = 'T@K2YeD*4s_4q-F5m&R6@Wp7Wu2Xw#_-qJ8c^?#h6v_hW-3uY3q%h&4N#hV8k@Ca';
   define("HostedDomainName",  'localhost');
    define("DatabaseNamePrefix",  'topicst1_');
    define('AptSafeTextDecodeEWords',array('$','=','(',')','[',']','*','/','<','>','~','!','@','^','-','_','+','|',':','.',',','`'));
    define('AptSafeTextDecodeEWordsAll',array('$','=','(',')','[',']','?','*','/','{','}','<','>','~','!','@','%','^','-','_','+','|',':','.',',','`'));
    define('AptSafeTextDecodeEWordsAllEncode',array('$','=','(',')','[',']','?','*','/','{','}','<','>','~','!','@','%','^','-','_','+','|',':','.',',','`'));
    
   // DbCon -> ($PdoTopicsterPostData)
   require_once (RootPath."Library/Database/SQL/Pdo/topicster_post_data.php");
   // DbCon -> ($PdoTopicsterPartner)
   require_once (RootPath."Library/Database/SQL/Pdo/topicster_partner.php");
   // DbCon -> ($PdoTopicsterMain)
   require_once (RootPath."Library/Database/SQL/Pdo/topicster_main.php");
    /******************************  Apt Library *******************************/
    require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoFetchWithAes/index.php");
    require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoUpdateWithAes/index.php");
    require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoDeleteWithAes/index.php");
    require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoInsertWithAes/index.php");
    require_once (RootPath."Library/Apt/Php/Script/AptPhpScriptDirDelete/index.php");
    require_once (RootPath."Library/Apt/Php/Script/AptPhpScriptDeleteTable/index.php");
    require_once (RootPath."Library/Apt/Php/Script/EncodeAndEncrypt/AptEncodeAndEncryptWithAes.php");
    require_once (RootPath."Library/SiteComponents/IsLogin/index.php");

   require_once (RootPath."Library/Apt/Php/Script/AptSafeText/index.php");
   require_once (RootPath."Library/Apt/Php/Script/AptUtf8EncodeAndDecode/index.php");

   /******************************  Php Library *******************************/
   require_once (RootPath."Library/Php/Script/GoogleTranslater/index.php");
   
   //foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);

   $Result = GoogleTranslate(['Target'=>'en','String'=>'Corona, Covid-19 Latest News Live Updates: देश में कोरोना की रफ्तार थम नहीं रही है. पिछले 24 घंटे में 57 हजार से ज्यादा नए मामले सामने आए हैं और 764 लोगों की मौत हुई है. वहीं, कुल आंकड़ा 17 लाख के करीब पहुंच चुका है. भारत में इस महामारी से मौत का आंकड़ा 36.5 हजार के पार जा चुका है. वहीं विश्व भर में इस वायरस ने पौने दो करोड़ लोगों को अपना शिकार बनाया है. इसमें से 6.78 लाख लोग अपनी जान गंवा चुके हैं. कोरोना से जुड़े हर अपडेट के लिए इस पेज को रिफ्रेश करते रहें.']);
   AptPrint(['msg'=>$Result]);
?>