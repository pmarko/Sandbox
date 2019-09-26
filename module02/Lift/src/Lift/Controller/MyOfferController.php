<?php


namespace Lift\Controller;


use Doctrine\Common\Collections\Criteria;
use Lift\Entity\OfferEntity;
use Lift\Form\MyOfferForm;
use Lift\Repository\MyOfferRepository;
use Lift\Repository\OfferRepository;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Model\ViewModel;

class MyOfferController extends AbstractActionController
{
    /**
     * @var MyOfferRepository
     */
    private $repository;

    /**
     * MyOfferController constructor.
     * @param OfferRepository $repo
     */
    public function __construct(MyOfferRepository $repository)
    {
        $this->repository = $repository;
    }

    public function indexAction()
    {
        $page = $this->params()->fromQuery('page', '1');
        $size = $this->params()->fromQuery('size', '10');
        $search = $this->params()->fromQuery('search', '');

        $items = $this->repository->findAllAsPaginatorAdapter();

        $paginator = new Paginator($items);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage($size);

        $viewModel = new ViewModel();
        $viewModel->addChild($this->createViewModel('lift/my-offer/table', $paginator), 'table');
        $viewModel->addChild($this->createViewModel('lift/my-offer/table-footer', $paginator), 'footer');

        return $viewModel;
    }

    public function createAction()
    {
        $form = @$this->getServiceLocator()
            ->get('FormElementManager')
            ->get(MyOfferForm::class);

        if($this->getRequest()->isPost()){

            $form->setData($this->params()->fromPost());

            if($form->isValid()){

                $newOffer = $form->getData();

                $this->repository->persist($newOffer);

                $this->repository->flush();

                return $this->redirect()->toRoute('lift/my_offer');
            }
        }

        return [
            'form' => $form
        ];
    }

    public function updateAction()
    {
        $id = $this->params()->fromRoute('id');

        $myOffer = $this->repository->find($id);

        if(!$myOffer){
            return $this->notFoundAction();
        }

        $form = @$this->getServiceLocator()
            ->get('FormElementManager')
            ->get(MyOfferForm::class);

        $form->bind($myOffer);

        if($this->getRequest()->isPost()){

            $form->setData($this->params()->fromPost());

            if($form->isValid()){

                $this->repository->flush();

                return $this->redirect()->toRoute('lift/my_offer');
            }
        }

        return [
            'form' => $form
        ];
    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');

        $offer = $this->repository->find($id);

        if(!$offer){
            return $this->notFoundAction();
        }

        $this->repository->remove($offer);

        $this->repository->flush();

        return $this->redirect()->toRoute('lift/my_offer');
    }

    /**
     * No route just for forward in HOME
     * @return ViewModel
     */
    public function renderTableAction()
    {
        $size = $this->params('size', 10);
        $items = $this->repository->findAllAsPaginatorAdapter();
        $paginator = new Paginator($items);
        $paginator->setItemCountPerPage($size);
        return $this->createViewModel('lift/my-offer/table', $paginator);
    }

    private function createViewModel($template, $paginator)
    {
        $viewModel = new ViewModel();
        $viewModel->setVariable('items', $paginator);
        $viewModel->setTemplate($template);
        return $viewModel;
    }
}