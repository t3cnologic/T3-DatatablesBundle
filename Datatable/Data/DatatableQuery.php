<?php

/**
 * This file is part of the T3DatatablesBundle package.
 *
 * (c) stwe <https://github.com/stwe/DatatablesBundle>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace T3\DatatablesBundle\Datatable\Data;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;

/**
 * Class DatatableQuery
 *
 * @package T3\DatatablesBundle\Datatable\Data
 */
class DatatableQuery
{
    /**
     * @var array
     */
    protected $requestParams;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var string
     */
    protected $tableName;

    /**
     * @var string
     */
    protected $entityName;

    /**
     * @var QueryBuilder
     */
    protected $qb;

    /**
     * @var array
     */
    protected $selectColumns;

    /**
     * @var array
     */
    protected $allColumns;

    /**
     * @var array
     */
    protected $joins;

    /**
     * @var array
     */
    protected $searchColumns;

    /**
     * @var array
     */
    protected $orderColumns;

    /**
     * @var array
     */
    protected $callbacks;


    //-------------------------------------------------
    // Ctor.
    //-------------------------------------------------

    /**
     * Ctor.
     *
     * @param array         $requestParams All request params
     * @param ClassMetadata $metadata      A ClassMetadata instance
     * @param EntityManager $em            A EntityManager instance
     */
    public function __construct(array $requestParams, ClassMetadata $metadata, EntityManager $em)
    {
        $this->requestParams = $requestParams;
        $this->em = $em;
        $this->tableName = $metadata->getTableName();
        $this->entityName = $metadata->getName();
        $this->qb = $this->em->createQueryBuilder();
        $this->selectColumns = array();
        $this->allColumns = array();
        $this->joins = array();
        $this->searchColumns = array();
        $this->orderColumns = array();
        $this->callbacks = array(
            "WhereBuilder" => array(),
        );
    }


    //-------------------------------------------------
    // Public
    //-------------------------------------------------

    /**
     * Get qb.
     *
     * @return QueryBuilder
     */
    public function getQb()
    {
        return $this->qb;
    }

    /**
     * Set selectColumns.
     *
     * @param array $selectColumns
     *
     * @return $this
     */
    public function setSelectColumns(array $selectColumns)
    {
        $this->selectColumns = $selectColumns;

        return $this;
    }

    /**
     * Set allColumns.
     *
     * @param array $allColumns
     *
     * @return $this
     */
    public function setAllColumns(array $allColumns)
    {
        $this->allColumns = $allColumns;

        return $this;
    }

    /**
     * Set joins.
     *
     * @param array $joins
     *
     * @return $this
     */
    public function setJoins(array $joins)
    {
        $this->joins = $joins;

        return $this;
    }

    /**
     * Set search columns.
     *
     * @param array $searchColumns
     *
     * @return $this
     */
    public function setSearchColumns(array $searchColumns)
    {
        $this->searchColumns = $searchColumns;

        return $this;
    }

    /**
     * Set order columns.
     *
     * @param array $orderColumns
     *
     * @return $this
     */
    public function setOrderColumns(array $orderColumns)
    {
        $this->orderColumns = $orderColumns;

        return $this;
    }

    /**
     * Add callback.
     *
     * @param string $callback
     *
     * @return $this
     */
    public function addCallback($callback)
    {
        $this->callbacks["WhereBuilder"][] = $callback;

        return $this;
    }

    /**
     * Query results before filtering.
     *
     * @param integer $rootEntityIdentifier
     *
     * @return int
     */
    public function getCountAllResults($rootEntityIdentifier)
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select("count(" . $this->tableName . "." . $rootEntityIdentifier . ")");
        $qb->from($this->entityName, $this->tableName);

        $this->setWhereCallbacks($qb);

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Query results after filtering.
     *
     * @param integer $rootEntityIdentifier
     *
     * @return int
     */
    public function getCountFilteredResults($rootEntityIdentifier)
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select("count(distinct " . $this->tableName . "." . $rootEntityIdentifier . ")");
        $qb->from($this->entityName, $this->tableName);

        $this->setLeftJoins($qb);
        $this->setWhere($qb);
        $this->setWhereCallbacks($qb);

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Set select from.
     *
     * @return $this
     */
    public function setSelectFrom()
    {
        foreach ($this->selectColumns as $key => $value) {
            $this->qb->addSelect("partial " . $key . ".{" . implode(",", $this->selectColumns[$key]) . "}");
        }

        $this->qb->from($this->entityName, $this->tableName);

        return $this;
    }

    /**
     * Set leftJoins.
     *
     * @param QueryBuilder|null $qb
     *
     * @return $this
     */
    public function setLeftJoins($qb = null)
    {
        $pivot = $this->qb;

        if (null !== $qb) {
            $pivot = $qb;
        }

        foreach ($this->joins as $join) {
            $pivot->leftJoin($join["source"], $join["target"]);
        }

        return $this;
    }

    /**
     * Searching / Filtering.
     * Construct the WHERE clause for server-side processing SQL query.
     *
     * @param QueryBuilder|null $qb
     *
     * @return $this
     */
    public function setWhere($qb = null)
    {
        $pivot = $this->qb;

        if (null !== $qb) {
            $pivot = $qb;
        }

        $globalSearch = $this->requestParams["search"]["value"];

        // global filtering
        if ("" != $globalSearch) {

            $orExpr = $pivot->expr()->orX();

            foreach ($this->searchColumns as $key => $column) {
                if (null !== $this->searchColumns[$key]) {
                    $searchField = $this->searchColumns[$key];
                    $orExpr->add($pivot->expr()->like($searchField, "?$key"));
                    $pivot->setParameter($key, "%" . $globalSearch . "%");
                }
            }

            $pivot->where($orExpr);
        }

        // individual filtering
        $andExpr = $pivot->expr()->andX();

        $i = 100;

        foreach ($this->searchColumns as $key => $column) {
            if (null !== $this->searchColumns[$key]) {
                $searchField = $this->searchColumns[$key];
                $searchValue = $this->requestParams["columns"][$key]["search"]["value"];
                if ("" != $searchValue) {
                    $andExpr->add($pivot->expr()->like($searchField, "?$i"));
                    $pivot->setParameter($i, "%" . $searchValue . "%");
                    $i++;
                }
            }
        }

        if ($andExpr->count() > 0) {
            $pivot->andWhere($andExpr);
        }

        return $this;
    }

    /**
     * Set where callback functions.
     *
     * @param QueryBuilder|null $qb
     *
     * @return $this
     */
    public function setWhereCallbacks($qb = null)
    {
        $pivot = $this->qb;

        if (null !== $qb) {
            $pivot = $qb;
        }

        if (!empty($this->callbacks["WhereBuilder"])) {
            foreach ($this->callbacks["WhereBuilder"] as $callback) {
                $callback($pivot);
            }
        }

        return $this;
    }

    /**
     * Ordering.
     * Construct the ORDER BY clause for server-side processing SQL query.
     *
     * @return $this
     */
    public function setOrderBy()
    {
        if (isset($this->requestParams["order"]) && count($this->requestParams["order"])) {

            $counter = count($this->requestParams["order"]);

            for ($i = 0; $i < $counter; $i++) {
                $columnIdx = (integer) $this->requestParams["order"][$i]["column"];
                $requestColumn = $this->requestParams["columns"][$columnIdx];

                if ("true" == $requestColumn["orderable"]) {
                    $this->qb->addOrderBy(
                        $this->orderColumns[$columnIdx],
                        $this->requestParams["order"][$i]["dir"]
                    );
                }
            }
        }

        return $this;
    }

    /**
     * Paging.
     * Construct the LIMIT clause for server-side processing SQL query.
     *
     * @return $this
     */
    public function setLimit()
    {
        if (isset($this->requestParams["start"]) && -1 != $this->requestParams["length"]) {
            $this->qb->setFirstResult($this->requestParams["start"])->setMaxResults($this->requestParams["length"]);
        }

        return $this;
    }

    /**
     * Constructs a Query instance.
     *
     * @return Query
     */
    public function execute()
    {
        $query = $this->qb->getQuery();
        $query->setHydrationMode(Query::HYDRATE_ARRAY);

        return $query;
    }
}
