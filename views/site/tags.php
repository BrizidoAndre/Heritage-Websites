<?php

/** @var yii\web\View $this */
/** @var \app\models\FileModel [] $files */
/** @var string [] $folders */

$this->title = 'Listing page';
?>
<div class="site-index">
    <div class="col-5 bg-dark text-center mx-auto mb-4">
        <h1 class=" pb-3 text-light d-inline">Listing Page Layout</h1>
    </div>

    <div class="row">
        <div class="col-7 shadow p-3">
            <nav>
                <ul>
                    <?php foreach ($files as $file): ?>
                        <li>
                            <?= \yii\helpers\Html::a($file->pascalFilePath, \yii\helpers\Url::base(true) . '/heritages/' . $file->urlFilePath) ?>
                            <p>
                                <?= $file->summary ?>
                            </p>
                        </li>
                    <?php endforeach ?>
                </ul>
            </nav>
        </div>
        <div class="col-4 shadow p-3">
            <form action="">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Search</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="KEYWORD">
                </div>
                <button class="btn btn-outline-secondary">Search</button>
            </form>
        </div>
    </div>
</div>
