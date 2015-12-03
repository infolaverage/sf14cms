[?php use_helper('I18N', 'Date') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]

[?php slot('page_title') ?]
    <?php /*[?php echo <?php echo $this->getI18NString('new.title') ?> ?]*/?>
    <h1>
        [?php echo "<?php echo Translate::from(array("amg",$this->getSingularName(),"new:title")) ?>"?]
        <small>[?php echo '<?php echo $this->getModuleName() ?>' ?]</small>
    </h1>
[?php end_slot()?]

[?php slot('page_breadcrumb') ?]
    [?php include_partial(
        "dash_comp/breadcrumb",
        array("breadcrumbs" =>
            array(
                array(
                    'text'  => "<?php echo Translate::from(array("amg",$this->getSingularName(),"list:title")) ?>",
                    'link'  => '@<?php echo $this->getUrlForAction('list') ?>'
                ),
                array(
                    'text'  => "<?php echo Translate::from(array("amg",$this->getSingularName(),"new:title")) ?>",
                    'link'  => '@<?php echo $this->getUrlForAction('new') ?>'
                )
            )
        )
    )?]
[?php end_slot()?]

[?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

<div class="portlet light">
    <?php /*
    <div class="portlet-title">
        <div class="caption">
            <?php /*[?php echo <?php echo $this->getI18NString('new.title') ?> ?]?>
            [?php echo "<?php echo Translate::from(array("amg",$this->getSingularName(),"new:title")) ?>"?]
        </div>
    </div>
    */ ?>
    <div class="portlet-body form">
        [?php include_partial('<?php echo $this->getModuleName() ?>/form_header', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration)) ?]
        [?php include_partial('<?php echo $this->getModuleName() ?>/form', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
        [?php include_partial('<?php echo $this->getModuleName() ?>/form_footer', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration)) ?]
    </div>
</div>

