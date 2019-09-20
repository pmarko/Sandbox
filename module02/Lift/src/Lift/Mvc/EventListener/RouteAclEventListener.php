<?php


namespace Lift\Mvc\EventListener;


use Zend\Authentication\AuthenticationService;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Navigation\Page\Mvc;

class RouteAclEventListener
{
    public function attach($eventManager)
    {
        $eventManager->attach(MvcEvent::EVENT_ROUTE, [$this, 'onRoute']);
    }

    public function onRoute(MvcEvent $e)
    {
        $locator = $e->getApplication()->getServiceManager();
        $authService = $locator->get(AuthenticationService::class);
        $routeMatch = $e->getRouteMatch();
        $routeResource = $routeMatch->getParam('resource', '');
        $acl = $locator->get('Lift\Acl\Acl');

        $userRole = $authService->hasIdentity() ? $authService->getIdentity()->getRole() : $acl->getDefaultRole();

        if($acl->isAllowed($userRole, $routeResource) === false) {
            $e->stopPropagation();
            return $e->getResponse()
                ->setStatusCode(Response::STATUS_CODE_403)
                ->setContent('Access denied! Go away!');
        }
    }
}