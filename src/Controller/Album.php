<?php

namespace Miaoxing\Photo\Controller;

use Miaoxing\File\Service\File;
use Miaoxing\Tencentyun\Service\Tencentyun;

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

    public function testAction()
    {
        var_dump(wei()->tencentyunCosV5->signUrl('a.txt'));

        die;


        // 接着
        wei()->file->setOption('driver', 'tencentyunCosV5');

        $ret = wei()->file->upload('upload/card_intro_big29bc6c.jpg');
        var_dump($ret);die;
    }
}
