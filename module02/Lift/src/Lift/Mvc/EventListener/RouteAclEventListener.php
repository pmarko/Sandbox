<?php


namespace Lift\Mvc\EventListener;


use Lift\Auth\AuthServiceAwareInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Console\Request as ConsoleRequest;
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
        // at the moment no acl for cli
        if($e->getRequest() instanceof ConsoleRequest) return;

        $routeMatch = $e->getRouteMatch();
        // only work for lift section and nothing else
        if(strpos($routeMatch->getMatchedRouteName(), 'lift') !== 0) return;

        $locator = $e->getApplication()->getServiceManager();

        $routeResource = $routeMatch->getParam('resource', 'default');

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