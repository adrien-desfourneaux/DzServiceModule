<?php

/**
 * Fichier de source pour l'interface ServicesPluginManagerAwareInterface.
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

/**
 * Interface ServicesPluginManagerAwareInterface.
 *
 * Interface pour les classes connaissant le ServicesPluginManager.
 *
 * @category Source
 * @package  DzServiceModule\Service
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License Version 2.0
 * @link     https://github.com/dieze/DzServiceModule
 */
interface ServicesPluginManagerAwareInterface
{
    /**
     * Définit le gestionnaire de services.
     *
     * @param ServicesPluginManager $services Nouveau gestionnaire.
     *
     * @return ServicesPluginManagerAwareInterface
     */
    public function setServicesPluginManager($services);

    /**
     * Obtient le gestionnaire de services.
     *
     * @return ServicesPluginManager
     */
    public function getServicesPluginManager();
}
