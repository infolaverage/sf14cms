<?php use_helper('I18N') ?>

<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post" class="login-form">
    <h3 class="form-title"><?php echo __('Signin', null, 'sf_guard') ?></h3>
    <?php //echo $form ?>
    <?php echo $form->renderHiddenFields();?>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">
            <?php echo $form["username"]->renderLabelName()?>
        </label>
        <?php echo $form["username"]->render([
            "class"         => "form-control form-control-solid placeholder-no-fix",
//            "autocomplete"  => "off",
            "placeholder"   => $form["username"]->renderLabelName()
        ])?>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">
            <?php echo $form["password"]->renderLabelName()?>
        </label>
        <?php echo $form["password"]->render([
            "class"         => "form-control form-control-solid placeholder-no-fix",
//            "autocomplete"  => "off",
            "placeholder"   => $form["password"]->renderLabelName()
        ])?>

    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-success uppercase"><?php echo __('Signin', null, 'sf_guard') ?></button>
        <?php /*
        <label class="rememberme check">
            <input type="checkbox" name="remember" value="1"/>Remember </label>
        <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
        */?>

        <?php if(0):?>
            <?php $routes = $sf_context->getRouting()->getRoutes() ?>
            <?php if (isset($routes['sf_guard_forgot_password'])): ?>
                <a href="<?php echo url_for('@sf_guard_forgot_password') ?>"><?php echo __('Forgot your password?', null, 'sf_guard') ?></a>
            <?php endif; ?>

            <?php if (isset($routes['sf_guard_register'])): ?>
                &nbsp; <a href="<?php echo url_for('@sf_guard_register') ?>"><?php echo __('Want to register?', null, 'sf_guard') ?></a>
            <?php endif; ?>
        <?php endif;?>
    </div>


</form>