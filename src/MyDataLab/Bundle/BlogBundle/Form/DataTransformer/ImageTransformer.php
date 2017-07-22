<?php

namespace MyDataLab\Bundle\BlogBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;

class ImageTransformer implements DataTransformerInterface
{

    /**
     *
     * @var ObjectManager
     */
    private $manager;

    /**
     *
     * @var string
     */
    private $blogImagesDirectory;

    public function __construct(ObjectManager $manager, $blogImagesDirectory)
    {
        $this->manager = $manager;
        $this->blogImagesDirectory = $blogImagesDirectory;
    }

    public function reverseTransform($value)
    {
        if (empty($value)) {
            return '';
        }
        if ($value instanceof File) {
            $fileName = \md5(\uniqid()) . '.' . $value->guessExtension();
            $value->move($this->blogImagesDirectory, $fileName);
            return $fileName;
        }
        throw new \Symfony\Component\Form\Exception\TransformationFailedException();
    }

    public function transform($value)
    {
        if ($value) {
            return new File($this->blogImagesDirectory . DIRECTORY_SEPARATOR . $value);
        }
        return null;
    }

}
