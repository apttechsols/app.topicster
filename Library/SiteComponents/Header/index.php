<?php
	error_reporting(0);
	require_once(RootPath."Library/SiteComponents/FrontEndControlPage/index.php");
	
	#$StoreFontFamily = ["cursive","serif","sans-serif","Arial","Helvetica"];
	$StoreFontFamily = ["serif"];
	$FonFamily = $StoreFontFamily[rand(0,4)];
	$RandMsg = ['Hello!','Hi!','Welcome!','Namaskar!','Howdy!','Good day!',"What's up!",'Hey!'];
	$RandMsg = $RandMsg[rand(0,7)];
	$LastHeaderMenuActive = '';
	foreach (explode('>', PageSetting['HeaderMenuActive']) as $key => $value) {
		if($LastHeaderMenuActive != ''){
			${$LastHeaderMenuActive.'_'.$value} = 'HeadreMenuActive_2';
			$LastHeaderMenuActive = $LastHeaderMenuActive.'_'.$value;
		}else{
			${'HeaderMenu_'.$value} = 'HeadreMenuActive';
			$LastHeaderMenuActive = 'HeaderMenu_'.$value;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<?php if(PageSetting['robots'] != ''){
		echo "<meta NAME='ROBOTS' CONTENT='".PageSetting['robots']."'/>\n";
	} ?>
	<title><?php echo PageSetting['BrowserTitle'] != '' ? PageSetting['BrowserTitle'] : 'Topicster'; ?></title>
	<?php if(PageSetting['title'] != ''){
		echo"<meta name='title' content='".PageSetting['title']."'/>\n";
	}else if(PageSetting['BrowserTitle'] != ''){
		echo"<meta name='title' content='".PageSetting['BrowserTitle']."'/>\n";
	} ?>
	<?php if(PageSetting['keywords'] != ''){
		echo"<meta name='keywords' content='".str_replace(array("\n", "\r"), '', preg_replace('!\s+!', ' ',PageSetting['keywords']))."'/>\n";
	} ?>
	<?php if(PageSetting['description'] != ''){
		echo "<meta name='description' content='".PageSetting['description']."'/>\n";
	} ?>
	<meta property="og:site_name" content="<?php echo HostedSiteName; ?>"/>
    <?php if(PageSetting['og_url'] != ''){
        echo "<meta property='og:url' content='".PageSetting['og_url']."'/>\n";
	} ?>
    <?php if(PageSetting['title'] != ''){
		echo "<meta property='og:title' content='".PageSetting['title']."'/>\n";
	}else if(PageSetting['BrowserTitle'] != ''){
		echo"<meta property='og:title' content='".PageSetting['BrowserTitle']."'/>\n";
	} ?>
    <?php if(count(PageSetting['ThumbnailImage']) > 0){
    	$i=0;
    	foreach (PageSetting['ThumbnailImage'] as $key => $value) {
    		if($i > 0){
    			echo '    ';
    		}
    		echo "<meta property='og:image' content='".$value['Image']."'/>\n    <meta property='og:image:width' content='".$value['Width']."'/> \n    <meta property='og:image:height' content='".$value['Height']."'/>\n";
    		$i += 1;
    	}
	} ?>
    <?php if(PageSetting['description'] != ''){
		echo "<meta property='og:description' content='".PageSetting['description']."'/>\n";
	} ?>
    <?php if(PageSetting['og_url'] != ''){
		echo "<meta property='al:web:url' content='".PageSetting['og_url']."'/>\n";
	} ?>
    <?php if(PageSetting['og_type'] != ''){
		echo "<meta property='og:type' content='".PageSetting['og_type']."'/>\n";
		$i = 0;
		foreach (explode(', ', str_replace(array("\n", "\r"), '', preg_replace('!\s+!', ' ',PageSetting['keywords']))) as $key => $value) {
    		echo "    <meta property='og:".PageSetting['og_type'].":tag' content='$value'/>\n";
    		$i += 1;
    	}
	} ?>
	<?php if(PageSetting['twitter_card'] != ''){
 		echo "<meta name='twitter:card' content='".PageSetting['twitter_card']."'/>\n";
	}else{
		echo "<meta name='twitter:card' content='summary_large_image'/>\n";
	} ?>
	<meta name="twitter:site" content="@<?php echo HostedSiteName; ?>"/>
	<meta name="twitter:creator" content="@<?php echo HostedSiteName; ?>"/>
	<?php if(PageSetting['title'] != ''){
		echo "<meta name='twitter:title' content='".PageSetting['title']."'/>\n";
	}else if(PageSetting['BrowserTitle'] != ''){
		echo"<meta name='twitter:title' content='".PageSetting['BrowserTitle']."'/>\n";
	} ?>
	<?php if(PageSetting['description'] != ''){
		echo "<meta name='twitter:description' content='".PageSetting['description']."'/>\n";
	} ?>
	<?php if(count(PageSetting['ThumbnailImage']) > 0){
		echo "<meta name='twitter:image' content='".PageSetting['ThumbnailImage'][0]['Image']."'/>\n";
	} ?>
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
		.HeadreMenuActive{
			background: red!important;
		}
		.HeadreMenuActive_2{
			background: #ddd!important;
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
		::-webkit-scrollbar {
          width: 10px;
          height: 10px;
        }
        /* Track */
        ::-webkit-scrollbar-track {
          box-shadow: inset 0 0 5px grey; 
          border-radius: 10px;
        }
         
        /* Handle */
        ::-webkit-scrollbar-thumb {
          background: #c8ccd0; 
          border-radius: 10px;
        }
        
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
          background: #8f8f8f; 
        }
        
        body{
            scrollbar-width: thin;
            scrollbar-height: thin;
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
			font-size: 25px;
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
				font-size: 21px;
				padding: 0px 0px 3px 0px;
				width: calc(100% - 150px);
			}
			<?php } ?>
		}
		@media (max-width:780px){
		 	.PredefineContainer{
				width: calc(100% - 120px);
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
					<a href="<?php echo DomainName; ?>" class='<?php echo $HeaderMenu_Home; ?>'><i class="fas fa-home" style="padding-right: 5px;"></i>HOME</a>
				  	<a href="<?php echo DomainName.'/Pages/about-us.php'; ?>" class='<?php echo $HeaderMenu_AboutUs; ?>'>ABOUT US</a>
				  	<a href="<?php echo DomainName.'/Pages/contact-us.php'; ?>" class='<?php echo $HeaderMenu_ContactUs; ?>'>CONTACT US</a>
				  	<a href="<?php echo DomainName.'/Pages/privacy-policy.php'; ?>" class='<?php echo $HeaderMenu_PrivacyPolicy; ?>'>PRIVACY POLICY</a>
				  	<a href="<?php echo DomainName.'/Pages/disclaimer.php'; ?>" class='<?php echo $HeaderMenu_Disclaimer; ?>'>DESCLAIMER</a>
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
				  	<div class="HeaderPrimaryMenu-dropdown HeaderPrimaryMenuAccount " style='<?php echo $HeaderAccountProfileBtnStyle; ?>'>
				    	<button class="HeaderPrimaryMenu-dropbtn <?php echo $HeaderMenu_Account; ?>">ACCOUNT<i class="fa fa-caret-down"></i></button>
				    	<div class="HeaderPrimaryMenu-dropdown-content">
				    		<a href="<?php echo DomainName; ?>/Dashboard/<?php echo $IsLogin['LAS']; ?>/Profile/index.php" class='HeaderPrimaryMenuAccountDashboard'><i class="fas fa-meh-rolling-eyes" style="padding-right: 5px;"></i><?php echo $RandMsg.' '.$IsLogin['msg']['FullName'] ?></a>
				      		<a href="<?php echo DomainName; ?>/Dashboard/<?php echo $IsLogin['LAS']; ?>/index.php" class='HeaderPrimaryMenuAccountDashboard <?php echo $HeaderMenu_Account_Dashboard; ?>'><i class="fas fa-user" style="padding-right: 5px;"></i>Dashboard</a>
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
	<div id='LgOrSpPopBox'></div>