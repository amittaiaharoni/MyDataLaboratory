<?php

namespace MyDataLab\Bundle\FrontendBundle\Twig;

class MDLExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('mdl_page_name', [$this, 'pageName']),
        ];
    }

    /**
     * 
     * @return string
     */
    public function pageName($url)
    {
        $parts = array_values(array_filter(explode('/', $url)));
        return $parts[count($parts) - 1];
    }

    public function getName()
    {
        return 'mdl_page_name';
    }

}
