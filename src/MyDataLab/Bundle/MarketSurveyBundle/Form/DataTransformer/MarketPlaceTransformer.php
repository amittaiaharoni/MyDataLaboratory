<?php

namespace MyDataLab\Bundle\MarketSurveyBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use MyDataLab\Bundle\MarketSurveyBundle\Entity\MarketSurveyMarketPlace;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

class MarketPlaceTransformer implements DataTransformerInterface
{
    private $manager;

    function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (marketPlace) to a string.
     *
     * @param  MarketSurveyMarketPlace[]|null $marketPlaces
     * @return string
     */
    public function transform($marketPlaces)
    {
        if (null === $marketPlaces) {
            return '';
        }
        $result = [];
        foreach ($marketPlaces as $marketPlace) {
            $result[] = $marketPlace->getName();
        }
        return implode(', ', $result);
    }

    /**
     *
     * @param string $marketPlaceNames
     * @return Collection
     * @throws TransformationFailedException
     */
    public function reverseTransform($marketPlaceNames)
    {
        if (!$marketPlaceNames) {
            return;
        }
        $marketPlaceNames = preg_split('/,\s+/', $marketPlaceNames);
        $marketPlaces = $this->manager->getRepository(MarketSurveyMarketPlace::class)
            ->findBy([
                'name' => $marketPlaceNames,
            ]);

        $result = new ArrayCollection();
        foreach ($marketPlaces as $marketPlace) {
            $result->add($marketPlace);
        }
        return $result;
    }
}