<?php

/**
 * Fichier de source pour l'interface EntityMapperAwareInterface.
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
 * Interface EntityMapperAwareInterface.
 *
 * Interface pour les classes connaissant un Mapper d'entité.
 *
 * @category Source
 * @package  DzServiceModule\Mapper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License Version 2.0
 * @link     https://github.com/dieze/DzServiceModule
 */
interface EntityMapperAwareInterface
{
    /**
     * Définit le mappeur pour l'entité.
     *
     * @param EntityMapperInterface $mapper Nouveau mapper.
     *
     * @return EntityMapperAwareInterface
     */
    public function setMapper(EntityMapperInterface $mapper);

    /**
     * Obtient le mappeur pour l'entité.
     *
     * @return EntityMapperAwareInterface
     */
    public function getMapper();
}
