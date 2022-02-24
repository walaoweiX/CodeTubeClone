<?php

use \yii\bootstrap4\Nav;
?>

<aside class="shadow" style="min-width: 200px;">
    <?php
    echo Nav::widget([
        'options' => [
            'class' => 'nav d-flex flex-column nav-pills'
        ],
        'items' => [
            [
                'label' => 'Home',
                'url' => ['/video/index']
            ],
            [
                'label' => 'History',
                'url' => ['/video/history']
            ]
        ]
    ])

    ?>
</aside>