<?php

class warmupGeneralTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = '';
    $this->name             = 'warmupGeneral';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [warmupGeneral|INFO] task does things.
Call it with:

  [php symfony warmupGeneral|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    // MOBILE:
    //====================================
    //ionic_application_id
    //ionic_application_public_key
    //ionic_application_secret_key
    //api_version_current
    //api_version_available

    //view_cache_enabled
    //view_cache_delay

    //social_facebook_page
    //social_twitter_page
    //social_pinterest_page
    //social_youtube_page
    //social_googleplus_page

    //robots_txt
    //sitemap_enabled

    //seo_meta_title
    //seo_html_title
    //seo_meta_description
    //seo_meta_robots
    //seo_geo_region
    //seo_geo_placename
    //seo_geo_position_lat
    //seo_geo_position_lng
    //seo_geo_title

    //google_analytics_ua_code
    //google_analytics_enabled
    //social_addthis_enabled
    //social_addthis_app_id


    // I18N
    //====================================
    //i18n_available_cultures
    //i18n_available_cultures_default

    // INDEX SLUGS
    //====================================
    //index_slug_contact
    //index_slug_gallery
    //index_slug_faq
    //index_slug_blog_entry
    //index_slug_team_member
    //index_slug_service
    //index_slug_reference
    //index_slug_product

    // MAIL SLUGS
    //====================================
    //mail_noreply_address

    /*
    site_menu_top_id
    contact_email_address_1
    contact_phone_1
    social_facebook_app_id
    contact_address_1
    organization_name
    organization_main_office
    organization_company_registration_number
    contact_map_html_1
    site_brand_name
    contact_has_attachment
    max_per_page_blog_entry
    mail_contact_address
    mail_contact_subject
    site_menu_footer_id
    */

  }
}
