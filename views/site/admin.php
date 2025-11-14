<?php

/** @var yii\web\View $this */
/** @var \app\models\FileModel [] $files */
/** @var string [] $folders */
/** @var \app\models\UploadForm $model */

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
                            <p class="open-modal-paragraph">
                                <?= $file->title . ' ' . $file->date ?>
                            </p>
                        </li>
                    <?php endforeach ?>
                </ul>
            </nav>
        </div>
        <div class="col-4 shadow p-3">
            <?php
            \yii\bootstrap5\Modal::begin([
                'title' => 'Adding images',
                'toggleButton' => ['label' => 'Add Image', 'class' => 'btn btn-primary'],
            ]);
            $form = \yii\widgets\ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

            echo $form->field($model, 'imagePath')->textInput();
            echo $form->field($model, 'imageFile')->fileInput();

            echo '<button class="btn btn-primary">Submit</button>';

            \yii\widgets\ActiveForm::end();
            \yii\bootstrap5\Modal::end();
            ?>
        </div>
    </div>
</div>
