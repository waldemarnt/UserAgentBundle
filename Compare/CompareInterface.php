<?php
/**
 * Created by PhpStorm.
 * User: aluzzardi
 * Date: 14/05/16
 * Time: 13:10
 */

namespace Wneto\UserAgentBundle\Compare;


use Wneto\UserAgentBundle\Entity\Pattern;

/**
 * Interface CompareInterface
 * @package Wneto\UserAgentBundle\Compare
 */
interface CompareInterface
{
    /**
     * @param $separatedAgent
     * @return bool|mixed
     */
    public function isPatternAllowed($separatedAgent);

    /**
     * @param Pattern $pattern
     * @param $separatedAgent
     * @return bool
     */
    public function isAbleToCompare(Pattern $pattern, $separatedAgent);

    /**
     * @param Pattern $pattern
     * @param $separatedAgent
     * @return bool|mixed
     */
    public function compare(Pattern $pattern, $separatedAgent);
}