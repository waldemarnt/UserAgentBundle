<?php

namespace Wneto\UserAgentBundle\Entity;

use Wneto\UserAgentBundle\Compare\Validator\VersionCompareOperatorsValidator;

class Pattern
{
    private $pattern;

    private $version;

    private $operator;

    private $operatorValidator;

    public function __construct()
    {
        $this->operatorValidator = new VersionCompareOperatorsValidator();
    }

    /**
     * @return mixed
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @param mixed $pattern
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return mixed
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @param mixed $operator
     */
    public function setOperator($operator)
    {
        if ($this->operatorValidator->validate($operator)) {
            $this->operator = $operator;
        }
    }

}
