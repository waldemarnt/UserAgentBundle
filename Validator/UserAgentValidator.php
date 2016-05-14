<?php

namespace Wneto\UserAgentBundle\Validator;

use Wneto\UserAgentBundle\Compare\CompareAllowAll;
use Wneto\UserAgentBundle\Compare\CompareBlockAll;
use Wneto\UserAgentBundle\Compare\CompareStrategy;
use Wneto\UserAgentBundle\Parser\ConfigurationParser;

class UserAgentValidator
{
    /**
     * @var
     */
    private $configurationParser;

    /** @var CompareBlockAll|CompareAllowAll compareStrategy */
    private $compareStrategy;

    /**
     * @param ConfigurationParser $configurationParser
     * @param CompareStrategy $compareStrategy
     */
    public function __construct(ConfigurationParser $configurationParser, CompareStrategy $compareStrategy)
    {
        $this->configurationParser = $configurationParser;
        /** @var CompareBlockAll|CompareAllowAll compareStrategy */
        $this->compareStrategy = $compareStrategy->init();
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
        foreach ($agentList as $agent) {
            $separatedAgent = $this->splitAgent($agent);
            if ($this->compareStrategy->isPatternAllowed($separatedAgent)) {
                return true;
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