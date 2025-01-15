//<?php
/**
 * ManagerColors
 *
 * Customize Evolution CMS Default Manager theme colors
 *
 * @author    Nicola Lambathakis http://www.tattoocms.it/
 * @category    plugin
 * @version    4.0.1
 * @license	 http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal    @events OnManagerLoginFormPrerender,OnManagerMainFrameHeaderHTMLBlock,OnManagerTopPrerender
 * @internal    @installset base
 * @internal    @modx_category Admin
 * @internal    @properties  &plgVisibility=Run for:;menu;All,AdminOnly,AdminExcluded,ThisRoleOnly,ThisUserOnly;All &ThisRole=Run only for this role:;string;;;(role id) &ThisUser=Run only for this user:;string;;;(username) &ShowNavLogo=EVO Navbar Logo:;menu;default,hide,blacktext,whitetext,smallblack,smallwhite,customwide,customsquare;whitetext;;Choose type or Hide EVO Navbar logo &CustomLogoPath=Custom Logo path:;string;;;Url of custom logo (ie: ../assets/images/customlogo.png) wide 360x55px or square ie 300x300 &PrimaryColor=Main Theme Color:;string;#0e80cb;;Theme Primary Color (mandatory) &NavBgColor= Top Menu Background color:;string;;;(optional) &NavLinkColor= Top Menu link color :;string;#e5eef5;;(optional) &NavLinkHColor= Top Menu link hover color:;string;#fff;;(optional) &NavLinkLActColor= Top Menu Dropdown Active color:;string;#222;;(optional) &NavDropBgHColor= Top Menu dropdown item hover bg color:;string;#5cb85c;;(optional) &TreeButtC=Tree Buttons Color:;string;#5cb85c;;Tree navbar buttons color (optional) &ElTreeButtC=Elements in Tree Buttons Color:;string;#0e80cb;;Elements in Tree Plugin buttons color (optional) &TLinkColor=Tree Menu Links Color:;string;;;Published resources color (optional) &TDarkLinkColor=Dark Tree Menu Links Color:;string;;;Dark tree Published resources color (optional) &buttonsColor=Colored action buttons:;menu;yes,no;yes;;Add background color to duplicate delete and cancel buttons &MainLinkColor=Main Links Color:;string;;;(optional) &ShowLoginLogo=Show Login Logo:;menu;show,hide;show;;Hide EVO logo in login page &LoginBgColor= Login Page Background color:;string;;;Flat color login backgroung &CustomNavStyle=Custom Navigation and Tree styles chunk:;string;;;chunk name &CustomMainStyle=Custom Main Frame styles chunk:;string;;;chunk name  &CustomLoginStyle=Custom Login styles chunk:;string;;;chunk name 
 */

// Run the main code
include($modx->config['base_path'].'assets/plugins/managercolors/mancolors.php');