<?php

namespace Miaoxing\Photo\Controller\Admin;

class AlbumCategory extends \Miaoxing\Category\Controller\Admin\Category
{
    protected $controllerName = '相册栏目管理';

    protected $actionPermissions = [
        'index' => '列表',
        'new,create' => '添加',
        'edit,update' => '编辑',
        'destroy' => '删除',
    ];
}
