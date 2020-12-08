<?php
	error_reporting(0);
	define('RootPath', '../');
	define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
	require_once(RootPath."Library/SiteComponents/FrontEndControlPage/index.php");
	list($ThumbnailImageWidth, $ThumbnailImageHeight, $ThumbnailImageType, $ThumbnailImageAttr) = getimagesize(DomainName.'/Library/ImageStore/TopicsterLogo_Red.png');
	define('PageSetting', ['BrowserTitle'=>'Disclaimer : Topicster','PageTitle'=>'DESCLAIMER','HeaderMenuActive'=>'Disclaimer','keywords'=>'Topicster disclaimer, disclaimer','description'=>'Disclaimer for Topicster >> If you require any more information or have any questions about our site disclaimer, please feel free to contact us by email at contact@topicster.com >> Disclaimers for Topicster >> All the information on this website - topicster.in - is published in good faith and for general information purpose only.','og_url'=>DomainName.'/Pages/disclaimer.php','ThumbnailImage'=>[['Image'=>DomainName.'/Library/ImageStore/TopicsterLogo_Red.png','Width'=>$ThumbnailImageWidth,'Height'=>$ThumbnailImageHeight]],'og_type'=>'article','robots'=>'INDEX, FOLLOW']);
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
<meta name="keywords" content="Topicster, disclaimer us, topicster disclaimer us" />
<meta name="news_keywords" content="Topicster, disclaimer us, topicster disclaimer us" />
<meta name="description" content="Topicster disclaimer us page. Topicster - The best way to keep updated" />
	<style>
		.PredefineContainer{
			grid-template-columns: 1fr;
		}
		.Container{
			background: #f2f2f2;
			padding: 10px;
		}
		h1, h2, h3{
			color: #0c4da2;
		}
	</style>
	<section class="PredefineContainer">
		<div class='Container'>
			<h1>Disclaimer for Topicster</h1>

			<p>If you require any more information or have any questions about our site's disclaimer, please feel free to contact us by email at contact@topicster.com</p>

			<h2>Disclaimers for Topicster</h2>

			<p>All the information on this website - topicster.in - is published in good faith and for general information purpose only. Topicster does not make any warranties about the completeness, reliability and accuracy of this information. Any action you take upon the information you find on this website (Topicster), is strictly at your own risk. Topicster will not be liable for any losses and/or damages in connection with the use of our website.</p>

			<p>From our website, you can visit other websites by following hyperlinks to such external sites. While we strive to provide only quality links to useful and ethical websites, we have no control over the content and nature of these sites. These links to other websites do not imply a recommendation for all the content found on these sites. Site owners and content may change without notice and may occur before we have the opportunity to remove a link which may have gone 'bad'.</p>

			<p>Please be also aware that when you leave our website, other sites may have different privacy policies and terms which are beyond our control. Please be sure to check the Privacy Policies of these sites as well as their "Terms of Service" before engaging in any business or uploading any information.</p>

			<h2>Consent</h2>

			<p>By using our website, you hereby consent to our disclaimer and agree to its terms.</p>

			<h2>Update</h2>

			<p>Should we update, amend or make any changes to this document, those changes will be prominently posted here.</p>
		</div>
	</section>
<?php require(RootPath."Library/SiteComponents/Footer/index.php"); ?>
</body>
</html>
<?php foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal); ?>