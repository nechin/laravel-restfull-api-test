<?php

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepository;
use Doctrine\ORM\EntityRepository;

class CustomerRepository extends EntityRepository implements BaseRepository
{
}
