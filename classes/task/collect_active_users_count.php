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

        $sql = 'SELECT COUNT(*) as users_count
                  FROM mdl_user
                 WHERE lastlogin BETWEEN :period AND UNIX_TIMESTAMP();';

        $result = $DB->get_record_sql($sql, ['period' => $period]);

        $insert_sql = "INSERT INTO mdl_local_quickstats (activeuserscount, periodstart, periodend, timecreated)
                            VALUES (:activeuserscount, :periodstart, :periodend, :timecreated)";

        $insert_params = [
            'activeuserscount' => $result->users_count,
            'periodstart' => $periodstart,
            'periodend' => time(),
            'timecreated' => time(),
        ];

        $DB->execute($insert_sql, $insert_params);
    }
}