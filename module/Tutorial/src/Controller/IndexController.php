<?php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Tutorial\Service\GreetingServiceInterface;
use Application\Controller\IndexController as IndexCtr;

class IndexController extends AbstractActionController
{
    private $greetingService;

    /*public function onDispatch(MvcEvent $e)
    {
        $this->layout('layout/layoutTutorial');
        return parent::onDispatch($e);
    }*/

    public function indexAction()
    {
        if ($this->request->isPost()) {
            //$this->prg();
        }

        $widget = $this->forward()->dispatch(IndexCtr::class, ['action' => 'index']);

        $view =  new ViewModel([
            'greeting' => $this->getGreetingService()->getGreeting(),
        ]);
        $view->addChild($widget, 'widget');
        //$view->setTemplate('tutorial/index/example2');
        return $view;
    }

    public function setGreetingService(GreetingServiceInterface $greetingService)
    {
        $this->greetingService = $greetingService;
    }

    public function getGreetingService()
    {
        return $this->greetingService;
    }

    public function exampleAction()
    {
        //return $this->redirect()->toUrl('http://rambler.ru');
        //return $this->forward()->dispatch(IndexCtr::class, ['action' => 'index']);

        $url = $this->url()->fromRoute();
        //$this->layout('layout/layoutTutorial');

        //$successMessage = 'Success message';
        //$this->flashMessenger()->addSuccessMessage($successMessage);

        //$errorMessage   = 'Error message';
        //$this->flashMessenger()->addErrorMessage($errorMessage);
        //return $this->redirect()->toRoute('home');

        return [
            'url'  => $url,
            'date' => $this->getDate(),
        ];
    }

    public function sampleAction()
    {
        return [];
    }

    public function fooAction()
    {
        return [];
    }

    public function barAction()
    {
        return [];
    }





}
