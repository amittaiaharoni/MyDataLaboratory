<?php

namespace MyDataLab\Bundle\AdminBundle\Service;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuBuilder
{

    const MENUS_FILE_PATH = '/config/menubuilder.yml';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_USER = 'ROLE_USER';

    /**
     *
     * @var string
     */
    private $rootPath;

    /**
     *
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     *
     * @var RequestStack
     */
    private $requestStack;

    /**
     *
     * @var array
     */
    private $menus;

    public function __construct(TokenStorageInterface $tokenStorage, RequestStack $requestStack, $rootPath)
    {
        $this->tokenStorage = $tokenStorage;
        $this->requestStack = $requestStack;
        $this->rootPath = $rootPath;
    }

    private function getCurrentRouteName()
    {
        return $this->requestStack->getCurrentRequest()->get('_route');
    }

    /**
     * 
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    private function getUser()
    {
        return $this->tokenStorage->getToken()->getUser();
    }

    private function checkActiveMenus()
    {
        $currentRouteName = $this->getCurrentRouteName();
        foreach ($this->menus as $i => $menu) {
            $this->menus[$i]['active'] = false;
            if (isset($menu['name'])) {
                $this->menus[$i]['active'] = $menu['name'] == $currentRouteName;
                continue;
            }
            if (isset($menu['submenus'])) {
                $this->menus[$i]['active'] = false;
                foreach ($menu['submenus'] as $j => $submenu) {
                    $this->menus[$i]['submenus'][$j]['active'] = false;
                    if ($submenu['name'] == $currentRouteName) {
                        $this->menus[$i]['active'] = true;
                        $this->menus[$i]['submenus'][$j]['active'] = true;
                        //dont't break, because we want to go over all submenus
                        //and set their active prop
                    }
                }
                continue;
            }
        }
    }

    private function loadMenus($role)
    {
        $this->menus = [];
        $filepath = $this->rootPath . static::MENUS_FILE_PATH;
        $content = $this->parseContent(\file_get_contents($filepath));
        if (!empty($content[$role])) {
            foreach ($content[$role]['menus'] as $menu) {
                $this->menus[] = $menu;
            }
        }
        $this->checkActiveMenus();
        return $this->menus;
    }

    /**
     * @return array
     */
    public function getMenus()
    {
        if ($this->getUser()->hasRole(self::ROLE_ADMIN)) {
            return $this->loadMenus(self::ROLE_ADMIN);
        }
        return $this->loadMenus(self::ROLE_USER);
    }

    private function parseContent($filePath)
    {
        return Yaml::parse($filePath);
    }

}
