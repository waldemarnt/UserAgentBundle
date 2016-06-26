<?php

namespace Wneto\UserAgentBundle\EventListener;

use Wneto\UserAgentBundle\Validator\UserAgentValidator;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class OnKernelControllerListener
{
    /**
     * @var UserAgentValidator $userAgentValidator
     */
    protected $userAgentValidator;

    public function __construct(UserAgentValidator $userAgentValidator)
    {
        $this->userAgentValidator = $userAgentValidator;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        if (!$this->userAgentValidator->useOnKernelListener()) {
            return;
        }

        if (!$this->isDeviceAllowed($event->getRequest())) {
            throw new \InvalidArgumentException("User Agent can't receive updates anymore");
        }
    }

    /**
     * @param $request
     *
     * @return bool|mixed
     */
    private function isDeviceAllowed($request)
    {
        if ($this->userAgentValidator->isEnabled()) {
            return $this->userAgentValidator->isAllowed($request->headers->get('user-agent'));
        }

        return true;
    }
}