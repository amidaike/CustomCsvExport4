<?php
/*
 * This file is part of the Custom Csv Export Plugin
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomCsvExport4\Form\Type;

use Eccube\Common\EccubeConfig;
use Plugin\CustomCsvExport4\Validator as Asserts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CustomCsvExportType extends AbstractType
{

    /**
     * @var EccubeConfig
     */
    protected $eccubeConfig;

    /**
     * CustomCsvExportType constructor.
     *
     * @param EccubeConfig $eccubeConfig
     */
    public function __construct(EccubeConfig $eccubeConfig)
    {
        $this->eccubeConfig = $eccubeConfig;
    }


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('sql_name', TextType::class, array(
                'label' => '名称',
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                        'max' => $this->eccubeConfig['eccube_stext_len'],
                    )),
                ),
            ))
            ->add('custom_sql', TextareaType::class, array(
                'label' => 'SQL文(最初のSELECTは記述しないでください。最後の;(セミコロン)も不要です。)',
                'constraints' => array(
                    new Asserts\SqlCheck(),
                ),
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'admin_custom_csv_export';
    }
}
