<?php

/*
  Plugin Name:  GitHub API
  Description:  Plugin qui utilise l'API de GitHub via composer pour afficher les commits d'un dÃ©pot
  Version:      1.0
  Author:       Axel BARLET
  Author URI:   https:www.barlito.fr
  License:      GPL2
  License URI:  https://www.gnu.org/licenses/gpl-2.0.html

  GitHub API is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 2 of the License, or
  any later version.

  GitHub API is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with GitHub API. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */

require 'Controller/PluginController.php';

new PluginController();

