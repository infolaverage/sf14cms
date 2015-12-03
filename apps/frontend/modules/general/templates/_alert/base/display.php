<?php /*
  *
  * $alert_options['type']
  * $alert_options['text']
  * "alert_options"=>array("type"=>"", "text"=>"")
  * */?>

<?php
    #$alert_base_class       = "alert alert-1 alert-dismissable animated flipInX ";
    $alert_base_class       = "alert alert-1 alert-dismissable ";
    $alert_icon_base_class  = "fa ";
    $alert_text_class       = "text";
    $alert_text             = isset($alert_options['text']) ? $alert_options['text'] : "";
    $f_type                 = isset($alert_options['type']) ? $alert_options['type'] : "default";
?>

<?php
    $f_alert_base_class = "";
    $f_alert_icon_class = "";

    if($f_type == "notice"){
        $f_alert_base_class = $alert_base_class." alert-info";
        $f_alert_icon_class = $alert_icon_base_class." fa-info-circle";
    }

    /*
    if($f_type == "notice2"){
        $f_alert_base_class = $alert_base_class." alert-notice-2";
        $f_alert_icon_class = $alert_icon_base_class." fa-info-circle";
    }
    if($f_type == "notice3"){
        $f_alert_base_class = $alert_base_class." alert-notice-3";
        $f_alert_icon_class = $alert_icon_base_class." fa-info-circle";
    }
    if($f_type == "notice4"){
        $f_alert_base_class = $alert_base_class." alert-notice-4";
        $f_alert_icon_class = $alert_icon_base_class." fa-info-circle";
    }
    */

    if($f_type == "error"){
        $f_alert_base_class = $alert_base_class." alert-danger";
        $f_alert_icon_class = $alert_icon_base_class." fa-exclamation-triangle";
    }
    if($f_type == "success"){
        $f_alert_base_class = $alert_base_class." alert-success";
        $f_alert_icon_class = $alert_icon_base_class." fa-check-circle";
    }
?>

<div class="container">
    <?php if($f_type):?>
        <div class="<?php echo $f_alert_base_class?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <div class="<?php echo $alert_text_class?>">
                <i class="<?php echo $f_alert_icon_class?>"></i>
                <?php echo $alert_text; ?>
            </div>
        </div>
    <?php endif;?>
</div>
