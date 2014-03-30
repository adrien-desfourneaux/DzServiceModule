<?php

/**
 * Fichier de source pour l'interface OptionsAwareInterface.
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
 * @package  DzServiceModule\Options
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License Version 2.0
 * @link     https://github.com/dieze/DzServiceModule
 */

namespace DzServiceModule\Options;

use Zend\Stdlib\ParameterObjectInterface;

/**
 * Interface OptionsAwareInterface.
 *
 * Interface pour les classes ayant des options.
 *
 * @category Source
 * @package  DzServiceModule\Mapper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License Version 2.0
 * @link     https://github.com/dieze/DzServiceModule
 */
interface OptionsAwareInterface
{
    /**
     * Définit les options.
     *
     * @param ParameterObjectInterface $options Nouvelles options.
     *
     * @return OptionsAwareInterface
     */
    public function setOptions(ParameterObjectInterface $options);

    /**
     * Obtient les options.
     *
     * @return ParameterObjectInterface
     */
    public function getOptions();
}
