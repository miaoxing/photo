<?php

$view->layout();
?>

<pre><code id="c"></code></pre>

<?= $block->js() ?>
<script>
  require(['plugins/wechat/js/wx'], function (wx) {
    wx.load(function () {
      wx.getLocation({
        type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
        success: function (res) {
          var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
          var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
          var speed = res.speed; // 速度，以米/每秒计
          var accuracy = res.accuracy; // 位置精度
          alert(latitude);
          alert(longitude);
          // alert(JSON.stringify(res));
          $('#c').html(JSON.stringify(res));
        },
        fail: function (res) {
          alert('fail')
          alert(JSON.stringify(res));


        },
        complete: function (res) {
          //alert('complete')
          //alert(JSON.stringify(res));
        },
        cancel: function (res) {
          alert('cancel')
          alert(JSON.stringify(res));
        },
      });
    });
  });
</script>
<?= $block->end() ?>
