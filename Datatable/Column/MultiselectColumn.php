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
 * Class MultiselectColumn
 *
 * @package T3\DatatablesBundle\Datatable\Column
 */
class MultiselectColumn extends ActionColumn
{
    /**
     * HTML attributes for the checkboxes.
     *
     * @var array
     */
    protected $attributes;


    //-------------------------------------------------
    // ColumnInterface
    //-------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        //$resolver->setDefault("attributes", array());
        $resolver->setDefaults( array( "attributes" => array() ) );

        $resolver->addAllowedTypes(array(
            "attributes" => "array",
        ));

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return "T3DatatablesBundle:Column:multiselect.html.twig";
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return "multiselect";
    }


    //-------------------------------------------------
    // Getters && Setters
    //-------------------------------------------------

    /**
     * Set checkbox attributes.
     *
     * @param array $attributes
     *
     * @throws InvalidArgumentException
     * @return $this
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        if (array_key_exists("type", $this->attributes)) {
            throw new InvalidArgumentException("The 'type' attribute is not supported.");
        }
        if (array_key_exists("value", $this->attributes)) {
            throw new InvalidArgumentException("The 'value' attribute is not supported.");
        }
        if (array_key_exists("name", $this->attributes)) {
            $this->attributes["name"] = "multiselect_checkbox " . $this->attributes["name"];
        } else {
            $this->attributes["name"] = "multiselect_checkbox";
        }
        if (array_key_exists("class", $this->attributes)) {
            $this->attributes["class"] = "multiselect_checkbox " . $this->attributes["class"];
        } else {
            $this->attributes["class"] = "multiselect_checkbox";
        }

        return $this;
    }

    /**
     * Get checkbox attributes.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}
