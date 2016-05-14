<?php
/**
 * Created by PhpStorm.
 * User: aluzzardi
 * Date: 14/05/16
 * Time: 19:50
 */

namespace Wneto\UserAgentBundle\Tests;


class ConfigurationMock extends \PHPUnit_Framework_TestCase
{
    private $config = [
        'enabled' => true,
        'type' => 'whitelist',
        'patterns' => [
            [
                'pattern' => 'Mozilla',
                'version' => '4.0.0',
                'operator' => '>'
            ],
        ]
    ];

    public function getMockConfig()
    {
        return $this->config;
    }
}