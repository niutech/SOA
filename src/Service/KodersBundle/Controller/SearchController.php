<?php

namespace Service\KodersBundle\Controller;

use Service\KodersBundle\Libraries\Manager as KodersManager;
use \Library\ManagerBundle\Abstracts\Controller as ControllerAbstract;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends ControllerAbstract
{

    protected function _getManager(Request $request)
    {
        return new KodersManager($request);
    }

}
