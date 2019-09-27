<?php
/**
 * Configuration file generated by ZFTool
 * The previous configuration file is stored in application.config.old
 *
 * @see https://github.com/zendframework/ZFTool
 */
return array(
    'modules' => array(
        'DoctrineModule',
        'DoctrineORMModule',
        'Application',
        'Lift',
        'ZendDeveloperTools',
        'Zend\\Navigation',
        'GmM2M',
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './module02',
            './vendor',
        ),
        'config_glob_paths' => array(
            'config/autoload/{{,*.}global,{,*.}local}.php',
        ),
    ),
);
