<?php


namespace Lift\Mvc\EventListener;


use Zend\Authentication\AuthenticationService;
use Zend\Mvc\MvcEvent;

class NavigationHelperAclEventListener
{
    public function attach($eventManager)
    {
        $eventManager->attach(MvcEvent::EVENT_ROUTE, [$this, 'onRoute']);
    }

    public function onRoute(MvcEvent $e)
    {
        $locator = $e->getApplication()->getServiceManager();
        $navigationViewHelper = $locator->get('ViewHelperManager')->get('navigation');
        $acl = $locator->get('Lift\Acl\Acl');
        $authService = $locator->get(AuthenticationService::class);
        $userRole = $authService->hasIdentity() ?
            $authService->getIdentity()->getRole() : $acl->getDefaultRole();
        $navigationViewHelper->setAcl($acl)->setRole($userRole);
    }
}