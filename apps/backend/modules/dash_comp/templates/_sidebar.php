<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu">
            <li class="start">
                <a href="<?php echo url_for('homepage') ?>">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <?php
                foreach($menuItems as $e):
                    $perm = sfOutputEscaperArrayDecorator::unescape($e["permissions"]);
                    ?>
                    <?php if ($user->hasCredential($perm, false)):?>
                    <li class="

                    <?php if (isset($e['submenus'])): ?>
                        <?php
                        foreach ($e['submenus'] as $sm)
                        {
                            if (array_key_exists(2, explode('/', substr($sf_request->getUri(), 7))))
                            {
                                if (substr($sm['href'], 1) == explode('/', substr($sf_request->getUri(), 7))[2])
                                {
                                    echo ' active ';
                                }
                            }
                        }
                        ?>
                    <?php endif ?>
                    <?php echo $e['class']; ?>
                    <?php if (isset($e['submenus'])): ?>menu-dropdown classic-menu-dropdown<?php endif; ?>
                        <?php if (array_key_exists(2, explode('/', substr($sf_request->getUri(), 7)))):?>
                            <?php if (explode('/', substr($sf_request->getUri(), 7))[2] == substr($e['href'],1)): ?>active<?php endif ?>
                        <?php endif ?>
                        <?php if (isset($e['submenus'])): ?>
                            <?php if (array_key_exists(2, explode('/', substr($sf_request->getUri(), 7)))): ?>
                                <?php if (array_key_exists(explode('/', substr($sf_request->getUri(), 7))[2], $e['submenus'])): ?>
                                    active
                                <?php endif ?>
                            <?php endif ?>
                        <?php endif ?>
                ">
                        <?php include_partial("dash_comp/list_element", array("e" => $e, "has_sub" => isset($e['submenus'])))?>
                        <?php if(isset($e['submenus'])):?>
                            <ul class="sub-menu">
                                <?php foreach($e['submenus'] as $subkey => $submenu):
                                    $subperm = sfOutputEscaperArrayDecorator::unescape($submenu["permissions"]);
                                    ?>
                                    <?php if ($user->hasCredential($subperm, false)):?>
                                    <li class="
                                    <?php if (array_key_exists(2, explode('/', substr($sf_request->getUri(), 7)))):?>
                                        <?php if (explode('/', substr($sf_request->getUri(), 7))[2] == substr($submenu['href'],1)): ?>active<?php endif ?>
                                    <?php endif ?>
                                    <?php echo $submenu['class']; ?>
                                    <?php if(isset($submenu['submenus'])):?>dropdown-submenu<?php endif;?>
                                    ">
                                        <?php include_partial("dash_comp/list_element", array("e" => $submenu, "is_sub" => true)); ?>
                                        <?php if(isset($submenu['submenus'])):?>
                                            <ul class="dropdown-menu">
                                                <?php foreach($submenu['submenus'] as $ssubkey => $subsubmenu):
                                                    $subsubperm = sfOutputEscaperArrayDecorator::unescape($subsubmenu["permissions"]);
                                                    ?>
                                                    <?php if ($user->hasCredential($subsubperm, false)):?>
                                                    <li class="<?php echo $subsubmenu['class']; ?>">
                                                        <?php include_partial("dash_comp/list_element", array("e" => $subsubmenu, "is_sub" => false)); ?>
                                                    </li>
                                                <?php endif;?>
                                                <?php endforeach;?>
                                            </ul>
                                        <?php endif;?>
                                    </li>
                                <?php endif;?>
                                <?php endforeach;?>
                            </ul>
                        <?php endif;?>
                    </li>
                <?php endif;?>
                <?php endforeach;?>

            <?php if(0 && $user->hasCredential("wunderadmin")):?>
                <li>
                    <a href="/resources_core/backend_core/mnc/v4.1.0/theme/templates/admin4" target="_blank">
                        <i class="icon-puzzle"></i>
                        <span class="title">Theme Preview</span>
                    </a>
                </li>
            <?php endif;?>
        </ul>
    </div>
</div>