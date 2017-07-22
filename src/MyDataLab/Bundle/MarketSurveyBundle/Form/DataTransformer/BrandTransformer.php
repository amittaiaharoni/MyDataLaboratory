<?php

namespace MyDataLab\Bundle\MarketSurveyBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use MyDataLab\Bundle\MarketSurveyBundle\Entity\MarketSurveyBrand;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

class BrandTransformer implements DataTransformerInterface
{
    private $manager;

    function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (activity) to a string.
     *
     * @param  MarketSurveyBrand[]|null $brands
     * @return string
     */
    public function transform($brands)
    {
        if (null === $brands) {
            return '';
        }
        $result = [];
        foreach ($brands as $brand) {
            $result[] = $brand->getName();
        }
        return implode(', ', $result);
    }

    /**
     *
     * @param string $brandNames
     * @return Collection
     * @throws TransformationFailedException
     */
    public function reverseTransform($brandNames)
    {
        if (!$brandNames) {
            return;
        }
        $brandNames = preg_split('/,\s+/', $brandNames);
        $brands = $this->manager->getRepository(MarketSurveyBrand::class)
            ->findBy([
                'name' => $brandNames,
            ]);

        $result = new ArrayCollection();
        foreach ($brands as $brand) {
            $result->add($brand);
        }
        return $result;
    }
}