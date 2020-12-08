<?php include('server.php') ?>
<?php
	define('RootPath', '../');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Uploading images in CKEditor using PHP</title>

	<!-- Custom styling -->
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<textarea name='editor'></textarea>
</body>
<script src="<?php echo RootPath; ?>Library/JavaScript/Jquery/GoogleDNS/3.4.1/jquery.min.js"></script>
<script src="<?php echo RootPath; ?>Library/JavaScript/Javascript/SweetAlert2.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> -->
<!-- CKEditor -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.8.0/ckeditor.js"></script> -->

<!-- custom scripts -->
<script src="ckeditor.js"></script>
 <script>
 	CKEDITOR.replace( 'editor', {
	    height: 500,
	} );
	CKEDITOR.editorConfig = function( config ) {

		config.toolbarGroups = [
			{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
			{ name: 'insert', groups: [ 'insert'] },
			{ name: 'paragraph', groups: [ 'align', 'list', 'indent', 'blocks', 'bidi', 'paragraph' ] },
			{ name: 'links', groups: [ 'links' ] },
			{ name: 'styles', groups: [ 'styles' ] },
			{ name: 'colors', groups: [ 'colors' ] },
			{ name: 'tools', groups: [ 'tools' ] },
			{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
			{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
			{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
			{ name: 'forms', groups: [ 'forms' ] },
			'/',
			'/',
			{ name: 'others', groups: [ 'others' ] },
			{ name: 'about', groups: [ 'about' ] }
		];
		
		config.extraPlugins = 'AptBrowseImage';

		config.removeButtons = 'Save,NewPage,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,SelectAll,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,Outdent,Indent,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,Flash,Image,About,Replace,Preview,Form,Checkbox,Radio,PageBreak,Source,link';
	};

	
	CKEDITOR.on('dialogDefinition', function (ev) {
	    var dialogName = ev.data.name;
	    var dialogDefinition = ev.data.definition;
	    var dialog = dialogDefinition.dialog;
	    var editor = ev.editor;
	    console.log(dialogName);
	    console.log(dialogDefinition);
	    if (dialogName == 'image') {
	    	dialogDefinition.removeContents('Link');
			dialogDefinition.removeContents('advanced');
			dialogDefinition.removeContents('Upload');
			var tabContent = dialogDefinition.getContents('info');
			tabContent.remove('txtHSpace');
			tabContent.remove('txtVSpace');
			tabContent.remove('txtWidth');
			tabContent.remove('txtHeight');
			tabContent.remove('txtBorder');
			tabContent.remove('cmbAlign');
			tabContent.remove( 'ratioLock' ); 
			tabContent.remove( 'htmlPreview' ); 
			//tabContent.remove( 'txtAlt' ); 
			//tabContent.remove( 'txtUrl' );
		}else if(dialogName == 'link'){
			dialogDefinition.removeContents('advanced');
		}
	});
</script>
</html>