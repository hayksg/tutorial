<?php

namespace Tutorial\Event;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Tutorial\Service\EventServiceInterface;
use Zend\EventManager\Event;

class GreetingServiceListenerAggregate implements ListenerAggregateInterface
{
    private $eventService;
    private $listeners = [];

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach('getGreeting', [$this, 'firstEvent'], $priority);
        $this->listeners[] = $events->attach('getGreeting', [$this, 'secondEvent'], $priority);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            $events->detach($listener);
            unset($listener[$index]);
        }
    }

    public function firstEvent(Event $event)
    {
        $params = $event->getParams();
        $this->getEventService()->onGetGreeting($params);
    }

    public function secondEvent(Event $event)
    {
        $params = $event->getParams();
        $this->getEventService()->onGetGreeting($params);
    }

    public function setEventService(EventServiceInterface $eventService)
    {
        $this->eventService = $eventService;
    }

    public function getEventService()
    {
        return $this->eventService;
    }
}
