<?php
/**
 * ManagerColors plugin 
 * Customize Evolution CMS Default Manager theme colors
 * version    4.1.2
 * Events: OnManagerLoginFormPrerender,OnManagerMainFrameHeaderHTMLBlock,OnManagerTopPrerender
 */

if (!defined('MODX_BASE_PATH')) { die('What are you doing? Get out of here!'); }

if (!class_exists('ManagerColors')) {
class ManagerColors {
    private $modx;
    private $config;
    private $modules;
    
    public function __construct($modx) {
        $this->modx = $modx;
        $this->initModules();
        $this->loadConfig();
    }
    
    private function initModules() {
        // Debug per vedere quali parametri sono disponibili
        error_log('Available params: ' . print_r($this->modx->event->params, true));
        
        // Inizializza lo stato dei moduli (default: tutti attivi per retrocompatibilità)
        $this->modules = [
            'navbar' => $this->getParamValue('mc_enable_navbar_styles', 'yes') === 'yes',
            'tree' => $this->getParamValue('mc_enable_tree_styles', 'yes') === 'yes',
            'mainframe' => $this->getParamValue('mc_enable_main_styles', 'yes') === 'yes',
            'login' => $this->getParamValue('mc_enable_login_styles', 'yes') === 'yes'
        ];
        
        error_log('ManagerColors Modules State: ' . print_r($this->modules, true));
    }
    private function hexToRgb($hex) {
    // Rimuove il # se presente
    $hex = str_replace('#', '', $hex);
    
    // Converte in RGB
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    
    return $r.', '.$g.', '.$b;
    }
    private function getParamValue($key, $default = '') {
        return isset($this->modx->event->params[$key]) ? $this->modx->event->params[$key] : $default;
    }
    
    private function getBooleanValue($value, $default = false) {
        if ($value === null) return $default;
        if (is_bool($value)) return $value;
        if (is_string($value)) {
            return strtolower($value) === 'true' || $value === '1';
        }
        return (bool)$value;
    }
    
    private function loadConfig() {
    // Colore base principale
    $primaryColor = $this->getParamValue('PrimaryColor', '#0e80cb');

    $loginBoxBgColor = $this->modules['login'] ? $this->getParamValue('LoginBoxBgColor', '#FFFFFF') : '';
    $loginBoxBgColorRGBA = !empty($loginBoxBgColor) ? $this->hexToRgb($loginBoxBgColor) : '';

    $this->config = [
        // Colore base
        'PrimaryColor' => $primaryColor,
        
        // Colori navbar (caricati solo se il modulo è attivo)
        'NavBgColor' => $this->modules['navbar'] ? $this->getParamValue('NavBgColor', '') : '',
        'NavLinkColor' => $this->modules['navbar'] ? $this->getParamValue('NavLinkColor', '') : '',
        'NavLinkHColor' => $this->modules['navbar'] ? $this->getParamValue('NavLinkHColor', '') : '',
        'NavDropBgHColor' => $this->modules['navbar'] ? $this->getParamValue('NavDropBgHColor', $primaryColor) : '',
        'NavLinkLActColor' => $this->modules['navbar'] ? $this->getParamValue('NavLinkLActColor', '') : '',
        
        // Colori tree (caricati solo se il modulo è attivo con PrimaryColor come default)
        'TreeButtC' => $this->modules['tree'] ? $this->getParamValue('TreeButtC', $primaryColor) : '',
        'TreeLinksColor' => $this->modules['tree'] ? $this->getParamValue('TreeLinksColor', '') : '',
        'TLinkColor' => $this->modules['tree'] ? $this->getParamValue('TLinkColor', $primaryColor) : '',
        'TDarkLinkColor' => $this->modules['tree'] ? $this->getParamValue('TDarkLinkColor', '') : '',
        'ElTreeButtC' => $this->modules['tree'] ? $this->getParamValue('ElTreeButtC', $primaryColor) : '',
        
        // Colori Bottoni Welcome Page
        'WelcomeButtonsColor' => $this->modules['mainframe'] ? $this->getParamValue('WelcomeButtonsColor', '') : '',
        'WelcomeButtonsHColor' => $this->modules['mainframe'] ? $this->getParamValue('WelcomeButtonsHColor', '') : '',
        
        // Colori main frame (caricati solo se il modulo è attivo)
        'PrimaryButtonsColor' => $this->modules['mainframe'] ? $this->getParamValue('PrimaryButtonsColor', $primaryColor) : '',
        'PrimaryButtonsHColor' => $this->modules['mainframe'] ? $this->getParamValue('PrimaryButtonsHColor', '') : '',
        'MainLinkColor' => $this->modules['mainframe'] ? $this->getParamValue('MainLinkColor', '') : '',
        
        // Colori login (caricati solo se il modulo è attivo)
        'LoginBgColor' => $this->modules['login'] ? $this->getParamValue('LoginBgColor', '') : '',
        'LoginBoxBgColor' => $this->modules['login'] ? $this->getParamValue('LoginBoxBgColor', '#FFFFFF') : '',
        'LoginBoxOpacity' => $this->modules['login'] ? $this->getParamValue('LoginBoxOpacity', '0.5') : '',
        'LoginBoxTxtColor' => $this->modules['login'] ? $this->getParamValue('LoginBoxTxtColor', '') : '',
        'LoginBoxBgColorRGBA' => $loginBoxBgColorRGBA,
        
        // Features sempre disponibili
        'ShowLoginLogo' => $this->getParamValue('ShowLoginLogo', 'default'),
        'ShowNavLogo' => $this->getParamValue('ShowNavLogo', 'default'),
        'CustomLogoPath' => $this->getParamValue('CustomLogoPath', ''),
        'buttonsColor' => $this->getParamValue('buttonsColor', 'no'),
        
        // Custom styles chunks
        'CustomLoginStyle' => $this->getParamValue('CustomLoginStyle', ''),
        'CustomNavStyle' => $this->getParamValue('CustomNavStyle', ''),
        'CustomMainStyle' => $this->getParamValue('CustomMainStyle', '')
    ];
}
    
    public function handleLogin() {
    $output = '';
    
    // Login background (solo se gli stili login sono abilitati)
    if ($this->modules['login']) {
        if (!empty($this->config['LoginBgColor'])) {
            $output .= '
            /* Login Background */
            body {
                background-color: '.$this->config['LoginBgColor'].';
            }
            body div.page {
                background-color: '.$this->config['LoginBgColor'].';
            }';
        }
        
        if (!empty($this->config['LoginBoxBgColor'])) {
            $output .= '
            /* Login Box */
            .loginbox {
                color: '.$this->config['LoginBoxTxtColor'].'!important;
                background-color: rgba('.$this->config['LoginBoxBgColorRGBA'].', '.$this->config['LoginBoxOpacity'].')!important;
            }
            
            .loginbox.loginbox-dark label.text-muted, .loginbox.loginbox-dark label#FMP-email_label,
            .loginbox.loginbox-light label.text-muted, .loginbox.loginbox-light label#FMP-email_label, .loginbox.loginbox-light input#username,
            a#ForgotManagerPassword-show_form  { 
                color: '.$this->config['LoginBoxTxtColor'].'!important;
            }';
        }

        // Logo control (sempre disponibile)
        if ($this->config['ShowLoginLogo'] == 'hide') {
            $output .= '
            /* Hide Login Logo */
            img#logo {
                display: none;
            }';
        }
    }
    
    return $this->wrapStyles($output, 'LoginFormPrerender');
}
    public function handleNavbar() {
        $output = '';
        
        // Debug info
        $output .= '
        /* Debug values */
        /* Module States - Navbar: '.($this->modules['navbar'] ? 'enabled' : 'disabled').' */
        /* Module States - Tree: '.($this->modules['tree'] ? 'enabled' : 'disabled').' */
        /* PrimaryColor: '.$this->config['PrimaryColor'].' */
        /* NavBgColor: '.$this->config['NavBgColor'].' */';
        
        if ($this->modules['navbar']) {
            $mainMenuColor = $this->getNavbarBackgroundColor();
            $output .= $this->generateNavbarStyles($mainMenuColor);
        }
        
        // Logo styles (sempre disponibili)
        $logoStyle = $this->getLogoStyle();
        if ($logoStyle) {
            $output .= $logoStyle;
        }
        
        if ($this->modules['tree']) {
            $output .= $this->generateTreeStyles();
        }
        
        return $this->wrapStyles($output, 'TopPrerender');
    }
    
        private function generateNavbarStyles($mainMenuColor) {
        return '
        /* Main Navbar Styles */
        #mainMenu [data-evocp="bgmColor"] { 
            background-color: '.$mainMenuColor.'; 
            color: '.$this->config['NavLinkColor'].';
        }

        /* Navbar Links */
        .lightness #mainMenu [data-evocp="bgmColor"] .nav > li > a, 
        #mainMenu [data-evocp="bgmColor"] .nav > li > a, 
        #mainMenu .nav .label_searchid { 
            color: '.$this->config['NavLinkColor'].'!important; 
        }

        /* Hover States */
        #mainMenu [data-evocp="bgmColor"] .nav > li > a:hover, 
        #mainMenu .nav .label_searchid:hover { 
            color: '.$this->config['NavLinkHColor'].'!important; 
        }

        /* Dropdown and Active States */
        .dark #mainMenu.show [data-evocp="bgmColor"] .nav > li.dropdown.hover > a, 
        .light #mainMenu.show [data-evocp="bgmColor"] .nav > li.dropdown.hover > a, 
        .lightness #mainMenu.show [data-evocp="bgmColor"] .nav > li.dropdown.hover > a { 
            color: '.$this->config['NavLinkLActColor'].'!important;
        }

        .lightness #mainMenu.show [data-evocp="bgmColor"] .nav > li.dropdown.hover > a { 
            background-color: #FFF!important;
        }

        /* Active State */
        .lightness #mainMenu [data-evocp="bgmColor"] .nav > li.active > a {
            background: rgba(255, 255, 255, 0.07);
        }

        /* Dropdown Menu */
        #mainMenu [data-evocp="bgmColor"] .nav > li.dropdown.hover > ul {
            background-color: #fff;
            box-shadow: 0 3px 5px rgba(0,0,0,0.2);
        }
        #mainMenu [data-evocp="bgmColor"] .nav > li > ul > li > a {
            color: #333!important;
        }

        /* Darkness Theme Dropdown Menu */
        .darkness #mainMenu [data-evocp="bgmColor"] .nav > li.dropdown.hover > ul {
            background-color: #343942;
            box-shadow: 0 3px 5px rgba(0,0,0,0.5);
        }
        .darkness #mainMenu [data-evocp="bgmColor"] .nav > li > ul > li > a {
            color: #c2c2c2!important;
        }

        /* Hover Effects for both themes */
        #mainMenu [data-evocp="bgmColor"] .nav > li > ul > li.hover > a { 
            color: #fff!important; 
            background-color: '.$this->config['NavDropBgHColor'].'!important; 
        }

        /* Search Input */
        #mainMenu [data-evocp="bgmColor"] #searchform input:focus { 
            color: '.$this->config['NavLinkColor'].';
            border-color: rgba(255,255,255,0.4);
        }';
    }
    
    private function generateTreeStyles() {
        $output = '
        /* Tree Styles */
        .treeButton i, .treeButtonDisabled i, #mx_contextmenu .menuLink i,
        div#treeHolder a i:hover, .treeButton i:hover, .treeButtonDisabled i:hover { 
            color: '.$this->config['TreeButtC'].'!important;
        }';

        // Aggiungiamo gli stili per ElTreeButtC
        if (!empty($this->config['ElTreeButtC'])) {
            $output .= '
            .treeframebody .tab-row h2.tab span i {
                color: '.$this->config['ElTreeButtC'].'!important;
            }';
        }

        $output .= '
        /* Tree Menu Links */
        .treeframebody .tab-pane input.form-control, 
        #treeRoot a:not(.deleted):not(.unpublished):not(.hidemenu) .title {
            color: '.$this->config['TLinkColor'].'!important;
        }';

        // Dark mode styles
        if (!empty($this->config['TDarkLinkColor'])) {
            $output .= '
            /* Dark Mode */
            .dark #treeMenu .treeButton, 
            .dark .treeframebody .tab-pane input.form-control, 
            .dark #treeRoot a:not(.deleted):not(.unpublished):not(.hidemenu) .title,
            .darkness #treeMenu .treeButton, 
            .darkness .treeframebody .tab-pane input.form-control, 
            .darkness #treeRoot a:not(.deleted):not(.unpublished):not(.hidemenu) .title {
                color: '.$this->config['TDarkLinkColor'].'!important;
            }';
        }

        $output .= '
        /* Context Menu */
        #mx_contextmenu #nameHolder, 
        #mx_contextmenu a i, 
        #mx_contextmenu .menuLink:hover i, 
        #mx_contextmenu .menuLink:hover {
            background: '.$this->config['PrimaryColor'].';
            color: #FFF!important;
        }';
        
        return $output;
    }
    
    private function getNavbarBackgroundColor() {
        return (empty($this->config['NavBgColor']) || $this->config['NavBgColor'] === '') ? 
               $this->config['PrimaryColor'] : 
               $this->config['NavBgColor'];
    }
    
    private function getLogoStyle() {
    switch($this->config['ShowNavLogo']) {
        case 'hide':
            return 'body #mainMenu [data-evocp="bgmColor"] #nav #site::before, 
                   #mainMenu #nav #site::before {display:none;} 
                   @media (min-width: 1200px) { 
                       #mainMenu #nav #site a {margin-left:0;} 
                   }';
        case 'blacktext':
            return 'body #mainMenu [data-evocp="bgmColor"] #nav #site::before, 
                   #mainMenu #nav #site::before, 
                   body.lightness #mainMenu #nav #site::before {
                       background: url("media/style/default/images/misc/logo-navbar.png") 0 50% no-repeat; 
                       background-size: 8rem;
                   }';
        case 'whitetext':
            return 'body #mainMenu [data-evocp="bgmColor"] #nav #site::before, 
                   #mainMenu #nav #site::before, 
                   body.lightness #mainMenu #nav #site::before {
                       background: url("media/style/default/images/misc/logo-navbar-white.png") 0 50% no-repeat; 
                       background-size: 8rem;
                   }';
        case 'smallblack':
            return 'body #mainMenu [data-evocp="bgmColor"] #nav #site::before, 
                   #mainMenu #nav #site::before, 
                   body.lightness #mainMenu #nav #site::before {
                       left: 0; 
                       top: 0.25rem; 
                       width: 100%; 
                       height: 2.0rem; 
                       background: url("media/style/default/images/misc/logo-navbar-left.png") no-repeat 0 50%; 
                       background-size: 2.0rem;
                   }
                   @media (min-width: 1200px) { 
                       #mainMenu #nav #site a {
                           margin-left: 3.0rem;
                       } 
                   }';
        case 'smallwhite':
            return 'body #mainMenu [data-evocp="bgmColor"] #nav #site::before, 
                   #mainMenu #nav #site::before, 
                   body.lightness #mainMenu #nav #site::before {
                       left: 0; 
                       top: 0.25rem; 
                       width: 100%; 
                       height: 2.0rem; 
                       background: url("media/style/default/images/misc/logo-navbar-left-white.png") no-repeat 0 50%; 
                       background-size: 2.0rem;
                   }
                   @media (min-width: 1200px) { 
                       #mainMenu #nav #site a {
                           margin-left: 3.0rem;
                       } 
                   }';
        case 'customwide':
        if (!empty($this->config['CustomLogoPath'])) {
            return 'body #mainMenu [data-evocp="bgmColor"] #nav #site::before, 
                   #mainMenu #nav #site::before, 
                   body.lightness #mainMenu #nav #site::before {
                       background: url("'.$this->config['CustomLogoPath'].'") 0 50% no-repeat; 
                       background-size: 8rem;
                   }
                   @media (min-width: 1200px) { 
                       #mainMenu #nav #site a {
                           margin-left: 8.5rem;
                       } 
                   }';
        }

        case 'customsquare':
            if (!empty($this->config['CustomLogoPath'])) {
                $size = $this->config['ShowNavLogo'] === 'customwide' ? '8rem' : '2.0rem';
                $marginLeft = $this->config['ShowNavLogo'] === 'customsquare' ? '3.0rem' : '0';
                return 'body #mainMenu [data-evocp="bgmColor"] #nav #site::before, 
                       #mainMenu #nav #site::before, 
                       body.lightness #mainMenu #nav #site::before {
                           background: url("'.$this->config['CustomLogoPath'].'") 0 50% no-repeat; 
                           background-size: '.$size.';
                       }
                       @media (min-width: 1200px) { 
                           #mainMenu #nav #site a {margin-left:'.$marginLeft.';} 
                       }';
            }
            break;
    }
    return '';
}

    private function wrapStyles($styles, $section) {
    // Determina quale chunk usare in base alla sezione
    $customStyles = '';
    switch($section) {
        case 'LoginFormPrerender':
            if (!empty($this->config['CustomLoginStyle'])) {
                $customStyles = $this->modx->getChunk($this->config['CustomLoginStyle']);
            }
            break;
        case 'TopPrerender':
            if (!empty($this->config['CustomNavStyle'])) {
                $customStyles = $this->modx->getChunk($this->config['CustomNavStyle']);
            }
            break;
        case 'MainFrameHeaderHTMLBlock':
            if (!empty($this->config['CustomMainStyle'])) {
                $customStyles = $this->modx->getChunk($this->config['CustomMainStyle']);
            }
            break;
    }

    return '
    <!-----managercolor '.$section.'--!>
    <style>
    '.$styles.'
    '.$customStyles.'
    </style>
    <!-----end managercolor--!>
    ';
}

    public function handleMainFrame() {
    $output = '';
    
    // Colored buttons (sempre disponibili)
    if ($this->config['buttonsColor'] === 'yes') {
        $output .= $this->generateColoredButtonsStyle();
    }
    
    // Main frame styles
    if ($this->modules['mainframe']) {
        if (!empty($this->config['MainLinkColor'])) {
            $output .= '
            .elements_description :not(.disabledPlugin) a.man_el_name, 
            .container-body .card a, 
            td a {
                color: '.$this->config['MainLinkColor'].';
            }';
        }
        
        $output .= '
        /* Welcome Dashboard */
        .card .wm_buttons .wm_button a i { 
        color: '.$this->config['WelcomeButtonsColor'].'!important; 
        }
        .card .wm_buttons .wm_button a:hover i {
        color: '.$this->config['WelcomeButtonsHColor'].'!important; 
        }
        /* Buttons and inputs */
        input[type="button"], input[type="submit"] {
            border-color: '.$this->config['PrimaryColor'].';
        }
        button.btn-primary, a.btn-primary, .darkness button.btn-primary, .darkness a.btn-primary {
            background: '.$this->config['PrimaryButtonsColor'].';
            border-color: '.$this->config['PrimaryButtonsColor'].'; 
            color: #FFF!important;
        }
        button.btn-primary:hover, a.btn-primary:hover, .darkness button.btn-primary:hover, .darkness a.btn-primary:hover {
            background: '.$this->config['PrimaryButtonsHColor'].';
            border-color: '.$this->config['PrimaryButtonsHColor'].'; 
            color: #FFF!important;
        }
        
        /* Tabs */
        .dynamic-tab-pane-control.tab-pane .tab-row h2.tab.selected.hover,
        .dynamic-tab-pane-control.tab-pane .tab-row .tab.selected,
        .dynamic-tab-pane-control.tab-pane .tab-row .tab.selected.hover,
        .dynamic-tab-pane-control .tab-row .tab.selected,
        .dynamic-tab-pane-control .tab-row .tab.selected.hover {
            color: '.$this->config['PrimaryColor'].'!important;
        }
        
        /* Resource tree */
        .resourceTable ul.elements > li:hover { 
            border-left-color: '.$this->config['PrimaryColor'].'!important; 
        }
        
        /* Icons and other elements */
        ul li span a:not(.man_el_name), 
        span.pagetitle-icon, 
        h1 .fa {
            color: '.$this->config['PrimaryColor'].'!important;
        }
        
        /* Work Manager buttons */
        .wm_buttons a { 
            color: #576B75 !important;
        }';
    }
    
    return $this->wrapStyles($output, 'MainFrameHeaderHTMLBlock');
}

    private function generateColoredButtonsStyle() {
        return '
        /* Colored Buttons */
        /* duplicate button */ 
        #actions a#Button6.btn.btn-secondary {
            color: #FFF!important;
            border-color: #337ab7;
            background: #337ab7;
        }
        #actions a#Button6.btn.btn-secondary:hover {
            color: #fff;
            border-color: #285e8d;
            background: #285e8d;
        }
        
        /* delete button */ 
        #actions a#Button3.btn.btn-secondary {
            color: #FFF!important;
            border-color: #e77755;
            background-color: #e77755;
        }
        #actions a#Button3.btn.btn-secondary:hover {
            color: #fff;
            border-color: #bc3423;
            background: #bc3423;
        }
        
        /* cancel button */ 
        #actions a#Button5.btn.btn-secondary {
            color: #FFF!important;
            border-color: #f0ad4e;
            background: #f0ad4e!important;
        }
        #actions a#Button5.btn.btn-secondary:hover {
            color: #FFF;
            border-color: #e18a13;
            background: #e18a13!important;
        }';
    }
}
}
// Plugin execution
$e = &$modx->Event;

if ($modx->config['manager_theme'] == "default") {
    $managerColors = new ManagerColors($modx);
    $output = "";

    switch($e->name) {
        case 'OnManagerLoginFormPrerender':
            $output = $managerColors->handleLogin();
            break;
            
        case 'OnManagerTopPrerender':
            $output = $managerColors->handleNavbar();
            break;
            
        case 'OnManagerMainFrameHeaderHTMLBlock':
            $output = $managerColors->handleMainFrame();
            break;
    }
    
    if ($output) {
        $e->output($output);
    }
}
?>