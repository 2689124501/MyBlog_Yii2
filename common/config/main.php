<?php
return [
    // 为路径和URL设置别名
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',            
        ],
        'authManager' => [                
            'class' => 'yii\rbac\DbManager',
        ],
    ],
];
