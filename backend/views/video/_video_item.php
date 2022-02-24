<?php

/**
 * @var $model \common\models\Video
 */

use \yii\helpers\StringHelper;
use \yii\helpers\Url;

?>



<div class="media">
    <a href="<?php echo Url::to(['/video/update', 'video_id' => $model->video_id]) ?>">
        <div class="ratio ratio-16x9 mr-3" style="width: 140px;">
            <video width="100%" poster="<?php echo $model->getThumbnailLink() ?>" src="<?php echo $model->getVideoLink() ?>"></video>
        </div>
    </a>
    <div class="media-body">
        <h6 class="mt-0"><?php echo $model->title ?></h6>
        <p><?php echo StringHelper::truncateWords($model->description, 10) ?></p>
    </div>
</div>