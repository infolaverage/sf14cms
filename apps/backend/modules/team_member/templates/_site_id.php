<?php
    /**
     * @var TeamMember $entity
     */
    $entity = $team_member;
    include_partial(
        "site/parts/site_id", [
            "entity" => $entity->getSite()
        ]
    );
?>