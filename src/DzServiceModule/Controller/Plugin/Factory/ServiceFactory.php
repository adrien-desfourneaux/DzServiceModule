<?php

/**
 * Fichier source pour le ServiceFactory.
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
 * @package  DzServiceModule\Controller\Plugin\Factory
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License Version 2.0
 * @link     https://github.com/dieze/DzServiceModule
 */

namespace DzServiceModule\Controller\Plugin\Factory;

use DzServiceModule\Controller\Plugin\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Classe ServiceFactory.
 *
 * Classe usine pour le plugin de contrôleur Service.
 *
 * @category Source
 * @package  DzServiceModule\Controller\Plugin\Factory
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License Version 2.0
 * @link     https://github.com/dieze/DzServiceModule
 */
class ServiceFactory implements FactoryInterface
{
    /**
     * Cré et retourne un plugin de contrôleur Service.
     *
     * @param ServiceLocatorInterface $serviceLocator Localisateur de service.
     *
     * @return Service
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $plugin = new Service;

        $locator  = $serviceLocator->getServiceLocator();
        $services = $locator->get('DzServiceModule\ServicesManager');

        $plugin->setServicesPluginManager($services);

        return $plugin;
    }
}
