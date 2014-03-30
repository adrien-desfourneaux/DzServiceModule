DzServiceModule
============

Module de gestion de services pour ZF2.

Ce module est écrit et maintenu et maintenu par Adrien Desfourneaux (aka Dieze) &lt;dieze51@gmail.com&gt;. Le projet est hébergé par GitHub à l'adresse [https://github.com/dieze/DzServiceModule.git](https://github.com/dieze/DzServiceModule.git).

Fonctionnalités
-------------

DzServiceModule fournit des classes de base pour la mise en place d'une couche *service* dans le cadre d'une application basée sur le Zend Framework 2.

### Couche Mapper

#### AbstractMapper

La classe *AbstractMapper* est une classe abstraite de  gestion d'une entité donnée. Elle contient des méthodes abstraites d'*insertion*, de *mise à jour* et de *suppression* de cette entité.

#### DoctrineMapper

La classe *DoctrineMapper* est une classe mapper concrète de gestion d'une entité Doctrine donnée. Elle étend l'*AbstractMapper* et fournit des méthodes prêtes à l'emploi d'*insertion*, de *mise à jour* et de *suppression* de cette entité Doctrine via l'EntityManager qu'on lui a fournit. Les méthodes de recherche d'entités **find** sont automatiquement proxiées vers le *Repository* de cette entité.

	<?php
	
	$mapper = new DoctrineMapper($entityManager);
	$mapper->setEntityClass('MyModule\Entity\MyEntity');
	
	$entityObject = new MyModule\Entity\MyEntity();
	$entityObject->setName('foo');
	$entityObject->setDescription('bar');
	
	// Insertion
	$mapper->insert($entityObject);
	
	$entityObject->setDescription('babar');
	
	// Mise à jour
	$mapper->update($entityObject);
	
	// Suppression
	$mapper->delete($entityObject);

	// Proxy vers le Repository de MyEntity
	// Retourne l'objet MyEntity d'id 3
	$entityObject = $mapper->findOneById(3);
	
	$id = $entityObject->getId();


### Couche Service

#### EntityService

L'*EntityService* est une classe générale de service pour une entité donnée. Elle contient le *mapper* et l'*hydrateur* pour cette entité. Les méthodes de recherche d'entités **find** sont automatiquement proxiées vers le Mapper de cette entité, avec extraction automatique des données.

Il est possible de modifier le comportement de l'*EntityService* via des *options*.

	<?php
	
	$entityService = new EntityService();
	$entityService->setEntityClass('MyModule\Entity\MyEntity');
	
	// Hydrateur ClassMethods
	$entityService->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods());
	
	// Proxy de la méthode "find" vers le Mapper
	// qui proxy l'appel vers le Repository
	// et extraction automatique via l'hydrateur
	$data = $entityService->findOneById(3);
	
	// $data est un array
	// car extraction via l'hydrateur
	$id = $data['id'];
	
## ServicesManager

Le module DzServiceModule ajoute un nouveau service manager apppelé *ServicesManager* (noter le "s" dans *Service__s__Manager*) au service manager de Zend Framework 2. Le *ServicesManager* permet d'obtenir un service à partir d'une clé (chaîne de caractères).

Par exemple, à l'intérieur d'un controller ZF2, on peut récupérer un Service depuis le *ServicesManager* de cette façon :

	$locator  = $this->getServiceLocator();
	$services = $locator->get('ServicesManager');
	$service  = $services->get('MyService');
	
### Enregistrer ses Services auprès du ServicesManager

Pour pouvoir récupérer ses Services auprès du *ServicesManager* il faut les déclarer. Il y a deux façons de déclarer des nouveaux Services :

#### via l'interface ServicesProviderInterface

Dans le fichier Module.php

	<?php
	
	namespace MyModule;
	
	use DzServiceModule\ModuleManager\Feature\ServicesProviderInterface;
	
	class Module implements
		ServicesProviderInterface
	{
		public function getServicesConfig()
		{
			return array(
				'factories' => array(
					'MyModule\MyEntityService' => 'MyModule\Service\Factory\MyEntityService',
				),
				'aliases' => array(
					'MyEntityService' => 'MyModule\MyEntityService',
				),
			);
		}
	}
	
#### via le module.config.php

Dans le fichier Module.php

	<?php
	
	namespace MyModule;
	
	use Zend\ModuleManager\Feature\ConfigProviderInterface;
	
	class Module implements
		ConfigProviderInterface
	{
		public function getConfig()
		{
			return include __DIR__ . '/config/module.config.php';
		}
	}

Dans le fichier config/module.config.php

	<?php
	
	return array(
		'services' => array(
			'factories' => array(
				'MyModule\MyEntityService' => 'MyModule\Service\Factory\MyEntityService',
			),
			'aliases' => array(
				'MyEntityService' => 'MyModule\MyEntityService',
			),
		),
	);

### Plugins de controller

### Service

Le plugin de controller *Service* permet d'obtenir un Service à partir de sa clé dans le *ServicesManager*.

Dans le controller :

	$service = $this->service('MyModule\MyEntityService');
	
permet d'obtenir le Service enregistré sous le nom "MyModule\MyEntityService".

Licence
--------------

Copyright 2014 Adrien Desfourneaux

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.