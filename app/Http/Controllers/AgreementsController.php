<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\Clients;
use App\Models\Agents;
use App\Models\Country;
use App\Models\Organization;
use App\Models\Employees;
use App\Models\City;
use App\Models\Number_of_cities_visited;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AgreementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $this->authorize('agreementAvailable');
        $agreements = Agreement::leftJoin('Contract', 'Agreement.id', '=', 'Contract.id_agreement')
        ->where('Contract.id_agreement', '=', null)
        ->join('Organization', 'Agreement.Id_organization', '=', 'Organization.id')
        //->where('Agreement.Id_organization', '=', 'Organization.id')
        ->join('Agents', 'Id_Agent', '=', 'Agents.id')
        ->join('Clients', 'Id_client', '=', 'Clients.id')
        ->join('Number_of_cities_visited', 'Agreement.id', '=', 'Number_of_cities_visited.id_agreement')
        ->join('City', 'Number_of_cities_visited.id_city', '=', 'City.id')
        ->join('Country', 'City.Id_country', '=', 'Country.id')
        ->orderBy('id', 'asc')
        ->groupBy('Number_of_cities_visited.id_agreement')
        // ->join('Employees', 'Id_employee', '=', 'Employees.id')
        ->get(['Agreement.id',
        'Agreement.date',
        'Agreement.start_of_trip',
        'Agreement.end_of_trip', 
        'Agreement.number_of_participants',
        'Organization.organization_name', 
        'Number_of_cities_visited.id_city',
        DB::raw('Agents.surname AS agent_surname'),
        DB::raw('Agents.name AS agent_name'),
        DB::raw('Agents.patronymic AS agent_patronymic'),
        DB::raw('Clients.surname AS client_surname'), 
        DB::raw('Clients.name AS client_name'), 
        DB::raw('Clients.patronymic AS client_patronymic'), 
        'Country.name_country', 
        'City.name_city',
        DB::raw('GROUP_CONCAT(City.name_city SEPARATOR ", ") as cities')
        // DB::raw('Employees.surname AS employee_surname')
        ]);
        //return $agreements;
        // $agreements = Agreement::all();
        return view('agreement.index',compact('agreements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('agreementAvailable');
        //здесь передать в виде списка организацию, Агент, клиент, сотрудник, страна посещения
        $listOrganizations = Organization::select('id','organization_name')->get();
        $listAgent = Agents::select('id','surname', 'name', 'patronymic', 'Id_organization')->get();
        $listClient = Clients::select('id','surname', 'name', 'patronymic')->get();
        $listCountry = Country::select('id','name_country')->get(); 
        $listEmployees = Employees::select('surname')->get();
        $listCity = City::all();
        //return [$listOrganizations, $listAgent, $listClient, $listCountry, $listEmployees];
        return view('agreement.create', compact('listOrganizations', 'listClient', 'listCountry', 'listEmployees', 'listAgent', 'listCity'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('agreementAvailable');
        $request->validate([
            'date' => 'required',
            'organization_name' => 'required',
            'country' => 'required',
            'client' => 'required',
            'agent' => 'required',
            'count' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'cities' => 'required',
        ]);

        $agreement = new Agreement();
        $agreement->date = $request->date;
        $agreement->number_of_participants = $request->count;
        $agreement->start_of_trip = $request->date_start;
        $agreement->end_of_trip = $request->date_end;
        $agreement->Id_organization = $request->organization_name;
        $agreement->Id_Agent = $request->agent;
        $agreement->Id_client = $request->client;
        $agreement->save();

        $result = explode(',', $request->cities);
        foreach($result as $city) {
            $number_of_cities = new Number_of_cities_visited();
            $number_of_cities->id_city = $city;
            $number_of_cities->id_agreement = $agreement->id;
            $number_of_cities->save();
        }

        return redirect()->route('agreement.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function show(Agreement $agreement)
    {
        $this->authorize('agreementAvailable');
        return view('agreement.index', compact('agreement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function edit(Agreement $agreement)
    {
        $this->authorize('agreementAvailable');
        //преобразовать данные как в index
        //return $agreement->id;
        $agreements = Agreement::where('Agreement.id','=',$agreement->id)
        ->join('Organization', 'Id_organization', '=', 'Organization.id')
        ->join('Agents', 'Id_Agent', '=', 'Agents.id')
        ->join('Clients', 'Id_client', '=', 'Clients.id')
        ->join('City', 'Agreement.Id_city', '=', 'City.id')
        ->join('Country', 'City.Id_country', '=', 'Country.id')
        ->orderBy('id', 'asc')
        // ->join('Employees', 'Id_employee', '=', 'Employees.id')
        ->get([
        'Agreement.id',
        'Agreement.date',
        'Agreement.start_of_trip',
        'Agreement.end_of_trip', 
        'Agreement.number_of_participants',
        'Organization.organization_name',  
        DB::raw('Organization.id AS organization_id'), 
        DB::raw('Agents.id AS agent_id'), 
        DB::raw('Agents.surname AS agent_surname'),
        DB::raw('Agents.name AS agent_name'),
        DB::raw('Agents.patronymic AS agent_patronymic'),
        DB::raw('Clients.id AS client_id'), 
        DB::raw('Clients.surname AS client_surname'), 
        DB::raw('Clients.name AS client_name'), 
        DB::raw('Clients.patronymic AS client_patronymic'), 
        DB::raw('Country.id AS country_id'), 
        DB::raw('City.id AS city_id'), 
        'Country.name_country', 
        // DB::raw('Employees.surname AS employee_surname')
        ]);
        $listOrganizations = Organization::select('id','organization_name')->get();
        $listAgent = Agents::select('id','surname', 'name', 'patronymic')->get();
        $listClient = Clients::select('id','surname', 'name', 'patronymic')->get();
        $listCountry = Country::select('id','name_country')->get(); 
        $listCity = City::all();
        //return $agreements;
        return view('agreement.edit', compact('agreements', 'listOrganizations', 'listClient', 'listCountry', 'listAgent', 'listCity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agreement $agreement)
    {
        $this->authorize('agreementAvailable');
        $request->validate([
            'date' => 'required',
            'number_of_participants' => 'required',
            'start_of_trip' => 'required',
            'end_of_trip' => 'required',
            'Id_organization' => 'required',
            'Id_Agent' => 'required',
            'Id_client' => 'required',
            'cities' => 'required',
        ]);
        Agreement::where('id','=', $request->IdAgreement)
        ->update([
            'Id_city' => $request->Id_city, 
            'date' => $request->date,
            'number_of_participants' => $request->number_of_participants,
            'start_of_trip' => $request->start_of_trip,
            'end_of_trip' => $request->end_of_trip,
            'Id_organization' => $request->Id_organization,
            'Id_Agent' => $request->Id_Agent,
            'Id_client' => $request->Id_client,
        ]);

        return redirect()->route('agreement.index')->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agreement $agreement)
    {
        $this->authorize('agreementAvailable');
        Number_of_cities_visited::where('Number_of_cities_visited.id_agreement','=', $agreement->id)->delete();
        Agreement::where('Agreement.id', '=', $agreement->id)->delete();
        return redirect()->route('agreement.index')->with('success','post deleted successfully');
    }
    public function addcity( Request $request){
        $this->authorize('agreementAvailable');
        $request->validate([
            'date' => 'required',
            'organization_name' => 'required',
            'country' => 'required',
            'client' => 'required',
            'agent' => 'required',
            'count' => 'required',
            'date_start' => 'required',
            'date_end' => 'required'
        ]);
        //занести данные в Agreement
        //Взять значение Country и вывести из него список городов страны
        $agreement = new Agreement();
        $agreement->date = $request->date;
        $agreement->number_of_participants = $request->count;
        $agreement->start_of_trip = $request->date_start;
        $agreement->end_of_trip = $request->date_end;
        $agreement->Id_organization = $request->organization_name;
        $agreement->Id_Agent = $request->agent;
        $agreement->Id_client = $request->client;
        $agreement->save();
        $idAgreement = $agreement->id;
        // return $idAgreement;
        $countryId = request('country');
        $cities = City::select(['City.id', 'City.name_city'])
        ->where('City.Id_country','=', $countryId)
        ->get();
        return view('agreement.addcity', compact('cities'))->with('idAgreement', $idAgreement);
    }
    public function addedcity(Request $request){
        $this->authorize('agreementAvailable');
        $request->validate([
            //'city' => 'required'
        ]);
        // return $request->idAgreement;
        Agreement::where('id','=', $request->idAgreement)
        ->update(['Id_city' => $request->city]);
        return redirect()->route('agreement.index');
    }
}
