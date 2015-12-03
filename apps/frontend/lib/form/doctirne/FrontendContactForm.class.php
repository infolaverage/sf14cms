<?php

/**
 * Contact form.
 *
 * @package    mysymfonyoft
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class FrontendContactForm extends BaseContactForm
{

    use TraitFrontendGeneralForm;

    static $translate_prefix = "contact";
    static $field_html_classes = array(
        "mail"          => "form-control",
        "name"          => "form-control",
        "phone"         => "form-control",
        "message"       => "form-control",
        "attachment"    => "form-control",
    );
    static $field_container_html_classes = array(
        "mail"          => "col-sm-16",
        "name"          => "col-sm-16",
        "phone"         => "col-sm-16",
        "message"       => "col-sm-16",
        "attachment"    => "col-sm-16",
    );


    public function configure()
    {
        unset(
            $this['ip_address'],
            $this['sent_from'],
            $this['client_info'],
            $this['created_at'],
            $this['updated_at']

        );

        $this->manageSiteIdField();
        $this->manageMailField();
        $this->manageNameField();
        $this->managePhoneField();
        $this->manageMessageField();
        //$this->manageAttachmentField();

        $this->useFields([
            "site_id",
            "mail",
            "name",
            "phone",
            "message",

        ]);

        $required_fields = array(
            "name",
            "mail",
            "message",
        );
        foreach ($required_fields as $rf) {
            $this->validatorSchema[$rf]->setOption("required", true);
        }

    }

    protected function manageSiteIdField(){

        $site_id_choices = array();
        if ($this->getOption("required_site_id")) {
            $site_id_option = $this->getOption("required_site_id");
            $site_id_choices[] = $site_id_option;
            $this->setDefault("site_id", $site_id_option);
        }

        $this->widgetSchema['site_id']      = new sfWidgetFormInputHidden();
        $this->validatorSchema['site_id']   = new sfValidatorChoice(array(
            "choices" => $site_id_choices
        ));
    }

    protected function manageMailField(){

        $this->validatorSchema["mail"] = new sfValidatorAnd(array(
            $this->validatorSchema['mail'],
            new sfValidatorEmail()
        ));

    }

    protected function manageNameField(){

    }

    protected function managePhoneField(){

    }

    protected function manageMessageField(){

    }

    protected function manageAttachmentField(){

//        $upload_dir     = DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR.sfConfig::get('app_contact_attachmentsFileWebDir').DIRECTORY_SEPARATOR;
//        $upload_path    = sfConfig::get('sf_upload_dir').sfConfig::get('app_contact_attachmentsFileWebDir');
//
//        $site = null;
//        /**
//         * @var Site $site
//         */
//        try{
//            $site = Site::getCurrentSiteIdSafely();
//        } catch (Exception $e){}
//
//        try{
//            $site = SiteTable::getActiveEntityById($this->getOption("required_site_id"));
//        } catch (Exception $e){
//
//        }
//
//        if($site && $site->getFinalSettingContactHasAttachment()){
//
//            $upload_dir     = $site->getFinalContactUploadDir(true);
//            $upload_path    = $site->getFinalContactUploadPath();
//
//            //Project::prePrint($upload_dir);
//            //Project::prePrint($upload_path);
//
//            $this->widgetSchema['attachment'] = new sfWidgetFormInputFileEditable(array(
//                'file_src'     => $upload_dir,
//                'edit_mode'    => false,
//                'template'     => '<div class="fileInput">%input%</div>'
//            ));
//
//            $this->validatorSchema['attachment'] = new sfValidatorFile(array(
//                'required'      => false,
//                'path'          => $upload_path,
//            ));
//
//        }

    }
}
