<?php

namespace MyDataLab\Bundle\PageRoutingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\Config\Loader\DelegatingLoader;

class PageRoutingType extends AbstractType
{

    /**
     *
     * @var RouterInterface
     */
    private $router;

    /**
     *
     * @var string
     */
    private $prefix = 'my_data_lab_frontend_';

    /**
     *
     * @var string
     */
    private $path;

    public function __construct(RouterInterface $router, $path)
    {
        $this->router = $router;
        $this->path = $path;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $routes = $this->router->getRouteCollection();
//        $locator = new FileLocator($this->path);
//        $loaderResolver = new LoaderResolver([new XmlFileLoader($locator)]);
//        $delegatingLoader = new DelegatingLoader($loaderResolver);
//        $routes = $delegatingLoader->load('routing.xml');
        $choices = [];
        /* @var $route Symfony\Component\Routing\Route */
        foreach ($routes as $name => $route) {
            if (strpos($name, $this->prefix) !== false && $name !== 'my_data_lab_frontend_homepage') {
                $choices[str_replace($this->prefix, '', $name)] = $name;
            }
        }
        $builder
                ->add('name', ChoiceType::class, [
                    'choices' => $choices,
                ])
                ->add('path')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'MyDataLab\Bundle\PageRoutingBundle\Entity\PageRouting',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'my_data_lab_page_route';
    }

}
