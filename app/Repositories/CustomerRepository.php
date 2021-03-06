<?php

namespace App\Repositories;

use App\Entities\Customer;
use App\Repositories\Contracts\BaseRepository;
use Doctrine\ORM\EntityRepository;
use EntityManager;

class CustomerRepository extends EntityRepository implements BaseRepository
{
    /**
     * @param array $data
     */
    public function insertOrUpdateByEmail(array $data): void
    {
        $entity = $this->findOneBy(['email' => $data['email']]);
        if ($entity === null) {
            $entity = new Customer();
            $entity->setEmail($data['email']);
        }

        $entity->setFirstName($data['firstName']);
        $entity->setLastName($data['lastName']);
        $entity->setCountry($data['country']);
        $entity->setUsername($data['username']);
        $entity->setGender($data['gender']);
        $entity->setCity($data['city']);
        $entity->setPhone($data['phone']);

        EntityManager::persist($entity);
        EntityManager::flush();
    }
}
