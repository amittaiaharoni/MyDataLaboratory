<?php

namespace MyDataLab\Bundle\ProductBundle\Entity;

/**
 * Site
 */
class Site
{

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $tel;

    /**
     * @var string
     */
    private $rcs;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $cms;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $favicon;

    /**
     * @var string
     */
    private $socialnetwork;

    /**
     * @var string
     */
    private $productTitle;

    /**
     * @var string
     */
    private $productUrl;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $keywords;

    /**
     * @var string
     */
    private $brand;

    /**
     * @var boolean
     */
    private $categoryId;

    /**
     * @var string
     */
    private $ean13;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $imageTitle;

    /**
     * @var string
     */
    private $price;

    /**
     * @var string
     */
    private $priceOld;

    /**
     * @var string
     */
    private $typePromo;

    /**
     * @var string
     */
    private $priceTtcHt;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $shipmentPrice;

    /**
     * @var string
     */
    private $stockState;

    /**
     * @var string
     */
    private $productMark;

    /**
     * @var string
     */
    private $breadcrumb;

    /**
     * @var string
     */
    private $tagTypeProductTitle;

    /**
     * @var string
     */
    private $tagTypeProductUrl;

    /**
     * @var string
     */
    private $tagTypeDescription;

    /**
     * @var string
     */
    private $tagTypeKeywords;

    /**
     * @var string
     */
    private $tagTypeBrand;

    /**
     * @var string
     */
    private $tagTypeCategories;

    /**
     * @var string
     */
    private $tagTypeEan13;

    /**
     * @var string
     */
    private $tagTypeReference;

    /**
     * @var string
     */
    private $tagTypeImage;

    /**
     * @var string
     */
    private $tagTypeImageTitle;

    /**
     * @var string
     */
    private $tagTypePrice;

    /**
     * @var string
     */
    private $tagTypePriceOld;

    /**
     * @var string
     */
    private $tagTypeTypePromo;

    /**
     * @var string
     */
    private $tagTypePriceTtcHt;

    /**
     * @var string
     */
    private $tagTypeCurrency;

    /**
     * @var string
     */
    private $tagTypeShipmentPrice;

    /**
     * @var string
     */
    private $tagTypeStockState;

    /**
     * @var string
     */
    private $tagTypeProductMark;

    /**
     * @var string
     */
    private $tagTypeBreadcrumb;

    /**
     * @var boolean
     */
    private $scanning = '0';

    /**
     * @var \DateTime
     */
    private $lastScan;

    /**
     * @var string
     */
    private $comments;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var integer
     */
    private $id;

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Site
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Site
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Site
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set rcs
     *
     * @param string $rcs
     *
     * @return Site
     */
    public function setRcs($rcs)
    {
        $this->rcs = $rcs;

        return $this;
    }

    /**
     * Get rcs
     *
     * @return string
     */
    public function getRcs()
    {
        return $this->rcs;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Site
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set cms
     *
     * @param string $cms
     *
     * @return Site
     */
    public function setCms($cms)
    {
        $this->cms = $cms;

        return $this;
    }

    /**
     * Get cms
     *
     * @return string
     */
    public function getCms()
    {
        return $this->cms;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Site
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set favicon
     *
     * @param string $favicon
     *
     * @return Site
     */
    public function setFavicon($favicon)
    {
        $this->favicon = $favicon;

        return $this;
    }

    /**
     * Get favicon
     *
     * @return string
     */
    public function getFavicon()
    {
        return $this->favicon;
    }

    /**
     * Set socialnetwork
     *
     * @param string $socialnetwork
     *
     * @return Site
     */
    public function setSocialnetwork($socialnetwork)
    {
        $this->socialnetwork = $socialnetwork;

        return $this;
    }

    /**
     * Get socialnetwork
     *
     * @return string
     */
    public function getSocialnetwork()
    {
        return $this->socialnetwork;
    }

    /**
     * Set productTitle
     *
     * @param string $productTitle
     *
     * @return Site
     */
    public function setProductTitle($productTitle)
    {
        $this->productTitle = $productTitle;

        return $this;
    }

    /**
     * Get productTitle
     *
     * @return string
     */
    public function getProductTitle()
    {
        return $this->productTitle;
    }

    /**
     * Set productUrl
     *
     * @param string $productUrl
     *
     * @return Site
     */
    public function setProductUrl($productUrl)
    {
        $this->productUrl = $productUrl;

        return $this;
    }

    /**
     * Get productUrl
     *
     * @return string
     */
    public function getProductUrl()
    {
        return $this->productUrl;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Site
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     *
     * @return Site
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set brand
     *
     * @param string $brand
     *
     * @return Site
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set categoryId
     *
     * @param boolean $categoryId
     *
     * @return Site
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return boolean
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set ean13
     *
     * @param string $ean13
     *
     * @return Site
     */
    public function setEan13($ean13)
    {
        $this->ean13 = $ean13;

        return $this;
    }

    /**
     * Get ean13
     *
     * @return string
     */
    public function getEan13()
    {
        return $this->ean13;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Site
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Site
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set imageTitle
     *
     * @param string $imageTitle
     *
     * @return Site
     */
    public function setImageTitle($imageTitle)
    {
        $this->imageTitle = $imageTitle;

        return $this;
    }

    /**
     * Get imageTitle
     *
     * @return string
     */
    public function getImageTitle()
    {
        return $this->imageTitle;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Site
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set priceOld
     *
     * @param string $priceOld
     *
     * @return Site
     */
    public function setPriceOld($priceOld)
    {
        $this->priceOld = $priceOld;

        return $this;
    }

    /**
     * Get priceOld
     *
     * @return string
     */
    public function getPriceOld()
    {
        return $this->priceOld;
    }

    /**
     * Set typePromo
     *
     * @param string $typePromo
     *
     * @return Site
     */
    public function setTypePromo($typePromo)
    {
        $this->typePromo = $typePromo;

        return $this;
    }

    /**
     * Get typePromo
     *
     * @return string
     */
    public function getTypePromo()
    {
        return $this->typePromo;
    }

    /**
     * Set priceTtcHt
     *
     * @param string $priceTtcHt
     *
     * @return Site
     */
    public function setPriceTtcHt($priceTtcHt)
    {
        $this->priceTtcHt = $priceTtcHt;

        return $this;
    }

    /**
     * Get priceTtcHt
     *
     * @return string
     */
    public function getPriceTtcHt()
    {
        return $this->priceTtcHt;
    }

    /**
     * Set currency
     *
     * @param string $currency
     *
     * @return Site
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set shipmentPrice
     *
     * @param string $shipmentPrice
     *
     * @return Site
     */
    public function setShipmentPrice($shipmentPrice)
    {
        $this->shipmentPrice = $shipmentPrice;

        return $this;
    }

    /**
     * Get shipmentPrice
     *
     * @return string
     */
    public function getShipmentPrice()
    {
        return $this->shipmentPrice;
    }

    /**
     * Set stockState
     *
     * @param string $stockState
     *
     * @return Site
     */
    public function setStockState($stockState)
    {
        $this->stockState = $stockState;

        return $this;
    }

    /**
     * Get stockState
     *
     * @return string
     */
    public function getStockState()
    {
        return $this->stockState;
    }

    /**
     * Set productMark
     *
     * @param string $productMark
     *
     * @return Site
     */
    public function setProductMark($productMark)
    {
        $this->productMark = $productMark;

        return $this;
    }

    /**
     * Get productMark
     *
     * @return string
     */
    public function getProductMark()
    {
        return $this->productMark;
    }

    /**
     * Set breadcrumb
     *
     * @param string $breadcrumb
     *
     * @return Site
     */
    public function setBreadcrumb($breadcrumb)
    {
        $this->breadcrumb = $breadcrumb;

        return $this;
    }

    /**
     * Get breadcrumb
     *
     * @return string
     */
    public function getBreadcrumb()
    {
        return $this->breadcrumb;
    }

    /**
     * Set tagTypeProductTitle
     *
     * @param string $tagTypeProductTitle
     *
     * @return Site
     */
    public function setTagTypeProductTitle($tagTypeProductTitle)
    {
        $this->tagTypeProductTitle = $tagTypeProductTitle;

        return $this;
    }

    /**
     * Get tagTypeProductTitle
     *
     * @return string
     */
    public function getTagTypeProductTitle()
    {
        return $this->tagTypeProductTitle;
    }

    /**
     * Set tagTypeProductUrl
     *
     * @param string $tagTypeProductUrl
     *
     * @return Site
     */
    public function setTagTypeProductUrl($tagTypeProductUrl)
    {
        $this->tagTypeProductUrl = $tagTypeProductUrl;

        return $this;
    }

    /**
     * Get tagTypeProductUrl
     *
     * @return string
     */
    public function getTagTypeProductUrl()
    {
        return $this->tagTypeProductUrl;
    }

    /**
     * Set tagTypeDescription
     *
     * @param string $tagTypeDescription
     *
     * @return Site
     */
    public function setTagTypeDescription($tagTypeDescription)
    {
        $this->tagTypeDescription = $tagTypeDescription;

        return $this;
    }

    /**
     * Get tagTypeDescription
     *
     * @return string
     */
    public function getTagTypeDescription()
    {
        return $this->tagTypeDescription;
    }

    /**
     * Set tagTypeKeywords
     *
     * @param string $tagTypeKeywords
     *
     * @return Site
     */
    public function setTagTypeKeywords($tagTypeKeywords)
    {
        $this->tagTypeKeywords = $tagTypeKeywords;

        return $this;
    }

    /**
     * Get tagTypeKeywords
     *
     * @return string
     */
    public function getTagTypeKeywords()
    {
        return $this->tagTypeKeywords;
    }

    /**
     * Set tagTypeBrand
     *
     * @param string $tagTypeBrand
     *
     * @return Site
     */
    public function setTagTypeBrand($tagTypeBrand)
    {
        $this->tagTypeBrand = $tagTypeBrand;

        return $this;
    }

    /**
     * Get tagTypeBrand
     *
     * @return string
     */
    public function getTagTypeBrand()
    {
        return $this->tagTypeBrand;
    }

    /**
     * Set tagTypeCategories
     *
     * @param string $tagTypeCategories
     *
     * @return Site
     */
    public function setTagTypeCategories($tagTypeCategories)
    {
        $this->tagTypeCategories = $tagTypeCategories;

        return $this;
    }

    /**
     * Get tagTypeCategories
     *
     * @return string
     */
    public function getTagTypeCategories()
    {
        return $this->tagTypeCategories;
    }

    /**
     * Set tagTypeEan13
     *
     * @param string $tagTypeEan13
     *
     * @return Site
     */
    public function setTagTypeEan13($tagTypeEan13)
    {
        $this->tagTypeEan13 = $tagTypeEan13;

        return $this;
    }

    /**
     * Get tagTypeEan13
     *
     * @return string
     */
    public function getTagTypeEan13()
    {
        return $this->tagTypeEan13;
    }

    /**
     * Set tagTypeReference
     *
     * @param string $tagTypeReference
     *
     * @return Site
     */
    public function setTagTypeReference($tagTypeReference)
    {
        $this->tagTypeReference = $tagTypeReference;

        return $this;
    }

    /**
     * Get tagTypeReference
     *
     * @return string
     */
    public function getTagTypeReference()
    {
        return $this->tagTypeReference;
    }

    /**
     * Set tagTypeImage
     *
     * @param string $tagTypeImage
     *
     * @return Site
     */
    public function setTagTypeImage($tagTypeImage)
    {
        $this->tagTypeImage = $tagTypeImage;

        return $this;
    }

    /**
     * Get tagTypeImage
     *
     * @return string
     */
    public function getTagTypeImage()
    {
        return $this->tagTypeImage;
    }

    /**
     * Set tagTypeImageTitle
     *
     * @param string $tagTypeImageTitle
     *
     * @return Site
     */
    public function setTagTypeImageTitle($tagTypeImageTitle)
    {
        $this->tagTypeImageTitle = $tagTypeImageTitle;

        return $this;
    }

    /**
     * Get tagTypeImageTitle
     *
     * @return string
     */
    public function getTagTypeImageTitle()
    {
        return $this->tagTypeImageTitle;
    }

    /**
     * Set tagTypePrice
     *
     * @param string $tagTypePrice
     *
     * @return Site
     */
    public function setTagTypePrice($tagTypePrice)
    {
        $this->tagTypePrice = $tagTypePrice;

        return $this;
    }

    /**
     * Get tagTypePrice
     *
     * @return string
     */
    public function getTagTypePrice()
    {
        return $this->tagTypePrice;
    }

    /**
     * Set tagTypePriceOld
     *
     * @param string $tagTypePriceOld
     *
     * @return Site
     */
    public function setTagTypePriceOld($tagTypePriceOld)
    {
        $this->tagTypePriceOld = $tagTypePriceOld;

        return $this;
    }

    /**
     * Get tagTypePriceOld
     *
     * @return string
     */
    public function getTagTypePriceOld()
    {
        return $this->tagTypePriceOld;
    }

    /**
     * Set tagTypeTypePromo
     *
     * @param string $tagTypeTypePromo
     *
     * @return Site
     */
    public function setTagTypeTypePromo($tagTypeTypePromo)
    {
        $this->tagTypeTypePromo = $tagTypeTypePromo;

        return $this;
    }

    /**
     * Get tagTypeTypePromo
     *
     * @return string
     */
    public function getTagTypeTypePromo()
    {
        return $this->tagTypeTypePromo;
    }

    /**
     * Set tagTypePriceTtcHt
     *
     * @param string $tagTypePriceTtcHt
     *
     * @return Site
     */
    public function setTagTypePriceTtcHt($tagTypePriceTtcHt)
    {
        $this->tagTypePriceTtcHt = $tagTypePriceTtcHt;

        return $this;
    }

    /**
     * Get tagTypePriceTtcHt
     *
     * @return string
     */
    public function getTagTypePriceTtcHt()
    {
        return $this->tagTypePriceTtcHt;
    }

    /**
     * Set tagTypeCurrency
     *
     * @param string $tagTypeCurrency
     *
     * @return Site
     */
    public function setTagTypeCurrency($tagTypeCurrency)
    {
        $this->tagTypeCurrency = $tagTypeCurrency;

        return $this;
    }

    /**
     * Get tagTypeCurrency
     *
     * @return string
     */
    public function getTagTypeCurrency()
    {
        return $this->tagTypeCurrency;
    }

    /**
     * Set tagTypeShipmentPrice
     *
     * @param string $tagTypeShipmentPrice
     *
     * @return Site
     */
    public function setTagTypeShipmentPrice($tagTypeShipmentPrice)
    {
        $this->tagTypeShipmentPrice = $tagTypeShipmentPrice;

        return $this;
    }

    /**
     * Get tagTypeShipmentPrice
     *
     * @return string
     */
    public function getTagTypeShipmentPrice()
    {
        return $this->tagTypeShipmentPrice;
    }

    /**
     * Set tagTypeStockState
     *
     * @param string $tagTypeStockState
     *
     * @return Site
     */
    public function setTagTypeStockState($tagTypeStockState)
    {
        $this->tagTypeStockState = $tagTypeStockState;

        return $this;
    }

    /**
     * Get tagTypeStockState
     *
     * @return string
     */
    public function getTagTypeStockState()
    {
        return $this->tagTypeStockState;
    }

    /**
     * Set tagTypeProductMark
     *
     * @param string $tagTypeProductMark
     *
     * @return Site
     */
    public function setTagTypeProductMark($tagTypeProductMark)
    {
        $this->tagTypeProductMark = $tagTypeProductMark;

        return $this;
    }

    /**
     * Get tagTypeProductMark
     *
     * @return string
     */
    public function getTagTypeProductMark()
    {
        return $this->tagTypeProductMark;
    }

    /**
     * Set tagTypeBreadcrumb
     *
     * @param string $tagTypeBreadcrumb
     *
     * @return Site
     */
    public function setTagTypeBreadcrumb($tagTypeBreadcrumb)
    {
        $this->tagTypeBreadcrumb = $tagTypeBreadcrumb;

        return $this;
    }

    /**
     * Get tagTypeBreadcrumb
     *
     * @return string
     */
    public function getTagTypeBreadcrumb()
    {
        return $this->tagTypeBreadcrumb;
    }

    /**
     * Set scanning
     *
     * @param boolean $scanning
     *
     * @return Site
     */
    public function setScanning($scanning)
    {
        $this->scanning = $scanning;

        return $this;
    }

    /**
     * Get scanning
     *
     * @return boolean
     */
    public function getScanning()
    {
        return $this->scanning;
    }

    /**
     * Set lastScan
     *
     * @param \DateTime $lastScan
     *
     * @return Site
     */
    public function setLastScan($lastScan)
    {
        $this->lastScan = $lastScan;

        return $this;
    }

    /**
     * Get lastScan
     *
     * @return \DateTime
     */
    public function getLastScan()
    {
        return $this->lastScan;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return Site
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Site
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

}
