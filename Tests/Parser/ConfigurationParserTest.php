<?php
/**
 * Created by PhpStorm.
 * User: aluzzardi
 * Date: 14/05/16
 * Time: 16:25
 */

namespace Wneto\UserAgentBundle\Tests\Parser;


use Wneto\UserAgentBundle\Parser\ConfigurationParser;
use Wneto\UserAgentBundle\Tests\ConfigurationMock;

class ConfigurationParserTest extends \PHPUnit_Framework_TestCase
{
    protected $configuration;

    /** @var ConfigurationParser $parser */
    protected $parser;

    public function setUp()
    {
        $mock = new ConfigurationMock();
        $this->configuration = $mock->getMockConfig();
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