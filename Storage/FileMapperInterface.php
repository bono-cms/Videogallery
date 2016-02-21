<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Videogallery\Storage;

interface FileMapperInterface
{
    /**
     * Updates sorting order by associated id
     * 
     * @param string $id
     * @param string $order
     * @return boolean
     */
    public function updateOrderById($id, $order);

    /**
     * Update file's published state by its associated id
     * 
     * @param string $id Post id
     * @param string $published Either 0 or 1
     * @return boolean
     */
    public function updatePublishedById($id, $published);

    /**
     * Updates whether file's SEO is enabled or not by its associated id
     * 
     * @param string $id Post id
     * @param string $published Either 0 or 1
     * @return boolean
     */
    public function updateSeoById($id, $seo);

    /**
     * Fetches a record by its associated id
     * 
     * @param string $id
     * @return array
     */
    public function fetchById($id);

    /**
     * Fetches all records filtered by pagination
     * 
     * @param integer $page
     * @param integer $itemsPerPage
     * @param boolean $published Whether to fetch only published records
     * @param string $categoryId Optionally can be filtered by category id
     * @return array
     */
    public function fetchAllByPage($page, $itemsPerPage, $published, $categoryId = null);

    /**
     * Removes a video record by its associated id
     * 
     * @param string $id
     * @return boolean
     */
    public function deleteById($id);

    /**
     * Adds a video record
     * 
     * @param array $data Data to be inserted
     * @return boolean
     */
    public function insert(array $data);

    /**
     * Updates a video record
     * 
     * @param array $data Data to be updated
     * @return boolean
     */
    public function update(array $data);
}
