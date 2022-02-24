<?php

/**
 * @var $channel common\models\User
 * @var $user \common\models\User
 */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<p>Hello <?php echo $channel->username ?></p>
<p>User <?php echo Html::a($user->username, Url::to([
            'channel/view', 'username' => $user->username,
        ], true), ['class' => 'text-dark']) ?> has subscribed to you</p>

<p>CodeTube team</p>