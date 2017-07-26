//<?php
/**
 * ManagerColors
 *
 * Customize Default EVO Manager theme colors
 *
 * @author    Nicola Lambathakis http://www.tattoocms.it/
 * @category    plugin
 * @version    beta 3.1.1
 * @license	 http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal    @events OnManagerLoginFormPrerender,OnManagerTopFrameHeaderHTMLBlock,OnManagerTopPrerender,OnManagerTreeInit
 * @internal    @installset base
 * @internal    @modx_category Admin
 * @internal    @properties  &PrimaryColor=Main Theme Color:;string;#499bea;;Theme Primary Color (mandatory) &NavBgColor= Top Nav Background color:;string;;;(optional) &NavLinkColor= Top Nav link color :;string;#e5eef5;;(optional) &NavLinkHColor= Top Nav link hover color:;string;#fff;;(optional) &NavDropBgHColor= Top Nav dropdown hover bg color:;string;;;(optional) &TreeBgColor= Tree Menu Background:;string;;;(optional) &TreeDarkBgColor= Tree Menu Dark Background:;string;;;(optional) &TLinkColor=Tree Menu Links Color:;string;;;Published resources and ElementsInTree element names (optional) &CustomNavStyle=Custom Navigation and Tree styles chunk:;string;;;chunk name  &MainBgColor= Main Frame Background:;string;;;(optional) &MainBgDarkColor= Main Frame Dark Background:;string;;;(optional) &MainLinkColor=Main Links Color:;string;;;(optional) &CustomMainStyle=Custom Main Frame styles chunk:;string;;;chunk name  &LoginBgColor= Login Page Background color:;string;#499bea;;overwrite both dark and light backgrounds (optional) &ShowLoginLogo=Show Login Logo:;menu;show,hide;show;;Hide EVO logo in login page &CustomLogoPath=Custom Logo path:;string;;;enter the of your company logo &animate-login=Animate Login box:;menu;yes,no;yes;;Add a soft animation to the login box &CustomLoginStyle=Custom Login styles chunk:;string;;;chunk name 
 */

/*
### ManagerColors Plugin for Evolution CMS 1.3 ###
Customize Default EVO Manager theme colors
Written By Nicola Lambathakis http://www.tattoocms.it/
Version beta 3.1.1
Events: OnManagerLoginFormPrerender,OnManagerTopFrameHeaderHTMLBlock,OnManagerTopPrerender,OnManagerTreeInit

Default configuration:
&PrimaryColor=Main Theme Color:;string;#499bea;;Theme Primary Color (mandatory) &NavBgColor= Top Nav Background color:;string;;;(optional) &NavLinkColor= Top Nav link color :;string;#e5eef5;;(optional) &NavLinkHColor= Top Nav link hover color:;string;#fff;;(optional) &NavDropBgHColor= Top Nav dropdown hover bg color:;string;;;(optional) &TreeBgColor= Tree Menu Background:;string;;;(optional) &TreeDarkBgColor= Tree Menu Dark Background:;string;;;(optional) &TLinkColor=Tree Menu Links Color:;string;;;Published resources and ElementsInTree element names (optional) &CustomNavStyle=Custom Navigation and Tree styles chunk:;string;;;chunk name  &MainBgColor= Main Frame Background:;string;;;(optional) &MainBgDarkColor= Main Frame Dark Background:;string;;;(optional) &MainLinkColor=Main Links Color:;string;;;(optional) &CustomMainStyle=Custom Main Frame styles chunk:;string;;;chunk name  &LoginBgColor= Login Page Background color:;string;#499bea;;overwrite both dark and light backgrounds (optional) &ShowLoginLogo=Show Login Logo:;menu;show,hide;show;;Hide EVO logo in login page &CustomLogoPath=Custom Logo path:;string;;;enter the of your company logo &animate-login=Animate Login box:;menu;yes,no;yes;;Add a soft animation to the login box &CustomLoginStyle=Custom Login styles chunk:;string;;;chunk name 

*/


// Run the main code
include($modx->config['base_path'].'assets/plugins/managercolors/mancolors.php');
