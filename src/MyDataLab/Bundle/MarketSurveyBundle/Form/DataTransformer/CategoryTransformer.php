<?php

namespace MyDataLab\Bundle\MarketSurveyBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use MyDataLab\Bundle\MarketSurveyBundle\Entity\MarketSurveyCategory;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

class CategoryTransformer implements DataTransformerInterface
{
    private $manager;

    function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (category) to a string.
     *
     * @param  MarketSurveyCategory[]|null $categories
     * @return string
     */
    public function transform($categories)
    {
        if (null === $categories) {
            return '';
        }
        $result = [];
        foreach ($categories as $category) {
            $result[] = $category->getName();
        }
        return implode(', ', $result);
    }

    /**
     *
     * @param string $categoryNames
     * @return Collection
     * @throws TransformationFailedException
     */
    public function reverseTransform($categoryNames)
    {
        if (!$categoryNames) {
            return;
        }
        $categoryNames = preg_split('/,\s+/', $categoryNames);
        $categories = $this->manager->getRepository(MarketSurveyCategory::class)
            ->findBy([
                'name' => $categoryNames,
            ]);

        $result = new ArrayCollection();
        foreach ($categories as $category) {
            $result->add($category);
        }
        return $result;
    }
}