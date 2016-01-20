[?php use_helper('I18N', 'Date') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]

[?php slot('page_title') ?]
    <?php /*[?php echo <?php echo $this->getI18NString('edit.title') ?> ?]*/?>
    <h1>
        [?php echo "<?php echo Translate::from(array("amg",$this->getSingularName(),"edit:title"), ["default"=> sfInflector::humanize($this->getSingularName())." Edit"]) ?>"?]
        <small>[?php echo '<?php echo $this->getModuleName() ?>' ?]</small>
    </h1>
[?php end_slot()?]

[?php slot('page_toolbar')?]
    [?php include_partial('<?php echo $this->getModuleName() ?>/page_content_top_right', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
[?php end_slot()?]

[?php slot('page_breadcrumb') ?]
    [?php include_partial(
        "dash_comp/breadcrumb",
        array("breadcrumbs" =>
            array(
                array(
                    'text'  => "<?php echo Translate::from(array("amg",$this->getSingularName(),"list:title"), ["default"=> sfInflector::humanize($this->getSingularName())." List"]) ?>" ,
                    'link'  => '@<?php echo $this->getUrlForAction('list') ?>'
                ),
                array(
                    'text'  => "<?php echo Translate::from(array("amg",$this->getSingularName(),"edit:title"), ["default"=> sfInflector::humanize($this->getSingularName())." Edit"]) ?>",
                    'link'  => url_for('<?php echo $this->getUrlForAction('edit')?>', $<?php echo $this->getSingularName() ?>)
                )
            )
        )
    )?]
[?php end_slot()?]


<?php /*
[?php echo $<?php echo $this->getSingularName() ?>?]
[?php echo url_for($helper->getUrlForAction('edit'), $<?php echo $this->getSingularName() ?>)?]
[?php echo url_for('<?php echo $this->getUrlForAction('edit')?>', $<?php echo $this->getSingularName() ?>)?]
*/?>

[?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]
<?php /*
[?php include_slot('page_content_title') ?]
[?php include_slot('page_breadcrumb') ?]
*/?>

<div class="portlet light">
    <?php /*
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-edit"></i>
            <?php /*[?php echo <?php echo $this->getI18NString('edit.title') ?>?]?>
            [?php echo "<?php echo Translate::from(array("amg",$this->getSingularName(),"edit:title")) ?>"?]
        </div>
        <?php /*
          <div class="tools">
              <a href="javascript:;" class="collapse"></a>
              <a href="#portlet-config" data-toggle="modal" class="config"></a>
              <a href="javascript:;" class="reload"></a>
              <a href="javascript:;" class="remove"></a>
          </div>
    </div>
    */?>
    <div class="portlet-body form">
        [?php include_partial('<?php echo $this->getModuleName() ?>/form_header', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration)) ?]
        [?php include_partial('<?php echo $this->getModuleName() ?>/form', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
        [?php include_partial('<?php echo $this->getModuleName() ?>/form_footer', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration)) ?]
    </div>
</div>

