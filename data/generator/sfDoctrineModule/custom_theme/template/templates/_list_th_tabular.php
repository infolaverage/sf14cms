<?php /*
[?php echo Translate::from(array("amg","<?php echo $this->getSingularName()?>","field",$name,"label"))?]
*/?>
<?php foreach ($this->configuration->getValue('list.display') as $name => $field): ?>
    [?php slot('sf_admin.current_header') ?]
    <?php /*class="ws_admin_<?php echo strtolower($field->getType()) ?> ws_admin_list_th_<?php echo $name ?>"*/ ?>
    <th>
        <?php
        if($field->isReal()): ?>
            [?php if ('<?php echo $name ?>' == $sort[0]): ?]
            [?php echo link_to(
                Translate::from(
                    array("amg","<?php echo $this->getSingularName(); ?>","field","<?php echo $name; ?>","label"),
                    ["default"=>"<?php echo $name; ?>"]
                ),
                <?php /*
                    __(
                        '<?php echo $name.'.label'//$field->getConfig('label', '', true) ?>',
                        array(),
                        '<?php echo $this->getI18nCatalogue() ?>'
                    ),*/?>
                '@<?php echo $this->getUrlForAction('list') ?>',
                array('query_string' => 'sort=<?php echo $name ?>&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')))
            ?]
            [?php if($sort[1] == "asc"):?]
                <i class="fa fa-angle-up" title="[?php echo __($sort[1], array(), 'sf_admin') ?]"></i>
            [?php else:?]
                <i class="fa fa-angle-down" title="[?php echo __($sort[1], array(), 'sf_admin') ?]"></i>
            [?php endif;?]
            [?php else: ?]
                [?php echo link_to(
                    Translate::from(array("amg","<?php echo $this->getSingularName(); ?>","field","<?php echo $name; ?>","label"),
                    ["default"=>"<?php echo $name; ?>"]
                    ),
                    <?php /*__(
                        '<?php echo $name.'.label'//$field->getConfig('label', '', true) ?>',
                        array(),
                        '<?php echo $this->getI18nCatalogue() ?>'
                    ),*/?>
                    '@<?php echo $this->getUrlForAction('list') ?>', array('query_string' => 'sort=<?php echo $name ?>&sort_type=asc')) ?]
            [?php endif; ?]
        <?php else:
            ?>
            [?php echo Translate::from(
                    array("amg","<?php echo $this->getSingularName(); ?>","field","<?php echo $name; ?>","label"),
                    ["default"=>"<?php echo $name; ?>"]
            );
            <?php /*__(
                '<?php echo $name.'.label'//$field->getConfig('label', '', true) ?>',
                array(),
                '<?php echo $this->getI18nCatalogue() ?>'
            )*/?>
            ?]
        <?php endif; ?>
    </th>
    [?php end_slot(); ?]
    <?php echo $this->addCredentialCondition("[?php include_slot('sf_admin.current_header') ?]", $field->getConfig()) ?>
<?php endforeach; ?>
