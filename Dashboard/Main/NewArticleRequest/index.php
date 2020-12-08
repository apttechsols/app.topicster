<?php
	error_reporting(0);
	define('RootPath', '../../../');
	define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
	define('PageSetting', ['BrowserTitle'=>'Topicster : New Article Request','PageTitle'=>'New Article Request','HeaderMenuActive'=>'Account>Dashboard']);
	require(RootPath."Library/SiteComponents/FrontEndControlPage/index.php");
	require(RootPath."Library/SiteComponents/FrontAndBackEndControlPage/index.php");
	require(RootPath."Library/SiteComponents/Header/index.php");
	// DbCon -> ($PdoTopicsterPostData)
	require_once (RootPath."Library/Database/SQL/Pdo/topicster_post_data.php");
	
	if($IsLogin['code'] != 200){
		header("Location: " . RootPath);
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'Authentication failed [Login]']); exit();
	}else if($IsLogin['LAS'] != 'Main'){
		header("Location: " . RootPath);
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'Authentication failed [Login]']); exit();
	}
	
	$GetNewArticleRequest = AptPdoFetchWithAes(['Condtion'=> "Status::::UnderReview",'FetchData'=>'Url::::Title::::CreateTime', 'DbCon'=> $PdoTopicsterPostData, 'TbName'=> 'post', 'EPass'=> $EPass,'FetchRowNo'=>'All','Limit'=>10,'DataOrder'=>'DESC|CreateTime']);

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
		border: 1px solid #000;
		min-height: calc(100vh - 300px);
		grid-template-columns: 1fr;
		border: none;
		display: block;
	}
	#ArticleContainer{
		padding: 10px;
		grid-row-gap: 20px;
		box-shadow: 10px 2px 2px 0px rgba(0,0,0,.14), 0px 3px 10px -2px rgba(0,0,0,.2), 10px 1px 5px 0 rgba(0,0,0,.12);
		margin-bottom: 30px;
	}
	.Title{
		text-decoration: none;
		color: #000;
	}
	.Title:hover{
		color: #0c4da2;
	}
	.Time{
		color: #8f8f8f;
		margin-top: 15px;
	}
	.Time > i{
		margin-right: 10px;
	}
</style>
	<div class="PredefineContainer">
		<?php foreach ($GetNewArticleRequest['msg'] as $key => $value) {
			echo "<div id='ArticleContainer'><a href='NewArticleRequest.php?url=$value->Url' class='Title'>$value->Title</a><div class='Time'><i class='fas fa-stopwatch'></i>".date("d-M-Y h:i:s A",$value->CreateTime)."</div></div>";
		} ?>
	</div>
	<?php require(RootPath."Library/SiteComponents/Footer/index.php"); ?>
</body>
</html>
<script>
	$(document).ready(function(){
	});
</script>
<?php foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal); ?>