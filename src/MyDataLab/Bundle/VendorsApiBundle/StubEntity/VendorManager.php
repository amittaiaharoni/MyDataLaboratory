<?php

namespace MyDataLab\Bundle\VendorsApiBundle\StubEntity;

use MyDataLab\Bundle\VendorsApiBundle\StubRepository\EbayRepository;
use MyDataLab\Bundle\VendorsApiBundle\StubRepository\PriceMinisterRepository;

class VendorManager
{

     // Ebay constants
    /**
     * @var string
     */
        const EBAY_APP_ID = 'SteeveAb-MyDataLa-PRD-32466ad44-180de0e2';
    /**
     * @var string
     */
    const EBAY_CERTIFICATION_ID = 'PRD-2466ad448cf6-99a5-4093-84df-1794';
    /**
     * @var string
     */
    const EBAY_DEVELOPMENT_ID = '82564523-94a2-4a7c-893e-e134eaa863a2';

    // PriceMinister constants
    /**
     * @var string
     */
    const PRICEMINISTER_USERNAME = 'MyDataLab';
    /**
     * @var string
     */
    const PRICEMINISTER_TOKEN = '703f1a484a334bbaa7887cf9d8825b56';


    public function getRepository($vendorEntity)
    {
        $vendorEntity = $this->getEntity($vendorEntity);
        if($vendorEntity === 'EbayItem'){
            return new EbayRepository($this::EBAY_APP_ID, $this::EBAY_CERTIFICATION_ID, $this::EBAY_DEVELOPMENT_ID);
        }
        if($vendorEntity === 'PriceMinisterItem'){
            return new PriceMinisterRepository(self::PRICEMINISTER_USERNAME, self::PRICEMINISTER_TOKEN);
        }
    }

    /**
     * @param string $entityPath
     * @return string array|mixed
     */
    private function getEntity($entityPath)
    {
        $vendorEntity = explode('\\', $entityPath);
        $vendorEntity = end($vendorEntity);
        return $vendorEntity;
    }
}