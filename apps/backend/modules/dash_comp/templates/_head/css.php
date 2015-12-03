<?php
    $themeCss = [

        "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css",
        "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css",
        "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css",
        "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/uniform/css/uniform.default.min.css",
        "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/select2/select2.css",
        //"/resources_core/backend_core/mnc/css/theme/login-soft.css",
        "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/css/components-rounded.css",
        "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/css/plugins.css",
        "/resources_core/backend_core/mnc/v4.1.0/theme/assets/admin/layout4/css/layout.css",
//        "/resources_core/backend_core/mnc/css/theme/default.css"
        "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css",
        "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css",
        "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/jquery-ui/jquery-ui.min.css",
        "/resources_core/backend_core/mnc/v4.1.0/theme/assets/admin/layout4/css/themes/light.css",
        "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/jquery-multi-select/css/multi-select.css",
//        "/resources/backend/css/backend.css",
        "/mgI18nPlugin/css/redmond-jquery-ui.css",
        "/resources/backend_726/css/backend.css"
    ];
?>

<?php foreach($themeCss as $css):?>
    <link href="<?php echo $css; ?>" rel="stylesheet" type="text/css"/>
<?php endforeach;?>
