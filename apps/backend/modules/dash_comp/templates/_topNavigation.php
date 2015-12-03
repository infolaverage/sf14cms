<div class="top-menu">
    <ul class="nav navbar-nav pull-right">

        <li class="dropdown dropdown-user dropdown-dark">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <span class="username username-hide-on-mobile">
                    <?php echo $sf_user->getGuardUser()->getUsername() ?>
                </span>
                <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                <!-- <img alt="" class="img-circle" src="../../assets/admin/layout4/img/avatar9.jpg"/>-->
            </a>
            <ul class="dropdown-menu dropdown-menu-default">
                <li>
                    <a href="<?php echo url_for("sf_guard_signout")?>">
                        <i class="icon-key"></i> Log Out </a>
                </li>
            </ul>
        </li>
    </ul>

    <!--<a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-login"></i></a>-->

</div>