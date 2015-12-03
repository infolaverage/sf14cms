<div class="ws_admin_actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
            <?php foreach (array('new', 'edit') as $action): ?>
                <?php if ('new' == $action): ?>
                    [?php if ($form->isNew()): ?]
                <?php else: ?>
                    [?php else: ?]
                <?php endif; ?>

                <?php foreach ($this->configuration->getValue($action.'.actions') as $name => $params): ?>

                    <?php if('_save' == $name): ?>
                        <?php echo $this->addCredentialCondition('[?php echo $helper->linkToSave($form->getObject(), '.$this->asPhp($params).') ?]', $params); ?>
                        <?php #echo $this->addCredentialCondition('[?php echo $helper->linkToSaveFixed($form->getObject(), '.$this->asPhp($params).') ?]', $params); ?>
                    <?php elseif('_save_and_add' == $name): ?>
                        <?php echo $this->addCredentialCondition('[?php echo $helper->linkToSaveAndAdd($form->getObject(), '.$this->asPhp($params).') ?]', $params); ?>
                    <?php elseif('_delete' == $name): ?>
                        <?php echo $this->addCredentialCondition('[?php echo $helper->linkToDelete($form->getObject(), '.$this->asPhp($params).') ?]', $params); ?>
                    <?php elseif('_list' == $name): ?>
                        <?php echo $this->addCredentialCondition('[?php echo $helper->linkToList('.$this->asPhp($params).') ?]', $params) ?>
                    <?php else: ?>
                        <?php /*<span class="sf_admin_action_<?php echo $params['class_suffix'] ?>">*/?>
                        [?php if (method_exists($helper, 'linkTo<?php echo $method = ucfirst(sfInflector::camelize($name)) ?>')): ?]
                        <?php echo $this->addCredentialCondition('[?php echo $helper->linkTo'.$method.'($form->getObject(), '.$this->asPhp($params).') ?]', $params); ?>
                        [?php else: ?]
                        <?php echo $this->addCredentialCondition($this->getLinkToAction($name, $params, true), $params); ?>
                        [?php endif; ?]
                        <?php /*</span>*/?>
                    <?php endif; ?>

                <?php endforeach; ?>



            <?php endforeach; ?>
            [?php endif; ?]
        </div>
    </div>


</div>
