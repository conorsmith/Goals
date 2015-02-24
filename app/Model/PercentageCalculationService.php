<?php namespace ConorSmith\Goals\Model;

use ConorSmith\Goals\Goal;

class PercentageCalculationService
{
    private $goalSlugToStrategyMap = [
        'weigh' => 'weigh',
    ];

    private $goal;

    public function setGoal(Goal $goal)
    {
        $this->goal = $goal;
    }

    public function getAnnualPercentage($total)
    {
        if (is_null($this->goal)) {
            throw new \LogicException;
        }

        if (!array_key_exists($this->goal->slug, $this->goalSlugToStrategyMap)) {
            return $this->defaultAnnualStrategy($total);
        }

        return $this->{$this->goalSlugToStrategyMap[$this->goal->slug] . 'AnnualStrategy'}($total);
    }

    public function getMonthlyPercentage($monthIndex, $total)
    {
        if (is_null($this->goal)) {
            throw new \LogicException;
        }

        if (array_key_exists($this->goal->slug, $this->goalSlugToStrategyMap)) {
            $strategy = $this->goalSlugToStrategyMap[$this->goal->slug] . 'MonthlyStrategy';
        } else {
            $strategy = 'defaultMonthlyStrategy';
        }

        return $this->{$strategy}($monthIndex, $total);
    }

    private function defaultAnnualStrategy($total)
    {
        return round($total / $this->goal->value * 100, 1);
    }

    private function defaultMonthlyStrategy($monthIndex, $total)
    {
        $monthlyTarget = $this->goal->value * cal_days_in_month(CAL_GREGORIAN, $monthIndex, 2015) / 365;
        return round($total / $monthlyTarget * 100, 1);
    }

    private function weighAnnualStrategy($total)
    {
        $startingWeight = 94;
        return round(($startingWeight - $total) / ($startingWeight - $this->goal->value) * 100, 1);
    }

    private function weighMonthlyStrategy($monthIndex, $total)
    {
        if ($total === 0) {
            return 0;
        }
        
        $startingWeight = 94;
        $monthlyTarget = ($startingWeight - $this->goal->value) * cal_days_in_month(CAL_GREGORIAN, $monthIndex, 2015) / 365;
        return round(($startingWeight - $total) / $monthlyTarget * 100, 1);
    }
}
