<?php

namespace Wneto\UserAgentBundle\Entity;

class Pattern
{
    private $pattern;

    private $allowed = false;

    private $version;

    private $operator;

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
     * @return boolean
     */
    public function isAllowed()
    {
        return $this->allowed;
    }

    /**
     * @param boolean $allowed
     */
    public function setAllowed($allowed)
    {
        $this->allowed = $allowed;
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
        $this->operator = $operator;
    }
}
