<?php
    $entity = $banner;
    include_partial(
        "site/parts/site_id", [
            "entity" => $entity->getSite()
        ]
    );
?>