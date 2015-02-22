<?php namespace ConorSmith\Goals\Model;

class Goal
{
    private $name;
    private $progress;
    private $value;
    private $unit;

    public function __construct($name, $value, $unit, GoalProgress $progress)
    {
        $this->name = $name;
        $this->progress = $progress;
        $this->value = $value;
        $this->unit = $unit;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return GoalProgress
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }
}
