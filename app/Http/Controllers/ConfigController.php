<?php

namespace App\Http\Controllers;

use App\User;
use App\Notify;
use App\NotifyType;
use App\Department;
use App\Speciality;
use App\Work;
use App\Metrotype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ConfigController extends Controller
{
    /**
     * Get Departments.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getDepartments()
    {
        $departments = Department::all();
        $response = array('success' => true, 'departments' => $departments);
        return response()->json($response,200);
    }

    /**
     * Get Specialities.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getSpecialities($department)
    {
        $specialities = Speciality::where('id_department', $department)->get();
        $response = array('success' => true, 'specialities' => $specialities);
        return response()->json($response,200);
    }
    
    /**
     * Get Works.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getWorks($appmodule)
    {
        $works = array();

        switch ($appmodule) {
            case 'metro':
                $field = 'metrology';
                break;
            case 'plan':
                $field = 'planning';
                break;
            case 'intcustomer':
                $field = 'intcustomerpoll';
                break;
            case 'extcustomer':
                $field = 'extcustomerpoll';
                break;
            default:
                $field = 'all';
                break;
        }

        if ($field == 'all') {
            $works = Work::where('active', 1)->orderBy('name', 'ASC')->get();
        }
        elseif ($field == 'metrology') {
            $works = Work::where($field, 1)->where('active', 1)->orderBy('name', 'ASC')->get();
            $works[] = array(
                'id' => -1,
                'name' => 'Todos los Proyectos',
                'abbr' => 'all'
            );
        }
        else {
            $works = Work::where($field, 1)->where('active', 1)->orderBy('name', 'ASC')->get();
        }
        
        $works[] = array(
            'id' => 0,
            'name' => '',
            'abbr' => ''
        );

        $response = array('success' => true, 'works' => $works);
        return response()->json($response,200);
    }

    /**
     * Get Works Abbr.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getWorksAbbr()
    {
        $works = array();
        $works = Work::where('active', 1)->orderBy('name', 'ASC')->get();

        $response = array('success' => true, 'works' => $works);
        return response()->json($response,200);
    }

    /**
     * Update Works Module State.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateStateModuleWork(Request $request)
    {
        switch ($request->appmodule) {
            case 'metro':
                $field = 'metrology';
                break;
            case 'plan':
                $field = 'planning';
                break;
            case 'intcustomer':
                $field = 'intcustomerpoll';
                break;
            case 'extcustomer':
                $field = 'extcustomerpoll';
                break;
        }

        $works = Work::find($request->id)->update([
            $field => $request->newstate
        ]);

        $response = array('success' => true, 'works' => $works);
        return response()->json($response,200);
    }

    /**
     * Update a Work.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updWork(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        if ($request->id == 0) {
            // Add Work
            $work = Work::create([
                'name' => $request->name,
                'abbr' => $request->abbr
            ]);
        }
        else {
            // Update Work
            $work = Work::where('id', $request->id)->update([
                'name' => $request->name,
                'abbr' => $request->abbr
            ]);
        }

        $response = array('success' => true, 'work' => $work);        
        return response()->json($response,200);
    }
    
    /**
     * Delete a Work.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delWorks(Request $request)
    {
        // Delete Work
        Work::where('id', $request->id)->delete();

        $response = array('success' => true);        
        return response()->json($response,200);
    }

    /**
     * Update a Metrology Type.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updMetrotype(Request $request)
    {
        $metrotype = Metrotype::where('id', $request->id)->update([
                        'code' => $request->code
                     ]);

        $response = array('success' => true, 'metrotype' => $metrotype);        
        return response()->json($response,200);
    }

    /**
     * Create User.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUser(Request $request)
    {
        $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password'=> Hash::make($request->password),
                    'rol' => $request->rol,  // admin, specialist, public
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

        $response = array('success' => true, 'user' => $user);        
        return response()->json($response,200);
    }

    /**
     * Profile User.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profileUser(Request $request)
    {
        $metrology       = 0;
        $normalization   = 0;
        $satisfaction_ci = 0;
        $satisfaction_ce = 0;

        $types = NotifyType::all();
        foreach ($types as $type) {
            if (Notify::where('id_user', $request->id_user)->where('id_type', $type->id)->exists()) {
                if ($type->name == 'Plan de Calibración') {
                    $metrology = 1;
                }
                elseif ($type->name == 'Plan de Normalización') {
                    $normalization = 1;
                }
                elseif ($type->name == 'Satisfacción de Clientes Internos') {
                    $satisfaction_ci = 1;
                }
                elseif ($type->name == 'Satisfacción de Clientes Externos') {
                    $satisfaction_ce = 1;
                }
            }
        }

        $response = array(
            'success' => true,
            'data' => array(
                "metrology" => $metrology,
                "normalization" => $normalization,
                "satisfaction_ci" => $satisfaction_ci,
                "satisfaction_ce" => $satisfaction_ce
            )
        );
        return response()->json($response,200);
    }

    /**
     * Notify User.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function notifyUser(Request $request)
    {
        $id_type = NotifyType::where('name', $request->notify)->first()->id;

        if ($request->state == 'true') {
            Notify::create([
                'id_type' => $id_type,
                'id_user' => $request->id_user
            ]);
        }
        else {
            Notify::where('id_type', $id_type)->where('id_user', $request->id_user)->delete();
        }

        $response = array('success' => true);       
        return response()->json($response,200);
    }
}