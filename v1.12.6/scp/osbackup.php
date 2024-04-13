<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script>

    $(document).ready(function(){

    $('#database-checkbox').change(function() {
        if ($('#database-checkbox').is(":checked")){
                $('#select_tables').css('display','block');
            }else{
                $('#select_tables').css('display','none');
            }
  });

    $.fn.checkIsRun = function(){ 
            var isrun = true;
            $.ajax({
                url: 'osbackup_isrun.php',
                type: 'post',
                data: {isrun:isrun},
                success:function(response){
                    if(response==1) {
                        $("#backup_now_button").prop('disabled', true);
                        $("#backup_now_button").prop('value', 'In progress, please wait...');
                    }else if(response==0){
                        $("#backup_now_button").prop('disabled', false);
                        $("#backup_now_button").prop('value', 'Perform full backup now');
                    }

                },
                error:function(textStatus, errorThrown) {
                    Success = false;
                }
            });
    }

    // Initial page load check
    $.fn.checkIsRun();
    
    // Check every 5 seconds for an update
    window.setInterval(function(){
            $.fn.checkIsRun();
        }, 5000);

    });


      $(function () {

        $("form[name='backupForm_now']").on('submit', function (e) {

          // Immediately disable and change text on button, don't wait for osbackup_now.php and first loop
          $("#backup_now_button").prop('disabled', true);
          $("#backup_now_button").prop('value', 'In progress, please wait...');
          e.preventDefault();
          alert('Beginning manual backup, you can continue working on any page and an alert will inform you when the backup is complete');
    
          $.ajax({
            type: 'post',
            url: 'osbackup_now.php',
            success: function () {
               alert('Manual backup completed');
            },
            error: function(){
              alert('Failed to complete manual backup - please check backups.log and PHP/Webserver logs for details');
            }
          });

        });

      });
    </script>
<?php
// SCP
require 'admin.inc.php';
$nav->setTabActive('apps');

// Opening header
require STAFFINC_DIR.'header.inc.php';
require '../include/plugins/osBackupLite/include/form.inc.php';
require STAFFINC_DIR.'footer.inc.php';
