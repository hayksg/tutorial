<?php

namespace Tutorial\Service;

use Tutorial\Service\GreetingServiceInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\Event;

class GreetingService implements GreetingServiceInterface
{
    private $eventManager;

    public function getGreeting()
    {
        date_default_timezone_set('Asia/Yerevan');
        $output = '';
        $hour = date('H');

        $this->getEventManager()->setIdentifiers(['getGreetingIdentifier']);
        $this->getEventManager()->trigger('getGreeting', $this, ['hour' => $hour]);

        /*$event = new Event();
        $event->setName(__FUNCTION__);
        $event->setParams(['hour' => $hour]);
        $this->getEventManager()->triggerEvent($event);*/

        if ($hour > 5 && $hour <= 11) {
            $output = 'Good morning';
        } elseif ($hour > 11 && $hour <= 17) {
            $output = 'Good day';
        } elseif ($hour > 17 && $hour <= 23) {
            $output = 'Good evening';
        } else {
            $output = 'Good night';
        }

        return $output;
    }

    public function setEventManager(EventManagerInterface $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function getEventManager()
    {
        return $this->eventManager;
    }
}
