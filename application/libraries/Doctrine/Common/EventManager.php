<?php
namespace Doctrine\Common;
class EventManager{
    private $_listeners = array();
    public function dispatchEvent($eventName, EventArgs $eventArgs = null){
        if (isset($this->_listeners[$eventName])) {
            $eventArgs = $eventArgs === null ? EventArgs::getEmptyInstance() : $eventArgs;
            foreach ($this->_listeners[$eventName] as $listener) {
                $listener->$eventName($eventArgs);
            }
        }
    }
    public function getListeners($event = null) {
        return $event ? $this->_listeners[$event] : $this->_listeners;
    }
    public function hasListeners($event) {
        return isset($this->_listeners[$event]) && $this->_listeners[$event];
    }
    public function addEventListener($events, $listener) {
        $hash = spl_object_hash($listener);
        foreach ((array) $events as $event) {
            $this->_listeners[$event][$hash] = $listener;
        }
    }
    public function removeEventListener($events, $listener) {
        $hash = spl_object_hash($listener);
        foreach ((array) $events as $event) {
            if (isset($this->_listeners[$event][$hash])) {
                unset($this->_listeners[$event][$hash]);
            }
        }
    }
    public function addEventSubscriber(EventSubscriber $subscriber){
        $this->addEventListener($subscriber->getSubscribedEvents(), $subscriber);
    }
    public function removeEventSubscriber(EventSubscriber $subscriber)
    {
        $this->removeEventListener($subscriber->getSubscribedEvents(), $subscriber);
    } 	
}