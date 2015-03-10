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

/**
 * Interface ColumnBuilderInterface
 *
 * @package T3\DatatablesBundle\Datatable\Column
 */
interface ColumnBuilderInterface
{
    /**
     * Add a ColumnInterface.
     *
     * @param null|string            $data    The data source for the column
     * @param string|ColumnInterface $name    Column class alias or instance of ColumnInterface
     * @param array                  $options The column options
     *
     * @return $this
     */
    public function add($data, $name, array $options = array());

    /**
     * Get all columns.
     *
     * @return array
     */
    public function getColumns();

    /**
     * Get all virtual column names.
     *
     * @deprecated
     *
     * @return array
     */
    public function getVirtualColumnNames();
}
