<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Response;
use App\Models\Party;
use Illuminate\Support\Facades\DB;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all responses with a join on the other tables
        return Party::leftJoin('responses', 'r_party', 'p_id')
            ->select('p_name')
            ->selectRaw('COALESCE(SUM(r_voting), 0) AS votes')
            ->groupBy('p_name')
            ->orderBy('p_name')
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->response) {
            return "No data provided in request";
        }
        
        $newResponse = new Response;
        $newResponse->r_constituency = $request->response['constituency'];
        $newResponse->r_voting = $request->response['voting'];
        $newResponse->r_party = $request->response['party'];
        $newResponse->save();

        return $newResponse->r_id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get all responses for a constituency with a join on the other tables
        $votes = DB::select('SELECT c_name, p_name, votes
        FROM (constituencies,
        (SELECT * FROM parties) AS partyNames)
        LEFT JOIN (SELECT r_constituency, r_party, COUNT(*) as votes FROM responses WHERE r_voting = 1 GROUP BY r_constituency, r_party) r 
        ON (r.r_constituency = c_id AND r.r_party = p_id)
        ORDER BY c_name');
        return $votes;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
