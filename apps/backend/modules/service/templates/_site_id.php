<?php
    /**
     * @var Service $entity
     */
    $entity = $service;
    include_partial(
        "site/parts/site_id", [
            "entity" => $entity->getSite()
        ]
    );
?>