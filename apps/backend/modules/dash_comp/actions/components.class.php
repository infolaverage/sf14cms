<?php

class dash_compComponents extends sfComponents
{
    public function executeTopNavigation(sfWebRequest $request)
    {

    }// end executeTopNavigation()


    public function executeSidebar(sfWebRequest $request)
    {
        $menus = ["banner", "cms", "option_key", "site", "site_menu", "site_setting", "contact"];

        $this->user = $this->getUser();
        $this->menuItems = [
            /*[
                'title' => 'Cms',
                'class' => 'Cms',
                'href' => '@cms',
                'icon' => 'fa fa-text-o',
                'permissions' => ['admin'],
            ],*/

            [
                'href'          => '',
                'class'         => 'Cms',
                'title'         => 'Cms',
                'icon'          => 'fa fa-file-text-o',
                'permissions'   => ['admin'],
                'submenus'      => [
                    [
                        'title'         => 'Cms',
                        'href'          => '@cms',
                        'class'         => 'Cms',
                        'icon'          => 'fa fa-file-text-o',
                        'permissions'   => ['admin'],
                    ],
                    [
                        'title'         => 'SiteMenu',
                        'href'          => '@site_menu',
                        'class'         => 'SiteMenu',
                        'icon'          => 'fa fa-list',
                        'permissions'   => ['admin'],
                    ],
                    [
                        'title'         => 'Service',
                        'href'          => '@service',
                        'class'         => 'Service',
                        'icon'          => 'fa fa-gears',
                        'permissions'   => ['admin'],
                    ],
                    [
                        'title'         => 'Reference',
                        'href'          => '@reference',
                        'class'         => 'Reference',
                        'icon'          => 'fa fa-check',
                        'permissions'   => ['admin'],
                    ],
                    [
                        'title'         => 'TeamMember',
                        'href'          => '@team_member',
                        'class'         => 'TeamMember',
                        'icon'          => 'fa fa-users',
                        'permissions'   => ['admin'],
                    ],

                ]
            ],
            [
                'href'          => '',
                'class'         => 'Banner',
                'title'         => 'Banner',
                'icon'          => 'fa fa-picture-o',
                'permissions'   => ['admin'],
                'submenus'      => [
                    [
                        'title'         => 'Banner',
                        'href'          => '@banner',
                        'class'         => 'Banner',
                        'icon'          => 'fa fa-picture-o',
                        'permissions'   => ['admin'],
                    ],

                ]
            ],
            [
                'href'          => '',
                'class'         => 'Site',
                'title'         => 'Site',
                'icon'          => 'fa fa-globe',
                'permissions'   => ['admin'],
                'submenus'      => [
                    [
                        'title'         => 'Site',
                        'href'          => '@site',
                        'class'         => 'Site',
                        'icon'          => 'fa fa-list',
                        'permissions'   => ['admin'],
                    ],

                ]
            ],
            [
                'href'          => '@contact',
                'class'         => 'Contact',
                'title'         => 'Contact',
                'icon'          => 'fa fa-envelope-o',
                'permissions'   => ['admin'],
                /*'submenus'      => [
                    [
                        'title'         => 'Site',
                        'href'          => '@site',
                        'class'         => 'Site',
                        'icon'          => 'fa fa-list',
                        'permissions'   => ['admin'],
                    ],
                ]*/
            ],
            [
                'title'         => 'User administration',
                'href'          => '',
                'class'         => 'User administration',
                'icon'          => 'fa fa-users',
                'permissions'   => ['admin'],
                'submenus'      => [
                    [
                        'title'         => 'Users',
                        'href'          => '@sf_guard_user',
                        'class'         => 'Users',
                        'icon'          => 'icon-user',
                        'permissions'   => ['admin']
                    ],
                ]
            ],
        ];


        foreach($this->menuItems as $key => $e)
        {
            if (($e['href'] != "") && (!isset($e['class']))) {
                $e['class'] = str_replace("@", "", $e['href']);
                $this->menuItems[$key] = $e;
            }

            if (isset($e["submenus"])) {
                foreach ($e["submenus"] as $skey => $se) {
                    if (($se['href'] != "") && (!isset($se['class']))) {
                        $se['class'] = str_replace("@", "", $se['href']);
                        $this->menuItems[$key]["submenus"][$skey] = $se;
                    }

                    if (isset($se["submenus"])) {
                        foreach ($se["submenus"] as $sskey => $sse) {
                            if (($sse['href'] != "") && (!isset($sse['class']))) {
                                $sse['class'] = str_replace("@", "", $sse['href']);
                                $this->menuItems[$key]["submenus"][$skey]["submenus"][$sskey] = $sse;
                            }
                        }
                    }

                }
            }
        }
//        var_dump($this->menuItems); die();
    }// end executeSidebar()


}// end class