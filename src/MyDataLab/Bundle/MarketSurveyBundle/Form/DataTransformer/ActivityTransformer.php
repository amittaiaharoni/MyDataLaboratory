<?php

namespace MyDataLab\Bundle\MarketSurveyBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use MyDataLab\Bundle\MarketSurveyBundle\Entity\MarketSurveyActivity;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

class ActivityTransformer implements DataTransformerInterface
{
    private $manager;

    function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (activity) to a string.
     *
     * @param  MarketSurveyActivity[]|null $activities
     * @return string
     */
    public function transform($activities)
    {
        if (null === $activities) {
            return '';
        }
        $result = [];
        foreach ($activities as $activity) {
            $result[] = $activity->getName();
        }
        return implode(', ', $result);
    }

    /**
     *
     * @param string $activityNames
     * @return Collection
     * @throws TransformationFailedException
     */
    public function reverseTransform($activityNames)
    {
        if (!$activityNames) {
            return;
        }
        $activityNames = preg_split('/,\s+/', $activityNames);
        $activities = $this->manager->getRepository(MarketSurveyActivity::class)
            ->findBy([
                'name' => $activityNames,
            ]);

        $result = new ArrayCollection();
        foreach ($activities as $activity) {
            $result->add($activity);
        }
        return $result;
    }
}