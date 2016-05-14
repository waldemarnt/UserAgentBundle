<?php
/**
 * Created by PhpStorm.
 * User: aluzzardi
 * Date: 14/05/16
 * Time: 13:32
 */

namespace Wneto\UserAgentBundle\Compare;

use Wneto\UserAgentBundle\Entity\Pattern;
use Wneto\UserAgentBundle\Parser\ConfigurationParser;

abstract class CompareAbstract implements CompareInterface
{
    /**
     * Injected configuration
     * @var String
     */
    protected $configuration;

    /**
     * CompareAbstract constructor.
     * @param ConfigurationParser $configurationParser
     */
    public function __construct(ConfigurationParser $configurationParser)
    {
        $this->configuration = $configurationParser;
    }

    /**
     * @param $separatedAgent
     * @return mixed
     */
    abstract public function isPatternAllowed($separatedAgent);

    /**
     * @param Pattern $pattern
     * @param $separatedAgent
     * @return mixed
     */
    public function isAbleToCompare(Pattern $pattern, $separatedAgent)
    {
        if (in_array($pattern->getPattern(), $separatedAgent)) {
            return true;
        }

        return false;
    }

    /**
     * @param Pattern $pattern
     * @param $separatedAgent
     * @return mixed
     */
    public function compare(Pattern $pattern, $separatedAgent)
    {
        if (isset($separatedAgent[1])) {
            return version_compare($separatedAgent[1], $pattern->getVersion(), $pattern->getOperator());
        }

        return false;
    }


}