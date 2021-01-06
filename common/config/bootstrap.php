<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

// 定义别名 别名是 @common
// 别名用来表示文件路径和URL 别名以@开头
// 为了避免在代码中一些硬编码一些绝对路径和URL
