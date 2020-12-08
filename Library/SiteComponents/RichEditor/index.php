<?php
	error_reporting(0);
	define('RootPath', '../../../');
	header("Location: " . RootPath); exit();
?>
	<style>
		textarea{
			resize: none;
			outline: none;
			padding: 5px;
		}
		.PredefineContainer{
			display: block;
		}
		.RichEdtior{
			height: auto;
			width: calc(100% - 2px);
		}
		.Toolbar{
			display: grid;
			padding: 5px;
			grid-template-columns:repeat(10,40px);
			grid-column-gap: 5px;
		}
		.Toolbar select{
			height: 28px;
			border-radius: 5px;
		}
		.Toolbar div{
			border: 1px solid darkgrey;
		    height: 20px;
		    padding-top: 5px;
		    border-radius: 5px;
		    text-align: center;
		    cursor: pointer;
		}
		.Toolbar div:hover{
			background: yellow;
		}
		.Toolbar div img{
			height: 16px;
		}
		.H-Heading{
			font-size: 18px;
			font-weight: bolder;
		}
		.H2-Heading{
			font-size: 16px;
			font-weight: bold;
		}
		.H3-Heading{
			font-size: 15px;
			font-weight: 600;
		}
		.H4-Heading{
			font-size: 15px;
			font-weight: 500;
		}
		.Itelic-ToolBar{
			font-size: 18px;
			font-weight: bolder;
			font-style: italic;
		}
		.EditorHeading{
			min-height: 40px;
			font-size: 20px;
			font-weight: bold;
		}
		.EditorDis{
			min-height: 300px;
		}

		.RichEdtior textarea{
			display: block;
			height:600px !important;
			background: none;
			resize: none;
			spellc
		}
		.RichEdtiorToolbar,.RichEdtior iframe,.RichEdtior textarea {
		  width: 100% !important;
		  margin: auto;
		  display: block;
		  border: 1px solid darkgrey;
		}
		.RichEdtior iframe{
		  height:600px !important;
		}
		.RichEdtiorToolbar{
		  border: none;
		  margin-bottom: 10px;
		  border: 1px solid darkgrey;
		}
		.RichEdtior button,.RichEdtior input,.RichEdtior select {
		  margin:5px;
		  outline: none;
		  cursor: pointer;
		  border: 1px solid darkgrey;
		  border-radius: 5px;
		  background: #fff; 
		}

		.Postdetail{
			display: grid!important;
			border:none;
			grid-template-columns:repeat(4,140px);
			padding:10px;
			grid-gap:5px;
		}
		.Postdetailcomponent{
			height: 30px;
			background-color: #0c4da2;
			border: 1px solid darkgrey;
			max-width: 120px;
			border-radius:0px 5px 0px 5px;
			text-align: center;
			padding:0 5px 0 5px;
			cursor: pointer;
		}
		.SubmitBtn{
			height:25px;
			padding-top: 5px;
		}
		.SubmitBtn p{
			color: #fff;
			font-family: sens-serif;
		}
	</style>
	<section class="PredefineContainer">
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<div class='RichEdtior'>
			<div class="Toolbar RichEdtiorToolbar" style='width: calc(100% - 10px)!important;'>
				<button onclick="Edit('bold')" title="bold"><i class="fa fa-bold"></i></button>
				<button onclick="Edit('italic')" title="italic"><i class="fa fa-italic"></i></button>
				<button onclick="Edit('underline')" title="underline"><i class="fa fa-underline"></i></button>
				<button onclick="Edit('strikeThrough')" title="strikeThrough"><i class="fa fa-strikethrough"></i></button>
				<button onclick="Edit('justifyLeft')" title="Align Left"><i class="fa fa-align-left"></i></button>
				<button onclick="Edit('justifyCenter')" title="Align Center"><i class="fa fa-align-center"></i></button>
				<button onclick="Edit('justifyFull')" title="justify"><i class="fa fa-align-justify"></i></button>
				<button onclick="Edit('cut')" title="cut"><i class="fa fa-cut"></i></button>
				<button onclick="Edit('copy')" title="Copy"><i class="fa fa-copy"></i></button>
				<button onclick="Edit('indent')" title="text-indent"><i class="fa fa-indent"></i></button>
				<button onclick="Edit('outdent')" title="text outdent"><i class="fa fa-outdent"></i></button>
				<button onclick="Edit('subscript')" title="subscript"><i class="fa fa-subscript"></i></button>
				<button onclick="Edit('superscript')" title="subscript"><i class="fa fa-superscript"></i></button>
				<button onclick="Edit('undo')" title="undo"><i class="fa fa-undo"></i></button>
				<button onclick="Edit('redo')" title="redo"><i class="fa fa-repeat"></i></button>
				<button onclick="Edit('insertUnorderedList')" title="unordered list"><i class="fa fa-list-ul"></i></button>
				<button onclick="Edit('insertOrderedList')" title="ordered list"><i class="fa fa-list-ol"></i></button>
				<button onclick="Edit('insertParagraph')"><i class="fa fa-paragraph"></i></button>
				<button onclick="execVal('formatBlock','p')">P</button>
				<select onchange="execVal('formatBlock',this.value)" onclick="execVal('formatBlock',this.value)">
				    <option value="H1">H1</option>
				    <option value="H2">H2</option>
				    <option value="H3">H3</option>
				    <option value="H4">H4</option>
				    <option value="H5">H5</option>
				    <option value="H6">H6</option>
				</select>
				<input type="file" name="RichEdtiorImgFile" id='RichEdtiorImgFile'accept="image/*" multiple hidden="true"/>
				<span id='ImgInputStore'></span>
				<button><label for='RichEdtiorImgFile'><i class="fa fa-picture-o"></i></label></button>
				<button onclick="Edit('insertvedio')"><i class="fa fa-video-camera"></i></button>

				<br>
				<button onclick="Edit('insertHorizontalRule')" title="insert Horizontal Rule">insert Horizontal Rule</button>
				<select onchange="execVal('fontName',this.value)">
				    <option value="Arial">Arial</option>
				    <option value="Comic Sans MS">Comic Sans MS</option>
				    <option value="Courier">Courier</option>
				    <option value="Georgia">Georgia</option>
				    <option value="Tahoma">Tahoma</option>
				    <option value="Times New Roman">Times New Roman</option>
				    <option value="Verdana">Verdana</option>
				</select>
				<span>Font Size<input type="number" onkeyup="execVal('fontSize',this.value)" value='3' style='width: 35px;'/></span>
				</select>Font Color<input type="color" onchange="execVal('foreColor',this.value)" /> Background<input type="color" onchange="execVal('hiliteColor',this.value)" />
				  <button onclick="execVal('hiliteColor','rgb(0,0,0,0)')">Remove Background</button>
				<button onclick="Edit('SelectAll')">Select All</button>
				<button id='ShowSourceCodeBtn' onclick="Edit('CustomSourceView')">Source Code</button>
			</div>
			<textarea name="CustomViewTextArea" id='CustomViewTextArea' style="width:80%;height: 80%;display: none;" disabled="true"></textarea>
			<body onload="enableEditMode()">
		    <iframe name="richTextField" id='richTextField' style="width:80%;height: 80%;display: block;"></iframe>
			</body>
			<div class="Postdetail">
				<div class="LanguageBox Postdetailcomponent">
				<select class="Language">
					    <option value="">Language</option>
					    <option value="Hindi">Hindi</option>
					    <option value="English">English</option>
				</select>
				</div>	
				<div class="CategoryBox Postdetailcomponent" style="display: none;">
					<select class="Category">
					    <option class="LgEnglish" value="">Category</option>
					    <option class="OpEnglish" value="Bussiness">Bussiness</option>
					    <option class="OpEnglish" value="Technology">Technology</option>
					    <option class="OpEnglish" value="Sports">Sports</option>
					    <option class="OpEnglish" value="Education">Education</option>
					    <option class="OpEnglish" value="Movie">Movie</option>
					    <option class="OpEnglish" value="Television">Television</option>
					</select>
				</div>
				<div class="SubcategoryBox Postdetailcomponent" style="display: none;">
				<select class="Subcategory">
					    <option class="LgEnglish" value="">Subcategory</option>
					    <option class="OpBussiness" value="Bussiness">Bussiness</option>
					    <option class="OpTechnology" value="Mobile">Mobile</option>
					    <option class="OpTechnology" value="Laptop">Laptop</option>
					    <option class="OpTechnology" value="Telecom">Telecom</option>
					    <option class="OpTechnology" value="Processor">Processor</option>
					     <option class="OpSports" value="Cricket">Cricket</option>
					     <option class="OpSports" value="Football">Football</option>
					     <option class="OpEducation" value="Programing">Programing</option>
					     <option class="OpEducation" value="Science">Science</option>
					      <option class="OpMovie" value="Hollywood">Hollywood</option>
					      <option class="OpMovie" value="Bollywood">Bollywood</option>
					      <option class="OpMovie" value="Tollywood">Tollywood</option>
					      <option class="OpTelevision" value="Hollywood">Hollywood</option>
					      <option class="OpTelevision" value="Bollywood">Bollywood</option>
					      <option class="OpTelevision" value="Tollywood">Tollywood</option>

				</select>
				</div>	
				<div class="SubmitBtn Postdetailcomponent" style="display: none;"><p>Submit</p></div>

			</div>
	    </div>
    </section>
  <script type="text/javascript">
  	function enableEditMode() {
  		richTextField.document.designMode = "on";
	}
	function Edit(command) {
		if(command === 'CustomSourceView'){
			var Temp = $('#richTextField').contents().find("html").html();
			if($('#CustomViewTextArea').css('display') == 'none'){
				$('#CustomViewTextArea').html('');
				$('#CustomViewTextArea').html(Temp.substring(19, Temp.length-7));
				$('#CustomViewTextArea').css('display','block');
				$('#richTextField').css('display','none');
				$("#ShowSourceCodeBtn").css({'background': 'green','color': '#fff'});
			}else{
				$("#ShowSourceCodeBtn").css({'background': 'transparent','color': 'black'});
				$('#CustomViewTextArea').html('');
				$('#CustomViewTextArea').css('display','none');
				$('#richTextField').css('display','block');
			}

		}
	   	richTextField.document.execCommand(command, false, null);
	}
	function execVal(command, value) {
	  richTextField.document.execCommand(command, false, value);
	}
	var RichEdtiorImgFileCounter = -1;
	$("#RichEdtiorImgFile").change(function(e){
		if(this.files.length >= 1){
			for(var i=0; i < this.files.length; i++){
				var file = this.files[i];
				var fileType = file["type"];
				var validImageTypes = ["image/gif"-+9, "image/jpeg", "image/jpg", "image/png"];
				if ($.inArray(fileType, validImageTypes) < 0) {


					
					swal.fire('',"Invalid file type", "error");
				}else{
					if((this.files[i].size/1024).toFixed(2) < 2048){
						if (this.files && this.files[i]) {
							var reader = new FileReader();
							reader.onload = function (e) {
								RichEdtiorImgFileCounter++;
								richTextField.document.execCommand("insertHTML", false, '<img id="ImgId'+RichEdtiorImgFileCounter+'" src="'+e.target.result+'" style="max-width:250px;height:180px;"/>');
							}
							reader.readAsDataURL(this.files[i]);
						}
					}else{
						swal.fire("Image size must be under 2 mb", "", "warning");
					}
				}
			}
		}
	});
	$(".Language").change(function(){
		$('.Language option[value = ""]').prop('disabled',true);
		$('.Category option[value = ""]').prop('disabled',false);
		$('.Category option').css('display','none');
		$(".Category").val("");
		$('.CategoryBox').css('display','none');
		$('.SubcategoryBox').css('display','none');
		$('.SubmitBtn').css('display','none');
		if(this.value != ''){
			$('.CategoryBox').css('display','block');
			$('.Category .Op'+this.value).css('display','block');
			$('.Category .Lg'+this.value).css('display','block');
		}
	});

	$(".Category").change(function(){
		$('.Category option[value = ""]').prop('disabled',true);
		$('.Subcategory option[value = ""]').prop('disabled',false);
		$('.Subcategory option').css('display','none');
		$(".Subcategory").val("");
		$('.SubcategoryBox').css('display','none');
		$('.SubmitBtn').css('display','none');
		if(this.value != ''){
			$('.SubcategoryBox').css('display','block');
			$('.Subcategory .Lg'+$('.Language').val()).css('display','block');
			$('.Subcategory .Op'+this.value).css('display','block');
		}
	});

	$(".Subcategory").change(function(){
		$('.Subcategory option[value = ""]').prop('disabled',true);
		$('.SubmitBtn').css('display','none');
		if(this.value != ''){
			$('.SubmitBtn').css('display','block');
		}
	});
	
	</script>
</body>
</html>