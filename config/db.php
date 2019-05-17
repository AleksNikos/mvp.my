<?php

return [
    'class' => 'yii\db\Connection',
// это хостинг
//    'dsn' => 'mysql:host=localhost;dbname=host1410347_nlabdb',
//    'username' => 'host1410347_vitalij',
//    'password' => '8KJIXt4p',
//это vps
//    'dsn' => 'mysql:host=localhost;dbname=admin_default',
//    'username' => 'admin_default',
//    'password' => 'wX94nf91gy',
//Это локалка
    'dsn' => 'mysql:host=localhost;dbname=mvp',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'enableQueryCache'=>true,

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
