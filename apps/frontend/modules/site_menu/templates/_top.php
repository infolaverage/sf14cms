<?php
    $top_nav_class = has_slot("top_navigation_class") ? get_slot("top_navigation_class") : null;
    /**
     * @var Site $site
     */
    $site = Site::getCurrent();

?>
<nav class="navbar navbar-default navbar-fixed-top navbar-s-1 <?php echo $top_nav_class?>">
    <div class="">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar top-bar"></span>
                <span class="icon-bar middle-bar"></span>
                <span class="icon-bar bottom-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo url_for("homepage")?>">

                <?php if($site->getFinalNavbarBrandImgLink()):?>
                    <img src="<?php echo $site->getFinalNavbarBrandImgLink()?>" alt="<?php echo $site->getCurrentSiteSetting("site_brand_name")?>"/>
                    <span class="visible-xs">
                        <?php echo $site->getCurrentSiteSetting("site_brand_name");?>
                    </span>
                <?php else:?>
                    <?php echo $site->getCurrentSiteSetting("site_brand_name");?>
                <?php endif;?>

            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php
                $context = sfContext::getInstance();
                $routing = $context->getRouting();
                $uri = $context->getRequest()->getUri();
            ?>
            <ul class="nav navbar-nav">
                <?php if(!is_null($menu)):?>
                    <?php foreach($menu as $m):?>
                    <?php if(!$m["is_active"]){ continue; }?>
                    <?php
                    $is_active = false;
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

                    $is_on_end = false; #Project::endsWith($uri, $url);
                    $is_active = $is_on_end;
                    //echo ".".$is_on_end;
                    $m_class_arr = array();
                    $m_li_class = array();
                    if($is_active) {
                        $m_li_class[] = "active";
                    }
                    if(isset($m["class"])) {
                        $m_class_arr[] = $m["class"];
                    }
                    $m_class = implode(" ", $m_class_arr);
                    $m_li_class = implode(" ", $m_li_class);
                    ?>
                    <li class="<?php echo $m_li_class?>">
                        <a href="<?php echo $url?>" <?php if($m_class):?>class="<?php echo $m_class?>"<?php endif;?>>
                            <span>
                                <?php echo isset($m["text"])?$m["text"]:"..."?>
                            </span>
                        </a>
                    </li>
                <?php endforeach;?>
                <?php endif;?>
            </ul>

            <div class="nav navbar-nav navbar-right hidden-xs">
                <?php if($site):?>
                <li>
                    <?php foreach($site->getFinalContactPhones() as $phone):?>
                    <a href="<?php echo SeoUrlHelper::contact()?>" class="inline-block">
                        <i class="fa fa-phone"></i>
                        <?php echo $phone;?>
                    </a>
                    <?php endforeach;?>
                </li>
                <?php endif;?>
                <?php /*
                <?php if($site):?>
                <li>
                    <?php foreach($site->getFinalContactEmailAddresses() as $mail):?>
                    <a href="<?php echo SeoUrlHelper::contact()?>" class="inline-block">
                        <i class="fa fa-envelope"></i>
                        <?php echo $mail;?>
                    </a>
                    <?php endforeach;?>
                </li>
                <?php endif;?>
                */?>
            </div>

        </div>
    </div>
</nav>