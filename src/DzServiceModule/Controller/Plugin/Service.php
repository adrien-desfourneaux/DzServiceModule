<?php

/**
 * Fichier source pour le plugin de contrôleur Service.
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
 * @package  DzServiceModule\Controller\Plugin
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License Version 2.0
 * @link     https://github.com/dieze/DzServiceModule
 */

namespace DzServiceModule\Controller\Plugin;

use DzServiceModule\Service\ServicesPluginManager;
use DzServiceModule\Service\ServicesPluginManagerAwareInterface;
use DzServiceModule\Service\ServiceInterface;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * Plugin de Contrôleur Service.
 *
 * Obtient un Service auprès du gestionnaire de Service.
 *
 * @category Source
 * @package  DzServiceModule\Controller\Plugin
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License Version 2.0
 * @link     https://github.com/dieze/DzServiceModule
 */
class Service extends AbstractPlugin implements ServicesPluginManagerAwareInterface
{
    /**
     * Gestionnaire de Services.
     *
     * @var ServicesPluginManager
     */
    protected $services;

    /**
     * Méthode appelée lorsqu'un script tente
     * d'appeler cet objet comme une fonction.
     *
     * @param string $name Nom du Service à récupérer.
     *
     * @return ServiceInterface|Service
     */
    public function __invoke($name = null)
    {
        if ($name === null) {
            return $this;
        }

        $services = $this->getServicesPluginManager();
        $service  = $services->get($name);

        return $service;
    }

    /**
     * {@inheritdoc}
     */
    public function setServicesPluginManager($services)
    {
        $this->services = $services;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getServicesPluginManager()
    {
        return $this->services;
    }
}
