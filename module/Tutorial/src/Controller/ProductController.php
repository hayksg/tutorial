<?php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProductController extends AbstractActionController
{
    public function indexAction()
    {
        $view = new ViewModel();
    }

    public function editAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id', 0);
        $view = new ViewModel([
            'id' => $id,
        ]);
        return $view;
    }

    public function editPostAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id', 0);
        $postValue = $this->request->getPost('value');
        $view = new ViewModel([
            'id' => $id,
            'postValue' => $postValue,
        ]);
        return $view;
    }
}
