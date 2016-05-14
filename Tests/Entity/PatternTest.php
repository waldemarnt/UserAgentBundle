<?php
/**
 * Created by PhpStorm.
 * User: aluzzardi
 * Date: 14/05/16
 * Time: 14:12
 */

namespace Wneto\UserAgentBundle\Tests\Entity;

use Wneto\UserAgentBundle\Entity\Pattern;

class PatternTest extends \PHPUnit_Framework_TestCase
{
    public function testOperator()
    {
        $pattern = new Pattern();
        $pattern->setOperator('>');

        $this->assertEquals('>', $pattern->getOperator());
    }

    public function testOperatorException()
    {
        $this->setExpectedException('Wneto\\UserAgentBundle\\Compare\\Exception\\WrongOperatorException');

        $pattern = new Pattern();
        $pattern->setOperator('>>');
    }

    public function testPattern()
    {
        $pattern = new Pattern();
        $pattern->setPattern('Mozilla');

        $this->assertEquals('Mozilla', $pattern->getPattern());
    }

    public function testVersion()
    {
        $pattern = new Pattern();
        $pattern->setVersion('5.5.0');

        $this->assertEquals('5.5.0', $pattern->getVersion());
    }
}