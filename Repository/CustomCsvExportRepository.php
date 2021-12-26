<?php
/*
 * This file is part of the Custom Csv Export Plugin
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomCsvExport4\Repository;

use Eccube\Repository\AbstractRepository;
use Plugin\CustomCsvExport4\Entity\CustomCsvExport;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CustomCsvExportRepository extends AbstractRepository
{
    /**
     * CouponRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CustomCsvExport::class);
    }

    /**
     * 設定SQL一覧を取得する.
     *
     * @return mixed 設定SQLの配列
     */
    public function getList()
    {
        $qb = $this->createQueryBuilder('cs')
            ->where('cs.deletable = 0');
        $CustomCsvExports = $qb->getQuery()->getResult();

        return $CustomCsvExports;
    }

    /**
     * CSV出力用の設定SQL実行結果を取得する.
     *
     * @param $custom_csv_export SQL文
     * @return mixed[]
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getArrayList($custom_csv_export)
    {
        $em = $this->getEntityManager();
        $qb = $em->getConnection()->prepare('SELECT '.$custom_csv_export);
        $qb->execute();
        $result = $qb->fetchAll();

        return $result;
    }

    /**
     * 入力されたSQL文が正しいかどうか判定する
     *
     * @param $sql SQL文
     * @return bool SQLの実行結果
     * @throws \Doctrine\DBAL\DBALException
     */
    public function query($sql)
    {
        $em = $this->getEntityManager();
        $qb = $em->getConnection()->prepare($sql);

        $result = $qb->execute();

        return $result;
    }

    /**
     * 設定SQLを保存する.
     *
     * @param CustomCsvExport $CustomCsvExport 設定SQL
     * @return bool 成功した場合 true
     * @throws \Doctrine\DBAL\ConnectionException
     */
    public function save($CustomCsvExport)
    {
        $em = $this->getEntityManager();
        $em->getConnection()->beginTransaction();
        try {
            if (!$CustomCsvExport->getId()) {
                $CustomCsvExport->setDeletable(false);

                $em->createQueryBuilder()
                    ->update('Plugin\CustomCsvExport4\Entity\CustomCsvExport', 'cs')
                    ->getQuery();
            }

            $em->persist($CustomCsvExport);
            $em->flush();

            $em->getConnection()->commit();
        } catch (\Exception $e) {
            $em->getConnection()->rollback();

            return false;
        }

        return true;
    }

    /**
     * 設定SQLを削除する.
     *
     * @param CustomCsvExport $CustomCsvExport 削除対象の設定SQL
     * @return bool 成功した場合 true
     * @throws \Doctrine\DBAL\ConnectionException
     */
    public function delete($CustomCsvExport)
    {
        $em = $this->getEntityManager();
        $em->getConnection()->beginTransaction();
        try {
            $CustomCsvExport->setDeletable(true);
            $em->flush($CustomCsvExport);

            $em->getConnection()->commit();
        } catch (\Exception $e) {
            $em->getConnection()->rollback();

            return false;
        }

        return true;
    }
}
