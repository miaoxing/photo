<?php

namespace Miaoxing\Photo\Migration;

use Miaoxing\Plugin\BaseMigration;

class V20170228172435CreateAlbumTable extends BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->schema->table('album')
            ->id()
            ->string('class')
            ->string('image')
            ->string('description')
            ->text('linkTo')
            ->int('sort')
            ->bool('enable')
            ->timestamp('createTime')
            ->timestamp('updateTime')
            ->exec();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->schema->dropIfExists('album');
    }
}
