<?php

namespace Application;

class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getViewHelperConfig()
    {
        return [
            'invokables' => [
                'getYear' => View\Helper\GetYear::class,
                'getTime' => View\Helper\GetTime::class,
            ],
        ];
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'top_navigation' => Service\TopNavigationService::class,
            ],
        ];
    }
}
