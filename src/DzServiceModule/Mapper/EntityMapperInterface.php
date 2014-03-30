<?php

/**
 * Fichier de source pour l'interface EntityMapperInterface.
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
 * @package  DzServiceModule\Mapper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License Version 2.0
 * @link     https://github.com/dieze/DzServiceModule
 */

namespace DzServiceModule\Mapper;

/**
 * Interface EntityMapperInterface.
 *
 * Interface pour une classe qui gère les
 * opérations CRUD d'une entité spécifique.
 *
 * @category Source
 * @package  DzServiceModule\Mapper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License Version 2.0
 * @link     https://github.com/dieze/DzServiceModule
 */
interface EntityMapperInterface
{
    /**
     * Insère un nouvel objet entité dans le média de
     * stockage à partir des données passées en paramètre.
     *
     * @param mixed $data Données d'insertion.
     *
     * @return void
     */
    public function insert($data);

    /**
     * Met à jour un objet entité existant
     * depuis les données passées en paramètre.
     *
     * @param mixed $data Données de mise à jour.
     *
     * @return void
     */
    public function update($data);

    /**
     * Supprime un objet entité du média de stockage
     * à partir des données passées en paramètre.
     *
     * @param mixed $data Données de suppression.
     *
     * @return void
     */
    public function delete($data);

    /**
     * Définit le nom de la classe entité gérée par le mapper.
     *
     * @param string $class Nouveau nom de classe.
     *
     * @return EntityMapperInterface
     */
    public function setEntityClass($class);

    /**
     * Obtient le nom de la classe entité gérée par la mapper.
     *
     * @return string
     */
    public function getEntityClass();
}
