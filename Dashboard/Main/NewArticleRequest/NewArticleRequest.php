<?php
	//error_reporting(0);
	define('RootPath', '../../../');
	define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
	define('PageSetting', ['BrowserTitle'=>'Topicster : New Article Request','PageTitle'=>'New Article Request','HeaderMenuActive'=>'Account>Dashboard']);
	require(RootPath."Library/SiteComponents/Header/index.php");
	// DbCon -> ($PdoTopicsterPostData)
	require_once (RootPath."Library/Database/SQL/Pdo/topicster_post_data.php");
	require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoFetchWithAes/index.php");
	require_once (RootPath."Library/Apt/Php/Script/EncodeAndEncrypt/AptEncodeAndEncryptWithAes.php");
	require_once (RootPath."Library/Apt/Php/Script/AptSafeText/index.php");
	require_once (RootPath."Library/Apt/Php/Script/AptUtf8EncodeAndDecode/index.php");
	
	if($IsLogin['code'] != 200){
		header("Location: " . RootPath);
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'Authentication failed [Login]']); exit();
	}else if($IsLogin['LAS'] != 'Main'){
		header("Location: " . RootPath);
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'Authentication failed [Login]']); exit();
	}
	
	if(strlen($_GET['url']) != 15 || $_GET['url'] != preg_replace('/[^A-Za-z0-9]/', '', $_GET['url'])){
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'Invalid Url detect [NewArticleRequestBackend]','status'=>'Error']); exit();
	}

	$result = AptPdoFetchWithAes(['Condtion'=> "Url::::".$_GET['url']."::,::Status::::UnderReview", 'DbCon'=> $PdoTopicsterPostData,'TbName'=> 'post', 'EPass'=> $EPass]);

  	if($result['code'] != 200){
  		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'Invalid Url detect [NewArticleRequestBackend]','status'=>'Error']); exit();
  	}
  	
	$GetNewArticleRequest = AptPdoFetchWithAes(['Condtion'=> "Status::::UnderReview::,::Url::::".preg_replace('/[^A-Za-z0-9-]/', '', $_GET['url']),'FetchData'=>'Url::::Title::::CreateTime::::Description', 'DbCon'=> $PdoTopicsterPostData, 'TbName'=> 'post', 'EPass'=> $EPass]);
    
	if($GetNewArticleRequest['code'] == 200){
		#Continue
	}else if($GetNewArticleRequest['code'] == 404){
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'No New Article Request Found [Complete]']); exit();
	}else{
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'New Article Request Not Fetched due to technical error [ArticleRequest]']); exit();
	}
?>
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
			white-space: pre-wrap;
			line-height: 1.7em;
			font-size: 13px;
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
			padding: 12px;
		}

		.Title{
			text-decoration: none;
			color: #000;
			background: #f4f4f4;
			width: 100%;
			margin: -10px 0px 0px -10px;
			padding: 0px 10px;
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
			width: calc(100% - 20px);
		    margin-left: 10px;
		    margin-top: 25px;
		}
		.PostContent{
			display: grid;
			padding: 10px;
			grid-row-gap: 20px;
			box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),
			 0 3px 1px -2px rgba(0,0,0,.2),
			 0 1px 5px 0 rgba(0,0,0,.12);
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
		.DecisionReason{
			border: 2px solid #8f8f8f;
			resize: none;
			width: calc(100% - 26px);
			margin-top: 10px;
			font-size: 15px;
			color: #524848;
			line-height: 1.8em;
			font-family: unset;
			padding: 10px;
		}
		.SubmitButton{
			background: #0c4da2;
			padding: 10px 5px;
			font-weight: bold;
			color: #fff;
			text-align: center;
			margin-top: 20px;
			cursor: pointer;
		}
    	
    	@media (max-width:1024px){
    	 	.PostDescription{
    			width: calc(100vw - 190px);
    		}
    	}
    	@media (max-width:780px){
    	 	.PostDescription{
    			width: calc(100vw - 160px);
    		}
    	}
    
    	@media (max-width:680px){
    	 	.PostDescription{
    			width: calc(100vw - 130px);
    		}
    	}
    	@media (max-width:580px){
    	 	.PostDescription{
    			width: calc(100vw - 90px);
    		}
    	}
    	@media (max-width:480px){
    	 	.PostDescription{
    			width: calc(100vw - 60px);
    		}
	}
	</style>
	<section class="PredefineContainer">
		<div class="Content">
			<div class="PostContent">
				<div class='Title'><h1><?php echo $GetNewArticleRequest['msg']->Title; ?></h1></div>
				<div class="Time"><i class='fas fa-stopwatch'></i><?php echo date("d-M-Y h:i:s A",$GetNewArticleRequest['msg']->CreateTime); ?></div>
				<div class='PostDescription'><?php echo str_replace('<PredifineKeyword>PredifinePartnerMediaFilePath<PredifineKeyword>', DomainName.'/PartnerMedia/', AptSafeTextDecode(['Str'=>$GetNewArticleRequest['msg']->Description,'EWords'=>['=','/','<','>']])['msg']); ?></div>
			</div>
			<div class='BottomToolBarButtons'>
				<div id='DecisionBox'></div>
				<div id='DecisionReasonBox' style='display: none;' spellcheck='false'>
					<textarea class='DecisionReason' placeholder="Please enter reason for reject request" maxlength='150'></textarea>
				</div>
				<div class='SubmitButton'>SUBMIT<span class="SmtBtn" hidden="true"><span class="spin_loader_round spin_button_center"><span></span></span></span></div>
			</div>
		</div>
		<?php require(RootPath."Library/SiteComponents/SideBar/index.php"); ?>
	</section>
	<?php require(RootPath."Library/SiteComponents/Footer/index.php"); ?>
	<?php require(RootPath."Library/Apt/Html/AptClassASelectBox/index.html"); ?>
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
		