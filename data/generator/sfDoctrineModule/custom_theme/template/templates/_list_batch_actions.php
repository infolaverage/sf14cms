<?php if ($listActions = $this->configuration->getValue('list.batch_actions')): ?>
    <div class="sf_admin_batch_actions_choice">
        <select name="batch_action" class="form-control input-inline input-medium">
            <option value="">[?php echo __('Choose an action', array(), 'sf_admin') ?]</option>
                <?php foreach ((array) $listActions as $action => $params):
                        $actionName = $action;
                    ?>
                    <?php if (isset($params["action"])){
                        $actionName = $params["action"];
                    } ?>
                    <?php echo $this->addCredentialCondition('<option value="'.$actionName.'">[?php echo __(\''.$params['label'].'\', array(), \'sf_admin\') ?]</option>', $params) ?>
                <?php endforeach; ?>
        </select>
        [?php $form = new BaseForm(); if ($form->isCSRFProtected()): ?]
            <input type="hidden" name="[?php echo $form->getCSRFFieldName() ?]" value="[?php echo $form->getCSRFToken() ?]" />
        [?php endif; ?]
        <input class="btn green" type="submit" value="[?php echo __('go', array(), 'sf_admin') ?]" />
    </div>

    <script type="text/javascript">
        function checkAll(all_checkbox) {
            var boxes = document.getElementsByTagName('input');
            for(var index = 0; index < boxes.length; index++) {
                box = boxes[index];
                if (box.type == 'checkbox' && $(box).hasClass('group_select_checkbox') ){
                    box.checked = all_checkbox.checked;
                    if(box.checked) {
                        $(box).parent().addClass("checked");
                    }else{
                        $(box).parent().removeClass("checked");
                    }
                }
            }
            return true;
        }
    </script>
<?php endif; ?>
