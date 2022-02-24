<?php

/**
 * @var $model \common\models\Video;
 */

use \yii\helpers\Url;
?>


<div class="card m-3" style="width: 14rem;">
    <a href="<?php echo Url::to(['/video/view', 'id' => $model->video_id]) ?>">
        <div class="ratio ratio-16x9">
            <video width="100%" poster="<?php echo $model->getThumbnailLink() ?>" src="<?php echo $model->getVideoLink() ?>"></video>
        </div>
    </a>
    <div class="card-body p-1">
        <h6 class="text-muted card-title m-0"><?php echo $model->title ?></h6>
        <p class="text-muted card-text m-0">
            <?php echo yii\helpers\Html::a($model->createdBy->username, [
                'channel/view', 'username' => $model->createdBy->username,
            ], ['class' => 'text-dark']) ?>
        </p>
        <p class="card-textm-0">
            <?php echo $model->getViews()->count() ?> views .
            <?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?>
        </p>
    </div>
</div>