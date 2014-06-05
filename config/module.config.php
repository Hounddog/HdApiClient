<?php
return array(
    'service_manager' => array(
        'invokables' => array(
            'HD\Api\Client\Client'                        => 'HD\Api\Client\Client',
            'HD\Api\Client\Listener\Auth\HttpPassword'    => 'HD\Api\Client\Listener\Auth\HttpPassword',
            'HD\Api\Client\Listener\Auth\HttpToken'       => 'HD\Api\Client\Listener\Auth\HttpToken',
            'HD\Api\Client\Listener\Auth\UrlClientId'     => 'HD\Api\Client\Listener\Auth\UrlClientId',
            'HD\Api\Client\Listener\Auth\UrlToken'        => 'HD\Api\Client\Listener\Auth\UrlToken',
            'HD\Api\Client\Listener\Error'                => 'HD\Api\Client\Listener\Error',
            'HD\Api\Client\Listener\Cache'                => 'HD\Api\Client\Listener\Cache',
        ),
    )
);
