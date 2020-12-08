<?php
	error_reporting(0);
	define('RootPath', '../../../');
	define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
	define('PageSetting', ['BrowserTitle'=>'My Article : Dashboard','PageTitle'=>'My Article','JavaScript'=>[RootPath.'Library/JavaScript/Javascript/Chart'],'HeaderMenuActive'=>'Account>Dashboard']);
	define('IsLoginSetting', ['FetchDtls'=>'FullName']);
	require(RootPath."Library/SiteComponents/Header/index.php");
	// DbCon -> ($PdoTopicsterPostData)
	require_once (RootPath."Library/Database/SQL/Pdo/topicster_post_data.php");

	require_once (RootPath."Library/Apt/Php/Script/AptSafeText/index.php");
	require_once (RootPath."Library/Apt/Php/Script/AptUtf8EncodeAndDecode/index.php");

	$GetMyArticleRequest = AptPdoFetchWithAes(['Condtion'=> "Author::::".$IsLogin['LURL'],'FetchData'=>'Url::::FUrl::::Title::::PublishTime::::Description::::Author::::ImageUrl', 'DbCon'=> $PdoTopicsterPostData, 'TbName'=> 'post', 'EPass'=> $EPass,'FetchRowNo'=>'All','Limit'=>10,'DataOrder'=>'DESC|PublishTime']);

	if($GetMyArticleRequest['code'] == 200){
		$ArticleDtls = array();
		foreach ($GetMyArticleRequest['msg'] as $key => $value) {
			$ArticleDtls[$key] = array();
			$ArticleDtls[$key]['Url'] = $value->Url;
			$ArticleDtls[$key]['FUrl'] = $value->FUrl;
			$ArticleDtls[$key]['Title'] = $value->Title;
			$ArticleDtls[$key]['PublishTime'] = $value->PublishTime;
			$ArticleDtls[$key]['Description'] = $value->Description;
			$ArticleDtls[$key]['ImageUrl'] = unserialize($value->ImageUrl);
		}
	}else if($GetMyArticleRequest['code'] == 404){
		/*foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'No Article Found [Coming soon]']); exit();*/
	}else{
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptFullScreenMsg(['msg'=>'Article Not Fetched due to technical error']); exit();
	}?>
	<style>
		.PredefineContainer{
			grid-template-columns: 1fr;
		}
		.PostContent > p{
			color: #2f2f2f;
		    font-size: 16px;
		    font-weight: bold;
		    display: inline-block;
		    display: -webkit-box;
		    -webkit-line-clamp: 3;
		    -webkit-box-orient: vertical;
		    overflow: hidden;
		}
		.PostDescription > p{
			font-size: 16px;
			line-height: 1.7em;
		    font-weight: 100;
		    display: inline-block;
		    display: -webkit-box;
		    -webkit-line-clamp: 3;
		    -webkit-box-orient: vertical;
		    overflow: hidden;
		    color: #2f2f2f;
		    cursor: pointer;
		}
		.PostContent{
			display: grid;
			padding: 10px;
			box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),
			 0 3px 1px -2px rgba(0,0,0,.2),
			 0 1px 5px 0 rgba(0,0,0,.12);
			margin-bottom: 30px;
			border-radius: 5px;
		}
		.PostContent a{
			font-size: 18px;
			color: #595959;
			line-height: 1.5em;
			display: inline-block;
			display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
			overflow: hidden;
			margin: -10px 0px 10px -10px;
			width: 100%;
			padding: 10px;
			background: #f4f4f4;
			max-height: 44px;
			font-weight: bold;
			text-decoration: none;
			cursor: pointer;
		}
		.PostContent a:hover{
			color: #0c4da2;
		}
		.PostInfo{
			color: #727272;
		}
		.PostInfo i{
			margin-right: 5px;
			margin-bottom: 5px;
		}
		.PostInfo:nth-child(1){
			margin-right: 15px;
		}
		.NameAndDate{
			width: 100%;
			white-space: nowrap;
			cursor: pointer;
		}
		.views{
			white-space: nowrap;
			cursor: pointer;
		}
		.PostImages{
			display: grid;
		}
		.PostImages img{
			max-width: 100%;
			max-height: 150px;
			cursor: pointer;
		}

		/* Post Image slider */
		.MultiCarousel { float: left; overflow: hidden; padding: 0px; width: 100%; position:relative; z-index: -1; max-height: 150px;}
	    .MultiCarousel .MultiCarousel-inner { transition: 1s ease all; float: left; max-height: 150px;}
	        .MultiCarousel .MultiCarousel-inner .item { float: left;}
	        .MultiCarousel .MultiCarousel-inner .item > div { text-align: center; padding:5px; margin:3px; background:#f1f1f1; color:#666;}
	    .MultiCarousel .leftLst, .MultiCarousel .rightLst { position:absolute; border-radius:50%;top:calc(50% - 20px); }
	    .MultiCarousel .leftLst { left:0; }
	    .MultiCarousel .rightLst { right:0; }
	    
	        .MultiCarousel .leftLst.over, .MultiCarousel .rightLst.over { pointer-events: none; background:#ccc; }
	     .btn {
		    display: inline-block;
		    padding: 6px 12px;
		    margin-bottom: 0;
		    font-size: 14px;
		    font-weight: 400;
		    line-height: 1.42857143;
		    text-align: center;
		    white-space: nowrap;
		    vertical-align: middle;
		    -ms-touch-action: manipulation;
		    touch-action: manipulation;
		    cursor: pointer;
		    -webkit-user-select: none;
		    -moz-user-select: none;
		    -ms-user-select: none;
		    user-select: none;
		    background-image: none;
		    border: 1px solid transparent;
		        border-top-color: transparent;
		        border-right-color: transparent;
		        border-bottom-color: transparent;
		        border-left-color: transparent;
		    border-radius: 4px;
		    font-family: inherit;
			font-size: inherit;
			line-height: inherit;
			-webkit-appearance: button;
			cursor: pointer;
			text-transform: none;
			margin: 0;
	    	margin-bottom: 0px;
			font: inherit;
			    font-weight: inherit;
			    font-size: inherit;
			    line-height: inherit;
			    font-family: inherit;
			color: inherit;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box
		}
		.btn-primary {
		    color: #fff;
		    background-color: #428bca;
		    border-color: #357ebd;
		}
		.btn:hover{color:#fff;background-color:#3071a9;border-color:#285e8e;}
		button{
			outline:none;
		}
		/* Post image slider end */
		@media (max-width: 680px){
		}
		@media (max-width: 380px){
		}
	</style>
	<section class="PredefineContainer">
		<div style='margin-top: 25px;'>
			<?php
			$key = 0;
			foreach ($ArticleDtls as $key => $value) { ?>
				<div class="PostContent">
					<div><a href='<?php echo RootPath; ?>/Article/index.php?<?php echo $value['FUrl']; ?>' name='<?php echo $value['Url']; ?>'><?php echo $value['Title']; ?></a></div>
					<div class="PostInfo">
						<span class="NameAndDate"><i class="fas fa-user"></i><?php echo $IsLogin['msg']['FullName']; ?> at <?php echo date("d-M-Y",$value['PublishTime']); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="views"><i class="fas fa-eye"></i>1000K @<?php echo $IsLogin['LMAN']; ?></span>
					</div>
					<div class="PostImages">
						<div class="MultiCarousel" data-items="1,2,3,4" data-slide="1" id="MultiCarousel"  data-interval="1000">
				            <div class="MultiCarousel-inner">
			            		<?php foreach (str_replace('<PredifineKeyword>PredifinePartnerMediaFilePath<PredifineKeyword>', DomainName.'/PartnerMedia/', $value['ImageUrl']) as $keyImageUrl => $valueImageUrl) { ?>
			            		<div class="item">
				                    <div class="pad15">
				                    	<img src='<?php echo $valueImageUrl; ?>'/>
				                        <p class="lead"></p>
				                        <p></p>
				                        <p></p>
				                        <p></p>
				                    </div>
				                </div>
				            	<?php } ?>
				            </div>
				            <button class="btn btn-primary leftLst" name='leftLst' id='leftLst'><</button>
				            <button class="btn btn-primary rightLst" name='rightLst' id='rightLst'>></button>
				        </div>
					</div>
					<div class='PostDescription'><p><?php echo strip_tags(AptSafeTextDecode(['Str'=>$value['Description'],'EWords'=>['=','/','<','>']])['msg']); ?></p></div>
				</div>
			<?php }
				if(count($ArticleDtls) <= 0){
    			    echo "No Article Found [Coming soon]";
    			}
			?>
		</div>
	</section>
	<?php require(RootPath."Library/SiteComponents/Footer/index.php"); ?>
</body>
</html>
<script>
	$(document).ready(function () {
	    var itemsMainDiv = ('.MultiCarousel');
	    var itemsDiv = ('.MultiCarousel-inner');
	    var itemWidth = "";

	    $(window).resize(function () {
	        ResCarouselSize();
	    });

	    //this function define the size of the items
	    function ResCarouselSize() {
	        var incno = 0;
	        var dataItems = ("data-items");
	        var itemClass = ('.item');
	        var id = 0;
	        var btnParentSb = '';
	        var itemsSplit = '';
	        var sampwidth = $(itemsMainDiv).width();
	        var bodyWidth = $('body').width();
	        $(itemsDiv).each(function () {
	            id = id + 1;
	            var itemNumbers = $(this).find(itemClass).length;
	            btnParentSb = $(this).parent().attr(dataItems);
	            itemsSplit = btnParentSb.split(',');
	            $(this).parent().attr("id", "MultiCarousel" + id);


	            if (bodyWidth >= 1200) {
	                incno = itemsSplit[3];
	                itemWidth = sampwidth / incno;
	            }
	            else if (bodyWidth >= 680) {
	                incno = itemsSplit[2];
	                itemWidth = sampwidth / incno;
	            }else if (bodyWidth >= 420) {
	            	incno = itemsSplit[1];
	                itemWidth = sampwidth / incno;
	            }
	            else {
	                incno = itemsSplit[0];
	                itemWidth = sampwidth / incno;
	            }
	            $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
	            $(this).find(itemClass).each(function () {
	                $(this).outerWidth(itemWidth);
	            });

	            $(".leftLst").addClass("over");
	            $(".rightLst").removeClass("over");

	        });
	    }
	    ResCarouselSize();

	    $('.leftLst, .rightLst').click(function () {
	        var condition = $(this).hasClass("leftLst");
	        if (condition)
	            click(0, this);
	        else
	            click(1, this)
	    });

	    //this function used to move the items
	    function ResCarousel(e, el, s) {
	        var leftBtn = ('.leftLst');
	        var rightBtn = ('.rightLst');
	        var translateXval = '';
	        var divStyle = $(el + ' ' + itemsDiv).css('transform');
	        var values = divStyle.match(/-?[\d\.]+/g);
	        var xds = Math.abs(values[4]);
	        if (e == 0) {
	            translateXval = parseInt(xds) - parseInt(itemWidth * s);
	            $(el + ' ' + rightBtn).removeClass("over");

	            if (translateXval <= itemWidth / 2) {
	                translateXval = 0;
	                $(el + ' ' + leftBtn).addClass("over");
	            }
	        }
	        else if (e == 1) {
	            var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
	            translateXval = parseInt(xds) + parseInt(itemWidth * s);
	            $(el + ' ' + leftBtn).removeClass("over");

	            if (translateXval >= itemsCondition - itemWidth / 2) {
	                translateXval = itemsCondition;
	                $(el + ' ' + rightBtn).addClass("over");
	            }
	        }
	        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
	    }

	    //It is used to get some elements from btn
	    function click(ell, ee) {
	        var Parent = "#" + $(ee).parent().attr("id");
	        var slide = $(Parent).attr("data-slide");
	        ResCarousel(ell, Parent, slide);
	    }

	    $('.PostImages').hover(function(){
	    	$(this).children().css('z-index','0');
	    });
	    $('.PostImages').mouseleave(function(){
	    	$(this).children().css('z-index','-1');
	    });

	});
	$('.item').click(function(event){
		event.preventDefault();
       	event.stopPropagation();
	});
	$('.leftLst').click(function(event){
		event.preventDefault();
       	event.stopPropagation();
	});
	$('.rightLst').click(function(event){
		event.preventDefault();
       	event.stopPropagation();
	});

	$('.PostContent').click(function(){
		window.location.href = $(this).children().eq(0).children().eq(0).attr('href');
	});
</script>
<?php foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal); ?>
</body>
</html>
<script>
	$(document).ready(function () {
	     var itemsMainDiv = ('.MultiCarousel');
	    var itemsDiv = ('.MultiCarousel-inner');
	    var itemWidth = "";

	    $(window).resize(function () {
	        ResCarouselSize();
	    });

	    //this function define the size of the items
	    function ResCarouselSize() {
	        var incno = 0;
	        var dataItems = ("data-items");
	        var itemClass = ('.item');
	        var id = 0;
	        var btnParentSb = '';
	        var itemsSplit = '';
	        var sampwidth = $(itemsMainDiv).width();
	        var bodyWidth = $('body').width();
	        $(itemsDiv).each(function () {
	            id = id + 1;
	            var itemNumbers = $(this).find(itemClass).length;
	            btnParentSb = $(this).parent().attr(dataItems);
	            itemsSplit = btnParentSb.split(',');
	            $(this).parent().attr("id", "MultiCarousel" + id);
	            var len = $(this).children()['length'];

	            if (bodyWidth >= 1200) {
	            	var minTab = 4;
	                incno = itemsSplit[3];
	                itemWidth = sampwidth / incno;
	            }
	            else if (bodyWidth >= 680) {
	            	var minTab = 3;
	                incno = itemsSplit[2];
	                itemWidth = sampwidth / incno;
	            }else if (bodyWidth >= 420) {
	            	var minTab = 2;
	            	incno = itemsSplit[1];
	                itemWidth = sampwidth / incno;
	            }else {
	            	var minTab = 1;
	                incno = itemsSplit[0];
	                itemWidth = sampwidth / incno;
	            }
	            $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
	            $(this).find(itemClass).each(function () {
	                $(this).outerWidth(itemWidth);
	            });

	            if(len <= minTab){
	            	$(this).parent().children().eq(1).css('display','none');
	            	$(this).parent().children().eq(2).css('display','none');
	            }else{
	            	$(this).parent().children().eq(1).css('display','block');
	            	$(this).parent().children().eq(2).css('display','block');
	            	$(".leftLst").addClass("over");
	            	$(".rightLst").removeClass("over");
	            }

	        });
	    }
	    ResCarouselSize();

	    $('.leftLst, .rightLst').click(function () {
	        var condition = $(this).hasClass("leftLst");
	        if (condition)
	            click(0, this);
	        else
	            click(1, this)
	    });

	    //this function used to move the items
	    function ResCarousel(e, el, s) {
	        var leftBtn = ('.leftLst');
	        var rightBtn = ('.rightLst');
	        var translateXval = '';
	        var divStyle = $(el + ' ' + itemsDiv).css('transform');
	        var values = divStyle.match(/-?[\d\.]+/g);
	        var xds = Math.abs(values[4]);
	        if (e == 0) {
	            translateXval = parseInt(xds) - parseInt(itemWidth * s);
	            $(el + ' ' + rightBtn).removeClass("over");

	            if (translateXval <= itemWidth / 2) {
	                translateXval = 0;
	                $(el + ' ' + leftBtn).addClass("over");
	            }
	        }
	        else if (e == 1) {
	            var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
	            translateXval = parseInt(xds) + parseInt(itemWidth * s);
	            $(el + ' ' + leftBtn).removeClass("over");

	            if (translateXval >= itemsCondition - itemWidth / 2) {
	                translateXval = itemsCondition;
	                $(el + ' ' + rightBtn).addClass("over");
	            }
	        }
	        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
	    }

	    //It is used to get some elements from btn
	    function click(ell, ee) {
	        var Parent = "#" + $(ee).parent().attr("id");
	        var slide = $(Parent).attr("data-slide");
	        ResCarousel(ell, Parent, slide);
	    }

	    $('.PostImages').hover(function(){
	    	$(this).children().css('z-index','0');
	    });
	    $('.PostImages').mouseleave(function(){
	    	$(this).children().css('z-index','-1');
	    });

	});
	$('.item').click(function(event){
		event.preventDefault();
       	event.stopPropagation();
	});
	$('.leftLst').click(function(event){
		event.preventDefault();
       	event.stopPropagation();
	});
	$('.rightLst').click(function(event){
		event.preventDefault();
       	event.stopPropagation();
	});

	$('.PostContent').click(function(){
		window.location.href = $(this).children().eq(0).children().eq(0).attr('href');
	});
</script>
<?php foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal); ?>
