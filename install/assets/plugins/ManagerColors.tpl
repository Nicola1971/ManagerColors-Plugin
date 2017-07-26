//<?php
/**
 * ManagerColors
 *
 * Customize Default EVO Manager theme colors
 *
 * @author    Nicola Lambathakis http://www.tattoocms.it/
 * @category    plugin
 * @version    beta 3.0
 * @license	 http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal    @events OnManagerLoginFormPrerender,OnManagerTopFrameHeaderHTMLBlock,OnManagerTopPrerender,OnManagerTreeInit
 * @internal    @installset base
 * @internal    @modx_category Admin
 * @internal    @properties  &PrimaryColor=main Manager Color:;string;#499bea;;Theme Primary Color (mandatory) &NavBgColor= Nav Background color:;string;;;(optional) &NavLinkColor= Nav link color :;string;#e5eef5;;(optional) &NavLinkHColor= Nav link hover color:;string;#fff;;(optional) &NavDropBgHColor= Nav dropdown hover bg color:;string;;;(optional) &TreeBgColor= Tree Frame Background:;string;;;(optional) &TLinkColor=Tree Links Color:;string;;;Published resources and ElementsInTree element names (optional) &MainBgColor= Main Frame Background:;string;;;(optional) &MainLinkColor=Main Links Color:;string;;;(optional) &ShowLoginLogo=Show Login Logo:;menu;show,hide;show;;Hide EVO logo in login page &CustomLogoPath=Custom Logo path:;string;;;enter the of your company logo &animate-login=Animate Login box:;menu;yes,no;yes;;Add a soft animation to the login box &CustomLoginStyle=Custom Login styles chunk:;string;;;chunk name &CustomNavStyle=Custom Top Frame styles chunk:;string;;;chunk name &CustomTreeStyle=Custom Tree Frame styles chunk:;string;;;chunk name &CustomMainStyle=Custom Main Frame styles chunk:;string;;;chunk name)
 */

/*
### MODxFlatColors Plugin for Evolution CMS 1.3 ###
Customize Default EVO Manager theme colors
Written By Nicola Lambathakis http://www.tattoocms.it/
Version beta 3.0
Events: OnManagerLoginFormPrerender,OnManagerTopFrameHeaderHTMLBlock,OnManagerTopPrerender,OnManagerTreeInit

Default configuration:
&PrimaryColor=main Manager Color:;string;#499bea;;Theme Primary Color (mandatory) &NavBgColor= Nav Background color:;string;;;(optional) &NavLinkColor= Nav link color :;string;#e5eef5;;(optional) &NavLinkHColor= Nav link hover color:;string;#fff;;(optional) &NavDropBgHColor= Nav dropdown hover bg color:;string;;;(optional) &TreeBgColor= Tree Frame Background:;string;;;(optional) &TLinkColor=Tree Links Color:;string;;;Published resources and ElementsInTree element names (optional) &MainBgColor= Main Frame Background:;string;;;(optional) &MainLinkColor=Main Links Color:;string;;;(optional) &ShowLoginLogo=Show Login Logo:;menu;show,hide;show;;Hide EVO logo in login page &CustomLogoPath=Custom Logo path:;string;;;enter the of your company logo &animate-login=Animate Login box:;menu;yes,no;yes;;Add a soft animation to the login box &CustomLoginStyle=Custom Login styles chunk:;string;;;chunk name &CustomNavStyle=Custom Top Frame styles chunk:;string;;;chunk name &CustomTreeStyle=Custom Tree Frame styles chunk:;string;;;chunk name &CustomMainStyle=Custom Main Frame styles chunk:;string;;;chunk name

*/


// Run the main code
include($modx->config['base_path'].'assets/plugins/managercolors/mancolors.php');
