[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]

<div class="ws_admin_filter">

    <div class="portlet box grey-cascade">
        <div class="portlet-title">
            <div class="caption"><i class="fa fa-filter"></i>
                <?php /*[?php echo __('Filter', array(), 'sf_admin') ?]*/?>
                [?php echo "<?php echo Translate::from(array("amg",$this->getSingularName(),"filter:title")) ?>"?]
            </div>
            <div class="tools">
                <a href="javascript:;" class="expand"></a>
                <?php /*
                <a href="#portlet-config" data-toggle="modal" class="config"></a>
                <a href="javascript:;" class="reload"></a>
                */?>
            </div>
        </div>
        <div class="portlet-body form display-hide">
            [?php if ($form->hasGlobalErrors()): ?]
                [?php echo $form->renderGlobalErrors() ?]
            [?php endif; ?]

            <form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter')) ?]" method="post" class="form-horizontal form-row-seperated">
                <div class="form-body">
                    [?php echo $form->renderHiddenFields() ?]

                    [?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?]
                        [?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?]
                            [?php include_partial('<?php echo $this->getModuleName() ?>/filters_field', array(
                                'name'       => $name,
                                'attributes' => $field->getConfig('attributes', array()),
                                'label'      => $field->getConfig('label'),
                                'help'       => $field->getConfig('help'),
                                'form'       => $form,
                                'field'      => $field,
                                'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_filter_field_'.$name,
                            )) ?]
                    [?php endforeach; ?]

                </div>

                <div class="form-actions fluid">
                    <div class="col-md-offset-3 col-md-9">
                        <?php
                            //echo Translate::from("general:filter:btn:text:filter")
                            //Translate::from("general:filter:btn:text:reset")
                        ?>
                        <button type="submit" class="btn green">
                            <i class="fa fa-search"></i>
                            [?php echo Translate::from("general:filter:btn:text:filter") ?]
                        </button>

                        [?php echo link_to(
                            "<i class='fa fa-times'></i> ".Translate::from("general:filter:btn:text:reset"),
                            '<?php echo $this->getUrlForAction('collection') ?>',
                            array('action' => 'filter'),
                            array('query_string' => '_reset', 'method' => 'post', 'class'=>'btn red')
                        ) ?]
                    </div>
                </div>
            </form>

        </div>
    </div>


</div>
