<?php use_helper('I18N') ?>
<?php /*
<h1><?php echo __('Signin', null, 'sf_guard') ?></h1>
*/?>
<?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>