<?php

/**
 * Fichier de source pour l'interface EntityServiceInterface.
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

use DzServiceModule\Mapper\EntityMapperAwareInterface;

use Zend\Stdlib\Hydrator\HydratorAwareInterface;

/**
 * Interface EntityServiceInterface.
 *
 * Interface pour un service de base pour la gestion d'une entité.
 *
 * @category Source
 * @package  DzServiceModule\Service
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License Version 2.0
 * @link     https://github.com/dieze/DzServiceModule
 */
interface EntityServiceInterface extends
    ServiceInterface,
    EntityMapperAwareInterface,
    HydratorAwareInterface
{
    /**
     * Définit le nom de la classe entité.
     * gérée par le service.
     *
     * @param string $class Nouveau nom de classe.
     *
     * @return AbstractEntityService
     */
    public function setEntityClass($class);

    /**
     * Obtient le nom de la classe entité
     * gérée par le service.
     *
     * @return string
     */
    public function getEntityClass();
}
