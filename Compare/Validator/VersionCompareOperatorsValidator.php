<?php
/**
 * Created by PhpStorm.
 * User: aluzzardi
 * Date: 14/05/16
 * Time: 14:56
 */

namespace Wneto\UserAgentBundle\Compare\Validator;

use Wneto\UserAgentBundle\Compare\Exception\WrongOperatorException;


/**
 * Class VersionCompareOperatorsValidator
 * @package Wneto\UserAgentBundle\Compare\Validator
 */
class VersionCompareOperatorsValidator
{
    /** @var VersionCompareOperators $constraint */
    private $constraint;


    /**
     * VersionCompareOperatorsValidator constructor.
     */
    public function __construct()
    {
        $this->constraint = new VersionCompareOperators();
    }

    /**
     * @param $value
     *
     * @return true;
     *
     * @throws WrongOperatorException
    */
    public function validate($value)
    {
        if (!in_array($value, $this->constraint->getOperators())) {
            throw new WrongOperatorException($this->constraint->getMessage($value));
        }

        return true;
    }
}