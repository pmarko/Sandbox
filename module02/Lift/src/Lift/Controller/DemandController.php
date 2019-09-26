<?php


namespace Lift\Controller;


use Lift\Repository\DemandRepository;
use Lift\Repository\OfferRepository;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Paginator;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Zend\View\View;
use ZFTool\Diagnostics\Reporter\VerboseConsole;

class DemandController extends AbstractActionController
{
    /**
     * @var array
     */
    protected $acceptMapping = [
        'Zend\View\Model\ViewModel' => [
            'text/html'
        ],
        'Zend\View\Model\JsonModel' => [
            'application/json'
        ]
    ];
    /**
     * @var DemandRepository
     */
    private $repository;

    /**
     * DemandController constructor.
     * @param DemandRepository $repository
     */
    public function __construct(DemandRepository $repository)
    {
        $this->repository = $repository;
    }

    public function indexAction()
    {
        $page = $this->params()->fromRoute('page');
        $size = $this->params()->fromRoute('size');

        $items = $this->repository->findAllAsPaginatorAdapter();

        $paginator = new Paginator($items);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage($size);

        $viewModel = new ViewModel();
        $viewModel->addChild($this->createViewModel('lift/demand/table', $paginator), 'table');
        $viewModel->addChild($this->createViewModel('lift/demand/table-footer', $paginator), 'footer');

        return $viewModel;
    }

    public function renderTableAction()
    {
        $size = $this->params()->fromRoute('size');
        $items = $this->repository->findAllAsPaginatorAdapter();
        $paginator = new Paginator($items);
        $paginator->setItemCountPerPage($size);
        return $this->createViewModel('lift/demand/table', $paginator);
    }

    private function createViewModel($template, $paginator)
    {
        $viewModel = new ViewModel();
        $viewModel->setVariable('items', $paginator);
        $viewModel->setTemplate($template);
        return $viewModel;
    }

}