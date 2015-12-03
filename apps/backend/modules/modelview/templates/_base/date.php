<?php if($date):?>
    <?php if($date): ?>
        <?php //if($date): //$sf_user->getTime($date, true)): ?>

        <?php if(strlen($date) > 2): ?>
            <span title="list.date.title.local" class="qt">
                <?php echo $date //$sf_user->getTime($date) ?>
            </span>
        <?php endif; ?>

    <?php else: ?>

        <small class="muted"><?php echo $date?></small>

    <?php endif; ?>
<?php endif;?>