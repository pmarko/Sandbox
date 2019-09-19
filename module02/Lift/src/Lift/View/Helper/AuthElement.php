<?php


namespace Lift\View\Helper;


use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Form\FormInterface;
use Zend\View\Helper\AbstractHelper;

class AuthElement extends AbstractHelper
{
    /**
     * @var AuthenticationServiceInterface
     */
    private $authService;

    /**
     * @var FormInterface
     */
    private $loginForm;

    /**
     * AuthElement constructor.
     * @param AuthenticationServiceInterface $authService
     * @param FormInterface $loginForm
     */
    public function __construct(AuthenticationServiceInterface $authService, FormInterface $loginForm)
    {
        $this->authService = $authService;
        $this->loginForm = $loginForm;
    }

    public function __invoke($loginUrl, $logoutUrl)
    {
        $view = $this->getView();
        if($this->authService->hasIdentity()) {
            return $view->partial('partials/layout/logout-button', [
                'user' => $this->authService->getIdentity(),
                'logout_url' => $logoutUrl
            ]);
        }else{
            $this->loginForm->setAttribute('action', $loginUrl);
            return $view->partial('partials/layout/login-form', [
                'form' => $this->loginForm
            ]);
        }
    }
}