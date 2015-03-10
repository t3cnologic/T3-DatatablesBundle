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

/**
 * Interface ColumnFactoryInterface
 *
 * @package T3\DatatablesBundle\Datatable\Column
 */
interface ColumnFactoryInterface
{
    /**
     * Creates a Column by name.
     *
     * @param string|ColumnInterface $name
     *
     * @throws \Symfony\Component\PropertyAccess\Exception\InvalidArgumentException
     * @throws \Exception
     * @return ColumnInterface
     */
    public function createColumnByName($name);
}
