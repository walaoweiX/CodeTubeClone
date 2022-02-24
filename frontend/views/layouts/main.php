<?php

/** @var \yii\web\View $this */
/** @var string $content */


use common\widgets\Alert;


$this->beginContent('@frontend/views/layouts/base.php');
?>

<main class="d-flex" style="flex: 1; flex-direction: row;">
    <?php echo $this->render('_sidebar'); ?>
    <div class="content-wrapper p-3 col-lg-8">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<?php $this->endContent() ?>