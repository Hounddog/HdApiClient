<?php
return array(
    'service_manager' => array(
        'invokables' => array(
            'HD\Api\Client\Client'                        => 'HD\Api\Client\Client',
            'HD\Api\Client\Api\CurrentUser'               => 'HD\Api\Client\Api\CurrentUser',
            'HD\Api\Client\Api\User'                      => 'HD\Api\Client\Api\User',
            'HD\Api\Client\Api\Repos'                     => 'HD\Api\Client\Api\Repos',
            'HD\Api\Client\Api\Gist'                      => 'HD\Api\Client\Api\Gist',
            'HD\Api\Client\Api\GitData'                   => 'HD\Api\Client\Api\GitData',
            'HD\Api\Client\Api\Organization'              => 'HD\Api\Client\Api\Organization',
            'HD\Api\Client\Api\PullRequest'               => 'HD\Api\Client\Api\PullRequest',
            'HD\Api\Client\Api\Repository'                => 'HD\Api\Client\Api\Repository',
            'HD\Api\Client\Api\Issue'                     => 'HD\Api\Client\Api\Issue',
            'HD\Api\Client\Listener\Auth\HttpPassword'    => 'HD\Api\Client\Listener\Auth\HttpPassword',
            'HD\Api\Client\Listener\Auth\HttpToken'       => 'HD\Api\Client\Listener\Auth\HttpToken',
            'HD\Api\Client\Listener\Auth\UrlClientId'     => 'HD\Api\Client\Listener\Auth\UrlClientId',
            'HD\Api\Client\Listener\Auth\UrlToken'        => 'HD\Api\Client\Listener\Auth\UrlToken',
            'HD\Api\Client\Listener\Error'                => 'HD\Api\Client\Listener\Error',
            'HD\Api\Client\Listener\Cache'                => 'HD\Api\Client\Listener\Cache',
        ),
    )
);
