<?php
/**
 * Created by PhpStorm.
 * User: aluzzardi
 * Date: 14/05/16
 * Time: 13:11
 */

namespace Wneto\UserAgentBundle\Compare;

use Wneto\UserAgentBundle\Entity\Pattern;

/**
 * Class CompareBlockAll
 * @package Wneto\UserAgentBundle\Compare
 */
class CompareBlockAll extends CompareAbstract
{
    /**
     * @inheritdoc
     */
    public function isPatternAllowed($separatedAgent)
    {
        foreach ($this->configuration->getPatterns() as $pattern) {
            if ($this->isAbleToCompare($pattern, $separatedAgent)) {
                return $this->compare($pattern, $separatedAgent);
            }
        }

        return false;
    }

}