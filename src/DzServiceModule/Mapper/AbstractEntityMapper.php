<?php

/**
 * Fichier de source pour l'AbstractEntityMapper.
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
 * Classe AbstractEntityMapper.
 *
 * Mapper abstrait qui gère les
 * opérations CRUD d'une entité spécifique.
 *
 * @category Source
 * @package  DzServiceModule\Mapper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License Version 2.0
 * @link     https://github.com/dieze/DzServiceModule
 */
abstract class AbstractEntityMapper implements EntityMapperInterface
{
    /**
     * Classe d'entité gérée par le Mapper.
     *
     * @var string
     */
    protected $entityClass;

    /**
     * {@inheritdoc}
     */
    abstract public function insert($data);

    /**
     * {@inheritdoc}
     */
    abstract public function update($data);

    /**
     * {@inheritdoc}
     */
    abstract public function delete($data);

    /**
     * {@inheritdoc}
     */
    public function setEntityClass($class)
    {
        $this->entityClass = $class;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }
}
