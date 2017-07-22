<?php

namespace MyDataLab\Bundle\CrawlerBundle;

use MyDataLab\Bundle\RetailersBundle\Entity\Retailer;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

class Crawler
{

    /**
     *
     * @var string
     */
    private $rootDir;

    /**
     *
     * @var RequestStack
     */
    private $requestStack;

    /**
     *
     * @var RouterInterface
     */
    private $router;

    /**
     *
     * @var DebugLoggerInterface
     */
    private $logger;

    const LOCATION = 'retailers';

    public function __construct(RequestStack $requestStack, RouterInterface $router, DebugLoggerInterface $logger, $rootDir)
    {
        $this->requestStack = $requestStack;
        $this->router = $router;
        $this->logger = $logger;
        $this->rootDir = $rootDir;
    }

    /**
     * Returns the folder location
     * @example '/var/www/mydatalaboratory.com/web/retailers/1/'
     * @param Retailer $retailer
     * @return string
     */
    private function getDownloadPath()
    {
        $dir = \implode(DIRECTORY_SEPARATOR, [
            $this->rootDir,
            '..',
            'web',
            self::LOCATION,
        ]);
        return $dir;
    }

    public function getDownloadedFileAbsoluteLocation(Retailer $retailer)
    {
        return $this->getDownloadPath() . '/' . $retailer->getId() . '.html';
    }

    public function getDownloadedFileURL(Retailer $retailer)
    {
        $request = $this->requestStack->getCurrentRequest();
        $host = $request->getScheme() . '://' . $request->getHost();
        return \implode('/', [
            $host,
            self::LOCATION,
            $retailer->getId() . '.html',
        ]);
    }

    public function downloadPageByRetailer(Retailer $retailer)
    {
        $productPage = $retailer->getProductPage();
        $dir = $this->getDownloadPath();
        \chdir($dir);
        $command = 'wget --convert-links  '
//        $command = 'wget -r --page-requisites --no-parent '
                . $productPage
                . ' -O ' . $retailer->getId() . '.html ';
        $this->logger->info('STARTING DOWNLOADING');
        
        $this->logger->info('EXECUTING: ' . $command);
        $output = [];
        $result = \exec($command, $output);
        $this->logger->info($result);
        foreach ($output as $line) {
            $this->logger->info($line);
        }
        $this->logger->info('FINISHED DOWNLOADING');
//        $file = $this->getDownloadedFileAbsoluteLocation($retailer);
//        $this->pageContent = \file_get_contents($file);
//        \file_put_contents($file, $this->pageContent);
        return [
            'url' => $this->router->generate('my_data_lab_crawler_config', [
                'retailerId' => $retailer->getId(),
            ])
//            'url' => $this->getDownloadedFileURL($retailer),
        ];
    }

}
