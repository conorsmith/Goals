<?php namespace ConorSmith\Goals\Model;

class ProgressMeasurement
{
    private $percentage;
    private $value;
    private $period;

    public function __construct($percentage, $value, $period)
    {
        $this->percentage = $percentage;
        $this->value = $value;
        $this->period = $period;
    }

    public function getPercentage()
    {
        return $this->percentage;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getPeriod()
    {
        return $this->period;
    }
}
