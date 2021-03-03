<?php

namespace App\Repositories\Contracts;

interface BaseRepository
{
    public function find($id);
    public function findAll();
}
