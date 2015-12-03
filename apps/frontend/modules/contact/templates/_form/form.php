<?php if(isset($form)):?>
    <?php include_partial("general/form/form_all", array("form" => $form, "options" => array(
        "form_action"            => SeoUrlHelper::contact(),
        "form_class"             => "form-1",
        "form_container_class"   => "form-cnr form-cnr-1 contact form-horizontal",
        "show_title"             => false,
        //"enctype"                => "multipart/form-data",
        "button_container_class" => "col-sm-offset-6 col-sm-18",
        "button_submit_class"    => "btn-1",
        "label_class"            => "col-sm-6"
    ))); ?>
<?php endif;?>