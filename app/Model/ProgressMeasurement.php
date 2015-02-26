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
        if ($this->value == intval($this->value)) {
            return number_format($this->value, 0);
        } else if ($this->value * 10 == intval($this->value * 10)) {
            return number_format($this->value, 1);
        } else {
            return number_format($this->value, 2);
        }
    }

    public function getPeriod()
    {
        return $this->period;
    }
}
