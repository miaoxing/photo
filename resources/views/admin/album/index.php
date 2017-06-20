<?php $view->layout() ?>

<?= $block('css') ?>
<link rel="stylesheet" href="<?= $asset('plugins/photo/css/admin/photo.css') ?>"/>
<?= $block->end() ?>

<div class="page-header">
  <div class="pull-right">
    <a class="btn btn-success" href="<?= $url('admin/album/new') ?>">添加相片</a>
    <a class="btn btn-success" href="<?= $url('admin/albumCategory/index') ?>">管理相册专辑</a>
  </div>
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
    <div class="table-responsive">
      <div class="well form-well">
        <form class="form-inline" id="search-form" role="form">
          <div class="form-group">
            <select id="class" name="class">
              <option value="">全部专辑</option>
            </select>
          </div>

          <div class="form-group">
            <select id="enable" name="enable">
              <option value="">全部状态</option>
              <option value="1">显示</option>
              <option value="0">不显示</option>
            </select>
          </div>
        </form>
      </div>
      <table id="album-table" class="table-center table table-bordered table-hover">
        <thead>
        <tr>
          <th class="t-12">专辑</th>
          <th class="t-12">图片</th>
          <th>描述</th>
          <th>状态</th>
          <th>链接</th>
          <th>顺序</th>
          <th>操作</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    <!-- /.table-responsive -->
    <!-- PAGE CONTENT ENDS -->
  </div>
  <!-- /col -->
</div>
<!-- /row -->

<?php require $view->getFile('@link-to/link-to/link-to.php') ?>

<?= $block('js') ?>
<script>
  require(['linkTo', 'form', 'dataTable', 'jquery-deparam'], function (linkTo, form) {
    var photoJson = <?= json_encode(wei()->category()->notDeleted()->withParent('photo')->getTreeToArray()) ?>;
    form.toOptions($('#class'), photoJson, 'id', 'name');

    var recordTable = $('#album-table').dataTable({
      ajax: {
        url: $.queryUrl('admin/album.json')
      },
      columns: [
        {
          data: 'className'
        },
        {
          data: 'image',
          render: function (data, type, full) {
            return '<img class="album-img" src="' + data + '" />';
          }
        },
        {
          data: 'description'
        },
        {
          data: 'enable',
          render: function (data, type, full) {
            if (data == 1) {
              return '显示';
            }
            return '不显示';
          }
        },
        {
          data: 'linkTo',
          render: function (data, type, full) {
            return linkTo.renderLink(data, full.url);
          }
        },
        {
          data: 'sort',
          sClass: 'text-center'
        },
        {
          data: 'id',
          sClass: 'text-center',
          render: function (data, type, full) {
            return template.render('table-actions', full)
          }
        }
      ]
    });

    recordTable.on('click', '.delete-record', function () {
      var $this = $(this);
      $.confirm('删除后将无法还原,确认删除?', function () {
        $.post($this.data('href'), function (result) {
          $.msg(result);
          recordTable.reload();
        }, 'json');
      });
    });

    $('#search-form').update(function () {
      recordTable.reload($(this).serialize(), false);
    });
  });
</script>
<?= $block->end() ?>
<script id="table-actions" type="text/html">
  <div class="action-buttons">
    <a href="<?= $url('admin/album/edit') ?>?id=<%= id %>" title="编辑">
      <i class="fa fa-edit bigger-130"></i>
    </a>
    <a class="text-danger delete-record" data-href="<?= $url('admin/album/destroy') ?>?id=<%= id %>" href="javascript:"
      title="删除">
      <i class="fa fa-trash-o bigger-130"></i>
    </a>
  </div>
</script>
