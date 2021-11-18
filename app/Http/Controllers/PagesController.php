<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Employees;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function welcome(){
        return view("welcome");
    }
    public function search(Request $request){
        $text = $request->text;
        $employees = Employees::where('surname', 'LIKE' , "%{$text}%")->orderBy('name', 'ASC')->get();
        return view('/employees/index', compact('employees'));
    }
}
