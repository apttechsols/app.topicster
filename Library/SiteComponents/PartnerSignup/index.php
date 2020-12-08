<style>
	body{
		margin: 0px;
	}

	input, select{
		height: 40px;
		padding:5px;
		border-radius: 10px  0px 10px 0px;
		color: #3c3c3c;;
	}

	select{
		width: 100%;
		height: 50px!important;
	}

	textarea{
		width: calc(100% - 12px);
		resize: none;
		min-height: 100px;
		padding:5px;
		border-radius: 10px  0px 10px 0px;
		line-height: 1.8em;
		color: #3c3c3c;;
	}

	.SignupPage_PartnerSignupBox{
		width: 100%;
		height: 100%;
		background-color: rgb(0,0,0,0.8);
		overflow-x: hidden;
		position: fixed;
		top: 0px;
	}
	.SignupPage_PartnerSignupBox input ,select{
		outline: none;
		border: none;
		width: calc(100% - 10px);
	}
	.PartnerSignupCloseBtn{
		max-width: 924px;
		background-color: transparent;
		margin: 30px auto 0px auto;
		height: 20px;
		color: #fff;
		font-size: 16px;
		font-weight: bold;
	}
	.PartnerSignupCloseBtn p{
		background-color: #0c4da2;
		width: 60px;
		margin: 0px;
		float: right;
		text-align: center;
		cursor: pointer;
	}
	.PartnerSignupCloseBtn p:hover{
		background-color: #000;
	}
	.PartnerSignupBox{
		border: 3px solid #fff;
	    height: auto;
	    width: calc(100% - 46px);
	    max-width: 924px;
	    background-color: #0c4da2;
	    text-align: center;
	    display: grid;
	    padding: 10px;
	    grid-row-gap: 5px;
	    margin: 0px auto 30px auto;
	    border-radius: 0px 10px;
	}
	.PartnerSignupBoxImagebox{
		padding:15px;
	}
	.change_signup_profile_image{
		position: absolute;
	    margin-top: -80px;
	    margin-left: -48px;
	    width: 100px;
	    text-align: center;
	    color: white;
	    background: rgb(0,0,0,0.5);
	    border-radius: 5px;
	    cursor: pointer;
	    opacity: 0.5;
	}
	.signup_image{
		height: 150px;
		width: 150px;
		border-radius: 50%;
	}
	.RoundPartnerSignupBoxImagebox{
		border: 5px solid #fff;
		height: 150px;
		
		margin:auto;
		width: 150px; 
		border-radius:50%; 
	}
	
	.PartnerSignupBoxForm1{
		padding:5px;
		display: grid;
		grid-template-columns:repeat(2,1fr);
		grid-gap: 35px 25px;
		overflow: hidden;
	}
	
	.PartnerSignupBoxForm2{
		padding:5px;
		display: grid;
		grid-template-columns:1fr;
		grid-gap: 35px 25px;
		overflow: hidden;
	}
	.SignupClickbox{
		border: 2px solid #fff;
		text-align:center;
		color: #fff;
		font-size: 20px;
		font-weight: bold; 
		width: 150px;
		margin:auto;
		height: 50px;
		border-radius: 10px  0px 10px 0px;
	}
	.SignupClickbox p{
		margin-top:12px;
	}
	.SignupClickbox:hover{
		background-color: green;
		cursor: pointer;
	}

	.Signup_response_main_box {
	    width: 100%;
	    text-align: center;
	    margin-bottom: -16px;
	}
	.Signup_response {
	    font-size: 14px;
	    color: red;
	}
	.Signup_button {
	    border: 1px solid #fff;
	    border-radius: 15px 0px;
	    width: 150px;
	    height: 30px;
	    text-align: center;
	    font-size: 22px;
	    padding-top: 4px;
	    margin: 40px auto 30px auto;
	    cursor: pointer;
	    color: #fff;
	}
	
	.Create_new_account_text {
	    text-align: center;
	    cursor: default;
	    margin-bottom: 25px;
		color: red;
	}
	.Goto_login_page {
	    color: #fff;
	    font-weight: bold;
	    cursor: pointer;
	}
	.Goto_login_page:hover{
		color: green;
		text-decoration: underline;
	}
	.Signup_bottom_all_links {
	    width: 100%;
	    display: flex;
	    box-sizing: border-box;
	    justify-content: center;
	    color: #fff;
	}
	.Signup_help, .Signup_TAndC, .Signup_privacy, .Signup_how_it_works {
	    width: 30%;
	    text-align: center;
	    margin: 3px;
	    cursor: pointer;
	}
	.Signup_help:hover, .Signup_TAndC:hover, .Signup_privacy:hover, .Signup_how_it_works:hover {
	    color: green;
		text-decoration: underline;
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

	@media(max-width:520px ){
		.PartnerSignupBoxForm1{
			grid-template-columns:repeat(1,1fr);
		}
	}
</style>
<section class='SignupPage_PartnerSignupBox'>
	<div class="PartnerSignupCloseBtn"><p>Close</p></div>
	<section class='PartnerSignupBox'>
		<div class="PartnerSignupBoxImagebox">
			<div class="RoundPartnerSignupBoxImagebox">
				<div class="signup_image_round_border">
					<img class="signup_image" id="signup_image" src="">
					<div>
					<label for="Signup_image_file_input" class="change_signup_profile_image">Change Profile</label>
					</div>
					<input type="file" class="Signup_image_file_input" id="Signup_image_file_input" name="Signup_image_file_input" accept="image/*" hidden/>
				</div>
			</div>
		</div>
		<div class="PartnerSignupBoxForm1">
				<div>
					<input type="text" name="" placeholder="AccountName" class="AccountName" id="AccountName">
					<span class="Error AccountNameError"></span>
				</div>

				<div>
					<input type="text" name="" placeholder="Display name" class="DisplayName" id="DisplayName">
					<span class="Error DisplayNameError"></span>
				</div>
				<div>
					<input type="text" name="" placeholder="Full name" class="FullName" id="FullName">
					<span class="Error FullNameError"></span>
				</div>
				<div>
					<select class="Gender" id="Gender">
						  <option value="">Gender</option>
						  <option value="Male">Male</option>
						  <option value="Female">Female</option>
						  <option value="Other">Other</option>
					</select>
						  <span class="Error GenderError"></span>
				</div>

				<div>
					<input type="text" name="" placeholder="MobileNo" class="MobileNo" id="MobileNo">
					<span class="Error MobileNoError"></span>
				</div>

				<div>
					<input type="text" name="" placeholder="Email" class="Email" id="Email">
					<span class="Error EmailError"></span>
				</div>

				<div>
					<input type="text" name="" placeholder="Address" class="Address" id="Address">
					<span class="Error AddressError"></span>
				</div>

				<div>
					<input type="text" name="" placeholder="City" class="City" id="City">
					<span class="Error CityError"></span>
				</div>

				<div>
					<input type="text" name="" placeholder="Pincode" class="Pincode" id="Pincode">
					<span class="Error PincodeError"></span>
				</div>

				<div>
				<select name="State" class="State" id="State">
					<option value=""> State</option>
					<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
					<option value="Andhra Pradesh">Andhra Pradesh</option>
					<option value="Arunachal Pradesh">Arunachal Pradesh</option>
					<option value="Assam">Assam</option>
					<option value="Bihar">Bihar</option>
					<option value="Chandigarh">Chandigarh</option>
					<option value="Chhattisgarh">Chhattisgarh</option>
					<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
					<option value="Daman and Diu">Daman and Diu</option>
					<option value="Delhi">Delhi</option>
					<option value="Goa">Goa</option>
					<option value="Gujarat">Gujarat</option>
					<option value="Haryana">Haryana</option>
					<option value="Himachal Pradesh">Himachal Pradesh</option>
					<option value="Jammu and Kashmir">Jammu and Kashmir</option>
					<option value="Jharkhand">Jharkhand</option>
					<option value="Karnataka">Karnataka</option>
					<option value="Kerala">Kerala</option>
					<option value="Lakshadweep">Lakshadweep</option>
					<option value="Madhya Pradesh">Madhya Pradesh</option>
					<option value="Maharashtra">Maharashtra</option>
					<option value="Manipur">Manipur</option>
					<option value="Meghalaya">Meghalaya</option>
					<option value="Mizoram">Mizoram</option>
					<option value="Nagaland">Nagaland</option>
					<option value="Orissa">Orissa</option>
					<option value="Pondicherry">Pondicherry</option>
					<option value="Punjab">Punjab</option>
					<option value="Rajasthan">Rajasthan</option>
					<option value="Sikkim">Sikkim</option>
					<option value="Tamil Nadu">Tamil Nadu</option>
					<option value="Tamil Nadu">Telangana</option>
					<option value="Tripura">Tripura</option>
					<option value="Uttaranchal">Uttaranchal</option>
					<option value="Uttar Pradesh">Uttar Pradesh</option>
					<option value="West Bengal">West Bengal</option>
				</select>
					<span class="Error StateError"></span>
				</div>

				<div>
				<select class="Country" id="Country">
					  <option value="">Country</option>
					  <option value="India">India</option>
				</select>
					<span class="Error CountryError"></span>
				</div>

				<div>
					<input type="password" name="" placeholder="Password" class="Password" id="Password">
					<span class="Error PasswordError"></span>
				</div>

				<div>
					<input type="text" name="" placeholder="Comform Password" class="ComformPassword" id="ComformPassword">
					<span class="Error ComformPasswordError"></span>
				</div>
				<div>
					<input type="text" name="" placeholder="Security Code" class="SecurityCode" id="SecurityCode">
					<span class="Error SecurityCodeError"></span>
				</div>
		</div>
		<div class='PartnerSignupBoxForm2'>
			<div>
				<textarea placeholder="Enter Bio for this Account" class="Bio" id="Bio" spellcheck="false"></textarea>
				<span class="Error BioError"></span>
			</div>
		</div>
		<div class="Signup_response_main_box">
			<p class="Signup_response SelectEventStartAsText" id="Signup_response" onselectstart="return true"></p>
		</div>
		<div class="Signup_button" id="Signup_button">Signup <span class="SignupSpinLoader" hidden="true"><span class="spin_loader_round spin_button_center"><span></span></span></span></div>
		<p class="Create_new_account_text">Already have an account? <span class="Goto_login_page">Login</span></p>
		<section class="Signup_bottom_all_links">
			<div class="Signup_TAndC">Terms & conditaions</div>
			<div class="Signup_privacy">Privacy</div>
			<div class="Signup_help">Need help</div>
			<div class="Signup_how_it_works">How it works?</div>
		</section> 
	</section>
<script>
	$(document).ready(function(){

		(function(){
			$("#signup_image").attr('src',RootPath+'Library/ImageStore/NatureImage.jfif');
		})();

		$(".AccountName").keyup(function(){
			this.value = this.value.replace(/[^A-Za-z0-9_]/g,'').toLowerCase();
			if(this.value.length >= 5 && this.value.length <= 18){
				$(".AccountNameError").html("").css('display','none');
			}
		});
		$(".AccountName").blur(function(){
			if(this.value.length < 5 || this.value.length > 18){
				$(".AccountNameError").html("Username must be between 5 to 18 characters long").css('display','block');
			}
		});

		$(".DisplayName").keyup(function(){
			this.value = this.value.replace(/[^A-Za-z- _:)('|&@!]/g,'').charAt(0).toUpperCase() + this.value.replace(/[^A-Za-z ]/g,'').slice(1).toLowerCase();
			if(this.value.length >= 2 && this.value.length <= 30){  
				$(".DisplayNameError").html("").css('display','none');
			}
	    });
		$(".DisplayName").blur(function(){
			if(this.value.length < 2 || this.value.length > 30){
				$(".DisplayNameError").html("Display name must be between 2 to 30 characters long").css('display','block');
			}
		});

		// FullName Validations 
		$(".FullName").keyup(function(){
			this.value = this.value.replace(/[^A-Za-z ]/g,'').charAt(0).toUpperCase() + this.value.replace(/[^A-Za-z ]/g,'').slice(1).toLowerCase();
			if(this.value.length >= 6 && this.value.length <= 30){
				FullNameSpace = this.value.replace(/[^ ]/g,"").length;
				if(FullNameSpace > 0){
					if(this.value.split(" ")[0].length > 0 && this.value.split(" ")[1].length > 0){
						$(".FullNameError").html("").css('display','none');
					}
				}
			}
	    });
		$(".FullName").blur(function(){
			if(this.value.length < 6 || this.value.length > 30){
				$(".FullNameError").html("Full name must be between 6 to 30 characters long").css('display','block');
			}else if(this.value.replace(/[^ ]/g,"").length < 1){
				$(".FullNameError").html("It's look like first name").css('display','block');
			}else if(this.value.split(" ")[0].length < 1){
				$(".FullNameError").html("It's look like first name").css('display','block');
			}else if(this.value.split(" ")[1].length < 1){
				$(".FullNameError").html("It's look like first name").css('display','block');
			}
		});
		
		$(".Gender").blur(function(){
			if(this.value == ""){
				$(".GenderError").html("Gender must required").css('display','block');
			}
		});
		$(".Gender").change(function(){
			if(this.value != ""){
				$(".GenderError").html("").css('display','none');
			}
		});
		$(".MobileNo").blur(function(){
			this.value	= this.value.replace(/[^0-9]/g,"");
			 if(this.value.length != 10){
				$(".MobileNoError").html("Mobile no must have  10 digit").css('display','block');
			} 

		});
		$(".MobileNo").keyup(function(){
			this.value	= this.value.replace(/[^0-9]/g,"");
			 if(this.value.length == 10){
				$(".MobileNoError").html("").css('display','none');
			} 

		});

		$(".City").keyup(function (){
			this.value = this.value = this.value.replace(/[^A-Za-z]/g,'').charAt(0).toUpperCase() +
			this.value.replace(/[^A-Za-z ]/g,'').slice(1).toLowerCase();
			if(this.value.length <= 50 && this.value.length >= 3){
				$(".CityError").html("").css('display','none');
			}
		});
		$(".City").blur(function (){
			if(this.value.length > 50 || this.value.length < 3){
				$(".CityError").html("City name must be between 3 to 50 characters long").css('display','block');
			}
		});
		$(".Pincode").blur(function(){
			this.value	= this.value.replace(/[^0-9]/g,"");
			 if(this.value.length != 6){
				$(".PincodeError").html("pincode no must have  6 digit").css('display','block');
			} 

		});
		$(".Pincode").keyup(function(){
			this.value	= this.value.replace(/[^0-9]/g,"");
			 if(this.value.length == 6){
				$(".PincodeError").html("").css('display','none');
			} 
		});
		$(".State").blur(function(){
			if(this.value == ""){
				$(".StateError").html("State must required").css('display','block');
			}
		});
		$(".State").change(function(){
			if(this.value != ""){
				$(".StateError").html("").css('display','none');
			}
		});
		$(".Country").blur(function(){
			if(this.value == ""){
				$(".CountryError").html("State must required").css('display','block');
			}
		});
		$(".Country").change(function(){
			if(this.value != ""){
				$(".CountryError").html("").css('display','none');
			}
		});
		
		$(".Address").keyup(function (){
			this.value = this.value = this.value.replace(/[^A-Za-z]/g,'').charAt(0).toUpperCase() + this.value.replace(/[^A-Za-z- _,.]/g,'').slice(1).toLowerCase();
			if(this.value.length <= 40 && this.value.length >= 10){
				$(".AddressError").html("").css('display','none');
			}
		});
		$(".Address").blur(function (){
			if(this.value.length > 40 || this.value.length < 10){
				$(".AddressError").html("Address must have be between 10 to 40 characters long").css('display','block');
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

		$(".ComformPassword").keyup(function (){
			if(this.value == $(".Password").val()){
				$(".ComformPasswordError").html("").css('display','none');
			}

		});
		$(".ComformPassword").blur(function (){
			if(this.value != $(".Password").val()){
				$(".ComformPasswordError").html("Password not Match").css('display','block');
			}
		});

		// SecurityCode Validation
		$(".SecurityCode").keyup(function (){
			this.value = this.value.replace(/[^0-9]/g,"");
			if($(".SecurityCode").val().length >= 4 &&  $(".SecurityCode").val().length <= 6){
				$(".SecurityCodeError").html("").css('display','none');
			}
		});

		$("#SecurityCode").blur(function (){
			if($(".SecurityCode").val().length < 4 ||  $(".SecurityCode").val().length > 8){
				$(".SecurityCodeError").html("Security Code must be between 4 to 8 character long");
			}
		});
		
		$(".Bio").keyup(function (){
			this.value = this.value = this.value.replace(/[^A-Za-z0-9]/g,'').charAt(0).toUpperCase() + this.value.replace(/[^A-Za-z- _,:.&)('@!|]/g,'').slice(1).toLowerCase();
			if(this.value.length >= 40 && this.value.length <= 150){
				$(".BioError").html("").css('display','none');
			}
		});
		
		$(".Bio").blur(function (){
			if(this.value.length < 40 || this.value.length > 150){
				$(".BioError").html("Bio must have be between 40 to 150 characters long").css('display','block');
			}
		});

		// Signup image change
		$("#Signup_image_file_input").change(function(e){
			if(this.files.length == 1){
				var file = this.files[0];
				var fileType = file["type"];
				var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
				if ($.inArray(fileType, validImageTypes) < 0) {
					swal.fire('',"Invalid file type", "error")
					.then((value) => {
						$("#Signup_image_file_input").click(); 	
					});
					return false;
				}else{
					if((this.files[0].size/1024).toFixed(2) < 2048){
						if (this.files && this.files[0]) {
							var reader = new FileReader();
							reader.onload = function (e) {
								$('#signup_image').attr('src', e.target.result);
							}
							reader.readAsDataURL(this.files[0]);
						}
					}else{
						swal.fire("Image size must be under 2 mb", "", "warning")
						.then((value) => {
							$('#signup_image').attr('src', RootPath+"Library/ImageStore/photo.png");
							$("#Signup_image_file_input").click();
						});
					}
				}
			}else{
				if(this.files.length > 1){
					swal.fire("Select only one Profile image", "", "warning")
					.then((value) => {
						$('#signup_image').attr('src', RootPath+"Library/ImageStore/photo.png");
						$("#Signup_image_file_input").click();
					});
				}else{
					swal.fire("Profile image must required", "", "warning")
					.then((value) => {
						$('#signup_image').attr('src', RootPath+"Library/ImageStore/photo.png");
						$("#Signup_image_file_input").click();
					});
				}
				return false;
			}
			$("#Signup_response").html("").css('display','none');	
		});

		window.Signup_buttonSmtBtn = false;
		$("#Signup_button").click(function(){

			if(window.Signup_buttonSmtBtn != false){ return false; }
			Signup_buttonSmtBtnStart();
			const AllInputClassStore = ["AccountName","DisplayName",'FullName',"Gender","MobileNo",'Email',"City","Pincode","State","Country",
				"Address","Password","ComformPassword",'SecurityCode','Bio'];
			for(var i=0; i<AllInputClassStore.length; i++){
				if($("."+AllInputClassStore[i].split("&")[0]).val().length == 0){
					$("."+AllInputClassStore[i].split("&")[0]).css('border','2px solid red');
					$('.SignupPage_PartnerSignupBox').animate({'scrollTop' : $("#"+AllInputClassStore[i].split("&")[0]).position().top - 70});
					$("."+AllInputClassStore[i].split("&")[0]).focus();
					Signup_buttonSmtBtnReset();
					return false;
				}else{
					$("."+AllInputClassStore[i].split("&")[0]).css('border','1px solid darkgray');
				}
			}
			AccountName = $(".AccountName").val();
			DisplayName = $(".DisplayName").val();
			FullName = $(".FullName").val();
			Gender = $(".Gender").val();
			MobileNo = $(".MobileNo").val();
			Email = $(".Email").val();
			City = $(".City").val();
			Pincode = $(".Pincode").val();
			State = $(".State").val();
			Country = $(".Country").val();
			Address = $(".Address").val();
			Password = $(".Password").val();
			ComformPassword = $(".ComformPassword").val();
			SecurityCode = $(".SecurityCode").val();
			Bio = $(".Bio").val();
			
			// Signup image revalidation
			if(document.getElementById("Signup_image_file_input").files.length == 1){
				Signup_image_file = $("#Signup_image_file_input")[0].files[0];
				if((Signup_image_file.size/1024).toFixed(2) > 2048){ // Signup image Size in mb
					swal.fire("Image size must be under 5 mb")
					.then((value) => {
						$("#Signup_image_file_input").click();
					});
					Signup_buttonSmtBtnReset();
					return false;
				}
			}else{
				if(document.getElementById("Signup_image_file_input").files.length > 1){
					swal.fire("Select only one Profile image")
					.then((value) => {
						$("#Signup_image_file_input").click();
					});
				}else{
					swal.fire("Profile image must required")
					.then((value) => {
						$("#Signup_image_file_input").click();
					});
				}
				Signup_buttonSmtBtnReset();
				return false;
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
					formdata.append("AccountType", 'Partner');
					formdata.append("AccountName", AccountName);
					formdata.append("DisplayName", DisplayName);
					formdata.append("FullName", FullName);
					formdata.append("Gender", Gender);
					formdata.append("MobileNo", MobileNo);
					formdata.append("Email", Email);
					formdata.append("City", City);
					formdata.append("Pincode", Pincode);
					formdata.append("State", State);
					formdata.append("Country", Country);
					formdata.append("Address", Address);
					formdata.append("Password", Password);
					formdata.append("SecurityCode", SecurityCode);
					formdata.append("Bio", Bio);
					formdata.append("ProfileImage", Signup_image_file);
					formdata.append("MobileOTP", '123456');
					formdata.append("EmailOTP", '123456');
					formdata.append("Token_CSRF", Token_CSRF);
					formdata.append("BrowserClientId1", BrowserClientId1);
					formdata.append("BrowserClientId2", BrowserClientId2);

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
						if(response['status'] === "Success"){
							$('input').val(''); $('textarea').val(''); $('select').val('');
							Swal.fire({
							  icon: 'success',
							  title: 'Signup',
							  text: response['msg'],
							  buttons: {
									cancel: "Not Now",
									Login: true,
								},
							})
							.then((value) => {
								$(".PartnerSignupCloseBtn").click();
								if(value === "Login"){
									$.when($(".HeaderLoginBtn").click()).then(function( x ) {
										$("input").prop("disabled",true);
										$("select").prop("disabled",true);
										$("textarea").prop("disabled",true);
										$('.LgBtn').css("pointer-events","none");
										$(".LgBtn").css("cursor","default");
										setTimeout(function(){
											$('.LoginType').val('Partner');
											$('.LoginFor').val(AccountName);
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
									$(".HeaderLoginBtn").click();
								}
							});
						}else{
							if(response['status'] == 'warning'){
								$('.HeaderPrimaryMenuLogin').css('display','none');
								$('.HeaderPrimaryMenuSignup').css('display','none');
								$('.HeaderPrimaryMenuAccount').css('display','block');
								swal.fire('Signup',response['msg'],'warning'); $(".PartnerSignupCloseBtn").click(); return false;
							}else if(response['code'] == 204){
								swal.fire(response['status'],response['msg'],'info');  $(".PartnerSignupCloseBtn").click(); return false;
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

		$(".PartnerSignupCloseBtn").click(()=>{
			$(".SignupPage_PartnerSignupBox").css('display','none');
		});
	});
</script>