<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Videogallery\Controller\Admin\Category;

use Admin\Controller\Admin\AbstractController;
use stdclass;

abstract class AbstractCategory extends AbstractController
{
	/**
	 * Loads shared plugins
	 * 
	 * @return void
	 */
	final protected function loadSharedPlugins()
	{
	}

	/**
	 * Returns configured validator instance
	 * 
	 * @return Validator
	 */
	final protected function getValidator()
	{
	}

	/**
	 * Returns request container
	 * 
	 * @return \stdclass
	 */
	final protected function getContainer()
	{
		$container = new stdclass();
		
		return $container;
	}

	/**
	 * Returns template path
	 * 
	 * @return string
	 */
	final protected function getTemplatePath()
	{
		return '/category.form.phtml';
	}

	/**
	 * Returns shared variables
	 * 
	 * @param array $overrides
	 * @return array
	 */
	final protected function getSharedVars(array $overrides)
	{
		$vars = array(
			'breadcrumbs' => array(
				'Videogallery:Admin:Browser@indexAction' => 'Videogallery'
			)
		);
		
		return array_replace_recursive($vars, $overrides);
	}
}
