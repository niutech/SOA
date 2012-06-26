<?php

namespace Service\GoogleCodeBundle\Controller;

use Service\GoogleCodeBundle\Libraries\Manager as GoogleCodeManager;
use \Library\ManagerBundle\Abstracts\Controller as ControllerAbstract;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends ControllerAbstract
{

    protected function _getManager(Request $request)
    {
        return new GoogleCodeManager($request);
    }

}
