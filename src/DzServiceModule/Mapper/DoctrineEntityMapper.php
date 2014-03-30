<?php

/**
 * Fichier de source pour le DoctrineEntityMapper.
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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Classe DoctrineEntityMapper.
 *
 * Mapper pour l'ORM Doctrine.
 * Gère les opérations CRUD d'une entité Doctrine spécifique.
 *
 * @category Source
 * @package  DzServiceModule\Mapper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License Version 2.0
 * @link     https://github.com/dieze/DzServiceModule
 */
class DoctrineEntityMapper extends AbstractEntityMapper
{
    /**
     * Manager d'entités Doctrine.
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Constructeur de DoctrineEntityMapper.
     *
     * @param EntityManager $entityManager Instance de EntityManager.
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Insère un nouvel objet entité dans le média de stockage.
     *
     * @param  $entity Entité à insérer.
     *
     * @return void
     */
    public function insert($entity)
    {
        return $this->persist($entity);
    }

    /**
     * Met à jour un objet entité existant
     *
     * @param mixed $entity Entité à mettre à jour.
     *
     * @return void
     */
    public function update($entity)
    {
        return $this->persist($entity);
    }

    /**
     * Supprime un objet entité du média de stockage.
     *
     * @param mixed $entity Entité à supprimer.
     *
     * @return void
     */
    public function delete($entity)
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    /**
     * Persiste un objet entité dans le média de stockage.
     *
     * @param mixed $entity Entité à persister.
     *
     * @return mixed L'objet entité persisté.
     */
    protected function persist($entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    /**
     * Obtient le Repository.
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return $this->entityManager
            ->getRepository($this->getEntityClass());
    }

    /**
     * Overloading: Proxy des appels de méthode "find"
     * vers le respository.
     *
     * @param string $method    Nom de la méthode appelée.
     * @param array  $arguments Arguments passés à la méthode.
     *
     * @return ArrayCollection
     */
    public function __call($method, $arguments)
    {
        $repository = $this->getRepository();

        // Proxy vers le Respository.
        if (strpos($method, 'find') == 0) {
            if (is_callable(array($repository, $method))) {
                return call_user_func_array(
                    array(
                        &$repository,
                        $method
                    ), $arguments
                );
            }
        }
    }
}
