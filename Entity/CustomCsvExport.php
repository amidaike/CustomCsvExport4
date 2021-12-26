<?php
/*
 * This file is part of the Custom Csv Export Plugin
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomCsvExport4\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Entity\AbstractEntity;

/**
 * CustomCsvExport
 *
 * @ORM\Table(name="plg_custom_csv_export")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Plugin\CustomCsvExport4\Repository\CustomCsvExportRepository")
 */
class CustomCsvExport extends AbstractEntity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="sql_name", type="string", length=255)
     */
    private $sql_name;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_sql", type="text")
     */
    private $custom_sql;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deletable", type="boolean", options={"default":false})
     */
    private $deletable = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetimetz")
     */
    private $create_date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_date", type="datetimetz")
     */
    private $update_date;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sqlName.
     *
     * @param string $sqlName
     *
     * @return CustomCsvExport
     */
    public function setSqlName($sqlName)
    {
        $this->sql_name = $sqlName;

        return $this;
    }

    /**
     * Get sqlName.
     *
     * @return string
     */
    public function getSqlName()
    {
        return $this->sql_name;
    }

    /**
     * Set customSql.
     *
     * @param string $customSql
     *
     * @return CustomCsvExport
     */
    public function setCustomSql($customSql)
    {
        $this->custom_sql = $customSql;

        return $this;
    }

    /**
     * Get customSql.
     *
     * @return string
     */
    public function getCustomSql()
    {
        return $this->custom_sql;
    }

    /**
     * Set deletable.
     *
     * @param bool $deletable
     *
     * @return CustomCsvExport
     */
    public function setDeletable($deletable)
    {
        $this->deletable = $deletable;

        return $this;
    }

    /**
     * Get deletable.
     *
     * @return bool
     */
    public function getDeletable()
    {
        return $this->deletable;
    }

    /**
     * Set createDate.
     *
     * @param \DateTime $createDate
     *
     * @return CustomCsvExport
     */
    public function setCreateDate($createDate)
    {
        $this->create_date = $createDate;

        return $this;
    }

    /**
     * Get createDate.
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->create_date;
    }

    /**
     * Set updateDate.
     *
     * @param \DateTime $updateDate
     *
     * @return CustomCsvExport
     */
    public function setUpdateDate($updateDate)
    {
        $this->update_date = $updateDate;

        return $this;
    }

    /**
     * Get updateDate.
     *
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->update_date;
    }
}
