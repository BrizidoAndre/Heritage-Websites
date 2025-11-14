<?php

/** @var yii\web\View $this */
/** @var \app\models\FileModel $file */

$this->title = $file->title;
?>
<div class="cover">
    <img src="<?= \yii\helpers\Url::base(true) .'/content-pages/images/' . $file->image ?>
    " alt="">
    <div class="effect"></div>
</div>
<div class="site-index mt-5">
    <div class="col-5 bg-dark text-center mx-auto mb-4">
        <h1 class=" pb-3 text-light d-inline"><?= $file->title ?>
        </h1>
    </div>

    <div class="row position-relative">
        <div class="col-7 shadow p-3 content bg-light">
            <?php foreach ($file->content as $line): ?>
                <?= $line ?>
            <?php endforeach ?>
        </div>
        <aside class="col-4 shadow p-3 aside-stick bg-light">
            <ul>
                <?php if ($file->tags): ?>
                    <li>Tags: <?= implode(', ', $file->tags) ?></li>
                <?php endif ?>
                <?php if ($file->summary): ?>
                    <li>Summary: <?= $file->summary ?></li>
                <?php endif ?>
                <?php if ($file->image): ?>
                    <li>Image: <?= $file->image ?></li>
                <?php endif ?>
                <?php if ($file->date): ?>
                    <li>Date: <?= $file->date ?></li>
                <?php endif ?>
            </ul>
        </aside>
    </div>
</div>


<script>
    let effect = document.querySelector('.effect');
    let cover = document.querySelector('.cover');

    window.addEventListener('mousemove',function(ev){
        let mouseX = ev.x;
        let mouseY = ev.y;

        effect.style.top = mouseY + 'px';
        effect.style.left = mouseX + 'px';
    })
</script>