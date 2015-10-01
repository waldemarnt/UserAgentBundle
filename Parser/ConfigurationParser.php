<?php

namespace Wneto\UserAgentBundle\Parser;

use Wneto\UserAgentBundle\Entity\Pattern;

class ConfigurationParser
{
    /**
     * Injected configuration
     * @var String
     */
    private $configuration;

    /**
     * @var
     */
    private $patterns;

    /**
     * @var
     */
    private $whiteList;

    /**
     * @boolean
     */
    private $enabled = false;

    public function __construct($configuration)
    {
        $this->configuration = $configuration;
        $this->enabled = $this->configuration['user_agent_validation'];
        $this->patterns = $this->hidrateEntities($this->configuration['user_agent_patterns']);
    }

    private function hidrateEntities($user_agent_patterns)
    {
        $patterns = [];
        foreach ($user_agent_patterns as $pattern) {
            $patternEntity = new Pattern();
            $patternEntity->setPattern($pattern['pattern']);
            $patternEntity->setAllowed($pattern['allowed']);
            $patternEntity->setOperator($pattern['operator']);
            $patternEntity->setVersion($pattern['version']);
            $patterns[] = $patternEntity;
        }

        return $patterns;
    }

    /**
     * @return mixed
     */
    public function getPatterns()
    {
        return $this->patterns;
    }

    /**
     * @param mixed $patterns
     */
    public function setPatterns($patterns)
    {
        $this->patterns = $patterns;
    }

    /**
     * @return mixed
     */
    public function getWhiteList()
    {
        return $this->whiteList;
    }

    /**
     * @param mixed $whiteList
     */
    public function setWhiteList($whiteList)
    {
        $this->whiteList = $whiteList;
    }

    /**
     * @return mixed
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param mixed $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }
}
