[?php if ($field->isPartial()): ?]
    [?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php elseif ($field->isComponent()): ?]
    [?php include_component('<?php echo $this->getModuleName() ?>', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php else: ?]
<div class="form-group [?php echo $class ?][?php $form[$name]->hasError() and print ' errors note note-danger' ?]">
    <?php /*[?php echo $form[$name]->renderError() ?]*/?>

    <label class="control-label col-md-3">
        <?php /*[?php echo $form[$name]->renderLabel($label) ?]*/?>
        <?php /*[?php echo $form[$name]->renderLabelName($name) ?]*/?>
        <?php /*<?php #echo $this->getConfig('label', '', true)*/?>
        [?php echo Translate::from(array("amg","<?php echo $this->getSingularName()?>","field",$name,"label"))?]
    </label>

    <div class="controls col-md-9">

        <?php /*RENDERER: [?php echo $form[$name]->getWidget()->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes); ?]*/?>
        [?php if(!$form[$name]->getWidget()->getAttribute("data-display-as")): ?]
        [?php $form[$name]->getWidget()->setAttribute("class", "form-control ".$form[$name]->getWidget()->getAttribute("class")."")?]
        [?php endif; ?]

        <?php /*
            [?php $icon_align = $form[$name]->getWidget()->getAttribute("data-icon-align"); ?]
            <div class="input-icon">
                <i class="[?php echo $form[$name]->getWidget()->getAttribute('data-icon')?]"></i>

                [?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?]
            </div>
            */?>


        [?php if( $form[$name]->getWidget()->getAttribute("data-display-as") == "checkbox-switch"): ?]
        <div
            class="make-switch"
            data-on-label="&nbsp;<?php echo Translate::from("form:display:checkbox-switch:on-label")?>&nbsp;"
            data-off-label="&nbsp;<?php echo Translate::from("form:display:checkbox-switch:off-label")?>&nbsp;"
            >
            [?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?]
        </div>
        [?php elseif( $form[$name]->getWidget()->getAttribute("data-display-as") == "file-editable-image"): ?]
        <div class="file-editable-image">
            [?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?]
        </div>
        [?php else: ?]

        <?php //ICON-ALIGN: ?>
        [?php $icon_align   = $form[$name]->getWidget()->getAttribute("data-icon-align"); ?]
        [?php $icon         = $form[$name]->getWidget()->getAttribute("data-icon"); ?]
        [?php $input_size   = $form[$name]->getWidget()->getAttribute("data-input-size"); ?]
        [?php $has_icon     = $icon ? true : false; ?]

        [?php $icon_suffix = $form[$name]->getWidget()->getAttribute("data-icon-suffix")?]
        [?php $text_suffix = $form[$name]->getWidget()->getAttribute("data-text-suffix")?]

        [?php $container_class_a   = array(); ?]
        [?php $container_class_a[] = $has_icon ? "input-icon" : ""; ?]
        [?php $container_class_a[] = $input_size; ?]
        [?php if( !$form[$name]->getWidget()->getAttribute("data-display-as") == "" || $icon_suffix || $text_suffix ): ?]
        [?php $container_class_a[] = "input-group"; ?]
        [?php endif;?]

        [?php $container_class = implode($container_class_a, " "); ?]

        <div class="[?php echo $container_class; ?]">


            [?php if($has_icon):?]
            <i class="[?php echo $form[$name]->getWidget()->getAttribute('data-icon'); ?]"></i>
            [?php endif; ?]


            [?php $original_class           = $form[$name]->getWidget()->getAttribute("class"); ?]
            [?php $data_additional_class    = $form[$name]->getWidget()->getAttribute("data-additional-class"); ?]

            [?php $form[$name]->getWidget()->setAttribute("class", $original_class." ".$data_additional_class); ?]


            <?php /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */?>
            <?php /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */?>
            <?php /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */?>
            <div class="fieldset">
                [?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?]
            </div>
            <?php /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */?>
            <?php /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */?>
            <?php /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */?>



            [?php if($icon_suffix || $text_suffix):?]

                        <span class="input-group-addon">
                             [?php if($icon_suffix):?]
                                <i class="fa [?php echo $icon_suffix?]"></i>
                             [?php endif?]
                             [?php if($text_suffix):?]
                                [?php echo $text_suffix?]
                             [?php endif?]
                        </span>
            [?php endif;?]
        </div>
        [?php endif; ?]


        [?php if($form[$name]->getWidget()->getAttribute("data-with-new-button") == "true"):?]

        [?php if($form[$name]->getWidget()->getAttribute("data-new-button-url")):?]
        [?php $new_url_route = $form[$name]->getWidget()->getAttribute("data-new-button-url"); ?]
        <a href="[?php echo url_for('@'.$new_url_route);?]" target="_blank" class="btn yellow btn-xs"><i class="fa fa-file-o"></i><?php echo Translate::from(array("amg","form","field","add_new:text"))?></a>
        <?php /*
                [?php $field_value = $form->getObject()->$name; ?]
                [?php if($field_value):?]
                    <a href="[?php echo Project::getDerefererUrl($field_value);?]" target="_blank" class="btn yellow btn-xs"><i class="fa fa-external-link"></i> Jump To Saved Url: [?php echo $field_value;?]</a>
                [?php endif;?]
                */?>

        [?php endif; ?]
        [?php endif; ?]

        [?php if($form[$name]->getWidget()->getAttribute("data-jump-to-url") == "true"):?]

        [?php $field_value = $form->getObject()->$name; ?]
        [?php if($field_value):?]
        <a href="[?php echo Project::getDerefererUrl($field_value);?]" target="_blank" class="btn yellow btn-xs"><i class="fa fa-external-link"></i> Ugrás a mentett URL-re: [?php echo $field_value;?]</a>
        [?php endif;?]

        [?php endif; ?]

        [?php if($form[$name]->getWidget()->getAttribute("data-with-clear-button") == "true"):?]

        [?php $form_widget_id = $form[$name]->renderId()?]
        [?php #print_r($form_widget_id); ?]
        [?php #if($field_value):?]
        <a href="#" onclick="ClearFieldValueById($(this)); return false;" data-j-field-id="[?php echo $form_widget_id; ?]" class="btn dark btn-xs"><i class="fa fa-trash-o"></i> Mező törlése</a>
        [?php #endif;?]

        [?php endif; ?]

        [?php if ($form[$name]->hasError()): ?]
        <!--        <div class="controls col-md-12">-->
        [?php include_partial('<?php echo $this->getModuleName() ?>/form_field_error', array('form' => $form, 'name' => $name)); ?]
        <!--        </div>-->
        [?php endif; ?]

        [?php if ($help): ?]
        <span class="help-block">[?php echo __($help, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</span>
        [?php elseif ($help = $form[$name]->renderHelp()): ?]
        <span class="help-block">[?php echo $help ?]</span>
        [?php endif; ?]
    </div>

</div>
[?php endif; ?]
