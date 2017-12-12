<?php
/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2015 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */


namespace Eccube\Repository;

use Eccube\Annotation\Repository;
use Eccube\Entity\MailHistory;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * MailHistoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @Repository
 */
class MailHistoryRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MailHistory::class);
    }

    /**
     * @param \Eccube\Entity\Customer
     * @param integer $id
     * @expectedException \Exception|NoResultException|NonUniqueResultException
     */
    public function getByCustomerAndId(\Eccube\Entity\Customer $Customer, $id)
    {
        $qb = $this->createQueryBuilder('mh')
            ->leftJoin('mh.Order', 'o')
            ->where('mh.id = :id AND o.Customer = :Customer');

        return $qb
            ->getQuery()
            ->setParameters(array(
                'id' => $id,
                'Customer' => $Customer,
            ))
            ->getSingleResult();
    }
}
