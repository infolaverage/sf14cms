<?php
    $test_mode = (0 && (!Project::getGlobalEnvironmentIs("prod")));
?>
<?php //$sf_user = Project::anyUnescape($sf_user);?>
<?php

    $alerts = array();

    if($sf_user->hasFlash('notice') || $test_mode){
        $alert_options          = array();
        $alert_options['type']  = 'notice';
        $alert_options['text']  = $sf_user->getFlash('notice',ESC_RAW) . ($test_mode?"test":"");
        $alerts[] = $alert_options;
    }

    if($sf_user->hasFlash('error') || $test_mode){
        $alert_options          = array();
        $alert_options['type']  = 'error';
        $alert_options['text']  = $sf_user->getFlash('error',ESC_RAW) . ($test_mode?"test":"");
        $alerts[]               = $alert_options;
    }

    if($sf_user->hasFlash('success') || $test_mode){
        $alert_options          = array();
        $alert_options['type']  = 'success';
        $alert_options['text']  = $sf_user->getFlash('success',ESC_RAW) . ($test_mode?"test":"");
        $alerts[]               = $alert_options;
    }

?>
<?php foreach($alerts as $alert):?>
    <?php include_partial("general/alert/base/display", array("alert_options"=>$alert));?>
<?php endforeach;?>