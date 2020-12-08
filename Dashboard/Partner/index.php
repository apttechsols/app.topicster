<?php
	error_reporting(0);
	define('RootPath', '../../');
	define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
	define('PageSetting', ['BrowserTitle'=>'Topicster : Dashboard','JavaScript'=>[RootPath.'Library/JavaScript/Javascript/Chart'],'HeaderMenuActive'=>'Account>Dashboard']);
	define('HeaderSetting', ['LatestUpdate'=>'off','HeaderLogoStyle'=>'LeftInTopMenu','HeaderScroll'=>'off']);
	require(RootPath."Library/SiteComponents/FrontEndControlPage/index.php");
	require(RootPath."Library/SiteComponents/FrontAndBackEndControlPage/index.php");

	if($IsLogin['code'] != 200 || $IsLogin['LAS'] != 'Partner'){
		header("Location: " . RootPath);
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'Authentication failed [Login]']); exit();
	}
	require(RootPath."Library/SiteComponents/Header/index.php");
?>
	<style>
		body{
			margin: 0px;
		}

		button{
			cursor: pointer;
		}

		/* Scroll bar design code*/
		/* width */
		aside::-webkit-scrollbar {
		  width: 10px;
		}

		/* Track */
		aside::-webkit-scrollbar-track {
		  background: #f1f1f1; 
		}
		 
		/* Handle */
		aside::-webkit-scrollbar-thumb {
		  background: #888;
		  border-radius: 20px;
		}

		/* Handle on hover */
		aside::-webkit-scrollbar-thumb:hover {
		  background: #555; 
		}

		.dashboard{
			max-width:100%;
			overflow: hidden; 
			width: calc(100% - 250px);
			float: right;
		}

		aside{
			width: 250px;
			border:1px solid darkgray;
			border-width:0 0px 0 0;
			background-color: #fff;
			padding-top:0;
			left:0;
			box-shadow: 0 0 2rem 0 rgba(136,152,170,.15);
			font-family:sans-serif;
			overflow-y: auto;
			position: fixed;
			height: 100vh;
		}

		aside a{
			text-decoration: none;
		}
		aside i{
			padding-right: 10px;
		}

		article{
			overflow-y: auto;
			margin: 30px 0px 0px 0px;
		}

		.Sidebar-Item p{
			margin: 0px;
			color: #471f87;
			cursor: pointer;
		}
		.Sidebar-Item p img{
		    width: 20px;
		    float: left;
		    padding-right: 20px;
		}
		.link-text{
			margin:30px 5px 5px 20px; 
		}
		.Header{
			height:40px;
			max-width:100%; 
			text-align:center; 
			padding-top:10px;  

		}
		.Header h1{
			color: rgba(0,0,0,.6);
		}
		.desk i{
			float:left;
		}

		.desk{
			margin: 20px 5px 2px 10px;
			padding:7px 0 7px 30px;
			background: #f6f9fc;
			border-radius:10px;
			color: #224579;
		}
		.desk img{
			width: 20px;
		}
		article .Main-Container{
			background: #224579!important;
			padding: 10px;
			width: calc(100% - 20px);
		}
		.Header-Container{
			padding-top: 20px;
		    overflow: hidden;
		    display: grid;
		    grid-template-columns: 1fr 90px; 
		}
		.SideBar-inner ul {
			list-style: none;
			text-decoration:none; 
			margin-left:-40px; 
		}
		.MenuShowIcon{
			display: none;
			width: 25px;
			height: 25px;
			margin: auto;
			position: absolute;
			cursor: pointer;
			text-align: center;
		    padding-top: 2px;
		    height: 19px;
		    margin-top: 7px;
		}
		.MenuShowIcon img{
			width: 30px;
			margin: -6px 0px 0px -3px;
		}

		.TopRightIconBox{
			display:flex;
			padding-top: 13px;
		}
		.TopRightIconBox div{
			padding: 0px 10px;
		}
		.Image{
			width: 35px;
			height: 35px;
			margin: -16px 10px -12px -4px;
			border-radius:50%;
		}
		.MenuProfileIcon{
			margin: 0px 10px -6px 0px;
		    width: 20px;
		}

		.TopRightIconBox  img :hover{
			display:block;
			position:absolute;
			background:rgb(0,100,0); 
		}


		.container{
			display: grid;
			grid-template-columns: 1fr 45px;
		    overflow-x: auto;   
		}
		.defaultdesk{
			display:flex;
		}
		.sidedesk p{
			margin-left:10px;
			margin-right:10px;
			margin-top: 12px;
			display: flex;
			color: #fff;
		    font-family: sans-serif;
		}
		 
		 /*4 Control-Box CSS*/ 
		.Control-Box{
			display:grid; 
			grid-template-columns: repeat(4,1fr);
			grid-gap:20px;
			overflow: hidden; 
		}
		.Sub-Control-box1{
			padding: 10px;
		    box-shadow: 0 7px 3px rgba(50,50,93,.15), 0 1px 0 rgba(0,0,0,.02);
		    margin-top: 10px;
		    border-radius: 0px 15px;
		    background-color: #fff;
		    width: calc(100% - 20px);
		    overflow: hidden;
		}
		.Heading-icon{
			display: flex;
		}
		.SubControlA{
			width: 100%;
		}
		.icon{
			height: 40px;
			width: 40px; 
			border-radius: 40px;
			background: -webkit-linear-gradient(3deg,#f5365c,#f56036)!important;
			margin-top: -5px;
		}
		.icon i{
			padding: 10px 10px 2px 12px;
			color: #fff;
		}
		.icon img{
			margin: 8px 0 0 5.5px;
			width: 25px;
		}
		.number h1{
			font-size: 15px;
		}
		.tag-line h1{
			font-size: 15px;
		}
		 	
		 /*	GraphocalReportMainBox*/

		.GraphocalReportMainBox{
			width:calc(100% - 20px);
			margin: -60px 10px 30px 10px; 
			display: grid;
			grid-template-columns: 2fr 1fr;
			grid-gap: 30px; 
		}


		.GraphocalReport{
			min-height: 400px;
			width:100%;
		}
		.Grafical-table{ 
			border:1px solid black;
			box-shadow: 0 7px 3px rgba(50,50,93,.15), 0 1px 0 rgba(0,0,0,.02);
			background-color: #172b4d;
			height:500px;   
		}
		.Grafical-table-header{
			height:50px;
			padding-bottom: 7px;
			display:grid;
			grid-template-columns:1fr 153px;   
		}
		.Grafical-table-header-box-right{
			display: flex;
			padding: 20px;
		}
		.Grafical-table-header-box-right button{
			box-shadow: 0 15px 3px rgba(50,50,93,.15), 0 1px 0 rgba(0,0,0,.02);
		    height: 33px;
		    outline: none;
		    border: none;
		    border-radius: 8px;
		    margin: 0px 5px;

		}
		.GraphocalReport1 .Grafical-table-header-box-right button{
			box-shadow: 0 15px 3px rgba(0,0,0,.60), 0 1px 0 rgba(0,0,0,.02);
		}
		.Grafical-table-container{
			padding: 20px;
		}

		.Grafical-table-container-chart{
			height: 400px;
			border:1px solid black;
		}
		.graphic-design{
			display: flex;
		    flex-wrap: wrap;
		    margin-right: -15px;
		    margin-left: -15px;
		}

		/*.Container{
		  border: 5px solid #fff;
		  width: calc(100% - 300px);
		  min-height: calc(100vh - 295px);
		  margin: 30px 10px 30px auto;
		  border-radius: 20px 0px;
		  padding: 10px;
		  display: grid;
		  grid-template-columns: repeat(2,1fr);
		  grid-gap: 20px 25px;
		}*/
		.ServiceBox{
		  max-width: 310px;
		  border: 1px solid
		  #0008ff;
		  height: min-content;
		  width: 100%;
		  border-radius: 20px 0px;
		  background:
		  #172b4d;
		  cursor: pointer;
		  margin: auto;
		  padding: 10px 0px;
		  text-align: center;
		  color:#fff;
		  text-decoration: none;
		  font-weight: bold;
		}
		.ServiceBox p{
		  margin: 10px;
		  font-size: 18px;
		  font-weight: bold;
		  color: #fff;
		  text-align: center;
		}

		/*Extra Importent code*/
		.Footer{
			width: calc(100% - 250px);
			float: right;
		}


		/*responsive code*/
		@media(max-width: 1024px){
			.Control-Box{
				grid-template-columns: repeat(2,1fr);
			}
			.GraphocalReportMainBox{
				grid-template-columns: 1fr;
			}
		}

		@media(max-width: 620px){
			.Header-Container{
				padding-top: 0px;
				margin-top: -10px;
			}
			aside{
				display:none;
				position: absolute;
		    	width: 100%;
		    	z-index: 2;
			}
			.dashboard{
				width: 100%;
			}
			.MenuShowIcon{
				display: block;
			}
			.Footer{
				width: 100%;
			}
		}

		@media(max-width: 420px){
			.Control-Box{
				grid-template-columns: repeat(1,1fr);
			}
			.Container{
			    grid-template-columns: 1fr;
			}
		}
	</style>
	<div class="dashboard">

		<!-- code for left-side bar -->
		<aside>
			<div class="asidebar">
			<div class="Header"><h1>Menu</h1></div>  
			<nav class="SideBar">
				<div class="SideBar-inner">
					<div class="Sidebar-side">
						<a class="Sidebar-Item" id='DMProfile' href='Profile/index.php'>
							<div class="desk">
								<div><i class="far fa-meh-rolling-eyes IDMProfile"></i>Profile</div>
							</div>
						</a>
					</div>
				</div>
				<div class="SideBar-inner">
					<div class="Sidebar-side">
						<a class="Sidebar-Item" id='SideBarNewArticle' href='<?php echo RootPath; ?>Dashboard/Partner/WriteArticle/ckeditor/index.php'>
							<div class="desk">
								<div><i class="far fa-newspaper ISideBarNewArticle"></i>New Article</div>
							</div>
						</a>
					</div>
				</div>
				<div class="SideBar-inner">
					<div class="Sidebar-side">
						<a class="Sidebar-Item" id='SideBarNewArticle' href='<?php echo RootPath; ?>Dashboard/Partner/MyArticle/index.php'>
							<div class="desk">
								<div><i class="far fa-newspaper ISideBarNewArticle"></i>My Article</div>
							</div>
						</a>
					</div>
				</div>
			</nav>
		</div>
		</aside>
		
		<!--  RIGHT SIDE Article START -->

		<article>
			<div class="Main-Container">
				<!--  Header-Container OF Article => SEARCHBOX  & STUDENTIMAGE -->
				<nav class="Header-Container">
					<div class="MenuShowIcon" style='color: #fff;'>
						<i class="fas fa-bars"></i>
					</div>
					<div class="container">

						<!-- DEFAULT & DESKBOARD WORD -->
						<div class="defaultdesk">
							<div class="sidedesk" ><p><i class="fa fa-home" aria-hidden="true" style="margin-right:5px;"></i>Dashboard</p>
							</div>
						</div>
					</div>
					<div class="TopRightIconBox">
						<div><i class="far fa-bell" style='color: #fff;'></i></div>
						<div><img src="<?php echo PartnerDir.$IsLogin['LMAN'].'/ProfileImage/'.$IsLogin['msg']['Profile']; ?>" class="Image" style="cursor: pointer;"></div>
					</div>
				</nav>

				<!--  4 CONTROL BOX OF RIGHT SIDE Article -->
				<div class="Control-Box">
				
					<div class="Sub-Control-box1">

						<div class="Heading-icon">
							<div class="total-trafic SubControlA">Total Member</div>
							<div class="icon"><i class="far fa-user"></i></div>
						</div>
						<div class="number"><h1><?php echo $GetOrgAllMember['totalrows']; ?></h1></div>
						<div class="tag-line"><h1>Good job, <?php  echo $ResponseLogin['LFRORNM']; ?></h1></div>
					</div>

					<div class="Sub-Control-box1">
						<div class="Heading-icon">
							<div class="Newuser SubControlA">Collage Staff</div>
							<div class="icon"><i class="far fa-user"></i></div>
						</div>
						<div class="number"><h1><?php echo $GetOrgAllMember['totalrows']; ?></h1></div>
						<div class="tag-line"><h1>Good job, <?php  echo $ResponseLogin['LFRORNM']; ?></h1></div>
					</div>

					<div class="Sub-Control-box1">
						<div class="Heading-icon">
							<div class="Sales SubControlA">Student</div>
							<div class="icon"><i class="far fa-user"></i></div>
						</div>
						<div class="number"><h1><?php echo $GetOrgAllMember['totalrows']; ?></h1></div>
						<div class="tag-line"><h1>Good job, <?php  echo $ResponseLogin['LFRORNM']; ?></h1></div>
					</div>
					<div class="Sub-Control-box1">
						<div class="Heading-icon">
							<div class="performance SubControlA">Total Service</div>
							<div class="icon"><i class="far fa-user"></i></div>
						</div>
						<div class="number"><h1><?php echo $GetOrgAllMember['totalrows']; ?></h1></div>
						<div class="tag-line"><h1>Good job, <?php  echo $ResponseLogin['LFRORNM']; ?></h1></div>
					</div>
				</div>
				<div style="height: 90px; width: 100%;"></div>
			</div>

			<!-- GraphocalReportMainBox -->

			<div class="GraphocalReportMainBox">

				<!-- GraphocalReport1 -->

				<div class="GraphocalReport1 GraphocalReport">
					<div class="Grafical-table" style="border-radius: 0px 20px;">
							<div class="Grafical-table-header">
								<div class="Grafical-table-header-box left">
									<h1 style="font-size:15px; color:white;margin-left:14px; ">overview</h1>
									<h1 style="margin: -16px 0px 2px 10px; color:#fff; ">sales value</h1>
								</div>
								<div class="Grafical-table-header-box-right">
									<button style="background-color:#fff;"><p style="color:blue;margin-top:5px; font-size:14px; ">Month</p></button>
									<button style="background-color:#fff;"><p style="color:blue;margin-top:5px; font-size:14px; ">Week</p></button>
								</div>
							</div>

							<div class="Grafical-table-container">
								<div class="Grafical-table-container-chart">
									<canvas id="myChart" style="display: block; height: 400px; width: 100%;"></canvas>
									<script>
											var ctx = document.getElementById('myChart').getContext('2d');
												var chart = new Chart(ctx, {
								    			// The type of chart we want to create
								    		type: 'line',

								    			// The data for our dataset
								    		data: {
								        		labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
								        		datasets: [{
								            		label: 'My First dataset',
								            		backgroundColor: 'rgb(0, 0, 255)',
								            		borderColor: 'rgb(255, 99, 132)',
								            		data: [0, 10, 5, 2, 20, 30, 45]
								        					},
								 				        		]},

								 				        });
									</script>
								</div>
							</div>
					</div>
				</div>

				<!-- GraphocalReport2 -->

				<div class="GraphocalReport2 GraphocalReport:">
					<div class="Grafical-table" style="background-color: #fff; border:none; border-radius: 0px 20px;">
					<div class="Grafical-table-header">
						<div class="Grafical-table-header-box left">
							<h1 style="font-size:15px; color:black;margin-left:14px; ">overview</h1>
							<h1 style="margin: -16px 0px 2px 10px; color:black; ">Total</h1>
						</div>
					</div>
					<div class="Grafical-table-container">
						<div class="Grafical-table-container-chart" style="border:none;">
							<canvas id="Chart" style="display: block;border:none; height: 350px; width: 100%;" class="chartjs-render-monitor"></canvas>
						</div>
					</div>
				</div>
				</div>
			</div>
		</article>
	</div>
	<?php require(RootPath."Library/SiteComponents/Footer/index.php"); ?>
</body>
</html>
<script>
	$(document).ready(()=>{

		$(".Sidebar-Item").hover(function(){
		   $('.I'+this.id).toggleClass("fas");
		});

		/*Load Chart or Creat Chart*/

		var ctx = document.getElementById('myChart').getContext('2d');
		var chart = new Chart(ctx, {
			// The type of chart we want to create
    		type: 'line',

    			// The data for our dataset
    		data: {
        		labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        		datasets: [{
            		label: 'My First dataset',
            		backgroundColor: 'rgb(0, 0, 255)',
            		borderColor: 'rgb(255, 99, 132)',
            		data: [0, 10, 5, 2, 20, 30, 45]
        		},
		        ]
			},

		});

		var ctx = document.getElementById('Chart').getContext('2d');
		var chart = new Chart(ctx, {
		    // The type of chart we want to create
		    type: 'bar',

			// The data for our dataset
    		data: {
        		labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        		datasets: [{
            		label: 'My First dataset',
            		backgroundColor: 'rgb(255, 0,0)',
            		borderColor: 'rgb(255, 99, 132)',
            		data: [0, 10, 5, 2, 20, 30, 45]
        			},
 				]
 			},
		});

		$(".MenuShowIcon").click(function(){
			if($('aside').css('display') === 'none'){
				var TmpAsideMargin = $('aside').css('margin');
				$('aside').slideToggle();
				$('header').css({'z-index': '0'});
				$('.MenuShowIcon').css({'z-index': '2','color':'rgba(0,0,0,.6)'});
				$('aside').css({'margin':'0px'});
				$('.dashboard').css({'position':'fixed','top':'0'});
			}else{
				$('aside').slideToggle();
				$('.MenuShowIcon').css({'z-index': '0','color':'#fff'})
				$('header').css({'z-index': '2'});
				$('aside').css({'margin':TmpAsideMargin});
				$('.dashboard').css({'position':'absolute','top':'unset'});
			}
		});
	});
</script>
<?php foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal); ?>
