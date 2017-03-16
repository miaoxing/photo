<?php $view->layout() ?>

<div class="page-header">
  <h1>
    微官网
    <small>
      <i class="fa fa-angle-double-right"></i>
      相册管理
    </small>
  </h1>
</div>
<!-- /.page-header -->

<div class="row">
  <div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form id="album-form" class="form-horizontal" method="post" role="form">
      <div class="form-group">
        <label class="col-lg-2 control-label" for="class">
          <span class="text-warning">*</span>
          专辑
        </label>

        <div class="col-lg-4">
          <select id="class" name="class" class="form-control">
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label" for="image">
          <span class="text-warning">*</span>
          图片
        </label>

        <div class="col-lg-4">
          <div class="input-group">
            <input type="text" class="form-control" id="image" name="image">
                        <span class="input-group-btn">
                            <button id="select-thumb" class="btn btn-white" type="button">
                              <i class="fa fa-picture-o"></i>
                              选择图片
                            </button>
                        </span>
          </div>
        </div>

        <label class="col-lg-6 help-text" for="image">
          推荐宽度为640像素,高度不限,所有图片保持一致高度即可
        </label>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label" for="link-to">
          链接到
        </label>

        <div class="col-lg-4">
          <p class="form-control-static" id="link-to"></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label" for="enable">
          状态
        </label>

        <div class="col-lg-4">
          <label class="radio-inline">
            <input type="radio" name="enable" value="1" checked> 显示
          </label>
          <label class="radio-inline">
            <input type="radio" name="enable" value="0"> 不显示
          </label>

        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label" for="sort">
          顺序
        </label>

        <div class="col-lg-4">
          <input type="text" class="form-control" name="sort" id="sort">
        </div>

        <label class="col-lg-6 help-text" for="no">
          大的显示在前面,按从大到小排列.
        </label>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label" for="description">
          简介
        </label>

        <div class="col-lg-4">
          <textarea class="form-control" id="description" name="description"></textarea>
        </div>
      </div>

      <input type="hidden" name="id" id="id">
      <input type="hidden" name="url" id="url" value="">

      <div class="clearfix form-actions form-group">
        <div class="col-lg-offset-2">
          <button class="btn btn-primary" type="submit">
            <i class="fa fa-check bigger-110"></i>
            提交
          </button>
          &nbsp; &nbsp; &nbsp;
          <a class="btn btn-default" href="<?= $url('admin/album/index') ?>">
            <i class="fa fa-undo bigger-110"></i>
            返回列表
          </a>
        </div>
      </div>
    </form>
  </div>
  <!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
<!-- /.row -->

<?= $block('js') ?>
<script>
  require(['linkTo', 'form', 'ueditor', 'jquery-deparam'], function (linkTo, form) {
    var photoJson = <?= json_encode(wei()->category()->notDeleted()->withParent('photo')->getTreeToArray()) ?>;
    form.toOptions($('#class'), photoJson, 'id', 'name');

    var album = <?= $album->toJson() ?>;

    $('#album-form')
      .loadJSON(album)
      .loadParams()
      .ajaxForm({
        url: '<?= $url('admin/album/' . ($album->isNew() ? 'create' : 'update')) ?>',
        dataType: 'json',
        success: function (result) {
          $.msg(result, function () {
            if (result.code > 0) {
              window.location = $.url('admin/album/index');
            }
          });
        }
      });

    // 初始化链接选择器
    linkTo.init({
      $el: $('#link-to'),
      data: album.linkTo,
      hide: {
        keyword: true,
        decorator: true
      }
    });

    // 点击选择图片
    $('#image').imageInput();
  });
</script>
<?php $block->end() ?>

<?php require $view->getFile('@link-to/link-to/link-to.php') ?>
