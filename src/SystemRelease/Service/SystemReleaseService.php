<?php

namespace SystemRelease\Service;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SystemReleaseService
 *
 * @author Achim Kramer <achim.kramer@platis.de>
 */
class SystemReleaseService implements \Zend\ServiceManager\ServiceManagerAwareInterface, \Zend\EventManager\EventManagerAwareInterface {
    
    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $serviceManager;
        
    /**
     *
     * @var \Zend\EventManager\EventManagerInterface
     */
    protected $eventManager;
    
    
    
    /**
     * This funtion injects a "System Release Bar" into final rendered View
     */
    public function injectSytemReleaseBar(\Zend\Mvc\MvcEvent $e) 
    {
        
        // load HTML response and inject HTML code
        $responseContent = $e->getResponse()->getContent();
        
        
        $injectedHTML = str_replace('<body>', '<body>
            <div style="width: 100%; height: 38px; background-color: orange; position: fixed; top: 0px; left: 0px; float: left; z-index: 1040;"><div style="width: 800px; margin: 0 auto; text-align: center; line-height: 38px; vertical-align: middle;">System: LOKAL ACHIM</div></div>',
                $responseContent);       
        
        // set "injected" Content
        $e->getResponse()->setContent($injectedHTML);
    }
    
    /**
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     */
    public function setServiceManager(\Zend\ServiceManager\ServiceManager $serviceManager) {
        
        $this->serviceManager = $serviceManager;        
    }
    
    /**
     * 
     * @return \Zend\ServiceManager\ServiceManager
     */
    public function getServiceManager() 
    {
        return $this->serviceManager;
    }

    /**
     * @return \Zend\EventManager\EventManagerInterface
     */
    public function getEventManager() {
        
        return $this->eventManager;
    }

    /**
     * 
     * @param \Zend\EventManager\EventManagerInterface $eventManager
     */
    public function setEventManager(\Zend\EventManager\EventManagerInterface $eventManager) {
        
        $this->eventManager = $eventManager;     
                        
        // cache $this
        $thiz = $this;
        
        // register for MvcEvent
        $this->getEventManager()->getSharedManager()->attach('Zend\Mvc\Application', \Zend\Mvc\MvcEvent::EVENT_FINISH, function($e) use ($thiz) {
            
            // inject system release bar
            $thiz->injectSytemReleaseBar($e);
            
        }, 10);        
    }    
}

