<?php
	error_reporting(0);
	define('RootPath', '../../../');
	define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
	define('PageSetting', ['BrowserTitle'=>'Topicster : Account Review','PageTitle'=>'Account Review','css'=>'AccountReview','HeaderMenuActive'=>'Account>Dashboard']);
	require(RootPath."Library/SiteComponents/FrontEndControlPage/index.php");
	require(RootPath."Library/SiteComponents/FrontAndBackEndControlPage/index.php");
	require(RootPath."Library/SiteComponents/Header/index.php");
	
	if($IsLogin['code'] != 200){
		header("Location: " . RootPath);
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'Authentication failed [Login]']); exit();
	}else if($IsLogin['LAS'] != 'Main'){
		header("Location: " . RootPath);
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'Authentication failed [Login]']); exit();
	}
	
	$GetPartnerReviewAccount = AptPdoFetchWithAes(['Condtion'=> "AccountType::::Partner::,::Status::::Review",'FetchData'=>'UserUrl::::AccountName::::Bio', 'DbCon'=> $PdoTopicsterMain, 'TbName'=> 'account', 'EPass'=> $EPass,'FetchRowNo'=>'All']);
	
	if($GetPartnerReviewAccount['code'] == 200){
		#Continue
	}else if($GetPartnerReviewAccount['code'] == 404){
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'No Partner Account In Review [Complete]']); exit();
	}else{
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'Partner Account Not Fetched due to technical error [Account]']); exit();
	}

	$PartnerReviewAccountStore = array();
	foreach ($GetPartnerReviewAccount['msg'] as $key => $value){
		$TmpArray = array();
		$GetPartnerAccountDtls = AptPdoFetchWithAes(['Condtion'=> "UserUrl::::".$value->UserUrl,'FetchData'=>'FullName::::Email::::Mobile::::Gender::::Profile::::Address::::Pincode::::City::::State::::Country::::SocialAccount', 'DbCon'=> $PdoTopicsterPartner, 'TbName'=> $value->UserUrl.'_account', 'EPass'=> $EPass]);

		if($GetPartnerAccountDtls['code'] == 200){
			$GetPartnerAccountDtls['msg']->UserUrl = $value->UserUrl;
			$GetPartnerAccountDtls['msg']->AccountName = $value->AccountName;
			$GetPartnerAccountDtls['msg']->Bio = $value->Bio;
			array_push($PartnerReviewAccountStore, $GetPartnerAccountDtls['msg']);
		}else{
			foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
			AptFullScreenMsg(['msg'=>'Partner Account Not Fetched due to technical error [Partner Account]']); exit();
		}
	}
?>
<style>
	.PredefineContainer{
		border: 1px solid #000;
		min-height: calc(100vh - 300px);
		grid-template-columns: 1fr;
		border: none;

	}
	.Container{
		border: 1px solid #6d6d6d;
		padding: 10px 10px 30px 10px;
		border-radius: 5px;
	}
	.Form2{
		display: grid;
		grid-template-columns: 1fr 1fr 1fr;
		grid-gap: 20px 30px;
	}
	.FormLast{
		display: grid;
		grid-template-columns: 1fr 1fr;
		grid-gap: 20px 30px;
	}
	.Profile{
		width: 180px;
		height: 180px;
		border-radius: 50%;
		border: 5px solid #6d6d6d;
		margin-bottom: 10px;
	}
	.Profile:hover{
		opacity: 0.9;
	}
	.DtlBox{
		margin: auto;
		text-align: center;
		width: calc(100% - 20px);
	}
	.DtlTl{
		background: #6d6d6d;
		color: #fff;
		padding: 5px;
	}
	.DtlDes{
		overflow-y: auto;
		border: 1px solid #6d6d6d;
		width: calc(100% - 12px);
		padding: 5px;
	}
	.FormLast div, .ReasonBox, .SmtBtn{
		background: #6d6d6d;
		max-width: 380px;
		min-height: 23px;
		padding: 0px 5px 5px 5px;
		color: #fff;
		border-radius: 5px;
		text-align: center;
		margin: 20px auto 0px auto;
		cursor: pointer;
		display: flex;
		outline: none;
		width: calc(100% - 27px);
		overflow: hidden;
	}
	.switch {
		position: relative;
		display: inline-block;
		width: calc(100% - 80px);
		height: 30px;
		margin: 7px 0px 0px 5px;
	}

	.switch input { 
		opacity: 0;
		width: 0;
		height: 0;
	}

	.slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #ccc;
		-webkit-transition: .4s;
		transition: .4s;
	}

	.slider:before {
		position: absolute;
		content: "";
		height: 30px;
		width: 30px;
		left: 0px;
		background-color: white;
		-webkit-transition: .4s;
		transition: .4s;
		margin: 0px 0px -4px 0px;
	}

	input:checked + .slider {
		background-color: #2196F3;
	}

	input:focus + .slider {
		box-shadow: 0 0 1px #2196F3;
	}

	input:checked + .slider:before {
		-webkit-transform: translateX(252px);
		-ms-transform: translateX(252px);
		transform: translateX(252px);
	}

	/* Rounded sliders */
	.slider.round {
		border-radius: 34px;
	}

	.slider.round:before {
		border-radius: 50%;
	}

	.SwitchBtnText{
		font-weight: bold;
		color: red;
		font-size: 25px;
		padding: 5px 0px;
	}

	.ReasonBox{
		max-width: none;
	}

	.Reason{
		width: 100%;
		resize: none;
		padding: 3px;
		margin: 7px auto 3px auto;
	}

	.SecurityCode{
		width: 100%;
		margin: 6px auto 3px auto;
		height: 20px;
		padding: 5px;
	}

	.SmtBtn{
		display: block!important;
		padding: 10px 5px 6px 5px!important;
		font-weight: bold;
		cursor: pointer!important;
	}


	@media (max-width:1200px){
		.Form2{
			grid-template-columns: 1fr 1fr;
		}
	}
	@media (max-width:580px){
		.Form2{
			grid-template-columns: 1fr;
		}
		.FormLast{
			grid-template-columns: 1fr;
		}
	}
</style>
<?php foreach ($PartnerReviewAccountStore as $key => $value) {
	echo "
		<div class='PredefineContainer' id='Container$value->UserUrl'>
			<div class='Container'>
				<div class='Form1'>
					<div class='DtlBox'>
						<img class='Profile' src='".PartnerDir."$value->AccountName/ProfileImage/$value->Profile'/>
					</div>
				</div>
				<div class='Form2'>
					<div class='DtlBox'>
						<div class='DtlTl'>Account Name</div>
						<div class='DtlDes'>$value->AccountName</div>
					</div>
					<div class='DtlBox'>
						<div class='DtlTl'>Fullname</div>
						<div class='DtlDes'>$value->FullName</div>
					</div>
					<div class='DtlBox'>
						<div class='DtlTl'>Email</div>
						<div class='DtlDes'>$value->Email</div>
					</div>
					<div class='DtlBox'>
						<div class='DtlTl'>Mobile</div>
						<div class='DtlDes'>$value->Mobile</div>
					</div>
					<div class='DtlBox'>
						<div class='DtlTl'>Gender</div>
						<div class='DtlDes'>$value->Gender</div>
					</div>
					<div class='DtlBox'>
						<div class='DtlTl'>Address</div>
						<div class='DtlDes'>$value->Address</div>
					</div>
					<div class='DtlBox'>
						<div class='DtlTl'>Pincode</div>
						<div class='DtlDes'>$value->Pincode</div>
					</div>
					<div class='DtlBox'>
						<div class='DtlTl'>City</div>
						<div class='DtlDes'>$value->City</div>
					</div>
					<div class='DtlBox'>
						<div class='DtlTl'>State</div>
						<div class='DtlDes'>$value->State</div>
					</div>
					<div class='DtlBox'>
						<div class='DtlTl'>Country</div>
						<div class='DtlDes'>$value->Country</div>
					</div>
					<div class='DtlBox'>
						<div class='DtlTl'>Bio</div>
						<div class='DtlDes'>$value->Bio</div>
					</div>
					<div class='DtlBox'>
						<div class='DtlTl'>Social Account</div>
						<div class='DtlDes'>$value->SocialAccount</div>
					</div>
				</div>
				<div class='Form1'>
					<div class='ReasonBox'><textarea class='Reason Reason$value->UserUrl' placeholder='Write reason for reject partner request' spellcheck='false'></textarea></div>
				</div>
				<div class='FormLast'>
					<div class='SwitchBtn'><span class='SwitchBtnText SwitchBtnText$value->UserUrl'>Reject</span><label class='switch'><input type='checkbox' class='SwitchBtnInput' id='SwitchBtnInput$value->UserUrl'><span class='slider round'></span></label></div>
					<div class='SecurityCodeBox'><input class='SecurityCode SecurityCode$value->UserUrl' id='SecurityCode$value->UserUrl' placeholder='enter your security code' type='number' /></div>
				</div>
				<div class='Form1'>	
					<div class='SmtBtn' id='SmtBtn$value->UserUrl'>Submit<span class='SmtBtnSpinLoader' hidden='true'><span class='spin_loader_round spin_button_center'><span></span></span></span></div>
				</div>
			</div>
		</div>
	";
} ?>
<?php require(RootPath."Library/SiteComponents/Footer/index.php"); ?>
</body>
</html>
<script>
	$(document).ready(function(){

		$('.SwitchBtnInput').change(function(){
			var TmpUserUrl = this.id.replace("SwitchBtnInput", "");
    		if($(this).is(":checked")){
    			$('.SwitchBtnText'+TmpUserUrl).html('Approve').css({'color':'#0c4da2'});
    			$('.ReasonBox').css({'display':'none'});
    		}else{
    			$('.SwitchBtnText'+TmpUserUrl).html('Reject').css({'color':'red'});
    			$('.ReasonBox').css({'display':'flex'});
    		}
    	});

		$('.SecurityCode').keyup(function(){
    		$('#'+this.id).css('border','1px solid darkgray');
    	});

		window.SmtBtn = false;
		$(".SmtBtn").click(function(){

			if(window.SmtBtn != false){ return false; }
			var TmpUserUrl = this.id.replace("SmtBtn", "");
			SmtBtnStart();
			const AllInputClassStore = ["SecurityCode"+TmpUserUrl];
			for(var i=0; i<AllInputClassStore.length; i++){
				if($("."+AllInputClassStore[i].split("&")[0]).val().length == 0){
					$("."+AllInputClassStore[i].split("&")[0]).css('border','2px solid red');
					$("."+AllInputClassStore[i].split("&")[0]).focus();
					SmtBtnReset();
					return false;
				}else{
					$("."+AllInputClassStore[i].split("&")[0]).css('border','1px solid darkgray');
				}
			}

			if($('#SwitchBtnInput'+TmpUserUrl).is(":checked")){
				var Decision = 'Approve';
			}else{
				var Decision = 'Reject';
			}

			var SecurityCode = $('#SecurityCode'+TmpUserUrl).val();
			var Reason = $('.Reason'+TmpUserUrl).val();


			var client = new ClientJS();
			imprint.test(browserTests).then(function(result){
				var fingerprint_1 = new Fingerprint().get();
				var customfingerprint_1 = new Fingerprint({screen_resolution: true}).get();
				audioFingerprint.run(function (fingerprint_2) {
					var BrowserClientId1 = RandomPass1 + new jsSHA(fingerprint_1.toString()+customfingerprint_1.toString()+result+fingerprint_3.toString()+uid.toString()+client.getFingerprint().toString()+fingerprint_2+fingerprint_canvas()+client.getCanvasPrint()+fingerprint_display().toString()+fingerprint_touch().toString()+client.getBrowser().toString()+client.getOS().toString()+client.getScreenPrint().toString()).getHash("SHA-512", "HEX") +RandomPass2;
					

					var BrowserClientId2 = RandomPass3+ new jsSHA(customfingerprint_1.toString()+fingerprint_1.toString()+fingerprint_2+uid.toString()+client.getFingerprint().toString()+fingerprint_3.toString()+result+fingerprint_display().toString()+client.getScreenPrint().toString()+client.getBrowser().toString()+client.getOS().toString()+fingerprint_touch().toString()+client.getCanvasPrint()+fingerprint_canvas()).getHash("SHA-512", "HEX") +RandomPass4;

					// append data which we want to send data on targeted page
					var formdata = new FormData();
					formdata.append("AccountUserUsrl", TmpUserUrl);
					formdata.append("Decision", Decision);
					formdata.append("Reason", Reason);
					formdata.append("SecurityCode", SecurityCode);
					formdata.append("Token_CSRF", Token_CSRF);
					formdata.append("BrowserClientId1", BrowserClientId1);
					formdata.append("BrowserClientId2", BrowserClientId2);

					// Check Internet connection
					if(navigator.onLine == false){
						swal.fire('Internet',"It seems that you are offline. Please check your internet connection", "warning");
						SmtBtnReset();
						return false;
					}
					// Send data on sigup backend page for uploading on the server
					try{
						var ajax = new XMLHttpRequest();
						ajax.addEventListener("load",ResponseHandler,false);
						ajax.open("POST", RootPath+"Dashboard/Main/AccountReview/AccountReview.php");
						ajax.send(formdata);
					}catch(error){
						swal.fire('Technical Error',"An Technical error occur in signup process! Try again later", "warning");
						SmtBtnReset();
						return false;
					}

					//function run on complete signup request
					function ResponseHandler(event){
						SmtBtnReset();
						var response = $.parseJSON(event.target.responseText);
						if(response['status'] === "Success"){
							$('input').val(''); $('textarea').val(''); $('select').val('');
							swal.fire('Account Review',response['msg'],'success')
							.then((value) => {
								$('#Container'+TmpUserUrl).remove();
							});
						}else{
							swal.fire('Account Review',response['msg'], "error");
						}
					}
				});
			});

			function SmtBtnStart(){
				window.SmtBtn = true;
				$(".SmtBtnSpinLoader").prop('hidden',false);
				$("input").prop("disabled",true);
				$("select").prop("disabled",true);
				$("textarea").prop("disabled",true);
				$('.SmtBtn').css("pointer-events","none");
				$(".SmtBtn").css("background","linear-gradient(skyblue, pink)");
				$(".SmtBtn").css("cursor","default");
			}
			function SmtBtnReset(){
				$("input").prop("disabled",false);
				$("select").prop("disabled",false);
				$("textarea").prop("disabled",false);
				$('.SmtBtn').css("pointer-events","auto");
				$(".SmtBtn").css("background","#6d6d6d");
				$(".SmtBtn").css("cursor","pointer");
				$(".SmtBtnSpinLoader").prop('hidden',true);
				window.SmtBtn = false;
			}
		});
	});
</script>
<?php foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal); ?>