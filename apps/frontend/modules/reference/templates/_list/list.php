<?php if(isset($entities)):?>
<div class="reference-list-container">

    <div class="row">
    <?php foreach($entities as $entity):?>
        <div class="col-sm-8">
            <?php include_partial("reference/list/list_element",["entity"=>$entity])?>
        </div>

    <?php endforeach;?>
    </div>

</div>
<?php endif;?>