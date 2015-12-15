<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) 2014 Bono Team
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Videogallery;

use Cms\AbstractCmsModule;
use Videogallery\Service\FileManager;

final class Module extends AbstractCmsModule
{
	/**
	 * {@inheritDoc}
	 */
	public function getServiceProviders()
	{
		$admin = $this->moduleManager->getModule('Admin');
		
		// Grab a mapper
		$mapperFactory = $admin->getService('mapperFactory');
		$languageManager = $admin->getService('languageManager');
		
		$categoryMapper = $mapperFactory->build('/Videogallery/Storage/MySQL/CategoryMapper');
		$categoryMapper->setLangId($languageManager->getCurrentId());
		
		$fileMapper = $mapperFactory->build('/Videogallery/Storage/MySQL/FileMapper');
		$fileMapper->setLangId($languageManager->getCurrentId());
		
		$fileManager = new FileManager($fileMapper);
		
		return array(
			'fileManager' => $fileManager
		);
	}
}
