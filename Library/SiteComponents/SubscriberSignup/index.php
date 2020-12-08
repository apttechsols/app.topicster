<style>
	body{
		margin: 0px;
	}

	input{
		height: 40px;
		padding:5px;
		border-radius: 10px  0px 10px 0px;
		color: #3c3c3c;;
		width: 100%;
	}
	.SignupPage_SubscriberSignupBox{
		height:auto;
		padding: 0px 10px 10px 10px;
		background-color: #0c4da2!important;
		bottom: 0px;
		position: fixed;
		width: 100vh;
		width: calc(100% - 20px);
		overflow: hidden;
	}
	.SpPopClose{
		width: calc(100% + 12px);
		background-color: #fff;
		margin-left: -10px;
		text-align: right;
	}
	.SubscriberSignupCloseBtn{
		background-color: #0c4da2;
	    padding: 5px 0px 10px 10px;
	    color: #fff;
	    font-weight: bold;
	    cursor: pointer;
	}
	.SubscriberSignupBoxDetail{
		padding-top: 10px;
		height: auto;
		display: grid;
		text-align:center;
		grid-template-columns: repeat(2,1fr) 150px;
		grid-gap: 20px 30px;
	}
	.SubscriberSignupBoxDetail input{
		height:40px;
		border: none;
		padding: 3px;
	}
	.Name{
		border-radius: 10px 0px 0px 10px;
	}
	.Passward{
		border-radius: 0px 10px 10px 0px;
	}
	.Signup_button {
	    border: 1px solid #fff;
	    border-radius: 15px 0px;
	    width: 150px;
	    height: 30px;
	    text-align: center;
	    font-size: 22px;
	    padding-top: 4px;
	    margin: auto;
	    cursor: pointer;
	    color: #fff;
	}

	.Error{
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
		.SubscriberSignupBoxDetail{
			grid-gap: 20px 10px;
		}
	}

	@media(max-width: 680px){
		.SubscriberSignupBoxDetail{
			grid-template-columns: 1fr;
		}
		.SubscriberSignupBoxDetail input{
			border-radius: 0px 10px;
		}
		.SpBtn{
			max-width: 150px;
			margin: auto;
			width: 100%;
			height: 25px;
		}
	}
</style>
<section class='SignupPage_SubscriberSignupBox'>
	<div class='SpPopClose'><span class='SubscriberSignupCloseBtn'>Close</span></div>
	<div class="SubscriberSignupBoxDetail">
		<div>
			<input type="text" name="" placeholder="Mobile Or Email" class="Email" id="Email">
			<span class="Error EmailError"></span>
		</div>
		<div>
			<input type="password" name="" placeholder="Password" class="Password" id="Password">
			<span class="Error PasswordError"></span>
		</div>
		<div class="Signup_button" id="Signup_button">Signup <span class="SignupSpinLoader" hidden="true"><span class="spin_loader_round spin_button_center"><span></span></span></span></div>
	</div>
	
</section>
<script type="text/javascript">
	$(document).ready(function(){

		$(".Email").keyup(function(){
			if(this.value.length >= 4 && this.value.length <= 60){
				$(".EmailError").html("").css('display','none');
			}
		});
		$(".Email").blur(function(){
			if(this.value.length < 4 || this.value.length > 60){
				$(".EmailError").html("Mobile or Email must be between 4 to 60 characters long").css('display','block');
			}
		});

		$(".Password").keyup(function (){
			if(this.value.length <= 40 && this.value.length >= 8){
				$(".PasswordError").html("").css('display','none');
			}
			
		});
		$(".Password").blur(function (){
			if(this.value.length > 40 || this.value.length < 8){
				$(".PasswordError").html(" Password must have be between 8 to 40 characters long").css('display','block');
			}
			
		});

		window.Signup_buttonSmtBtn = false;
		$("#Signup_button").click(function(){

			if(window.Signup_buttonSmtBtn != false){ return false; }
			Signup_buttonSmtBtnStart();
			const AllInputClassStore = ["Email","Password"];
			for(var i=0; i<AllInputClassStore.length; i++){
				if($("."+AllInputClassStore[i].split("&")[0]).val().length == 0){
					$("."+AllInputClassStore[i].split("&")[0]).css('border','2px solid red');
					$('.SignupPage_SubscriberSignupBox').animate({'scrollTop' : $("#"+AllInputClassStore[i].split("&")[0]).position().top - 70});
					$("."+AllInputClassStore[i].split("&")[0]).focus();
					Signup_buttonSmtBtnReset();
					return false;
				}else{
					$("."+AllInputClassStore[i].split("&")[0]).css('border','1px solid darkgray');
				}
			}
			Email = $(".Email").val();
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
					formdata.append("AccountType", 'Subscriber');
					formdata.append("Email", Email);
					formdata.append("Password", Password);
					formdata.append("MobileOTP", '123456');
					formdata.append("EmailOTP", '123456');
					formdata.append("Token_CSRF", Token_CSRF);
					formdata.append("BrowserClientId1", BrowserClientId1);
					formdata.append("BrowserClientId2", BrowserClientId2);
					formdata.append("AccountName", '');
					formdata.append("DisplayName", '');
					formdata.append("FullName", '');
					formdata.append("Gender", '');
					formdata.append("MobileNo", '');
					formdata.append("City", '');
					formdata.append("Pincode", '');
					formdata.append("State", '');
					formdata.append("Country", '');
					formdata.append("Address", '');
					formdata.append("SecurityCode", '');
					formdata.append("Bio", '');
					formdata.append("ProfileImage", '');

					// Check Internet connection
					if(navigator.onLine == false){
						swal.fire('Internet',"It seems that you are offline. Please check your internet connection", "warning");
						Signup_buttonSmtBtnReset();
						return false;
					}
					// Send data on sigup backend page for uploading on the server
					try{
						var ajax = new XMLHttpRequest();
						ajax.addEventListener("load",SignupHandler,false);
						ajax.open("POST", RootPath+"Library/SiteComponents/SignupBackend/index.php");
						ajax.send(formdata);
					}catch(error){
						swal.fire('Technical Error',"An Technical error occur in signup process! Try again later", "warning");
						Signup_buttonSmtBtnReset();
						return false;
					}

					//function run on complete signup request
					function SignupHandler(event){
						Signup_buttonSmtBtnReset();
						var response = $.parseJSON(event.target.responseText);
						if(response['status'] == 'Success'){
							$('input').val(''); $('textarea').val(''); $('select').val('');
							swal.fire(response['msg'], {
								icon: "success",
								buttons: {
									cancel: "Not Now",
									Login: true,
								},
							})
							.then((value) => {
								$(".SubscriberSignupCloseBtn").click();
								if(value === "Login"){
									$.when($(".HeaderLoginBtn").click()).then(function( x ) {
										$("input").prop("disabled",true);
										$("select").prop("disabled",true);
										$("textarea").prop("disabled",true);
										$('.LgBtn').css("pointer-events","none");
										$(".LgBtn").css("cursor","default");
										setTimeout(function(){
											$('.LoginType').val('Subscriber');
											$('.LoginFor').val('');
											$('.LoginData').val(Email);
											$('.Password').val(Password);
											$('.LoginType').trigger('change');
											$("input").prop("disabled",false);
											$("select").prop("disabled",false);
											$('.LgBtn').css("pointer-events","auto");
											$(".LgBtn").css("cursor","pointer");
											$('#LgBtn').click();
										}, 300);
									});
								}

							});
						}else{
							if(response['status'] == 'warning'){
								$('.HeaderPrimaryMenuLogin').css('display','none');
								$('.HeaderPrimaryMenuSignup').css('display','none');
								$('.HeaderPrimaryMenuAccount').css('display','block');
								swal.fire('Signup',response['msg'],'warning'); $(".SubscriberSignupCloseBtn").click(); return false;
							}else if(response['code'] == 204){
								swal.fire(response['status'],response['msg'],'info'); return false;
							}
							swal.fire('Signup',response['msg'], "error");
						}
					}
				});
			});

			function Signup_buttonSmtBtnStart(){
				window.Signup_buttonSmtBtn = true;
				$(".SignupSpinLoader").prop('hidden',false);
				$("input").prop("disabled",true);
				$("select").prop("disabled",true);
				$("textarea").prop("disabled",true);
				$('.Signup_button').css("pointer-events","none");
				$(".Signup_button").css("background","linear-gradient(skyblue, pink)");
				$(".Signup_button").css("cursor","default");
			}
			function Signup_buttonSmtBtnReset(){
				$("input").prop("disabled",false);
				$("select").prop("disabled",false);
				$("textarea").prop("disabled",false);
				$('.Signup_button').css("pointer-events","auto");
				$(".Signup_button").css("background","transparent");
				$(".Signup_button").css("cursor","pointer");
				$(".SignupSpinLoader").prop('hidden',true);
				window.Signup_buttonSmtBtn = false;
			}
		});
		
		$(".SubscriberSignupCloseBtn").click(()=>{
			$(".SignupPage_SubscriberSignupBox").css('display','none');
		});
	});
</script>