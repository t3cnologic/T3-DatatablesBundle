<?php

/**
 * This file is part of the T3DatatablesBundle package.
 *
 * (c) stwe <https://github.com/t3cnologic/T3-DatatablesBundle>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace T3\DatatablesBundle\Datatable\Column;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\Exception\InvalidArgumentException;

/**
 * Class BooleanColumn
 *
 * @package T3\DatatablesBundle\Datatable\Column
 */
class BooleanColumn extends AbstractColumn
{
    /**
     * The icon for a value that is true.
     *
     * @var string
     */
    protected $trueIcon;

    /**
     * The icon for a value that is false.
     *
     * @var string
     */
    protected $falseIcon;

    /**
     * The label for a value that is true.
     *
     * @var string
     */
    protected $trueLabel;

    /**
     * The label for a value that is false.
     *
     * @var string
     */
    protected $falseLabel;


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
            "render" => "render_boolean",
            "searchable" => true,
            "title" => "",
            "type" => "",
            "visible" => true,
            "width" => "",
            "true_icon" => "",
            "false_icon" => "",
            "true_label" => "",
            "false_label" => ""
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
            "width" => "string",
            "true_icon" => "string",
            "false_icon" => "string",
            "true_label" => "string",
            "false_label" => "string"
        ));

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return "T3DatatablesBundle:Column:boolean.html.twig";
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return "boolean";
    }


    //-------------------------------------------------
    // Getters && Setters
    //-------------------------------------------------

    /**
     * Set false icon.
     *
     * @param string $falseIcon
     *
     * @return $this
     */
    public function setFalseIcon($falseIcon)
    {
        $this->falseIcon = $falseIcon;

        return $this;
    }

    /**
     * Get false icon.
     *
     * @return string
     */
    public function getFalseIcon()
    {
        return $this->falseIcon;
    }

    /**
     * Set true icon.
     *
     * @param string $trueIcon
     *
     * @return $this
     */
    public function setTrueIcon($trueIcon)
    {
        $this->trueIcon = $trueIcon;

        return $this;
    }

    /**
     * Get true icon.
     *
     * @return string
     */
    public function getTrueIcon()
    {
        return $this->trueIcon;
    }

    /**
     * Set false label.
     *
     * @param string $falseLabel
     *
     * @return $this
     */
    public function setFalseLabel($falseLabel)
    {
        $this->falseLabel = $falseLabel;

        return $this;
    }

    /**
     * Get false label.
     *
     * @return string
     */
    public function getFalseLabel()
    {
        return $this->falseLabel;
    }

    /**
     * Set true label.
     *
     * @param string $trueLabel
     *
     * @return $this
     */
    public function setTrueLabel($trueLabel)
    {
        $this->trueLabel = $trueLabel;

        return $this;
    }

    /**
     * Get false label.
     *
     * @return string
     */
    public function getTrueLabel()
    {
        return $this->trueLabel;
    }
}
