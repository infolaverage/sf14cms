<?php if(isset($entities)):?>
    <div class="h2">
        <a href="<?php echo SeoUrlHelper::content_index("Reference")?>">
            Referenciák
        </a>
    </div>
    <div class="reference-list-container-2">
        <div class="row">
            <?php foreach($entities as $entity):?>
                <?php $f_href = $entity->getVideo()?>
                <div class="col-xs-8 col-sm-6">
                    <div class="reference-list-element-2">
                        <a
                            href="<?php echo $f_href?>"
                            data-rel="jpp[g][sb]"
                            title="<?php echo $entity->getTitle()?>"
                            class="j-pp"
                        >
                            <img
                                src="<?php echo $entity->getImageLink()?>"
                                class="img-responsive center-block"
                                alt=""
                                title="<?php echo $entity->getTitle()?>"
                            />
                        </a>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
<?php endif;?>