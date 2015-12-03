<?php if(isset($condition) && $condition):?>
    <?php if ($condition): ?>
        <span class="label label-success" title="">
            <i class="fa fa-check"></i></span>
    <?php else: ?>
        <span class="label label-danger" title="">
            <i class="fa fa-times"></i></span>
    <?php endif; ?>
<?php endif;?>