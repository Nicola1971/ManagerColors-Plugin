<?php
/**
events: OnManagerLoginFormPrerender,OnManagerMainFrameHeaderHTMLBlock,OnManagerTopPrerender
config:
&PrimaryColor=Main Theme Color:;string;#499bea;;Theme Primary Color (mandatory) &NavBgColor= Top Nav Background color:;string;;;(optional) &NavLinkColor= Top Nav link color :;string;#e5eef5;;(optional) &NavLinkHColor= Top Nav link hover color:;string;#fff;;(optional) &NavDropBgHColor= Top Nav dropdown hover bg color:;string;;;(optional) &TreeBgColor= Tree Menu Background:;string;;;(optional) &TreeDarkBgColor= Tree Menu Dark Background:;string;;;(optional) &TLinkColor=Tree Menu Links Color:;string;;;Published resources and ElementsInTree element names (optional) &CustomNavStyle=Custom Navigation and Tree styles chunk:;string;;;chunk name  &MainBgColor= Main Frame Background:;string;;;(optional) &MainBgDarkColor= Main Frame Dark Background:;string;;;(optional) &MainLinkColor=Main Links Color:;string;;;(optional) &buttonsColor=Colored action buttons:;menu;yes,no;yes;;Add background color to duplicate delete and cancel buttons &CustomMainStyle=Custom Main Frame styles chunk:;string;;;chunk name  &LoginBgColor= Login Page Background color:;string;#499bea;;overwrite both dark and light backgrounds (optional) &LoginBgImage= Login Page Background image:;string;;;ie: ../assets/images/login/rainbow.jpg (optional) &ShowLoginLogo=Show Login Logo:;menu;show,hide;show;;Hide EVO logo in login page &CustomLogoPath=Custom Logo path:;string;;;enter the url of your company logo &animate-login=Animate Login box:;menu;yes,no;yes;;Add a soft animation to the login box &CustomLoginStyle=Custom Login styles chunk:;string;;;chunk name  

**/
global $modx;
$output = "";
$e = &$modx->Event;

//Colors */
$PrimaryColor = isset($PrimaryColor) ? $PrimaryColor : '';
$TreeLinksC = isset($TreeLinksC) ? $TreeLinksC : '';
$LoginBgColor = isset($LoginBgColor) ? $LoginBgColor : '';
$LoginBgImage = isset($LoginBgImage) ? $LoginBgImage : '';
$NavBgColor = isset($NavBgColor) ? $NavBgColor : $PrimaryColor;
$NavDropBgHColor = isset($NavDropBgHColor) ? $NavDropBgHColor : $PrimaryColor;


if ($buttonsColor == 'yes') {
$coloredButtons = '
/* duplicate button */ 
#actions a#Button6.btn.btn-secondary{
color: #FFF!important;
border-color: #337ab7;
background: #337ab7;}
#actions a#Button6.btn.btn-secondary:hover{
color: #fff;
border-color: #285e8d;
background:#285e8d;}

/* delete button */ 
#actions a#Button3.btn.btn-secondary{
color: #FFF!important;
border-color: #e77755;
background-color: #e77755;}
#actions a#Button3.btn.btn-secondary:hover{
color: #fff;
border-color: #bc3423;
background:#bc3423;}

/* cancel button */ 
#actions a#Button5.btn.btn-secondary{
color: #FFF!important;
border-color: #f0ad4e;
background: #f0ad4e!important;}
#actions a#Button5.btn.btn-secondary:hover{
color: #FFF;
border-color: #e18a13;
background: #e18a13!important;}';
}

/*****************login*************/
$sitename = $modx->getPlaceholder('site_name');
if($e->name == 'OnManagerLoginFormPrerender') {

if ($LoginBgColor !== '') {
$LoginBg = ' 
body{background-color: '.$LoginBgColor.';}
body.dark div.page{background-color: '.$LoginBgColor.';}
'; 
}
else {
$LoginBg = ' 
body{background-color: '.$MainBgColor.';}
body.dark div.page{background-color: '.$MainBgDarkColor.';}
';   
}
if ($LoginBgImage !== '') {
$LoginBgI = ' 
body{background: url("'.$LoginBgImage.'") no-repeat center center fixed; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;}
      
body.dark div.page{background: url("'.$LoginBgImage.'") no-repeat center center fixed; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;}
'; 
}
else {
$LoginBgI = '';
}
if ($CustomLogoPath !== '') {
$logocustom = '<a class="logo" href="../" title="'.$sitename.'">
					<img src="'.$CustomLogoPath.'" alt="'.$sitename.'" id="logocustom" />
				</a>';
}
if ($animate-login == 'yes') {
$animatedlogin ='  
/* CSS Animation */
.loginbox {width: 460px;
    position: absolute;
    left: 50%;
    top: 25%;
    margin-left: -250px;
    margin-top: -75px;
    -webkit-animation: login 1s ease-in-out;
    -moz-animation: login 1s ease-in-out;
    -ms-animation: login 1s ease-in-out;
    -o-animation: login 1s ease-in-out;
    animation: login 1s ease-in-out;
}
@keyframes "login" {
 0% {
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    opacity: 0;
    margin-top: -50px;
 }
 100% {
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    filter: alpha(opacity=100);
    opacity: 1;
    margin-top: -75px;
 }
}
@-moz-keyframes login {
 0% {
   filter: alpha(opacity=0);
   opacity: 0;
   margin-top: -50px;
 }
 100% {
   filter: alpha(opacity=100);
   opacity: 1;
   margin-top: -75px;
 }
}
@-webkit-keyframes "login" {
 0% {
   filter: alpha(opacity=0);
   opacity: 0;
   margin-top: -50px;
 }
 100% {
   filter: alpha(opacity=100);
   opacity: 1;
   margin-top: -75px;
 }
}
@-ms-keyframes "login" {
 0% {
   -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
   filter: alpha(opacity=0);
   opacity: 0;
   margin-top: -50px;
 }
 100% {
   -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
   filter: alpha(opacity=100);
   opacity: 1;
   margin-top: -75px;
 }
}
@-o-keyframes "login" {
 0% {
   filter: alpha(opacity=0);
   opacity: 0;
   margin-top: -50px;
 }
 100% {
   filter: alpha(opacity=100);
   opacity: 1;
   margin-top: -75px;
 }
}';
}
if ($ShowLoginLogo == 'hide') {
$logodisplay = 'img#logo {display:none;}';    
}

$logincssOutput = '
<!-----mancolor LoginFormPrerender--!>
<style>
'.$LoginBg.'
'.$LoginBgI.'
'.$logodisplay.'
'.$animatedlogin.'
'.$modx->getChunk(''.$CustomLoginStyle.'').'
</style>
  '.$logocustom.'
<!----- end mancolor--!>  
';
}

/***************Top Frame (nav)  ******************/
if($e->name == 'OnManagerTopPrerender') {
//top frame - Nav bar

if (empty($TLinkColor)) {
$TreeLinksColor = $PrimaryColor;
}
else {
$TreeLinksColor = $TLinkColor;
    }
$topcssOutput = '
<!-----mancolor TopPrerender--!>
<style>
#mainMenu { background-color: '.$NavBgColor.'; color: '.$NavLinkColor.';}

#mainMenu .nav > li > a, #mainMenu .nav .label_searchid { color: '.$NavLinkColor.'!important; }
#mainMenu .nav > li > a:hover, #mainMenu .nav .label_searchid:hover { color: '.$NavLinkHColor.'!important; }
#mainMenu .nav > li > ul > li.hover > a { color: #fff; background-color: '.$NavDropBgHColor.'!important; }
#mainMenu.show .nav > li.dropdown.hover > a { background-color: #fff; color: #444!important; }
'.$modx->getChunk(''.$CustomNavStyle.'').'

#tree .treeframebody #treeHolder{ background-color: '.$TreeBgColor.';}
.dark #tree .treeframebody, .dark.ElementsInTree #tree .treeframebody #treeHolder, .dark.ElementsInTree #tree .treeframebody #treeHolder h2.tab.selected, .dark #treeMenu .treeButton:hover:not(.disabled){ background-color: '.$TreeDarkBgColor.';}
.treeButton i, .treeButtonDisabled i , #mx_contextmenu .menuLink i,
div#treeHolder a i:hover, .treeButton i:hover, .treeButtonDisabled i:hover, .tab-page ul.actionButtons li a, #treePane .tab-page .actionButtons a:hover, #treePane .tab-page .actionButtons a:hover i 
{
	color: '.$PrimaryColor.'!important;
}
.dark #treeMenu .treeButton, .treeframebody .tab-row h2.tab span, .treeframebody .tab-row h2.tab span i, .treeframebody .tab-pane input.form-control, #treeRoot a:not(.deleted):not(.unpublished):not(.hidemenu) .title {
color: '.$TreeLinksColor.'!important; }
#mx_contextmenu #nameHolder, #mx_contextmenu a i, #mx_contextmenu .menuLink:hover i, #mx_contextmenu .menuLink:hover 
{
background:'.$PrimaryColor.';
color:#FFF!important;
}
.rootNode, .publishedNode, 
.treeframebody .elementname {color: '.$TreeLinksColor.'!important;}
span.disabledPlugin > a > span.elementname {color: #b27979!important;}
#treePane span.panel-title a:hover{color: '.$PrimaryColor.';}
#treeSplitter {background: '.$PrimaryColor.';}
.nu-context-menu ul li:hover {
    background: '.$PrimaryColor.'!important;
    border-color: '.$PrimaryColor.'!important;
}
.nu-context-menu ul li i, .nu-context-menu-title {color:'.$PrimaryColor.';}
</style>
<!-----end mancolor--!>
';

}
/***************Main frame******************/
if($e->name == 'OnManagerMainFrameHeaderHTMLBlock') {
if (empty($MainLinkColor)) {
$ALinksColor = $PrimaryColor;
}
else {
$ALinksColor = $MainLinkColor;
    }
//main frame - boxes and tabs
$maincssOutput = '
<!-----mancolor MainFrameHeaderHTMLBlock --!>
<style>

body {
	background:'.$MainBgColor.'!important;
}
body.dark {
	background:'.$MainBgDarkColor.'!important;
}
a:link, a:visited {
    color: '.$ALinksColor.'!important;
}
span.disabledPlugin a {
    color: #aaa!important;
}
input[type="button"], input[type="submit"]{border-color: '.$PrimaryColor.';}
a.btn-default {
background:'.$PrimaryColor.';
border-color:'.$PrimaryColor.'; 
color:#FFF!important;
}

.btn.panel-hide {color: #999!important;}
a#Button1, a.btn-primary, a.primary, a.btn-success, a.btn-danger { color: #fff!important;}
.dynamic-tab-pane-control.tab-pane .tab-row h2.tab.selected.hover,
.dynamic-tab-pane-control.tab-pane .tab-row .tab.selected,
.dynamic-tab-pane-control.tab-pane .tab-row .tab.selected.hover,
.dynamic-tab-pane-control .tab-row .tab.selected,
.dynamic-tab-pane-control .tab-row .tab.selected.hover
{
color:'.$PrimaryColor.'!important;
}
ul li span a, span.pagetitle-icon, h1 .fa {color: '.$PrimaryColor.'!important;}
.wm_buttons a { color: #576B75 !important;}
'.$coloredButtons.'

'.$modx->getChunk(''.$CustomMainStyle.'').'
</style>
<!-----end mancolor--!>
';
}


$manager_theme = $modx->config['manager_theme'];
if($manager_theme == "default") {
$output .= $logincssOutput.$maincssOutput.$topcssOutput;
}
$e->output($output);
return;
?>