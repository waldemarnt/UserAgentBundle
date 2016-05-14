<?php
/**
 * Created by PhpStorm.
 * User: aluzzardi
 * Date: 14/05/16
 * Time: 19:59
 */

namespace Wneto\UserAgentBundle\Tests\Validator;

use Wneto\UserAgentBundle\Compare\CompareStrategy;
use Wneto\UserAgentBundle\Parser\ConfigurationParser;
use Wneto\UserAgentBundle\Tests\ConfigurationMock;
use Wneto\UserAgentBundle\Validator\UserAgentValidator;

class UserAgentValidatorTest extends \PHPUnit_Framework_TestCase
{
    protected $userAgentHeader = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36';

    protected $configuration;

    /** @var ConfigurationParser $parser */
    protected $parser;

    public function setUp()
    {
        $mock = new ConfigurationMock();
        $this->configuration = $mock->getMockConfig();
        $this->parser = new ConfigurationParser($this->configuration);
    }

    public function testIsAllowed()
    {
        $compareStrategy = new CompareStrategy($this->parser);
        $userAgentValidator = new UserAgentValidator($this->parser, $compareStrategy);
        $this->assertTrue($userAgentValidator->isAllowed($this->userAgentHeader), "It's allowed");

        $mock = new ConfigurationMock();
        $configuration = $mock->getMockConfig();
        $configuration['patterns'][0]['version'] = '7.0.0';
        $parser = new ConfigurationParser($configuration);
        $compareStrategy = new CompareStrategy($parser);
        $userAgentValidator = new UserAgentValidator($parser, $compareStrategy);
        $this->assertFalse($userAgentValidator->isAllowed($this->userAgentHeader), "It's not allowed");

        $mock = new ConfigurationMock();
        $configuration = $mock->getMockConfig();
        $configuration['patterns'][0]['pattern'] = null;
        $parser = new ConfigurationParser($configuration);
        $compareStrategy = new CompareStrategy($parser);
        $userAgentValidator = new UserAgentValidator($parser, $compareStrategy);
        $this->assertFalse($userAgentValidator->isAllowed($this->userAgentHeader), "It's not allowed");
    }

    public function testIsEnabled()
    {
        $compareStrategy = new CompareStrategy($this->parser);
        /** @var UserAgentValidator $userAgentValidator */
        $userAgentValidator = new UserAgentValidator($this->parser, $compareStrategy);
        $this->assertTrue($userAgentValidator->isEnabled(), "It's enabled");

        $mock = new ConfigurationMock();
        $configuration = $mock->getMockConfig();
        $configuration['enabled'] = false;
        $parser = new ConfigurationParser($configuration);
        $compareStrategy = new CompareStrategy($parser);
        $userAgentValidator = new UserAgentValidator($parser, $compareStrategy);
        $this->assertFalse($userAgentValidator->isEnabled(), "It's not enabled");
    }
}