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
     * @var String
     */
    private $type;

    /**
     * @boolean
     */
    private $enabled = false;

    public function __construct($configuration)
    {
        $this->configuration = $configuration;
        $this->enabled = $this->configuration['user_agent_validation'];
        $this->type = $this->configuration['user_agent_type'];
        $this->patterns = $this->hidrateEntities($this->configuration['user_agent_patterns']);
    }

    private function hidrateEntities($user_agent_patterns)
    {
        $patterns = [];
        foreach ($user_agent_patterns as $pattern) {
            $patternEntity = new Pattern();
            $patternEntity->setPattern($pattern['pattern']);
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

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}
