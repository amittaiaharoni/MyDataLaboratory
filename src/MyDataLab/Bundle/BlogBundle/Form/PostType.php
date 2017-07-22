<?php

namespace MyDataLab\Bundle\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use MyDataLab\Bundle\BlogBundle\Form\DataTransformer\TagsTransformer;
use MyDataLab\Bundle\BlogBundle\Form\DataTransformer\KeywordsTransformer;
use MyDataLab\Bundle\BlogBundle\Form\DataTransformer\ImageTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PostType extends AbstractType
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

    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'csrf_protection' => false,
        ]);
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title')
                ->add('slug', TextType::class, [
                    'label' => 'URL'
                ])
                ->add('language', EntityType::class, [
                    'class' => 'MyDataLabCoreBundle:Language',
                    'choice_value' => 'code',
                ])
                ->add('image', FileType::class, [
                    'data_class' => null,
                ])
                ->add('metaDescription')
                ->add('keywords', TextType::class)
                ->add('tags', TextType::class)
                ->add('content')
        ;
        $builder
                ->get('tags')
                ->addModelTransformer(new TagsTransformer($this->manager))
        ;
        $builder
                ->get('keywords')
                ->addModelTransformer(new KeywordsTransformer($this->manager))
        ;
//        $builder
//                ->get('image')
//                ->addModelTransformer(new ImageTransformer($this->manager, $this->blogImagesDirectory))
//        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'MyDataLab\Bundle\BlogBundle\Entity\Post',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'my_data_lab_blog_post';
    }

}
