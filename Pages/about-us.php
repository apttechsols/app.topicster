<?php
	error_reporting(0);
	define('RootPath', '../');
	define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
	require_once(RootPath."Library/SiteComponents/FrontEndControlPage/index.php");
	list($ThumbnailImageWidth, $ThumbnailImageHeight, $ThumbnailImageType, $ThumbnailImageAttr) = getimagesize('https://media.giphy.com/media/xTiN0IuPQxRqzxodZm/giphy.gif');
	define('PageSetting', ['BrowserTitle'=>'About us : Topicster','PageTitle'=>'About us','HeaderMenuActive'=>'AboutUs','keywords'=>'Topicster about, about us','description'=>'WHO WE ARE? We are platform where you can share story, article, poem, knowlage and everthing. WHY WE ARE? Here are to provide quality and organic reader for your heartfull and ammazing articles. WHY FOR YOU? We reward you for your article based upon views.','og_url'=>DomainName.'/Pages/about-us.php','ThumbnailImage'=>[['Image'=>'https://media.giphy.com/media/xTiN0IuPQxRqzxodZm/giphy.gif','Width'=>$ThumbnailImageWidth,'Height'=>$ThumbnailImageHeight]],'og_type'=>'article','robots'=>'INDEX, FOLLOW']);
	require(RootPath."Library/SiteComponents/FrontEndControlPage/index.php");
	require(RootPath."Library/SiteComponents/FrontAndBackEndControlPage/index.php");
	require(RootPath."Library/SiteComponents/Header/index.php");
	// DbCon -> ($PdoTopicsterPostData)
	require_once (RootPath."Library/Database/SQL/Pdo/topicster_post_data.php");
	// DbCon -> ($PdoTopicsterPartner)
	require_once (RootPath."Library/Database/SQL/Pdo/topicster_partner.php");
	// DbCon -> ($PdoTopicsterMain)
	require_once (RootPath."Library/Database/SQL/Pdo/topicster_main.php");

	require_once (RootPath."Library/Apt/Php/Script/AptSafeText/index.php");
	require_once (RootPath."Library/Apt/Php/Script/AptUtf8EncodeAndDecode/index.php");
?>
<meta name="keywords" content="Topicster, about us, topicster about us" />
<meta name="news_keywords" content="Topicster, about us, topicster about us" />
<meta name="description" content="Topicster about us page. Topicster - The best way to keep updated" />
	<style>
		.Content{
			text-align: center;
			background: #f4f4f4;
			border: 5px solid #96f0f5;
			margin-bottom: 0px;
		}
		.Content .Top{
			background: #96f0f5;
			min-height: 25px;
		}
		.Content img{
			width: 100px;
			border-radius: 50%;
			margin-top: -35px;
		}
		.Content h4{
			background: #f4f4f4;
		    padding: 10px 5px;
		    margin: 0;
		}
		.Content p{
			padding: 5px 15px 50px 15px;
			margin: 0px;
			background: #fff;
			color: #584a4a;
		}

		.SideContainer .card {
		  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		  max-width: 300px;
		  margin: auto;
		  text-align: center;
		}

		.SideContainer .title {
		  color: grey;
		  font-size: 18px;
		}

		.SideContainer button {
		  border: none;
		  outline: 0;
		  display: inline-block;
		  padding: 8px;
		  color: white;
		  background-color: #000;
		  text-align: center;
		  cursor: pointer;
		  width: 100%;
		  font-size: 18px;
		}

		.SideContainer a {
		  text-decoration: none;
		  font-size: 22px;
		  color: black;
		}

		.SideContainer button:hover, .SideContainer a:hover {
		  opacity: 0.7;
		}
		.PredefineContainer{
			grid-column-gap: 20px;
		}
		@media(max-width: 1024px){
			.SideContainer{
				display: grid;
				grid-template-columns: 1fr 1fr;
				grid-column-gap: 20px;
				margin-top: 30px;
			}
		}
		@media(max-width: 480px){
			.SideContainer{
				grid-template-columns: 1fr;
			}
		}
	</style>
	<section class="PredefineContainer">
		<div class='MainContainer'>
			<div class="Content">
				<p class='Top'></p>
				<img src="https://media.giphy.com/media/xTiN0IuPQxRqzxodZm/giphy.gif"/>
				<h4>WHO WE ARE?</h4>
				<p>We are platform where you can share story, article, poem, knowlage and everthing</p>
			</div>
			<div class="Content">
				<p class='Top'></p>
				<img src="https://media.giphy.com/media/xTiN0IuPQxRqzxodZm/giphy.gif"/>
				<h4>WHY WE ARE?</h4>
				<p>Here are to provide quality and organic reader for your heartfull and ammazing articles</p>
			</div>
			<div class="Content">
				<p class='Top'></p>
				<img src="https://media.giphy.com/media/xTiN0IuPQxRqzxodZm/giphy.gif"/>
				<h4>WHY FOR YOU?</h4>
				<p>We reward you for your article based upon views</p>
			</div>
		</div>
		<div class='SideContainer'>
			<div class="card">
			  <img src="https://media.wired.com/photos/5ed6891ed9fb171733fd7840/master/pass/Ideas-Zuckerberg-1200875675.jpg" alt="Bhavesh soni" style="width:100%">
			  <h1>Bhavesh soni</h1>
			  <p class="title">Co Founder, Topicster</p>
			  <p>Global Technical University</p>
			  <a href="#"><i class="fa fa-dribbble"></i></a>
			  <a href="#"><i class="fa fa-twitter"></i></a>
			  <a href="#"><i class="fa fa-linkedin"></i></a>
			  <a href="#"><i class="fa fa-facebook"></i></a>
			  <p><button>Contact</button></p>
			</div>
			<div class="card">
			  <img src="https://media.wired.com/photos/5ed6891ed9fb171733fd7840/master/pass/Ideas-Zuckerberg-1200875675.jpg" alt="Arpit sharma" style="width:100%">
			  <h1>Arpit sharma</h1>
			  <p class="title">Arpit sharma, Topicster</p>
			  <p>Global Technical University</p>
			  <a href="#"><i class="fa fa-dribbble"></i></a>
			  <a href="#"><i class="fa fa-twitter"></i></a>
			  <a href="#"><i class="fa fa-linkedin"></i></a>
			  <a href="#"><i class="fa fa-facebook"></i></a>
			  <p><button>Contact</button></p>
			</div>
		</div>
	</section>
<?php require(RootPath."Library/SiteComponents/Footer/index.php"); ?>
</body>
</html>
<?php foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal); ?>