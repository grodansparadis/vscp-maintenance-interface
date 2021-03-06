<?php

namespace AppBundle\Repository;

/**
 * VSCPUnitRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VSCPUnitRepository extends \Doctrine\ORM\EntityRepository
{
  public function GetVSCPUnit()
  {

    $em = $this->getEntityManager();
    $query = $em->createQuery("
      SELECT
      a.id,
      a.vscpunit,
      b.vscptype,
      a.vscpunitDescription
      FROM AppBundle:VSCPUnit a
      LEFT JOIN AppBundle:VSCPType b with a.vscpunittype = b.id
      ORDER BY a.vscpunit
      ");
    return $query->getResult();

  }

  public function GetVSCPUnitByType($vscptypeid)
  {

    $em = $this->getEntityManager();
    $query = $em->createQuery("
      SELECT
      a.id,
      a.vscpunit,
      b.vscptype,
      b.vscptypeName,
      c.vscpclassName,
      a.vscpunitDescription
      FROM AppBundle:VSCPUnit a
      LEFT JOIN AppBundle:VSCPType b with a.vscpunittype = b.id
      JOIN AppBundle:VSCPClass c with b.vscptypeclass = c.id
      where b.id = $vscptypeid
      ORDER BY a.vscpunit
      ");
    return $query->getResult();

  }
}
