<?php

global $DB, $PAGE, $OUTPUT, $USER, $CFG;
require_once('../../config.php');
require_once($CFG->libdir . '/adminlib.php');

$PAGE->set_url('/local/quickstats/index.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('admin');

if (!get_config('local_quickstats', 'enable')) {
    throw new moodle_exception('pluginnotfound', 'local_quickstats');
}

$period = get_config('local_quickstats', 'period');

$result = $DB->get_records('local_quickstats', [], 'timecreated DESC', '*');

$activeusercount = 0;

if ($result) {
    $todaystat = array_shift($result);
    $activeusercount = $todaystat->activeuserscount;

    $datajs = [];
    foreach ($result as $stat) {
        $datajs[] = [
            'year' => date("d.m.y", $stat->timecreated),
            'count' => (int)$stat->activeuserscount,
        ];
    }
}

echo $OUTPUT->header();

echo "<h2>Active Users in the Last $period Days</h2>";
echo "<p>Active users: $activeusercount</p>";

echo '<div style="width: 800px;"><canvas id="chart"></canvas></div>';

$PAGE->requires->js_call_amd('local_quickstats/chart', 'init', [json_encode($datajs)]);
echo $OUTPUT->footer();
