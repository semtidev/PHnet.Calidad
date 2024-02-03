<?php

namespace App\Http\Controllers;

use App\Company;
use App\Work;
use App\Metrology;
use App\Metrotype;
use App\MetroState;
use App\MetroHistory;
use App\MetroPlanHistory;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class MetrologyController extends Controller
{
    /**
     * Get Metrology.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getMetrology($type, $work, $state, $show_inactive = 0)
    {
        $metrology = array();
        $id_state  = '';
        
        switch ($type) {
            case 'pressuretab':
                $type_name = 'Presión';
                break;
            case 'electab':
                $type_name = 'Magnitudes Eléctricas';
                break;
            case 'topgeotab':
                $type_name = 'Topografía y Geodesia';
                break;
            case 'lengthtab':
                $type_name = 'Longitud';
                break;   
            default:
                $type_name = 'Masa';
                break;
        }
        
        switch ($state) {
            case 'send':
                $id_state = MetroState::where('state', 'Entregado para calibrar')->first()->id;
                break;
            case 'available':
                $id_state = MetroState::where('state', 'Disponible/Apto')->first()->id;
                break;
            case 'no-available':
                $id_state = MetroState::where('state', 'No Disponible/No Apto')->first()->id;
                break;
        }
        
        $id_type = Metrotype::where('name', $type_name)->first()->id;
        
        if ($state == 'all') {
            
            if ($work == -1) {
                $metrology = Metrology::leftJoin('metrology_types', 'metrology_types.id', '=', 'metrology.id_type')
                ->select('metrology.id', 'metrology.id_work', 'metrology.id_state', 'metrology.photo', 'metrology_types.name AS type', 'metrology.name', 'metrology.ctdad', 'metrology.demand', 'metrology.model', 'metrology.serie', 'metrology.precision', 'metrology.limit', 'metrology.last_check', 'metrology.term_check', 'metrology.plan_date', 'metrology.real_date', 'metrology.result_check', 'metrology.reparation', 'metrology.next_plan', 'metrology.location', 'metrology.owner', 'metrology.comment', 'metrology.created_at', 'metrology.updated_at', 'metrology.active')
                ->where('metrology.id_type', $id_type)
                ->get();
            }
            else {
                $metrology = Metrology::leftJoin('metrology_types', 'metrology_types.id', '=', 'metrology.id_type')
                ->select('metrology.id', 'metrology.id_work', 'metrology.id_state', 'metrology.photo', 'metrology_types.name AS type', 'metrology.name', 'metrology.ctdad', 'metrology.demand', 'metrology.model', 'metrology.serie', 'metrology.precision', 'metrology.limit', 'metrology.last_check', 'metrology.term_check', 'metrology.plan_date', 'metrology.real_date', 'metrology.result_check', 'metrology.reparation', 'metrology.next_plan', 'metrology.location', 'metrology.owner', 'metrology.comment', 'metrology.created_at', 'metrology.updated_at', 'metrology.active')
                ->where('metrology.id_work', $work)
                ->where('metrology.id_type', $id_type)
                ->get();
            }
            
        }
        else {
            
            if ($work == -1) {
                $metrology = Metrology::leftJoin('metrology_types', 'metrology_types.id', '=', 'metrology.id_type')
                ->select('metrology.id', 'metrology.id_work', 'metrology.id_state', 'metrology.photo', 'metrology_types.name AS type', 'metrology.name', 'metrology.ctdad', 'metrology.demand', 'metrology.model', 'metrology.serie', 'metrology.precision', 'metrology.limit', 'metrology.last_check', 'metrology.term_check', 'metrology.plan_date', 'metrology.real_date', 'metrology.result_check', 'metrology.reparation', 'metrology.next_plan', 'metrology.location', 'metrology.owner', 'metrology.comment', 'metrology.created_at', 'metrology.updated_at', 'metrology.active')
                ->where([
                    ['metrology.id_type', $id_type], 
                    ['metrology.id_state', $id_state]
                ])
                ->get();
            }
            else {
                $metrology = Metrology::leftJoin('metrology_types', 'metrology_types.id', '=', 'metrology.id_type')
                ->select('metrology.id', 'metrology.id_work', 'metrology.id_state', 'metrology.photo', 'metrology_types.name AS type', 'metrology.name', 'metrology.ctdad', 'metrology.demand', 'metrology.model', 'metrology.serie', 'metrology.precision', 'metrology.limit', 'metrology.last_check', 'metrology.term_check', 'metrology.plan_date', 'metrology.real_date', 'metrology.result_check', 'metrology.reparation', 'metrology.next_plan', 'metrology.location', 'metrology.owner', 'metrology.comment', 'metrology.created_at', 'metrology.updated_at', 'metrology.active')
                ->where([
                    ['metrology.id_work', $work], 
                    ['metrology.id_type', $id_type], 
                    ['metrology.id_state', $id_state]
                ])
                ->get();
            }
        }
        
        $number = 0;
        $keys_inactives = array();
        foreach ($metrology as $key => $row){
            if ($show_inactive == 0 && $row['active'] == 0) {
                $keys_inactives[] = $key;
            }
            else {
                $number++;
            }
            $row['number'] = $number;

            $workname = Work::find($row['id_work'])->abbr;
            $row['workname'] = $workname;

            $history = MetroHistory::where('id_tool', $row->id)->where('action', 'moved')->get();
            if (count($history) > 1) {
                $row['history'] = '<sup class="badge badge-danger">' . (count($history) - 1) . '</sup>';
            }
            else {
                $row['history'] = '';
            }
        }
        
        // Delete Inactives Items
        foreach ($keys_inactives as $key => $value) {
            unset($metrology[$value]);
        }

        $list_metrology = array();
        foreach ($metrology as $row){
            $list_metrology[] = $row;
        }

        //return $list_metrology;
        $response = array('success' => true, 'metrology' => $list_metrology);
        return response()->json($response,200);
    }

    /**
     * Get Metrology Types.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getMetrotypes()
    {
        $metrotypes = array();
        $metrotypes = Metrotype::all();
        $response = array('success' => true, 'metrotypes' => $metrotypes);
        return response()->json($response,200);
    }

    /**
     * Store a Tool Metrology.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addEquipment(Request $request)
    {
        $work = Work::where('abbr', $request->work)->first()->id;

        switch ($request->activetab) {
            case 'pressuretab':
                $id_type = Metrotype::where('name', 'Presión')->first()->id;
                break;
            case 'electab':
                $id_type = Metrotype::where('name', 'Magnitudes Eléctricas')->first()->id;
                break;
            case 'topgeotab':
                $id_type = Metrotype::where('name', 'Topografía y Geodesia')->first()->id;
                break;
            case 'lengthtab':
                $id_type = Metrotype::where('name', 'Longitud')->first()->id;
                break;    
            default:
                $id_type = Metrotype::where('name', 'Masa')->first()->id;
                break;
        }
        
        $tool = Metrology::create([
            'id_work' => $work,
            'id_type' => $id_type,
            'name' => $request->name,
            'ctdad' => $request->ctdad,
            'model' => $request->model,
            'serie' => $request->serie,
            'precision' => $request->precision,
            'limit' => $request->limit,
            'last_check' => $request->last_check,
            'term_check' => $request->term_check,
            'plan_date' => $request->plan_date,
            'real_date' => $request->real_date,
            'result_check' => $request->result_check,
            'reparation' => $request->reparation,
            'next_plan' => $request->next_plan,
            'location' => $request->location,
            'owner' => $request->owner,
            'comment' => $request->comment
        ]);

        $history = MetroHistory::create([
            'id_tool' => $tool->id,
            'action' => 'created',
            'action_date' => date('Y-m-d'),
            'project' => $work,
            'owner' => $request->owner
        ]);

        $response = array('success' => true, 'id' => $tool['id']);    
        return response()->json($response,201);
    }

    /**
     * Update a Tool Metrology.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updEquipment(Request $request)
    {
        $work = Work::where('abbr', $request->work)->first()->id;

        if ($request->field == 'type') {
            $field = 'id_type';
            $newvalue = Metrotype::where('name', $request->newvalue)->first()->id;
        }
        elseif ($request->field == 'workname') {
            $field = 'id_work';
            $newvalue = $work;
        }
        else {
            $field = $request->field;
            $newvalue = $request->newvalue;
        }

        if ($field == 'owner') {
            $tool = Metrology::where('id', $request->id)->update([
                $field => $newvalue
            ]);
            $history = MetroHistory::create([
                            'id_tool' => $request->id,
                            'action' => 'updated',
                            'action_date' => date('Y-m-d'),
                            'project' => $work,
                            'owner' => $newvalue
                        ]);
        }
        elseif ($field == 'real_date') {
            if ($newvalue != ''){
                $newvalue = explode('T', $request->newvalue);
                $newvalue = $newvalue[0];
                $arr_date = explode('-', $newvalue);
            }
            else {
                $newvalue = null;
            } 
 
            $tool = Metrology::where('id', $request->id)->update([
                $field => $newvalue
            ]);
            
            if (MetroHistory::where('id_tool', $request->id)->where('project', $work)->where('action', 'calibrate')->whereYear('action_date', $arr_date[0])->exists()) {
                $history = MetroHistory::where('id_tool', $request->id)
                            ->where('project', $request->work)
                            ->where('action', 'calibrate')
                            ->update([
                                'action_date' => $newvalue
                            ]);   
            }
            else {
                $owner = MetroHistory::where('id_tool', $request->id)->where('project', $work)->orderBy('action_date', 'DESC')->first()->owner;
                $history = MetroHistory::create([
                                'id_tool' => $request->id,
                                'action' => 'calibrate',
                                'action_date' => $newvalue,
                                'project' => $work,
                                'owner' => $owner
                            ]);
            }         
        }
        else {
            $tool = Metrology::where('id', $request->id)->update([
                $field => $newvalue
            ]);

            $owner = Metrology::where('id', $request->id)->first()->owner;

            $history = MetroHistory::create([
                'id_tool' => $request->id,
                'action' => 'updated',
                'action_date' => date('Y-m-d'),
                'project' => $work,
                'owner' => $owner
            ]);
        }

        $response = array('success' => true);   
        return response()->json($response,201);
    }

    /**
     * Remove the specified Tool Metrology.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function delEquipment(Request $request)
    {
        Metrology::where('id', $request->id)->delete();
        MetroHistory::where('id_tool', $request->id)->delete();

        $response = array('success' => true);        
        return response()->json($response,200);
    }

    /**
     * Set Metrology Activate.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function Activate(Request $request)
    {
        Metrology::where('id', $request->id)->update([
            'active' => $request->newactive
        ]);

        $response = array('success' => true);      
        return response()->json($response,200);
    }
    
    /**
     * Set Metrology State.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function optState(Request $request)
    {
        $id_state = MetroState::where('state', $request->state)->first()->id;
        Metrology::where('id', $request->id)->update([
            'id_state' => $id_state
        ]);

        $response = array('success' => true);        
        return response()->json($response,200);
    }

    /**
     * Set Metrology Photo.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function setPhoto(Request $request)
    {
        Metrology::where('id', $request->id)->update([
            'photo' => $request->photo
        ]);

        $response = array('success' => true);        
        return response()->json($response,200);
    }

    /**
     * Delete Metrology Photo.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function delPhoto(Request $request)
    {
        Metrology::where('id', $request->id)->update([
            'photo' => null
        ]);

        $response = array('success' => true);        
        return response()->json($response,200);
    }

    /**
     * Move to Project.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function metroMove(Request $request)
    {
        Metrology::where('id', $request->id)->update([
            'id_work' => $request->newproject
        ]);

        $history = MetroHistory::create([
            'id_tool' => $request->id,
            'action' => 'moved',
            'action_date' => now(),
            'project' => $request->newproject,
            'owner' => $request->newowner
        ]);

        $response = array('success' => true);        
        return response()->json($response,200);
    }

    /**
     * Search tool in Projects.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function metroSearch(Request $request)
    {
        $metrology = array();
        $metrology = Metrology::leftJoin('metrology_types', 'metrology_types.id', '=', 'metrology.id_type')
                                ->select('metrology.id', 'metrology.id_work', 'metrology_types.name AS type')->where('serie', $request->serie)->first();

        if ($metrology == null) {
            $response = array(
                'success' => false,
                'message' => 'Numero de serie No encontrado.'
            );
        }
        else {
            $response = array(
                'success' => true, 
                'id_work' => $metrology->id_work, 
                'id_tool' => $metrology->id,
                'type'    => $metrology->type
            );
        }
        
        return response()->json($response,200);
    }

    /**
     * Get Tool History.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getMetrohistory($tool)
    {
        $history = MetroHistory::leftJoin('works', 'works.id', '=', 'metrology_history.project')
                        ->select('metrology_history.id', 'metrology_history.action', 'metrology_history.action_date', 'works.name AS project', 'metrology_history.owner')
                        ->where('metrology_history.id_tool', $tool)
                        ->orderBy('action_date', 'ASC')
                        ->get();
        
        foreach ($history as $row) {
            if ($row->action == 'created') {
                $row['action'] = 'Alta';
            }
            elseif ($row->action == 'moved') {
                $row['action'] = 'Movido';
            }
            elseif ($row->action == 'calibrate') {
                $row['action'] = 'Calibrado';
            }
            elseif ($row->action == 'sync-plan') {
                $row['action'] = 'Sincronizado';
            }
        }

        /* Insert history metrology 
        $metro = Metrology::all();
        foreach ($metro as $tool) {
            MetroHistory::create([
                'id_tool' => $tool->id,
                'action' => 'created',
                'action_date' => $tool->created_at,
                'project' => $tool->id_work,
                'owner' => $tool->owner
            ]);
        }*/

        $response = array('success' => true, 'metrohistory' => $history);
        return response()->json($response,200);
    }

    /**
     * Sync Planning.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function syncMetroPlanning($user)
    {
        $metrology = Metrology::select('id', 'id_work', 'term_check', 'plan_date', 'real_date', 'next_plan', 'owner')->get();
        
        foreach ($metrology as $row) {
           
            if ($row->plan_date != '' && $row->plan_date != null) {
               
                $dateplan  = explode('-', $row->plan_date);
                $termcheck = explode(' ', $row->term_check);
                $term_calc = intval($termcheck[0]);

                if ($dateplan[0] < date('Y')) {
                    
                    if ($row->real_date != '' && $row->real_date != null) {
                        
                        $real_date = $row->real_date;
                        $new_plan  = date('Y-m-d', strtotime("+".$term_calc." year", strtotime($real_date)));
                        $next_plan = date('Y-m-d', strtotime("+".$term_calc." year", strtotime($new_plan)));
                    }
                    else {
                        $new_plan  = date('Y-m-d', strtotime("+".$term_calc." year", strtotime($row->plan_date)));
                        $next_plan = date('Y-m-d', strtotime("+".$term_calc." year", strtotime($new_plan)));
                    }

                    if (MetroPlanHistory::where('id_tool', $row->id)->whereYear('plan_date', $dateplan[0])->exists()) {

                        MetroPlanHistory::where('id_tool', $row->id)
                                        ->whereYear('plan_date', $dateplan[0])
                                        ->update([
                                            'id_tool' => $row->id,
                                            'plan_date' => $row->plan_date,
                                            'real_date' => $row->real_date,
                                            'id_user' => $user,
                                            'updated_at' => now()
                                        ]);
                    }
                    else {

                        MetroPlanHistory::create([
                                            'id_tool' => $row->id,
                                            'plan_date' => $row->plan_date,
                                            'real_date' => $row->real_date,
                                            'id_user' => $user,
                                            'created_at' => now(),
                                            'updated_at' => now()
                                        ]);
                    }
                    
                    MetroHistory::create([
                        'id_tool' => $row->id,
                        'action' => 'sync-plan',
                        'action_date' => date('Y-m-d'),
                        'project' => $row->id_work,
                        'owner' => $row->owner
                    ]);

                    Metrology::where('id', $row->id)->update([
                        'plan_date' => $new_plan,
                        'real_date' => null,
                        'next_plan' => $next_plan
                    ]);
                }
            }
        }

        $response = array('success' => true);
        return response()->json($response,200);
    }

    /**
     * Get Calibration Planning for Project.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPlanningProject($work, $year)
    {
        $months = array('ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic');
        $metrology = Metrology::select('id', 'id_work', 'photo', 'name' , 'serie', 'plan_date', 'real_date')
                            ->where('id_work', $work)
                            ->where('active', 1)
                            ->whereYear('plan_date', $year)
                            ->orderBY('plan_date', 'ASC')
                            ->get();
        
        foreach ($metrology as $tool) {
            
            $plan_date = explode('-', $tool->plan_date);
            if ($tool->real_date != null && $tool->real_date != ''){
                $real_date = explode('-', $tool->real_date);
                $real_month = $real_date[1];
            }
            else {
                $real_month = 0;
            }
            // History
            $history = MetroHistory::where('id_tool', $tool->id)->where('action', 'moved')->get();
            if (count($history) > 1) {
               $tool['history'] = '<sup class="badge badge-danger">' . (count($history) - 1) . '</sup>'; 
            }
            else {
                $tool['history'] = '';
            } 
            // Planning
            $plandate = false;
            $realdate = false;
            for ($i=0; $i < 12; $i++) {
                $tool[$months[$i]] = 0;
                // Plan & Real date
                if (intval($plan_date[1]) == $i + 1 && intval($real_month) == $i + 1) {
                    $tool[$months[$i]] = 1;
                    $plandate = true;
                    $realdate = true;
                }
                elseif (intval($plan_date[1]) == $i + 1 && intval($real_month) != $i + 1) {
                    $tool[$months[$i]] = 2;
                    $plandate = true;
                }
                elseif (intval($plan_date[1]) != $i + 1 && intval($real_month) == $i + 1) {
                    $tool[$months[$i]] = 3;
                    $realdate = true;
                }
                else{
                    // Backlog
                    if ($plandate == true && $realdate == false && date('n') >= $i + 1) {
                        $tool[$months[$i]] = 4;
                    }                
                }
            }
        }

        Cache::forever('metroplanningproject', $metrology);

        $response = array('success' => true, 'metroplanning' => $metrology);
        return response()->json($response,200);
    }

    /**
     * Get Calibration Planning for UBPH.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPlanningUbph($year)
    {
        $months = array('ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic');
        $metrology = Metrology::leftJoin('works', 'works.id', '=', 'metrology.id_work')
                            ->select('metrology.id', 'metrology.id_work', 'metrology.photo', 'metrology.name' , 'metrology.serie', 'works.abbr AS project', 'metrology.plan_date', 'metrology.real_date')
                            ->where('works.planning', 1)
                            ->where('metrology.active', 1)
                            ->whereYear('metrology.plan_date', $year)
                            ->orderBY('plan_date', 'ASC')
                            ->get();
        
        foreach ($metrology as $tool) {
            
            $plan_date = explode('-', $tool->plan_date);
            if ($tool->real_date != null && $tool->real_date != ''){
                $real_date = explode('-', $tool->real_date);
                $real_month = $real_date[1];
            }
            else {
                $real_month = 0;
            }
            // History
            $history = MetroHistory::where('id_tool', $tool->id)->where('action', 'moved')->get();
            if (count($history) > 1) {
               $tool['history'] = '<sup class="badge badge-danger">' . (count($history) - 1) . '</sup>'; 
            }
            else {
                $tool['history'] = '';
            } 
            // Planning
            $plandate = false;
            $realdate = false;
            for ($i=0; $i < 12; $i++) {
                $tool[$months[$i]] = 0;
                // Plan & Real date
                if (intval($plan_date[1]) == $i + 1 && intval($real_month) == $i + 1) {
                    $tool[$months[$i]] = 1;
                    $plandate = true;
                    $realdate = true;
                }
                elseif (intval($plan_date[1]) == $i + 1 && intval($real_month) != $i + 1) {
                    $tool[$months[$i]] = 2;
                    $plandate = true;
                }
                elseif (intval($plan_date[1]) != $i + 1 && intval($real_month) == $i + 1) {
                    $tool[$months[$i]] = 3;
                    $realdate = true;
                }
                else{
                    // Backlog
                    if ($plandate == true && $realdate == false && date('n') >= $i + 1) {
                        $tool[$months[$i]] = 4;
                    }          
                }
            }
        }

        Cache::forever('metroplanningubph', $metrology);

        $response = array('success' => true, 'metroplanning' => $metrology);
        return response()->json($response,200);
    }

    /**
     * Export to PDF Current Project.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportCurrent(Request $request)
    {
        $work    = Work::where('id', $request->work)->first();
        $company = Company::first();
        $state   = $request->state;
        switch ($state) {
            case 'available':
                $state = MetroState::where('state', 'Disponible/Apto')->first()->id;
                break;
            case 'no-available':
                $state = MetroState::where('state', 'No Disponible/No Apto')->first()->id;
                break;
            case 'send':
                $state = MetroState::where('state', 'Entregado para calibrar')->first()->id;
                break;
        }

        if ($state == 'all') {
            // WEIGHT
            $weight_type = Metrotype::where('name', 'Masa')->first();
            $weight_code = $weight_type->code;       
            $weight = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_work', $work->id)
                ->where('metrology.id_type', $weight_type->id)
                ->where('metrology.active', 1)
                ->orderBy('metrology.name', 'ASC')
                ->orderBy('metrology.model', 'ASC')
                ->get();
            foreach ($weight as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
            // TOPOGRAPHY & GEODESY
            $topgeo_type = Metrotype::where('name', 'Topografía y Geodesia')->first();
            $topgeo_code = $topgeo_type->code;       
            $topgeo      = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_work', $work->id)
                ->where('metrology.id_type', $topgeo_type->id)
                ->where('metrology.active', 1)
                ->orderBy('metrology.name', 'ASC')
                ->orderBy('metrology.model', 'ASC')
                ->get();
            foreach ($topgeo as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
            // ELECTRIC
            $elect_type = Metrotype::where('name', 'Magnitudes Eléctricas')->first();
            $elect_code = $elect_type->code;       
            $elect      = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_work', $work->id)
                ->where('metrology.id_type', $elect_type->id)
                ->where('metrology.active', 1)
                ->orderBy('metrology.name', 'ASC')
                ->orderBy('metrology.model', 'ASC')
                ->get();
            foreach ($elect as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
            // PRESURE
            $pressure_type = Metrotype::where('name', 'Presión')->first();
            $pressure_code = $pressure_type->code;       
            $pressure = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_work', $work->id)
                ->where('metrology.id_type', $pressure_type->id)
                ->where('metrology.active', 1)
                ->orderBy('metrology.name', 'ASC')
                ->orderBy('metrology.model', 'ASC')
                ->get();
            foreach ($pressure as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
            // LENGTH
            $length_type = Metrotype::where('name', 'Longitud')->first();
            $length_code = $length_type->code;       
            $length      = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_work', $work->id)
                ->where('metrology.id_type', $length_type->id)
                ->where('metrology.active', 1)
                ->orderBy('metrology.name', 'ASC')
                ->orderBy('metrology.model', 'ASC')
                ->get();
            foreach ($length as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
        }
        else {
            // WEIGHT
            $weight_type = Metrotype::where('name', 'Masa')->first();
            $weight_code = $weight_type->code;       
            $weight = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('id_work', $work->id)
                ->where('metrology.id_type', $weight_type->id)
                ->where('metrology.id_state', $state)
                ->where('metrology.active', 1)
                ->orderBy('metrology.name', 'ASC')
                ->orderBy('metrology.model', 'ASC')
                ->get();
            foreach ($weight as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
            // TOPOGRAPHY & GEODESY
            $topgeo_type = Metrotype::where('name', 'Topografía y Geodesia')->first();
            $topgeo_code = $topgeo_type->code;       
            $topgeo      = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_work', $work->id)
                ->where('metrology.id_type', $topgeo_type->id)
                ->where('metrology.id_state', $state)
                ->where('metrology.active', 1)
                ->orderBy('metrology.name', 'ASC')
                ->orderBy('metrology.model', 'ASC')
                ->get();
            foreach ($topgeo as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
            // ELECTRIC
            $elect_type = Metrotype::where('name', 'Magnitudes Eléctricas')->first();
            $elect_code = $elect_type->code;       
            $elect      = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_work', $work->id)
                ->where('metrology.id_type', $elect_type->id)
                ->where('metrology.id_state', $state)
                ->where('metrology.active', 1)
                ->orderBy('metrology.name', 'ASC')
                ->orderBy('metrology.model', 'ASC')
                ->get();
            foreach ($elect as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
            // PRESURE
            $pressure_type = Metrotype::where('name', 'Presión')->first();
            $pressure_code = $pressure_type->code;       
            $pressure = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_work', $work->id)
                ->where('metrology.id_type', $pressure_type->id)
                ->where('metrology.id_state', $state)
                ->where('metrology.active', 1)
                ->orderBy('metrology.name', 'ASC')
                ->orderBy('metrology.model', 'ASC')
                ->get();
            foreach ($pressure as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
            // LENGTH
            $length_type = Metrotype::where('name', 'Longitud')->first();
            $length_code = $length_type->code;       
            $length      = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_work', $work->id)
                ->where('metrology.id_type', $length_type->id)
                ->where('metrology.id_state', $state)
                ->where('metrology.active', 1)
                ->orderBy('metrology.name', 'ASC')
                ->orderBy('metrology.model', 'ASC')
                ->get();
            foreach ($length as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
        }
        
        $pdf = PDF::loadView('pdf.MetroCurrentProject', compact('company', 'work', 'weight_code', 'weight', 'topgeo_code', 'topgeo', 'pressure_code', 'pressure', 'elect_code', 'elect', 'length_code', 'length'));
        return $pdf->download('Plantilla IM '.$work->name.' '.date('d-m-Y').'.pdf');
    }

    /**
     * Export to PDF All Project.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportAll(Request $request)
    {
        $company = Company::first();
        $state   = $request->state;
        switch ($state) {
            case 'available':
                $state = MetroState::where('state', 'Disponible/Apto')->first()->id;
                break;
            case 'no-available':
                $state = MetroState::where('state', 'No Disponible/No Apto')->first()->id;
                break;
            case 'send':
                $state = MetroState::where('state', 'Entregado para calibrar')->first()->id;
                break;
        }

        if ($state == 'all') {
            // WEIGHT
            $weight_type = Metrotype::where('name', 'Masa')->first();
            $weight_code = $weight_type->code;       
            $weight = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $weight_type->id)
                ->where('metrology.active', 1)
                ->get();
            foreach ($weight as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
            // TOPOGRAPHY & GEODESY
            $topgeo_type = Metrotype::where('name', 'Topografía y Geodesia')->first();
            $topgeo_code = $topgeo_type->code;       
            $topgeo      = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $topgeo_type->id)
                ->where('metrology.active', 1)
                ->get();
            foreach ($topgeo as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
            // ELECTRIC
            $elect_type = Metrotype::where('name', 'Magnitudes Eléctricas')->first();
            $elect_code = $elect_type->code;       
            $elect      = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $elect_type->id)
                ->where('metrology.active', 1)
                ->get();
            foreach ($elect as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
            // PRESURE
            $pressure_type = Metrotype::where('name', 'Presión')->first();
            $pressure_code = $pressure_type->code;       
            $pressure = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $pressure_type->id)
                ->where('metrology.active', 1)
                ->get();
            foreach ($pressure as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
            // LENGTH
            $length_type = Metrotype::where('name', 'Longitud')->first();
            $length_code = $length_type->code;       
            $length      = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $length_type->id)
                ->where('metrology.active', 1)
                ->get();
            foreach ($length as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
        }
        else {
            // WEIGHT
            $weight_type = Metrotype::where('name', 'Masa')->first();
            $weight_code = $weight_type->code;       
            $weight = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $weight_type->id)
                ->where('metrology.id_state', $state)
                ->where('metrology.active', 1)
                ->get();
            foreach ($weight as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
            // TOPOGRAPHY & GEODESY
            $topgeo_type = Metrotype::where('name', 'Topografía y Geodesia')->first();
            $topgeo_code = $topgeo_type->code;       
            $topgeo      = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $topgeo_type->id)
                ->where('metrology.id_state', $state)
                ->where('metrology.active', 1)
                ->get();
            foreach ($topgeo as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
            // ELECTRIC
            $elect_type = Metrotype::where('name', 'Magnitudes Eléctricas')->first();
            $elect_code = $elect_type->code;       
            $elect      = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $elect_type->id)
                ->where('metrology.active', 1)
                ->where('metrology.id_state', $state)
                ->get();
            foreach ($elect as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
            // PRESURE
            $pressure_type = Metrotype::where('name', 'Presión')->first();
            $pressure_code = $pressure_type->code;       
            $pressure = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $pressure_type->id)
                ->where('metrology.active', 1)
                ->where('metrology.id_state', $state)
                ->get();
            foreach ($pressure as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
            // LENGTH
            $length_type = Metrotype::where('name', 'Longitud')->first();
            $length_code = $length_type->code;       
            $length      = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.name', 'metrology.model', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $length_type->id)
                ->where('metrology.active', 1)
                ->where('metrology.id_state', $state)
                ->get();
            foreach ($length as $row) {
                if ($row['state'] != 'Entregado para calibrar') {
                    $row['comment'] = $row['state'];
                }
                else {
                    $row['comment'] = '-';
                }
            }
        }
        
        $pdf = PDF::loadView('pdf.MetroAllProject', compact('company', 'weight_code', 'weight', 'topgeo_code', 'topgeo', 'pressure_code', 'pressure', 'elect_code', 'elect', 'length_code', 'length'));
        return $pdf->download('Plantilla IM '.$company->name.' '.date('d-m-Y').'.pdf');
    }

    /**
     * Export to PDF Book.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportBook(Request $request)
    {
        $company = Company::first();
        $work    = Work::where('id', $request->work)->first();
        $state   = $request->state;
        switch ($state) {
            case 'available':
                $state = MetroState::where('state', 'Disponible/Apto')->first()->id;
                break;
            case 'no-available':
                $state = MetroState::where('state', 'No Disponible/No Apto')->first()->id;
                break;
            case 'send':
                $state = MetroState::where('state', 'Entregado para calibrar')->first()->id;
                break;
        }

        // PROJECT
        if ($request->work > 0){
        
            // WEIGHT
            $weight_type = Metrotype::where('name', 'Masa')->first();
            $weight_code = $weight_type->code;       
            $weight = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.id_work', 'metrology.name', 'metrology.model', 'metrology.serie', 'metrology.last_check', 'metrology.term_check', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $weight_type->id)
                ->where('metrology.active', 1)
                ->where('metrology.id_work', $request->work)
                ->get();
            foreach ($weight as $row) {
                if ($row['comment'] == '' || $row['comment'] == null) {
                    $row['comment'] = $row['state'];
                }
            }
            // TOPOGRAPHY & GEODESY
            $topgeo_type = Metrotype::where('name', 'Topografía y Geodesia')->first();
            $topgeo_code = $topgeo_type->code;       
            $topgeo      = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.id_work', 'metrology.name', 'metrology.model', 'metrology.serie', 'metrology.last_check', 'metrology.term_check', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $topgeo_type->id)
                ->where('metrology.active', 1)
                ->where('metrology.id_work', $request->work)
                ->get();
            foreach ($topgeo as $row) {
                if ($row['comment'] == '' || $row['comment'] == null) {
                    $row['comment'] = $row['state'];
                }
            }
            // ELECTRIC
            $elect_type = Metrotype::where('name', 'Magnitudes Eléctricas')->first();
            $elect_code = $elect_type->code;       
            $elect      = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.id_work', 'metrology.name', 'metrology.model', 'metrology.serie', 'metrology.last_check', 'metrology.term_check', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $elect_type->id)
                ->where('metrology.active', 1)
                ->where('metrology.id_work', $request->work)
                ->get();
            foreach ($elect as $row) {
                if ($row['comment'] == '' || $row['comment'] == null) {
                    $row['comment'] = $row['state'];
                }
            }
            // PRESURE
            $pressure_type = Metrotype::where('name', 'Presión')->first();
            $pressure_code = $pressure_type->code;       
            $pressure = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.id_work', 'metrology.name', 'metrology.model', 'metrology.serie', 'metrology.last_check', 'metrology.term_check', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $pressure_type->id)
                ->where('metrology.active', 1)
                ->where('metrology.id_work', $request->work)
                ->get();
            foreach ($pressure as $row) {
                if ($row['comment'] == '' || $row['comment'] == null) {
                    $row['comment'] = $row['state'];
                }
            }
            // LENGTH
            $length_type = Metrotype::where('name', 'Longitud')->first();
            $length_code = $length_type->code;       
            $length      = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.id_work', 'metrology.name', 'metrology.model', 'metrology.serie', 'metrology.last_check', 'metrology.term_check', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $length_type->id)
                ->where('metrology.active', 1)
                ->where('metrology.id_work', $request->work)
                ->get();
            foreach ($length as $row) {
                if ($row['comment'] == '' || $row['comment'] == null) {
                    $row['comment'] = $row['state'];
                }
            }
        }

        // ALL PROJECTS
        else {

            // WEIGHT
            $weight_type = Metrotype::where('name', 'Masa')->first();
            $weight_code = $weight_type->code;       
            $weight = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.id_work', 'metrology.name', 'metrology.model', 'metrology.serie', 'metrology.last_check', 'metrology.term_check', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $weight_type->id)
                ->where('metrology.active', 1)
                ->get();
            foreach ($weight as $row) {
                if ($row['comment'] == '' || $row['comment'] == null) {
                    $row['comment'] = $row['state'];
                }
            }
            // TOPOGRAPHY & GEODESY
            $topgeo_type = Metrotype::where('name', 'Topografía y Geodesia')->first();
            $topgeo_code = $topgeo_type->code;       
            $topgeo      = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.id_work', 'metrology.name', 'metrology.model', 'metrology.serie', 'metrology.last_check', 'metrology.term_check', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $topgeo_type->id)
                ->where('metrology.active', 1)
                ->get();
            foreach ($topgeo as $row) {
                if ($row['comment'] == '' || $row['comment'] == null) {
                    $row['comment'] = $row['state'];
                }
            }
            // ELECTRIC
            $elect_type = Metrotype::where('name', 'Magnitudes Eléctricas')->first();
            $elect_code = $elect_type->code;       
            $elect      = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.id_work', 'metrology.name', 'metrology.model', 'metrology.serie', 'metrology.last_check', 'metrology.term_check', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $elect_type->id)
                ->where('metrology.active', 1)
                ->get();
            foreach ($elect as $row) {
                if ($row['comment'] == '' || $row['comment'] == null) {
                    $row['comment'] = $row['state'];
                }
            }
            // PRESURE
            $pressure_type = Metrotype::where('name', 'Presión')->first();
            $pressure_code = $pressure_type->code;       
            $pressure = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.id_work', 'metrology.name', 'metrology.model', 'metrology.serie', 'metrology.last_check', 'metrology.term_check', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $pressure_type->id)
                ->where('metrology.active', 1)
                ->get();
            foreach ($pressure as $row) {
                if ($row['comment'] == '' || $row['comment'] == null) {
                    $row['comment'] = $row['state'];
                }
            }
            // LENGTH
            $length_type = Metrotype::where('name', 'Longitud')->first();
            $length_code = $length_type->code;       
            $length      = Metrology::leftJoin('metrology_states', 'metrology_states.id', '=', 'metrology.id_state')
                ->select('metrology.id_work', 'metrology.name', 'metrology.model', 'metrology.serie', 'metrology.last_check', 'metrology.term_check', 'metrology.precision', 'metrology.limit', 'metrology.demand', 'metrology.ctdad', 'metrology.comment', 'metrology_states.state')
                ->where('metrology.id_type', $length_type->id)
                ->where('metrology.active', 1)
                ->get();
            foreach ($length as $row) {
                if ($row['comment'] == '' || $row['comment'] == null) {
                    $row['comment'] = $row['state'];
                }
            }
        }
        
        $pdf = PDF::loadView('pdf.MetroBook', compact('company', 'work', 'weight_code', 'weight', 'topgeo_code', 'topgeo', 'pressure_code', 'pressure', 'elect_code', 'elect', 'length_code', 'length'))->setPaper('letter', 'landscape');
        return $pdf->download('Libro de Instrumentos UBPH '.date('d-m-Y').'.pdf');
    }

    /**
     * Export to PDF Planning Project.
     *
     * @return \Illuminate\Http\Response
     */
    public function ExpPlanningProject(Request $request)
    {
        $year    = $request->year;
        $work    = Work::where('id', $request->project)->first();
        $company = Company::first();
        
        $planningproject = array();
        if (Cache::get('metroplanningproject') != null) {
            $planningproject = Cache::get('metroplanningproject');
        }
        
        $pdf = PDF::loadView('pdf.MetroplanningProject', compact('year', 'company', 'work', 'planningproject'))->setPaper('letter', 'landscape');
        return $pdf->download('Plan de Calibración '.$work->name.' '.$request->year.'.pdf');
    }

    /**
     * Export to PDF Planning UBPH.
     *
     * @return \Illuminate\Http\Response
     */
    public function ExpPlanningUbph(Request $request)
    {
        $year    = $request->year;
        $company = Company::first();
        
        $planningubph = array();
        if (Cache::get('metroplanningubph') != null) {
            $planningubph = Cache::get('metroplanningubph');
        }
        //return $planningubph;
        $pdf = PDF::loadView('pdf.MetroplanningUbph', compact('year', 'company', 'planningubph'))->setPaper('letter', 'landscape');
        return $pdf->download('Plan de Calibración UBPH '.$request->year.'.pdf');
    }
}