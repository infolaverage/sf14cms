<?php
    $entity = $site_menu;
    include_partial(
        "site/parts/site_id", [
            "entity" => $entity->getSite()
        ]
    );
?>