<?php

class PluginIopsreportMenu {
    static function getMenuContent() {
        return [
            'title' => __('IT Custom Report', 'iopsreport'),
	    'page'  => '/plugins/iopsreport/front/report.php',
	    'icon'  => 'fas fa-file-excel'
        ];
    }
}
