<?php

namespace Miaoxing\Photo\Controller\Admin;

class Album extends \miaoxing\plugin\BaseController
{
    public $class = array(
        'index_roll' => '首页轮转图',
    );

    protected $controllerName = '相册管理';

    protected $actionPermissions = [
        'index' => '列表',
        'new,create' => '添加',
        'edit,update' => '编辑',
        'destroy' => '删除',
    ];

    public function indexAction($req)
    {
        switch ($req['_format']) {
            case 'json':
                $albums = wei()->album();

                // 分页
                $albums->limit($req['rows'])->page($req['page']);

                // 排序
                $albums->desc('sort');

                if ($req['class']) {
                    $albums->andWhere(array('class' => $req['class']));
                }

                $data = array();
                foreach ($albums->findAll() as $album) {
                    $data[] = $album->toArray() + [
                            'url' => wei()->linkTo->getUrl($album['linkTo']),
                            'className' => $album->getCategory()->get('name')
                        ];
                }

                return $this->json('读取列表成功', 1, array(
                    'data' => $data,
                    'page' => $req['page'],
                    'rows' => $req['rows'],
                    'records' => $albums->count(),
                ));

            default:
                $class = $this->class;
                return get_defined_vars();
        }
    }

    public function newAction()
    {
        $class = $this->class;
        $album = wei()->album();
        return get_defined_vars();
    }

    public function createAction($req)
    {
        wei()->album()->saveData($req);
        return $this->suc();
    }

    public function editAction($req)
    {
        $album = wei()->album()->findOneById($req['id']);
        $class = $this->class;
        return get_defined_vars();
    }

    public function updateAction($req)
    {
        $album = wei()->album()->findOneById($req['id']);
        $album->saveData($req);
        return $this->suc();
    }

    public function destroyAction($req)
    {
        wei()->album()->findOneById($req['id'])->destroy();
        return $this->suc();
    }
}
