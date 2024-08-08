<?php

namespace App\Repository;

use App\Entity\Booking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Booking>
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Booking::class);
    }

    public function findAllBookings(): array
    {
        // DQL (Doctrine Query Language) kullanarak tüm booking kayıtlarını çeken bir sorgu oluşturun
        return $this->createQueryBuilder('b')
            ->getQuery()
            ->getResult();
    }

}
