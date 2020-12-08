<?php
	error_reporting(0);
	define('RootPath', '../');
	define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
	require_once(RootPath."Library/SiteComponents/FrontEndControlPage/index.php");
	list($ThumbnailImageWidth, $ThumbnailImageHeight, $ThumbnailImageType, $ThumbnailImageAttr) = getimagesize(DomainName.'/Library/ImageStore/Training-vector-800.png');
	define('PageSetting', ['BrowserTitle'=>'Contact us : Topicster','PageTitle'=>'Contact us','HeaderMenuActive'=>'ContactUs','keywords'=>'Topicster contact us, contact us, contact','description'=>'Get into touch >> Swing by for a cup of coffee, or leave us a message: >> First Name >> Last Name >> Country >> Subject','og_url'=>DomainName.'/Pages/contact-us.php','ThumbnailImage'=>[['Image'=>DomainName.'/Library/ImageStore/Training-vector-800.png','Width'=>$ThumbnailImageWidth,'Height'=>$ThumbnailImageHeight]],'og_type'=>'article','robots'=>'INDEX, FOLLOW']);
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
<meta name="keywords" content="Topicster, contact us, topicster contact us" />
<meta name="news_keywords" content="Topicster, contact us, topicster contact us" />
<meta name="description" content="Topicster contact us page. Topicster - The best way to keep updated" />
	<style>
		.PredefineContainer body {
		  font-family: Arial, Helvetica, sans-serif;
		}

		.PredefineContainer * {
		  box-sizing: border-box;
		}

		/* Style inputs */
		.PredefineContainer input[type=text], .PredefineContainer select, .PredefineContainer textarea {
		  width: 100%;
		  padding: 12px;
		  border: 1px solid #ccc;
		  margin-top: 6px;
		  margin-bottom: 16px;
		  resize: vertical;
		}

		.PredefineContainer input[type=submit] {
		  background-color: #4CAF50;
		  color: white;
		  padding: 12px 20px;
		  border: none;
		  cursor: pointer;
		}

		.PredefineContainer input[type=submit]:hover {
		  background-color: #45a049;
		}

		/* Style the container/contact section */
		.PredefineContainer .container {
		  border-radius: 5px;
		  /*background-color: #f2f2f2;*/
		  padding: 10px;
		  background: #96f0f5;
		}

		/* Create two columns that float next to eachother */
		.PredefineContainer .column {
		  float: left;
		  width: 50%;
		  margin-top: 6px;
		  padding: 20px;
		}

		/* Clear floats after the columns */
		.PredefineContainer .row:after {
		  content: "";
		  display: table;
		  clear: both;
		}

		.PredefineContainer{
			grid-template-columns: 1fr;
		}
		/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
		@media screen and (max-width: 600px) {
		  .PredefineContainer .column, .PredefineContainer input[type=submit] {
		    width: 100%;
		    margin-top: 0;
		  }
		}
	</style>
	<section class="PredefineContainer">
		<div class="container">
		  <div style="text-align:center">
		    <h2>Get into touch</h2>
		    <p>Swing by for a cup of coffee, or leave us a message:</p>
		  </div>
		  <div class="row">
		    <div class="column">
		      <img src="<?php echo RootPath; ?>Library/ImageStore/Training-vector-800.png" style="width:100%">
		    </div>
		    <div class="column">
		      <div class='form'>
		        <label for="fname">First Name</label>
		        <input type="text" id="fname" name="firstname" placeholder="Your name..">
		        <label for="lname">Last Name</label>
		        <input type="text" id="lname" name="lastname" placeholder="Your last name..">
		        <label for="country">Country</label>
		        <select id="country" name="country">
		          <option value="australia">Australia</option>
		          <option value="canada">Canada</option>
		          <option value="usa">USA</option>
		        </select>
		        <label for="subject">Subject</label>
		        <textarea id="subject" name="subject" placeholder="Write something.." style="height:170px"></textarea>
		        <input class='submit' type="submit" value="Submit">
		      </div>
		    </div>
		  </div>
		</div>
	</section>
<?php require(RootPath."Library/SiteComponents/Footer/index.php"); ?>
</body>
</html>
<script>
	$('.submit').click(function(){
		swal.fire('Comming soon','This feature may unlock soon','info');
	});
</script>
<?php foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal); ?>