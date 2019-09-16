<?php


namespace Client\Mvc\EventListener;

use Client\Mvc\Validator\Policy\OperationClientPolicyValidator;
use Zend\EventManager\EventManagerInterface;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

class OperationClientEventListener
{
    /**
     * @var OperationClientPolicyValidator
     */
    private $validator;

    /**
     * OperationClientEventListener constructor.
     * @param OperationClientPolicyValidator $validator
     */
    public function __construct(OperationClientPolicyValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param EventManagerInterface $eventManager
     */
    public function attach(EventManagerInterface $eventManager)
    {
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, [$this, 'onDispatch']);
    }

    /**
     * @param MvcEvent $e
     * @return $this
     */
    public function onDispatch(MvcEvent $e)
    {
        $routeMatch = $e->getRouteMatch();

        if($routeMatch->getParam('check_operation_client_policy', false) &&
            !$this->validator->isValid($routeMatch))
        {
            $e->stopPropagation(true);
            $e->getResponse()->setStatusCode(Response::STATUS_CODE_404);
            $viewModel = new ViewModel();
            $viewModel->setTemplate('error/operation-client-404');
            $layout = $e->getViewModel();
            $layout->addChild($viewModel, 'content', false);
        }

        return $this;
    }
}