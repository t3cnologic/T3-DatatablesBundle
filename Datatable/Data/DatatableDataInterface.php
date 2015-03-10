<?php

/**
 * This file is part of the T3DatatablesBundle package.
 *
 * (c) stwe <https://github.com/t3cnologic/T3-DatatablesBundle>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace T3\DatatablesBundle\Datatable\Data;

/**
 * Interface DatatableDataInterface
 *
 * @package T3\DatatablesBundle\Datatable\Data
 */
interface DatatableDataInterface
{
    /**
     * Get Response.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getResponse();

    /**
     * Add a callback function.
     *
     * @param string $callback
     *
     * @throws \Exception
     * @return self
     */
    public function addWhereBuilderCallback($callback);
}
