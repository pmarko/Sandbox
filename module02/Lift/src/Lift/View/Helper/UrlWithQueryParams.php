<?php


namespace Lift\View\Helper;


use Zend\Debug\Debug;
use Zend\Http\Request;
use Zend\View\Helper\AbstractHelper;

class UrlWithQueryParams extends AbstractHelper
{
    /**
     * @var Request
     */
    private $request;

    /**
     * UrlWithQueryParams constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function __invoke($name, $params = [], $options = [], $reuseMatchedParams = false)
    {
        $queryParams = $this->request->getQuery()->toArray();

        if(array_key_exists('query', $options)){
            $queryParams = array_merge($queryParams, $options['query']);
        }

        $options = array_merge($options, ['query' => $queryParams]);

        return $this->getView()->url($name, $params, $options, $reuseMatchedParams);
    }
}