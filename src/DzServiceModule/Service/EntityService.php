<?php

/**
 * Fichier de source pour le EntityService.
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

use DzServiceModule\Mapper\EntityMapperInterface;
use DzServiceModule\Options\OptionsAwareInterface;

use Zend\Stdlib\ParameterObjectInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;

/**
 * Classe EntityService.
 *
 * Service de base pour la gestion d'une entité.
 *
 * @category Source
 * @package  DzServiceModule\Service
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License Version 2.0
 * @link     https://github.com/dieze/DzServiceModule
 */
class EntityService implements
    EntityServiceInterface,
    EventmanagerAwareInterface,
    OptionsAwareInterface
{
    /**
     * Nom de la classe entité gérée par le service.
     *
     * @var string
     */
    protected $entityClass;

    /**
     * Mappeur pour l'entité.
     *
     * @var EntityMapperInterface
     */
    protected $mapper;

    /**
     * Hydrateur pour l'entité.
     *
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     * Options du Service.
     *
     * @var ParameterObject
     */
    protected $options;

    /**
     * Gestionnaire d'événements.
     *
     * @var EventManagerInterface
     */
    protected $events;

    /**
     * Redirige les méthodes de recherche vers le mappeur.
     * Ajoute l'extraction des résultats via l'hydrateur,
     * si l'hydrateur est définit.
     *
     * @param string $method    Nom de la méthode appellée
     * @param array  $arguments Arguments passés à la méthode
     *
     * @return array
     */
    public function __call($method, $arguments)
    {
        $mapper   = $this->getMapper();
        $hydrator = $this->getHydrator();

        // Proxy vers le mapper.
        if (strpos($method, 'find') == 0) {
            if (is_callable(array($mapper, $method))) {
                $return = call_user_func_array(
                    array(
                        &$mapper,
                        $method
                    ), $arguments
                );
            }
        }

        // Extraction.
        if (isset($return) && $return !== null) {
            if ($hydrator) {
                if (is_array($return)) {
                    for ($i=0; $i<count($return); $i++) {
                        $return[$i] = $hydrator->extract($return[$i]);
                    }
                } elseif (is_object($return)) {
                    $return = $hydrator->extract($return);
                }
            }

            return $return;
        }
    }

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


    /**
     * {inheritdoc}
     */
    public function setMapper(EntityMapperInterface $mapper)
    {
        $this->mapper = $mapper;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMapper()
    {
        return $this->mapper;
    }

    /**
     * {@inheritdoc}
     */
    public function setHydrator(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getHydrator()
    {
        return $this->hydrator;
    }

    /**
     * {@inheritdoc}
     */
    public function setOptions(ParameterObjectInterface $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Définit le gestionnaire d'événements.
     *
     * @param EventManagerInterface $events Nouveau gestionnaire d'événéments.
     *
     * @return mixed
     */
    public function setEventManager(EventManagerInterface $events)
    {
        $identifiers = array(__CLASS__, get_class($this));
        if (isset($this->eventIdentifier)) {
            if ((is_string($this->eventIdentifier))
                || (is_array($this->eventIdentifier))
                || ($this->eventIdentifier instanceof Traversable)
            ) {
                $identifiers = array_unique(array_merge($identifiers, (array) $this->eventIdentifier));
            } elseif (is_object($this->eventIdentifier)) {
                $identifiers[] = $this->eventIdentifier;
            }
            // silently ignore invalid eventIdentifier types
        }
        $events->setIdentifiers($identifiers);
        $this->events = $events;

        return $this;
    }

    /**
     * Obtient le gestionnaire d'événements.
     *
     * Chargement paresseux d'une instance
     * EventManager si aucune n'a été définie.
     *
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        if (!$this->events instanceof EventManagerInterface) {
            $this->setEventManager(new EventManager());
        }

        return $this->events;
    }
}
