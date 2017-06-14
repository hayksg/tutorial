<?php

namespace Application\Controller;

use Zend\Http\Header\SetCookie;
use Zend\Http\Headers;
use Zend\Http\Response\Stream;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class IndexController extends AbstractActionController
{
    const FILE_PATH = DIRECTORY_SEPARATOR . 'public' .
                      DIRECTORY_SEPARATOR . 'img' .
                      DIRECTORY_SEPARATOR . 'robot2.jpg';

    public function indexAction()
    {
        $message = '';

        /*$container = new Container('SomeMessage');
        $message = $container->message;
        $container->getManager()->getStorage()->clear('SomeMessage');*/

        $cookie = $this->getRequest()->getCookie();
        if ($cookie && $cookie->offsetExists('cookieMessage')) {
            $message = $cookie->offsetGet('cookieMessage');

            $cookie = new SetCookie('cookieMessage', '', time() - 3600, '');
            $this->getResponse()->getHeaders()->addHeader($cookie);
        }

        return new ViewModel([
            'message' => $message,
        ]);
    }

    public function downloadAction()
    {
        $file = getcwd() . self::FILE_PATH;

        if (is_file($file)) {
            $filesize = filesize($file);

            $response = new Stream();
            $response->setStream(fopen($file, 'r'));
            $response->setStreamName(basename($file));
            $response->setStatusCode(200);

            $headers = new Headers();
            $headers->addHeaderLine('Content-Type: application/octet-stream');
            $headers->addHeaderLine('Content-Disposition: attachment;filename = ' . basename($file));
            $headers->addHeaderLine('Content-Length: ' . $filesize);
            $headers->addHeaderLine('Cache-Control: no-store');

            $response->setHeaders($headers);
            return $response;
        }

        return false;
    }
}
