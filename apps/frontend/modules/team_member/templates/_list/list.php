<?php if(isset($entities)):?>
<div class="team-member-list-container">
    <div class="row">
        <?php foreach($entities as $entity):?>

            <?php include_partial("team_member/list/list_element",["entity"=>$entity])?>

        <?php endforeach;?>
    </div>
</div>
<?php endif;?>