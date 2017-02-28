<?php

namespace Miaoxing\Photo\Service;

use Miaoxing\Category\Service\Category;
use miaoxing\plugin\BaseModel;

/**
 * @property \Miaoxing\LinkTo\Service\LinkTo $linkTo
 */
class Album extends BaseModel
{
    protected $data = [
        'enable' => 1,
        'linkTo' => [],
    ];

    /**
     * @var Category
     */
    protected $category;

    public function afterFind()
    {
        parent::afterFind();
        $this['linkTo'] = $this->linkTo->decode($this['linkTo']);
        $this->event->trigger('postImageDataLoad', [&$this, ['image']]);
    }

    public function beforeSave()
    {
        parent::beforeSave();
        $this['linkTo'] = $this->linkTo->encode($this['linkTo']);
        $this->event->trigger('preImageDataSave', [&$this, ['image']]);
    }

    public function enable()
    {
        return $this->andWhere('enable = 1');
    }

    public function byClass($class)
    {
        return $this->andWhere(['class' => $class]);
    }

    public function getCategory()
    {
        $this->category || $this->category = wei()->category()->findOrInit(['id' => $this['class']]);

        return $this->category;
    }

    public function afterSave()
    {
        parent::afterSave();
        $this->clearTagCache();
    }

    public function afterDestroy()
    {
        parent::afterDestroy();
        $this->clearTagCache();
    }
}
