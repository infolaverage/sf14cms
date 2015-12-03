<?php if(isset($entities) && $entities):?>
    <div class="row">
        <?php foreach($entities as $entity):?>
            <?php
            /**
             * @var Banner $entity
             */
            ?>
            <div class="col-md-8">
                <div class="box-3-container">
                    <div class="box-3">
                        <div class="box-3-header">
                            <?php if(trim($entity->getHeadIcon())):?>
                            <div class="icon-container">
                                <i class="fa <?php echo trim($entity->getHeadIcon())?>"></i>
                            </div>
                            <?php endif;?>
                            <?php /*
                            <img src="<?php echo $entity->getImageLink();?>" alt="" class="img-responsive center-block"/>
                            */?>
                        </div>
                        <div class="box-3-title">
                            <?php echo $entity->getHeadText();?>
                        </div>
                        <div class="box-3-content">
                            <?php echo $entity->getContent();?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
<?php endif;?>