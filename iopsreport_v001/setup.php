<?php
define('PLUGIN_IOPSREPORT_VERSION', '0.0.1');
function plugin_init_iopsreport() {
    global $PLUGIN_HOOKS;

    $PLUGIN_HOOKS['csrf_compliant']['iopsreport'] = true;
    $PLUGIN_HOOKS['config_page']['iopsreport'] = 'config.php';
    $PLUGIN_HOOKS['menu_toadd']['iopsreport'] = [
        'tools' => 'PluginIopsreportMenu'
    ];
}

function plugin_version_iopsreport() {
    return [
        'name'           => 'iopsreport (IT Asset Report)',
        'version'        => PLUGIN_IOPSREPORT_VERSION,
        'author'         => 'geeLo',
        'license'        => 'GPLv3',
        'homepage'       => '',
        'minGlpiVersion' => '10.0.0'
    ];
}

function plugin_iopsreport_check_prerequisites() {
    return true;
}

function plugin_iopsreport_check_config() {
    return true;
}

if (file_exists(__DIR__ . '/inc/menu.php')) {
    require_once __DIR__ . '/inc/menu.php';
}
