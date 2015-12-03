<?php if(isset($entity) && $entity):?>
    <div class="ccnt">
        <?php echo $entity->getFinalContent(ESC_RAW)?>
        <div class="clearfix"></div>
    </div>
<?php endif;?>