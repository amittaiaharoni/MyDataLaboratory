<?php
/**
 * Created by PhpStorm.
 * User: hephaestusmith
 * Date: 3/1/17
 * Time: 11:16 AM
 */

namespace MyDataLab\Bundle\FrontendBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;

class SitemapController extends Controller
{
    public function indexAction(Request $request)
    {
        $file = $this->getSiteMap();
        $file = $this->getTree($file);

        return $this->render('MyDataLabFrontendBundle:Sitemap:index.html.twig', [
            'sitemapping' => $file
        ]);
    }

    /**
     * @return string
     */
    private function getSiteMap()
    {
        $finder = new Finder();
        $finder->files()->in($this->getParameter('sitemap_location'))->name('*.xml');
        $iterator = $finder->getIterator();
        $iterator->rewind();
        $file = $iterator->current();
        $file = $file->getContents();

        return $file;
    }

    /**
     * @param array
     * @return array
     */
    private function treeBuilder($parentArray){
        $branch = ['children' => []];
        foreach ($parentArray as $key => $value){
            if($key !== 'children' && $key !== 'link'){
                if(count($value) === 1){
                    $branch['link'] = $value['link'];
                }
                else{
                    $valueKey = $value[0];
                    if(!isset($branch['children'][$valueKey])){
                        $branch['children'][$valueKey] = [];
                    }
                    array_shift($value);
                    if($value !== []){
                        $branch['children'][$valueKey][] = $value;
                    }
                }
            }
        }
        foreach ($branch['children'] as &$childBranch){
            $childBranch = $this->treeBuilder($childBranch);
        }
        return $branch;
    }

    /**
     * @param string
     * @return array
     */
    private function getTree($file){
        preg_match_all("-<loc>(.*?)</loc>-U", $file, $preg_array);
        $file = $preg_array[1];

        for($i = 0; $i < count($file); $i++){
            $link = $file[$i];
            $file[$i] = str_replace("http://dev.mydatalaboratory.com/", "", $file[$i]);
            $file[$i] = rtrim($file[$i], './');
            $file[$i] = explode("/", $file[$i]);
            $file[$i]['link'] = $link;
        }

        return $this->treeBuilder($file);
    }
}