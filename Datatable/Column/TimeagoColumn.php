<?php

/**
 * This file is part of the T3DatatablesBundle package.
 *
 * (c) stwe <https://github.com/stwe/DatatablesBundle>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace T3\DatatablesBundle\Datatable\Column;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\Exception\InvalidArgumentException;

/**
 * Class TimeagoColumn
 *
 * @package T3\DatatablesBundle\Datatable\Column
 */
class TimeagoColumn extends AbstractColumn
{
    //-------------------------------------------------
    // ColumnInterface
    //-------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function setData($data)
    {
        if (empty($data) || !is_string($data)) {
            throw new InvalidArgumentException("setData(): Expecting non-empty string.");
        }

        $this->data = $data;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            "class" => "",
            "padding" => "",
            "name" => "",
            "orderable" => true,
            "render" => "render_timeago",
            "searchable" => true,
            "title" => "",
            "type" => "",
            "visible" => true,
            "width" => ""
        ));

        $resolver->setAllowedTypes(array(
            "class" => "string",
            "padding" => "string",
            "name" => "string",
            "orderable" => "bool",
            "render" => array("string"),
            "searchable" => "bool",
            "title" => "string",
            "type" => "string",
            "visible" => "bool",
            "width" => "string"
        ));

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return "T3DatatablesBundle:Column:timeago.html.twig";
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return "timeago";
    }
}
