<div class="ws_admin_list">
    [?php if (!$pager->getNbResults()): ?]
    <h3>[?php echo __('No result', array(), 'sf_admin') ?]</h3>
    [?php else: ?]
    <div class="portlet light">
        <?php /*
        <div class="portlet-title">
            <div class="caption">
                [?php echo "<?php echo Translate::from(array("amg",$this->getSingularName(),"list:title")) ?>"?]
            </div>

            <div class="tools">
                <a href="javascript:;" class="collapse j-expand-or-collapse"></a>
            </div>
        </div>
        */ ?>
        <div class="portlet-body">
            <div class="clearfix">
                <div class="btn-group">

                    <?php /*[?php include_partial('<?php echo $this->getModuleName() ?>/list_batch_actions', array('helper' => $helper)) ?] */?>
                    <?php /*[?php include_partial('<?php echo $this->getModuleName() ?>/list_actions', array('helper' => $helper)) ?]*/?>

                </div>

                <?php /*
                <div class="btn-group pull-right">
                    <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i></button>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="#">Lorem</a></li>
                        <li><a href="#">Ipsum</a></li>
                        <li><a href="#">Dolor Sit</a></li>
                    </ul>
                </div>
                */?>

            </div>

            <table class="table table-striped table-hover" <?php /*id="sample_1"*/?>>
                <thead>
                <tr>
                    <?php if ($this->configuration->getValue('list.batch_actions')): ?>
                        <th style="width:8px;"><input type="checkbox" class="group-checkable" onclick="checkAll(this);"/></th>
                    <?php endif; ?>
                    [?php include_partial('<?php echo $this->getModuleName() ?>/list_th_<?php echo $this->configuration->getValue('list.layout') ?>', array('sort' => $sort)) ?]

                    <?php if ($this->configuration->getValue('list.object_actions')): ?>
                        <th id="">[?php echo __('Actions', array(), 'sf_admin') ?]</th>
                    <?php endif; ?>
                </tr>
                </thead>

                <?php /*
                <tfoot>
                    <tr>
                        <th colspan="<?php echo count($this->configuration->getValue('list.display')) + ($this->configuration->getValue('list.object_actions') ? 1 : 0) + ($this->configuration->getValue('list.batch_actions') ? 1 : 0) ?>"></th>
                    </tr>
                </tfoot>
                */?>

                <tbody>
                [?php foreach ($pager->getResults() as $i => $<?php echo $this->getSingularName() ?>): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?]
                <tr class="ws_admin_row [?php echo $odd ?]">
                    <?php if ($this->configuration->getValue('list.batch_actions')): ?>
                        [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_batch_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'helper' => $helper)) ?]
                    <?php endif; ?>
                    [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_<?php echo $this->configuration->getValue('list.layout') ?>', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
                    <?php if ($this->configuration->getValue('list.object_actions')): ?>
                        [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'helper' => $helper)) ?]
                    <?php endif; ?>
                </tr>
                [?php endforeach; ?]
                </tbody>
            </table>



            <div class="row">

                <div class="col-md-8">
                    <div class="dataTables_paginate paging_bootstrap">
                        [?php if ($pager->haveToPaginate()): ?]
                            [?php include_partial('<?php echo $this->getModuleName() ?>/pagination', array('pager' => $pager)) ?]
                        [?php endif; ?]
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="pagination-info">
                        <?php /*
                        [?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results',
                            array(
                                '%1%' => $pager->getNbResults()),
                                $pager->getNbResults(),
                                'sf_admin'
                            ) ?]
                        */?>

                        [?php echo Translate::from(
                            ["backend","pager:result:numbers:%1%"],
                            [

                                "args" => [
                                    "%1%" => $pager->getNbResults()
                                ],
                                "format_number_choice" => true,
                                "format_number_choice_condition" => "%1%"
                            ]
                        )?]

                        <br/>
                        [?php if ($pager->haveToPaginate()): ?]
                            [?php echo Translate::from(
                                array("backend","pager:list:info:%1%:%2%"),
                                [
                                    "args" => [
                                        "%1%" => $pager->getPage(),
                                        "%2%" => $pager->getLastPage(),
                                    ]
                                ] );?]
                        [?php endif; ?]
                    </div>
                </div>
            </div>
        </div>
    </div>
    [?php endif; ?]
</div>