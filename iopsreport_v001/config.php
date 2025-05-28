<?php
include('../../../inc/includes.php');

echo "<h2>Report Settings</h2>";

if (isset($_POST['add'])) {
    $DB->insert('glpi_plugin_iopsreport_settings', [
        'report_catagory' => $_POST['report_catagory'],
        'report_query' => $_POST['report_query']
    ]);
}

if (isset($_GET['delete'])) {
    $DB->delete('glpi_plugin_iopsreport_settings', ['id' => $_GET['delete']]);
}

$settings = $DB->request('glpi_plugin_iopsreport_settings');

echo "<form method='post'>
    <input type='text' name='report_catagory' placeholder='Category' required>
    <input type='text' name='report_query' placeholder='SQL Query' required>
    <input type='submit' name='add' value='Add'>
</form>";

echo "<table class='tab_cadre'>";
echo "<tr><th>ID</th><th>Category</th><th>Query</th><th>Date</th><th>Action</th></tr>";
foreach ($settings as $row) {
    echo "<tr><td>{$row['id']}</td><td>{$row['report_catagory']}</td><td>{$row['report_query']}</td><td>{$row['create_date']}</td>
        <td><a href='?delete={$row['id']}'>Delete</a></td></tr>";
}
echo "</table>";
