<?php
    /**
     * @var Reference $entity
     */
    $entity = $reference;
    include_partial(
        "site/parts/site_id", [
            "entity" => $entity->getSite()
        ]
    );
?>