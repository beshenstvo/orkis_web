<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Clients;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ClientController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('clientsAvailable');
        $clients = Clients::all();
        return view('/clients/index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('clientsAvailable');
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('clientsAvailable');
        $client = new Clients();
        $client->id = request('id');
        $client->name = request('name');
        $client->surname = request('surname');
        $client->patronymic = request('patronymic');
        $client->bth = request('bth');
        $client->series_passport = request('series_passport');
        $client->number_passport = request('number_passport');
        $client->date_of_issue = request('date_of_issue');
        $client->expiration_date = request('expiration_date');
        $client->government_agency = request('government_agency');
        $client->place_of_birth = request('place_of_birth');
        $client->type_sex = request('type_sex');
        $client->type_client = request('type_client');
        $client->save();
        //return request()->all();
        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Clients $client)
    {
        $this->authorize('clientsAvailable');
        return view('clients.index', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Clients $client)
    {
        $this->authorize('clientsAvailable');
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clients $client)
    {
        $this->authorize('clientsAvailable');
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'patronymic' => 'required',
            'bth' => 'required',
            'series_passport' => 'required',
            'number_passport' => 'required',
            'date_of_issue' => 'required',
            'expiration_date' => 'required',
            'government_agency' => 'required',
            'place_of_birth' => 'required',
            'type_sex' => 'required',
            'type_client' => 'required'
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clients $client)
    {
        $this->authorize('clientsAvailable');
        $client->delete();

       return redirect()->route('clients.index')->with('success','post deleted successfully');
    }
    public function search(Request $request){
        $this->authorize('clientsAvailable');
        $text = $request->text;
        $clients = Clients::where('surname', 'LIKE' , "%{$text}%")->orderBy('name', 'ASC')->paginate(10);
        return view('/clients/index', compact('clients'));
    }
    public function filter(Request $request){
        $this->authorize('clientsAvailable');
        $filterType = $request->filter;
        switch ($filterType){
            case 1:
                $filterType = 'VIP';
                break;
            case 2:
                $filterType = 'Привилегированный';
                break;
            case 3:
                $filterType = 'Обычный';
                break;
        }
        $clients = DB::table('clients')->where('type_client', "{$filterType}")->get();
        return view('/clients/index', compact('clients'));
    }
}
