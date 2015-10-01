<?php

namespace Wneto\UserAgentBundle\Validator;

use Wneto\UserAgentBundle\Parser\ConfigurationParser;

class UserAgentValidator
{
    /**
     * @var
     */
    private $configurationParser;

    /**
     * @param ConfigurationParser $configurationParser
     */
    public function __construct(ConfigurationParser $configurationParser)
    {
        $this->configurationParser = $configurationParser;
    }

    /**
     * @param $userAgentHeader
     * @return bool|mixed
     */
    public function isAllowed($userAgentHeader)
    {
        $agentList = $this->getAgentListFromUserAgentHeader($userAgentHeader);
        foreach ($agentList as $agent) {
            $separatedAgent = $this->splitAgent($agent);
            foreach ($this->configurationParser->getPatterns() as $pattern) {
                if (in_array($pattern->getPattern(), $separatedAgent) && $pattern->isAllowed() == true) {
                    if (isset($separatedAgent[1])) {
                        return version_compare($separatedAgent[1], $pattern->getVersion(), $pattern->getOperator());
                    }
                }
            }
        }

        return false;
    }

    /**
     * @param $userAgentHeader
     * @return array
     */
    protected function getAgentListFromUserAgentHeader($userAgentHeader)
    {
        return explode(' ', $userAgentHeader);
    }

    /**
     * Split the agent in name and version
     * @param $agent
     * @return array
     */
    protected function splitAgent($agent)
    {
        return explode('/', $agent);
    }

    /**
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->configurationParser->isEnabled();
    }
}
