<?php

namespace MyDataLab\Bundle\MarketSurveyBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use MyDataLab\Bundle\RetailersBundle\Entity\Retailer;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

class RetailerTransformer implements DataTransformerInterface
{
    private $manager;

    function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (retailer) to a string.
     *
     * @param  Retailer[]|null $retailers
     * @return string
     */
    public function transform($retailers)
    {
        if (null === $retailers) {
            return '';
        }
        $result = [];
        foreach ($retailers as $retailer) {
            $result[] = $retailer->getName();
        }
        return implode(', ', $result);
    }

    /**
     *
     * @param string $retailerNames
     * @return Collection
     * @throws TransformationFailedException
     */
    public function reverseTransform($retailerNames)
    {
        if (!$retailerNames) {
            return;
        }
        $retailerNames = preg_split('/,\s+/', $retailerNames);
        $retailers = $this->manager->getRepository(Retailer::class)
            ->findBy([
                'name' => $retailerNames,
            ]);

        $result = new ArrayCollection();
        foreach ($retailers as $retailer) {
            $result->add($retailer);
        }
        return $result;
    }
}