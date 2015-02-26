<?php namespace ConorSmith\Goals\Model;

use Illuminate\Database\Eloquent\Collection;

class GoalProgress
{
    public static function createFromEloquentCollection(Collection $models)
    {
        $measurements = [];

        foreach ($models as $progress) {
            if (is_null($progress->month)) {
                $yearMeasurement = new ProgressMeasurement($progress->percentage, $progress->value, "Year");
            } else {
                $measurements[] = new ProgressMeasurement($progress->percentage, $progress->value, \DateTime::createFromFormat("m", $progress->month)->format('M'));
            }
        }

        return new self($yearMeasurement, $measurements);
    }

    private $yearMeasurement;
    private $monthMeasurements;

    public function __construct(ProgressMeasurement $yearMeasurement, array $monthMeasurements)
    {
        $this->yearMeasurement = $yearMeasurement;
        $this->monthMeasurements = $monthMeasurements;
    }

    public function getMeasurementForTheYear()
    {
        return $this->yearMeasurement;
    }

    public function getMeasurementsForEachMonth()
    {
        return $this->monthMeasurements;
    }

    public function getMonthlyProgressAsJson()
    {
        $data = [];

        foreach ($this->monthMeasurements as $measurement) {
            //$data[] = $measurement->getPercentage();
            $data[] = [
                'name' => $measurement->getValue(),
                'y' => (float) $measurement->getPercentage()
            ];
        }

        return json_encode($data);
    }
}