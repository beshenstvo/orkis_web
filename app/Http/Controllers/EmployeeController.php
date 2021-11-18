<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('employeeAvailable');
        $employees = Employees::join('Organization', 'Employees.Id_organization', '=', 'Organization.id')
        ->orderBy('Employees.id')
        ->get([
            'Organization.organization_name',
            'Employees.id',
            'Employees.name',
            'Employees.surname',
            'Employees.patronymic',
            'Employees.bth',
            'Employees.photo',
            'Employees.type_position',
        ]);
        // dd($employees);
        return view('/employees/index', compact('employees'));
    }

    public function userHasRole(User $user){
        $this->authorize('employeeAvailable');
        return $user->role->count() > 0;
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('employeeAvailable');
        $listOrganizations = Organization::all();
        return view('employees.create', compact('listOrganizations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('employeeAvailable');
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'patronymic' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'bth' => 'required',
            'type_position' => 'required',
            'Id_organization' => 'required'
        ]);

        $employee = new Employees();
        $employee->id = request('id');
        $employee->name = request('name');
        $employee->surname = request('surname');
        $employee->patronymic = request('patronymic');
        $employee->bth = request('bth');
        $employee->Id_organization = request('Id_organization');
        if($request->hasFile('photo')){
            $employee->photo = $request->file('photo')->store('photos');
        }else{
            return '<h1>Фото НЕ загружено</h1>';
        }
        $employee->type_position = request('type_position');
        $employee->save();
        //return request()->all();
        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employees $employee)
    {
        $this->authorize('employeeAvailable');
        return view('employees.index', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employees $employee)
    {
        $this->authorize('employeeAvailable');
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employees $employee)
    {
        $this->authorize('employeeAvailable');
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'patronymic' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'bth' => 'required',
            'type_position' => 'required'
        ]);
        if ($request->hasFile('photo')) {
            Storage::delete($employee->photo);
            $path = $request->file('photo')->store('photos');
            $photoParams = $request->all();
            $photoParams['photo'] = $path;
            $employee->update($photoParams);
            $data = [
                'name' => $request->name, 
                'surname' => $request->surname, 
                'patronymic' => $request->patronymic, 
                'bth' => $request->bth, 
                'type_position' => $request->type_position
            ];
            $employee->update($data);
            return redirect()->route('employees.index')->with('message','employee updated successfully');
        }else{
            $data = [
                'name' => $request->name, 
                'surname' => $request->surname, 
                'patronymic' => $request->patronymic, 
                'bth' => $request->bth, 
                'type_position' => $request->type_position
            ];
            $employee->update($data);
            return redirect()->route('employees.index')->with('message','employee updated successfully');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employees $employee)
    {
        $this->authorize('employeeAvailable');
        $employee->delete();

       return redirect()->route('employees.index')->with('success','employee deleted successfully');
    }
    public function search(Request $request){
        $this->authorize('employeeAvailable');
        $text = $request->text;
        $employees = Employees::where('surname', 'LIKE' , "%{$text}%")->orderBy('name', 'ASC')->get();
        return view('/employees/index', compact('employees'));
    }
    public function filter(Request $request){
        $this->authorize('employeeAvailable');
        $filterType = $request->filter;
        switch ($filterType){
            case 1:
                $filterType = 'Бухгалтер';
                break;
            case 2:
                $filterType = 'Администратор';
                break;
            case 3:
                $filterType = 'Менеджер';
                break;
        }
        $employees = DB::table('employees')->where('type_position', "{$filterType}")->get();
        return view('/employees/index', compact('employees'));
    }
}
