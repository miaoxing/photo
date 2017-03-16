<?php $view->layout() ?>

<div class="page-header">
  <h1>
    微官网
    <small>
      <i class="fa fa-angle-double-right"></i>
      相册专辑管理
    </small>
  </h1>
</div>
<!-- /.page-header -->

<div class="row">
  <div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <form id="category-form" class="form-horizontal" method="post" role="form">

      <div class="form-group">
        <label class="col-lg-2 control-label" for="parent-id">
          所属专辑
        </label>

        <div class="col-lg-4">
          <select name="parentId" id="parent-id" class="form-control">
            <option value="photo">根专辑</option>

          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label" for="binding">
          绑定栏目
        </label>

        <div class="col-lg-4">
          <select name="binding" id="binding" class="form-control">
            <option value="">无</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label" for="name">
          <span class="text-warning">*</span>
          名称
        </label>

        <div class="col-lg-4">
          <input type="text" class="form-control" name="name" id="name" data-rule-required="true">
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-2 control-label" for="sort">
          顺序
        </label>

        <div class="col-lg-4">
          <input type="text" class="form-control" name="sort" id="sort">
        </div>

        <label class="col-lg-6 help-text" for="sort">
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
      <input type="hidden" name="type" id="type" value="photo">

      <div class="clearfix form-actions form-group">
        <div class="col-lg-offset-2">
          <button class="btn btn-primary" type="submit">
            <i class="fa fa-check bigger-110"></i>
            提交
          </button>
          &nbsp; &nbsp; &nbsp;
          <a class="btn btn-default" href="<?= $url('admin/albumCategory/index') ?>">
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
  require(['form', 'ueditor', 'jquery-deparam', 'dataTable', 'validator'], function (form) {
    var photoJson = <?= json_encode(wei()->category()->notDeleted()->withParent('photo')->getTreeToArray()) ?>;
    form.toOptions($('#parent-id'), photoJson, 'id', 'name');

    <?php if ($plugin->isInstalled('mall')) : ?>
    var mallJson = <?= json_encode(wei()->category()->notDeleted()->withParent('mall')->getTreeToArray()) ?>;
      form.toOptions($('#binding'), mallJson, 'id', 'name');
    <?php endif ?>

    var category = <?= $category->toJson() ?>;

    $('#category-form')
      .loadJSON(category)
      .loadParams()
      .ajaxForm({
        url: '<?= $url('admin/category/' . ($category->isNew() ? 'create' : 'update')) ?>',
        dataType: 'json',
        beforeSubmit: function (arr, $form, options) {
          return $form.valid();
        },
        success: function (result) {
          $.msg(result, function () {
            if (result.code > 0) {
              window.location = $.url('admin/albumCategory/index');
            }
          });
        }
      })
      .validate();

  });
</script>
<?= $block->end() ?>
