<?php
include('../../../inc/includes.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once(GLPI_ROOT . '/vendor/autoload.php');

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

if (isset($_POST['generate'])) {
    $id = $_POST['report_id'];
    $report = $DB->request('glpi_plugin_iopsreport_settings', ['id' => $id])->next();

    if ($report) {
        $result = $DB->query($report['report_query']);
        $filename = "report_" . date('Ymd_His') . ".xlsx";

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        if ($row = $result->fetch_assoc()) {
            $col = 1;
            foreach (array_keys($row) as $key) {
                $sheet->setCellValueByColumnAndRow($col++, 1, $key);
            }

            $rowIndex = 2;
            do {
                $col = 1;
                foreach ($row as $value) {
                    $sheet->setCellValueByColumnAndRow($col++, $rowIndex, $value);
                }
                $rowIndex++;
            } while ($row = $result->fetch_assoc());
        }

        $writer = new Xlsx($spreadsheet);
        $path = GLPI_PLUGIN_DOC_DIR . "/iopsreport/$filename";
        Toolbox::createDirectory(dirname($path));
        $writer->save($path);

        $DB->insert('glpi_plugin_iopsreport_generate', [
            'myreport_settings_id' => $id,
            'file_name' => $filename
        ]);

        echo "<p>Report generated: <a href='" . $CFG_GLPI["root_doc"] . "/files/_plugins/iopsreport/$filename'>$filename</a></p>";
    }
}
