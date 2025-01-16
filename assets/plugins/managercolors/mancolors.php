<?php
/**
 * ManagerColors plugin 
 * Customize Evolution CMS Default Manager theme colors
 * version    4.0.2
 * Events: OnManagerLoginFormPrerender,OnManagerMainFrameHeaderHTMLBlock,OnManagerTopPrerender
 */

if (!defined('MODX_BASE_PATH')) { die('What are you doing? Get out of here!'); }

// Initialize plugin parameters with default values
$plgVisibility = $plgVisibility ?? 'All';
$ThisRole = $ThisRole ?? '';
$ThisUser = $ThisUser ?? '';
$ShowLoginLogo = $ShowLoginLogo ?? 'default';
$ShowNavLogo = $ShowNavLogo ?? 'default';
$CustomLoginStyle = $CustomLoginStyle ?? '';
$CustomNavStyle = $CustomNavStyle ?? '';
$CustomMainStyle = $CustomMainStyle ?? '';
$TLinkColor = $TLinkColor ?? '';
$TDarkLinkColor = $TDarkLinkColor ?? '';
$NavLinkColor = $NavLinkColor ?? '';
$NavLinkHColor = $NavLinkHColor ?? '';
$NavLinkLActColor = $NavLinkLActColor ?? '';
$TreeLinksColor = $TreeLinksColor ?? '';
$MainLinkColor = $MainLinkColor ?? '';
$buttonsColor = $buttonsColor ?? 'no';
$stylelogodisplay = '';
$styleLoginBg = '';
$styleTreeLinksColor = '';
$styleElTreeButtC = '';
$stylelogocustom = '';
$stylecoloredButtons = '';
$styleALinksColor = '';

// get manager role
$internalKey = $modx->getLoginUserID();
$sid = $modx->sid;
$role = $_SESSION['mgrRole'] ?? null;
$user = $_SESSION['mgrShortname'] ?? null;

// run for Admin role 1
if(($role!=1) AND ($plgVisibility == 'AdminOnly')) {}
// run for all manager users excluded Admin role 1
else if(($role==1) AND ($plgVisibility == 'AdminExcluded')) {}
// run only for "this" role id
else if(($role!=$ThisRole) AND ($plgVisibility == 'ThisRoleOnly')) {}
// run only for "this" username
else if(($user!=$ThisUser) AND ($plgVisibility == 'ThisUserOnly')) {}
else {
    global $modx;
    $output = "";
    $e = &$modx->Event;

    //Colors
    $PrimaryColor = $PrimaryColor ?? '';
    $TreeLinksC = $TreeLinksC ?? '';
    $DarkTreeLinksColor = $DarkTreeLinksColor ?? '';
    $TreeButtC = $TreeButtC ?? $PrimaryColor;
    $ElTreeButtC = $ElTreeButtC ?? '';
    $LoginBgColor = $LoginBgColor ?? '';
    $NavBgColor = $NavBgColor ?? $PrimaryColor;
    $NavDropBgHColor = $NavDropBgHColor ?? $PrimaryColor;
    
    //logos
    $CustomLogoPath = $CustomLogoPath ?? '';
    
    /*****************login*************/
    $sitename = $modx->getPlaceholder('site_name');
    if($e->name == 'OnManagerLoginFormPrerender') {
        if ($LoginBgColor !== '') {
            $styleLoginBg = ' 
            body{background-color: '.$LoginBgColor.';}
            body div.page{background-color: '.$LoginBgColor.';}
            '; 
        }

        if ($ShowLoginLogo == 'hide') {
            $stylelogodisplay = 'img#logo {display:none;}';    
        }

        $logincssOutput = '
        <!-----managercolor LoginFormPrerender--!>
        <style>
        '.$styleLoginBg.'
        '.$stylelogodisplay.'
        '.$modx->getChunk($CustomLoginStyle).'
        </style>
        <!----- end managercolor--!>  
        ';
    }

    /***************Top & left Frames (nav and tree)  ******************/
    if($e->name == 'OnManagerTopPrerender') {
        //left frame - Tree
        if (!empty($TLinkColor)) {
            $styleTreeLinksColor = '.treeframebody .tab-pane input.form-control, #treeRoot a:not(.deleted):not(.unpublished):not(.hidemenu) .title {
        color: '.$TLinkColor.'!important; }';
        }   

        $styleDarkTreeLinksColor = '';
        if (!empty($TLinkColor) && empty($TDarkLinkColor)) {
            $DarkTreeLinksColor = $TLinkColor;
            $styleDarkTreeLinksColor = '.dark #treeMenu .treeButton, .dark .treeframebody .tab-pane input.form-control, .dark #treeRoot a:not(.deleted):not(.unpublished):not(.hidemenu) .title,
            .darkness #treeMenu .treeButton, .darkness .treeframebody .tab-pane input.form-control, .darkness #treeRoot a:not(.deleted):not(.unpublished):not(.hidemenu) .title {color: '.$DarkTreeLinksColor.'!important; }';
        } else if (!empty($TDarkLinkColor)) {
            $DarkTreeLinksColor = $TDarkLinkColor;
            $styleDarkTreeLinksColor = '.dark #treeMenu .treeButton, .dark .treeframebody .tab-pane input.form-control, .dark #treeRoot a:not(.deleted):not(.unpublished):not(.hidemenu) .title,
            .darkness #treeMenu .treeButton, .darkness .treeframebody .tab-pane input.form-control, .darkness #treeRoot a:not(.deleted):not(.unpublished):not(.hidemenu) .title {color: '.$DarkTreeLinksColor.'!important; }';
        }

        if (!empty($ElTreeButtC)) {
            $styleElTreeButtC = '.treeframebody .tab-row h2.tab span i  {color: '.$ElTreeButtC.'!important; }';
        }
        
        //top frame - Nav bar
        $mainMenuColor = empty($NavBgColor) ? $PrimaryColor : $NavBgColor;
        
        //Navbar Logo
        if ($ShowNavLogo == 'hide') {
            $stylenavlogodisplay = 'body #mainMenu [data-evocp="bgmColor"] #nav #site::before, #mainMenu #nav #site::before {display:none;} @media (min-width: 1200px) {
                #mainMenu #nav #site a {margin-left:0;} }';    
        }
        else if ($ShowNavLogo == 'blacktext') {
            $stylenavlogodisplay = 'body #mainMenu [data-evocp="bgmColor"] #nav #site::before, #mainMenu #nav #site::before, body.lightness #mainMenu #nav #site::before {background: url("media/style/default/images/misc/logo-navbar.png") 0 50% no-repeat; background-size: 8rem; }';    
        }
        else if ($ShowNavLogo == 'whitetext') {
            $stylenavlogodisplay = 'body #mainMenu [data-evocp="bgmColor"] #nav #site::before, #mainMenu #nav #site::before, body.lightness #mainMenu #nav #site::before {background: url("media/style/default/images/misc/logo-navbar-white.png") 0 50% no-repeat; background-size: 8rem; }';   
        } 
        else if ($ShowNavLogo == 'smallblack') {
            $stylenavlogodisplay = 'body #mainMenu [data-evocp="bgmColor"] #nav #site::before, #mainMenu #nav #site::before, body.lightness #mainMenu #nav #site::before {left: 0; top: 0.25rem; width: 100%; height: 2.0rem; background: url("media/style/default/images/misc/logo-navbar-left.png") no-repeat 0 50%; background-size: 2.0rem;} @media (min-width: 1200px) {
                #mainMenu #nav #site a {margin-left:3.0rem;;} }';  
        } 
        else if ($ShowNavLogo == 'smallwhite') {
            $stylenavlogodisplay = 'body #mainMenu [data-evocp="bgmColor"] #nav #site::before, #mainMenu #nav #site::before, body.lightness #mainMenu #nav #site::before {left: 0; top: 0.25rem; width: 100%; height: 2.0rem; background: url("media/style/default/images/misc/logo-navbar-left-white.png") no-repeat 0 50%; background-size: 2.0rem;} @media (min-width: 1200px) {
                #mainMenu #nav #site a {margin-left:3.0rem;;} }';  
        }
        else if ($CustomLogoPath !== '' && $ShowNavLogo == 'customwide') {
            $stylelogocustom = 'body #mainMenu [data-evocp="bgmColor"] #nav #site::before, #mainMenu #nav #site::before, body.lightness #mainMenu #nav #site::before {background: url("'.$CustomLogoPath.'") 0 50% no-repeat; background-size: 8rem; }';
        }
        else if ($CustomLogoPath !== '' && $ShowNavLogo == 'customsquare') {
            $stylelogocustom = 'body #mainMenu [data-evocp="bgmColor"] #nav #site::before, #mainMenu #nav #site::before, body.lightness #mainMenu #nav #site::before {left: 0; top: 0.25rem; width: 100%; height: 2.0rem; background: url("'.$CustomLogoPath.'") no-repeat 0 50%; background-size: 2.0rem;} @media (min-width: 1200px) {
                #mainMenu #nav #site a {margin-left:3.0rem;;} }';
        }

        $topcssOutput = '
        <!-----managercolor TopPrerender--!>
        <style>
        #mainMenu [data-evocp="bgmColor"] { background-color: '.$mainMenuColor.'; color: '.$NavLinkColor.';}
        .lightness #mainMenu [data-evocp="bgmColor"]  .nav > li > a, 
        #mainMenu [data-evocp="bgmColor"]  .nav > li > a, #mainMenu .nav .label_searchid { color: '.$NavLinkColor.'!important; }
        #mainMenu [data-evocp="bgmColor"] .nav > li > a:hover, #mainMenu .nav .label_searchid:hover { color: '.$NavLinkHColor.'!important; }
        .dark #mainMenu.show [data-evocp="bgmColor"] .nav > li.dropdown.hover > a, .light #mainMenu.show [data-evocp="bgmColor"] .nav > li.dropdown.hover > a, .lightness #mainMenu.show [data-evocp="bgmColor"] .nav > li.dropdown.hover > a { color: '.$NavLinkLActColor.'!important;}
        .lightness #mainMenu.show [data-evocp="bgmColor"] .nav > li.dropdown.hover > a { background-color: #FFF!important;}
        #mainMenu [data-evocp="bgmColor"]  .nav > li > ul > li.hover > a { color: #fff; background-color: '.$NavDropBgHColor.'!important; }
        .lightness #mainMenu [data-evocp="bgmColor"] .nav > li.active > a {background: rgba(255, 255, 255, 0.07);}  
        '.$stylelogocustom.'
        '.$stylenavlogodisplay.'
        '.$modx->getChunk($CustomNavStyle).'
        .treeButton i, .treeButtonDisabled i , #mx_contextmenu .menuLink i,
        div#treeHolder a i:hover, .treeButton i:hover, .treeButtonDisabled i:hover, .tab-page ul.actionButtons li a, #treePane .tab-page .actionButtons a:hover, #treePane .tab-page .actionButtons a:hover i 
        {color: '.$TreeButtC.'!important;}
        '.$styleTreeLinksColor.'
        '.$styleDarkTreeLinksColor.'
        '.$styleElTreeButtC.'
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
        <!-----end managercolor--!>
        ';
    }

    /***************Main frame******************/
    //coloured action buttons
    if ($buttonsColor == 'yes') {
        $stylecoloredButtons = '
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

    if($e->name == 'OnManagerMainFrameHeaderHTMLBlock') {
        if (!empty($MainLinkColor)) {
            $styleALinksColor = '.elements_description :not(.disabledPlugin) a.man_el_name, .container-body .card a, td a {color: '.$MainLinkColor.';}';
        }
        
        //main frame - boxes and tabs
        $maincssOutput = '
        <!-----managercolor MainFrameHeaderHTMLBlock --!>
        <style>
        '.$styleALinksColor.'

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
        .resourceTable ul.elements > li:hover { border-left-color:'.$PrimaryColor.'!important; }
        ul li span a:not(.man_el_name ), span.pagetitle-icon, h1 .fa {color: '.$PrimaryColor.'!important;}
        .wm_buttons a { color: #576B75 !important;}
        '.$stylecoloredButtons.'

        '.$modx->getChunk($CustomMainStyle).'
        </style>
        <!-----end managercolor--!>
        ';
    }

    $manager_theme = $modx->config['manager_theme'];
    if($manager_theme == "default") {
        $output .= $logincssOutput ?? '';
        $output .= $maincssOutput ?? '';
        $output .= $topcssOutput ?? '';
    }
    $e->output($output);
    return;
}
?>