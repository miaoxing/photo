<?php

namespace Miaoxing\Photo;

class Plugin extends \miaoxing\plugin\BasePlugin
{
    protected $name = '相册';

    protected $description = '';

    public function onAdminNavGetNavs(&$navs, &$categories, &$subCategories)
    {
        $navs[] = [
            'parentId' => 'app-site',
            'url' => 'admin/album/index',
            'name' => '相册管理',
        ];
    }

    public function onLinkToGetLinks(&$links, &$types)
    {
        $types['photo'] = [
            'name' => '相册',
            'sort' => 800,
        ];

        $links[] = [
            'typeId' => 'photo',
            'name' => '相册首页',
            'url' => 'album',
        ];

        foreach (wei()->category()->notDeleted()->withParent('album')->desc('sort')->getTree() as $category) {
            $links[] = [
                'typeId' => 'photo',
                'name' => '相册列表：' . $category['name'],
                'url' => 'album?categoryId=' . $category['id'],
            ];
        }
    }
}
