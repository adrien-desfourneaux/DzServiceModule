<?php

/**
 * Fichier de module de DzServiceModule.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzServiceModule
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzServiceModule
 */

namespace DzServiceModule;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ControllerPluginProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;

/**
 * Classe module de DzServiceModule.
 *
 * @category Source
 * @package  DzServiceModule
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzServiceModule
 */
class Module implements
	InitProviderInterface,
	AutoloaderProviderInterface,
    ControllerPluginProviderInterface,
    ServiceProviderInterface
{
	/**
     * Initialise le ModuleManager.
     *
     * @param  ModuleManagerInterface $manager Gestionnaire de module.
     *
     * @return void
     */
    public function init(ModuleManagerInterface $manager)
    {
        $eventManager = $manager->getEventManager();

        // Ajoute le nouveau ServiceManager ServicesManager au ServiceListener.
        $eventManager->attach(new Listener\AddServicesManagerListener(), 100);
    }

    /**
     * Retourne un tableau à parser par Zend\Loader\AutoloaderFactory.
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/../../autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    /**
     * Doit retourner un objet de type \Zend\ServiceManager\Config
     * ou un tableau pour créer un tel objet.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getControllerPluginConfig()
    {
        return array(
            'factories' => array(
                'DzServiceModule\Service' => 'DzServiceModule\Controller\Plugin\Factory\ServiceFactory',
            ),
            'aliases' => array(
                'service' => 'DzServiceModule\Service',
            ),
        );
    }

    /**
     * Doit retourner un objet de type \Zend\ServiceManager\Config
     * ou un tableau pour créer un tel objet.
     *
     * @return array|\Zend\ServiceManager\Config
     *
     * @see ServiceProviderInterface
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'DzServiceModule\ServicesManager'  => 'DzServiceModule\Factory\ServicesManagerFactory',
            ),
            'aliases' => array(
                'ServicesManager' => 'DzViewModule\ServicesManager',
            ),
        );
    }
}