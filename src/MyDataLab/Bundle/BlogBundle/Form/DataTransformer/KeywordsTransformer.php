<?php

namespace MyDataLab\Bundle\BlogBundle\Form\DataTransformer;

use MyDataLab\Bundle\BlogBundle\Entity\Keyword;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

class KeywordsTransformer implements DataTransformerInterface
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
     * @param string $keywords
     * @return Collection
     */
    public function reverseTransform($keywords)
    {
        if (!$keywords) {
            return;
        }
        $keywords = preg_split('/,\s+/', $keywords);
        $existingKeywords = $this->manager->getRepository('MyDataLabBlogBundle:Keyword')
                ->findBy([
            'name' => $keywords,
        ]);

        /* @var $keyword Keyword */
        foreach ($existingKeywords as $keyword) {
            $keywords = array_diff($keywords, [$keyword->getName()]);
        }
        $newKeywords = [];
        foreach ($keywords as $i => $newKeywordName) {
            $newKeywords[$i] = new Keyword();
            $newKeywords[$i]->setName($newKeywordName);
        }

        $result = new ArrayCollection();
        foreach (array_merge($existingKeywords, $newKeywords) as $keyword) {
            $result->add($keyword);
        }
        return $result;
    }

    /**
     * 
     * @param Collection $keywords
     * @return string
     */
    public function transform($keywords)
    {
        if (null === $keywords) {
            return '';
        }
        $result = [];
        foreach ($keywords as $keyword) {
            $result[] = $keyword->getName();
        }
        return implode(', ', $result);
    }

}
