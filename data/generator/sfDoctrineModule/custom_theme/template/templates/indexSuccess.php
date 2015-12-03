[?php use_helper('I18N', 'Date') ?]

<?php //Translate::glue(array("amg",$this->getSingularName())) ?>

[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]

[?php slot('page_title') ?]
    <h1>
        <?php /*[?php echo <?php echo $this->getI18NString('list.title') ?> ?]*/?>
        [?php echo "<?php echo Translate::from(array("amg",$this->getSingularName(),"list:title")) ?>"?]
        <small>[?php echo '<?php echo $this->getModuleName() ?>' ?]</small>
    </h1>
[?php end_slot()?]

[?php slot('page_breadcrumb') ?]
    [?php include_partial(
        "dash_comp/breadcrumb",
        array("breadcrumbs" =>
            array(
                array(
                    'text'  =>  "<?php echo Translate::from(array("amg",$this->getSingularName(),"list:title")) ?>",
                    'link'  => '@<?php echo $this->getUrlForAction('list') ?>'
                )
            )
        )
    )?]
[?php end_slot()?]

<div class="row">
    <div class="col-md-12">

        [?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

        <div id="sf_admin_header">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    [?php include_partial('<?php echo $this->getModuleName() ?>/list_header', array('pager' => $pager)) ?]
                </div>
            </div>
        </div>

        <?php /*[?php include_slot('page_breadcrumb') ?]*/?>

        <?php if ($this->configuration->hasFilterForm()): ?>
            <div id="ws_admin_bar">
                [?php include_partial('<?php echo $this->getModuleName() ?>/filters', array('form' => $filters, 'configuration' => $configuration)) ?]
            </div>
        <?php endif; ?>

        <div id="ws_custom_admin_content">
            <?php if ($this->configuration->getValue('list.batch_actions')): ?>
            <form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'batch')) ?]" method="post">
                <?php endif; ?>

                [?php include_partial('<?php echo $this->getModuleName() ?>/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?]

                <div class="ws_custom_admin_actions">
                    <div class="row">
                        <div class="col-md-6">
                            [?php include_partial('<?php echo $this->getModuleName() ?>/list_batch_actions', array('helper' => $helper)) ?]
                        </div>
                        <div class="col-md-6 col-xs-6 text-right">
                            [?php include_partial('<?php echo $this->getModuleName() ?>/list_actions', array('helper' => $helper)) ?]
                        </div>
                    </div>
                </div>

                <?php if ($this->configuration->getValue('list.batch_actions')): ?>
            </form>
        <?php endif; ?>
        </div>

        <div id="sf_admin_footer">
            [?php include_partial('<?php echo $this->getModuleName() ?>/list_footer', array('pager' => $pager)) ?]
        </div>


    </div>
</div>

