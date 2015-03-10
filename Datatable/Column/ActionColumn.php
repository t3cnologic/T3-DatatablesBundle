<?php

/**
 * This file is part of the T3DatatablesBundle package.
 *
 * (c) stwe <https://github.com/t3cnologic/T3-DatatablesBundle>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Tomáš Polívka <draczris@gmail.com>
 * @author stwe
 */

namespace T3\DatatablesBundle\Datatable\Column;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\Exception\InvalidArgumentException;

/**
 * Class ActionColumn
 *
 * @package T3\DatatablesBundle\Datatable\Column
 */
class ActionColumn extends AbstractColumn
{
    /**
     * Start HTML.
     *
     * @var string
     */
    protected $startHtml;

    /**
     * End HTML.
     *
     * @var string
     */
    protected $endHtml;

    /**
     * The actions container.
     *
     * @var array
     */
    protected $actions;


    //-------------------------------------------------
    // ColumnInterface
    //-------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function setData($data)
    {
        if (null !== $data) {
            throw new InvalidArgumentException("setData(): Null expected.");
        }

        $this->data = $data;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(array("actions"));

        $resolver->setDefaults(array(
            "class" => "",
            "padding" => "",
            "name" => "",
            "title" => "",
            "type" => "",
            "visible" => true,
            "width" => "",
            "start_html" => "",
            "end_html" => ""
        ));

        $resolver->setAllowedTypes(array(
            "class" => "string",
            "padding" => "string",
            "name" => "string",
            "title" => "string",
            "type" => "string",
            "visible" => "bool",
            "width" => "string",
            "start_html" => "string",
            "end_html" => "string",
            "actions" => "array"
        ));

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return "T3DatatablesBundle:Column:action.html.twig";
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return "action";
    }


    //-------------------------------------------------
    // Getters && Setters
    //-------------------------------------------------

    /**
     * Set start HTML.
     *
     * @param string $startHtml
     *
     * @return $this
     */
    public function setStartHtml($startHtml)
    {
        $this->startHtml = $startHtml;

        return $this;
    }

    /**
     * Get start HTML.
     *
     * @return string
     */
    public function getStartHtml()
    {
        return $this->startHtml;
    }

    /**
     * Set end HTML.
     *
     * @param string $endHtml
     *
     * @return $this
     */
    public function setEndHtml($endHtml)
    {
        $this->endHtml = $endHtml;

        return $this;
    }

    /**
     * Get end HTML.
     *
     * @return string
     */
    public function getEndHtml()
    {
        return $this->endHtml;
    }

    /**
     * Set actions.
     *
     * @param array $actions
     *
     * @return $this
     */
    public function setActions(array $actions)
    {
        foreach ($actions as $action) {
            $newAction = new Action();
            $this->actions[] = $newAction->setOptions($action);
        }

        return $this;
    }

    /**
     * Get actions.
     *
     * @return array
     */
    public function getActions()
    {
        return $this->actions;
    }
}
