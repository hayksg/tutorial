<?php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ArticleController extends AbstractActionController
{
    public function indexAction()
    {

        $view =  new ViewModel();
        return $view;
    }

    public function editAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id', 0);
        $view =  new ViewModel([
            'id' => $id,
        ]);
        return $view;
    }

    public function postAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id', 0);
        $postValue = $this->request->getPost('value');

        $view =  new ViewModel([
            'id' => $id,
            'postValue' => $postValue,
        ]);
        return $view;
    }
}
