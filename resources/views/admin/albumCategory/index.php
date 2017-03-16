<?php $view->layout() ?>

<div class="page-header">
  <div class="pull-right">
    <a class="btn btn-success" href="<?= $url('admin/albumCategory/new') ?>">添加专辑</a>
    <a class="btn btn-default" href="<?= $url('admin/album/index') ?>">返回相册列表</a>
  </div>
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
    <div class="table-responsive">
      <div class="well form-well">
        <form class="form-inline" id="search-form" role="form">
          <div class="form-group">
            <input type="text" class="form-control" name="search" placeholder="请输入名称搜索">
          </div>
        </form>
      </div>
      <table id="category-table" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>名称</th>
          <th>简介</th>
          <th class="t-8">顺序</th>
          <th class="t-12">操作</th>
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

<script id="table-actions" type="text/html">
  <div class="action-buttons">
    <a href="<%= $.url('admin/albumCategory/edit', {id: id}) %>" title="编辑">
      <i class="fa fa-edit bigger-130"></i>
    </a>
    <% if(canDelete == 1) { %>
    <a class="text-danger delete-record" href="javascript:"
      data-href="<%= $.url('admin/albumCategory/destroy', {id: id}) %>" title="删除">
      <i class="fa fa-trash-o bigger-130"></i>
    </a>
    <% } %>
  </div>
</script>

<?= $block('js') ?>
<script>
  require(['assets/apps/admin/category', 'dataTable', 'form', 'jquery-deparam'], function (category) {
    var recordTable = $('#category-table').dataTable({
      ajax: {
        url: $.url('admin/albumCategory.json', {parentId: 'photo'})
      },
      columns: [
        {
          data: 'name',
          render: function (data, type, full) {
            return category.generatePrefix(full.level) + data;
          }
        },
        {
          data: 'description',
          render: function (data) {
            return data || '-';
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
            return template.render('table-actions', full);
          }
        }
      ]
    });

    recordTable.deletable();

    $('#search-form').update(function () {
      recordTable.reload($(this).serialize(), false);
    });
  });
</script>
<?= $block->end() ?>
