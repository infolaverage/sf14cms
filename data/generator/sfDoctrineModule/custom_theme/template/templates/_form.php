[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]

[?php
    $attributes_default = [];
    if($form->getOption("form-attributes")) {
        $attributes_default = $form->getOption("form-attributes");
    }
?]
[?php echo form_tag_for($form, '@<?php echo $this->params['route_prefix'] ?>', $attributes_default) ?]
[?php echo $form->renderHiddenFields(false) ?]

<div class="form-body">

    [?php if ($form->hasGlobalErrors()): ?]
    [?php echo $form->renderGlobalErrors() ?]
    [?php endif; ?]

    [?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?]
    [?php include_partial('<?php echo $this->getModuleName() ?>/form_fieldset', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?]
    [?php endforeach; ?]

</div>
<div class="form-actions">
    [?php include_partial('<?php echo $this->getModuleName() ?>/form_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
</div>
</form>

