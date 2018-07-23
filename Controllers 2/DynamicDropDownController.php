<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DynamicDropDownController extends Controller
{
    //

    function index()
    {
        $companies = DB::table('company_programs')
                        ->join('companies', 'company_programs.company_id', '=', 'companies.id')
                        ->select('company_programs.company_id', 'companies.name as company_name')
                        ->get();
                    
        return view('dynamicdependent')->with('companies', $companies);
    }

    function fetch(Request $request)
    {
        //try{
            //$_token = $request->get('$data->_token');
            $select = $request->get('$data->select');
            $value = $request->get('$data->value');
            $dependent = $request->get('$data->dependent');

            echo $select;

            $data = DB::table('company_programs')
                    ->where($select, $value)
                    ->groupBy($dependent)
                    ->value('program_id')
                    ->get();

            $output .= '<option value="">Select '.ucfirst($dependent).'</option>';
            foreach($data as $row)
            {
                $output .= '<option value="'.$row->dependent.'">'.$row->dependent.'</option>';
            }

            echo $output;
        //}

        //catch(\Exception $e)
        //{
            //console.log($e);
        //}
    }
}
