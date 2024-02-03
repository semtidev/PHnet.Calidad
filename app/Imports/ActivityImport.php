<?php

namespace App\Imports;

use App\Extpoll;
use App\ExtpollActivity;
use App\Speciality;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ActivityImport implements ToCollection {
    
    public $work, $month, $year;

    // Constructor
    public function __construct($work, $month, $year) {
        $this->work = $work;
        $this->month = $month;
        $this->year = $year;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows) {
        
        foreach ($rows as $row) {
            
            if (strlen($row[0]) > 0 && $row[0] != 'Actividad') {
                
                if (Speciality::where('name', $row[2])->exists()) {
                    
                    $speciality = Speciality::where('name', $row[2])->first()->id;
                    
                    $activity = ExtpollActivity::create([
                        'id_speciality' => $speciality,
                        'description' => $row[0],
                        'act_level' => $row[1]
                    ]);

                    Extpoll::create([
                        'id_work' => intval($this->work),
                        'id_activity' => intval($activity->id),
                        'month' => intval($this->month),
                        'year' => intval($this->year),
                        'p1' => 4
                    ]);
                }
            }
        }
    }
}