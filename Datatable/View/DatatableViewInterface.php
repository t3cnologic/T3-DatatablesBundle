<?php

/**
 * This file is part of the T3DatatablesBundle package.
 *
 * (c) stwe <https://github.com/t3cnologic/T3-DatatablesBundle>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace T3\DatatablesBundle\Datatable\View;

/**
 * Interface DatatableViewInterface
 *
 * @package T3\DatatablesBundle\Datatable\View
 */
interface DatatableViewInterface
{
    /**
     * Builds the datatable view.
     */
    public function buildDatatableView();

    /**
     * Renders the datatable view.
     *
     * @param string $type
     *
     * @return mixed
     */
    public function renderDatatableView($type = 'all');

    /**
     * Returns Entity.
     *
     * @return string
     */
    public function getEntity();

    /**
     * Set Ajax.
     *
     * @param Ajax $ajax
     *
     * @return $this
     */
    public function setAjax(Ajax $ajax);

    /**
     * Get Ajax.
     *
     * @return Ajax
     */
    public function getAjax();

    /**
     * Returns the name of this datatable view.
     * Is used as jQuery datatable id selector.
     *
     * @return string
     */
    public function getName();

    /**
     * Returns a callable that could transform the data line
     *
     * @return callable
     */
    public function getLineFormatter();
}
