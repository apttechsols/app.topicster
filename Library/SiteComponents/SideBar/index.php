<?php
	error_reporting(0);
	if(!defined('FileAccessCode') || FileAccessCode != 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl'){
		echo FileAccessCode; exit();
		if(!defined(RootPath)){
			define('RootPath', '../../../');
		}
		header("Location:".RootPath); die(); exit();
	}
	// DbCon -> ($PdoTopicsterPostData)
	require_once (RootPath."Library/Database/SQL/Pdo/topicster_post_data.php");
	// DbCon -> ($PdoTopicsterMain)
	require_once (RootPath."Library/Database/SQL/Pdo/topicster_main.php");

	require_once (RootPath."Library/Apt/Php/Script/AptSafeText/index.php");
	require_once (RootPath."Library/Apt/Php/Script/AptUtf8EncodeAndDecode/index.php");

	$GetArticle = AptPdoFetchWithAes(['Condtion'=> "Status::::Publish",'FetchData'=>'Url::::FUrl::::Title::::ModTitle::::Author', 'DbCon'=> $PdoTopicsterPostData, 'TbName'=> 'post', 'EPass'=> $EPass,'FetchRowNo'=>'All','Limit'=>5,'DataOrder'=>'DESC|PublishTime']);

	if($GetArticle['code'] == 200){
		#contionue;
	}else if($GetArticle['code'] == 404){
		/*foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'No Article Found [Coming soon]']); exit();*/
	}else{
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'Article Not Fetched due to technical error']); exit();
	}
?>
<style>
	.SiderBar{
		padding: 10px;
	    margin: 10px;
	    max-width: 420px;
	}
	.SiderBar a{
		text-decoration: none;
	}
	.SiderBarContainer{
		color: #fff;
		font-size: 18px;
		font-weight: bold;
		display: grid;
	    grid-template-rows: 50px repeat(2,30px);
	    grid-row-gap: 8px;
	    padding: 5px;
	    margin-bottom: 30px;
	}
	.SidebarTitle{
		display: grid;
		text-align: center; 
		grid-template-columns: 1fr 1fr;
		background-color: #0c4da2;
		border: 1px solid #0c4da2;
		border-bottom: 5px solid #0c4da2;
	}
	.SidebarTitle p{
		color: #fff;
		font-size: 18px;
		font-weight: bold;
		margin: 0px;
	}
	.SidebarItems {
		border-bottom: 1px solid darkgrey;
		display: flex;
	}
	.SidebarItems p{
		color: black;
		font-size: 15px;
		margin: 1px -32px;
	}
	.SidebarItems i{
		color: #706f6f;
	}
	.SidebarItems span{
		display: inline-block;
	    display: -webkit-box;
		margin: -8.5px 0px 0px 5px;
		font-weight: 100;
		cursor: pointer;
		line-height: 2.5em;
	    -webkit-line-clamp: 1;
	    -webkit-box-orient: vertical;
	    overflow: hidden;
	    font-size: 15px;
	}
	.SidebarItems{
		color: #414141;
	}
	.SidebarItems:hover {
		color: red!important;
	}
	.SidebarItemsLink:visited{
		color: #0c4da2!important;
	}
	.SidebarTitle li{
		padding: 7px;
	}
	.SidebarTitlepart-2{
		background-color:#fff;
		border-bottom-width: 2px; 
	}
	.SideBar p{
		width: 100%;
		font: 500 17px/29px Noto Sans,sans-serif;
		color: #000;
		margin-top: 0px;
		margin-bottom: 0px;
		font-size: 14px;
	}

	.SideBar li{
		line-height: 2em;
		color: #585858;
		font-weight: 700;
		list-style-type: none;
	}
</style>
<div class="SiderBar">
<?php if($GetArticle['code'] == 200){?>
		<div class="SiderBarContainer">
			<div class="SidebarTitle">
				<li><p>Trending</p></li>
				<li class="SidebarTitlepart-2"><p></p></li>
			</div>
			<?php
			$i=0;
			foreach ($GetArticle['msg'] as $key => $value) {
				$GetPartnerDtls = AptPdoFetchWithAes(['Condtion'=> "Status::::Active::,::UserUrl::::".explode('_', $value->Author)[0].'_'.explode('_', $value->Author)[0],'FetchData'=>'AccountName', 'DbCon'=> $PdoTopicsterMain, 'TbName'=> 'account', 'EPass'=> $EPass]);
				if($GetPartnerDtls['code'] == 200){
					$value->AccountName = $GetPartnerDtls['msg']->AccountName;
				}else{
					unset($value->AccountName); 
					continue;
				}
				echo "<a href='".DomainName."/Article/index.php?".$value->FUrl."'  class='SidebarItems SidebarItemsLink'><i class='fas fa-angle-double-right'></i><span>".AptSafeTextDecode(['Str'=>$value->Title,'EWords'=>AptSafeTextDecodeEWords])['msg']."</span></a>\n";
				$i++;
			}
			?>
		</div>
		<?php } ?>
		<?php if($GetArticle['code'] == 200){?>
		<div class="SiderBarContainer">
			<div class="SidebarTitle">
				<li><p>For You</p></li>
				<li class="SidebarTitlepart-2"><p></p></li>
			</div>
			<?php
			$i=0;
			foreach ($GetArticle['msg'] as $key => $value) {
				$GetPartnerDtls = AptPdoFetchWithAes(['Condtion'=> "Status::::Active::,::UserUrl::::".explode('_', $value->Author)[0].'_'.explode('_', $value->Author)[0],'FetchData'=>'AccountName', 'DbCon'=> $PdoTopicsterMain, 'TbName'=> 'account', 'EPass'=> $EPass]);
				if($GetPartnerDtls['code'] == 200){
					$value->AccountName = $GetPartnerDtls['msg']->AccountName;
				}else{
					unset($value->AccountName); 
					continue;
				}
				echo "<a href='".DomainName."/Article/index.php?".$value->FUrl."'  class='SidebarItems SidebarItemsLink'><i class='fas fa-angle-double-right'></i><span>".AptSafeTextDecode(['Str'=>$value->Title,'EWords'=>AptSafeTextDecodeEWords])['msg']."</span></a>\n";
				$i++;
			}
			?>
		</div>
		<?php } ?>
		<?php if($GetArticle['code'] == 200){?>
		<div class="SiderBarContainer">
			<div class="SidebarTitle">
				<li><p>Recent</p></li>
				<li class="SidebarTitlepart-2"><p></p></li>
			</div>
			<?php
			$i=0;
			foreach ($GetArticle['msg'] as $key => $value) {
				$GetPartnerDtls = AptPdoFetchWithAes(['Condtion'=> "Status::::Active::,::UserUrl::::".explode('_', $value->Author)[0].'_'.explode('_', $value->Author)[0],'FetchData'=>'AccountName', 'DbCon'=> $PdoTopicsterMain, 'TbName'=> 'account', 'EPass'=> $EPass]);
				if($GetPartnerDtls['code'] == 200){
					$value->AccountName = $GetPartnerDtls['msg']->AccountName;
				}else{
					unset($value->AccountName); 
					continue;
				}
				echo "<a href='".DomainName."/Article/index.php?".$value->FUrl."'  class='SidebarItems SidebarItemsLink'><i class='fas fa-angle-double-right'></i><span>".AptSafeTextDecode(['Str'=>$value->Title,'EWords'=>AptSafeTextDecodeEWords])['msg']."</span></a>\n";
				$i++;
			}
			?>
		</div>
		<?php } ?>
		<div class="SiderBarContainer">
			<div class="SidebarTitle">
				<li><p>Category</p></li>
				<li class="SidebarTitlepart-2"><p></p></li>
			</div>
			<a href="<?php echo RootPath.'Category/Entertainment/index.php'; ?>" class="SidebarItems"><i class="fas fa-angle-double-right"></i><span>Entertainment</span></a>
			<a href="<?php echo RootPath.'Category/Lifestyle/index.php'; ?>" class="SidebarItems"><i class="fas fa-angle-double-right"></i><span>Lifestyle</span></a>
			<a href="<?php echo RootPath.'Category/Education/index.php'; ?>" class="SidebarItems"><i class="fas fa-angle-double-right"></i></i><span>Education</span></a>
			<a href="<?php echo RootPath.'Category/Sports/index.php'; ?>" class="SidebarItems"><i class="fas fa-angle-double-right"></i><span>Sports</span></a>
			<a href="<?php echo RootPath.'Category/Politics/index.php'; ?>" class="SidebarItems"><i class="fas fa-angle-double-right"></i></i><span>Politics</span></a>
		</div>
</div>