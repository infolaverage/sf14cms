<?php
    $site = Site::getCurrent();
?>
<div class="row">
    <div class="col-sm-11">
        <div class="box-4-container">
            <div class="box-4">

                <?php /*
                <div class="box-4-title title-a">
                    Vedd fel velünk a kapcsolatot!
                </div>
                <div class="box-4-title title-b">
                   Írj nekünk!
                </div>
                <div class="sep-1"></div>
                <div class="clearfix"></div>
                <div class="box-4-content">
                    <p>
                        <span class="bold">
                            Visszahíváshoz vagy árajánlat kéréshez töltsd ki alábbi az formot!
                        </span>
                        <br/>
                        Küldd el  a tervezett rendezvény technikai igényeit és kérdár ajánlatunkat!
                        Keress minket elérhetőségeinken, előzetes egyeztetéssel, tanácsadással is készséggel állunk rendelkezésedre!
                    </p>
                </div>
                */?>
                <?php include_component("cms","compCms",["role"=>"contact_simple"])?>

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
                    <?php endif;?>
                    <?php /*
                    <?php if($site):?>
                        <br/>
                        <?php foreach($site->getFinalContactEmailAddresses() as $mail):?>
                        <div class="">
                            <a href="<?php echo SeoUrlHelper::contact()?>">
                                <i class="fa fa-envelope"></i>
                                <?php echo $mail;?>
                            </a>
                        </div>
                        <?php endforeach;?>
                    <?php endif;?>
                    */?>
                </div>


            </div>
        </div>
    </div>
    <div class="col-sm-12 col-sm-offset-1">
        <?php if(isset($form)):?>
            <?php include_partial("contact/form/form", ["form"=>$form])?>
        <?php endif;?>
    </div>
</div>