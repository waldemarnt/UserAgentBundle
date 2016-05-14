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

    /** @var CompareStrategy $compareStrategy */
    private $compareStrategy;

    public function setUp()
    {
        $mock = new ConfigurationMock();
        $this->configuration = $mock->getMockConfig();
        $this->parser = new ConfigurationParser($this->configuration);
        $this->compareStrategy = new CompareStrategy($this->parser);
    }

    public function testIsAllowed()
    {
        $userAgentValidator = new UserAgentValidator($this->parser, $this->compareStrategy);
        $this->assertTrue($userAgentValidator->isAllowed($this->userAgentHeader), "It's allowed");
    }

}