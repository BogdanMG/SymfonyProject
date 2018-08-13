<?php declare(strict_types = 1);

namespace App\Repository;

use App\Entity\Products;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Products|null find($id, $lockMode = null, $lockVersion = null)
 * @method Products|null findOneBy(array $criteria, array $orderBy = null)
 * @method Products[]    findAll()
 * @method Products[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Products::class);
    }


    public function findAllPrice() : array
    {
        $dbConn = $this->getEntityManager()->getConnection();
        $sql = "SELECT COUNT(price) FROM products";
        $stmt = $dbConn->query($sql);
        return $stmt->fetchAll(); 
    }

    public function findMinPrice() : array
    {
        $dbConn = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM products WHERE price = 320";
        $stmt = $dbConn->query($sql);
        return $stmt->fetchAll(); 

    }
    
    public function findMaxPrice() : array
    {
        $dbConn = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM products WHERE price = 1300";
        $stmt = $dbConn->query($sql);
        return $stmt->fetchAll(); 
    }

    public function setDateRange( int $from, int $to) : array
    {
        $dbConn = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM products WHERE  date BETWEEN  :from AND :to";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute(['from'=> $from, 'to'=> $to]);
        return $stmt->fetchAll(); 
    }

    public function sortOnDate() : array
    {
        $dbConn = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM products ORDER BY date";
        $stmt = $dbConn->query($sql);
        return $stmt->fetchAll(); 
    }

    public function sortOnDateRev() : array
    {
        $dbConn = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM products ORDER BY date DESC";
        $stmt = $dbConn->query($sql);
        return $stmt->fetchAll(); 
    }

    public function sortByName() : array
    {
        $dbConn = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM products ORDER BY name";
        $stmt = $dbConn->query($sql);
        return $stmt->fetchAll(); 
    }

    public function sortByNameRev() : array
    {
        $dbConn = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM products ORDER BY name DESC";
        $stmt = $dbConn->query($sql);
        return $stmt->fetchAll(); 
    }

    public function sortByLowerBound() : array
    {
        $dbConn = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM products WHERE price BETWEEN 320 AND 480 ORDER BY price DESC";
        $stmt = $dbConn->query($sql);
        return $stmt->fetchAll();
    }

    public function sortByUpperBound() : array
    {
        $dbConn = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM products WHERE price BETWEEN 850 AND 1300 ORDER BY price DESC";
        $stmt = $dbConn->query($sql);
        return $stmt->fetchAll();
    }


  /*  {
	
        "price_all": true,
        "price" : "min",
        "sort_on_date" : "forward",
        "sort_by_name" : "reverse",
        "date_from" : 20170419,
        "date_to" : 20180226,
        "upper_bound": true,
        "lower_bound" : null
        
        
        
        
    }*/
//    /**
//     * @return Products[] Returns an array of Products objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Products
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
