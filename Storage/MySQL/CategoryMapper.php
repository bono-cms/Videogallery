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
use stdclass;

final class CategoryMapper extends AbstractMapper
{
	/**
	 * {@inheritDoc}
	 */
	protected $table = '';

	/**
	 * Fetches a record by its associated id
	 * 
	 * @paran string $id
	 * @return array
	 */
	public function fetchById($id)
	{
		$query = sprintf('SELECT * FROM `%s` WHERE `id` =:id', $this->table);
		
		$stmt = $this->pdo->prepare($query);
		$stmt->execute(array(
			':id' => $id
		));
		
		return $stmt->fetch();
	}
	
	/**
	 * Deletes a record by its associated id
	 * 
	 * @param string $id
	 * @return boolean
	 */
	public function deleteById($id)
	{
		$query = sprintf('DELETE FROM `%s` WHERE `id` =:id', $this->table);
		
		$stmt = $this->pdo->prepare($query);
		return $stmt->execute(array(
			':id' => $id
		));
	}

	/**
	 * Inserts a record
	 * 
	 * @param stdclass $container
	 * @return boolean
	 */
	public function insert(stdclass $container)
	{
		$query = sprintf('INSERT INTO `%s` (
			
		) VALUES (
			
		)', $this->table);
		
		$stmt = $this->pdo->prepare($query);
		return $stmt->execute(array(
			
		));
	}

	/**
	 * Updates a record
	 * 
	 * @param stdclass $container
	 * @return boolean
	 */
	public function update(stdclass $container)
	{
		$query = sprintf('UPDATE `%s`', $this->table);
		
		$stmt = $this->pdo->prepare($query);
		return $stmt->execute(array(
			
		));
	}
}

