<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
$this->beginContent('@backend/views/layouts/base.php');
?>

<main class="d-flex" style="flex: 1; flex-direction: row;">
    <?php echo $this->render('_sidebar'); ?>
    <div class="content-wrapper p-3 col-lg-8">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<?php $this->endContent() ?>