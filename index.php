<?php

// index.php

global $DB;
require_once('../../config.php');
//require_once('lib.php');
require_once($CFG->libdir.'/adminlib.php');

$PAGE->set_url('/local/quickstats/index.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('admin');

if (!get_config('local_quickstats', 'enable')) {
    throw new moodle_exception('pluginnotfound', 'local_quickstats');
}

$period = get_config('local_quickstats', 'period');

$result = $DB->get_records('local_quickstats', [], 'timecreated DESC', '*', 0, 1);

$activeusercount = 0;

if ($result) {
    $result = reset($result);
    $activeusercount = $result->activeuserscount;
}


echo $OUTPUT->header();

echo "<h2>Active Users in the Last $period Days</h2>";
echo "<p>Active users: $activeusercount</p>";

// Render chart
echo '<div id="chart"></div>';
echo $OUTPUT->footer();
