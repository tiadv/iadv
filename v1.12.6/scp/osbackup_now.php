<?php

    require_once('../main.inc.php');
    require_once('../include/plugins/osBackupLite/class.backups.php');

    osBackup::osbackup_log("Performing manual backup...");
    osBackup::backup_go(true,true,osBackup::get_default('sm_local_path'),'*');

?>
