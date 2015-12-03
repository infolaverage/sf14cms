<?php
    /**
     * @var Reference $entity
     */
?>
<?php if(isset($entity) && $entity):?>

    <?php $f_href = $entity->getVideo()?>


    <div class="reference-list-element">
        <div class="h2 reference-name">
            <a
                href="<?php echo $f_href?>"
                data-rel="jpp[g][title]"
                title="<?php echo $entity->getTitle()?>"
                class="j-pp"
            >
                <?php echo $entity->getTitle()?>
            </a>
        </div>


        <a
            href="<?php echo $f_href?>"
            data-rel="jpp[g][content]"
            title="<?php echo $entity->getTitle()?>"
            class="j-pp"
        >
            <img src="<?php echo $entity->getImageLink()?>" class="img-responsive center-block" alt=""/>
        </a>
        <?php /*
        <a href="images/fullscreen/1.jpg"
           rel="prettyPhoto[pp_gal]"
           title="You can add caption to pictures.">
            <img src="images/thumbnails/t_1.jpg" width="60" height="60" alt="Red round shape" />
        </a>
         <a href="https://www.youtube.com/watch?v=O2dKoyCvfiM" data-rel="jpp[g]" title="" class="j-pp">
            <i class="fa fa-youtube"></i>
        </a>
        */?>


    </div>
<?php endif;?>



<?php /*
    <div class="row">
        <div class="col-sm-6">
            <img src="<?php echo $entity->getImageLink()?>" class="img-responsive center-block" alt=""/>
        </div>
        <div class="col-sm-17 col-sm-offset-1">

            <div class="reference-description ccnt">
                <?php echo $entity->getDescription()?>
            </div>
        </div>
    </div>

    <br/>
    <br/>
    <br/>
*/?>