
[?php if ($sf_user->hasFlash('success')): ?]
  <div class="alert alert-success"><i class="fa fa-check"></i> [?php echo __($sf_user->getFlash('success'), array(), 'sf_admin') ?]</div>
[?php endif; ?]

[?php if ($sf_user->hasFlash('notice')): ?]
  <div class="alert alert-info"><i class="fa fa-info-circle"></i> [?php echo __($sf_user->getFlash('notice'), array(), 'sf_admin') ?]</div>
[?php endif; ?]

[?php if ($sf_user->hasFlash('error')): ?]
  <div class="alert alert-warning"><i class="fa fa-warning"></i> [?php echo __($sf_user->getFlash('error'), array(), 'sf_admin') ?]</div>
[?php endif; ?]
