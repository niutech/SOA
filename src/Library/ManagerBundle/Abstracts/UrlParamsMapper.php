<?php

namespace Library\ManagerBundle\Abstracts;

use Library\ManagerBundle\Interfaces\UrlParamsMapper as UrlParamsMapperInterface;

abstract class UrlParamsMapper implements UrlParamsMapperInterface
{

    public function mapLanguage($language)
    {
        return $language;
    }

}
