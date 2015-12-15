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
        $categoryMapper = $this->getMapper('/Videogallery/Storage/MySQL/CategoryMapper');
        $fileMapper = $this->getMapper('/Videogallery/Storage/MySQL/FileMapper');

        $fileManager = new FileManager($fileMapper);

        return array(
            'fileManager' => $fileManager
        );
    }
}
