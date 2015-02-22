<?php namespace ConorSmith\Goals\Model;

use Cache;
use Carbon\Carbon;
use Config;
use ConorSmith\Goals\Achievement;
use ConorSmith\Goals\RangedAchievement;
use ConorSmith\Goals\Services\GoogleDrive;
use ConorSmith\Goals\Weight;
use ConorSmith\Goals\Words;
use ConorSmith\Goals\Workout;
use League\Csv\Reader as CsvReader;

class ProgressCalculationService
{
    private $slug;
    private $annualTotal;
    private $monthlyTotals;

    public function __construct()
    {
        $this->annualTotal = 0;
        $this->monthlyTotals = array_fill(1, 12, 0);
    }

    public function setGoal($goalSlug)
    {
        $this->slug = $goalSlug;

        if (method_exists($this, $this->slug . 'Strategy')) {
            $this->{$this->slug . 'Strategy'}();
        }
    }

    public function getAnnualTotal()
    {
        if (is_null($this->slug)) {
            throw new \LogicException;
        }

        return $this->annualTotal;;
    }

    public function getMonthlyTotals()
    {
        if (is_null($this->slug)) {
            throw new \LogicException;
        }

        return $this->monthlyTotals;
    }

    private function cookStrategy()
    {
        $achievements = Achievement::where('label', 'recipe-learned')->get();

        $this->annualTotal = count($achievements);

        foreach ($achievements as $achievement) {
            $this->monthlyTotals[$achievement->achieved_at->format('n')]++;
        }
    }

    private function weighStrategy()
    {
        $mostRecentWeight = Weight::orderBy('measured_at', 'desc')->first();

        if (is_null($mostRecentWeight)) {
            return;
        }

        $this->annualTotal = $mostRecentWeight->measurement;

        for ($i = 1; $i <= 12; $i++) {
            $weight = Weight::whereRaw("MONTH(measured_at) = ?", [$i])
                ->orderBy('measured_at', 'desc')->first();

            if (is_null($weight)) {
                $this->monthlyTotals[$i] = $mostRecentWeight->measurement;
            } else {
                $this->monthlyTotals[$i] = $weight->measurement;
            }
        }
    }

    private function readStrategy()
    {
        $achievements = RangedAchievement::where('label', 'book-read')->get();

        $this->annualTotal = count($achievements);

        foreach ($achievements as $achievement) {
            $this->monthlyTotals[$achievement->finished_at->format('n')]++;
        }
    }

    private function writeStrategy()
    {
        $words = Words::all();

        $this->annualTotal = $words->reduce(function ($total, $words)
        {
            return $total + $words->word_count;
        }, 0);

        for ($i = 1; $i <= 12; $i++) {
            $this->monthlyTotals[$i] = $words
                ->filter(function ($words) use ($i)
                {
                    return $words->written_at->format('n') == $i;
                })
                ->reduce(function ($total, $words)
                {
                    return $total + $words->word_count;
                }, 0);
        }
    }

    private function listenStrategy()
    {
        $drive = new GoogleDrive;

        if (!$drive->hasAccessToken()) {
            throw new \DomainException("The application does not have an access token for Google Drive.");
        }

        $service = $drive->getService();
        $sheet = $service->files->get("1QjvQu-m1HQStiI5fY_rzemwSrCm9i4OriKxRSRzEU08");

        $csv = CsvReader::createFromString(file_get_contents($sheet->getExportLinks()['text/csv']));

        foreach ($csv->fetchAssoc() as $album) {
            if (!is_null($album['Album'])) {
                $this->annualTotal++;

                if ($album['Week']) {
                    $latestDate = Carbon::createFromFormat("d/m/Y", $album['Week']);
                }

                $this->monthlyTotals[$latestDate->format('n')]++;
            }
        }
    }

    private function runStrategy()
    {
        $this->exerciseStrategy();
    }

    private function walkStrategy()
    {
        $this->exerciseStrategy();
    }

    private function exerciseStrategy()
    {
        $workouts = Workout::all();

        $this->annualTotal = $workouts->reduce(function ($total, $workout)
        {
            return $total + $workout->distance;
        }, 0);

        for ($i = 1; $i <= 12; $i++) {
            $this->monthlyTotals[$i] = $workouts
                ->filter(function ($workout) use ($i)
                {
                    return $workout->exercised_at->format('n') == $i;
                })
                ->reduce(function ($total, $workout)
                {
                    return $total + $workout->distance;
                }, 0);
        }
    }
}
