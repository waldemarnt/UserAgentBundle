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
 * Class CompareAllowAll
 * @package Wneto\UserAgentBundle\Compare
 */
class CompareAllowAll extends CompareAbstract
{
    /**
     * @inheritdoc
     */
    public function isPatternAllowed($separatedAgent)
    {
        $allowed = true;
        foreach ($this->configuration->getPatterns() as $pattern) {
            if ($this->isAbleToCompare($pattern, $separatedAgent)) {
                if ($this->compare($pattern, $separatedAgent)) {
                    $allowed = false;
                }
            }
        }
        return $allowed;
    }

}