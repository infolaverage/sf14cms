<form method="post" class="form-horizontal">
    <?php echo $form->renderHiddenFields()?>
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <div class="form-body">
        <?php foreach ($form->getFormFieldsets() as $fieldset_name => $fields): ?>
            <h2 class="form-section">
                <?php echo sfInflector::humanize($fieldset_name)?>
            </h2>
            <?php /**
             * @var sfFormField $field
             */?>
            <?php foreach($fields as $field_name):?>
                <?php if(isset($form[$field_name]) && $form[$field_name]->isHidden()){ continue; }?>
                <?php $field = $form[$field_name]?>
                <div class="form-group">
                    <div class="controls col-md-9 col-md-offset-3">
                        <?php if ($field->hasError()): ?>
                            <div class="note note-danger">
                                <?php if(is_array($field->getError())): ?>
                                    <?php foreach ($field->getError() as $error): ?>
                                        <p><?php echo $error->__toString() ?></p>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <?php echo $field->getError();?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <label class="col-md-3 control-label">
                        <?php echo $field->renderLabelName();?>
                    </label>
                    <div class="col-md-9">
                        <?php echo $field->render(array("class"=>"form-control"))?>
                        <?php /*<input type="text" class="form-control" placeholder="Enter text">
                    <span class="help-block">A block of help text.</span>*/?>
                    </div>
                    <?php if($field->renderHelp()):?>
                        <div class="clearfix"></div>
                        <div class="col-md-9 col-md-offset-3">
                        <span class="help-block">
                            <?php echo $field->renderHelp();?>
                        </span>
                        </div>
                    <?php endif;?>
                </div>
            <?php endforeach;?>
        <?php endforeach;?>
    </div>

    <hr/>
    <div class="row">
        <div class="col-md-9 col-md-offset-3">
            <button class="btn green btn-lg " type="submit">
                <i class="fa fa-save"></i>
                Save Settings
            </button>
        </div>
    </div>

    <div class="vs-60"></div>

</form>