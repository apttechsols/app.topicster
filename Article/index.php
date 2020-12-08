<?php
	error_reporting(0);
	error_reporting(0);
	define('RootPath', '../');
    define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
    define('DatabaseAccessCode', 'T@6Ug5t_u56t*P_B&B@Kl7U_v8N_xN7b_Z&B@Kl75t_u56@6Ug5t_u56t*P_B&Ap');
    $EPass = 'T@K2YeD*4s_4q-F5m&R6@Wp7Wu2Xw#_-qJ8c^?#h6v_hW-3uY3q%h&4N#hV8k@Ca';
	require(RootPath."Library/SiteComponents/FrontEndControlPage/index.php");
	
	#$StoreFontFamily = ["cursive","serif","sans-serif","Arial","Helvetica"];
	$StoreFontFamily = ["serif"];
	$FonFamily = $StoreFontFamily[rand(0,4)];
	$RandMsg = ['Hello!','Hi!','Welcome!','Namaskar!','Howdy!','Good day!',"What's up!",'Hey!'];
	$RandMsg = $RandMsg[rand(0,7)];
	// DbCon -> ($PdoTopicsterPostData)
	require_once (RootPath."Library/Database/SQL/Pdo/topicster_post_data.php");
	// DbCon -> ($PdoTopicsterPartner)
	require_once (RootPath."Library/Database/SQL/Pdo/topicster_partner.php");
	// DbCon -> ($PdoTopicsterMain)
	require_once (RootPath."Library/Database/SQL/Pdo/topicster_main.php");

	require_once (RootPath."Library/Apt/Php/Script/AptSafeText/index.php");
	require_once (RootPath."Library/Apt/Php/Script/AptUtf8EncodeAndDecode/index.php");

	/******************************  Php Library *******************************/
	require_once (RootPath."Library/Php/Script/GoogleTranslater/index.php");

	if(strlen($_GET['url']) != 15 || $_GET['url'] != preg_replace('/[^A-Za-z0-9]/', '', $_GET['url'])){
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'Invalid Url detect [NewArticleRequestBackend]','status'=>'Error']); exit();
	}
	
	$GetArticle = AptPdoFetchWithAes(['Condtion'=> "Url::::".$_GET['url'],'FetchData'=>'PostNumber::,::nenc::::Status::::Title::::ModTitle::::PublishTime::::MetaDescription::::Description::::Author::::Keyword::::FUrl::::ImageUrl', 'DbCon'=> $PdoTopicsterPostData, 'TbName'=> 'post', 'EPass'=> $EPass]);
	if($GetArticle['code'] == 200){
		$GetAuthorDtls = AptPdoFetchWithAes(['Condtion'=> "UserUrl::::".explode('_', $GetArticle['msg']->Author)[0].'_'.explode('_', $GetArticle['msg']->Author)[1],'FetchData'=>'FullName', 'DbCon'=> $PdoTopicsterPartner, 'TbName'=> explode('_', $GetArticle['msg']->Author)[0].'_'.explode('_', $GetArticle['msg']->Author)[0].'_account', 'EPass'=> $EPass]);
		if($GetAuthorDtls['code'] == 200){
			$AuthorName = $GetAuthorDtls['msg']->FullName;
		}else{
			foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
			AptFullScreenMsg(['msg'=>"Author is removed, So we can not show this author's articles"]); exit();
		}
		$ArticleUrl = 'https://'.$_SERVER['HTTP_HOST'].'/Article?'.$GetArticle['msg']->FUrl;
		$ThumbnailImageRow =  unserialize($GetArticle['msg']->ImageUrl)[0];
		$ThumbnailImage = str_replace('<PredifineKeyword>PredifinePartnerMediaFilePath<PredifineKeyword>', 'https://'.$_SERVER['HTTP_HOST'].'/PartnerMedia/',$ThumbnailImageRow);
		list($ThumbnailImageWidth, $ThumbnailImageHeight, $ThumbnailImageType, $ThumbnailImageAttr) = getimagesize(str_replace('<PredifineKeyword>PredifinePartnerMediaFilePath<PredifineKeyword>', RootPath.'PartnerMedia/',$ThumbnailImageRow));
	}else if($GetArticle['code'] == 404){
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'Article is not available']); exit();
	}else{
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'Sorry! We can not fetched Article due to technical error']); exit();
	}
	//AptFullScreenMsg(['msg'=>preg_replace('/\s+/', ' ', AptSafeTextDecode(['Str'=>$GetArticle['msg']->Keyword,'EWords'=>['$','=','(',')','[',']','?','*','/','{','}','<','>']])['msg'])]);
	
	#AptFullScreenMsg(['msg'=>GoogleTranslate(['Target'=>'en','String'=>$GetArticle['msg']->Title])['msg']]);
	define('PageSetting', ['BrowserTitle'=>AptSafeTextDecode(['Str'=>$GetArticle['msg']->Title,'EWords'=>['$','=','(',')','[',']','?','*','/','{','}','<','>']])['msg'].' : Topicster','PageTitle'=>$GetArticle['msg']->Title,'keywords'=>str_replace(array("\n", "\r"), '', preg_replace('!\s+!',' ',trim(AptSafeTextDecode(['Str'=>$GetArticle['msg']->Keyword,'EWords'=>['$','=','(',')','[',']','?','*','/','{','}','<','>']])['msg'],', '))),'description'=>preg_replace('!\s+!',' ',AptSafeTextDecode(['Str'=>$GetArticle['msg']->MetaDescription,'EWords'=>['$','=','(',')','[',']','?','*','/','{','}','<','>']])['msg']),'og_url'=>$ArticleUrl,'ThumbnailImage'=>[['Image'=>$ThumbnailImage,'Width'=>$ThumbnailImageWidth,'Height'=>$ThumbnailImageHeight]],'og_type'=>'article','robots'=>'INDEX, FOLLOW']);
	require(RootPath."Library/SiteComponents/Header/index.php");
?>
<!-- <!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">
		<title><?php echo PageSetting['BrowserTitle'] != '' ? PageSetting['BrowserTitle'] : 'Topicster'; ?></title>
		<meta name="title" content="<?php echo $GetArticle['msg']->Title; ?>">
		<meta name="keywords" content="<?php echo str_replace(array("\n", "\r"), '', preg_replace('!\s+!',' ',trim(AptSafeTextDecode(['Str'=>$GetArticle['msg']->Keyword,'EWords'=>['$','=','(',')','[',']','?','*','/','{','}','<','>']])['msg'],', '))); ?>" />
		<meta name="news_keywords" content="<?php echo str_replace(array("\n", "\r"), '', preg_replace('!\s+!',' ', trim(AptSafeTextDecode(['Str'=>$GetArticle['msg']->Keyword,'EWords'=>['$','=','(',')','[',']','?','*','/','{','}','<','>']])['msg'],', '))); ?>" />
		<meta name="description" content="<?php echo preg_replace('!\s+!',' ',AptSafeTextDecode(['Str'=>$GetArticle['msg']->MetaDescription,'EWords'=>['$','=','(',')','[',']','?','*','/','{','}','<','>']])['msg']); ?>" />
	    <meta property="og:site_name" content="<?php echo HostedSiteName; ?>"/>
	    <meta property="og:url" content="<?php echo $ArticleUrl; ?>">
	    <meta property="og:title" content="<?php echo $GetArticle['msg']->Title; ?>"/>
	    <?php if($ThumbnailImage != ''){
	    	echo "<meta property='og:image' content='$ThumbnailImage'/>\n";
	    	echo "<meta property='og:image:width' content='$ThumbnailImageWidth'/>\n";
	    	echo "<meta property='og:image:height' content='$ThumbnailImageHeight'/>\n";
	    } ?>

	    <meta property="og:description" content="<?php echo preg_replace('!\s+!',' ',AptSafeTextDecode(['Str'=>$GetArticle['msg']->MetaDescription,'EWords'=>['$','=','(',')','[',']','?','*','/','{','}','<','>']])['msg']); ?>"/>

	    <meta property="al:web:url" content="<?php echo $ArticleUrl; ?>"/>

	    <meta property="og:type" content="article">
	    <?php foreach (explode(', ', preg_replace('!\s+!',' ',trim(AptSafeTextDecode(['Str'=>$GetArticle['msg']->Keyword,'EWords'=>['$','=','(',')','[',']','?','*','/','{','}','<','>']])['msg'],', '))) as $key => $value) {
	    	echo " <meta property='og:article:tag' content='".str_replace(array("\n", "\r"), '', $value)."'>\n";
	    } ?>

	    <meta name="twitter:card" content="summary_large_image"/>
		<meta name="twitter:site" content="@Topicster"/>
		<meta name="twitter:creator" content="@Topicster"/>
		<meta name="twitter:title" content="<?php echo $GetArticle['msg']->Title; ?>"/>
		<meta name="twitter:description" content="<?php echo preg_replace('!\s+!',' ',AptSafeTextDecode(['Str'=>$GetArticle['msg']->MetaDescription,'EWords'=>['$','=','(',')','[',']','?','*','/','{','}','<','>']])['msg']); ?>"/>
		<meta name="twitter:image" content="<?php echo $ThumbnailImage; ?>"/>

		<?php if(PageSetting['css'] != ''){
			if(is_array(PageSetting['css'])){
				foreach (PageSetting['css'] as $value) { ?>
					<link rel="stylesheet" type="text/css" href="<?php echo $value; ?>.css" media="screen">
				<?php }
			}else{ ?>
				<link rel="stylesheet" type="text/css" href="<?php echo PageSetting['css']; ?>.css" media="screen">
			<?php }
		} ?>
		<style>
			header{
				width: 100%!important;
				background: #fff;
				z-index: 10;
				<?php if(HeaderSetting['HeaderScroll'] == 'off'){ ?>
					position: fixed;
				<?php } ?>
			}
			header *{
				box-sizing: unset;
				text-decoration: none;
			}
			body {
			    font-family: <?php echo $FonFamily; ?>!important;
			    margin: 0px;
				padding: 0px;
				width: 100%;
				overflow-x: hidden;
				cursor: default;
			}
			li{
				line-height: 1.5em;
				color: #585858;
				font-weight: 700;
				list-style-type: none;
			}
			.HeaderPrimaryMenu-dropdown-content{
				margin-top: -5px;
			}
			<?php if(HeaderSetting['HeaderLogoStyle'] == 'LeftInTopMenu'){ ?>
				.HeaderSiteName{
					font-size: 25px;
					font-weight: bold;
					margin: 0px 20px;
				}
				<?php if(HeaderSetting['HeaderScroll'] == 'off'){ ?>
				.HeaderScrollOff{
					height: 80px;
				}
				<?php }
			}else{ ?>
			.HeaderSiteName{
				font-size: 36px;
				font-weight: bold;
				padding: 12px 0px 18px 0px;
			}
				<?php if(HeaderSetting['HeaderScroll'] == 'off'){ ?>
				.HeaderScrollOff{
					height: 156.4px;
				}
				<?php }
			} ?>
			.HeaderDayDateBox{
				height:20px;
				width:calc(100% - 10px);
				background-color: #0c4da2;
				padding: 5px;
				display: flex;
				color: #fff;
			}
			.HeaderTopMenuTimeImage{
				padding: 0px 10px;
			}
			<?php if(HeaderSetting['HeaderLogoStyle'] == 'LeftInTopMenu'){ ?>

			<?php }else{ ?>
			.HeaderLogoContainer{
			    padding: 0px 10px;
			    max-width: calc(100% - 20px);
			}

			.HeaderLogoContainer h1{
				color: #0c4da2;
			}
			.HeaderLogoContainer p{
				font:bold;
				margin:-10px 5px;
			}
			<?php } ?>
			.HeaderMenuBox{
				background-color: #0c4da2;
			    width: calc(100% - 20px);
			    font-size: 14px;
			    padding: 0px 10px;
			    height: 50px;
			    display: grid;
			    grid-template-columns: 1fr 100px;
			    overflow: hidden;
			    <?php if(HeaderSetting['HeaderLogoStyle'] == 'LeftInTopMenu'){ ?>
			    	 margin: 0px 0px 0px 0px;
			    <?php }else{ ?>
			    	 margin: 20px 0px 0px 0px;
			    <?php } ?>
			}

			.HeaderPrimaryMenu {
			  	overflow: hidden;
			  	color: #fff;
			    font-weight: bold;
			    overflow: hidden;
			    width: 100%;
			    /*z-index: 10;*/
			}

			.HeaderPrimaryMenu a {
			  float: left;
			  font-size: 16px;
			  color: white;
			  text-align: center;
			  padding: 14px 16px;
			  text-decoration: none!important;
			}
			.HeaderPrimaryMenu a:hover{
				color: white;
			}

			.HeaderPrimaryMenu-dropdown {
			  float: left;
			  overflow: hidden;
			}

			.HeaderPrimaryMenu-dropdown .HeaderPrimaryMenu-dropbtn {
			  font-size: 16px;  
			  border: none;
			  outline: none;
			  color: white;
			  padding: 14px 16px;
			  background-color: inherit;
			  font-family: inherit;
			  margin: 0;
			  font-weight: bold;
			}

			.HeaderPrimaryMenu a:hover, .HeaderPrimaryMenu-dropdown:hover .HeaderPrimaryMenu-dropbtn {
			  background-color: red;
			}

			.HeaderPrimaryMenu-dropdown-content {
			  display: none;
			  position: absolute;
			  background-color: #f9f9f9;
			  min-width: 160px;
			  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			  z-index: 1;
			}

			.HeaderPrimaryMenu-dropdown-content a {
			  float: none;
			  color: black;
			  padding: 12px 16px;
			  text-decoration: none;
			  display: block;
			  text-align: left;
			}

			.HeaderPrimaryMenu-dropdown-content a:hover {
			  background-color: #ddd!important;
			  color: #000!important;
			}

			.HeaderPrimaryMenu-dropdown:hover .HeaderPrimaryMenu-dropdown-content {
			  display: block;
			}

			.DesktopMenuIcon{
		 	 	display: block;
		 	}

			.MobMenuIcon{
				display: none;
			}

			.MobMenuIcon-Right{
				float: right!important;
			}

			.HeaderPrimaryMenu-SearchBarBox{
				display: grid;
				grid-template-columns: 1fr 70px 50px;
				color: #fff;
			}

			.HeaderPrimaryMenuSearchBar{
				height: 25px;
				width: calc(100% + 58px);
				margin: 5px;
				padding: 5px 80px 5px 5px;
				border-radius: 5px;
				color: #6e6d6d;
			}

			.HeaderPrimaryMenuSearchBarIcon{
				font-size: 25px;
				cursor: pointer;
				background: #aaa;
				padding: 3px 0px 0px 0px;
				border: 2px solid;
				margin: 6px 0px 0px 78px;
				height: 31px;
				width: 70px;
				text-align: center;
				border-radius: 5px;
			}

			.HeaderPrimaryMenuSearchBarIcon:hover{
				color: red;
			}

			.HeaderPrimaryMenuSearchBarCloseIcon{
				font-size: 30px;
				border: 2px solid;
				width: 45px;
				height: 33px;
				margin: 6px 0px 0px 90px;
				text-align: center;
				border-radius: 5px;
				padding: 0px 3px 1px 1px;
				cursor: pointer;
			}

			.HeaderPrimaryMenuSearchBarCloseIcon:hover{
				color: red;
			}

			.HeaderUPDATES{
				background-color:#fff;
				display: grid;
				grid-template-columns: 5fr .1fr .1fr;
				grid-column-gap: 5px;
				border: 1px solid darkgrey; 
			}

			/************ responsive code ************************/

			@media (max-width:1024px){
				<?php if(HeaderSetting['HeaderLogoStyle'] == 'LeftInTopMenu'){ ?>
					.HeaderSiteName{
						margin: 0px auto;
					}
					<?php if(HeaderSetting['HeaderScroll'] == 'off'){ ?>
					.HeaderScrollOff{
						height: 80px;
					}
					<?php }
				}else{ ?>
				  	.HeaderLogoContainer{
						text-align:center; 
					}
					<?php if(HeaderSetting['HeaderScroll'] == 'off'){ ?>
					.HeaderScrollOff{
						height: 156.4px;
					}
					<?php }
				} ?>
			  	.HeaderPrimaryMenu-Left{
			 	 	display:none;
			 	 	max-width: 380px;
					background: gray;
					position: absolute;
					margin: 46px 0px 0px -10px;
					padding: 0px 10px;
			 	}
			 	.DesktopMenuIcon{
			 	 	display: none;
			 	}

				.MobMenuIcon{
					display: block;
				}

				.HeaderPrimaryMenu-Left a{
					width: calc(100% - 36px);
					text-align: left;
				}
				.HeaderMenuBox{
					grid-template-columns: 1fr;
					height: auto;
				}
				.HeaderPrimaryMenu-dropdown{
					width: 100%;
				}
				.HeaderPrimaryMenu-dropbtn{
					width: 100%;
					text-align: left;
				}
				.HeaderPrimaryMenu-dropdown-content{
					width: 100%;
					overflow: hidden;
				}
				.HeaderPrimaryMenu-SearchBarBox{
					grid-template-columns: 1fr 139px 50px;
				}
				.HeaderPrimaryMenuSearchBar{
					width: calc(100% + 27px);
				}
				.HeaderPrimaryMenuSearchBarIcon{
					margin: 6px 0px 0px 47px;
				}
				.HeaderPrimaryMenuSearchBarCloseIcon{
					margin: 6px 0px 0px -10px;
				}
			}

			@media (max-width:480px){
				.HeaderPrimaryMenu-SearchBarBox{
					grid-template-columns: 1fr 139px 29px;
					width: 100vw;
					margin: 0px 0px 0px -13px;
				}
				.HeaderPrimaryMenuSearchBar{
					width: calc(100% + 55px);
					padding: 5px 45px 5px 5px;
				}
				.HeaderPrimaryMenuSearchBarIcon{
					width: 40px;
					margin: 6px 0px 0px 70px;
				}
				.HeaderPrimaryMenuSearchBarCloseIcon{
					width: 30px;
					margin: 6px 0px 0px -24px;
				}
			}

			/*********** Spin Loader Css ************/
			.spin_loader_round {
				height: 32px;
				width: 32px;
			}
			.spin_loader_round::after {
				content: "";
				display: block;
				position: absolute;
				top: 0; left: 0;
				bottom: 0; right: 0;
				margin: auto;
				width: 12px;
				height: 12px;
				top: 0; left: 0;
				bottom: 0; right: 0;
				margin: auto;
				background: #FFF;
				border-radius: 50%;
				-webkit-animation: spin_loader_round-1 2s cubic-bezier(0.770, 0.000, 0.175, 1.000) infinite;
				animation: spin_loader_round-1 2s cubic-bezier(0.770, 0.000, 0.175, 1.000) infinite;
			}
			@-webkit-keyframes spin_loader_round-1 {
				0%   { -webkit-transform: scale(0); opacity: 0; }
				50%  { -webkit-transform: scale(1); opacity: 1; }
				100% { -webkit-transform: scale(0); opacity: 0; }
			}
			@keyframes spin_loader_round-1 {
				0%   { transform: scale(0); opacity: 0; }
				50%  { transform: scale(1); opacity: 1; }
				100% { transform: scale(0); opacity: 0; }
			}
			.spin_loader_round span {
				display: block;
				position: absolute;
				top: 0; left: 0;
				bottom: 0; right: 0;
				margin: auto;
				height: 32px;
				width: 32px;
				-webkit-animation: spin_loader_round-2 2s cubic-bezier(0.770, 0.000, 0.175, 1.000) infinite;
				        animation: spin_loader_round-2 2s cubic-bezier(0.770, 0.000, 0.175, 1.000) infinite;
			}
			@-webkit-keyframes spin_loader_round-2 {
				0%   { -webkit-transform: rotate(0deg); }
				50%  { -webkit-transform: rotate(180deg); }
				100% { -webkit-transform: rotate(360deg); }
			}
			@keyframes spin_loader_round-2 {
				0%   { transform: rotate(0deg); }
				50%  { transform: rotate(180deg); }
				100% { transform: rotate(360deg); }
			}
			.spin_loader_round span::before,
			.spin_loader_round span::after {
				content: "";
				display: block;
				position: absolute;
				top: 0; left: 0;
				bottom: 0; right: 0;
				margin: auto;
				height: 12px;
				width: 12px;
				background: blue;
				border-radius: 50%;
				-webkit-animation: spin_loader_round-3 2s cubic-bezier(0.770, 0.000, 0.175, 1.000) infinite;
				        animation: spin_loader_round-3 2s cubic-bezier(0.770, 0.000, 0.175, 1.000) infinite;
			}
			@-webkit-keyframes spin_loader_round-3 {
				0%   { -webkit-transform: translate3d(0, 0, 0) scale(1); }
				50%  { -webkit-transform: translate3d(-16px, 0, 0) scale(.5); }
				100% { -webkit-transform: translate3d(0, 0, 0) scale(1); }
			}
			@keyframes spin_loader_round-3 {
				0%   { transform: translate3d(0, 0, 0) scale(1); }
				50%  { transform: translate3d(-16px, 0, 0) scale(.5); }
				100% { transform: translate3d(0, 0, 0) scale(1); }
			}
			.spin_loader_round span::after {
				-webkit-animation: spin_loader_round-4 2s cubic-bezier(0.770, 0.000, 0.175, 1.000) infinite;
				        animation: spin_loader_round-4 2s cubic-bezier(0.770, 0.000, 0.175, 1.000) infinite;
			}
			@-webkit-keyframes spin_loader_round-4 {
				0%   { -webkit-transform: translate3d(0, 0, 0) scale(1); }
				50%  { -webkit-transform: translate3d(16px, 0, 0) scale(.5); }
				100% { -webkit-transform: translate3d(0, 0, 0) scale(1); }
			}
			@keyframes spin_loader_round-4 {
				0%   { transform: translate3d(0, 0, 0) scale(1); }
				50%  { transform: translate3d(16px, 0, 0) scale(.5); }
				100% { transform: translate3d(0, 0, 0) scale(1); }
			}

			.spin_button_center {position: absolute;
			    margin: -3px 0px 0px 6px;
			}
			
			/******************************************** Extra css for Predefine Tags **************************************************/

			input{
				outline: none;
			}
			<?php if(HeaderSetting['LatestUpdate'] != 'off'){ ?>
			.HeaderUpdateContainer{
				display: grid;
			    background-color: #0c4da2;
			    grid-template-columns: 1fr 4fr;
			    width: calc(100% - 250px);
			    font-size: 15px;
			    margin: 20px auto;
			    text-align: center;
			}
			.HeaderUpdateContainer div{
				color: #fff;
				font-size: 16px;
				font-weight: bold;  
			}
			<?php } ?>
			.PredefineContainer{
				display: grid;
			    grid-template-columns: 5fr 2.5fr;
			    height: auto;
			    margin: 20px auto 30px auto;
			    width: calc(100% - 250px);
			    overflow: hidden;
			}
			header img{
				vertical-align: unset!important;
			}
			<?php if(HeaderSetting['PageTitle'] != 'off'){ ?>
			.PageTitle{
				width: calc(100% - 250px);
				color: #fff;
				font-weight: bold;
				font-size: 18px;
				text-align: center;
				background: #8e8e8e;
				<?php if(HeaderSetting['LatestUpdate'] != 'off'){ ?>
				margin: -20px auto auto auto;
				<?php }else{ ?>
					margin: 10px auto;
				<?php } ?>
				padding: 0px 0px 3px 0px;
			}
			<?php } ?>

			@media (max-width:1024px){
			 	.PredefineContainer{
			 		grid-template-columns:repeat(1,1fr);
					width: calc(100% - 150px);
				}
				<?php if(HeaderSetting['LatestUpdate'] != 'off'){ ?>
				.HeaderUpdateContainer{
					width: calc(100% - 150px);
				}
				<?php } ?>
				<?php if(HeaderSetting['PageTitle'] != 'off'){ ?>
				.PageTitle{
					font-size: 17px;
					padding: 0px 0px 3px 0px;
					width: calc(100% - 150px);
				}
				<?php } ?>
			}
			@media (max-width:780px){
			 	.PredefineContainer{
					width: calc(100% - 120px);
					font-size : 12px;
				}
				<?php if(HeaderSetting['LatestUpdate'] != 'off'){ ?>
				.HeaderUpdateContainer{
					width: calc(100% - 120px);
				}
				<?php } ?>
				<?php if(HeaderSetting['PageTitle'] != 'off'){ ?>
				.PageTitle{
					width: calc(100% - 120px);
				}
				<?php } ?>
			}

			@media (max-width:680px){
			 	.PredefineContainer{
					width: calc(100% - 90px);
				}
				<?php if(HeaderSetting['LatestUpdate'] != 'off'){ ?>
				.HeaderUpdateContainer{
					display: grid;
					grid-template-columns:120px 1fr;
				}
				<?php } ?>
				<?php if(HeaderSetting['PageTitle'] != 'off'){ ?>
				.PageTitle{
					display: grid;
					grid-template-columns:1fr;
					font-size : 14px;
				}
				<?php } ?>
			}
			@media (max-width:580px){
			 	.PredefineContainer{
					width: calc(100% - 50px);
				}
				<?php if(HeaderSetting['LatestUpdate'] != 'off'){ ?>
				.HeaderUpdateContainer{
					display: grid;
					grid-template-columns:120px 1fr;
				}
				<?php } ?>
			}
			@media (max-width:480px){
			 	.PredefineContainer{
					width: calc(100% - 20px);
				}
				<?php if(HeaderSetting['LatestUpdate'] != 'off'){ ?>
				.HeaderUpdateContainer{
					width: calc(100% - 20px);
				}
				<?php } ?>
				<?php if(HeaderSetting['PageTitle'] != 'off'){ ?>
				.PageTitle{
					width: calc(100% - 20px);
					font-size : 12px;
				}
				<?php } ?>
			}
		</style>
	</head>
	<body>
		<header>
			<div class="HeaderDayDateBox">
				<?php if(HeaderSetting['HeaderLogoStyle'] == 'LeftInTopMenu'){ ?>
					<p class='HeaderSiteName'>Topicster</p>
				<?php }else{ ?>
				<img class='HeaderTopMenuTimeImage' src="<?php echo RootPath; ?>Library/ImageStore/watchicon-20px.png">
				<div class='HeaderTopMenuTime'><?php echo date('D').', '. date('d-M-Y'); ?></div>
				<?php } ?>
			</div>
			<?php if(HeaderSetting['HeaderLogoStyle'] != 'LeftInTopMenu'){ ?>
			<div class="HeaderLogoContainer">
				<p class='HeaderSiteName'>Topicster</p>
				<p>The best way to keep update</p>
			</div>
			<?php } ?>
			<div class="HeaderMenuBox">
				<div class="HeaderPrimaryMenu">
					<a href="#MobMenuIcon" class='HeaderPrimaryMenu-MobMenuIcon MobMenuIcon'><i class="fas fa-bars" style="padding-right: 5px;"></i></a>
					<a href="#Refresh" class='HeaderPrimaryMenu-RefreshIcon MobMenuIcon MobMenuIcon-Right'><i class="fas fa-redo-alt"></i></a>
					<a href="#Search" class='HeaderPrimaryMenu-SearchIcon MobMenuIcon MobMenuIcon-Right'><i class="fas fa-search"></i></a>
					<div class='HeaderPrimaryMenu-Left'>
						<a href="<?php echo DomainName; ?>"><i class="fas fa-home" style="padding-right: 5px;"></i>HOME</a>
					  	<a href="<?php echo DomainName.'/Pages/about-us.php'; ?>">ABOUT US</a>
				  	<a href="<?php echo DomainName.'/Pages/contact-us.php'; ?>">CONTACT US</a>
				  	<a href="<?php echo DomainName.'/Pages/privacy-policy.php'; ?>">PRIVACY POLICY</a>
				  	<a href="<?php echo DomainName.'/Pages/disclaimer.php'; ?>">DESCLAIMER</a>
					  	<?php if($IsLogin['code'] == 200){ $HeaderLoginBtnStyle = 'display:none;';  $HeaderSignupBtnStyle = 'display:none;';}?>
					  	<a href="#login" class='HeaderLoginBtn HeaderPrimaryMenuLogin' style='<?php echo $HeaderLoginBtnStyle; ?>'>LOGIN</a>
					  	<div class="HeaderPrimaryMenu-dropdown HeaderPrimaryMenuSignup" style='<?php echo $HeaderSignupBtnStyle; ?>'>
					    	<button class="HeaderPrimaryMenu-dropbtn">SIGNUP 
					      		<i class="fa fa-caret-down"></i>
					    	</button>
					    	<div class="HeaderPrimaryMenu-dropdown-content">
					      		<a href="#UserSignup" class='HeaderSubscriberSpBtn'><i class="fas fa-user-plus" style="padding-right: 5px;"></i>User Signup</a>
					      		<a href="#PartnerSignup" class='HeaderPartnerSpBtn'><i class="fas fa-user-plus" style="padding-right: 5px;"></i>Partner Signup</a>
					    	</div>
					  	</div>

					  	<?php if($IsLogin['code'] != 200){ $HeaderAccountProfileBtnStyle = 'display:none;'; }?>
					  	<div class="HeaderPrimaryMenu-dropdown HeaderPrimaryMenuAccount" style='<?php echo $HeaderAccountProfileBtnStyle; ?>'>
					    	<button class="HeaderPrimaryMenu-dropbtn">ACCOUNT<i class="fa fa-caret-down"></i></button>
					    	<div class="HeaderPrimaryMenu-dropdown-content">
					    		<a href="/Dashboard/<?php echo $IsLogin['LAS']; ?>/Profile/index.php" class='HeaderPrimaryMenuAccountDashboard'><i class="fas fa-meh-rolling-eyes" style="padding-right: 5px;"></i><?php echo $RandMsg.' '.$IsLogin['msg']['FullName'] ?></a>
					      		<a href="/Dashboard/<?php echo $IsLogin['LAS']; ?>/index.php" class='HeaderPrimaryMenuAccountDashboard'><i class="fas fa-user" style="padding-right: 5px;"></i>Dashboard</a>
					      		<a href="#AccountLogout" class='HeaderPrimaryMenuAccountLogout'><i class="fas fa-power-off" style="padding-right: 5px;"></i>Logout<span class="LogoutSpinLoader" hidden="true"><span class="spin_loader_round spin_button_center"><span></span></span></span></a>
					    	</div>
					  	</div>
					</div>
				</div>
				<div class="HeaderPrimaryMenu HeaderPrimaryMenu-Right">
					<a href="#Search" class='HeaderPrimaryMenu-SearchIcon DesktopMenuIcon'><i class="fas fa-search"></i></a>
					<a href="#Refresh" class='HeaderPrimaryMenu-RefreshIcon DesktopMenuIcon'><i class="fas fa-redo-alt"></i></a>
				</div>
				<div Class='HeaderPrimaryMenu-SearchBarBox' style='display: none;'>
					<input type="text" class="HeaderPrimaryMenuSearchBar" placeholder="Search here">
					<div class="HeaderPrimaryMenuSearchBarIcon">
						<i class="fas fa-search"></i>
					</div>
					<div class="HeaderPrimaryMenuSearchBarCloseIcon">
						<i class="fas fa-times"></i>
					</div>
				</div>
			</div>
			<?php if(HeaderSetting['LatestUpdate'] != 'off'){ ?>
			<div class="HeaderUpdateContainer">
				<div style='margin: 10px 5px;'>Latest Update</div>
				<div class="HeaderUPDATES">
					<a class="LatestUpdateValue" href='' style="color: #8e8e8e; /*font-family: serif;*/padding: 8px 0px 0px 3px;text-align: left;display: block;display: -webkit-box;max-width: 100%;height: 20px;line-height: 1.2;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;text-decoration: none;">Latest Update Loading...</a>
					<div class="LatestUpdateBackIcon" style='float:right; background-color: #0c4da2;height: 20px;margin: 7px 0px;cursor: pointer;width: 16px;padding: 3px 0px 0px 0px;width: 16px;'><img src="<?php echo RootPath; ?>Library/ImageStore/LEFTARROW-16PX.png"></div>
					<div class="LatestUpdateNextIcon"  style='float: right;background-color: #0c4da2;height: 20px;margin: 7px 5px 7px 0px;cursor: pointer;width: 16px;padding: 3px 0px 0px 0px;'><img src="<?php echo RootPath; ?>Library/ImageStore/RIGHTARROW-16PX.png"></div>
				</div>
			</div>
			<?php } ?>
		</header>
		<?php if(HeaderSetting['HeaderScroll'] == 'off'){ ?>
			<div class='HeaderScrollOff'></div>
		<?php } ?>
		<?php if( PageSetting['PageTitle'] != ''){
			echo "<h1 class='PageTitle'>". PageSetting['PageTitle']."</h1>";
		}?>
		<div id='LgOrSpPopBox'></div> -->

<style>
	.PredefineContainer{
		line-height: 2em;
	}

	pre{
		white-space: -moz-pre-wrap; /* Mozilla, supported since 1999 */
	    white-space: -pre-wrap; /* Opera */
	    white-space: -o-pre-wrap; /* Opera */
	    white-space: pre-wrap; /* CSS3 - Text module (Candidate Recommendation) http://www.w3.org/TR/css3-text/#white-space */
	    word-wrap: break-word; /* IE 5.5+ */

	    margin-bottom: 1em;
		padding: 12px 8px;
		width: auto;
		max-height: 600px;
		overflow: auto;
		font-family: Consolas,Menlo,Monaco,Lucida Console,Liberation Mono,DejaVu Sans Mono,Bitstream Vera Sans Mono,Courier New,monospace,sans-serif;
		font-size: 13px;
		background-color: #e6e6e6;
		border-radius: 3px;
		scrollbar-color: #d0d0d0 transparent;
	}

	img{
		max-width: 100%;
	}

	p{
		width: 100%;
		font: 500 17px/29px Noto Sans,sans-serif;
		color: #000;
		margin-top: 0px;
		margin-bottom: 0px;
		font-size: 14px;
	}

	li{
		line-height: 2em;
		color: #585858;
		font-weight: 700;
		list-style-type: none;
	}
	.Title > h1{
		font-size: 18px;
		color: #444343;
	}
	h1,h2,h3,h4,h5,h6{
		color: #585858;
	}
	h2,h3,h4,h5,h6{
		line-height: 1.8em;
	}
	h1{
		font-size: 17px;
		line-height: 1.7em;
	}
	h2{
		font-size: 16px;
	}
	h3{
		font-size: 15px;
	}
	h4{
		font-size: 14px;
	}
	h5{
		font-size: 13px;
	}
	h6{
		font-size: 12px;
	}

	code{
		font-family: Consolas,Menlo,Monaco,Lucida Console,Liberation Mono,DejaVu Sans Mono,Bitstream Vera Sans Mono,Courier New,monospace,sans-serif;
		background-color: #e4e6e8;
		padding: 1px 5px;
		white-space: pre;
		line-height: 1.7em;
		font-size: 13px;
		overflow: auto;
	}
	p:has(code) {
	    overflow: auto;
	}
	ul{
		padding: 0px;
	}

	blockquote{
		background: #c8ccd0;
		padding: 0px 0px 0px 4px;
		margin: 5px 5px 5px 22px;
		border-radius: 8px;
	}
	blockquote p{
		background: #f4f4f4;
		padding: 8px 12px;
	}
	iframe{
		max-width: 100%!important;
	}

	.Title{
		text-decoration: none;
		color: #000;
		background: #f4f4f4;
		width: 100%;
		margin: -10px 0px 0px -10px;
		padding: 10px 10px 0px 10px;
	}
	.Time{
		color: #8f8f8f;
		margin-top: -25px;
		padding: 10px 0px;
	}
	.Time > i{
		margin-right: 10px;
	}
	.Content{
		width: calc(100% - 7px);
		box-shadow: 0px 0px 4px 0px rgba(0.5, 0.5, 0.5, 0.5);
		margin: 25px auto 0px auto;
	}
	.PostContent{
		display: block;
		padding: 0px 10px 10px 10px;
		grid-row-gap: 20px;
		margin-bottom: 30px;
		border-radius: 5px;

	}
	.PostDescription{
		background: #f4f4f4;
		width: 100%;
		margin: -30px 0px 0px -5px;
		padding: 5px 5px;
		display: block;
	}
	
	.ArticleContainer{
		display: block;
	    height: auto;
	    margin: 20px auto 30px 0px;
	    width: 100%;
	    overflow: hidden;
	}
	.body{
		width: calc(100% - 250px);
		margin: auto;
	}
	.SiderBar{
		padding : 0px!important;
		display:none;
	}
	.SiderBarContainer{
		padding: 0px!important;
	}
	@media (min-width: 1024px){
		.SiderBar{
			margin-right: 0px!important;
			margin-left: auto!important;
			width: 30%;
		}
		.ArticleContainer{
			width: 65%;
		}
	}
	@media (max-width:1024px){
		.body{
			width: calc(100% - 150px);
		}
		.SiderBar{
			margin: 0px!important;
			width: auto!important;
			margin-top: auto!important;
			display:block;
		}
	}
	@media (max-width:780px){
		.body{
			width: calc(100% - 120px);
		}
	}
	@media (max-width:480px){
		.body{
			width: calc(100% - 20px);
		}
	}
</style>
	<section class='body'>
		<section class="ArticleContainer">
			<div class="Content">
				<div class="PostContent">
					<div class='Title'><h1><?php echo AptSafeTextDecode(['Str'=>$GetArticle['msg']->Title,'EWords'=>AptSafeTextDecodeEWords])['msg']; ?></h1></div>
					<div class="Time"><i class='fas fa-stopwatch'></i><?php echo date("d-M-Y h:i:s A",$GetArticle['msg']->CreateTime); ?></div>
					<div class='PostDescription'><?php echo str_replace('<PredifineKeyword>PredifinePartnerMediaFilePath<PredifineKeyword>', DomainName.'/PartnerMedia/', AptSafeTextDecode(['Str'=>$GetArticle['msg']->Description,'EWords'=>AptSafeTextDecodeEWords])['msg']); ?></div>
				</div>
			</div>
		</section>
		<?php require(RootPath."Library/SiteComponents/SideBar/index.php"); ?>
	</section>
	<?php require(RootPath."Library/SiteComponents/Footer/index.php"); ?>
	<?php require(RootPath."Library/Apt/Html/AptClassASelectBox/index.html"); ?>
	<script>
		$('.SiderBar').css({'margin-top':'-'+($('.ArticleContainer').height()+4)+'px','display':'block'});
		$(window).resize(function(){
			$('.SiderBar').css({'margin-top':'-'+($('.ArticleContainer').height()+4)+'px','display':'block'});
		});
	</script>
</body>
</html>
<script>
	AptClassASelectBoxCreate({name:'Decision',placeholder:'Make a Decision',option:['Approve','Reject'],eid:'DecisionBox'});
	$("#Decision").on("submit", function() {
        var CurrentCategory = $("#Decision").val();
		if(CurrentCategory == 'Reject'){
			$('#DecisionReasonBox').css('display','block');
		}else{
			$('#DecisionReasonBox').css('display','none');
		}
	});
	$('.SubmitButton').on('click',function(){
		if(window.SmtBtn == true){
			return false;
		}
		SubmitStart();
		var Decision = $("#Decision").val();
		if(Decision == 'Reject'){
			var DecisionReason = $('.DecisionReason').val();
			if(DecisionReason.length < 10){
				swal.fire('Invaild',"Invalid Decision reason found! reason must be more then 10 words", "warning");
				SubmitReset(); return false;
			}
		}else if(Decision == 'Approve'){
			var DecisionReason = '';
		}else{
			swal.fire('Invaild',"Invalid Decision found!", "warning");
			SubmitReset(); return false;
		}

		var client = new ClientJS();
		imprint.test(browserTests).then(function(result){
			var fingerprint_1 = new Fingerprint().get();
			var customfingerprint_1 = new Fingerprint({screen_resolution: true}).get();
			audioFingerprint.run(function (fingerprint_2) {
				var BrowserClientId1 = RandomPass1 + new jsSHA(fingerprint_1.toString()+customfingerprint_1.toString()+result+fingerprint_3.toString()+uid.toString()+client.getFingerprint().toString()+fingerprint_2+fingerprint_canvas()+client.getCanvasPrint()+fingerprint_display().toString()+fingerprint_touch().toString()+client.getBrowser().toString()+client.getOS().toString()+client.getScreenPrint().toString()).getHash("SHA-512", "HEX") +RandomPass2;
				

				var BrowserClientId2 = RandomPass3+ new jsSHA(customfingerprint_1.toString()+fingerprint_1.toString()+fingerprint_2+uid.toString()+client.getFingerprint().toString()+fingerprint_3.toString()+result+fingerprint_display().toString()+client.getScreenPrint().toString()+client.getBrowser().toString()+client.getOS().toString()+fingerprint_touch().toString()+client.getCanvasPrint()+fingerprint_canvas()).getHash("SHA-512", "HEX") +RandomPass4;

				// append data which we want to send data on targeted page
				var formdata = new FormData();
				formdata.append("Decision", Decision);
				formdata.append("DecisionReason", DecisionReason);
				formdata.append("Url", '<?php echo $_GET['url'] ?>');
				formdata.append("Token_CSRF", Token_CSRF);
				formdata.append("BrowserClientId1", BrowserClientId1);
				formdata.append("BrowserClientId2", BrowserClientId2);

				// Check Internet connection
				if(navigator.onLine == false){
					swal.fire('Internet',"It seems that you are offline. Please check your internet connection", "warning");
					SubmitReset();
					return false;
				}
				// Send data on sigup backend page for uploading on the server
				try{
					var ajax = new XMLHttpRequest();
					ajax.addEventListener("load",SmtHandler,false);
					ajax.open("POST", RootPath+"Dashboard/Main/NewArticleRequest/NewArticleRequestBackend.php");
					ajax.send(formdata);
				}catch(error){
					swal.fire('Technical Error',"An Technical error occur in login process! Try again later", "warning");
					SubmitReset(); return false;
				}

				//function run on complete login request
				function SmtHandler(event){
					SubmitReset();
					var response = $.parseJSON(event.target.responseText);
					if(response['code'] === 200){
						swal.fire('Update','Post update Suceesfully','success')
						.then((value) => {
							window.location.replace(RootPath+"Dashboard/Main/NewArticleRequest/index.php");
						});
					}else{
						swal.fire('Login',response['msg'], "warning");
					}
				}
			});
		});

		function SubmitStart(){
			window.SmtBtn = true;
			$(".SmtBtn").prop('hidden',false);
			$("input").prop("disabled",true);
			$("select").prop("disabled",true);
			$('.SubmitButton').css("pointer-events","none");
			$(".SubmitButton").css("background","linear-gradient(skyblue, pink)");
			$(".SubmitButton").css("cursor","default");
		}
		function SubmitReset(){
			$("input").prop("disabled",false);
			$("select").prop("disabled",false);
			$('.SubmitButton').css("pointer-events","auto");
			$(".SubmitButton").css("background","#0c4da2");
			$(".SubmitButton").css("cursor","pointer");
			$(".SmtBtn").prop('hidden',true);
			window.SmtBtn = false;
		}
	});
</script>
<?php foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal); ?>
		