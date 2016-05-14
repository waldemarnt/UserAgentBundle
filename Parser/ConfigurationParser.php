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
     * @var array
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
        $this->enabled = $this->configuration['enabled'];
        $this->type = $this->configuration['type'];
        $this->patterns = $this->hydrateEntities($this->configuration['patterns']);
    }

    /**
     * @param array $userAgentPatterns
     * @return array
     */
    private function hydrateEntities($userAgentPatterns)
    {
        $patterns = [];
        foreach ($userAgentPatterns as $pattern) {
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
