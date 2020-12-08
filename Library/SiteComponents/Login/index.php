<style>
	.LoginPage_LoginBox{
		height:auto;
		padding: 0px 10px 10px 10px;
		background-color: #0c4da2!important;
		bottom: 0px;
		position: fixed;
		width: 100vh;
		width: calc(100% - 20px);
		overflow: hidden;
	}
	.LgPopClose{
		width: calc(100% + 12px);
		background-color: #fff;
		margin-left: -10px;
		text-align: right;
	}
	.LgPopCloseSpan{
		background-color: #0c4da2;
	    padding: 5px 0px 10px 10px;
	    color: #fff;
	    font-weight: bold;
	    cursor: pointer;
	}
	.LoginPage_DetailBox{
		padding-top: 10px;
		height: auto;
		display: grid;
		text-align:center;
		grid-template-columns: repeat(2,1fr);
		grid-gap: 20px 30px;
	}
	.LoginPage_DetailBox select{
		height: 40px;
		border: none;
		width: 100%;
	}
	.LoginPage_DetailBox input{
		height:34px;
		border: none;
		padding: 3px;
		width: calc(100% - 6px);
	}
	.LgBtn{
		border: 2px solid #fff;
		font-size: 16px;
		text-align: center;
		padding: 10px 0px 6px 0px;
		font-weight: bold;
		color: #fff;
		border-radius: 0px 10px;
		cursor: pointer;
		margin: 20px auto 0px auto;
		max-width: 380px;
	}

	.LoginError{
		background: rgb(0,0,0,0.5);
	    width: calc(100% - 6px);
	    margin: 0px;
	    color: red;
	    padding: 3px 3px;
	    text-align: left;
	    font-size: 14px;
	    display: none;
	}

	@media(max-width: 680px){
		.LoginPage_DetailBox{
			grid-gap: 20px 10px;
		}
	}

	@media(max-width: 680px){
		.LoginPage_DetailBox{
			grid-template-columns: 1fr;
		}
		.LoginPage_DetailBox input, .LoginPage_DetailBox select{
			border-radius: 0px 10px;
		}
	}
</style>
<section class='LoginPage_LoginBox'>
	<div class='LgPopClose'><span class='LgPopCloseSpan'>Close</span></div>
	<div class="LoginPage_DetailBox">
		<div>
			<select class='LoginType'>
				<option value=''>Login Type</option>
				<option value='Subscriber'>Subscriber</option>
				<option value='Partner'>Partner</option>
				<option value='Main'>Main</option>
			</select>
			<span class="LoginError LoginTypeError"></span>
		</div>
		<div>
			<input type="text" placeholder="Login For" class="LoginFor" style='display: block;' disabled="true">
			<span class="LoginError LoginForError"></span>
		</div>
		<div>
			<input type="text" placeholder="Mobile or Email" class="LoginData">
			<span class="LoginError LoginDataError"></span>
		</div>
		<div>
			<input type="Password" placeholder="Password" class="Password">
			<span class="LoginError PasswordError"></span>
		</div>
	</div>
	<div class="LgBtn" id="LgBtn">login <span class="LoginSpinLoader" hidden="true"><span class="spin_loader_round spin_button_center"><span></span></span></span></div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		
		$(".LoginFor").keyup(function(){
			if(this.value != ""){
				$(".LoginForError").html("").css({'display':'none'});
				$(".LoginFor").css({'border':'1px solid darkgray'});
			}
		});
		$(".LoginFor").blur(function(){
			if(this.value == ""){
				$(".LoginForError").html("Login For Must required").css('display','block');
			}
		});

		$(".LoginType").change(function(){
			if(this.value == ""){
				$(".LoginTypeError").html("Login Type must required").css('display','block');
			}else{
				$(".LoginTypeError").html("").css({'display':'none'});
				$(".LoginType").css({'border':'1px solid darkgray'});
			}

			if(this.value == 'Main'){
				$(".LoginFor").val("Main").prop('disabled',true);
				$(".LoginForError").html("").css({'display':'none'});
			}else if(this.value == 'Subscriber'){
				$(".LoginFor").val("Subscriber").prop('disabled',true);
				$(".LoginForError").html("").css({'display':'none'});
			}else{
				$(".LoginFor").val(atob(AptGetJavaScriptCookie('LANM'))).prop('disabled',false);
			}
		});

		$(".LoginType").blur(function(){
			if(this.value == ""){
				$(".LoginTypeError").html("Login Type must required").css('display','block');
			}
		});

		$(".LoginData").keyup(function (){
			if(this.value != ""){
				$(".LoginDataError").html("").css({'display':'none'});
				$(".LoginData").css({'border':'1px solid darkgray'});
			}
			
		});
		$(".LoginData").blur(function (){
			if(this.value == ""){
				$(".LoginDataError").html("Mobile Or Email must required").css('display','block');
			}
		});

		$(".Password").keyup(function (){
			if(this.value != ""){
				$(".PasswordError").html("").css({'display':'none'});
				$(".Password").css({'border':'1px solid darkgray'});
			}
			
		});
		$(".Password").blur(function (){
			if(this.value == ""){
				$(".PasswordError").html("Password must required").css('display','block');
			}
		});

		window.LgBtnSmtBtn = false;
		$("#LgBtn").click(function(){

			if(window.LgBtnSmtBtn != false){ return false; }
			LgBtnSmtBtnStart();
			const AllInputClassStore = ["LoginType","LoginFor",'LoginData',"Password"];
			for(var i=0; i<AllInputClassStore.length; i++){
				if($("."+AllInputClassStore[i].split("&")[0]).val().length == 0){
					LgBtnSmtBtnReset();
					$("."+AllInputClassStore[i].split("&")[0]).css('border','2px solid red');
					$('.LoginPage_LoginBox').animate({'scrollTop' : $("#"+AllInputClassStore[i].split("&")[0]).position().top - 70});
					$("."+AllInputClassStore[i].split("&")[0]).focus();
					return false;
				}else{
					$("."+AllInputClassStore[i].split("&")[0]).css('border','1px solid darkgray');
				}
			}

			LoginType = $(".LoginType").val();
			LoginFor = $(".LoginFor").val();
			LoginData = $(".LoginData").val();
			Password = $(".Password").val();


			var client = new ClientJS();
			imprint.test(browserTests).then(function(result){
				var fingerprint_1 = new Fingerprint().get();
				var customfingerprint_1 = new Fingerprint({screen_resolution: true}).get();
				audioFingerprint.run(function (fingerprint_2) {
					var BrowserClientId1 = RandomPass1 + new jsSHA(fingerprint_1.toString()+customfingerprint_1.toString()+result+fingerprint_3.toString()+uid.toString()+client.getFingerprint().toString()+fingerprint_2+fingerprint_canvas()+client.getCanvasPrint()+fingerprint_display().toString()+fingerprint_touch().toString()+client.getBrowser().toString()+client.getOS().toString()+client.getScreenPrint().toString()).getHash("SHA-512", "HEX") +RandomPass2;
					

					var BrowserClientId2 = RandomPass3+ new jsSHA(customfingerprint_1.toString()+fingerprint_1.toString()+fingerprint_2+uid.toString()+client.getFingerprint().toString()+fingerprint_3.toString()+result+fingerprint_display().toString()+client.getScreenPrint().toString()+client.getBrowser().toString()+client.getOS().toString()+fingerprint_touch().toString()+client.getCanvasPrint()+fingerprint_canvas()).getHash("SHA-512", "HEX") +RandomPass4;

					// append data which we want to send data on targeted page
					var formdata = new FormData();
					formdata.append("AccountType", LoginType);
					formdata.append("AccountName", LoginFor);
					formdata.append("LoginData", LoginData);
					formdata.append("Password", Password);
					formdata.append("Token_CSRF", Token_CSRF);
					formdata.append("BrowserClientId1", BrowserClientId1);
					formdata.append("BrowserClientId2", BrowserClientId2);

					// Check Internet connection
					if(navigator.onLine == false){
						swal.fire('Internet',"It seems that you are offline. Please check your internet connection", "warning");
						LgBtnSmtBtnReset();
						return false;
					}
					// Send data on sigup backend page for uploading on the server
					try{
						var ajax = new XMLHttpRequest();
						ajax.addEventListener("load",LoginHandler,false);
						ajax.open("POST", RootPath+"Library/SiteComponents/Login/LoginBackend.php");
						ajax.send(formdata);
					}catch(error){
						swal.fire('Technical Error',"An Technical error occur in login process! Try again later", "warning");
						LgBtnSmtBtnReset();
						return false;
					}

					//function run on complete login request
					function LoginHandler(event){
						LgBtnSmtBtnReset();
						if(LoginType != 'Partner'){
							$('.LoginFor').prop("disabled",true);
						}
						var response = $.parseJSON(event.target.responseText);
						if(response['status'] === "Success"){
							$('input').val(''); $('textarea').val(''); $('select').val('');
							$(".LoginPage_LoginBox").css('display','none');
							swal.fire('Login','Login Suceesfully','success')
							.then((value) => {
								window.location.reload();
							});
						}else{
							if(response['status'] == 'Already'){
								swal.fire('Login',response['msg'], "warning")
								.then((value) => {
									window.location.reload();
								});
							}if(response['status'] == 'warning'){
								swal.fire('Login',response['msg'], "warning");
							}else{
								swal.fire('Login',response['msg'], "error");
							}
						}
					}
				});
			});

			function LgBtnSmtBtnStart(){
				window.LgBtnSmtBtn = true;
				$(".LoginSpinLoader").prop('hidden',false);
				$("input").prop("disabled",true);
				$("select").prop("disabled",true);
				$('.LgBtn').css("pointer-events","none");
				$(".LgBtn").css("background","linear-gradient(skyblue, pink)");
				$(".LgBtn").css("cursor","default");
			}
			function LgBtnSmtBtnReset(){
				$("input").prop("disabled",false);
				$("select").prop("disabled",false);
				$('.LgBtn').css("pointer-events","auto");
				$(".LgBtn").css("background","transparent");
				$(".LgBtn").css("cursor","pointer");
				$(".LoginSpinLoader").prop('hidden',true);
				window.LgBtnSmtBtn = false;
			}
		});

		$(".LgPopCloseSpan").click(()=>{
			$(".LoginPage_LoginBox").css('display','none');
			$(".LoginError").html('').css('display','none');
			$(".LoginType").css('border','1px solid darkgray');
			$(".LoginFor").css('border','1px solid darkgray');
			$(".LoginData").css('border','1px solid darkgray');
			$(".Password").css('border','1px solid darkgray');
		});

		(function(){
			$('.LoginType').val(atob(AptGetJavaScriptCookie('LT')));
			$('.LoginData').val(atob(AptGetJavaScriptCookie('LID')));
			$('.LoginType').trigger('change');
			$('.LoginFor').val(atob(AptGetJavaScriptCookie('LANM')))
			 s;
		})();
	});	
</script>