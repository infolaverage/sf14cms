<?php
    /**
     * @var Contact $entity
     */
    $entity = $contact;
    include_partial(
        "site/parts/site_id", [
            "entity" => $entity->getSite()
        ]
    );
?>