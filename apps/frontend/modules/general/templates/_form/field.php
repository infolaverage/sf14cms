<?php
    $form_field_schema                = $form->getFormFieldSchema();
    $field                            = $form_field_schema[$field_name];
    $field_classes                    = FormHelper::getFieldHtmlClasses($form);
    $field_container_classes          = FormHelper::getFieldContainerHtmlClasses($form);
    $field_outer_container_classes    = FormHelper::getFieldOuterContainerHtmlClasses($form);
    $tr_pre                           = "general:form:field:";
?>

<?php if(!$field->getWidget()->isHidden()): ?>

    <?php
    $field_class_original                       = "";
    $field_class_original_array                 = "";
    $field_container_class                      = "c-field-".$field_name;
    $field_class                                = "h-field-".$field_name;
    $field_container_class_original             = isset($field_container_classes[$field_name]) ? $field_container_classes[$field_name] : "";
    $field_outer_container_class_original       = isset($field_outer_container_classes[$field_name]) ? $field_outer_container_classes[$field_name] : "";
    $label_source                               = FormHelper::getRenderedLabelFor($form, $field_name);
    $display_type                               = FormHelper::getFieldDisplayType($form, $field_name);
    $f_help_position                            = isset($help_position) ? $help_position : "after-field";
    ?>

    <?php if( isset($field_classes[$field_name]) && !is_array($field_classes[$field_name]) ){ $field_class_original = $field_classes[$field_name];} ?>
    <?php if( isset($field_classes[$field_name]) && is_array($field_classes[$field_name]) ){ $field_class_original_array = $field_classes[$field_name];} ?>

    <div class="form-group <?php echo $field->hasError() ? "has-error" : ""; ?> <?php echo $field_container_class?> <?php echo $field_outer_container_class_original?> ">

        <?php $field_error = null;?>
        <?php if($field->hasError()):?>
            <?php $field_error = FormHelper::getRenderedErrorFor($form, $field_name, $field->getError());?>
        <?php endif;?>

        <?php if(!$display_type): ?>
            <label class="control-label <?php echo $label_class; ?>" for="<?php echo $field->renderId()?>">
                <?php echo Translate::from($label_source)?>
            </label>
        <?php endif; ?>

        <?php /*if($field->renderHelp() && ($f_help_position == "after-label")):?>
            <?php include_partial("general/form/help", array("help_source"=>FormHelper::getRenderedHelpFor($form, $field_name))); ?>
        <?php endif;*/ ?>


        <div class="<?php /*col-sm-16*/?> <?php echo $field_container_class_original; ?>">
            <?php if(!$display_type):?>

                <?php echo $field->render(
                    array(
                        "class"         => $field_class_original." ".$field_class ,
                        "class_array"   => $field_class_original_array
                    )
                );?>

                <?php if($field->hasError()):?>
                    <div class="help-block with-errors">
                        <ul class="list-unstyled">
                            <li><?php echo $field_error; ?></li>
                        </ul>
                    </div>
                <?php endif;?>

            <?php elseif($display_type == "simple_checkbox"): ?>

                <div class="checkbox">
                    <label>
                        <?php echo $field->render(array("class" => $field_class_original." ".$field_class ,"class_array" => $field_class_original_array))?>
                        <?php echo Translate::from($label_source)?>
                    </label>
                </div>

            <?php endif; ?>
        </div>

        <?php /*if($field->renderHelp() && ($f_help_position == "after-field")): ?>
            <?php include_partial("general/form/help", array("help_source"=>FormHelper::getRenderedHelpFor($form, $field_name))); ?>
        <?php endif;*/ ?>

        <?php /*if(isset($separator_between_fields) && $separator_between_fields): ?>
            <hr/>
        <?php endif;*/ ?>

    </div>
<?php endif;?>