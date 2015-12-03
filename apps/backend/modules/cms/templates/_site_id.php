<?php
    /**
     * @var Cms $entity
     */
    $entity = $cms;
    include_partial(
        "site/parts/site_id", [
            "entity" => $entity->getSite()
        ]
    );
?>