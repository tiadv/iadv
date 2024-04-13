<?php

    require_once('../main.inc.php');
    require_once('../include/plugins/osBackupLite/class.backups.php');

    echo osBackup::get_default('is_running','plugin.'.osBackup::get_plugin_id());

?>
