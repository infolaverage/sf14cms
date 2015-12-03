<?php
    /**
     * @var TeamMember $entity
     */
    $entity = $team_member;
?>
<?php if($entity->getImageLink()):?>
    <div class="" style="width: 60px">
        <img src="<?php echo $entity->getImageLink()?>" class="img-responsive"/>
    </div>
<?php endif;?>