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

interface CategoryManagerInterface
{
    /**
     * Fetches all category entities
     * 
     * @return array
     */
    public function fetchAll();

    /**
     * Fetches category's entity by its associated id
     * 
     * @param string $id
     * @return array
     */
    public function fetchById($id);

    /**
     * Deletes a category
     * 
     * @param string $id
     * @return boolean
     */
    public function deleteById($id);

    /**
     * Adds a category
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function add(array $input);

    /**
     * Updates a category
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function update(array $input);
}
