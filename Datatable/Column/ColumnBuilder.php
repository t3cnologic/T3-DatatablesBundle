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

use Exception;

/**
 * Class ColumnBuilder
 *
 * @package T3\DatatablesBundle\Datatable\Column
 */
class ColumnBuilder implements ColumnBuilderInterface
{
    /**
     * A ColumnFactoryInterface.
     *
     * @var ColumnFactory
     */
    private $columnFactory;

    /**
     * All columns.
     *
     * @var array
     */
    private $columns;

    /**
     * The multiselect column.
     *
     * @var ColumnInterface
     */
    private $multiselectColumn;

    /**
     * Multiselect column flag.
     *
     * @var boolean
     */
    private $multiselect;


    //-------------------------------------------------
    // Ctor.
    //-------------------------------------------------

    /**
     * Ctor.
     */
    public function __construct()
    {
        $this->columnFactory = new ColumnFactory();
        $this->columns = array();
        $this->multiselectColumn = null;
        $this->multiselect = false;
    }


    //-------------------------------------------------
    // ColumnBuilderInterface
    //-------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function add($data, $name, array $options = array())
    {
        /**
         * @var ColumnInterface $column
         */
        $column = $this->columnFactory->createColumnByName($name);
        $column->setData($data);
        $column->setDql($data);
        $column->setupOptionsResolver($options);

        $this->columns[] = $column;

        if ("multiselect" === $column->getAlias()) {
            if (false === $this->multiselect) {
                $this->multiselect = true;
                $this->multiselectColumn = $column;
            } else {
                throw new Exception("There is only one multiselect column allowed.");
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Get all virtual column names.
     *
     * @deprecated
     *
     * @return array
     */
    public function getVirtualColumnNames()
    {
        $virtualColumns = array();

        foreach ($this->columns as $column) {
            if ($column instanceof VirtualColumn) {
                $virtualColumns[] = $column->getData();
            }
        }

        return $virtualColumns;
    }


    //-------------------------------------------------
    // Getters && Setters
    //-------------------------------------------------

    /**
     * Get multiselect column.
     *
     * @return ColumnInterface
     */
    public function getMultiselectColumn()
    {
        return $this->multiselectColumn;
    }

    /**
     * Is multiselect.
     *
     * @return boolean
     */
    public function isMultiselect()
    {
        return (boolean) $this->multiselect;
    }
}
