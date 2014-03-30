<?php

/**
 * Fichier de source pour le AddServicesManagerListener.
 *
 * Copyright 2014 Adrien Desfourneaux
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzServiceModule\Listener
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License Version 2.0
 * @link     https://github.com/dieze/DzServiceModule
 */

namespace DzServiceModule\Listener;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\ModuleManager\ModuleEvent;

/**
 * Classe AddServicesManagerListener.
 *
 * Ce listener doit être attaché à l'EventManager du ModuleManager
 * dans la méthode init() du Module.
 *
 * @category Source
 * @package  DzServiceModule\Listener
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License Version 2.0
 * @link     https://github.com/dieze/DzServiceModule
 */
class AddServicesManagerListener extends AbstractListenerAggregate
{
    /**
     * Attache un ou plusieurs écouteurs.
     *
     * @param EventManagerInterface $eventManager Instance de EventManager
     *
     * @return void
     */
    public function attach(EventManagerInterface $eventManager)
    {
        $this->listeners[] = $eventManager->attach(
            ModuleEvent::EVENT_LOAD_MODULE,
            array(
                $this,
                'addServicesManager'
            ), 100
        );
    }

    /**
     * Ajoute le ServicesManager au ServiceListener.
     *
     * @param EventInterface $event Evénement.
     *
     * @return void
     */
    public function addServicesManager(EventInterface $event)
    {
        $moduleManager   = $event->getTarget();
        $eventManager    = $moduleManager->getEventManager();
        $serviceManager  = $event->getParam('ServiceManager');
        $serviceListener = $serviceManager->get('ServiceListener');

        $serviceListener->addServiceManager(
            'DzServiceModule\ServicesManager',
            'services',
            'DzServiceModule\ModuleManager\Feature\ServicesProviderInterface',
            'getServicesConfig'
        );

        // On détache le AddServicesManagerListener
        // pour que l'ajout du MessageManager ne se fasse
        // qu'une fois.
        $this->detach($eventManager);
    }
}
