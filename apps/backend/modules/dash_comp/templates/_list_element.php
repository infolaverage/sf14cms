<?php $f_is_sub     = isset($is_sub) ? $is_sub : false; ?>
<?php $f_has_sub    = isset($has_sub) ? $has_sub : false; ?>
<?php $f_href       = isset($e['href']) ? url_for($e['href']) : "javascript:;"; ?>
<a
    href="<?php echo $f_href?>"
    <?php if(isset($e['onclick'])): ?>onclick="<?php echo $e['onclick']; ?>"<?php endif; ?>
    <?php if(isset($e['rel'])): ?>rel="<?php echo url_for($e['rel']); ?>"<?php endif; ?>
    <?php if(isset($e['target'])): ?>target="<?php echo $e['target']; ?>"<?php endif; ?>
    <?php if(!$f_is_sub && $f_has_sub): ?>
        class="dropdown-toggle"
        data-toggle="dropdown" data-close-others="true" data-hover="megamenu-dropdown"
    <?php endif; ?>
    >
    <i class="<?php echo $e['icon']?>"></i>
    <span class="title">
        <?php if (isset($e["trans_title"])):?>
            <?php echo $e["trans_title"]; ?>
        <?php else: ?>
            <?php echo $e["class"] ?>
        <?php endif; ?>
    </span>

    <?php if ($f_has_sub): ?>
        <span class="arrow"></span>
    <?php endif ?>

    <?php if(isset($e["badges"])): ?>
        <?php foreach($e["badges"] as $badge): ?>
            <span
                class="badge badge-<?php echo $badge["type"]; ?> qt"
                title="<?php echo Translate::from("backend.menu.admin_task_marker.".$badge["task_class"].".".$badge["task_type"]); ?>">
                                <?php echo $badge["content"]; ?>
                            </span>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php /* if(isset($e['submenus'])):?>
        <i class="fa fa-angle-down"></i>
    <?php endif; */ ?>
</a>