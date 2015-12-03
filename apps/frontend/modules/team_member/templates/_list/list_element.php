<?php
    /**
     * @var TeamMember $entity
     */
?>
<?php if(isset($entity) && $entity):?>
    <div class="col-sm-8">

        <div class="box-5-container">
            <div class="box-5">

                <div class="box-5-content-image-container">
                    <img src="<?php echo $entity->getImageLink()?>" class="center-block img-responsive" alt="">
                </div>

                <div class="box-5-title">
                    <div class="h2 team-member-name">
                        <?php echo $entity->getTitle()?>
                    </div>
                </div>

                <div class="box-5-content">
                    <div class="team-member-position">
                        <?php echo $entity->getMemberPosition()?>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php endif;?>