<?php

namespace Miaoxing\Photo\Controller;

class Album extends \Miaoxing\Plugin\BaseController
{
    protected $guestPages = ['album'];

    public function indexAction($req)
    {
        $categories = wei()->category()
            ->notDeleted()
            ->withParent('album')
            ->desc('sort')
            ->findAll();

        $currCategory = $categories[0];
        if ($req['categoryId']) {
            $currCategory = wei()->category()->notDeleted()->findOneById($req['categoryId']);
        }

        $albums = wei()->album()->byClass($currCategory['id'])->findAll();

        return get_defined_vars();
    }
}
