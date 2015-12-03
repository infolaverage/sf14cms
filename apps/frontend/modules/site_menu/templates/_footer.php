<div class="footer-menu-container">
    <ul class="ul-1">
        <?php if(!is_null($menu)):?>
            <?php foreach($menu as $m):?>
                <?php if(!$m["is_active"]){ continue; }?>
                <?php
                $url = isset($m["url"]) ? $m["url"] : "#";
                if (isset($m["url_predefined"]) && $m["url_predefined"]){
                    $url = SeoUrlHelper::unescapeUrlPredefinedChoice($m["url_predefined"]);

                    $rt_params = isset($url["paramteres"]) ? $url['parameters'] : [];

                    if(isset($url["route_name"])){
                        if($url["route_name"] == "contact"){
                            $url = SeoUrlHelper::contact();
                        }
                    }
                    if(isset($url["route_name"])) {
                        if (is_array($url)) {
                            $url = url_for("@" . $url["route_name"], $rt_params);
                        }
                    }
                }
                ?>
                <li>
                    <a href="<?php echo $url?>">
                        <i class="fa fa-angle-right"></i>
                        <span>
                            <?php echo isset($m["text"])?$m["text"]:"..."?>
                        </span>
                    </a>
                </li>
            <?php endforeach;?>
        <?php endif;?>
    </ul>
</div>