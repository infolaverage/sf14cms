<?php

    /**
     * contact actions.
     *
     * @package    s14cms
     * @subpackage contact
     * @author     Your name here
     * @version    SVN: $Id$
     */
    class contactActions extends sfActions
    {

        public function preExecute(){
            /**
             * @var Site $site
             */
            $this->site = Site::getCurrent();
        }

        /**
         * Executes index action
         *
         * @param sfRequest $request A request object
         */
        public function executeIndex(sfWebRequest $request)
        {
            /**
             * @var Site $site
             */
            $site = $this->site;
            $cms = null; //$site->getCmsObject('contact');
            $cms = $site->getCmsObject('contact');


            $standard_url = SeoUrlHelper::contact();
            $breadcrumbs = array(
                array(
                    "link"  => $standard_url,
                    "text"  => "Kapcsolat",
                    "title" => "Kapcsolat"
                )
            );


            /*
            $general_seo_translated = Contact::getIndexGeneralSeoHelperTranslated(array(
                "type" => "contact_index",
                "args" => array("%1%" => $site->getFinalName())
            ));
            Project::createAndSetMetaData($this->getResponse(), $general_seo_translated);
            */

            $form = new FrontendContactForm(
                array(),
                array("required_site_id" => $site->getId())
            );

            if($request->isMethod("post")){
                $form->bind(
                    $request->getParameter($form->getName()),
                    $request->getFiles($form->getName())
                );

                if($form->isValid()){
                    $ip = $_SERVER["REMOTE_ADDR"];
                    $form->updateObject();
                    $contact = $form->getObject();
                    $contact['ip_address'] = $ip;

                    $cName      = strip_tags($contact->getName());
                    $cMail      = strip_tags($contact->getMail());
                    $cPhone     = strip_tags($contact->getPhone());
                    $cMessage   = strip_tags($contact->getMessage());

                    $contact->setName($cName);
                    $contact->setMail($cMail);
                    $contact->setPhone($cPhone);
                    $contact->setMessage($cMessage);

                    $contact->setClientInfo($_SERVER['HTTP_USER_AGENT']);
                    $contact->setSentFrom('contact_page');
                    $contact->setSentFrom($request->getParameter('sent_from'));
                    $contact->save();

                    #$contact['language'] = $this->getUser()->getCulture();
                    $contact->save();

                    $this->getUser()->setFlash('success', Translate::from("flash:contact:success:thank_you"), true);
                    $redirect_url = $standard_url;

                    $contact_thank_you_cms = null; #$site->getCmsObject("contact_thank_you");
                    #if($contact_thank_you_cms){
                    #    $redirect_url = SeoUrlHelper::content_show($contact_thank_you_cms);
                    #}

                    //MAIL:
                    $mail_notification_addresses    = [];
                    if(count($site->getFinalSettingMailContactAddresses())){
                        $mail_notification_addresses = $site->getFinalSettingMailContactAddresses();
                    }
                    $mail_notification_addresses[]  = "tamas.barkaszi+dev@infolaverage.hu";
                    $mail_no_reply_address          = $site->getFinalSettingMailNoreplyAddress();
                    $mail_contact_subject           = $site->getFinalSettingMailContactSubject();




                    if(count($mail_notification_addresses) && $mail_no_reply_address){

                        $mail_attachment = "#";//$contact->getFinalAttachmentWebLink(true);
                        //$attachment_part = '<a href="'.$mail_attachment.'" target="_blank">Attachment</a>';
                        //$mail_contact_subject = "Contact Mail Received";
                        $body = "<h2>".$mail_contact_subject."</h2>".
                            "<hr/>".
                            "".
                            "<table>".
                            "<tr><th>Name  :    </th><td>". $contact->name . "</td></tr>" .
                            "<tr><th>Email :    </th><td>". $contact->mail . "</td></tr>" .
                            "<tr><th>Phone :    </th><td>". $contact->phone. "</td></tr>" .
                            "</table>".
                            "<hr/>".
                            "<h3>Message</h3>".
                            "".
                            "". $contact->message ."\n".
                            "<br/>".
                            "<br/>".
                            //"<br/>". $attachment_part .
                            "<br/>".
                            "<hr/>";

                        foreach($mail_notification_addresses as $notification_address){

                            $message = $this->getMailer()->compose(
                            //array($contact->mail => $contact->name)                   // from
                                array($mail_no_reply_address => $mail_no_reply_address),    // from
                                //[$notification_address => $notification_address],           // to
                                $notification_address,                                      // to
                                $mail_contact_subject                                       // subject
                            );
                            $message->setBody($body, 'text/html');



                            $this->getMailer()->send($message);
                            /*
                            Project::prePrint($mail_contact_subject);
                            Project::prePrint($mail_no_reply_address);
                            Project::prePrint($body);
                            Project::prePrint($notification_address);
                            exit;
                            */
                            #Project::prePrint($mail_no_reply_address,0,"FROM:");
                            #Project::prePrint($notification_address,0,"TO:");
                            #Project::prePrint($mail_contact_subject);
                            #echo " ss "; exit;

                        }
                    }

                    //MAIL END

                    $this->getUser()->setAttribute("contact_sent_success", true);

                    $this->redirect($redirect_url, 301);

                } else {
                    $this->getUser()->setFlash('error', Translate::from("flash:contact:error:form_invalid"), false);
                }

            }

            $this->cms          = $cms;
            $this->breadcrumbs  = $breadcrumbs;
            $this->form         = $form;
            $this->site         = $site;

            //echo  Translate::from("flash:contact:success:thank_you");

        }
    }
