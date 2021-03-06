<?php

namespace App\Repositories\Contracts;

interface BaseRepository
{
    /**
     * @param mixed $id
     * @return object|null
     */
    public function find($id);

    /**
     * @return array
     */
    public function findAll();

    /**
     * @param array $data
     */
    public function insertOrUpdateByEmail(array $data): void;
}
