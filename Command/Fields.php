<?php

/**
 * This file is part of the T3DatatablesBundle package.
 *
 * (c) stwe <https://github.com/t3cnologic/T3-DatatablesBundle>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace T3\DatatablesBundle\Command;

/**
 * Class Fields
 *
 * @package T3\DatatablesBundle\Command
 */
class Fields
{
    /**
     * Parse fields.
     *
     * @param string $input
     *
     * @return array
     */
    public static function parseFields($input)
    {
        $fields = array();

        foreach (explode(" ", $input) as $value) {
            $elements = explode(':', $value);
            $property = $elements[0];
            if (strlen($property)) {
                $columnName = isset($elements[1]) ? $elements[1] : "column";
                preg_match_all('/(.*)\((.*)\)/', $columnName, $matches);
                $columnName = isset($matches[1][0]) ? $matches[1][0] : $columnName;

                $title = ucwords(str_replace(".", " ", $property));

                $row = array();
                $row["property"] = $property;
                $row["column_name"] = $columnName;
                $row["title"] = $title;
                $fields[] = $row;
            }
        }

        return $fields;
    }
}
