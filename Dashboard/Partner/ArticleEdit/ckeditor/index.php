<?php
    error_reporting(0);
    define('RootPath', '../../../../');
    header("Location: " . RootPath); die(); exit();
    define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
    define('PageSetting', ['BrowserTitle'=>'Topicster : Edtior','PageTitle'=>'Article Edtior','JavaScript'=>['ckeditor'],'HeaderMenuActive'=>'Account>Dashboard']);
    require(RootPath."Library/SiteComponents/Header/index.php");
     // DbCon -> ($PdoTopicsterPostData)
    require_once (RootPath."Library/Database/SQL/Pdo/topicster_post_data.php");

    require_once (RootPath."Library/Apt/Php/Script/AptSafeText/index.php");
    require_once (RootPath."Library/Apt/Php/Script/AptUtf8EncodeAndDecode/index.php");
    $PostUrl = $_GET['url'];
    if(strlen($PostUrl) != 15 || $PostUrl != preg_replace('/[^A-Za-z0-9]/', '', $PostUrl)){
        foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
        AptPrint(['msg'=>'Invalid Url detect','status'=>'Error']); exit();
    }

    $GetArticle = AptPdoFetchWithAes(['Condtion'=> "Url::::$PostUrl",'FetchData'=>'Status::::Title::::PublishTime::::MetaDescription::::Description::::Author::::PKeyword::::Category', 'DbCon'=> $PdoTopicsterPostData, 'TbName'=> 'post', 'EPass'=> $EPass]);

    if($GetArticle['code'] == 200){
        #continue
    }else if($GetArticle['code'] == 404){
        foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
        AptFullScreenMsg(['msg'=>'Invalid url found']); exit();
    }else{
        foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
        AptFullScreenMsg(['msg'=>'Article Not Fetched due to technical error']); exit();
    }
    $Description = AptSafeTextDecode(['Str'=>$GetArticle['msg']->Description,'EWords'=>['=','/','<','>']]);
    if($Description['code'] != 200){
        foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
        AptFullScreenMsg(['msg'=>'Description can not read due to technical error']); exit();
    }
    $Description = str_replace('http://localhost<YourDomainName>.com', DomainName, $Description['msg']);

    $i = 1;
    foreach (explode(', ', $GetArticle['msg']->PKeyword) as $key => $value) {
        if($i <= 5){
            ${'Keyword'.$i} = $value;
        }else{
            break;
        }
        $i++;
    }
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style>
    .HeaderLogoContainer{
        margin-top: 10px;
    }
    .PredefineContainer{
        display: block;
    }
    .ArticleTitleBox{
        width: 100%;
    }
    #ArticleTitle{
        width: calc(100% - 12px);
        margin: 0px auto 20px auto;
        border: 1px solid #ccc;
        border-radius: 2px;
        color: #6e6e6e;
        padding: 3px 5px;
        font-size: 18px;
        font-weight: bold;
        max-width: calc(100% - 12px);
        resize: none;
        height: 28px;
        box-sizing: unset;
    }
    #Ckeditor{
        height: 182px;
        border:1px solid #ccc;

    }
    .SmtBtn{
        border: 1px solid #8e8e8e;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        background: #0c4da2;
        color: #fff;
        padding: 5px;
        margin: 15px 0px;
        cursor: pointer;
        border-radius: 2px;
    }

    #AptClassASelectBoxCategory,#AptClassASelectBoxSubCategory{
        margin: 20px 0px 0px 0px;
    }

    .KeywordBox{
        border: 1px solid #ccc;
        min-height: 50px;
        margin: 20px 0px 0px 0px;
        overflow: hidden;
        cursor: default;
    }
    .KeywordSubBox{
        margin: 0px 10px 0px 0px;
    }
    .Dttl{
        text-align: center;
        cursor: pointer;
        background: #0c4da2;
        color: #fff;
        font-weight: bold; 
        margin: -6px 0px 0px 0px;
        padding: 7px 5px 3px 5px;
    }

    .KeywordBox input{
        border: 1px solid #ccc;
        border-radius: 2px;
        color: #6d6d6d;
        padding: 0px 30px 0px 5px;
        max-width: calc(100% - 10px);
        height: 29px;
        margin: 5px;
        font-size: 14px;
    }

    .KeywordBox i{
        margin: 11px 0px 0px -34px;
        color: #6d6d6d;
        cursor: pointer;
        height: 15px;
        overflow: hidden;
    }

    .KeywordBox i:hover{
        color: red;
    }
    .Submit{
        text-align: center;
        cursor: pointer;
        background: #0c4da2;
        color: #fff;
        font-weight: bold;
        margin: 20px 0px;
        padding: 7px 5px 9px 5px;
        font-size: 20px;
        cursor: pointer;
    }
    .Error{
        background: red;
        color: #fff;
        padding: 2px 5px 4px 5px;
        cursor: default;
        display: none;
        margin: -26px 0px 20px 0px;
    }
    .CategoryError,.ArticleDescriptionError,.SubCategoryError{
        margin-top: -1px;
    }
    #cke_1_contents{
        min-height: 500px!important;
    }
</style>
<div class="PredefineContainer">
    <div id='ArticleTitleBox'>
        <div class='Dttl'>Article Title</div>
        <textarea type="text" name="ArticleTitle" class='ArticleTitle' id='ArticleTitle' maxlength='100' placeholder="Title of Article..."><?php echo $GetArticle['msg']->Title; ?></textarea>
    </div>
    <div class="ArticleTitleError Error"></div>

    <div class='Dttl' class='ArticleDescription'>Article Description</div>
    <div name='Ckeditor' id='Ckeditor'><div style='height: 66px; border-bottom: 1px solid #ccc;'></div></div>
    <div class="ArticleDescriptionError Error"></div>

    <div id='CategoryBox'></div>
    <div class="CategoryError Error"></div>

    <div id='SubCategoryBox'></div>
    <div class="SubCategoryError Error"></div>

    <div class='KeywordBox'>
        <div class='Dttl'>Keyword</div>
        <span class='KeywordSubBox'>
            <input type='text' placeholder='Enter Keyword here' id='Keyword1' maxlength="20" value="<?php echo $Keyword1; ?>">
            <i class='fas fa-window-close ResetKeyword' name='Keyword1'></i>
        </span>
        <span class='KeywordSubBox'>
            <input type='text' placeholder='Enter Keyword here' id='Keyword2' maxlength="20" value="<?php echo $Keyword2; ?>">
            <i class='fas fa-window-close ResetKeyword' name='Keyword2'></i>
        </span>
        <span class='KeywordSubBox'>
            <input type='text' placeholder='Enter Keyword here' id='Keyword3' maxlength="20" value="<?php echo $Keyword3; ?>">
            <i class='fas fa-window-close ResetKeyword' name='Keyword3'></i>
        </span>
        <span class='KeywordSubBox'>
            <input type='text' placeholder='Enter Keyword here' id='Keyword4' maxlength="20" value="<?php echo $Keyword4; ?>">
            <i class='fas fa-window-close ResetKeyword' name='Keyword4'></i>
        </span>
        <span class='KeywordSubBox'>
            <input type='text' placeholder='Enter Keyword here' id='Keyword5' maxlength="20" value="<?php echo $Keyword5; ?>">
            <i class='fas fa-window-close ResetKeyword' name='Keyword5'></i>
        </span>
    </div>
    <div class='Submit'>Submit <span class="SubmitSpinLoader" hidden="true"><span class="spin_loader_round spin_button_center"><span></span></span></span></div>
    <div class="SubmitError Error"></div>
    <textarea class='DescriptionHide' style='display: none;'><?php echo str_replace('<PredifineKeyword>PredifinePartnerMediaFilePath<PredifineKeyword>', DomainName.'/PartnerMedia/',$Description); ?></textarea>
    <?php require(RootPath."Library/SiteComponents/Footer/index.php"); ?>
    <?php require(RootPath."Library/Apt/Html/AptClassASelectBox/index.html"); ?>
</body>
 <script>
    AptClassASelectBoxCreate({name:'Category',placeholder:'Choose a category',option:['Entertainment','Sports','Society','Politics','Offbeat','Humor','Lifestyle','Tech','Auto','Education','Inspirational','History','Science','Religion','Economics','Jobs'],eid:'CategoryBox'});
   
    function AptClassASelectBoxCreated(event) {
        if(event == 'Category'){
            $('#Category').val("<?php echo explode('||', trim($GetArticle['msg']->Category,'||'))[0]; ?>");
            setTimeout(function(){ $('#Category').trigger('submit'); }, 300);
        }else if(event == 'SubCategory'){
            $('#SubCategory').val("<?php echo explode('||', trim($GetArticle['msg']->Category,'||'))[1]; ?>");
        }
    }
     
    //explode('|', $GetArticle['msg']->Category)

    var Ckeditor = CKEDITOR.replace( 'Ckeditor', {
        height: 82,
    } );

    Ckeditor.on("instanceReady", function(){
        this.document.on("keyup", CkeditorKeyup);
        CKEDITOR.instances['Ckeditor'].setData('');
        setTimeout(function(){ CKEDITOR.instances.Ckeditor.insertHtml($('.DescriptionHide').val()); }, 300);
    });

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
        

        config.extraPlugins = 'AptBrowseImage,youtube';
        
        config.autoGrow_minHeight = 50;
        config.autoGrow_maxHeight = 600;
        config.autoGrow_bottomSpace = 20;

        config.removeButtons = 'Save,NewPage,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,SelectAll,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,Outdent,Indent,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,Flash,Image,About,Replace,Preview,Form,Checkbox,Radio,PageBreak,Source,link';
    };
    
    CKEDITOR.on('dialogDefinition', function (ev) {
        var dialogName = ev.data.name;
        var dialogDefinition = ev.data.definition;
        var dialog = dialogDefinition.dialog;
        var editor = ev.editor;

        if (dialogName == 'image') {
            dialogDefinition.removeContents('Link');
            //dialogDefinition.removeContents('advanced');
            dialogDefinition.removeContents('Upload');
            var tabContent = dialogDefinition.getContents('info');
            tabContent.remove('txtHSpace');
            tabContent.remove('txtVSpace');
            /*tabContent.remove('txtWidth');
            tabContent.remove('txtHeight');*/
            /*tabContent.remove('txtBorder');*/
            tabContent.remove('cmbAlign');
            tabContent.remove( 'ratioLock' ); 
            tabContent.remove( 'htmlPreview' ); 
            //tabContent.remove( 'txtAlt' ); 
            //tabContent.remove( 'txtUrl' );
        }else if(dialogName == 'link'){
            dialogDefinition.removeContents('advanced');
        }
    });

    $("#ArticleTitle").keyup(function(){
        this.style.height = '28px';
        this.style.height = (this.scrollHeight+1) + 'px';
        if(this.value.charAt(0).match(new RegExp(/^[A-Z]/)) == null){
            this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
        }
    });

    $('.ArticleTitle').keyup(function(){
        $('.ArticleTitleError').html('').css({'display':'none'});
    });

    function CkeditorKeyup(){
        $('.ArticleDescriptionError').html('').css({'display':'none'});
    }

    $(".Category").on('keyup change click', function() {
        $('.CategoryError').html('').css({'display':'none'});
        $('.SubCategoryError').html('').css({'display':'none'});
    });

    $("#Category").on("submit", function() {
        var CurrentCategory = $("#Category").val();
        if(CurrentCategory == ''){
            $('#SubCategoryBox').hide('slow', function(){ $('#SubCategoryBox').html(''); $('#SubCategoryBox').css('display','block');  });
            window.PreCategory = '';
        }else{
            if(window.PreCategory != CurrentCategory){
                if(CurrentCategory == 'Entertainment'){
                    var option = ['Music','TV Show','TV series','Movie','celebs&gossip','Celebs Fashion'];
                }else if(CurrentCategory == 'Sports'){
                    var option = ['Cricket','Wrestling','Hockey','Football','Badminton','Table Tennis','Car race','Basketball','Boxing','Tennis'];
                }else if(CurrentCategory == 'Society'){
                    var option = ['Crime','Environment','Livelihood','Custom'];
                }else if(CurrentCategory == 'Politics'){
                    var option = ['Election','Political parties','Politics government','Law','Military'];
                }else if(CurrentCategory == 'Lifestyle'){
                    var option = ['Health','Travel','Food','Fashion','Relationship','Beauty & Male Grooming','Myth'];
                }else if(CurrentCategory == 'Tech'){
                    var option = ['Phone','Games','Software','Cutting edge technologies','Digital product','Communications industry','Internet service'];
                }else if(CurrentCategory == 'Auto'){
                    var option = ['Car','Motocycle','Software','Cutting edge technologies','Digital product','Communications industry','Internet service'];
                }else if(CurrentCategory == 'Education'){
                    var option = ['CBSE','RBSE','BTECH','MBA','JEE','Other'];
                }else if(CurrentCategory == 'Religion'){
                    var option = ['Festivals','Religious places','Religions in india','Pilgrimage trips'];
                }else if(CurrentCategory == 'Economics'){
                    var option = ['Advertising','Marketing','Stock','Budget','Infrastructure','Insurance','Agriculture','Telecom','Energy','Manufacturing','Industry','Tax','Retail','Company','Commodity','Real estate'];
                }else if(CurrentCategory == 'Jobs'){
                    var option = ['PSU','Defence','UPSC','SSC','Railway job','Bank job','Government job'];
                }else{
                    var option = null;
                }

                if(option != null){
                    AptClassASelectBoxCreate({name:'SubCategory',placeholder:'Choose "'+CurrentCategory+'" category',option:option,eid:'SubCategoryBox',method:'insert',duplicate:false});
                    $(".SubCategory").on('keyup change click', function() {
                        $('.SubCategoryError').html('').css({'display':'none'});
                    });
                }else{
                    $('#SubCategoryBox').hide('slow', function(){ $('#SubCategoryBox').html(''); $('#SubCategoryBox').css('display','block');  });
                }
                window.PreCategory = CurrentCategory;
            }
        }
    });

    $('.KeywordSubBox input').keyup(function(){
        // this.value = this.value.pr
    });

    $('.ResetKeyword').click(function(){
        $('#'+$(this).attr('name')).val('');
    });

    window.SubmitSmtBtn = false;
    $('.Submit').click(function(){
        swal.fire('Comming soon','This feature may unlock soon','info'); return false;
        if(window.SubmitSmtBtn != false){ return false; }
        SubmitSmtBtnStart();
        IsError = false;

        var ArticleTitle = $('.ArticleTitle').val();
        if (ArticleTitle == ''){
            $('.ArticleTitleError').html('Article Title can not be empty').css({'display':'block'});;
            IsError = true;
        }

        var ArticleDescription = CKEDITOR.instances.Ckeditor.getData();
        if (ArticleDescription == ''){
            $('.ArticleDescriptionError').html('Article description can not be empty').css({'display':'block'});
            IsError = true;
        }

        var Category = $('.Category').val();
        if (Category == ''){
            $('.CategoryError').html('Category can not be empty').css({'display':'block'});
            IsError = true;
        }
        var SubCategory = $('.SubCategory').val();
        if (SubCategory == ''){
            $('.SubCategoryError').html('Sub category can not be empty').css({'display':'block'});
            IsError = true;
        }else if(SubCategory == undefined){
            SubCategory = '';
        }

        if(IsError == true){
            SubmitSmtBtnReset(); return false;
        }

        var client = new ClientJS();
        imprint.test(browserTests).then(function(result){
            var fingerprint_1 = new Fingerprint().get();
            var customfingerprint_1 = new Fingerprint({screen_resolution: true}).get();
            audioFingerprint.run(function (fingerprint_2) {
                var BrowserClientId1 = RandomPass1 + new jsSHA(fingerprint_1.toString()+customfingerprint_1.toString()+result+fingerprint_3.toString()+uid.toString()+client.getFingerprint().toString()+fingerprint_2+fingerprint_canvas()+client.getCanvasPrint()+fingerprint_display().toString()+fingerprint_touch().toString()+client.getBrowser().toString()+client.getOS().toString()+client.getScreenPrint().toString()).getHash("SHA-512", "HEX") +RandomPass2;
                

                var BrowserClientId2 = RandomPass3+ new jsSHA(customfingerprint_1.toString()+fingerprint_1.toString()+fingerprint_2+uid.toString()+client.getFingerprint().toString()+fingerprint_3.toString()+result+fingerprint_display().toString()+client.getScreenPrint().toString()+client.getBrowser().toString()+client.getOS().toString()+fingerprint_touch().toString()+client.getCanvasPrint()+fingerprint_canvas()).getHash("SHA-512", "HEX") +RandomPass4;

                // append data which we want to send data on targeted page
                var formdata = new FormData();
                formdata.append("Url", "<?php echo $PostUrl; ?>");
                formdata.append("ArticleTitle", ArticleTitle);
                formdata.append("ArticleTitle", ArticleTitle);
                formdata.append("ArticleDescription", ArticleDescription);
                formdata.append("Category", Category);
                formdata.append("SubCategory", SubCategory);
                formdata.append("Keyword1", $('#Keyword1').val());
                formdata.append("Keyword2", $('#Keyword2').val());
                formdata.append("Keyword3", $('#Keyword3').val());
                formdata.append("Keyword4", $('#Keyword4').val());
                formdata.append("Keyword5", $('#Keyword5').val());
                formdata.append("Token_CSRF", '<?php echo $Token_CSRF; ?>');
                formdata.append("BrowserClientId1", BrowserClientId1);
                formdata.append("BrowserClientId2", BrowserClientId2);

                if(navigator.onLine == false){
                    swal.fire('Internet',"It seems that you are offline. Please check your internet connection", "warning");
                    SubmitSmtBtnReset(); return false;
                }
                
                try{
                    var ajax = new XMLHttpRequest();
                    ajax.addEventListener("load",WriteArticleHandler,false);
                    ajax.open("POST", RootPath+"Dashboard/Partner/ArticleEdit/index.php");
                    ajax.send(formdata);
                }catch(error){
                    swal.fire('Technical Error',"An Technical error occur in login process! Try again later", "warning");
                    SubmitSmtBtnReset(); return false;
                }

                function WriteArticleHandler(event){
                    SubmitSmtBtnReset();
                    var response = $.parseJSON(event.target.responseText);
                    if(response['code'] === 200){
                        swal.fire('Submit',response['msg'],'success')
                        .then((value) => {
                            window.location.reload();
                        });
                    }else{
                        swal.fire('Submit',response['msg'], "warning");
                    }
                }
            });
        });
        function SubmitSmtBtnStart(){
            window.SubmitSmtBtn = true;
            $(".SubmitSpinLoader").prop('hidden',false);
            $("input").prop("disabled",true);
            $("select").prop("disabled",true);
            $('.Submit').css("pointer-events","none");
            $(".Submit").css("background","linear-gradient(skyblue, pink)");
            $(".Submit").css("cursor","default");
        }
        function SubmitSmtBtnReset(){
            $("input").prop("disabled",false);
            $("select").prop("disabled",false);
            $('.Submit').css("pointer-events","auto");
            $(".Submit").css("background","#0c4da2");
            $(".Submit").css("cursor","pointer");
            $(".SubmitSpinLoader").prop('hidden',true);
            window.SubmitSmtBtn = false;
        }
    });
</script>
</html>
<script>

</script>