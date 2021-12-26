<?php
/*
 * This file is part of the Custom Csv Export Plugin
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomCsvExport4;

use Eccube\Common\EccubeNav;

class CustomCsvExportNav implements EccubeNav
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public static function getNav()
    {
        return [
            'setting' => [
                'children' => [
                    'shop' => [
                        'children' => [
                            'admin_custom_csv_export' => [
                                'name' => 'カスタムCSV出力',
                                'url' => 'plugin_custom_csv_export',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
