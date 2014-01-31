<?php
return array(
    'service_manager' => array(
        'invokables' => array(
            'HdApiClient\Client'                        => 'HdApiClient\Client',
            'HdApiClient\Api\CurrentUser'               => 'HdApiClient\Api\CurrentUser',
            'HdApiClient\Api\User'                      => 'HdApiClient\Api\User',
            'HdApiClient\Api\Repos'                     => 'HdApiClient\Api\Repos',
            'HdApiClient\Api\Gist'                      => 'HdApiClient\Api\Gist',
            'HdApiClient\Api\GitData'                   => 'HdApiClient\Api\GitData',
            'HdApiClient\Api\Organization'              => 'HdApiClient\Api\Organization',
            'HdApiClient\Api\PullRequest'               => 'HdApiClient\Api\PullRequest',
            'HdApiClient\Api\Repository'                => 'HdApiClient\Api\Repository',
            'HdApiClient\Api\Issue'                     => 'HdApiClient\Api\Issue',
            'HdApiClient\Listener\Auth\HttpPassword'    => 'HdApiClient\Listener\Auth\HttpPassword',
            'HdApiClient\Listener\Auth\HttpToken'       => 'HdApiClient\Listener\Auth\HttpToken',
            'HdApiClient\Listener\Auth\UrlClientId'     => 'HdApiClient\Listener\Auth\UrlClientId',
            'HdApiClient\Listener\Auth\UrlToken'        => 'HdApiClient\Listener\Auth\UrlToken',
            'HdApiClient\Listener\Error'                => 'HdApiClient\Listener\Error',
            //'HdApiClient\HttpClient'                    => 'HdApiClient\Http\Client',
            'HdApiClient\Listener\Cache'                => 'HdApiClient\Listener\Cache',
        ),
    )
);
