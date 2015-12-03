<?php /* ========================================================================================================== */?>
<?php /* LOGGED IN */?>
<?php /* ========================================================================================================== */?>
<?php
    /**
     * @var MyUser $sf_user
     */
?>
<?php if($sf_user->isAuthenticated()):?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<link rel="shortcut icon" href="/favicon.ico" />
    <?php //include_stylesheets() ?>
    <?php //include_javascripts() ?>
    <?php include_partial('dash_comp/head/css') ?>
    <?php include_partial('dash_comp/head/js') ?>
    <?php $sf_user->setCulture("hu")?>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">

    <div class="page-header navbar navbar-fixed-top">
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner">
                <div class="page-logo">
                    <a href="<?php echo url_for('homepage') ?>">
                        <?php /*
                        <img src="/resources/backend/images/logo.png"
                             alt=""
                             class="logo-default"
                        />
                        */?>
                    </a>
                    <div class="menu-toggler sidebar-toggler"></div>
                </div>
                <a
                    href="javascript:;"
                    class="menu-toggler responsive-toggler"
                    data-toggle="collapse"
                    data-target=".navbar-collapse">
                </a>
                <div class="page-top">
                    <?php include_component('dash_comp', 'topNavigation'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="page-container">
        <?php include_component('dash_comp', 'sidebar'); ?>
        <div class="page-content-wrapper">
            <div class="page-content">

                <div class="page-head">
                    <div class="page-title">
                        <?php include_slot("page_title")?>
                    </div>
                    <div class="page-toolbar">
                        <?php include_slot("page_toolbar")?>
                    </div>
                </div>

                <?php include_slot("page_breadcrumb")?>

                <?php echo $sf_content ?>
            </div>
        </div>
    </div>

  </body>
</html>
<?php else:?>
<!DOCTYPE html>
<html>
    <head>

        <?php $base_dir = "/resources/login"?>
        <link href="<?php echo $base_dir?>/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $base_dir?>/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $base_dir?>/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $base_dir?>/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo $base_dir?>/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME STYLES -->
        <link href="<?php echo $base_dir?>/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $base_dir?>/global/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $base_dir?>/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $base_dir?>/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="<?php echo $base_dir?>/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

    </head>
    <body class="login">
        <div class="content">
            <?php echo $sf_content?>
        </div>
    </body>
</html>
<?php endif;?>
