<?php slot("content_top_outer_1");?>
<?php if(isset($entities) && $entities):?>
    <div class="slider-container">
        <div id="top-slides-1">
            <ul class="slides-container">
                <?php $repeat_until = (sfConfig::get("sf_environment") == "dev") ? 3 : 1;?>
                <?php for($i = 0; $i < $repeat_until; $i++):?>

                <?php foreach($entities as $entity):?>
                        <?php
                        /**
                         * @var Banner $entity
                         */
                        ?>
                        <?php $f_href = $entity->getFinalUrl()?>

                        <li>
                            <img src="<?php echo $entity->getImageLink()?>" alt="">
                            <div class="container">

                                <?php //echo $entity->getHeadText()?>
                                <div class="slider-box-1">
                                    <div class="content">
                                        <?php //echo "#".$i?>
                                        <?php echo $entity->getContent(ESC_RAW)?>
                                    </div>
                                    <div class="actions">
                                        <a href="<?php echo url_for($f_href)?>"
                                           class="btn btn-lg"
                                        >
                                            <?php echo $entity->getTitle();?>
                                        </a>
                                    </div>

                                </div>

                            </div>
                        </li>

                <?php endforeach;?>
                <?php endfor;?>
            </ul>
        </div>

        <?php /*
        <nav class="slides-pagination"><a href="#1" class="">1</a><a href="#2" class="">2</a><a href="#3" class="current">3</a></nav>
        */?>

    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#top-slides-1').superslides({
                "play": 60000,
                "animation": "fade"/*,
                 "inherit_height_from": "slider-container"*/
            });
        });
    </script>
<?php endif;?>

<?php end_slot();?>
