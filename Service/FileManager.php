<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Videogallery\Service;

use Cms\Service\AbstractManager;
use Videogallery\Storage\FileMapperInterface;
use stdclass;

final class FileManager extends AbstractManager implements FileManagerInterface
{
    /**
     * A mapper which implements this interface
     * 
     * @var FileMapperInterface
     */
    private $fileMapper;

    /**
     * State initialization
     * 
     * @param FileMapperInterface $fileMapper
     * @return void
     */
    public function __construct(FileMapperInterface $fileMapper)
    {
        $this->fileMapper = $fileMapper;
    }

    /**
     * {@inheritDoc}
     */
    protected function toObject(array $file)
    {
        $container = new stdclass();
        $container->id = $file['id'];
        
        return $container;
    }

    /**
     * Prepare container
     * 
     * @param stdclass $container
     * @return void
     */
    private function prepareContainer(stdclass $container)
    {
        if (empty($container->slug)) {
            $container->slug = $container->title;
        }
    }

    /**
     * Returns paginator instance
     * 
     * @return Paginator
     */
    public function getPaginator()
    {
        return $this->fileMapper->getPaginator();
    }

    /**
     * Returns last id
     * 
     * @return integer
     */
    public function getLastId()
    {
        return $this->fileMapper->getLastId();
    }

    /**
     * Adds a record
     * 
     * @param stdclass $container
     * @return boolean
     */
    public function add(stdclass $container)
    {
        return $this->fileMapper->insert($container);
    }

    /**
     * Updates a record
     * 
     * @param stdclass $container
     * @return boolean
     */
    public function update(stdclass $container)
    {
        return $this->fileMapper->update($container);
    }

    /**
     * Fetches a video file info by its associated id
     * 
     * @param string $id
     * @return array
     */
    public function fetchById($id)
    {
        return $this->prepareResult($this->fileMapper->fetchById($id));
    }

    /**
     * Deletes a video file by its associated id
     * 
     * @param string $id
     * @return boolean
     */
    public function deleteById($id)
    {
        return $this->fileMapper->deleteById($id);
    }

    /**
     * Fetch all records filtered by pagination
     * 
     * @param integer $page
     * @param integer $itemsPerPage
     * @return array
     */
    public function fetchAllByPage($page, $itemsPerPage)
    {
        return $this->prepareResults($this->fileMapper->fetchAllByPage($page, $itemsPerPage));
    }

    /**
     * Fetch all published records filtered by pagination
     * 
     * @param integer $page
     * @param integer $itemsPerPage
     * @return array
     */
    public function fetchAllPublishedByPage($page, $itemsPerPage)
    {
        return $this->prepareResults($this->fileMapper->fetchAllPublishedByPage($page, $itemsPerPage));
    }
}
