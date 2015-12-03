<?php slot("breadcrumbs")?>
<?php include_partial("general/breadcrumbs", ["breadcrumbs"=>$breadcrumbs]);?>
<?php end_slot()?>



<div class="row">
    <div class="col-sm-12">
        <?php include_partial("cms/compCms", ["entity"=>$cms])?>


        <div class="sep-1-a"></div>


        <div class="box-4-container">
            <div class="box-4">

                <div class="box-4-content">
                    <strong class="h3">
                    <?php echo $site->getCurrentSiteSetting("organization_name")?><br/>
                    <?php echo $site->getCurrentSiteSetting("organization_main_office")?>
                    </strong>
                    <br/>
                    <br/>
                </div>

                <div class="box-4-footer">

                    <?php if($site):?>
                        <?php foreach($site->getFinalContactPhones() as $phone):?>
                            <div class="">
                                <a href="<?php echo SeoUrlHelper::contact()?>">
                                    <i class="fa fa-phone"></i>
                                    <?php echo $phone;?>
                                </a>
                            </div>
                        <?php endforeach;?>

                        <br/>

                    <?php endif;?>
                </div>
            </div>
        </div>

        <br/>
        <br/>



    </div>
    <div class="col-sm-11 col-sm-offset-1">
        <div class="h1">&nbsp;</div>
        <?php if(isset($form)):?>
            <?php include_partial("contact/form/form", ["form"=>$form])?>
        <?php endif;?>



    </div>
</div>