<?php
    $tr_pre = "general:form:form_all";
    $default_options = array(
        "form_action"                   => "",
        "button_submit_class"           => "type-2",
        "button_cancel_class"           => "btn-default btn-xs",
        "field_container_class"         => "",
        "button_container_class"        => "col-sm-offset-6 col-sm-16",
        "form_class"                    => "",
        "form_container_class"          => "",
        "enctype"                       => false,
        "with_reset"                    => false,
        "form"                          => null,
        "submit_button_string"          => Translate::from(array(FormHelper::getTranslatePrefix($form),"button","submit")),
        "with_cancel"                   => false,
        "cancel_url"                    => url_for("@homepage"),
        "separator_between_fields"      => false,
        "help_position"                 => "after-field",
        "collapse_long_form"            => false,
        "class_of_collapsed_by_default" => false,
        "method"                        => "post",
        "form_title"                    => Translate::from(array(FormHelper::getTranslatePrefix($form),"button","title")),
        "additional_links"              => array(),
        "button_name"                   => "",
        "label_class"                   => "col-sm-8"
    );

    $f_options = $default_options;

    if(isset($options)){
        $f_options = array_merge($default_options, $sf_data->getRaw('options'));
    }
    //Project::prePrint($f_options);
?>

<?php if($form): ?>
    <div class="<?php echo $f_options['form_container_class']; ?>">
        <form
            method="<?php echo $f_options["method"]; ?>"
            role="form"
            action="<?php echo $f_options['form_action']; ?>"
            class="<?php echo $f_options['form_class']; ?>"
            id="<?php echo isset($f_options['form_id']) ? $f_options['form_id'] : $form->getName(); ?>"
            name="<?php echo $form->getName(); ?>"
            <?php if(isset($f_options['enctype']) && !empty($f_options['enctype'])): ?>
            enctype="<?php echo $f_options['enctype']; ?>"
        <?php endif; ?>
            >

            <?php if (isset($f_options["show_title"]) && ($f_options["show_title"] == true) || !isset($f_options["show_title"])): ?>
                <?php if($f_options["form_title"]): ?>
                    <div class="form-group">
                        <div class="col-sm-offset-6 col-sm-16">
                            <h4><?php echo $f_options["form_title"]; ?></h4>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php include_partial("general/form/form", array("tr_pre" => $tr_pre, "form" => $form, "options" => $f_options))?>

            <?php if(is_null(FormHelper::getFormFieldsets($form))): ?>
                <div class="form-group form-controls">
                    <div class="<?php echo $f_options['button_container_class']; ?>">
                        <button
                            type="submit"
                            <?php if($f_options['button_name']): ?>name="<?php echo $f_options['button_name']; ?>"<?php endif; ?>
                            class="btn btn-default r-button-submit <?php echo $f_options['button_submit_class']; ?>"
                            >
                            <?php /*<i class="fa fa-chevron-right"></i>&nbsp;*/?>
                            <?php echo $f_options['submit_button_string']; ?>
                        </button>
                    </div>

                    <?php if($f_options['with_cancel']): ?>
                        <a class="btn r-button-cancel <?php echo $f_options['button_cancel_class']; ?>" href="<?php echo $f_options['cancel_url']; ?>">
                            <?php echo Translate::from(array(FormHelper::getTranslatePrefix($form), "button", "cancel")); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if(count($f_options["additional_links"])): ?>
                <div class="form-group form-links">
                    <?php foreach($f_options["additional_links"] as $link): ?>
                        <div class="col-sm-offset-6 col-sm-16">
                            <a href="<?php echo $link["href"]; ?>">
                                <?php echo $link["string"]; ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </form>
    </div>
<?php endif; ?>