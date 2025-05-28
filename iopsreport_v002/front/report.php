<?php
include('../../../inc/includes.php');

// ✅ Required to show inside GLPI layout
Html::header(
   __('IT Custom Report', 'iopsreport'), 
   $_SERVER['PHP_SELF'], 
   'tools', 
   'iopsreport'
);

// === Your page content ===
echo "<h2>IT Custom Report</h2>";

$reports = $DB->request('glpi_plugin_iopsreport_settings');

echo "<form method='post'>
<select name='report_id'>";
foreach ($reports as $row) {
    echo "<option value='{$row['id']}'>{$row['report_catagory']}</option>";
}
echo "</select>
<input type='submit' name='generate' value='Generate'>
</form>";

// ... your report generation code here ...

// ✅ Required footer
Html::footer();

