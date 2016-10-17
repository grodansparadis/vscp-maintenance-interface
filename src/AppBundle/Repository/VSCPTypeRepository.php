<?php

namespace AppBundle\Repository;

/**
 * VSCPTypeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VSCPTypeRepository extends \Doctrine\ORM\EntityRepository
{
  public function GetVSCPType()
  {

    $em = $this->getEntityManager();
    $query = $em->createQuery("
      SELECT
      a.id,
      a.vscptype,
      b.vscpclassName,
      a.vscptypeDescription
      FROM AppBundle:VSCPType a
      LEFT JOIN AppBundle:VSCPClass b with a.vscpclass = b.id
      ORDER BY a.vscptype
      ");
    return $query->getResult();

  }
}
