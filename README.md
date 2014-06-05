Client Api Module for Zend Framework 2
===

[![Latest Stable Version](https://poser.pugx.org/hounddog/hd-api-client/v/stable.png)](https://packagist.org/packages/hounddog/hd-api-client)
[![Latest Unstable Version](https://poser.pugx.org/hounddog/hd-api-client/v/unstable.png)](https://packagist.org/packages/hounddog/hd-api-client)
[![Build Status](https://travis-ci.org/Hounddog/hd-api-client.svg?branch=master)](https://travis-ci.org/hounddog/hd-api-client)
[![Code Coverage](https://scrutinizer-ci.com/g/Hounddog/hd-api-client/badges/coverage.png?s=0b25eec855c764443baf6e0fc1df3bd080eb0b01)](https://scrutinizer-ci.com/g/Hounddog/hd-api-client/)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Hounddog/hd-api-client/badges/quality-score.png?s=3da296bf6e430c7d920b9cc1b24a1221635d2069)](https://scrutinizer-ci.com/g/Hounddog/hd-api-client/)

## Introduction

HdClientApi is a connector for variuous Api based Modules (e.g. Github, Twitter, Instagramm etc) based on Zend Framework 2 .

## Installation

### Main Setup

1. Clone this project into your `./vendor/` directory and enable it in your
   `application.config.php` file.

### Usage

## Basic Usage

Here is short example on how to use

    $client = $serviceManager->get('EdpGithub\Client');
    $repos = $client->api('user')->repos('hounddog');

This would fetch all the  Repositories for the user Hounddog

## Authentication

To use functionality which needs Authentication you have to first authenticate

    $client = $serviceManager->get('EdpGithub\Client');
    $client->authenticate('url_token', 'access_token');
    $repos = $client->api('current_user')->repos();

You can also listen to the Event <em>'EdpGithub\Client', 'api'</em>

    $em->attach('EdpGithub\Client', 'api', function($e) use ($sm) {
        $client = $e->getTarget();
        $client->authenticate('url_token', $token /* your access_token here */);
    } );

## Documentation
Please refer to the [Wiki](https://github.com/EvanDotPro/EdpGithub/wiki) for a more detailed Documentation