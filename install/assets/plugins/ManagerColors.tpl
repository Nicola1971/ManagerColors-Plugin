//<?php
/**
 * ManagerColors
 *
 * Customize Manager theme colors
 *
 * @author    Nicola Lambathakis http://www.tattoocms.it/
 * @category    plugin
 * @version    beta 1.0
 * @license	 http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal    @events OnManagerTopFrameHeaderHTMLBlock,OnManagerTopPrerender,OnManagerTreeInit
 * @internal    @installset base
 * @internal    @modx_category Admin
 * @internal    @properties  &PrimaryColor=main Manager Color:;string;#499bea;;Theme Primary Color (mandatory) &NavBgColor= Nav Background color:;string;;;(optional) &NavLinkColor= Nav link color :;string;#e5eef5;;(optional) &NavLinkHColor= Nav link hover color:;string;#fff;;(optional) &NavDropBgHColor= Nav dropdown hover bg color:;string;;;(optional) &TreeBgColor= Tree Frame Background:;string;;;(optional) &TLinkColor=Tree Links Color:;string;;;Published resources and ElementsInTree element names (optional) &MainBgColor= Main Frame Background:;string;;;(optional) &MainLinkColor=Main Links Color:;string;;;(optional)
 */

/*
### MODxFlatColors Plugin for MODX Evolution 1.2 ###
Customize MODxFlat Manager theme colors
Written By Nicola Lambathakis http://www.tattoocms.it/
Version beta 1.0
Events: OnManagerTopFrameHeaderHTMLBlock,OnManagerTopPrerender,OnManagerTreeInit

Default configuration:
&PrimaryColor=main Manager Color:;string;#499bea;;Theme Primary Color (mandatory) &NavBgColor= Nav Background color:;string;;;(optional) &NavLinkColor= Nav link color :;string;#e5eef5;;(optional) &NavLinkHColor= Nav link hover color:;string;#fff;;(optional) &NavDropBgHColor= Nav dropdown hover bg color:;string;;;(optional) &TreeBgColor= Tree Frame Background:;string;;;(optional) &TLinkColor=Tree Links Color:;string;;;Published resources and ElementsInTree element names (optional) &MainBgColor= Main Frame Background:;string;;;(optional) &MainLinkColor=Main Links Color:;string;;;(optional)

*/


// Run the main code
include($modx->config['base_path'].'assets/plugins/managercolors/mancolors.php');
