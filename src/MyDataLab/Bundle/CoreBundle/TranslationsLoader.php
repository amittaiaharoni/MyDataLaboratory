<?php

namespace MyDataLab\Bundle\CoreBundle;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Translation\MessageCatalogue;
use Symfony\Component\Translation\Loader\LoaderInterface;

class TranslationsLoader implements LoaderInterface
{
    private $translationRepository;
    private $languageRepository;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->translationRepository = $entityManager->getRepository("MyDataLabCoreBundle:Translation");
        $this->languageRepository = $entityManager->getRepository("MyDataLabCoreBundle:Language");
    }

    function load($resource, $locale, $domain = 'messages'){
        //Load on the db for the specified local
        $language = $this->languageRepository->findOneBy(array("code" => $locale));

        $translations = $this->translationRepository->getTranslations($language, $domain);

        $catalogue = new MessageCatalogue($locale);

        /**
         * @var $translation /MyDataLab/Bundle/CoreBundle/Entity/Translation
         */
        foreach($translations as $translation){
            $catalogue->set($translation->getSource(), $translation->getTarget(), $domain);
        }

        return $catalogue;
    }
}