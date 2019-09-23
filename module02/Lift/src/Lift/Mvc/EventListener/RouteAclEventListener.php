<?php


namespace Lift\Mvc\EventListener;


use Lift\Auth\AuthServiceAwareInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Navigation\Page\Mvc;

class RouteAclEventListener implements AuthServiceAwareInterface
{
    private $authService;

    public function attach($eventManager)
    {
        $eventManager->attach(MvcEvent::EVENT_ROUTE, [$this, 'onRoute']);
    }

    public function onRoute(MvcEvent $e)
    {
        $locator = $e->getApplication()->getServiceManager();
        //$authService = $locator->get(AuthenticationService::class);
        $routeMatch = $e->getRouteMatch();
        $routeResource = $routeMatch->getParam('resource', '');
        $acl = $locator->get('Lift\Acl\Acl');

        $userRole = $this->authService->hasIdentity() ? $this->authService->getIdentity()->getRole() : $acl->getDefaultRole();

        if($acl->isAllowed($userRole, $routeResource) === false) {
            $e->stopPropagation();
            return $e->getResponse()
                ->setStatusCode(Response::STATUS_CODE_403)
                ->setContent('Access denied! Go away!');
        }
    }

    public function setAuthService(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }
}