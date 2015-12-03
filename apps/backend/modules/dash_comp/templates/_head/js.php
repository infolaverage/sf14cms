<?php
    $themeJs = array();

    if($sf_user->isAuthenticated())
    {
        $themeJs = [
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/jquery.min.js",
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/jquery.blockui.min.js",
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/jquery.cokie.min.js",
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js",
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/jquery.sparkline.min.js",
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/uniform/jquery.uniform.min.js",
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/jquery-migrate.min.js",
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/jquery-ui/jquery-ui.min.js",
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js",
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js",
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js",
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js",
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/jquery.pulsate.min.js",
//            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/morris/morris.min.js",
//            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/morris/raphael-min.js",
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/admin/layout4/scripts/quick-sidebar.js",
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/select2/select2.min.js",
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/admin/layout4/scripts/demo.js",
//            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/admin/pages/scripts/index3.js",
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/scripts/metronic.js",
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/admin/layout4/scripts/layout.js",
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/admin/pages/scripts/tasks.js",
            "/resources_core/backend_core/mnc/v4.1.0/theme/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js",
//            "/resources_core/backend_core/plugins/amcharts/amcharts/amcharts.js",
//            "/resources_core/backend_core/plugins/amcharts/amcharts/themes/light.js",
//            "/resources_core/backend_core/plugins/amcharts/amcharts/serial.js",
//            "/resources/backend/js/jsonTabelize.js",
            "/mgI18nPlugin/js/gui.js",

            "/resources_core/backend_core/plugins_153sfhAbx/ckeditor4112a/ckeditor.js",

            "/resources/backend_726/js/backend.js",

        ];
    }
?>

<?php foreach($themeJs as $js):?>
    <script src="<?php echo $js; ?>" type="text/javascript"></script>
<?php endforeach;?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        //Metronic.setAssetsPath('/resources_core/backend_core/mnc/');
        //Metronic.setGlobalImgPath('images/metronic/');
        //Metronic.setGlobalPluginsPath('js/plugins/');
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
//        Demo.init(); // init demo features
        QuickSidebar.init(); // init quick sidebar
//        Index.init(); // init index page
//        Tasks.initDashboardWidget(); // init tash dashboard widget
//        $('.js-tabelize').each(function() {
//            initDynamicJsonField($(this)); //init json editor
//        });
    });
</script>