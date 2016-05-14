<?php
/**
 * Created by PhpStorm.
 * User: aluzzardi
 * Date: 14/05/16
 * Time: 13:03
 */

namespace Wneto\UserAgentBundle\Compare;

use Wneto\UserAgentBundle\Parser\ConfigurationParser;

/**
 * Class CompareStrategy
 * @package Wneto\UserAgentBundle\Compare
 */
class CompareStrategy
{
    /**
     * @param ConfigurationParser $configurationParser
     */
    public function __construct(ConfigurationParser $configurationParser)
    {
        $this->configurationParser = $configurationParser;
    }


    /**
     * @return CompareAllowAll|CompareBlockAll
     */
    public function init()
    {
        switch($this->configurationParser->getType()) {
            case 'whitelist':
                return new CompareBlockAll($this->configurationParser);
            case 'blacklist':
                return new CompareAllowAll($this->configurationParser);
            default:
                return new CompareBlockAll($this->configurationParser);
        }
    }

}