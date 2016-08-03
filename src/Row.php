<?php

namespace Boduch\Grid;

/**
 * @property string $class
 * @property string $style
 */
class Row implements \IteratorAggregate
{
    /**
     * @var Grid
     */
    protected $grid;

    /**
     * @var mixed|null
     */
    protected $raw;

    /**
     * @var CellInterface[]
     */
    protected $cells = [];

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @param mixed|null $raw
     */
    public function __construct($raw = null)
    {
        $this->raw = $raw;
    }

    /**
     * @param Grid $grid
     * @return $this
     */
    public function setGrid($grid)
    {
        $this->grid = $grid;

        return $this;
    }

    /**
     * @return Grid
     */
    public function getGrid()
    {
        return $this->grid;
    }

    /**
     * @param CellInterface $cell
     * @return $this
     */
    public function addCell(CellInterface $cell)
    {
        $this->cells[$cell->getColumn()->getName()] = $cell;

        return $this;
    }

    /**
     * @see IteratorAggregate::getIterator()
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->cells);
    }

    /**
     * Get cell object by name.

     * @param string $name  Column name
     * @return CellInterface|null
     */
    public function get($name)
    {
        return $this->cells[$name] ?? null;
    }

    /**
     * Get raw row data.
     *
     * @param string $name
     * @return mixed|null
     */
    public function raw($name)
    {
        return $this->raw[$name] ?? null;
    }

    /**
     * Get cell value.
     *
     * @param string $name  Column name
     * @return mixed
     */
    public function getValue($name)
    {
        return $this->cells[$name]->getValue();
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    /**
     * @param $name
     * @return string|null
     */
    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }
}