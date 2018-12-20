<?php

namespace App\Repository\Galerie;

use App\Entity\Galerie\Format;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Format|null find($id, $lockMode = null, $lockVersion = null)
 * @method Format|null findOneBy(array $criteria, array $orderBy = null)
 * @method Format[]    findAll()
 * @method Format[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormatRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Format::class);
    }
}
