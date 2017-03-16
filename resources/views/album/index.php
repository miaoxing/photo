<?php $view->layout('plugin:layouts/jqm.php') ?>

<?= $block('css') ?>
<link rel="stylesheet" href="<?= $asset([
  'assets/buttonsRow.css',
  'assets/apps/album.css',
  'comps/TouchNSwipe/css/touchnswipe.min.css',
  'comps/TouchNSwipe/css/fullscreen_popup.css',
]) ?>"/>
<?= $block->end() ?>

<div class="buttons-row album-buttons-row">
  <?php foreach ($categories as $category) : ?>
    <a href="<?= $url('album', ['categoryId' => $category['id']]) ?>"
      class="button tab-link <?= $currCategory['id'] == $category['id'] ? 'active' : '' ?>"><?= $category['name'] ?></a>
  <?php endforeach ?>
</div>

<ul id="album-list">
  <?php foreach ($albums as $i => $album) : ?>
    <li class="item">
      <img src="<?= $album['image'] ?>" data-link="slider:0; index:<?= $i ?>">
    </li>
  <?php endforeach ?>
</ul>

<!-- 代码均用第三方代码编辑，不进行单元测试 -->
<!-- htmllint preset="none" -->
<!-- htmllint tag-name-match="false" -->

<div class="sliderHolder" data-elem="sliderHolder">
  <div class="slider" data-elem="slider" data-options="initShow:false; resetScrollDuration:1;"
    data-show="autoAlpha:1; display:block" data-hide="autoAlpha:0; display:none">
    <div class="sliderBg blackBgAlpha90"></div>
    <div class="slides" data-elem="slides"
      data-options="preloaderUrl:/comps/TouchNSwipe/assets/preloader.gif; resizeDuration:1; adjustHeight:-30"></div>
    <div class="captionHolder" data-elem="captionHolder">
      <div class="caption blackBgAlpha60" data-elem="caption"
        data-options="initShow:true; setHolderHeight:true; resizeDuration:1;"
        data-show="top:0%; display:block; autoAlpha:1;"
        data-hide="top:-60px; display:none; autoAlpha:0; ease:Power4.easeIn"></div>
    </div>
    <div class="controlHolder">
      <div class="autoPlayIcon controlPos1" data-elem="autoPlay" data-on="background-position:-25px 0px;"
        data-off="background-position:0px 0px;"></div>
      <div class="prevIcon controlPos2" data-elem="prev" data-on="autoAlpha:1; cursor: pointer;"
        data-off="autoAlpha:0.5; cursor:default"></div>
      <div class="nextIcon controlPos3" data-elem="next" data-on="autoAlpha:1; cursor: pointer;"
        data-off="autoAlpha:0.5; cursor:default"></div>
      <div class="zoomOutIcon controlPos4" data-elem="zoomOut" data-on="autoAlpha:1; cursor: pointer;"
        data-off="autoAlpha:0.5; cursor:default"></div>
      <div class="zoomInIcon controlPos5" data-elem="zoomIn" data-on="autoAlpha:1; cursor: pointer;"
        data-off="autoAlpha:0.5; cursor:default"></div>
      <div class="captionOnIcon controlPos6" data-elem="captionToggle" data-on="background-position:-150px 0px;"
        data-off="background-position:-175px 0px;"></div>
      <div class="closeIcon controlPos7" data-elem="close"></div>
    </div>
    <ul data-elem="items">
      <?php foreach ($albums as $i => $album) : ?>
        <li>
          <a href="<?= $album['image'] ?>">
            <img src="<?= $album['image'] ?>"/>
          </a>

          <div data-elem="imgCaption">
            <?= $album['description'] ?>
          </div>
        </li>
      <?php endforeach ?>
    </ul>
  </div>
</div>

<script>
  require(['comps/masonry/dist/masonry.pkgd.min'], function (Masonry) {
    var msnry = new Masonry('#album-list', {
      itemSelector: '.item',
      gutterWidth: 15
    });
  });
</script>
<script src="<?= $asset([
  'comps/TouchNSwipe/modernizr.min.js',
  'comps/TouchNSwipe/jquery.hammer.min.js',
  'comps/TouchNSwipe/TweenMax.min.js',
  'comps/TouchNSwipe/TouchNSwipe.js',
]) ?>"></script>
