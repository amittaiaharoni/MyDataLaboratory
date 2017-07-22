<?php

namespace MyDataLab\Bundle\MarketSurveyBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use MyDataLab\Bundle\MarketSurveyBundle\Form\DataTransformer\ActivityTransformer;
use MyDataLab\Bundle\MarketSurveyBundle\Form\DataTransformer\BrandTransformer;
use MyDataLab\Bundle\MarketSurveyBundle\Form\DataTransformer\CategoryTransformer;
use MyDataLab\Bundle\MarketSurveyBundle\Form\DataTransformer\MarketPlaceTransformer;
use MyDataLab\Bundle\MarketSurveyBundle\Form\DataTransformer\RetailerTransformer;
use MyDataLab\Bundle\RetailersBundle\Entity\Retailer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarketSurveyType extends AbstractType
{
    private $manager;

    function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('activity', ChoiceType::class, [
            ])
            ->add('mainCategories', ChoiceType::class, [
            ])
            ->add('categories', ChoiceType::class, [
            ])
            ->add('subCategories', ChoiceType::class, [
            ])
            ->add('retailers', ChoiceType::class, [
                'choices' => $this->manager->getRepository(Retailer::class)->findAll(),
                'choice_label' => function($retailer, $key, $index){
                    return $retailer->getName();
                }
            ])
            ->add('timeSlotStart', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'max' => date("Y-m-d")
                ]
            ])
            ->add('timeSlotEnd', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'max' => date("Y-m-d")
                ]
            ])
            ->add('marketPlaces', ChoiceType::class, [
            ])
            ->add('brands', ChoiceType::class, [
            ])
            ->add('name');
        $builder->get('activity')->addModelTransformer(new ActivityTransformer($this->manager));
        $builder->get('categories')->addModelTransformer(new CategoryTransformer($this->manager));
        $builder->get('retailers')->addModelTransformer(new RetailerTransformer($this->manager));
        $builder->get('marketPlaces')->addModelTransformer(new MarketPlaceTransformer($this->manager));
        $builder->get('brands')->addModelTransformer(new BrandTransformer($this->manager));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyDataLab\Bundle\MarketSurveyBundle\Entity\MarketSurvey'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mydatalab_bundle_marketsurveybundle_marketsurvey';
    }


}
