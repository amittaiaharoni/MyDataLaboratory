<?php

namespace MyDataLab\Bundle\VendorsApiBundle\StubRepository;


use MyDataLab\Bundle\VendorsApiBundle\StubEntity\PriceMinisterItem;
use MyDataLab\Bundle\VendorsApiBundle\StubEntity\VendorItem;
use Priceminister\PriceministerClient;
use Priceminister\ProductListing;

class PriceMinisterRepository
{
    private $productListing;

    /**
     * PriceMinisterRepository constructor.
     *
     * @param $username string
     * @param $token string
     */
    function __construct($username, $token)
    {
        $client = new PriceministerClient($username, $token);
        $this->productListing = new ProductListing($client);
    }

    /**
     * Finds an object by its primary key / identifier.
     *
     * @param mixed $id The identifier.
     *
     * @return object|null The object.
     */
    public function find($id)
    {
        $this->productListing->setParameter('productids', $id);
        $result = $this->productListing->request();
        $result = $result->getProducts()[0];

        $item = new VendorItem();
        $item->setId($result['id']);
        $item->setTitle($result['values']['name']);
        $item->setUrl($result['values']['url']);
        $item->setImg($result['values']['image']);
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

        foreach ($criteria as $key => $value){
            if($aliasKey = PriceMinisterItem::getRepositoryAliasKeyBy($key, 'repositoryName')){
                $this->productListing->setParameter($aliasKey, $value);
            }
            else if($aliasKey = PriceMinisterItem::getRepositoryAliasKeyBy($key, 'elementName')){
                $this->productListing->setParameter($aliasKey, $value);
            }
            else if(PriceMinisterItem::getRepositoryAliasKeyBy($key)){
                $this->productListing->setParameter($aliasKey, $value);
            }
            else{
                throw new \InvalidArgumentException('Not possible to query API for '.$key.' argument.');
            }
        }


        if ($limit){
            $this->productListing->setParameter('nbproductsperpage', $limit);
            $pageNum = ($offset + $limit)/$limit;
        }
        if($pageNum){
            $this->productListing->setParameter('pagenumber', $pageNum);
        }

        $result = $this->productListing->request();
        $result = $result->getProducts();

        $items = [];
        foreach ($result as $vendorItem) {
            $item = new VendorItem();
            $item->setId($vendorItem['id']);
            $item->setTitle($vendorItem['values']['name']);
            $item->setUrl($vendorItem['values']['url']);
            $item->setImg($vendorItem['values']['image']);
            $items[] = $item;
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