<?php

/**
 * Contact filter form.
 *
 * @package    s14cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BackendContactFormFilter extends BaseContactFormFilter
{

    use TraitBackendGeneralFilter;

    public function configure()
    {
        $this->manageIdField();
        $this->useFields([
            "id",
            "mail",
            "name",
            "phone",
            "message"
        ]);
    }


}
