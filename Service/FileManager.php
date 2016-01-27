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
use Krystal\Stdlib\VirtualEntity;

final class FileManager extends AbstractManager implements FileManagerInterface
{
    /**
     * Any compliant file mapper
     * 
     * @var \Videogallery\Storage\FileMapperInterface
     */
    private $fileMapper;

    /**
     * State initialization
     * 
     * @param \Videogallery\Storage\FileMapperInterface $fileMapper
     * @return void
     */
    public function __construct(FileMapperInterface $fileMapper)
    {
        $this->fileMapper = $fileMapper;
    }

    /**
     * {@inheritDoc}
     */
    protected function toEntity(array $file)
    {
        $entity = new VirtualEntity();
        return $entity;
    }

    /**
     * Prepares an input
     * 
     * @param array $input Raw input data
     * @return void
     */
    private function prepareInput(array $input)
    {
        return $input;
    }

    /**
     * Returns paginator instance
     * 
     * @return \Krystal\Paginate\Paginator
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
     * Adds a video file
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function add(array $input)
    {
        return $this->fileMapper->insert($input);
    }

    /**
     * Updates a video file
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function update(array $input)
    {
        return $this->fileMapper->update($input);
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
     * @param boolean $published Whether to fetch only published records
     * @param string $categoryId Optionally can be filtered by category id
     * @return array
     */
    public function fetchAllByPage($page, $itemsPerPage, $published, $categoryId = null)
    {
        return $this->prepareResults($this->fileMapper->fetchAllByPage($page, $itemsPerPage, $published, $categoryId));
    }
}
