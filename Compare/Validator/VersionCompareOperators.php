<?php
/**
 * Created by PhpStorm.
 * User: aluzzardi
 * Date: 14/05/16
 * Time: 14:51
 */

namespace Wneto\UserAgentBundle\Compare\Validator;

/**
 * Class VersionCompareOperators
 * @package Wneto\UserAgentBundle\Validator
 *
 * @Annotation
 *
 */
class VersionCompareOperators
{

    /**
     * @var string
     */
    protected $message = 'The operator "%s" is not allowed. Allowed operators: "%s"';
    /**
     * @var array
     */
    protected $operators = [
        '<',
        'lt',
        '<=',
        'le',
        '>',
        'gt',
        '>=',
        'ge',
        '==',
        '=',
        'eq',
        '!=',
        '<>'
    ];

    /**
     * @param $value
     *
     * @return string
     */
    public function getMessage($value)
    {
        return sprintf($this->message, $value, implode(', ', $this->operators));
    }

    /**
     * @return array
     */
    public function getOperators()
    {
        return $this->operators;
    }

}