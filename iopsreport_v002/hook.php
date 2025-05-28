<?php

function plugin_iopsreport_install() {
    global $DB;

    $DB->query("CREATE TABLE IF NOT EXISTS glpi_plugin_iopsreport_settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        report_catagory VARCHAR(255) NOT NULL,
        report_query TEXT NOT NULL,
        create_date DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB");

    $DB->query("CREATE TABLE IF NOT EXISTS glpi_plugin_iopsreport_generate (
        id INT AUTO_INCREMENT PRIMARY KEY,
        myreport_settings_id INT NOT NULL,
        file_name VARCHAR(255) NOT NULL,
        generate_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (myreport_settings_id) REFERENCES glpi_plugin_iopsreport_settings(id) ON DELETE CASCADE
    ) ENGINE=InnoDB");

    return true;
}

function plugin_iopsreport_uninstall() {
    global $DB;
    $DB->query("DROP TABLE IF EXISTS glpi_plugin_iopsreport_generate");
    $DB->query("DROP TABLE IF EXISTS glpi_plugin_iopsreport_settings");
    return true;
}
