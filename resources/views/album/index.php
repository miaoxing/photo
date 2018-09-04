<?php

$view->layout();
?>

<div id="show">
  显示图片
  <img class="js-a" src="">
  <pre id="pre">

  </pre>
</div>

<?= $block->js() ?>
<script>
  require(['plugins/wechat/js/wx'], function (wx) {
    wx.load(function () {
      wx.chooseImage({
        //sizeType: ['original'], // 可以指定是原图还是压缩图，默认二者都有
        success: function (res) {
          // {sourceType: "album"}
          //

          alert(JSON.stringify(res));

          var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
          $.each(localIds, function (i, localId) {
            $('.js-a').attr('src', localId);

            // wx.uploadImage({
            //   localId: localId, // 需要上传的图片的本地ID，由chooseImage接口获得
            //   success: function (res) {
            //     alert(JSON.stringify(res));
            //   }
            // });
          });
        }
      });
    });
  });
</script>
<?= $block->end() ?>
