<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    
    'service_manager' => array(
        'factories' => array(
            'SystemRelease\Service\SystemRelease' => function($sm) {
                
                // initialize and return system release service
                return new \SystemRelease\Service\SystemReleaseService();                
            },
        ),
    ),
);
