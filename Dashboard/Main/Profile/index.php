<?php
	error_reporting(0);
	define('RootPath', '../../../');
	define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
	define('PageSetting', ['BrowserTitle'=>'Profile : Dashboard','PageTitle'=>'Profile','JavaScript'=>[RootPath.'Library/JavaScript/Javascript/Chart'],'HeaderMenuActive'=>'Account>Dashboard']);
	define('HeaderSetting', ['LatestUpdate'=>'on']);
	define('IsLoginSetting', ['FetchDtls'=>'Email::::Mobile::::Gender::::Profile::::Address::::Pincode::::City::::State::::Country::::CreateTime']);
	require(RootPath."Library/SiteComponents/FrontEndControlPage/index.php");
	require(RootPath."Library/SiteComponents/FrontAndBackEndControlPage/index.php");
	if($IsLogin['code'] != 200 || $IsLogin['LAS'] != 'Main'){
		header("Location: " . RootPath);
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'Authentication failed [Login]']); exit();
	}
	require(RootPath."Library/SiteComponents/Header/index.php");
?>
	<style>
		body{
			margin:0px;
			padding:0px;
		}
		.PredefineContainer{
			border: 1px solid #8e8e8e;
			border-radius: 5px;
			grid-template-columns: 1fr!important;
			max-width: 850px;
		}

		.DtlTxt{
		    width: calc(100% - 12px);
			height: 30px;
			border: 1px solid #ccc;
			outline: none;
			padding: 5px;
			font-size: 15px;
			margin-bottom: 15px;
			border-radius: 10px;
			max-width: 350px;
			margin: 35px auto 0px auto;
			color: #8e8e8e;
		}
		.DtlTl{
			width: calc(100% - 12px);
			min-height: 15px;
			outline: none;
			font-size: 15px;
			margin-bottom: 15px;
			max-width: 350px;
			margin: 0px auto 0px auto;
			background: #8e8e8e;
			color: #fff;
		}
		.ImageBox
		{
			border: 5px solid #8e8e8e;
			width:150px;
			height:150px;
			border-radius: 50%;
			margin: auto;
			margin-top: 18px;
			overflow: hidden;
		}
		.ImageLabelBox
		{
			text-align: center;
			font-size: 18px;
		}
		.ProfileImage{
			width:150px;
			height:150px;
			background: white;
		}
		.ProfileImage:hover{
			opacity: 0.8;
		}
		.ProfileImageFileLabel
		{
			cursor: pointer;
		    margin: -74px 0px 0px -58px;
		    background: black;
		    color: white;
		    height: 22px;
		    width: 116px;
		    padding-top: 2px;
		    border-radius: 8px;
		    position: absolute;
		    opacity: 0.3;
		}
		.Form1,.Form2{
			margin: auto;
			display: grid;
			grid-template-columns: repeat(2,1fr);
			grid-column-gap: 25px;
			margin-bottom: 10px;
			width: calc(100% -  10px);
		}
		.Form2{
			grid-template-columns: 1fr;
			width: calc(100% -  10px);
		}

		.Form1 div,.Form2 div{
			text-align: center;
		}
		.ResponseBox
		{
			text-align: center;
		    width: calc(100% - 18px);
		    max-width: 350px;
		    margin: auto;
		    background: rgb(0,0,0,0.5);
		    padding: 5px;
		    border: 1px solid darkgray;
		}

		.Button{
			width: calc(100% - 12px);
			height: 20px;
			border: 1px solid #ccc;
			outline: none;
			padding: 15px 5px;
			font-size: 20px;
			margin-bottom: 15px;
			border-radius: 10px;
			max-width: 350px;
			margin: 35px auto 0px auto;
			color: #fff;
			cursor: pointer;
			background: #8e8e8e;
		}

		@media(max-width:480px)
		{
			.PredefineContainer{
				border: none;
			}
			.Form1
			{
				width: 98%;
				grid-template-columns: 1fr;
			}
			.Form1,.Form2{
				width: 100%;
			}
		}
	</style>
	<div class="PredefineContainer">
		<div class="ImageBox">
			<div class="ImageLabelBox">
				<input class="ProfileImageFile" type="file" name="ProfileImageFile" id="ProfileImageFile" accept="image/*" hidden>
				<img src="<?php echo MainDir.'ProfileImage/'.$IsLogin['msg']['Profile']; ?>" class="ProfileImage" id="ProfileImage">
			</div>
		</div>
		<div class="Form1">
		    <div class="StatusBox">
		    	<p class='DtlTxt'><?php echo 'Active'; ?></p>
		    	<p class='DtlTl'>Status</p>
			</div>
			
			<div class="FullNameBox">
				<p class='DtlTxt'><?php echo $IsLogin['msg']['FullName']; ?></p>
				<p class='DtlTl'>Name</p>
			</div>
			
			<div class="MobileNumberBox">
				<p class='DtlTxt'><?php echo $IsLogin['msg']['Mobile']; ?></p>
				<p class='DtlTl'>Mobiles</p>
			</div>
			<div class="EmailBox">
				<?php if($IsLogin['msg']['Email'] != ''){ ?>
					<p class='DtlTxt'><?php echo $IsLogin['msg']['Email']; ?></p>
				<?php }else{ ?>
					<p class='DtlTxt'><?php echo 'Unknown'; ?></p>
				<?php } ?>
				<p class='DtlTl'>Email</p>
			</div>
			<div class="GenderBox">
				<p class='DtlTxt'><?php echo $IsLogin['msg']['Gender']; ?></p>
				<p class='DtlTl'>Gender</p>
			</div>
			<div class="PositionBox">
				<p class='DtlTxt'><?php echo $IsLogin['msg']['Position']; ?></p>
				<p class='DtlTl'>Position</p>
			</div>
            <div class='JoinTime'>
				<p class='DtlTxt'><?php echo date("d-M-Y, h:i:s A",$IsLogin['msg']['CreateTime']); ?></p>
				<p class='DtlTl'>Join Time</p>
			</div>

			<div class="AddressBox">
				<p class='DtlTxt'><?php echo $IsLogin['msg']['Address']; ?></p>
				<p class='DtlTl'>Address</p>
			</div>
			<div class="PincodeBox">
				<p class='DtlTxt'><?php echo $IsLogin['msg']['Pincode']; ?></p>
				<p class='DtlTl'>Pincode</p>
			</div>
			<div class="CityBox">
				<p class='DtlTxt'><?php echo $IsLogin['msg']['City']; ?></p>
				<p class='DtlTl'>City</p>
			</div>
			<div class="StateBox">
				<p class='DtlTxt'><?php echo $IsLogin['msg']['State']; ?></p>
				<p class='DtlTl'>State</p>
			</div>
			<div class="CountryBox">
				<p class='DtlTxt'><?php echo $IsLogin['msg']['Country']; ?></p>
				<p class='DtlTl'>Country</p>
			</div>
		</div>
		<!-- <div class='Form2'>
			<div class='Button ChangePassAndPin'>Change Password & Pin</div>
		</div> -->
	</div>
	<?php require(RootPath."Library/SiteComponents/Footer/index.php"); ?>
</body>
</html>
<script>
	$(document).ready(()=>{

	});
</script>
<?php foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal); ?>
