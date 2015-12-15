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

use Admin\Storage\MySQL\AbstractMapper;
use Videogallery\Storage\FileMapperInterface;
use stdclass;

final class FileMapper extends AbstractMapper implements FileMapperInterface
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'bono_module_videogallery_files';

    /**
     * Count all records
     * 
     * @return integer
     */
    private function countAll()
    {
        return $this->db->count($this->table, array(
            'langId' => $this->getLangId()
        ));
    }

    /**
     * Count all published records
     * 
     * @return integer
     */
    private function countAllPublished()
    {
        return $this->db->count($this->table, array(
            'langId'    => $this->getLangId(),
            'published' => '1'
        ));
    }

    /**
     * Fetches a record by its associated id
     * 
     * @param string $id
     * @return array
     */
    public function fetchById($id)
    {
        $query = sprintf('SELECT * FROM `%s` WHERE `id` =:id', $this->table);
        return $this->db->query($query, array(
            ':id' => $id
        ));
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
        // Tweak paginator's instance
        $this->paginator->setTotalAmount($this->countAll())
                        ->setItemsPerPage($itemsPerPage)
                        ->setCurrentPage($page);
        
        // Build a query now
        $query = sprintf('SELECT * FROM `%s` WHERE `langId` =:langId ORDER BY `id` DESC LIMIT %s, %s', 
            $this->table,
            $this->paginator->countOffset(), 
            $this->paginator->getItemsPerPage()
        );
        
        return $this->db->queryAll($query, array(
            ':langId' => $this->getLangId()
        ));
    }

    /**
     * Fetch all published records by page
     * 
     * @param integer $page
     * @param integer $itemsPerPage
     * @return array
     */
    public function fetchAllPublishedByPage($page, $itemsPerPage)
    {
        // Tweak paginator's instance
        $this->paginator->setTotalAmount($this->countAllPublished())
                        ->setItemsPerPage($itemsPerPage)
                        ->setCurrentPage($page);
        
        // Build a query now
        $query = sprintf('SELECT * FROM `%s` WHERE `langId` =:langId AND `published` =:published LIMIT %s, %s', 
            $this->table, 
            $this->paginator->countOffset(), 
            $this->paginator->getItemsPerPage()
        );
        
        return $this->db->queryAll($query, array(
            ':langId' => $this->getLangId(),
            ':published' => '1'
        ));
    }
    
}
