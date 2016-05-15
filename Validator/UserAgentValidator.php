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
        $agent = $this->getAgenFromUserAgentHeader($userAgentHeader);

        return $this->checkIfListHaveAgentAllowed($agent);
    }

    /**
     * @param $agent
     * @return bool
     */
    protected function checkIfListHaveAgentAllowed($agent)
    {
        if ($this->compareStrategy->isPatternAllowed($agent)) {
            return true;
        }

        return false;
    }

    /**
     * @param $userAgentHeader
     * @return array
     */
    protected function getAgenFromUserAgentHeader($userAgentHeader)
    {
        preg_match("/(firefox|msie|chrome|safari)[\/\s]([\d.]+)/i", $userAgentHeader, $matches);
        return [
            $matches[1],
            $matches[2]
        ];
    }

    /**
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->configurationParser->isEnabled();
    }
}