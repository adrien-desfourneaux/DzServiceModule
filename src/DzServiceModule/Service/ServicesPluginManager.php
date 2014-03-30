<?php

/**
 * Fichier source pour le ServicesPluginManager.
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
 * @package  DzServiceModule\Service
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License Version 2.0
 * @link     https://github.com/dieze/DzServiceModule
 */

namespace DzServiceModule\Service;

use DzServiceModule\Exception\InvalidServiceException;

use Zend\ServiceManager\AbstractPluginManager;

/**
 * Classe ServicesPluginManager.
 *
 * Gestionnaire de Servicess. Cette classe étend AbstractPluginManager
 * pour avoir le même comportement qu'un ServiceManager.
 *
 * @category Source
 * @package  DzServiceModule\View\Services
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License Version 2.0
 * @link     https://github.com/dieze/DzServiceModule
 */
class ServicesPluginManager extends AbstractPluginManager
{
    /**
     * Usines par défaut pour les Services.
     *
     * @var array
     */
    protected $factories = array();

    /**
     * Invokables par défaut pour les Services.
     *
     * @var array
     */
    protected $invokableClasses = array();

    /**
     * Alias par défaut pour les Servicess.
     *
     * @var array
     */
    protected $aliases = array();

    /**
     * Valide un plugin.
     *
     * Vérifie que le Service chargé est une instance de ServiceInterface.
     *
     * @param mixed $plugin Plugin à valider.
     *
     * @return void
     *
     * @throws InvalidServiceException Si le plugin est invalide.
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof ServiceInterface) {
            return;
        }

        throw new InvalidServiceException(sprintf(
            'Le plugin de type %s est invalide; il doit implémenter %s\ServiceInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
            __NAMESPACE__
        ));
    }
}
