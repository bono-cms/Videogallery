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
use Cms\Service\WebPageManagerInterface;
use Cms\Service\HistoryManagerInterface;
use Videogallery\Storage\FileMapperInterface;
use Krystal\Stdlib\VirtualEntity;
use Krystal\Stdlib\ArrayUtils;

final class FileManager extends AbstractManager implements FileManagerInterface
{
    /**
     * Any compliant file mapper
     * 
     * @var \Videogallery\Storage\FileMapperInterface
     */
    private $fileMapper;

    /**
     * Web page manager to deal with slugs
     * 
     * @var \Cms\Service\WebPageManagerInterface
     */
    private $webPageManager;

    /**
     * History manager to keep tracks
     * 
     * @var \Cms\Service\HistoryManagerInterface
     */
    private $historyManager;

    /**
     * State initialization
     * 
     * @param \Videogallery\Storage\FileMapperInterface $fileMapper
     * @param \Cms\Service\WebPageManagerInterface $webPageManager
     * @param \Cms\Service\HistoryManagerInterface $historyManager
     * @return void
     */
    public function __construct(FileMapperInterface $fileMapper, WebPageManagerInterface $webPageManager, HistoryManagerInterface $historyManager)
    {
        $this->fileMapper = $fileMapper;
        $this->webPageManager = $webPageManager;
        $this->historyManager = $historyManager;
    }

    /**
     * {@inheritDoc}
     */
    protected function toEntity(array $file)
    {
        $entity = new VirtualEntity();
        $entity->setId($file['id'])
               ->setLangId($file['lang_id'])
               ->setCategoryId($file['category_id'])
               ->setTitle($file['title'])
               ->setDescription($file['description'])
               ->setOrder((int) $file['order'])
               ->setSeo((bool) $file['seo'])
               ->setPublished((bool) $file['published'])
               ->setMetaDescription($file['meta_description'])
               ->setKeywords($file['keywords']);

        return $entity;
    }

    /**
     * Tracks activity
     * 
     * @param string $message
     * @param string $placeholder
     * @return boolean
     */
    private function track($message, $placeholder)
    {
        return $this->historyManager->write('Videogallery', $message, $placeholder);
    }

    /**
     * Update orders
     * 
     * @param array $orders
     * @return boolean
     */
    public function updateOrders(array $orders)
    {
        foreach ($orders as $id => $order) {
            if (!$this->fileMapper->updateOrderById($id, $order)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Update published states
     * 
     * @param array $published
     * @return boolean
     */
    public function updatePublished(array $published)
    {
        foreach ($published as $id => $value) {
            if (!$this->fileMapper->updatePublishedById($id, $value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Update SEO states
     * 
     * @param array $seo
     * @return boolean
     */
    public function updateSeo(array $seo)
    {
        foreach ($seo as $id => $value) {
            if (!$this->fileMapper->updateSeoById($id, $value)) {
                return false;
            }
        }

        return true;
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
        $input = $this->prepareInput($input);

        // Form data
        $data = $input['data']['video'];

        return $this->fileMapper->insert(ArrayUtils::arrayWithout($data, array('slug')));
    }

    /**
     * Updates a video file
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function update(array $input)
    {
        $input = $this->prepareInput($input);

        // Form data
        $data = $input['data']['video'];

        return $this->fileMapper->update(ArrayUtils::arrayWithout($data, array('slug')));
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
