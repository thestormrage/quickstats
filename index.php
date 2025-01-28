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
//$activeusercount = get_active_user_count($period);
$sql = 'SELECT activeuserscount
          FROM mdl_local_quickstats
ORDER BY timecreated DESC
LIMIT 1';

$result = $DB->get_record_sql($sql);

$activeusercount = $result->activeuserscount;

echo $OUTPUT->header();

echo "<h2>Active Users in the Last $period Days</h2>";
echo "<p>Active users: $activeusercount</p>";

// Render chart
echo '<div id="chart"></div>';
echo $OUTPUT->footer();
