<?php
/**
events: OnManagerLoginFormPrerender,OnManagerTopFrameHeaderHTMLBlock,OnManagerTopPrerender,OnManagerTreeInit
config:
&PrimaryColor=main Manager Color:;string;#499bea;;Theme Primary Color (mandatory) &NavBgColor= Nav Background color:;string;;;(optional) &NavLinkColor= Nav link color :;string;#e5eef5;;(optional) &NavLinkHColor= Nav link hover color:;string;#fff;;(optional) &NavDropBgHColor= Nav dropdown hover bg color:;string;;;(optional) &TreeBgColor= Tree Frame Background:;string;;;(optional) &TLinkColor=Tree Links Color:;string;;;Published resources and ElementsInTree element names (optional) &MainBgColor= Main Frame Background:;string;;;(optional) &MainLinkColor=Main Links Color:;string;;;(optional) &ShowLoginLogo=Show Login Logo:;menu;show,hide;show;;Hide EVO logo in login page &CustomLogoPath=Custom Logo path:;string;;;enter the of your company logo &animate-login=Animate Login box:;menu;yes,no;yes;;Add a soft animation to the login box &CustomLoginStyle=Custom Login styles chunk:;string;;;chunk name &CustomNavStyle=Custom Top Frame styles chunk:;string;;;chunk name &CustomTreeStyle=Custom Tree Frame styles chunk:;string;;;chunk name &CustomMainStyle=Custom Main Frame styles chunk:;string;;;chunk name 

**/
global $modx;
$output = "";
$e = &$modx->Event;

//Main Color */
$PrimaryColor = isset($PrimaryColor) ? $PrimaryColor : '';
$TreeLinksC = isset($TreeLinksC) ? $TreeLinksC : '';
$NavBgColor = isset($NavBgColor) ? $NavBgColor : $PrimaryColor;
$NavDropBgHColor = isset($NavDropBgHColor) ? $NavDropBgHColor : $PrimaryColor;
/*****************login*************/
$sitename = $modx->getPlaceholder('site_name');
if($e->name == 'OnManagerLoginFormPrerender') {
if ($CustomLogoPath !== '') {
$logocustom = '<a class="logo" href="../" title="'.$sitename.'">
					<img src="'.$CustomLogoPath.'" alt="'.$sitename.'" id="logocustom" />
				</a>';
}
if ($animate-login == 'yes') {
$animatedlogin ='  
/* CSS Animations */
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

$logincssOutput = '<style>
html, body, body.dark div.page{background-color: '.$PrimaryColor.';}
'.$logodisplay.'
'.$animatedlogin.'
'.$modx->getChunk(''.$CustomLoginStyle.'').'
</style>
  '.$logocustom.''
;

}


/***************Top Frame (nav)  ******************/
if($e->name == 'OnManagerTopPrerender') {
//top frame - Nav bar
$topcssOutput = '<style>
#mainMenu { background-color: '.$NavBgColor.'; color: '.$NavLinkColor.';}
#mainMenu .nav > li > a { color: '.$NavLinkColor.';!important }
#mainMenu .nav > li > a:hover, #mainMenu .nav .label_searchid:hover { color: '.$NavLinkHColor.';!important }
#mainMenu .nav > li > ul > li.hover > a { color: #fff; background-color: '.$NavDropBgHColor.'; }
'.$modx->getChunk(''.$CustomNavStyle.'').'
</style>
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
<style>

body {
	background:'.$MainBgColor.'!important;
}
a:link, a:visited {
    color: '.$ALinksColor.'!important;
}
span.disabledPlugin a {
    color: #aaa!important;
}
ul li span a, span.pagetitle-icon, h1 .fa
{color: '.$PrimaryColor.'!important;}

input[type="button"], input[type="submit"]{
border-color: '.$PrimaryColor.';}
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
box-shadow: 0 -3px 0 '.$PrimaryColor.',-1px 0 0 transparent!important;
color:'.$PrimaryColor.'!important;
}
.dynamic-tab-pane-control .tab-row .tab.selected span:after {
border-top-color: '.$PrimaryColor.';
}
.dynamic-tab-pane-control .tab-row .tab.selected.hover {
color:'.$PrimaryColor.';
border-top-color:'.$PrimaryColor.';
}

.dynamic-tab-pane-control.tab-pane .tab-row .tab, 
.dynamic-tab-pane-control.tab-pane .tab-row .tab span, 
.dynamic-tab-pane-control.tab-pane .tab-row .tab.selected span,
.dynamic-tab-pane-control.tab-pane .tab-row .tab.selected.hover span,
.dynamic-tab-pane-control.tab-pane .tab-row .tab span i,
.tab-pane ul li ul li strong,
.dynamic-tab-pane-control.tab-pane .tab-row .tab.hover span
{
color:'.$PrimaryColor.';
}
.wm_buttons a { color: #576B75 !important;}
</style>
';
}

/***************tree frame**********************/
if($e->name == 'OnManagerTreeInit') {
//tree frame
    

if (empty($TLinkColor)) {
$TreeLinksColor = $PrimaryColor;
}
else {
$TreeLinksColor = $TLinkColor;
    }

$treecssOutput = '
<!-----mancolor--!>
<style>

#treeRoot a.deleted .title { color: #A52A2A; text-decoration: line-through; }
#treeRoot a.unpublished .title { color: #B68282; font-style: italic; }
#treeRoot a.hidemenu .title { color: #404040; }
#treeRoot a.protected .title { color: #aaa; }
#treeRoot a .lockedResource { cursor: pointer; }
#treeRoot a .editResource { margin-left: 0.2em }

.treeButton i, .treeButtonDisabled i , #mx_contextmenu .menuLink i{  color: '.$PrimaryColor.'!important;
}
div#treeHolder a i:hover, .treeButton i:hover, .treeButtonDisabled i:hover {
	color: '.$PrimaryColor.'!important;
}

.treeframebody .tab-row h2.tab span, .treeframebody .tab-row h2.tab span i, .treeframebody .tab-pane input.form-control{
    color: '.$TreeLinksColor.'!important; }

#mx_contextmenu #nameHolder, #mx_contextmenu a i, #mx_contextmenu .menuLink:hover {
background:'.$PrimaryColor.';
color:#FFF!important;
}
 .tab-page ul.actionButtons li a, #treePane .tab-page .actionButtons a:hover, #treePane .tab-page .actionButtons a:hover i {
color: '.$PrimaryColor.'!important;
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
';

}
$manager_theme = $modx->config['manager_theme'];
if($manager_theme == "default") {
$output .= $logincssOutput.$maincssOutput.$topcssOutput.$treecssOutput;
}
$e->output($output);
return;
?>