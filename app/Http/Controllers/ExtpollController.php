<?php

namespace App\Http\Controllers;

use Throwable;
use App\Work;
use App\Company;
use App\Department;
use App\Speciality;
use App\Extpoll;
use App\ExtpollActivity;
use App\Imports\ActivityImport;
use Maatwebsite\Excel\Facades\Excel as Excel;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class ExtpollController extends Controller
{
    /**
     * Get external polls.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getExtPoll($work, $month, $year)
    {
        $extpolls = array();
        $allpoll_prom = array('p1'=>0, 'p2'=>0, 'p3'=>0, 'p4'=>0, 'p5'=>0, 'sum'=>0, 'prom'=>0);
        $query_polls = Extpoll::leftJoin('extpoll_activities', 'extpoll_activities.id', '=', 'extpolls.id_activity')->leftJoin('specialities', 'specialities.id', '=', 'extpoll_activities.id_speciality')->leftJoin('departments', 'departments.id', '=', 'specialities.id_department')
                        ->select('extpolls.id', 'extpolls.id_work', 'extpolls.id_activity', 'extpolls.month', 'extpolls.year', 'extpolls.p1', 'extpolls.p2', 'extpolls.p3', 'extpolls.p4', 'extpolls.p5', 'extpoll_activities.description', 'extpoll_activities.act_level', 'specialities.id AS id_speciality', 'specialities.name AS speciality', 'departments.name AS department')
                        ->where('extpolls.id_work', $work)
                        ->where('extpolls.month', intval($month))
                        ->where('extpolls.year', $year)
                        ->orderBy('departments.id', 'ASC')
                        ->orderBy('specialities.id', 'ASC')
                        ->get();
        
        $counter = 0;
        $counter_act = 0;
        $number = 0;
        $work_total = 0;
        $speciality = '';
        $department = '';
        foreach ($query_polls as $row) {
            
            $number++;
            if ($row['speciality'] != $speciality) {
                
                if ($number == 1) {
                    $department = $row->department;
                }
                else{
                    $extpolls[$counter] = array(
                        "id"          => null,
                        "number"      => -1,
                        "id_work"     => null,
                        "id_activity" => null,
                        "month"       => null,
                        "year"        => null,
                        "p1"          => number_format($allpoll_prom['p1'] / $counter_act, 1, '.', ''),
                        "p2"          => number_format($allpoll_prom['p2'] / $counter_act, 1, '.', ''),
                        "p3"          => number_format($allpoll_prom['p3'] / $counter_act, 1, '.', ''),
                        "p4"          => number_format($allpoll_prom['p4'] / $counter_act, 1, '.', ''),
                        "p5"          => number_format($allpoll_prom['p5'] / $counter_act, 1, '.', ''),
                        "sum"         => number_format($allpoll_prom['sum'] / $counter_act, 1, '.', ''),
                        "prom"        => number_format($allpoll_prom['prom'] / $counter_act, 1, '.', ''),
                        "description" => 'Promedio',
                        "act_level"   => null,
                        "id_speciality" => null,
                        "speciality"  => null,
                        "department"  => $department,
                        "work_prom"   => null,
                        "work_eval"   => null
                    );
                    $counter++;
                    $department = $row->department;
                }
                
                $speciality = $row->speciality;
                $counter_act = 0;
                $extpolls[$counter] = array(
                    "id"          => null,
                    "number"      => null,
                    "id_work"     => null,
                    "id_activity" => null,
                    "month"       => null,
                    "year"        => null,
                    "p1"          => 0,
                    "p2"          => 0,
                    "p3"          => 0,
                    "p4"          => 0,
                    "p5"          => 0,
                    "sum"         => null,
                    "prom"        => null,
                    "description" => $row->speciality,
                    "act_level"   => null,
                    "id_speciality" => null,
                    "speciality"  => null,
                    "department"  => $row->department,
                    "work_prom"   => null,
                    "work_eval"   => null
                );
                $counter++;
                $allpoll_prom = array('p1'=>0, 'p2'=>0, 'p3'=>0, 'p4'=>0, 'p5'=>0, 'sum'=>0, 'prom'=>0);                
            }

            $row['sum'] = $row['p1'] + $row['p2'] + $row['p3'] + $row['p4'] + $row['p5'];
            $poll_counter = 0;
            for ($i=1; $i < 6; $i++) { 
                if ($row['p' . $i] > 0) {
                    $poll_counter++;
                }
            }
            $row['prom'] = number_format($row['sum'] / $poll_counter, 1, '.', ' ');
            $allpoll_prom['p1'] += $row['p1'];
            $allpoll_prom['p2'] += $row['p2'];
            $allpoll_prom['p3'] += $row['p3'];
            $allpoll_prom['p4'] += $row['p4'];
            $allpoll_prom['p5'] += $row['p5'];
            $allpoll_prom['sum'] += $row['sum'];
            $allpoll_prom['prom'] += $row['prom'];
            $work_total += $row['prom'];

            $extpolls[$counter] = array(
                "id"          => $row->id,
                "number"      => $number,
                "id_work"     => $row->id_work,
                "id_activity" => $row->id_activity,
                "month"       => $row->month,
                "year"        => $row->year,
                "p1"          => $row->p1,
                "p2"          => $row->p2,
                "p3"          => $row->p3,
                "p4"          => $row->p4,
                "p5"          => $row->p5,
                "sum"         => $row['sum'],
                "prom"        => $row['prom'],
                "description" => $row->description,
                "act_level"   => $row->act_level,
                "id_speciality" => $row->id_speciality,
                "speciality"  => $row->speciality,
                "department"  => $row->department,
                "work_prom"   => null,
                "work_eval"   => null
            );
            $counter++;
            $counter_act++;

            if ($number == count($query_polls)) {
                
                if ($number > 0) {
                    $work_prom = number_format($work_total / $number, 2, '.', '');
                    if (4.5 <= $work_prom && $work_prom <= 5) {
                        $work_eval = 'Muy Bueno';
                    }
                    elseif (4 <= $work_prom && $work_prom < 4.5) {
                        $work_eval = 'Bueno';
                    }
                    elseif (3 <= $work_prom && $work_prom < 4) {
                        $work_eval = 'Regular';
                    }
                    elseif ($work_prom < 3) {
                        $work_eval = 'Mal';
                    }
                }

                $extpolls[$counter] = array(
                    "id"          => null,
                    "number"      => -1,
                    "id_work"     => null,
                    "id_activity" => null,
                    "month"       => null,
                    "year"        => null,
                    "p1"          => number_format($allpoll_prom['p1'] / $counter_act, 1, '.', ''),
                    "p2"          => number_format($allpoll_prom['p2'] / $counter_act, 1, '.', ''),
                    "p3"          => number_format($allpoll_prom['p3'] / $counter_act, 1, '.', ''),
                    "p4"          => number_format($allpoll_prom['p4'] / $counter_act, 1, '.', ''),
                    "p5"          => number_format($allpoll_prom['p5'] / $counter_act, 1, '.', ''),
                    "sum"         => number_format($allpoll_prom['sum'] / $counter_act, 1, '.', ''),
                    "prom"        => number_format($allpoll_prom['prom'] / $counter_act, 1, '.', ''),
                    "description" => 'Promedio',
                    "act_level"   => null,
                    "id_speciality" => null,
                    "speciality"  => null,
                    "department"  => $department,
                    "work_prom"   => $work_prom,
                    "work_eval"   => $work_eval
                );
            }
        }
        
        Cache::forever('extpolls', $extpolls);
        
        $response = array('success' => true, 'satisfaction' => $extpolls);
        return response()->json($response,200);
    }

    /**
     * Create Activity.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createActivity(Request $request)
    {
        $activity = ExtpollActivity::create([
                        'id_speciality' => intval($request->speciality),
                        'description' => $request->activity,
                        'act_level' => $request->actlevel
                    ]);

        $poll = Extpoll::create([
                    'id_work' => intval($request->work),
                    'id_activity' => intval($activity->id),
                    'month' => intval($request->month),
                    'year' => intval($request->year),
                    'p1' => $request->p1,
                    'p2' => $request->p2,
                    'p3' => $request->p3,
                    'p4' => $request->p4,
                    'p5' => $request->p5
                ]);

        $response = array(
            'success' => true,
            'poll' => $poll
        );
        return response()->json($response,200);
    }

    /**
     * Update Activity.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateActivity(Request $request)
    {
        $activity = ExtpollActivity::find(intval($request->id_activity))->update([
                        'id_speciality' => intval($request->speciality),
                        'description' => $request->activity,
                        'act_level' => $request->actlevel
                    ]);

        $poll = Extpoll::find(intval($request->id_poll))->update([
                    'id_work' => intval($request->work),
                    'id_activity' => intval($request->id_activity),
                    'month' => intval($request->month),
                    'year' => intval($request->year),
                    'p1' => $request->p1,
                    'p2' => $request->p2,
                    'p3' => $request->p3,
                    'p4' => $request->p4,
                    'p5' => $request->p5
                ]);

        $response = array(
            'success' => true,
            'poll' => $poll
        );
        return response()->json($response,200);
    }

    /**
     * Delete Activity.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteActivity(Request $request)
    {
        $id_activity = Extpoll::where('id', $request->id)->first()->id_activity;
        $activity = ExtpollActivity::find($id_activity)->delete();

        $poll = Extpoll::find(intval($request->id))->delete();

        $response = array(
            'success' => true, 
            'poll' => $poll
        );
        return response()->json($response,200);
    }

    /**
     * Load Form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loadForm(Request $request)
    {
        $poll = Extpoll::leftJoin('extpoll_activities', 'extpoll_activities.id', '=', 'extpolls.id_activity')->leftJoin('specialities', 'specialities.id', '=', 'extpoll_activities.id_speciality')->leftJoin('departments', 'departments.id', '=', 'specialities.id_department')
                    ->select('extpolls.id', 'extpolls.id_activity', 'extpolls.p1', 'extpolls.p2', 'extpolls.p3', 'extpolls.p4', 'extpolls.p5', 'extpoll_activities.description', 'extpoll_activities.act_level', 'specialities.id AS speciality', 'departments.id AS department')
                    ->where('extpolls.id', $request->id_poll)
                    ->first();

        $response = array(
            'success' => true,
            'data' => array(
                "id_poll" => $poll->id,
                "id_activity" => $poll->id_activity,
                "activity" => $poll->description,
                "department" => intval($poll->department),
                "speciality" => intval($poll->speciality),
                "actlevel" => $poll->act_level,
                "p1" => $poll->p1,
                "p2" => $poll->p2,
                "p3" => $poll->p3,
                "p4" => $poll->p4,
                "p5" => $poll->p5
            )
        );
        return response()->json($response,200);
    }

    /**
     * Export to PDF Analityc Project.
     *
     * @return \Illuminate\Http\Response
     */
    public function ExpAnalityc(Request $request)
    {
        $month   = $request->month;
        $year    = $request->year;
        $work    = Work::where('id', $request->work)->first();
        $company = Company::first();
        $allpoll_prom = array('p1'=>0, 'p2'=>0, 'p3'=>0, 'p4'=>0, 'p5'=>0, 'sum'=>0, 'prom'=>0);
        $extpoll_eval = '';
        
        $extpolls = array();
        $extpolls_issues = array();
        if (Cache::get('extpolls') != null) {
            $extpolls = Cache::get('extpolls');
        }
        //return $extpolls;
        $counter_poll = 0;
        foreach ($extpolls as $row) {

            if ($row['number'] > 0) {
                
                $counter_poll++;

                $row['sum'] = intval($row['p1']) + intval($row['p2']) + intval($row['p3']) + intval($row['p4']) + intval($row['p5']);
                $poll_counter = 0;
                for ($i = 1; $i < 6; $i++) {
                    if ($row['p' . $i] > 0) {
                        $poll_counter++;
                    }
                }
                
                $allpoll_prom['prom'] += intval($row['prom']);
                $row['prom'] = number_format($row['sum'] / $poll_counter, 2, '.', '');
                $allpoll_prom['p1'] += intval($row['p1']);
                $allpoll_prom['p2'] += intval($row['p2']);
                $allpoll_prom['p3'] += intval($row['p3']);
                $allpoll_prom['p4'] += intval($row['p4']);
                $allpoll_prom['p5'] += intval($row['p5']);
                $allpoll_prom['sum'] += intval($row['sum']);

                if ($row['prom'] < 4) {
                    $extpolls_issues[] = $row['description'];
                }
            }
        }
        $total_prom = number_format($allpoll_prom['prom'] / $counter_poll, 2, '.', '');

        if (4.5 <= floatval($total_prom)  && floatval($total_prom) <= 5) {
            $extpoll_eval = 'Muy Bueno';
        }
        elseif (4 <= floatval($total_prom) && floatval($total_prom) < 4.5) {
            $extpoll_eval = 'Bueno';
        }
        elseif (3 <= floatval($total_prom) && floatval($total_prom) < 4) {
            $extpoll_eval = 'Regular';
        }
        elseif (floatval($total_prom) < 3) {
            $extpoll_eval = 'Mal';
        }

        $pdf = PDF::loadView('pdf.ExtpollAnalityc', compact('month', 'year',  'company', 'work', 'extpolls', 'total_prom', 'extpoll_eval', 'extpolls_issues'));
        return $pdf->download('Satisfacción Cliente Externo '.$work->name.' '.$request->month.'-'.$request->year.'.pdf');
    }

    /**
     * Export to PDF Certification.
     *
     * @return \Illuminate\Http\Response
     */
    public function ExpCertification(Request $request)
    {
        $month      = $request->month;
        $year       = $request->year;
        $company    = Company::first();
        $works      = Work::where('extcustomerpoll', 1)->where('active', 1)->get();
        $works_eval = array();
        $ubph_total = 0;
        $count_work = 0;
        
        foreach ($works as $work) {
            
            $allpoll_prom = 0;

            // Get polls
            $extpolls = array();
            $extpolls = Extpoll::leftJoin('extpoll_activities', 'extpoll_activities.id', '=', 'extpolls.id_activity')->leftJoin('specialities', 'specialities.id', '=', 'extpoll_activities.id_speciality')->leftJoin('departments', 'departments.id', '=', 'specialities.id_department')
                            ->select('extpolls.id', 'extpolls.id_work', 'extpolls.id_activity', 'extpolls.month', 'extpolls.year', 'extpolls.p1', 'extpolls.p2', 'extpolls.p3', 'extpolls.p4', 'extpolls.p5', 'extpoll_activities.description', 'extpoll_activities.act_level', 'specialities.id AS id_speciality', 'specialities.name AS speciality', 'departments.name AS department')
                            ->where('extpolls.id_work', $work->id)
                            ->where('extpolls.month', intval($month))
                            ->where('extpolls.year', $year)
                            ->orderBy('departments.id', 'ASC')
                            ->orderBy('specialities.id', 'ASC')
                            ->get();

            $counter_poll = 0;
            foreach ($extpolls as $row) {
                        
                $counter_poll++;

                $poll_sum = $row['p1'] + $row['p2'] + $row['p3'] + $row['p4'] + $row['p5'];
                $poll_counter = 0;
                for ($i=1; $i < 6; $i++) {
                    if ($row['p' . $i] > 0) {
                        $poll_counter++;
                    }
                }
                $allpoll_prom += $poll_sum / $poll_counter;
            }

            $total_prom   = '-';
            $extpoll_eval = '-';

            if ($counter_poll > 0) {
                $total_prom = number_format($allpoll_prom / $counter_poll, 2, '.', '');

                if (4.5 <= $total_prom && $total_prom <= 5) {
                    $extpoll_eval = 'Muy Bueno';
                }
                elseif (4 <= $total_prom && $total_prom < 4.5) {
                    $extpoll_eval = 'Bueno';
                }
                elseif (3 <= $total_prom && $total_prom < 4) {
                    $extpoll_eval = 'Regular';
                }
                elseif ($total_prom < 3) {
                    $extpoll_eval = 'Mal';
                }

                $ubph_total += $total_prom;
                $count_work++;
            }
            
            $works_eval[] = array(
                                "project" => $work->name,
                                "total_prom" => number_format(floatval($total_prom), 2, '.', ''),
                                "evaluation" => $extpoll_eval,
                            );
        }

        $ubph_prom = '-';
        if ($count_work > 0) {
            $ubph_prom = $ubph_total / $count_work;
            if (4.5 <= $ubph_prom && $ubph_prom <= 5) {
                $ubph_eval = 'Muy Bueno';
            }
            elseif (4 <= $ubph_prom && $ubph_prom < 4.5) {
                $ubph_eval = 'Bueno';
            }
            elseif (3 <= $ubph_prom && $ubph_prom < 4) {
                $ubph_eval = 'Regular';
            }
            elseif ($ubph_prom < 3) {
                $ubph_eval = 'Mal';
            }
            $ubph_prom = number_format($ubph_prom, 2, '.', '');
        }
        
        $pdf = PDF::loadView('pdf.ExtpollCertification', compact('month', 'year',  'company', 'works_eval', 'ubph_prom', 'ubph_eval'));
        return $pdf->download('Certificación de Calidad UBPH '.$request->month.'-'.$request->year.'.pdf');
    }

    /**
     * Export to PDF Poll Model.
     *
     * @return \Illuminate\Http\Response
     */
    public function ExpModel(Request $request)
    {
        $month   = $request->month;
        $year    = $request->year;
        $company = Company::first();
        $work    = Work::where('id', $request->work)->first();
         
        $extpolls = array();
        $extpolls_issues = array();
        if (Cache::get('extpolls') != null) {
            $extpolls = Cache::get('extpolls');
        }
        
        $pdf = PDF::loadView('pdf.ExtpollModel', compact('month', 'year',  'company', 'work', 'extpolls'));
        return $pdf->download('Encuesta de Satisfacción Cliente Externo.pdf');
    }

    /**
     * Import Activities from MS Excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function ImportActivities(Request $request) {
        
        $excel_doc = $request->excel_doc;
        $work = $request->work;
        $month = $request->month;
        $year = $request->year;
        
        try {
            Excel::import(new ActivityImport($work, $month, $year), $excel_doc);
        } catch (Throwable $th) {
            $response = array('success' => true, 'error' => $th->getMessage());
            return response()->json($response, 200);
        }

        $response = array('success' => true);
        return response()->json($response, 200);
    }

    /**
     * Delete All Activities.
     *
     * @return \Illuminate\Http\Response
     */
    public function AllDeleteActivities(Request $request) {
        
        $work = $request->work;
        $month = $request->month;
        $year = $request->year;
        
        try {
            
            $extpolls = Extpoll::where('id_work', intval($work))
                                ->where('month', intval($month))
                                ->where('year', intval($year))
                                ->get();
                                
            foreach ($extpolls as $extpoll) {
                $id_activity = $extpoll->id_activity;
                Extpoll::find($extpoll->id)->delete();
                ExtpollActivity::find($id_activity)->delete();
            }

        } catch (Throwable $th) {
            $response = array('success' => true, 'error' => $th->getMessage());
            return response()->json($response, 200);
        }

        $response = array('success' => true);
        return response()->json($response, 200);
    }
}
