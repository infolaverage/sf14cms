<?php if(isset($entities) && $entities):?>
    <div class="row">
        <?php foreach($entities as $entity):?>
            <?php
            /**
             * @var Banner $entity
             */

           $f_href = $entity->getFinalUrl();
            ?>
            <div class="col-md-8">
                <div class="box-2-container">
                    <div class="box-2">
                        <div class="box-2-header">
                            <a href="<?php echo $f_href?>">
                                <img src="<?php echo $entity->getImageLink();?>" alt="" class="img-responsive center-block"/>
                            </a>
                        </div>
                        <div class="box-2-title">
                            <a href="<?php echo $f_href?>">
                                <?php echo $entity->getHeadText();?>
                            </a>
                        </div>
                        <?php $text = str_replace(" ", "", strip_tags($entity->getContent(ESC_RAW)));?>
                        <?php if($text):?>
                        <div class="box-2-content">
                            <?php echo $entity->getContent(ESC_RAW);?>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
<?php endif;?>