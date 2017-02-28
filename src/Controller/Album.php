<?php

namespace Miaoxing\Photo\Controller;

class Album extends \miaoxing\plugin\BaseController
{
    protected $guestPages = ['album'];

    public function indexAction($req)
    {
        $categories = wei()->category()
            ->notDeleted()
            ->withParent('album')
            ->desc('sort')
            ->findAll();

        $currCategory = $req['categoryId'] ? wei()->category()->notDeleted()->findOneById($req['categoryId']) : $categories[0];

        $albums = wei()->album()->byClass($currCategory['id'])->findAll();

        return get_defined_vars();
    }
}
