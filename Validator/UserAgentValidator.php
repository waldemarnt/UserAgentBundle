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

        return $this->checkIfListHaveAgentAllowed($agentList);
    }

    /**
     * @param $agentList
     * @return bool
     */
    public function checkIfListHaveAgentAllowed($agentList)
    {
        foreach($agentList as $agent) {
            $separatedAgent = $this->splitAgent($agent);
            if($this->isPatternAllowed($separatedAgent)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $separatedAgent
     * @return bool|mixed
     */
    public function isPatternAllowed($separatedAgent)
    {
        foreach($this->configurationParser->getPatterns() as $pattern) {
            if($this->isAbleToCompare($pattern, $separatedAgent)) {
                return $this->compare($pattern, $separatedAgent);
            }
        }

        return false;
    }

    /**
     * @param $pattern
     * @param $separatedAgent
     * @return bool
     */
    public function isAbleToCompare($pattern, $separatedAgent)
    {
        if(in_array($pattern->getPattern(), $separatedAgent) && $pattern->isAllowed() == true) {
            return true;
        }

        return false;
    }

    /**
     * @param $pattern
     * @param $separatedAgent
     * @return bool|mixed
     */
    public function compare($pattern, $separatedAgent)
    {
        if(isset($separatedAgent[1])){
            return version_compare($separatedAgent[1], $pattern->getVersion(), $pattern->getOperator());
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