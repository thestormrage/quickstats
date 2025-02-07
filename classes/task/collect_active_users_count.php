<?php

namespace local_quickstats\task;

use coding_exception;

class collect_active_users_count extends \core\task\scheduled_task
{
    /**
     * Return the task's name as shown in admin screens.
     *
     * @return string
     * @throws coding_exception
     */
    public function get_name(): string {
        return get_string('collect_active_users_count', 'local_quickstats');
    }

    /**
     * Execute the task.
     */
    public function execute(): void {
        global $DB;

        $period = get_config('local_quickstats', 'period');
        $periodstart = strtotime("-$period days");
        $currenttime = time();

        $result = $DB->count_records_select(
            'user',
            'lastlogin BETWEEN :period AND :currenttime',
            ['period' => $periodstart, 'currenttime' => $currenttime]
        );

        $record = new \stdClass();
        $record->activeuserscount = $result;
        $record->periodstart = $periodstart;
        $record->periodend = time();
        $record->timecreated = time();

        $DB->insert_record('local_quickstats',$record);
    }
}