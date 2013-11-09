<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'fm' => 'FlashMessenger\View\Helper\FlashMessenger',
        )
    ),
    'controller_plugins' => array(
        'invokables' => array(
            'fm' => 'FlashMessenger\Controller\Plugin\FlashMessenger',
        )
    ),
);