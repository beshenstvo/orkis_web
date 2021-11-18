<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Agreement;
use App\Models\Agents;
use App\Models\Route;
use App\Models\Tours;
use App\Models\Hotels;
use App\Models\Voucher;
use App\Models\Transfer;
use App\Models\Participants_of_trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ContractsController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('contractAvailable');
        $contracts = Contract::leftJoin('Payment', 'Contract.id', '=', 'Payment.id_contract')
        ->where('Payment.id_contract', '=', null)
        ->join('Agreement', 'Contract.Id_agreement', '=', 'Agreement.id')
        ->join('Organization', 'Agreement.Id_organization', '=', 'Organization.id')
        ->join('Agents', 'Agreement.Id_Agent', '=', 'Agents.id')
        ->join('Clients', 'Agreement.Id_client', '=', 'Clients.id')
        ->join('Number_of_cities_visited', 'Agreement.id', '=', 'Number_of_cities_visited.id_agreement')
        ->join('City', 'Number_of_cities_visited.id_city', '=', 'City.id')
        ->join('Country', 'City.Id_country', '=', 'Country.id')
        ->join('Route', 'Contract.id', '=', 'Route.id_contract')
        ->join('Tours', 'Route.id', '=', 'Tours.id_route')
        ->join('Hotels', 'Tours.id_hotel', '=', 'Hotels.id')
        ->join('Participants_of_trip', 'Contract.id', '=', 'Participants_of_trip.id_contract')
        ->groupBy('Contract.id')
        ->get([
            // DB::raw('Contract.id AS contract_id'),
            'Contract.id',
            DB::raw('Agreement.id AS id_agreement'),
            DB::raw('Contract.created_at AS contract_created_at'),
            'Organization.organization_name',
            DB::raw('Agents.surname AS agent_surname'),
            DB::raw('Agents.patronymic AS agent_patronymic'),
            DB::raw('Agents.name AS agent_name'),
            DB::raw('Clients.name AS client_name'),
            DB::raw('Clients.surname AS client_surname'),
            DB::raw('Clients.patronymic AS client_patronymic'),
            'Country.name_country',
            DB::raw('GROUP_CONCAT(DISTINCT City.name_city SEPARATOR ", ") as name_city'),
            'Tours.type_food',
            'Tours.type_room',
            'Agreement.start_of_trip',
            'Agreement.end_of_trip',
            'Contract.amount_in_currency',
            DB::raw('GROUP_CONCAT(DISTINCT Hotels.name SEPARATOR ", ") AS hotel_name'),
            DB::raw('GROUP_CONCAT(DISTINCT Participants_of_trip.surname," ", Participants_of_trip.name, " ", Participants_of_trip.patronymic SEPARATOR ", ") AS participant_fullname'),
    
        ]);
        //return $contracts;
        return view('contract.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('contractAvailable');
        $listContract = Agreement::leftJoin('Contract', 'Agreement.id', '=', 'Contract.id_agreement')
        ->where('Contract.id_agreement', '=', null)
        ->join('Clients', 'Agreement.Id_client' , '=', 'Clients.id')
        ->join('Organization', 'Agreement.Id_organization', '=', 'Organization.id')
        ->join('Agents', 'Agreement.Id_Agent' , '=', 'Agents.id')
        ->join('Number_of_cities_visited', 'Agreement.id', '=', 'Number_of_cities_visited.id_agreement')
        ->join('City', 'Number_of_cities_visited.id_city', '=', 'City.id')
        ->join('Country', 'City.Id_country', '=', 'Country.id')
        // ->join('Hotels', 'Agreement.Id_city', '=', 'Hotels.Id_city')
        ->groupBy('Agreement.id')
        ->orderBy('Agreement.id', 'asc')
        ->get([
            DB::raw('Agreement.id AS id_agreement_hasnt_contract'),
            DB::raw('Clients.name AS client_name'),
            DB::raw('Clients.surname AS client_surname'),
            DB::raw('Clients.patronymic AS client_patronymic'),
            DB::raw('Organization.id AS organization_id'),
            DB::raw('Agents.id AS agent_id'),
            DB::raw('Agents.name AS agent_name'),
            DB::raw('Agents.surname AS agent_surname'),
            DB::raw('Agents.patronymic AS agent_patronymic'),
            DB::raw('Clients.id AS client_id'),
            DB::raw('GROUP_CONCAT(City.name_city) as name_city'),
            DB::raw('Organization.organization_name AS organization_name'),
            'Country.name_country',
            'start_of_trip',
            'end_of_trip',
            //'City.name_city',
            DB::raw('GROUP_CONCAT(City.id) AS city_id'),
            DB::raw('Country.id AS country_id'),
        ]);
        //return $listContract;
        $listHotels = Hotels::groupBy('Hotels.id')
        ->orderBy('Hotels.id', 'asc')
        ->get([
            DB::raw('Hotels.id AS hotel_id'),
            DB::raw('Hotels.name AS hotel_name'),
            DB::raw('Hotels.address AS hotel_address'),
            DB::raw('Hotels.id_city AS id_city_hotel'),
        ]);
        $listAgents = Agents::all();
        //return $listContract;
        return view('/contract/create', compact('listContract', 'listHotels', 'listAgents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('contractAvailable');
        $request->validate([
            'date' => 'required',
            'organization' => 'required',
            'client' => 'required',
            'country' => 'required',
            'city' => 'required',
            //'hotel' => 'required',
            'type_room' => 'required',
            'start_trip' => 'required',
            'end_trip' => 'required',
            'participants' => 'required',
            'amount_in_currency' => 'required',
            'type_food' => 'required',
            'type_transport' => 'required',
            'transfer' => 'required',
            'hotels' => 'required',
        ]);

        $contract = new Contract();
        $contract->date = $request->date;
        $contract->amount_in_currency = $request->amount_in_currency;
        $contract->id_agreement = $request->id_agreement;
        $contract->save();

        //Routes 
        $route = new Route();
        $route->id_contract = $contract->id;
        $route->save();

        //Voucher
        $voucher = new Voucher();
        $voucher->type_of_transport = $request->type_transport;
        $voucher->save();

        //Tours 
        $element = explode(',',$request->hotels);
        foreach($element as $val){
            $toure = new Tours();
            $toure->type_room = request('type_room');
            $toure->type_food = request('type_food');
            $toure->id_hotel = (int)$val;
            $toure->id_route = $route->id;
            $toure->id_voucher = $voucher->id;
            $toure->save();
            // return (int)$val;
        }

        //Participants
        $element = json_decode($request->participants, true);
        foreach($element as $val){
            $participants = new Participants_of_trip();
            $participants->name = $val['name'];
            $participants->surname = $val['surname'];
            $participants->patronymic = $val['patronymic'];
            $participants->id_contract = $contract->id;
            $participants->save();
        }

        //Transfer
        $transfer = new Transfer();
        $transfer->id_voucher = $voucher->id;
        $transfer->transfer = $request->transfer;
        $transfer->save();
        
        return redirect()->route('contract.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        $this->authorize('contractAvailable');
        return view('contract.index', compact('contract'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        $this->authorize('contractAvailable');
        return view('contract.index', compact('contract'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        $this->authorize('contractAvailable');
        $contract->delete();

       return redirect()->route('contract.index')->with('success','post deleted successfully');
    }
}
