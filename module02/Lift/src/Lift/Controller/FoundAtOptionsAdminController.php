<?php


namespace Lift\Controller;


use Zend\Debug\Debug;
use Zend\Hydrator\ClassMethods;
use Zend\Mvc\Controller\AbstractActionController;

class FoundAtOptionsAdminController extends AbstractActionController
{
    private $foundAtRepo;
    private $foundAtForm;

    public function __construct($foundAtRepo, $foundAtForm)
    {
        $this->foundAtRepo = $foundAtRepo;
        $this->foundAtForm = $foundAtForm;
    }

    public function indexAction()
    {
        $this->foundAtForm->setHydrator(new ClassMethods());

        $this->foundAtForm->bind($this->foundAtRepo);

        if($this->getRequest()->isPost()) {

            $this->foundAtForm->setData($this->params()->fromPost());

            if($this->foundAtForm->isValid()){
                //Debug::dump($this->foundAtForm->getData());
            }else{
                //Debug::dump($this->foundAtForm->getMessages());
            }

        }

        return [
            'form' => $this->foundAtForm
        ];
    }
}