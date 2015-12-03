<?php
    $default_options = array(
        "field_container_class"         => "",
        "separator_between_fields"      => false,
        "help_position"                 => "after-field",
    );
    $f_options = $default_options;

    if(isset($options)){
        $f_options = array_merge($default_options, $sf_data->getRaw('options'));
    }
?>

<?php if($form):?>
    <?php $form_field_schema = $form->getFormFieldSchema(); ?>

    <?php //Global Errors ------------------------------------------------------------ ?>
    <?php if($form->getGlobalErrors()){}?>

    <?php foreach ($form->getGlobalErrors() as $name => $error): ?>
        <?php $ge = FormHelper::getRenderedErrorFor($form, "global_error", $error);?>
        <span class="error s-1">
            <?php echo Translate::from($tr_pre.":".$ge); ?>
        </span>
    <?php endforeach; ?>

    <?php echo $form->renderHiddenFields(); ?>
    <?php //-------------------------------------------------------------------------------------------------------------- ?>

    <?php if(!is_null(FormHelper::getFormFieldsets($form))):?>

        <?php //Fieldsets ------------------------------------------------------------ ?>
        <?php $form_fieldsets = FormHelper::getFormFieldsets($form); ?>
        <?php $i = 0; ?>
        <?php foreach($form_fieldsets as $key => $form_fieldset_field): ?>
            <h3><?php echo Translate::from($tr_pre.":fieldset:title:".$key); ?></h3>
            <div class="row col-sm-20 col-sm-offset-1 col-md-14 col-md-offset-5">
                <?php foreach($form_fieldset_field as $key): ?>
                    <?php include_partial("general/form/field", array(
                            "form"                          => $form,
                            "field_name"                    => $key,
                            "separator_between_fields"      => $f_options['separator_between_fields'],
                            "help_position"                 => $f_options["help_position"],
                            "label_class"                   => $f_options["label_class"]
                        ));?>
                <?php endforeach; ?>
                <?php if($i == count($form_fieldsets) - 1): ?>
                    <div class="form-group">
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
            </div>
            <div class="clearfix"></div>
            <?php $i++; ?>
        <?php endforeach; ?>
        <?php //-------------------------------------------------------------------- ?>

    <?php else: ?>

        <?php foreach($form_field_schema as $key => $value): ?>
            <?php include_partial("general/form/field", array(
                    "form"                          => $form,
                    "field_name"                    => $key,
                    "separator_between_fields"      => $f_options['separator_between_fields'],
                    "help_position"                 => $f_options["help_position"],
                    "label_class"                   => $f_options["label_class"]
                ));?>
        <?php endforeach; ?>

    <?php endif;?>

<?php endif;?>