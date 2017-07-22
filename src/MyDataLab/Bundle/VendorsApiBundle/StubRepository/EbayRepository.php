<?php

namespace MyDataLab\Bundle\VendorsApiBundle\StubRepository;

use DTS\eBaySDK\Finding\Services\FindingService;
use DTS\eBaySDK\Finding\Types\FindItemsAdvancedRequest;
use DTS\eBaySDK\Shopping\Services\ShoppingService;
use DTS\eBaySDK\Shopping\Types\GetSingleItemRequestType;
use DTS\eBaySDK\Trading\Services\TradingService;
use DTS\eBaySDK\Trading\Types\GetItemRequestType;
use MyDataLab\Bundle\VendorsApiBundle\StubEntity\EbayItem;
use DTS\eBaySDK\Constants;
use \DTS\eBaySDK\Finding\Types;
use MyDataLab\Bundle\VendorsApiBundle\StubEntity\VendorItem;

class EbayRepository
{
    private $findingService;
    private $shoppingService;

    /**
     * EbayRepository constructor.
     * @param string $appId
     * @param string $certId
     * @param string $devId
     */
    function __construct($appId, $certId, $devId)
    {
        $this->findingService = new FindingService([
            'apiVersion' => '1.13.0',
            'siteId'     => Constants\GlobalIds::US,
            'credentials' => [
                'appId'  => $appId,
                'certId' => $certId,
                'devId'  => $devId
            ]
        ]);

        $this->shoppingService = new ShoppingService([
            'apiVersion' => '903',
            'siteId'     => Constants\GlobalIds::US,
            'credentials' => [
                'appId'  => $appId,
                'certId' => $certId,
                'devId'  => $devId
            ]
        ]);
    }

    /**
     * Finds an object by its primary key / identifier.
     *
     * @param mixed $id The identifier.
     *
     * @return object|null The object.
     */
    public function find($id){
        $request = new GetSingleItemRequestType();
        $request->ItemID = (string)$id;

        $result = $this->shoppingService->getSingleItem($request);
        $result = $result->Item;

        $item = new VendorItem();
        $item->setId($result->ItemID);
        $item->setTitle($result->Title);
        $item->setPrice($result->ConvertedCurrentPrice->value);
        $item->setCurrency($result->ConvertedCurrentPrice->currencyID);
        $item->setDescription($result->Subtitle);
        $item->setUrl($result->Location);

        return $item;
    }

    /**
     * Finds objects by a set of criteria.
     *
     * Optionally sorting and limiting details can be passed. An implementation may throw
     * an UnexpectedValueException if certain values of the sorting or limiting details are
     * not supported.
     *
     * @param array      $criteria
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return array The objects.
     *
     * @throws \UnexpectedValueException
     */
    public function findBy(array $criteria, $limit = null, $offset = null)
    {
        $pageNum = null;
        $request = new FindItemsAdvancedRequest();

        foreach ($criteria as $key => $value){
            if($aliasKey = EbayItem::getRepositoryAliasKeyBy($key, 'repositoryName')){
                $request->{$aliasKey} = $value;
            }
            else if($aliasKey = EbayItem::getAliasKey(EbayItem::getRepositoryAliasKeyBy($key, 'elementName'))){
                $request->{$aliasKey} = $value;
            }
            else if(EbayItem::getRepositoryAliasKeyBy($key)){
                $request->{$aliasKey} = $value;
            }
            else{
                throw new \InvalidArgumentException('Not possible to query API for '.$key.' argument.');
            }
        }
        $response = $this->findingService->findItemsAdvanced($request);

        $request->paginationInput = new Types\PaginationInput();
        if ($limit){
            $request->paginationInput->entriesPerPage = $limit;
            $pageNum = ($offset + $limit)/$limit;
        }
        if($pageNum){
            $request->paginationInput->pageNumber = $pageNum;
        }

        $items = [];
        foreach ($response->searchResult->item as $item) {
            $ebayApi = new VendorItem();
            $ebayApi->setId($item->itemId);
            $ebayApi->setTitle($item->title);
            $ebayApi->setDescription($item->subtitle);
            $ebayApi->setUrl($item->viewItemURL);
            $ebayApi->setPrice($item->sellingStatus->currentPrice->value);
            $ebayApi->setCurrency($item->sellingStatus->currentPrice->currencyId);
            $items[] = $ebayApi;
        }

        return $items;
    }

    /**
     * Finds a single object by a set of criteria.
     *
     * @param array $criteria The criteria.
     *
     * @return object|null The object.
     */
    public function findOneBy(array $criteria){
        return $this->findBy($criteria, 1)[0];
    }
}