<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Contract;
use App\Models\Employees;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PaymentsController extends Controller
{

  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('paymentAvailable');
        $payments = Payment::join('Employees', 'Payment.id_employee', '=', 'Employees.id')
        ->join('Organization', 'Employees.id_organization', '=', 'Organization.id')
        ->get([
            'Payment.id',
            'Payment.date_of_payment',
            'Payment.amount_in_rubels',
            'Payment.id_contract',
            'Organization.organization_name',
            DB::raw('Employees.name AS employee_name'),
            DB::raw('Employees.surname AS employee_surname'),
            DB::raw('Employees.patronymic AS employee_patronymic'),
        ]);
        //return $payments;

        return view('/payment/index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('paymentAvailable');
        $payments = Contract::Join('Payment', 'Payment.id_contract', '<>', 'Contract.id')
        ->get([
            'Contract.id',
        ]);
        $listAccounts = Employees::select('Id_organization', 'name', 'surname', 'patronymic', 'id')
        ->where('Employees.type_position', '=', 1)
        ->get();
        $listOrganizationsWithContact = Organization::join('Agreement', 'Organization.id', '=', 'Agreement.Id_organization')
        ->join('Contract', 'Agreement.id', '=', 'Contract.Id_agreement')
        ->leftjoin('Payment', 'Payment.id_contract', '=', 'Contract.id')
        ->where('Payment.id_contract', '=', null)
        ->join('Employees', 'Organization.id', '=', 'Employees.id_organization')
        ->groupBy('Organization.id')
        ->get([
            'Organization.id',
            'Organization.organization_name',
            // DB::raw('Employees.id AS employee_id'),
            DB::raw('GROUP_CONCAT(DISTINCT Contract.id SEPARATOR ",") AS nonpay_id_contract'),
            DB::raw('GROUP_CONCAT(DISTINCT Employees.id SEPARATOR ", ") AS id_employee_who_works_in')
        ]);
        //return $listOrganizationsWithContact;
        return view('payment.create' , compact('listAccounts', 'payments', 'listOrganizationsWithContact'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('paymentAvailable');
        $request->validate([
            'date_payment' => 'required',
            'organization' => 'required',
            'id_contract' => 'required',
            'accountant' => 'required',
            'amount_in_rubels' => 'required',
        ]);
        
        //return $request;
        $payment = new Payment();
        $payment->date_of_payment = $request->date_payment;
        $payment->amount_in_rubels = $request->amount_in_rubels;
        $payment->id_contract = $request->id_contract;
        $payment->id_employee = $request->accountant;
        $payment->save();

        return redirect()->route('payment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        $this->authorize('paymentAvailable');
        return view('payment.index', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        $this->authorize('paymentAvailable');
        return view('payment.index', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $this->authorize('paymentAvailable');
        $payment->delete();

       return redirect()->route('payment.index')->with('success','post deleted successfully');
    }
}
