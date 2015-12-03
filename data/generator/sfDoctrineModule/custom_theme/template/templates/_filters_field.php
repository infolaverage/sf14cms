[?php if ($field->isPartial()): ?]
    [?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php elseif ($field->isComponent()): ?]
    [?php include_component('<?php echo $this->getModuleName() ?>', $name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php else: ?]

<div class="control-group form-group [?php echo $class ?] [?php if($form[$name]->hasError()): ?]error[?php endif;?]">

    <label class="col-md-3 control-label">
        <?php /*[?php echo $form[$name]->renderLabel($label) ?]*/?>
        [?php echo Translate::from(array("amg","<?php echo $this->getSingularName()?>","field",$name,"label"))?]
    </label>

    <div class="col-md-9">
        <div class="controls">
            [?php $attrs = ($attributes instanceof sfOutputEscaper) ? $attributes->getRawValue() : $attributes ?]

            <div class="">
                [?php $default_attrs = array("class"=>"form-control"); ?]

                [?php $attrs = array_merge($default_attrs, $attrs); ?]

                [?php $form_attrs = $form[$name]->getWidget()->getAttributes() ?]


                [?php if (empty($form_attrs['class']) === false) : ?]
                [?php $attrs['class'] .= ' '.$form_attrs['class'] ?]
                [?php endif ?]

                [?php echo $form[$name]->render($attrs); ?]
            </div>

            [?php if ($help || $help = $form[$name]->renderHelp()): ?]
                    <span class="help-block">
                        [?php echo $form[$name]->renderError() ?] [?php echo Translate::from(array("amg",$help),array(),array("cataloge" =>'<?php echo $this->getI18nCatalogue() ?>' )) ?]
                    </span>
            [?php endif; ?]
        </div>
    </div>

</div>
[?php endif; ?]
