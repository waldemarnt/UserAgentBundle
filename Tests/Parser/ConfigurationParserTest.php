<?php
/**
 * Created by PhpStorm.
 * User: aluzzardi
 * Date: 14/05/16
 * Time: 16:25
 */

namespace Wneto\UserAgentBundle\Tests\Parser;


use Wneto\UserAgentBundle\Parser\ConfigurationParser;

class ConfigurationParserTest extends \PHPUnit_Framework_TestCase
{
    protected $configuration = [
        'enabled' => true,
        'type' => 'whitelist',
        'patterns' => [
            [
                'pattern' => 'Mozilla',
                'version' => '5.0.5',
                'operator' => '>'
            ],
        ]
    ];

    /** @var ConfigurationParser $parser */
    protected $parser;



    public function setUp()
    {
        $this->parser = new ConfigurationParser($this->configuration);
    }

    public function testGetValidation()
    {
        $this->assertEquals($this->configuration['enabled'], $this->parser->isEnabled());
    }

    public function testGetType()
    {
        $this->assertEquals($this->configuration['type'], $this->parser->getType());
    }

    public function testPatterns()
    {
        $this->assertInstanceOf('Wneto\\UserAgentBundle\\Entity\\Pattern', $this->parser->getPatterns()[0]);
    }

}