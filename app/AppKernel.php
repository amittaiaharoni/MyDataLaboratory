<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new WhiteOctober\BreadcrumbsBundle\WhiteOctoberBreadcrumbsBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new MyDataLab\Bundle\AdminBundle\MyDataLabAdminBundle(),
            new MyDataLab\Bundle\PricesBundle\MyDataLabPricesBundle(),
            new MyDataLab\Bundle\AlertsBundle\MyDataLabAlertsBundle(),
            new MyDataLab\Bundle\CatalogsBundle\MyDataLabCatalogsBundle(),
            new MyDataLab\Bundle\WordingBundle\MyDataLabWordingBundle(),
            new MyDataLab\Bundle\UserBundle\MyDataLabUserBundle(),
            new MyDataLab\Bundle\BlogBundle\MyDataLabBlogBundle(),
            new MyDataLab\Bundle\CoreBundle\MyDataLabCoreBundle(),
            new MyDataLab\Bundle\DashboardBundle\MyDataLabDashboardBundle(),
            new MyDataLab\Bundle\FrontendBundle\MyDataLabFrontendBundle(),
            new MyDataLab\Bundle\WidgetBundle\MyDataLabWidgetBundle(),
            new MyDataLab\Bundle\PageRoutingBundle\MyDataLabPageRoutingBundle(),
            new MyDataLab\Bundle\GlossaryBundle\MyDataLabGlossaryBundle(),
            new MyDataLab\Bundle\TranslationBundle\MyDataLabTranslationBundle(),
            new MyDataLab\Bundle\WhitePaperBundle\MyDataLabWhitePaperBundle(),
            new MyDataLab\Bundle\LeadsBundle\MyDataLabLeadsBundle(),
            new MyDataLab\Bundle\VendorsApiBundle\MyDataLabVendorsApiBundle(),
//            new MyDataLab\Bundle\CompetitorsBundle\MyDataLabCompetitorsBundle(),
            new MyDataLab\Bundle\MarketSurveyBundle\MyDataLabMarketSurveyBundle(),
            new MyDataLab\Bundle\RetailersBundle\MyDataLabRetailersBundle(),
            new MyDataLab\Bundle\CrawlerBundle\MyDataLabCrawlerBundle(),
            new MyDataLab\Bundle\ProductBundle\MyDataLabProductBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Bazinga\Bundle\FakerBundle\BazingaFakerBundle();
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
