<?php

namespace MyDataLab\Bundle\AdminBundle\Service;

use WhiteOctober\BreadcrumbsBundle\Model\Breadcrumbs;
use Symfony\Component\Routing\RouterInterface;

class BreadcrumbsBuilder
{

    /**
     *
     * @var Breadcrumbs
     */
    private $breadctumbs;

    /**
     *
     * @var RouterInterface
     */
    private $router;

    /**
     *
     * @var array
     * 
     * @todo move this to a config, couldn't fast, so I had to move on...
     * 
     */
    private $config = [
        //homepage
        'my_data_lab_admin_dashboard' => [
            'text' => 'Dashboard',
        ],
        'my_data_lab_admin_contact_us' => [
            'text' => 'Contact Us',
            'parent' => 'my_data_lab_admin_dashboard',
        ],
        //prices
        'my_data_lab_prices_homepage' => [
            'text' => 'Prices',
            'parent' => 'my_data_lab_admin_dashboard',
        ],
        'my_data_lab_prices_product' => [
            'text' => 'Products',
            'parent' => 'my_data_lab_prices_homepage',
        ],
        'my_data_lab_prices_product_single' => [
            'text' => 'Single Product',
            'parent' => 'my_data_lab_prices_product',
        ],
        'my_data_lab_prices_category' => [
            'text' => 'Categories',
            'parent' => 'my_data_lab_prices_homepage',
        ],
        'my_data_lab_prices_brand' => [
            'text' => 'Brands',
            'parent' => 'my_data_lab_prices_homepage',
        ],
        'my_data_lab_prices_competitor_list' => [
            'text' => 'Competitors / E-Retailers',
            'parent' => 'my_data_lab_prices_homepage',
        ],
        //alerts
        'my_data_lab_alert_homepage' => [
            'text' => 'Alerts',
            'parent' => 'my_data_lab_admin_dashboard',
        ],
        'my_data_lab_alert_list' => [
            'text' => 'Alerts List',
            'parent' => 'my_data_lab_alert_homepage',
        ],
        'my_data_lab_alert_read' => [
            'text' => 'Read Alert',
            'parent' => 'my_data_lab_alert_homepage',
        ],
        'my_data_lab_alert_create' => [
            'text' => 'Create Alert',
            'parent' => 'my_data_lab_alert_homepage',
        ],
        //catalogs
        'my_data_lab_catalog_homepage' => [
            'text' => 'Catalogue',
            'parent' => 'my_data_lab_admin_dashboard',
        ],
        'my_data_lab_catalog_dashboard' => [
            'text' => 'Global Analysis',
            'parent' => 'my_data_lab_catalog_homepage',
        ],
        'my_data_lab_catalog_product_top' => [
            'text' => 'Top products analysis',
            'parent' => 'my_data_lab_catalog_homepage',
        ],
        'my_data_lab_catalog_product_missing' => [
            'text' => 'Missing Products in Catalogue',
            'parent' => 'my_data_lab_catalog_homepage',
        ],
        'my_data_lab_catalog_product_exclusive' => [
            'text' => 'Exclusive Products in Catalogue',
            'parent' => 'my_data_lab_catalog_homepage',
        ],
        //wording
        'my_data_lab_wording_homepage' => [
            'text' => 'Wording',
            'parent' => 'my_data_lab_admin_dashboard',
        ],
        'my_data_lab_wording_dashboard' => [
            'text' => 'Select a product',
            'parent' => 'my_data_lab_wording_homepage'
        ],
        'my_data_lab_wording_keywords_list' => [
            'text' => 'Keywords list',
            'parent' => 'my_data_lab_wording_homepage',
        ],
        'my_data_lab_wording_product_analysis' => [
            'text' => 'Product Analysis',
            'parent' => 'my_data_lab_wording_homepage',
        ],
        //account
        'my_data_lab_user_homepage' => [
            'text' => 'Account',
            'parent' => 'my_data_lab_admin_dashboard',
        ],
        'my_data_lab_user_account' => [
            'text' => 'My Account',
            'parent' => 'my_data_lab_user_homepage',
        ],
        'my_data_lab_user_invoice' => [
            'text' => 'Invoice',
            'parent' => 'my_data_lab_user_homepage',
        ],
        'my_data_lab_blog_homepage' => [
            'text' => 'Blog',
            'parent' => 'my_data_lab_admin_dashboard',
        ],
    ];

    public function __construct(Breadcrumbs $breadcrumbs, RouterInterface $router)
    {
        $this->breadctumbs = $breadcrumbs;
        $this->router = $router;
    }

    public function build($route)
    {
        if (isset($this->config[$route])) {
            $config = $this->config[$route];
            $this->breadctumbs->prependItem($config['text'], $this->router->generate($route));
            if (isset($config['parent'])) {
                $this->build($config['parent']);
            }
        }
    }

}
