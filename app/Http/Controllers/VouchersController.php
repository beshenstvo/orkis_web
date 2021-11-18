<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Agreement;
use App\Models\Agents;
use App\Models\Route;
use App\Models\Tours;
use App\Models\Voucher;
use App\Models\Payment;
use App\Models\Transfer;
use App\Models\Participants_of_trip;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class VouchersController extends Controller
{
//    public function __construct(){
   
//    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('voucherAvailable');
        $vouchers = Payment::join('Employees', 'Payment.id_employee', '=', 'Employees.id')
        ->join('Organization', 'Employees.id_organization', '=', 'Organization.id')
        ->groupBy('Organization.organization_name')
        ->get([
            DB::raw('Organization.id AS org_id'),
            DB::raw('GROUP_CONCAT(Payment.id_contract SEPARATOR ",") AS id_contract'),
            'Organization.organization_name',
        ]);
        //return $vouchers;
        return view('voucher.index', compact('vouchers'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function getData(Request $request){
        // return $request;
        $data = Contract::where('Contract.id','=', $request->contract)
        ->join('Agreement', 'Contract.id_agreement', '=', 'Agreement.id')
        ->join('Clients', 'Agreement.id_client', '=', 'Clients.id')
        ->join('Number_of_cities_visited', 'Agreement.id', '=', 'Number_of_cities_visited.id_agreement')
        ->join('City', 'Number_of_cities_visited.id_city', '=', 'City.id')
        ->join('Country', 'City.Id_country', '=', 'Country.id')
        ->join('Participants_of_trip', 'Contract.id', '=', 'Participants_of_trip.id_contract')
        ->join('Route', 'Contract.id' ,'=', 'Route.id_contract')
        ->join('Tours', 'Route.id' , '=', 'Tours.id_route')
        ->join('Hotels', 'Tours.id_hotel', '=', 'Hotels.id')
        ->join('Voucher', 'Tours.id_voucher', '=', 'Voucher.id')
        ->join('Transfer', 'Voucher.id' , '=', 'Transfer.id_voucher')
        ->get([
            'Contract.id',
            DB::raw('Clients.name AS client_name'),
            DB::raw('Clients.surname AS client_surname'),
            DB::raw('Clients.patronymic AS client_patronymic'),
            'Agreement.start_of_trip',
            'Agreement.end_of_trip',
            DB::raw('GROUP_CONCAT(DISTINCT City.name_city SEPARATOR ", ") AS name_city'),
            'Country.name_country',
            DB::raw('GROUP_CONCAT(DISTINCT Participants_of_trip.surname," ", Participants_of_trip.name, " ", Participants_of_trip.patronymic SEPARATOR ", ") AS participant_fullname'),
            'Tours.type_room',
            'Tours.type_food',
            DB::raw('GROUP_CONCAT(DISTINCT Hotels.name SEPARATOR ", ") AS name_hotel'),
            DB::raw('GROUP_CONCAT(DISTINCT Hotels.address SEPARATOR ", ") AS address'),
            'Voucher.type_of_transport',
            'Transfer.transfer'
        ]);
        //return $data;
        return view('voucher.get', compact('data'));
    }
}
