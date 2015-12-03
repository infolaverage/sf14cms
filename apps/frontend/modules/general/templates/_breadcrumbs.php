<?php
    /**
     * @var Site $site
     */
    $site = Site::getCurrent();
    $translate_prefix   = "general:breadcrumbs";
    $f_text             = isset($text) ? $text : "(text)";
    $homepage_text      = Translate::from(array($translate_prefix, "homepage", "text"));
    $homepage_title     = Translate::from(array($translate_prefix, "homepage", "title"));
    if($site->getFinalName()){
        $homepage_text  = $site->getFinalName();
        $homepage_title = $site->getFinalName();
    }

    $homepage_text      = $homepage_text;
    $homepage_title     = $homepage_title; #$site->getFinalName(); #Translate::from("Homepage");

    $breadcrumbs        = sfOutputEscaperArrayDecorator::unescape($breadcrumbs);

    $breadcrumbs_to_display     = array();
    $breadcrumbs_to_display[]   = array(
        "href"  => url_for("@homepage"),
        "title" => $homepage_title,
        "text"  => $homepage_text
    );

    if(isset($breadcrumbs)){
        $bc_count   = count($breadcrumbs);
        $li_class   = "";
        $title      = "";
        $text       = "";

        $bci = 1; foreach($breadcrumbs as $bc){

            $source_suffix  = null;
            $args           = null;
            $text           = "";
            $title          = "";
            $param_options  = null;
            $text_parts     = array(/*$translate_prefix, */$bc['text']/*, "text"*/);
            $title_parts    = null;

            if(isset($bc['title'])){
                $title_parts = array(/*$translate_prefix, */$bc['title'],/*"title"*/);
            }
            else{
                $title_parts = array(/*$translate_prefix, */$bc['text'],/*"text"*/);
            }

            if(isset($bc['translate_params'])){
                $source_suffix  = implode("_", array_keys($bc['translate_params']));
                $param_options  = array("args" => $bc['translate_params']);
                $text_parts[]   = $source_suffix;
                $title_parts[]  = $source_suffix;
            }
            else{

            }

            $text   = Translate::from($text_parts,$param_options);
            $title  = Translate::from($title_parts,$param_options);

            $breadcrumbs_to_display[] = array(
                "href"  => $bc['link'],
                "title" => htmlspecialchars($title),
                "text"  => htmlspecialchars($text)
            );
        }
    }

?>

<div class="">
    <?php //BREADCRUMB NORMAL ?>
    <ul class="breadcrumb hidden-xs">

        <?php $i = 0; foreach($breadcrumbs_to_display as $breadcrumb):?>
            <?php if($i != $bc_count):?>
                <li>
                    <a href="<?php echo $breadcrumb['href']?>" title="<?php echo $breadcrumb['title']?>" class="qt"><?php echo $breadcrumb['text']?></a>
                    <?php //<i class="fa fa-caret-right"></i>?>
                </li>
            <?php else: ?>
                <?php $li_class = "active"?>
                <li class="<?php echo $li_class?> qt" title="<?php echo $breadcrumb['title']?>"><?php echo $breadcrumb['text']?></li>
            <?php endif; ?>

            <?php $i++; endforeach;?>

    </ul>

    <?php //DROPDOWN BREADCRUMB ?>
    <?php /*
    <?php if(count($breadcrumbs_to_display)):?>
        <div class="dropdown visible-xs">

            <?php if(end($breadcrumbs_to_display)):?>
                <?php $last = end($breadcrumbs_to_display);?>
                <button class="btn btn-default dropdown-toggle" type="button" id="mobile-submenu" data-toggle="dropdown">
                    <span class="text"><?php echo $last['text']?></span>
                    <span class="caret"></span>
                </button>
            <?php endif;?>

            <?php if(count($breadcrumbs_to_display)):?>
                <ul class="dropdown-menu" role="menu" aria-labelledby="mobile-submenu">
                    <?php $i = 1; foreach($breadcrumbs_to_display as $breadcrumb):?>


                        <li role="presentation">
                            <a
                                role="menuitem" tabindex="-1"
                                href="<?php echo $breadcrumb['href']?>"
                                title="<?php echo $breadcrumb['title']?>" class="qt"
                                >
                                <?php echo $breadcrumb['text']?>
                            </a>
                        </li>

                        <?php $i++; endforeach;?>

                </ul>
            <?php endif;?>
        </div>
    <?php endif;?>
    */?>

</div>