<?php
    class BackendCustomSiteSettingsForm extends sfForm{

        public function configure() {
            $this->manageSiteIdField();
            $this->manageSiteSettingsFields();
            $this->widgetSchema->setNameFormat("settings[%s]");
        }

        protected function manageSiteIdField(){
            $this->widgetSchema["site_id"] = new sfWidgetFormInputHidden();
            $this->widgetSchema["site_id"]->setDefault($this->getOption("required_site_id"));
            $this->validatorSchema["site_id"] = new sfValidatorChoice(
                array(
                    "choices" => array($this->getOption("required_site_id")),
                    "required" => true
                )
            );
        }

        protected function manageSiteSettingsFields(){
            $site_setting_keys = OptionKeyTable::getEditableOptionKeys();
            foreach($site_setting_keys as $site_setting_key){
                $this->widgetSchema[$site_setting_key] = $this->getWidgetFor($site_setting_key);
                $this->validatorSchema[$site_setting_key] = $this->getValidatorFor($site_setting_key);
                $this->getWidgetSchema()->setHelp($site_setting_key, $this->getHelpFor($site_setting_key));
                $this->widgetSchema[$site_setting_key]->setDefault($this->getDefaultFor($site_setting_key));
            }
        }

        protected function getWidgetFor($field) {
            return OptionKeyTable::getWidgetFor($field);
        }

        protected function getvalidatorFor($field) {
            return OptionKeyTable::getValidatorFor($field);
        }

        protected function getHelpFor($field){
            return OptionKeyTable::getHelpFor($field);
        }

        protected function getDefaultFor($field){

            $default        = null;
            $key            = $field;
            $setting_keys   = OptionKeyTable::getEditableOptionKeys();
            if(in_array($key, $setting_keys)){
                /**
                 * @var Site $site
                 */
                $site = SiteTable::getInstance()->find($this->getOption("required_site_id"));
                if($site){
                    $option_key = OptionKeyTable::getOptionkeyByName($key);
                    if($option_key){
                        $default = $site->getCurrentSiteSetting($key);
                    }
                    /*$current_setting = SiteSettingTable::getSiteSettingBySiteAndOptionKey($site->id, $option_key->id);
                    if($current_setting){
                        foreach($current_setting as $current_s){

                            $default = $current_s
                            //TODO : multiple !
                        }
                }*/
                }
            }

            return $default;
        }


        public function getFormFieldsets(){

            $fieldsets = array(
                "site" => array(
                    "site_brand_name"
                ),
                "mail" => array(
                    "mail_contact_subject",
                    "mail_contact_address",
                    "mail_noreply_address",
                ),
                "contact" => array(
                    "contact_email_address_1",
                    "contact_phone_1",
                    "contact_address_1",
                    "contact_map_html_1",
                    "contact_has_attachment"
                ),
                "organization" => array(
                    "organization_name",
                    "organization_main_office",
                    "organization_company_registration_number",
                    "organization_company_tax_number",
                ),
                "social" => array(
                    "social_facebook_page",
                    "social_twitter_page",
                    "social_pinterest_page",
                    "social_addthis_enabled",
                    "social_addthis_app_id",
                ),
                "seo" => array(
                    #"google_analytics_enabled",
                    #"google_analytics_ua_code",
                    "seo_html_title",
                    "seo_meta_title",
                    "seo_meta_description",
                    "seo_meta_robots",
                    "robots_txt",
                    "sitemap_enabled",
                ),
                "geo" => array(
                    "seo_geo_title",
                    "seo_geo_region",
                    "seo_geo_placename",
                    "seo_geo_position_lat",
                    "seo_geo_position_lng",
                ),
                "i18n" => array(
                    "i18n_available_cultures",
                    "i18n_available_cultures_default",
                ),
                "google_tools" => array(
                    "google_analytics_ua_code",
                    "google_analytics_enabled",
                ),
                "index_slug" => array(
                    "index_slug_contact",
                    "index_slug_gallery",
                    "index_slug_faq",
                    "index_slug_blog_entry",
                    "index_slug_team_member" ,
                    "index_slug_service"     ,
                    "index_slug_reference"   ,
                )

            );
            return $fieldsets;
        }

        public function customSave(){
            $values = $this->getValues();
            $result = false;
            /**
             * @var Site $site
             */
            $site = SiteTable::getInstance()->find($values["site_id"]);
            if($site){
                $setting_keys = OptionKeyTable::getEditableOptionKeys();
                foreach($values as $key => $value){
                    if(in_array($key, $setting_keys)){
                        $site->setCurrentSiteSetting($key, $value, true, null);
                    }
                }
                $result = true;
            }

            return $result;
        }

    }