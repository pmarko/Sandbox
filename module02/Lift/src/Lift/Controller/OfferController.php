<?php


namespace Lift\Controller;


use Doctrine\Common\Collections\Criteria;
use Lift\Repository\OfferRepository;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Model\ViewModel;

class OfferController extends AbstractActionController
{
    /**
     * @var OfferRepository
     */
    private $repository;

    /**
     * OfferController constructor.
     * @param OfferRepository $repo
     */
    public function __construct(OfferRepository $repository)
    {
        $this->repository = $repository;
    }

    public function indexAction()
    {
        $page = $this->params()->fromQuery('page', '1');
        $size = $this->params()->fromQuery('size', '10');
        $search = $this->params()->fromQuery('search', '');

        $searchBox = new SearchBox();

        $criteria = $searchBox->createCriteria($search);

        $items = $this->repository->findAllAsPaginatorAdapter($criteria);

        $paginator = new Paginator($items);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage($size);

        $viewModel = new ViewModel();
        $viewModel->addChild($this->createViewModel('lift/offer/table', $paginator), 'table');
        $viewModel->addChild($this->createViewModel('lift/offer/table-footer', $paginator), 'footer');

        return $viewModel;
    }

    public function renderTableAction()
    {
        $size = $this->params('size', 10);
        $items = $this->repository->findAllAsPaginatorAdapter();
        $paginator = new Paginator($items);
        $paginator->setItemCountPerPage($size);
        return $this->createViewModel('lift/offer/table', $paginator);
    }

    private function createViewModel($template, $paginator)
    {
        $viewModel = new ViewModel();
        $viewModel->setVariable('items', $paginator);
        $viewModel->setTemplate($template);
        return $viewModel;
    }
}

class SearchBox
{
    private $map = [
        'from' => 'o.fromLocation',
        'to' => 'o.toLocation'
    ];

    public function createCriteria($searchText)
    {
        $criteria = Criteria::create();

        if(strlen($searchText) == 0){
            return $criteria;
        }

        $searchPairs = explode(" ", $searchText);

        $allowedFields = array_keys($this->map);

        foreach ($searchPairs as $pair){

            $search = explode(":", $pair);

            $searchField = $search[0];
            $searchValue = $search[1];

            if(!in_array($searchField, $allowedFields)){
                continue;
            }

            $criteria->orWhere(Criteria::expr()->eq($this->map[$searchField], $searchValue));
        }

        return $criteria;

    }
}