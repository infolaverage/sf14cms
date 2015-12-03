<?php if(isset($entity) && $entity):?>
    <a href="<?php echo url_for("site_show", $entity)?>" title="" class="qt">
        <?php echo $entity->getName();?><br/>
        <small>
            <?php if($entity->getDomain()):?>
                <?php echo $entity->getDomain()?><br/>
            <?php endif;?>
            <?php if($entity->getDomainAlias()):?>
                <?php echo $entity->getDomainAlias()?><br/>
            <?php endif;?>
            <?php if($entity->getDomainDev()):?>
                <?php echo $entity->getDomainDev()?><br/>
            <?php endif;?>
            <?php if($entity->getDomainDevAlias()):?>
                <?php echo $entity->getDomainDevAlias()?><br/>
            <?php endif;?>
        </small>
    </a>
<?php endif;?>