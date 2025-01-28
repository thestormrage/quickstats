<?php

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_quickstats', new lang_string('pluginname', 'local_quickstats'));

    $settings->add(new admin_setting_configcheckbox(
        'local_quickstats/enable',
        new lang_string('enable', 'local_quickstats'),
        new lang_string('enable_desc', 'local_quickstats'),
        1
    ));

    $settings->add(new admin_setting_configtext(
        'local_quickstats/period',
        new lang_string('period', 'local_quickstats'),
        new lang_string('period_desc', 'local_quickstats'),
        7,
        PARAM_INT
    ));

    $ADMIN->add('localplugins', $settings);
}
