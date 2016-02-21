<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Videogallery;

use Cms\AbstractCmsModule;
use Videogallery\Service\FileManager;
use Videogallery\Service\CategoryManager;

final class Module extends AbstractCmsModule
{
    /**
     * {@inheritDoc}
     */
    public function getServiceProviders()
    {
        $categoryMapper = $this->getMapper('/Videogallery/Storage/MySQL/CategoryMapper');
        $fileMapper = $this->getMapper('/Videogallery/Storage/MySQL/FileMapper');

        $wpm = $this->getWebPageManager();
        $hm = $this->getHistoryManager();

        $fileManager = new FileManager($fileMapper, $wpm, $hm);
        $categoryManager = new CategoryManager($categoryMapper, $wpm, $hm);

        return array(
            'fileManager' => $fileManager,
            'categoryManager' => $categoryManager
        );
    }
}
