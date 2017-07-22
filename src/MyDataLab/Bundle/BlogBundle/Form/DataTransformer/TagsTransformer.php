<?php

namespace MyDataLab\Bundle\BlogBundle\Form\DataTransformer;

use MyDataLab\Bundle\BlogBundle\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

class TagsTransformer implements DataTransformerInterface
{

    /**
     *
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * 
     * @param string $tagsNames
     * @return Collection
     * @throws TransformationFailedException
     */
    public function reverseTransform($tagsNames)
    {
        if (!$tagsNames) {
            return;
        }
        $tagsNames = preg_split('/,\s+/', $tagsNames);
        $existingTags = $this->manager->getRepository('MyDataLabBlogBundle:Tag')
                ->findBy([
            'name' => $tagsNames,
        ]);

        /* @var $tag Tag */
        foreach ($existingTags as $tag) {
            $tagsNames = array_diff($tagsNames, [$tag->getName()]);
        }
        $newTags = [];
        foreach ($tagsNames as $i => $newTagName) {
            $newTags[$i] = new Tag();
            $newTags[$i]->setName($newTagName);
        }

        $result = new ArrayCollection();
        foreach (array_merge($existingTags, $newTags) as $tag) {
            $result->add($tag);
        }
        return $result;
    }

    /**
     * 
     * @param Collection $tags
     * @return string
     */
    public function transform($tags)
    {
        if (null === $tags) {
            return '';
        }
        $result = [];
        foreach ($tags as $tag) {
            $result[] = $tag->getName();
        }
        return implode(', ', $result);
    }

}
