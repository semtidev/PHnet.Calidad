<?php

namespace App\Http\Controllers;

use App\Work;
use App\Company;
use App\PollFeed;
use App\PollFeedQuest;
use App\PollHost;
use App\PollHostQuest;
use App\PollEquip;
use App\PollEquipQuest;
use App\PollBrigades;
use App\PollBrigadesQuest;
use App\PollPersonaltransp;
use App\PollPersonaltranspQuest;
use App\PollFreightransp;
use App\PollFreightranspQuest;
use App\PollComment;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class PollController extends Controller
{
    /**
     * Get Feed Polls.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPollFeed($work, $month, $year) {
        $satisfaction = array();
        $allpoll_prom = array('q1'=>0, 'q2'=>0, 'q3'=>0, 'q4'=>0, 'q5'=>0, 'sum'=>0, 'prom'=>0);
        
        $satisfaction = PollFeed::where('id_work', $work)
                                ->where('month', intval($month))
                                ->where('year', $year)
                                ->orderBy('number', 'ASC')
                                ->get();
        
        if (count($satisfaction) > 0) {

            foreach ($satisfaction as $row) {
                $row['sum'] = $row['q1'] + $row['q2'] + $row['q3'] + $row['q4'] + $row['q5'];
                $row['prom'] = number_format($row['sum'] / 5, 2, '.', ' ');
                $allpoll_prom['q1'] += $row['q1'];
                $allpoll_prom['q2'] += $row['q2'];
                $allpoll_prom['q3'] += $row['q3'];
                $allpoll_prom['q4'] += $row['q4'];
                $allpoll_prom['q5'] += $row['q5'];
                $allpoll_prom['sum'] += $row['sum'];
                $allpoll_prom['prom'] += $row['prom'];
            }
            
            $satisfaction[] = array(
                'id' => 0,
                'number' => null,
                'q1' => number_format($allpoll_prom['q1'] / count($satisfaction), 2, '.', ''),
                'q2' => number_format($allpoll_prom['q2'] / count($satisfaction), 2, '.', ''),
                'q3' => number_format($allpoll_prom['q3'] / count($satisfaction), 2, '.', ''),
                'q4' => number_format($allpoll_prom['q4'] / count($satisfaction), 2, '.', ''),
                'q5' => number_format($allpoll_prom['q5'] / count($satisfaction), 2, '.', ''),
                'sum' => number_format($allpoll_prom['sum'] / count($satisfaction), 2, '.', ''),
                'prom' => number_format($allpoll_prom['prom'] / count($satisfaction), 2, '.', ''),
            );

            Cache::forever('pollfeed', $satisfaction);
        }
        else {

            Cache::forget('pollfeed');
        }

        $response = array('success' => true, 'satisfaction' => $satisfaction);
        return response()->json($response,200);
    }

    /**
     * Get Host Polls.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPollHost($work, $month, $year) {
        
        $satisfaction = array();
        $allpoll_prom = array('q1'=>0, 'q2'=>0, 'q3'=>0, 'q4'=>0, 'q5'=>0, 'sum'=>0, 'prom'=>0);
        
        $satisfaction = PollHost::where('id_work', $work)
                                ->where('month', intval($month))
                                ->where('year', $year)
                                ->orderBy('number', 'ASC')
                                ->get();
        
        if (count($satisfaction) > 0) {

            foreach ($satisfaction as $row) {
                $row['sum'] = $row['q1'] + $row['q2'] + $row['q3'] + $row['q4'] + $row['q5'];
                $row['prom'] = number_format($row['sum'] / 5, 2, '.', ' ');
                $allpoll_prom['q1'] += $row['q1'];
                $allpoll_prom['q2'] += $row['q2'];
                $allpoll_prom['q3'] += $row['q3'];
                $allpoll_prom['q4'] += $row['q4'];
                $allpoll_prom['q5'] += $row['q5'];
                $allpoll_prom['sum'] += $row['sum'];
                $allpoll_prom['prom'] += $row['prom'];
            }
            
            $satisfaction[] = array(
                'id' => 0,
                'number' => null,
                'q1' => number_format($allpoll_prom['q1'] / count($satisfaction), 2, '.', ''),
                'q2' => number_format($allpoll_prom['q2'] / count($satisfaction), 2, '.', ''),
                'q3' => number_format($allpoll_prom['q3'] / count($satisfaction), 2, '.', ''),
                'q4' => number_format($allpoll_prom['q4'] / count($satisfaction), 2, '.', ''),
                'q5' => number_format($allpoll_prom['q5'] / count($satisfaction), 2, '.', ''),
                'sum' => number_format($allpoll_prom['sum'] / count($satisfaction), 2, '.', ''),
                'prom' => number_format($allpoll_prom['prom'] / count($satisfaction), 2, '.', ''),
            );

            Cache::forever('pollhost', $satisfaction);
        }
        else {

            Cache::forget('pollhost');
        }

        $response = array('success' => true, 'satisfaction' => $satisfaction);
        return response()->json($response,200);
    }

    /**
     * Get Equipment Polls.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPollEquip($work, $month, $year) {
        
        $satisfaction = array();
        $allpoll_prom = array('q1'=>0, 'q2'=>0, 'q3'=>0, 'q4'=>0, 'q5'=>0, 'sum'=>0, 'prom'=>0);
        
        $satisfaction = PollEquip::where('id_work', $work)
                                ->where('month', intval($month))
                                ->where('year', $year)
                                ->orderBy('number', 'ASC')
                                ->get();
        
        if (count($satisfaction) > 0) {

            foreach ($satisfaction as $row) {
                $row['sum'] = $row['q1'] + $row['q2'] + $row['q3'] + $row['q4'] + $row['q5'];
                $row['prom'] = number_format($row['sum'] / 5, 2, '.', ' ');
                $allpoll_prom['q1'] += $row['q1'];
                $allpoll_prom['q2'] += $row['q2'];
                $allpoll_prom['q3'] += $row['q3'];
                $allpoll_prom['q4'] += $row['q4'];
                $allpoll_prom['q5'] += $row['q5'];
                $allpoll_prom['sum'] += $row['sum'];
                $allpoll_prom['prom'] += $row['prom'];
            }
            
            $satisfaction[] = array(
                'id' => 0,
                'number' => null,
                'q1' => number_format($allpoll_prom['q1'] / count($satisfaction), 2, '.', ''),
                'q2' => number_format($allpoll_prom['q2'] / count($satisfaction), 2, '.', ''),
                'q3' => number_format($allpoll_prom['q3'] / count($satisfaction), 2, '.', ''),
                'q4' => number_format($allpoll_prom['q4'] / count($satisfaction), 2, '.', ''),
                'q5' => number_format($allpoll_prom['q5'] / count($satisfaction), 2, '.', ''),
                'sum' => number_format($allpoll_prom['sum'] / count($satisfaction), 2, '.', ''),
                'prom' => number_format($allpoll_prom['prom'] / count($satisfaction), 2, '.', ''),
            );

            Cache::forever('pollequip', $satisfaction);
        }
        else {

            Cache::forget('pollequip');
        }

        $response = array('success' => true, 'satisfaction' => $satisfaction);
        return response()->json($response,200);
    }

    /**
     * Get Polls Issues.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getServiceComments($type, $work, $month, $year)
    {
        $issues   = array();
        $comments = PollComment::where('type', $type)
                            ->where('id_work', $work)
                            ->where('month', intval($month))
                            ->where('year', $year)
                            ->get();
        $comments[] = array(
            'id' => null,
            'id_work' => $work,
            'month' => $month,
            'year' => $year,
            'type' => $type,
            'comment' => null
        );

        $response = array('success' => true, 'comments' => $comments);
        return response()->json($response, 200);
    }

    /**
     * Get Brigades Polls.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPollBrigades($work, $month, $year) {
        $satisfaction = array();
        $allpoll_prom = array('q1'=>0, 'q2'=>0, 'q3'=>0, 'q4'=>0, 'q5'=>0, 'sum'=>0, 'prom'=>0);
        
        $satisfaction = PollBrigades::where('id_work', $work)
                                ->where('month', intval($month))
                                ->where('year', $year)
                                ->orderBy('number', 'ASC')
                                ->get();
        
        if (count($satisfaction) > 0) {

            foreach ($satisfaction as $row) {
                $row['sum'] = $row['q1'] + $row['q2'] + $row['q3'] + $row['q4'] + $row['q5'];
                $row['prom'] = number_format($row['sum'] / 5, 2, '.', ' ');
                $allpoll_prom['q1'] += $row['q1'];
                $allpoll_prom['q2'] += $row['q2'];
                $allpoll_prom['q3'] += $row['q3'];
                $allpoll_prom['q4'] += $row['q4'];
                $allpoll_prom['q5'] += $row['q5'];
                $allpoll_prom['sum'] += $row['sum'];
                $allpoll_prom['prom'] += $row['prom'];
            }
            
            $satisfaction[] = array(
                'id' => 0,
                'number' => null,
                'q1' => number_format($allpoll_prom['q1'] / count($satisfaction), 2, '.', ''),
                'q2' => number_format($allpoll_prom['q2'] / count($satisfaction), 2, '.', ''),
                'q3' => number_format($allpoll_prom['q3'] / count($satisfaction), 2, '.', ''),
                'q4' => number_format($allpoll_prom['q4'] / count($satisfaction), 2, '.', ''),
                'q5' => number_format($allpoll_prom['q5'] / count($satisfaction), 2, '.', ''),
                'sum' => number_format($allpoll_prom['sum'] / count($satisfaction), 2, '.', ''),
                'prom' => number_format($allpoll_prom['prom'] / count($satisfaction), 2, '.', ''),
            );

            Cache::forever('pollbrigades', $satisfaction);
        }
        else {

            Cache::forget('pollbrigades');
        }

        $response = array('success' => true, 'satisfaction' => $satisfaction);
        return response()->json($response,200);
    }

    /**
     * Get Personal Transp.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPollPersonaltransp($work, $month, $year) {
        $satisfaction = array();
        $allpoll_prom = array('q1'=>0, 'q2'=>0, 'q3'=>0, 'q4'=>0, 'q5'=>0, 'sum'=>0, 'prom'=>0);
        
        $satisfaction = PollPersonaltransp::where('id_work', $work)
                                ->where('month', intval($month))
                                ->where('year', $year)
                                ->orderBy('number', 'ASC')
                                ->get();
        
        if (count($satisfaction) > 0) {

            foreach ($satisfaction as $row) {
                $row['sum'] = $row['q1'] + $row['q2'] + $row['q3'] + $row['q4'] + $row['q5'];
                $row['prom'] = number_format($row['sum'] / 5, 2, '.', ' ');
                $allpoll_prom['q1'] += $row['q1'];
                $allpoll_prom['q2'] += $row['q2'];
                $allpoll_prom['q3'] += $row['q3'];
                $allpoll_prom['q4'] += $row['q4'];
                $allpoll_prom['q5'] += $row['q5'];
                $allpoll_prom['sum'] += $row['sum'];
                $allpoll_prom['prom'] += $row['prom'];
            }
            
            $satisfaction[] = array(
                'id' => 0,
                'number' => null,
                'q1' => number_format($allpoll_prom['q1'] / count($satisfaction), 2, '.', ''),
                'q2' => number_format($allpoll_prom['q2'] / count($satisfaction), 2, '.', ''),
                'q3' => number_format($allpoll_prom['q3'] / count($satisfaction), 2, '.', ''),
                'q4' => number_format($allpoll_prom['q4'] / count($satisfaction), 2, '.', ''),
                'q5' => number_format($allpoll_prom['q5'] / count($satisfaction), 2, '.', ''),
                'sum' => number_format($allpoll_prom['sum'] / count($satisfaction), 2, '.', ''),
                'prom' => number_format($allpoll_prom['prom'] / count($satisfaction), 2, '.', ''),
            );

            Cache::forever('pollpersonaltransp', $satisfaction);
        }
        else {

            Cache::forget('pollpersonaltransp');
        }

        $response = array('success' => true, 'satisfaction' => $satisfaction);
        return response()->json($response,200);
    }

    /**
     * Get Freight Transp.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPollFreightransp($work, $month, $year) {
        $satisfaction = array();
        $allpoll_prom = array('q1'=>0, 'q2'=>0, 'q3'=>0, 'q4'=>0, 'q5'=>0, 'sum'=>0, 'prom'=>0);
        
        $satisfaction = PollFreightransp::where('id_work', $work)
                                ->where('month', intval($month))
                                ->where('year', $year)
                                ->orderBy('number', 'ASC')
                                ->get();
        
        if (count($satisfaction) > 0) {

            foreach ($satisfaction as $row) {
                $row['sum'] = $row['q1'] + $row['q2'] + $row['q3'] + $row['q4'] + $row['q5'];
                $row['prom'] = number_format($row['sum'] / 5, 2, '.', ' ');
                $allpoll_prom['q1'] += $row['q1'];
                $allpoll_prom['q2'] += $row['q2'];
                $allpoll_prom['q3'] += $row['q3'];
                $allpoll_prom['q4'] += $row['q4'];
                $allpoll_prom['q5'] += $row['q5'];
                $allpoll_prom['sum'] += $row['sum'];
                $allpoll_prom['prom'] += $row['prom'];
            }
            
            $satisfaction[] = array(
                'id' => 0,
                'number' => null,
                'q1' => number_format($allpoll_prom['q1'] / count($satisfaction), 2, '.', ''),
                'q2' => number_format($allpoll_prom['q2'] / count($satisfaction), 2, '.', ''),
                'q3' => number_format($allpoll_prom['q3'] / count($satisfaction), 2, '.', ''),
                'q4' => number_format($allpoll_prom['q4'] / count($satisfaction), 2, '.', ''),
                'q5' => number_format($allpoll_prom['q5'] / count($satisfaction), 2, '.', ''),
                'sum' => number_format($allpoll_prom['sum'] / count($satisfaction), 2, '.', ''),
                'prom' => number_format($allpoll_prom['prom'] / count($satisfaction), 2, '.', ''),
            );

            Cache::forever('pollfreightransp', $satisfaction);
        }
        else {

            Cache::forget('pollfreightransp');
        }

        $response = array('success' => true, 'satisfaction' => $satisfaction);
        return response()->json($response,200);
    }

    /**
     * Create Satisfaction Poll.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createPoll(Request $request) {
        switch ($request->activetab) {
            case 'intcfeedtab':
                $poll = PollFeed::create([
                            'id_work' => $request->work,
                            'month' => $request->month,
                            'year' => $request->year,
                            'number' => $request->number,
                            $request->field => $request->value
                        ]);
                break;
            case 'intchostab':
                $poll = PollHost::create([
                            'id_work' => $request->work,
                            'month' => $request->month,
                            'year' => $request->year,
                            'number' => $request->number,
                            $request->field => $request->value
                        ]);
                break;
            case 'intcequiptab':
                $poll = PollEquip::create([
                            'id_work' => $request->work,
                            'month' => $request->month,
                            'year' => $request->year,
                            'number' => $request->number,
                            $request->field => $request->value
                        ]);
                break;
            case 'intcbrigadestab':
                $poll = PollBrigades::create([
                            'id_work' => $request->work,
                            'month' => $request->month,
                            'year' => $request->year,
                            'number' => $request->number,
                            $request->field => $request->value
                        ]);
                break;
            case 'intcpersonaltransptab':
                $poll = PollPersonaltransp::create([
                            'id_work' => $request->work,
                            'month' => $request->month,
                            'year' => $request->year,
                            'number' => $request->number,
                            $request->field => $request->value
                        ]);
                break;
            case 'intcfreightransptab':
                    $poll = PollFreightransp::create([
                                'id_work' => $request->work,
                                'month' => $request->month,
                                'year' => $request->year,
                                'number' => $request->number,
                                $request->field => $request->value
                            ]);
                    break;
        }

        $response = array('success' => true, 'poll' => $poll);
        return response()->json($response,200);
    }

    /**
     * Create Satisfaction Issue.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createComment(Request $request) {
        $comment = PollComment::create([
                        'id_work' => $request->work,
                        'month' => intval($request->month),
                        'year' => $request->year,
                        'type' => $request->type,
                        $request->field => $request->value
                    ]);

        $response = array('success' => true, 'comment' => $comment);
        return response()->json($response,200);
    }

    /**
     * Update Satisfaction Poll.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updatePoll(Request $request) {
        switch ($request->activetab) {
            case 'intcfeedtab':
                $poll = PollFeed::find($request->id)->update([
                            $request->field => $request->value
                        ]);
                break;
            case 'intchostab':
                $poll = PollHost::find($request->id)->update([
                            $request->field => $request->value
                        ]);
                break;
            case 'intcequiptab':
                $poll = PollEquip::find($request->id)->update([
                            $request->field => $request->value
                        ]);
                break;
            case 'intcbrigadestab':
                $poll = PollBrigades::find($request->id)->update([
                            $request->field => $request->value
                        ]);
                break;
            case 'intcpersonaltransptab':
                $poll = PollPersonaltransp::find($request->id)->update([
                            $request->field => $request->value
                        ]);
                break;
            case 'intcfreightransptab':
                $poll = PollFreightransp::find($request->id)->update([
                            $request->field => $request->value
                        ]);
                break;
        }

        $response = array('success' => true, 'poll' => $poll);
        return response()->json($response,200);
    }

    /**
     * Update Polls Comment.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateComment(Request $request) {
        $comment = PollComment::find($request->id)->update([
                        $request->field => $request->value
                    ]);

        $response = array('success' => true, 'comment' => $comment);
        return response()->json($response,200);
    }

    /**
     * Delete Satisfaction Poll.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deletePoll(Request $request) {
        switch ($request->activetab) {
            case 'intcfeedtab':
                $poll = PollFeed::find($request->id)->delete();
            break;
            case 'intchostab':
                $poll = PollHost::find($request->id)->delete();
            break;
            case 'intcequiptab':
                $poll = PollEquip::find($request->id)->delete();
            break;
            case 'intcbrigadestab':
                $poll = PollBrigades::find($request->id)->delete();
            break;
            case 'intcpersonaltransptab':
                $poll = PollPersonaltransp::find($request->id)->delete();
            break;
            case 'intcfreightransptab':
                $poll = PollPersonaltransp::find($request->id)->delete();
            break;
        }

        $response = array('success' => true, 'poll' => $poll);
        return response()->json($response,200);
    }

    /**
     * Delete Poll Comment.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteComment(Request $request) {
        $comment = PollComment::find($request->id)->delete();

        $response = array('success' => true, 'comment' => $comment);
        return response()->json($response,200);
    }

    /**
     * Export to PDF Internal Polls Current Project.
     *
     * @return \Illuminate\Http\Response
     */
    public function intpollExpCurrent(Request $request) {
        $month   = $request->month;
        $year    = $request->year;
        $work    = Work::where('id', $request->work)->first();
        $company = Company::first();
        
        // FEED
        //////////////////////////
        $pollfeed  = array();
        $id_issues = array();
        $feed_total_prom = 0;
        $feed_eval = 'No fue procesada ninguna encuesta';

        if (Cache::get('pollfeed') != null) {
            
            $pollfeed = Cache::get('pollfeed');
            $feed_total_prom = $pollfeed[count($pollfeed) - 1]['prom'];
           
            if (4.5 <= $feed_total_prom && $feed_total_prom <= 5) {
                $feed_eval = 'Muy Bueno';
            }
            elseif (4 <= $feed_total_prom && $feed_total_prom < 4.5) {
                $feed_eval = 'Bueno';
            }
            elseif (3 <= $feed_total_prom && $feed_total_prom < 4) {
                $feed_eval = 'Regular';
            }
            elseif ($feed_total_prom < 3) {
                $feed_eval = 'Mal';
            }
            
            for ($i=1; $i < 6; $i++) {
                if ($pollfeed[count($pollfeed) - 1]['q' . $i] < 4) { $id_issues[] = $i; }
            }
        }
        
        $feed_questions = PollFeedQuest::where('active', 1)->get();
        $feed_issues    = array();
        
        for ($i=0; $i < count($id_issues); $i++) {
            $feed_issues[] = PollFeedQuest::where('active', 1)->where('order', $id_issues[$i])->first()->issue;
        }
        $feed_comments = PollComment::where('type', 'feed')
                                    ->where('id_work', $request->work)
                                    ->where('month', intval($month))
                                    ->where('year', $year)
                                    ->get();
       
        // HOST
        ////////////////////////////
        $pollhost  = array();
        $id_issues = array();
        $host_total_prom = 0;
        $host_eval = 'No fue procesada ninguna encuesta';

        if (Cache::get('pollhost') != null) {
            
            $pollhost = Cache::get('pollhost');
            $host_total_prom = $pollhost[count($pollhost) - 1]['prom'];
           
            if (4.5 <= $host_total_prom && $host_total_prom <= 5) {
                $host_eval = 'Muy Bueno';
            }
            elseif (4 <= $host_total_prom && $host_total_prom < 4.5) {
                $host_eval = 'Bueno';
            }
            elseif (3 <= $host_total_prom && $host_total_prom < 4) {
                $host_eval = 'Regular';
            }
            elseif ($host_total_prom < 3) {
                $host_eval = 'Mal';
            }

            for ($i=1; $i < 6; $i++) {
                if ($pollhost[count($pollhost) - 1]['q' . $i] < 4) { $id_issues[] = $i; }
            }
        }
        
        $host_questions = PollHostQuest::where('active', 1)->get();
        $host_issues    = array();
        
        for ($i=0; $i < count($id_issues); $i++) {
            $host_issues[] = PollHostQuest::where('active', 1)->where('order', $id_issues[$i])->first()->issue;
        }
        $host_comments = PollComment::whereIn('type', ['host', 'recr'])
                                    ->where('id_work', $request->work)
                                    ->where('month', intval($month))
                                    ->where('year', $year)
                                    ->get();

        // EQUIP
        ////////////////////////////
        $pollequip = array();
        $id_issues = array();
        $equip_total_prom = 0;
        $equip_eval = 'No fue procesada ninguna encuesta';

        if (Cache::get('pollequip') != null) {
            
            $pollequip = Cache::get('pollequip');
            $equip_total_prom = $pollequip[count($pollequip) - 1]['prom'];
           
            if (4.5 <= $equip_total_prom && $equip_total_prom <= 5) {
                $equip_eval = 'Muy Bueno';
            }
            elseif (4 <= $equip_total_prom && $equip_total_prom < 4.5) {
                $equip_eval = 'Bueno';
            }
            elseif (3 <= $equip_total_prom && $equip_total_prom < 4) {
                $equip_eval = 'Regular';
            }
            elseif ($equip_total_prom < 3) {
                $equip_eval = 'Mal';
            }

            for ($i=1; $i < 6; $i++) {
                if ($pollequip[count($pollequip) - 1]['q' . $i] < 4) { $id_issues[] = $i; }
            }
        }
        
        $equip_questions = PollEquipQuest::all();
        $equip_issues = array();
        
        for ($i=0; $i < count($id_issues); $i++) {
            $equip_issues[] = PollEquipQuest::where('order', $id_issues[$i])->first()->issue;
        }
        $equip_comments = PollComment::where('type', 'equip')
                                    ->where('id_work', $request->work)
                                    ->where('month', intval($month))
                                    ->where('year', $year)
                                    ->get();

        // BRIGADES
        //////////////////////////
        $pollbrigades  = array();
        $id_issues = array();
        $brigades_total_prom = 0;
        $brigades_eval = 'No fue procesada ninguna encuesta';

        if (Cache::get('pollbrigades') != null) {
            
            $pollbrigades = Cache::get('pollbrigades');
            $brigades_total_prom = $pollbrigades[count($pollbrigades) - 1]['prom'];
           
            if (4.5 <= $brigades_total_prom && $brigades_total_prom <= 5) {
                $brigades_eval = 'Muy Bueno';
            }
            elseif (4 <= $brigades_total_prom && $brigades_total_prom < 4.5) {
                $brigades_eval = 'Bueno';
            }
            elseif (3 <= $brigades_total_prom && $brigades_total_prom < 4) {
                $brigades_eval = 'Regular';
            }
            elseif ($brigades_total_prom < 3) {
                $brigades_eval = 'Mal';
            }
            
            for ($i=1; $i < 6; $i++) {
                if ($pollbrigades[count($pollbrigades) - 1]['q' . $i] < 4) { $id_issues[] = $i; }
            }
        }
        
        $brigades_questions = PollBrigadesQuest::where('active', 1)->get();
        $brigades_issues    = array();
        
        for ($i=0; $i < count($id_issues); $i++) {
            $brigades_issues[] = PollBrigadesQuest::where('active', 1)->where('order', $id_issues[$i])->first()->issue;
        }
        $brigades_comments = PollComment::where('type', 'brigades')
                                    ->where('id_work', $request->work)
                                    ->where('month', intval($month))
                                    ->where('year', $year)
                                    ->get();
        
        // PERSONAL TRANSPORT
        //////////////////////////
        $pollpersonaltransp  = array();
        $id_issues = array();
        $personaltransp_total_prom = 0;
        $personaltransp_eval = 'No fue procesada ninguna encuesta';

        if (Cache::get('pollpersonaltransp') != null) {
            
            $pollpersonaltransp = Cache::get('pollpersonaltransp');
            $personaltransp_total_prom = $pollpersonaltransp[count($pollpersonaltransp) - 1]['prom'];
           
            if (4.5 <= $personaltransp_total_prom && $personaltransp_total_prom <= 5) {
                $personaltransp_eval = 'Muy Bueno';
            }
            elseif (4 <= $personaltransp_total_prom && $personaltransp_total_prom < 4.5) {
                $personaltransp_eval = 'Bueno';
            }
            elseif (3 <= $personaltransp_total_prom && $personaltransp_total_prom < 4) {
                $personaltransp_eval = 'Regular';
            }
            elseif ($personaltransp_total_prom < 3) {
                $personaltransp_eval = 'Mal';
            }
            
            for ($i=1; $i < 6; $i++) {
                if ($pollpersonaltransp[count($pollpersonaltransp) - 1]['q' . $i] < 4) { $id_issues[] = $i; }
            }
        }
        
        $personaltransp_questions = PollPersonaltranspQuest::where('active', 1)->get();
        $personaltransp_issues    = array();
        
        for ($i=0; $i < count($id_issues); $i++) {
            $personaltransp_issues[] = PollPersonaltranspQuest::where('active', 1)->where('order', $id_issues[$i])->first()->issue;
        }
        $personaltransp_comments = PollComment::where('type', 'personaltransp')
                                    ->where('id_work', $request->work)
                                    ->where('month', intval($month))
                                    ->where('year', $year)
                                    ->get();

        // FREIGHT TRANSPORT
        //////////////////////////
        $pollfreightransp  = array();
        $id_issues = array();
        $freightransp_total_prom = 0;
        $freightransp_eval = 'No fue procesada ninguna encuesta';

        if (Cache::get('pollfreightransp') != null) {
            
            $pollfreightransp = Cache::get('pollfreightransp');
            $freightransp_total_prom = $pollfreightransp[count($pollfreightransp) - 1]['prom'];
           
            if (4.5 <= $freightransp_total_prom && $freightransp_total_prom <= 5) {
                $freightransp_eval = 'Muy Bueno';
            }
            elseif (4 <= $freightransp_total_prom && $freightransp_total_prom < 4.5) {
                $freightransp_eval = 'Bueno';
            }
            elseif (3 <= $freightransp_total_prom && $freightransp_total_prom < 4) {
                $freightransp_eval = 'Regular';
            }
            elseif ($freightransp_total_prom < 3) {
                $freightransp_eval = 'Mal';
            }
            
            for ($i=1; $i < 6; $i++) {
                if ($pollfreightransp[count($pollfreightransp) - 1]['q' . $i] < 4) { $id_issues[] = $i; }
            }
        }
        
        $freightransp_questions = PollFreightranspQuest::where('active', 1)->get();
        $freightransp_issues    = array();
        
        for ($i=0; $i < count($id_issues); $i++) {
            $freightransp_issues[] = PollFreightranspQuest::where('active', 1)->where('order', $id_issues[$i])->first()->issue;
        }
        $freightransp_comments = PollComment::where('type', 'freightransp')
                                    ->where('id_work', $request->work)
                                    ->where('month', intval($month))
                                    ->where('year', $year)
                                    ->get();
        
        
        $pdf = PDF::loadView('pdf.IntpollCurrentProject', compact('month', 'year',  'company', 'work', 'pollfeed', 'feed_total_prom', 'feed_eval', 'feed_questions', 'feed_issues', 'feed_comments', 'pollhost', 'host_total_prom', 'host_eval', 'host_questions', 'host_issues', 'host_comments', 'pollequip', 'equip_total_prom', 'equip_eval', 'equip_questions', 'equip_issues', 'equip_comments', 'pollbrigades', 'brigades_total_prom', 'brigades_eval', 'brigades_questions', 'brigades_issues', 'brigades_comments', 'pollpersonaltransp', 'personaltransp_total_prom', 'personaltransp_eval', 'personaltransp_questions', 'personaltransp_issues', 'personaltransp_comments', 'pollfreightransp', 'freightransp_total_prom', 'freightransp_eval', 'freightransp_questions', 'freightransp_issues', 'freightransp_comments'));
        return $pdf->download('Satisfacción Cliente Interno '.$work->name.' '.$request->month.'-'.$request->year.'.pdf');
    }

    /**
     * Export to PDF Internal Polls All Project.
     *
     * @return \Illuminate\Http\Response
     */
    public function intpollExpAll(Request $request) {

        $feed_allpoll_prom = array('q1'=>0, 'q2'=>0, 'q3'=>0, 'q4'=>0, 'q5'=>0, 'sum'=>0, 'prom'=>0);
        $host_allpoll_prom = array('q1'=>0, 'q2'=>0, 'q3'=>0, 'q4'=>0, 'q5'=>0, 'sum'=>0, 'prom'=>0);
        $equip_allpoll_prom = array('q1'=>0, 'q2'=>0, 'q3'=>0, 'q4'=>0, 'q5'=>0, 'sum'=>0, 'prom'=>0);
        $brigades_allpoll_prom = array('q1'=>0, 'q2'=>0, 'q3'=>0, 'q4'=>0, 'q5'=>0, 'sum'=>0, 'prom'=>0);
        $personaltransp_allpoll_prom = array('q1'=>0, 'q2'=>0, 'q3'=>0, 'q4'=>0, 'q5'=>0, 'sum'=>0, 'prom'=>0);
        $freightransp_allpoll_prom = array('q1'=>0, 'q2'=>0, 'q3'=>0, 'q4'=>0, 'q5'=>0, 'sum'=>0, 'prom'=>0);

        $pollfeed = array();
        $feed_total_prom = 0;
        $feed_eval = null;
        $feed_questions = array();
        $feed_issues = array();
        $feed_comments = array();

        $pollhost = array();
        $host_total_prom = 0;
        $host_eval = null;
        $host_questions = array();
        $host_issues = array();
        $host_comments = array();

        $pollequip = array();
        $equip_total_prom = 0;
        $equip_eval = null;
        $equip_questions = array();
        $equip_issues = array();
        $equip_comments = array();

        $pollbrigades = array();
        $brigades_total_prom = 0;
        $brigades_eval = null;
        $brigades_questions = array();
        $brigades_issues = array();
        $brigades_comments = array();

        $pollpersonaltransp = array();
        $personaltransp_total_prom = 0;
        $personaltransp_eval = null;
        $personaltransp_questions = array();
        $personaltransp_issues = array();
        $personaltransp_comments = array();

        $pollfreightransp = array();
        $freightransp_total_prom = 0;
        $freightransp_eval = null;
        $freightransp_questions = array();
        $freightransp_issues = array();
        $freightransp_comments = array();

        $month   = $request->month;
        $year    = $request->year;
        $company = Company::first();
        
        // FEED
        //////////////////////////
        $pollfeed = PollFeed::where('month', intval($request->month))
                            ->where('year', $request->year)
                            ->orderBy('id_work', 'ASC')
                            ->orderBy('number', 'ASC')
                            ->get();
        
        foreach ($pollfeed as $row) {
            $row['sum'] = $row['q1'] + $row['q2'] + $row['q3'] + $row['q4'] + $row['q5'];
            $row['prom'] = number_format($row['sum'] / 5, 2, '.', ' ');
            $feed_allpoll_prom['q1'] += $row['q1'];
            $feed_allpoll_prom['q2'] += $row['q2'];
            $feed_allpoll_prom['q3'] += $row['q3'];
            $feed_allpoll_prom['q4'] += $row['q4'];
            $feed_allpoll_prom['q5'] += $row['q5'];
            $feed_allpoll_prom['sum'] += $row['sum'];
            $feed_allpoll_prom['prom'] += $row['prom'];
        }
        
        if (count($pollfeed) > 0) {
            $pollfeed[] = array(
                'id' => 0,
                'number' => null,
                'q1' => number_format($feed_allpoll_prom['q1'] / count($pollfeed), 2, '.', ''),
                'q2' => number_format($feed_allpoll_prom['q2'] / count($pollfeed), 2, '.', ''),
                'q3' => number_format($feed_allpoll_prom['q3'] / count($pollfeed), 2, '.', ''),
                'q4' => number_format($feed_allpoll_prom['q4'] / count($pollfeed), 2, '.', ''),
                'q5' => number_format($feed_allpoll_prom['q5'] / count($pollfeed), 2, '.', ''),
                'sum' => number_format($feed_allpoll_prom['sum'] / count($pollfeed), 2, '.', ''),
                'prom' => number_format($feed_allpoll_prom['prom'] / count($pollfeed), 2, '.', ''),
            );

            $feed_total_prom = $pollfeed[count($pollfeed) - 1]['prom'];
            
            if (4.5 <= $feed_total_prom && $feed_total_prom <= 5) {
                $feed_eval = 'Muy Bueno';
            }
            elseif (4 <= $feed_total_prom && $feed_total_prom < 4.5) {
                $feed_eval = 'Bueno';
            }
            elseif (3 <= $feed_total_prom && $feed_total_prom < 4) {
                $feed_eval = 'Regular';
            }
            elseif ($feed_total_prom < 3) {
                $feed_eval = 'Mal';
            }
            $feed_questions = PollFeedQuest::where('active', 1)->get();
            $feed_issues    = array();
            $id_issues      = array();
            for ($i=1; $i < 6; $i++) {
                if ($pollfeed[count($pollfeed) - 1]['q' . $i] < 4) { $id_issues[] = $i; }
            }
            for ($i=0; $i < count($id_issues); $i++) {
                $feed_issues[] = PollFeedQuest::where('active', 1)->where('order', $id_issues[$i])->first()->issue;
            }
            $feed_comments = PollComment::distinct('comment')
                                        ->where('type', 'feed')
                                        ->where('month', intval($month))
                                        ->where('year', $year)
                                        ->get();
        }
        
        // HOST
        ////////////////////////////
        $pollhost = PollHost::where('month', intval($request->month))
                            ->where('year', $request->year)
                            ->orderBy('id_work', 'ASC')
                            ->orderBy('number', 'ASC')
                            ->get();

        foreach ($pollhost as $row) {
            $row['sum'] = $row['q1'] + $row['q2'] + $row['q3'] + $row['q4'] + $row['q5'];
            $row['prom'] = number_format($row['sum'] / 5, 2, '.', ' ');
            $host_allpoll_prom['q1'] += $row['q1'];
            $host_allpoll_prom['q2'] += $row['q2'];
            $host_allpoll_prom['q3'] += $row['q3'];
            $host_allpoll_prom['q4'] += $row['q4'];
            $host_allpoll_prom['q5'] += $row['q5'];
            $host_allpoll_prom['sum'] += $row['sum'];
            $host_allpoll_prom['prom'] += $row['prom'];
        }

        if (count($pollhost) > 0) {
            $pollhost[] = array(
                'id' => 0,
                'number' => null,
                'q1' => number_format($host_allpoll_prom['q1'] / count($pollhost), 2, '.', ''),
                'q2' => number_format($host_allpoll_prom['q2'] / count($pollhost), 2, '.', ''),
                'q3' => number_format($host_allpoll_prom['q3'] / count($pollhost), 2, '.', ''),
                'q4' => number_format($host_allpoll_prom['q4'] / count($pollhost), 2, '.', ''),
                'q5' => number_format($host_allpoll_prom['q5'] / count($pollhost), 2, '.', ''),
                'sum' => number_format($host_allpoll_prom['sum'] / count($pollhost), 2, '.', ''),
                'prom' => number_format($host_allpoll_prom['prom'] / count($pollhost), 2, '.', ''),
            );

            $host_total_prom = $pollhost[count($pollhost) - 1]['prom'];
            
            if (4.5 <= $host_total_prom && $host_total_prom <= 5) {
                $host_eval = 'Muy Bueno';
            }
            elseif (4 <= $host_total_prom && $host_total_prom < 4.5) {
                $host_eval = 'Bueno';
            }
            elseif (3 <= $host_total_prom && $host_total_prom < 4) {
                $host_eval = 'Regular';
            }
            elseif ($host_total_prom < 3) {
                $host_eval = 'Mal';
            }
            $host_questions = PollHostQuest::where('active', 1)->get();
            $host_issues    = array();
            $id_issues      = array();
            for ($i=1; $i < 6; $i++) {
                if ($pollhost[count($pollhost) - 1]['q' . $i] < 4) { $id_issues[] = $i; }
            }
            for ($i=0; $i < count($id_issues); $i++) {
                $host_issues[] = PollHostQuest::where('active', 1)
                                            ->where('order', $id_issues[$i])
                                            ->first()->issue;
            }
            $host_comments = PollComment::distinct('comment')
                                        ->where('type', 'host')
                                        ->where('month', intval($month))
                                        ->where('year', $year)
                                        ->get();
        }
        
        // EQUIP
        ////////////////////////////
        $pollequip = PollEquip::where('month', intval($request->month))
                            ->where('year', $request->year)
                            ->orderBy('id_work', 'ASC')
                            ->orderBy('number', 'ASC')
                            ->get();

        foreach ($pollequip as $row) {
            $row['sum'] = $row['q1'] + $row['q2'] + $row['q3'] + $row['q4'] + $row['q5'];
            $row['prom'] = number_format($row['sum'] / 5, 2, '.', ' ');
            $equip_allpoll_prom['q1'] += $row['q1'];
            $equip_allpoll_prom['q2'] += $row['q2'];
            $equip_allpoll_prom['q3'] += $row['q3'];
            $equip_allpoll_prom['q4'] += $row['q4'];
            $equip_allpoll_prom['q5'] += $row['q5'];
            $equip_allpoll_prom['sum'] += $row['sum'];
            $equip_allpoll_prom['prom'] += $row['prom'];
        }

        if (count($pollequip) > 0) {
            $pollequip[] = array(
                'id' => 0,
                'number' => null,
                'q1' => number_format($equip_allpoll_prom['q1'] / count($pollequip), 2, '.', ''),
                'q2' => number_format($equip_allpoll_prom['q2'] / count($pollequip), 2, '.', ''),
                'q3' => number_format($equip_allpoll_prom['q3'] / count($pollequip), 2, '.', ''),
                'q4' => number_format($equip_allpoll_prom['q4'] / count($pollequip), 2, '.', ''),
                'q5' => number_format($equip_allpoll_prom['q5'] / count($pollequip), 2, '.', ''),
                'sum' => number_format($equip_allpoll_prom['sum'] / count($pollequip), 2, '.', ''),
                'prom' => number_format($equip_allpoll_prom['prom'] / count($pollequip), 2, '.', ''),
            );

            $equip_total_prom = $pollequip[count($pollequip) - 1]['prom'];
            
            if (4.5 <= $equip_total_prom && $equip_total_prom <= 5) {
                $equip_eval = 'Muy Bueno';
            }
            elseif (4 <= $equip_total_prom && $equip_total_prom < 4.5) {
                $equip_eval = 'Bueno';
            }
            elseif (3 <= $equip_total_prom && $equip_total_prom < 4) {
                $equip_eval = 'Regular';
            }
            elseif ($equip_total_prom < 3) {
                $equip_eval = 'Mal';
            }
            $equip_questions = PollEquipQuest::all();
            $equip_issues    = array();
            $id_issues       = array();
            for ($i=1; $i < 6; $i++) {
                if ($pollequip[count($pollequip) - 1]['q' . $i] < 4) { $id_issues[] = $i; }
            }
            for ($i=0; $i < count($id_issues); $i++) {
                $equip_issues[] = PollEquipQuest::where('order', $id_issues[$i])->first()->issue;
            }
            $equip_comments = PollComment::distinct('comment')
                                        ->where('type', 'equip')
                                        ->where('month', intval($month))
                                        ->where('year', $year)
                                        ->get();
        }

        // BRIGADES
        //////////////////////////
        $pollbrigades = PollBrigades::where('month', intval($request->month))
                            ->where('year', $request->year)
                            ->orderBy('id_work', 'ASC')
                            ->orderBy('number', 'ASC')
                            ->get();
        
        foreach ($pollbrigades as $row) {
            $row['sum'] = $row['q1'] + $row['q2'] + $row['q3'] + $row['q4'] + $row['q5'];
            $row['prom'] = number_format($row['sum'] / 5, 2, '.', ' ');
            $brigades_allpoll_prom['q1'] += $row['q1'];
            $brigades_allpoll_prom['q2'] += $row['q2'];
            $brigades_allpoll_prom['q3'] += $row['q3'];
            $brigades_allpoll_prom['q4'] += $row['q4'];
            $brigades_allpoll_prom['q5'] += $row['q5'];
            $brigades_allpoll_prom['sum'] += $row['sum'];
            $brigades_allpoll_prom['prom'] += $row['prom'];
        }
        
        if (count($pollbrigades) > 0) {
            $pollbrigades[] = array(
                'id' => 0,
                'number' => null,
                'q1' => number_format($brigades_allpoll_prom['q1'] / count($pollbrigades), 2, '.', ''),
                'q2' => number_format($brigades_allpoll_prom['q2'] / count($pollbrigades), 2, '.', ''),
                'q3' => number_format($brigades_allpoll_prom['q3'] / count($pollbrigades), 2, '.', ''),
                'q4' => number_format($brigades_allpoll_prom['q4'] / count($pollbrigades), 2, '.', ''),
                'q5' => number_format($brigades_allpoll_prom['q5'] / count($pollbrigades), 2, '.', ''),
                'sum' => number_format($brigades_allpoll_prom['sum'] / count($pollbrigades), 2, '.', ''),
                'prom' => number_format($brigades_allpoll_prom['prom'] / count($pollbrigades), 2, '.', ''),
            );

            $brigades_total_prom = $pollbrigades[count($pollbrigades) - 1]['prom'];
            
            if (4.5 <= $brigades_total_prom && $brigades_total_prom <= 5) {
                $brigades_eval = 'Muy Bueno';
            }
            elseif (4 <= $brigades_total_prom && $brigades_total_prom < 4.5) {
                $brigades_eval = 'Bueno';
            }
            elseif (3 <= $brigades_total_prom && $brigades_total_prom < 4) {
                $brigades_eval = 'Regular';
            }
            elseif ($brigades_total_prom < 3) {
                $brigades_eval = 'Mal';
            }
            $brigades_questions = PollBrigadesQuest::where('active', 1)->get();
            $brigades_issues    = array();
            $id_issues          = array();
            for ($i=1; $i < 6; $i++) {
                if ($pollbrigades[count($pollbrigades) - 1]['q' . $i] < 4) { $id_issues[] = $i; }
            }
            for ($i=0; $i < count($id_issues); $i++) {
                $brigades_issues[] = PollBrigadesQuest::where('active', 1)->where('order', $id_issues[$i])->first()->issue;
            }
            $brigades_comments = PollComment::distinct('comment')
                                        ->where('type', 'brigades')
                                        ->where('month', intval($month))
                                        ->where('year', $year)
                                        ->get();
        }

        // PERSONAL TRANSPORT
        //////////////////////////
        $pollpersonaltransp = PollPersonaltransp::where('month', intval($request->month))
                            ->where('year', $request->year)
                            ->orderBy('id_work', 'ASC')
                            ->orderBy('number', 'ASC')
                            ->get();
        
        foreach ($pollpersonaltransp as $row) {
            $row['sum'] = $row['q1'] + $row['q2'] + $row['q3'] + $row['q4'] + $row['q5'];
            $row['prom'] = number_format($row['sum'] / 5, 2, '.', ' ');
            $personaltransp_allpoll_prom['q1'] += $row['q1'];
            $personaltransp_allpoll_prom['q2'] += $row['q2'];
            $personaltransp_allpoll_prom['q3'] += $row['q3'];
            $personaltransp_allpoll_prom['q4'] += $row['q4'];
            $personaltransp_allpoll_prom['q5'] += $row['q5'];
            $personaltransp_allpoll_prom['sum'] += $row['sum'];
            $personaltransp_allpoll_prom['prom'] += $row['prom'];
        }
        
        if (count($pollpersonaltransp) > 0) {
            $pollpersonaltransp[] = array(
                'id' => 0,
                'number' => null,
                'q1' => number_format($personaltransp_allpoll_prom['q1'] / count($pollpersonaltransp), 2, '.', ''),
                'q2' => number_format($personaltransp_allpoll_prom['q2'] / count($pollpersonaltransp), 2, '.', ''),
                'q3' => number_format($personaltransp_allpoll_prom['q3'] / count($pollpersonaltransp), 2, '.', ''),
                'q4' => number_format($personaltransp_allpoll_prom['q4'] / count($pollpersonaltransp), 2, '.', ''),
                'q5' => number_format($personaltransp_allpoll_prom['q5'] / count($pollpersonaltransp), 2, '.', ''),
                'sum' => number_format($personaltransp_allpoll_prom['sum'] / count($pollpersonaltransp), 2, '.', ''),
                'prom' => number_format($personaltransp_allpoll_prom['prom'] / count($pollpersonaltransp), 2, '.', ''),
            );

            $personaltransp_total_prom = $pollpersonaltransp[count($pollpersonaltransp) - 1]['prom'];
            
            if (4.5 <= $personaltransp_total_prom && $personaltransp_total_prom <= 5) {
                $personaltransp_eval = 'Muy Bueno';
            }
            elseif (4 <= $personaltransp_total_prom && $personaltransp_total_prom < 4.5) {
                $personaltransp_eval = 'Bueno';
            }
            elseif (3 <= $personaltransp_total_prom && $personaltransp_total_prom < 4) {
                $personaltransp_eval = 'Regular';
            }
            elseif ($personaltransp_total_prom < 3) {
                $personaltransp_eval = 'Mal';
            }
            $personaltransp_questions = PollPersonaltranspQuest::where('active', 1)->get();
            $personaltransp_issues    = array();
            $id_issues                = array();
            for ($i=1; $i < 6; $i++) {
                if ($pollpersonaltransp[count($pollpersonaltransp) - 1]['q' . $i] < 4) { $id_issues[] = $i; }
            }
            for ($i=0; $i < count($id_issues); $i++) {
                $personaltransp_issues[] = PollPersonaltranspQuest::where('active', 1)->where('order', $id_issues[$i])->first()->issue;
            }
            $personaltransp_comments = PollComment::distinct('comment')
                                        ->where('type', 'personaltransp')
                                        ->where('month', intval($month))
                                        ->where('year', $year)
                                        ->get();
        }


        // FREIGHT TRANSPORT
        //////////////////////////
        $pollfreightransp = PollFreightransp::where('month', intval($request->month))
                            ->where('year', $request->year)
                            ->orderBy('id_work', 'ASC')
                            ->orderBy('number', 'ASC')
                            ->get();
        
        foreach ($pollfreightransp as $row) {
            $row['sum'] = $row['q1'] + $row['q2'] + $row['q3'] + $row['q4'] + $row['q5'];
            $row['prom'] = number_format($row['sum'] / 5, 2, '.', ' ');
            $freightransp_allpoll_prom['q1'] += $row['q1'];
            $freightransp_allpoll_prom['q2'] += $row['q2'];
            $freightransp_allpoll_prom['q3'] += $row['q3'];
            $freightransp_allpoll_prom['q4'] += $row['q4'];
            $freightransp_allpoll_prom['q5'] += $row['q5'];
            $freightransp_allpoll_prom['sum'] += $row['sum'];
            $freightransp_allpoll_prom['prom'] += $row['prom'];
        }
        
        if (count($pollfreightransp) > 0) {
            $pollfreightransp[] = array(
                'id' => 0,
                'number' => null,
                'q1' => number_format($freightransp_allpoll_prom['q1'] / count($pollfreightransp), 2, '.', ''),
                'q2' => number_format($freightransp_allpoll_prom['q2'] / count($pollfreightransp), 2, '.', ''),
                'q3' => number_format($freightransp_allpoll_prom['q3'] / count($pollfreightransp), 2, '.', ''),
                'q4' => number_format($freightransp_allpoll_prom['q4'] / count($pollfreightransp), 2, '.', ''),
                'q5' => number_format($freightransp_allpoll_prom['q5'] / count($pollfreightransp), 2, '.', ''),
                'sum' => number_format($freightransp_allpoll_prom['sum'] / count($pollfreightransp), 2, '.', ''),
                'prom' => number_format($freightransp_allpoll_prom['prom'] / count($pollfreightransp), 2, '.', ''),
            );

            $freightransp_total_prom = $pollfreightransp[count($pollfreightransp) - 1]['prom'];
            
            if (4.5 <= $freightransp_total_prom && $freightransp_total_prom <= 5) {
                $freightransp_eval = 'Muy Bueno';
            }
            elseif (4 <= $freightransp_total_prom && $freightransp_total_prom < 4.5) {
                $freightransp_eval = 'Bueno';
            }
            elseif (3 <= $freightransp_total_prom && $freightransp_total_prom < 4) {
                $freightransp_eval = 'Regular';
            }
            elseif ($freightransp_total_prom < 3) {
                $freightransp_eval = 'Mal';
            }
            $freightransp_questions = PollFreightranspQuest::where('active', 1)->get();
            $freightransp_issues    = array();
            $id_issues                = array();
            for ($i=1; $i < 6; $i++) {
                if ($pollfreightransp[count($pollfreightransp) - 1]['q' . $i] < 4) { $id_issues[] = $i; }
            }
            for ($i=0; $i < count($id_issues); $i++) {
                $freightransp_issues[] = PollFreightranspQuest::where('active', 1)->where('order', $id_issues[$i])->first()->issue;
            }
            $freightransp_comments = PollComment::distinct('comment')
                                        ->where('type', 'freightransp')
                                        ->where('month', intval($month))
                                        ->where('year', $year)
                                        ->get();
        }
        
        $pdf = PDF::loadView('pdf.IntpollAllProject', compact('month', 'year',  'company', 'pollfeed', 'feed_total_prom', 'feed_eval', 'feed_questions', 'feed_issues', 'feed_comments', 'pollhost', 'host_total_prom', 'host_eval', 'host_questions', 'host_issues', 'host_comments', 'pollequip', 'equip_total_prom', 'equip_eval', 'equip_questions', 'equip_issues', 'equip_comments', 'pollbrigades', 'brigades_total_prom', 'brigades_eval', 'brigades_questions', 'brigades_issues', 'brigades_comments', 'pollpersonaltransp', 'personaltransp_total_prom', 'personaltransp_eval', 'personaltransp_questions', 'personaltransp_issues', 'personaltransp_comments', 'pollfreightransp', 'freightransp_total_prom', 'freightransp_eval', 'freightransp_questions', 'freightransp_issues', 'freightransp_comments'));
        return $pdf->download('Satisfacción Cliente Interno '.$company->name.' '.$request->month.'-'.$request->year.'.pdf');
    }
}