[?php if ($value): ?]
<?php /*
    [?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/tick.png', array('alt' => __('Checked', array(), 'sf_admin'), 'title' => __('Checked', array(), 'sf_admin'))) ?]

    <div class="text-center">
   */ ?>
    <i class="fa fa-check"></i>
<?php /*</div>*/ ?>
[?php else: ?]
    <i class="fa fa-times"></i>
[?php endif; ?]
