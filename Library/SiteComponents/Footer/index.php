<footer>
	
</footer>
<script src="<?php echo RootPath; ?>Library/JavaScript/Jquery/GoogleDNS/3.4.1/jquery.min.js"></script>
<script src="<?php echo RootPath; ?>Library/JavaScript/Javascript/UserBrowser_detection.js"></script>
<script src="<?php echo RootPath; ?>Library/Apt/JavaScript/JavaScript/AptSetAndGetJavaScriptCookie.js"></script>
<script src="<?php echo RootPath; ?>Library/JavaScript/Javascript/UserBrowser_detection.js"></script>
<script src="<?php echo RootPath; ?>Library/JavaScript/Javascript/SweetAlert2.js"></script>

<?php if(PageSetting['JavaScript'] != ''){
	if(is_array(PageSetting['JavaScript'])){
		foreach (PageSetting['JavaScript'] as $value) { ?>
			<script src="<?php echo $value; ?>.js"></script>
		<?php }
	}else{ ?>
		<script src="<?php echo PageSetting['JavaScript']; ?>.js"></script>
	<?php }
} ?>
<script>
	const RootPath = '<?php echo RootPath; ?>';
	const RandomPass1 = '<?php echo $_SESSION['RandomPass1']; ?>';
	const RandomPass2 = '<?php echo $_SESSION['RandomPass2']; ?>';
	const RandomPass3 = '<?php echo $_SESSION['RandomPass3']; ?>';
	const RandomPass4 = '<?php echo $_SESSION['RandomPass4']; ?>';
	const Token_CSRF = '<?php echo $_SESSION['Token_CSRF']; ?>';

	$(document).ready(function(){

		$(window).resize(function(){
			if($(window).width() >= 1024){
				$(".HeaderPrimaryMenu-Left").css('display','block');
				$('.HeaderMenuBox').css({'height':'50px','grid-template-columns':'1fr 100px'});
			}else{
				$(".HeaderPrimaryMenu-Left").css('display','none');
				$('.HeaderMenuBox').css({'height':'auto','grid-template-columns':'1fr'});
			}
		});

		var LatestUpdates = [];
		LatestUpdatesCount = LatestUpdates.length-1;
		CurrentLatestUpdatesNumber = 0;
		try{
			if(LatestUpdates[CurrentLatestUpdatesNumber]['Title'] != undefined && LatestUpdates[CurrentLatestUpdatesNumber]['href'] != undefined){$('.LatestUpdateValue').html(LatestUpdates[CurrentLatestUpdatesNumber]['Title']).attr('href',LatestUpdates[CurrentLatestUpdatesNumber]['href']); }else{$('.LatestUpdateValue').html('Latest Update Loading...'); return false;} if(LatestUpdatesCount <= 0){$('.LatestUpdateValue').html('Latest Update Loading...'); return false; }else if(CurrentLatestUpdatesNumber < LatestUpdatesCount){CurrentLatestUpdatesNumber++;}else{CurrentLatestUpdatesNumber = 0;}
		}catch(e){

		}
		var LatestUpdatesInterval;
		var LatestUpdatesTimer = function(){
			LatestUpdatesInterval = setInterval(function(){
				try{
					if(LatestUpdates[CurrentLatestUpdatesNumber]['Title'] != undefined && LatestUpdates[CurrentLatestUpdatesNumber]['href'] != undefined){$('.LatestUpdateValue').html(LatestUpdates[CurrentLatestUpdatesNumber]['Title']).attr('href',LatestUpdates[CurrentLatestUpdatesNumber]['href']); }else{$('.LatestUpdateValue').html('Latest Update Loading...'); return false;} if(LatestUpdatesCount < 0){$('.LatestUpdateValue').html('Latest Update Loading...'); return false; }else if(CurrentLatestUpdatesNumber < LatestUpdatesCount){CurrentLatestUpdatesNumber++;}else{CurrentLatestUpdatesNumber = 0;}
				}catch(e){

				}
			}, 5000);
		};
		LatestUpdatesTimer();

		$('.LatestUpdateBackIcon').click(function(){
			clearInterval(LatestUpdatesInterval);
			if(CurrentLatestUpdatesNumber > 0){
				CurrentLatestUpdatesNumber--;
			}else{
				CurrentLatestUpdatesNumber = LatestUpdatesCount;
			}
			try{
				if(LatestUpdates[CurrentLatestUpdatesNumber]['Title'] != undefined && LatestUpdates[CurrentLatestUpdatesNumber]['href'] != undefined){$('.LatestUpdateValue').html(LatestUpdates[CurrentLatestUpdatesNumber]['Title']).attr('href',LatestUpdates[CurrentLatestUpdatesNumber]['href']); }else{$('.LatestUpdateValue').html('Latest Update Loading...'); return false;} if(LatestUpdatesCount < 0){$('.LatestUpdateValue').html('Latest Update Loading...'); return false; }else if(CurrentLatestUpdatesNumber < LatestUpdatesCount){CurrentLatestUpdatesNumber++;}else{CurrentLatestUpdatesNumber = 0;}
			}catch(e){
				console.log(e);
			}
			LatestUpdatesTimer();
		});

		$('.LatestUpdateNextIcon').click(function(){
			clearInterval(LatestUpdatesInterval);
			if(CurrentLatestUpdatesNumber < LatestUpdatesCount){
				CurrentLatestUpdatesNumber++;
			}else{
				CurrentLatestUpdatesNumber = 0;
			}
			try{
				if(LatestUpdates[CurrentLatestUpdatesNumber]['Title'] != undefined && LatestUpdates[CurrentLatestUpdatesNumber]['href'] != undefined){$('.LatestUpdateValue').html(LatestUpdates[CurrentLatestUpdatesNumber]['Title']).attr('href',LatestUpdates[CurrentLatestUpdatesNumber]['href']); }else{$('.LatestUpdateValue').html('Latest Update Loading...'); return false;} if(LatestUpdatesCount < 0){$('.LatestUpdateValue').html('Latest Update Loading...'); return false; }else if(CurrentLatestUpdatesNumber < LatestUpdatesCount){CurrentLatestUpdatesNumber++;}else{CurrentLatestUpdatesNumber = 0;}
			}catch(e){
				console.log(e);
			}
			LatestUpdatesTimer();
		});

		setInterval(function(){
			try{
				var formdata = new FormData();
				var ajax = new XMLHttpRequest();
				ajax.addEventListener("load",LatestUpdatesHandler,false);
				ajax.open("POST", RootPath+"Library/SiteComponents/LatestArtical/index.php");
				ajax.send(formdata);
			}catch(error){
				console.log("An Technical error occur in fetch latest Artical "+error);
				return false;
			}
		}, 10000);

		try{
			var formdata = new FormData();
			var ajax = new XMLHttpRequest();
			ajax.addEventListener("load",LatestUpdatesHandler,false);
			ajax.open("POST", RootPath+"Library/SiteComponents/LatestArtical/index.php");
			ajax.send(formdata);
		}catch(error){
			console.log("An Technical error occur in fetch latest Artical "+error);
			return false;
		}

		//function run on complete login request
		function LatestUpdatesHandler(event){
			var response = $.parseJSON(event.target.responseText);
			if(response['code'] === 200){
				if(response['msg'][0] != '' && response['msg'][0] != undefined){
					LatestUpdates[0] = response['msg'][0];
				}else{
					LatestUpdates.splice(0, 0);
				}
				if(response['msg'][1] !='' && response['msg'][1] != undefined){
					LatestUpdates[1] = response['msg'][1];
				}else{
					LatestUpdates.splice(1, 1);
				}
				if(response['msg'][2] !='' && response['msg'][2] != undefined){
					LatestUpdates[2] = response['msg'][2];
				}else{
					LatestUpdates.splice(2, 2);
				}
				LatestUpdatesCount = LatestUpdates.length-1;
				if(CurrentLatestUpdatesNumber > LatestUpdatesCount){
					CurrentLatestUpdatesNumber = 0;
				}
			}else if(response['code'] === 404){
				LatestUpdates.splice(0, 0);
				LatestUpdates.splice(1, 1);
				LatestUpdates.splice(2, 2);
				LatestUpdatesCount = -1;
				CurrentLatestUpdatesNumber = 0;
			}else{
				LatestUpdates.splice(0, 0);
				LatestUpdates.splice(1, 1);
				LatestUpdates.splice(2, 2);
				LatestUpdatesCount = -1;
				CurrentLatestUpdatesNumber = 0;
				console.log("An Technical error occur in fetch latest Artical"); return false;
			}
		}

		$(".HeaderPrimaryMenu-MobMenuIcon").click(function(){
        	$(".HeaderPrimaryMenu-Left").slideToggle("medium");
		});

		$(".HeaderPrimaryMenu-RefreshIcon").click(function(){
			location.reload();
		});

		$(".HeaderPrimaryMenu-SearchIcon").click(function(){
			$('.HeaderPrimaryMenu').css('display','none');
			$('.HeaderPrimaryMenu-SearchBarBox').css('display','grid');
		});

		$(".HeaderPrimaryMenuSearchBarCloseIcon").click(function(){
			$('.HeaderPrimaryMenu-SearchBarBox').css('display','none');
			$('.HeaderPrimaryMenu').css('display','block');
		});

		$(".HeaderLoginBtn").click(function(){
			$(".SignupPage_PartnerSignupBox").remove();
			$(".SignupPage_SubscriberSignupBox").remove();
			if($('.LoginPage_LoginBox')[0]){
				$(".LoginPage_LoginBox").css('display','block');
				$('.LoginType').val(atob(AptGetJavaScriptCookie('LT')));
				$('.LoginFor').val(atob(AptGetJavaScriptCookie('LANM')));
				$('.LoginData').val(atob(AptGetJavaScriptCookie('LID')));
			}else{
				$('#LgOrSpPopBox').load("<?php echo RootPath; ?>Library/SiteComponents/Login/index.php");
			}
			 
		});
		$(".HeaderSubscriberSpBtn").click(function(){
			$(".SignupPage_PartnerSignupBox").remove();
			$(".LoginPage_LoginBox").remove();
			if($('.SignupPage_SubscriberSignupBox')[0]){
				$(".SignupPage_SubscriberSignupBox").css('display','block');
			}else{
				$('#LgOrSpPopBox').load("<?php echo RootPath; ?>Library/SiteComponents/SubscriberSignup/index.php");
			}
		});
		$(".HeaderPartnerSpBtn").click(function(){
			$(".SignupPage_SubscriberSignupBox").remove();
			$(".LoginPage_LoginBox").remove();
			if($('.SignupPage_PartnerSignupBox')[0]){
				$(".SignupPage_PartnerSignupBox").css('display','block');
			}else{
				$('#LgOrSpPopBox').load("<?php echo RootPath; ?>Library/SiteComponents/PartnerSignup/index.php");
			}
		});

		window.HeaderPrimaryMenuAccountLogoutBtnSmtBtn = false;
		$(".HeaderPrimaryMenuAccountLogout").click(function(){

			if(window.HeaderPrimaryMenuAccountLogoutBtnSmtBtn != false){ return false; }
			HeaderPrimaryMenuAccountLogoutBtnSmtBtnStart();
			var client = new ClientJS();
			imprint.test(browserTests).then(function(result){
				var fingerprint_1 = new Fingerprint().get();
				var customfingerprint_1 = new Fingerprint({screen_resolution: true}).get();
				audioFingerprint.run(function (fingerprint_2) {
					var BrowserClientId1 = RandomPass1 + new jsSHA(fingerprint_1.toString()+customfingerprint_1.toString()+result+fingerprint_3.toString()+uid.toString()+client.getFingerprint().toString()+fingerprint_2+fingerprint_canvas()+client.getCanvasPrint()+fingerprint_display().toString()+fingerprint_touch().toString()+client.getBrowser().toString()+client.getOS().toString()+client.getScreenPrint().toString()).getHash("SHA-512", "HEX") +RandomPass2;
					

					var BrowserClientId2 = RandomPass3+ new jsSHA(customfingerprint_1.toString()+fingerprint_1.toString()+fingerprint_2+uid.toString()+client.getFingerprint().toString()+fingerprint_3.toString()+result+fingerprint_display().toString()+client.getScreenPrint().toString()+client.getBrowser().toString()+client.getOS().toString()+fingerprint_touch().toString()+client.getCanvasPrint()+fingerprint_canvas()).getHash("SHA-512", "HEX") +RandomPass4;

					// append data which we want to send data on targeted page
					var formdata = new FormData();
					formdata.append("Token_CSRF", Token_CSRF);
					formdata.append("BrowserClientId1", BrowserClientId1);
					formdata.append("BrowserClientId2", BrowserClientId2);

					// Check Internet connection
					if(navigator.onLine == false){
						swal.fire('Internet',"It seems that you are offline. Please check your internet connection", "warning");
						HeaderPrimaryMenuAccountLogoutBtnSmtBtnReset();
						return false;
					}
					// Send data on sigup backend page for uploading on the server
					try{
						var ajax = new XMLHttpRequest();
						ajax.addEventListener("load",HeaderPrimaryMenuAccountLogoutHandler,false);
						ajax.open("POST", RootPath+"Library/SiteComponents/Logout/index.php");
						ajax.send(formdata);
					}catch(error){
						swal.fire('Technical Error',"An Technical error occur in login process! Try again later", "warning");
						HeaderPrimaryMenuAccountLogoutBtnSmtBtnReset();
						return false;
					}

					//function run on complete login request
					function HeaderPrimaryMenuAccountLogoutHandler(event){
						HeaderPrimaryMenuAccountLogoutBtnSmtBtnReset();
						var response = $.parseJSON(event.target.responseText);
						if(response['status'] === "Success"){
							swal.fire('Logout',response['msg']['msg'], "success")
							.then((value) => {
								if(response['msg']['NeedRefresh'] == true){
									window.location.href = '<?php echo DomainName; ?>';
								}else{
									window.location.reload();
								}
							});
						}else{
							if(response['status'] == 'info'){
								swal.fire('Logout',response['msg']['msg'], "info")
								.then((value) => {
									if(response['msg']['NeedRefresh' == true]){
										window.location.href = '<?php echo DomainName; ?>';
									}else{
										window.location.reload();
									}
								});
							}else{
								swal.fire('Logout',response['msg'], "error");
							}
						}
					}
				});
			});

			function HeaderPrimaryMenuAccountLogoutBtnSmtBtnStart(){
				window.HeaderPrimaryMenuAccountLogoutBtnSmtBtn = true;
				$(".LogoutSpinLoader").prop('hidden',false);
			}
			function HeaderPrimaryMenuAccountLogoutBtnSmtBtnReset(){
				$(".LogoutSpinLoader").prop('hidden',true);
				window.HeaderPrimaryMenuAccountLogoutBtnSmtBtn = false;
			}
		});

		$('.HeaderPrimaryMenuSearchBarIcon').click(function(){
			swal.fire('Comming soon','This feature may unlock soon','info');
		});
	});
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-173157846-1">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-173157846-1');
</script>
<script src="https://kit.fontawesome.com/c8b0e14dce.js" crossorigin="anonymous"></script>