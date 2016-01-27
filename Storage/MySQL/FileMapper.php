<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Videogallery\Storage\MySQL;

use Cms\Storage\MySQL\AbstractMapper;
use Videogallery\Storage\FileMapperInterface;
use Krystal\Db\Sql\RawSqlFragment;

final class FileMapper extends AbstractMapper implements FileMapperInterface
{
    /**
     * {@inheritDoc}
     */
    public static function getTableName()
    {
        return 'bono_module_videogallery_files';
    }

    /**
     * Fetches a record by its associated id
     * 
     * @param string $id
     * @return array
     */
    public function fetchById($id)
    {
        return $this->findByPk($id);
    }

    /**
     * Fetches all records filtered by pagination
     * 
     * @param integer $page
     * @param integer $itemsPerPage
     * @param boolean $published Whether to fetch only published records
     * @param string $categoryId Optionally can be filtered by category id
     * @return array
     */
    public function fetchAllByPage($page, $itemsPerPage, $published, $categoryId = null)
    {
        $db = $this->db->select('*')
                       ->from(self::getTableName())
                       ->whereEquals('lang_id', $this->getLangId());

        if ($categoryId !== null) {
            $db->andWhereEquals('category_id', $categoryId);
        }

        if ($published === true) {
            $db->andWhereEquals('published', '1')
               ->orderBy(new RawSqlFragment('`order`, CASE WHEN `order` = 0 THEN `id` END DESC'));
        } else {
            $db->orderBy('id')
               ->desc();
        }

        return $db->paginate($page, $itemsPerPage)
                  ->queryAll();
    }

    /**
     * Removes a video record by its associated id
     * 
     * @param string $id
     * @return boolean
     */
    public function deleteById($id)
    {
        return $this->deleteByPk($id);
    }

    /**
     * Adds a video record
     * 
     * @param array $data Data to be inserted
     * @return boolean
     */
    public function insert(array $data)
    {
        return $this->persist($this->getWithLang($data));
    }

    /**
     * Updates a video record
     * 
     * @param array $data Data to be updated
     * @return boolean
     */
    public function update(array $data)
    {
        return $this->persist($data);
    }
}
