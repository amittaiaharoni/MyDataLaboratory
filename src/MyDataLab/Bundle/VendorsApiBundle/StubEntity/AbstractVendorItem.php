<?php

namespace MyDataLab\Bundle\VendorsApiBundle\StubEntity;


abstract class AbstractVendorItem
{
    /**
     * @var VendorItem
     */
    protected $item;

    /**
     * @var array
     */
    protected static $propertyAlias = [
        'id' => [
            'type' => '',
            'elementName' => '',
            'repositoryName' => ''
        ],
        'title' => [
            'type' => '',
            'elementName' => '',
            'repositoryName' => ''
        ],
        'price' => [
            'type' => '',
            'elementName' => '',
            'repositoryName' => ''
        ],
        'currency' => [
            'type' => '',
            'elementName' => '',
            'repositoryName' => ''
        ],
        'description' => [
            'type' => '',
            'elementName' => '',
            'repositoryName' => ''
        ],
        'img' => [
            'type' => '',
            'elementName' => '',
            'repositoryName' => ''
        ],
        'url' => [
            'type' => '',
            'elementName' => '',
            'repositoryName' => ''
        ],
    ];

    function __construct(VendorItem $item = null)
    {
        if($item){
            $this->setItem($item);
        }
    }

    /**
     * @return VendorItem $item
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param VendorItem $item
     */
    public function setItem(VendorItem $item){}

    /**
     * @param string $alias
     */
    public function setAliasValue($alias, $value)
    {
        $this->{'set'.self::$propertyAlias[$alias]['elementName']}($value);
    }

    /**
     * @param string $alias
     */
    public function getAliasValue($alias)
    {
        return $this->{'get'.self::$propertyAlias[$alias]['elementName']}();
    }

    /**
     * @param string $alias
     * @return string
     */
    public static function getAliasKey($alias)
    {
        if(self::$propertyAlias[$alias]['elementName']){
            return self::$propertyAlias[$alias]['elementName'];
        }
        return null;
    }

    /**
     * $alias - the value searched for
     * $key - the type of element searched
     *
     * @param string $alias
     * @param string|null $key
     * @return string|null
     */
    public static function getRepositoryAliasKeyBy($alias, $key = null)
    {
        if(!$key){
            foreach (static::$propertyAlias as $aliaser){
                if($aliaser['repositoryName'] === $alias){
                    return $aliaser['repositoryName'];
                }
                return null;
            }
        }

        foreach (static::$propertyAlias as $aliaser){

            if($aliaser[$key] === $alias){
                return $aliaser['repositoryName'];
            }
        }
        return null;
    }

}