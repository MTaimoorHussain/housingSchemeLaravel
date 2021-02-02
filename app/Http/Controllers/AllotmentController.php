<?php

namespace App\Http\Controllers;

use App\Allotment;
use Illuminate\Http\Request;
use DataTables;
use Validator;

class AllotmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Allotment::latest()->get();
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit action" style="background: none; outline: none; border: none; color: blue;"><i class="fa fa-edit"></i>  /</button>';
                        $button .= '<button type="button" name="edit" id="'.$data->id.'" class="delete action" style="background: none; outline: none; border: none; color: blue; padding-left: 0%;"><i class="fa fa-trash"></i></button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('layouts.admin.membershipManagement.allotment');
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
        $rules = array(
            'membership_no'    =>  'required',
            'member_name'     =>  'required',
            'member_cnic_no'     =>  'required',
            'plot_type_id'     =>  'required',
            'plot_category_id'     =>  'required',
            'block_no'     =>  'required',
            'plot_no'     =>  'required',
            'plot_area'     =>  'required',
            'cost_of_land'     =>  'required',
            'no_of_shares'     =>  'required',
            'allotment_no'     =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'membership_no'    =>  $request->membership_no,
            'member_name'     =>  $request->member_name,
            'member_cnic_no'     =>  $request->member_cnic_no,
            'plot_type_id'     =>  $request->plot_type_id,
            'plot_category_id'     =>  $request->plot_category_id,
            'block_no'     =>  $request->block_no,
            'plot_no'     =>  $request->plot_no,
            'plot_area'     =>  $request->plot_area,
            'cost_of_land'     =>  $request->cost_of_land,
            'no_of_shares'     =>  $request->no_of_shares,
            'allotment_no'     =>  $request->allotment_no,
        );

        Allotment::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
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
        if(request()->ajax())
        {
            $data = Allotment::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = array(
            'membership_no'    =>  'required',
            'member_name'     =>  'required',
            'member_cnic_no'     =>  'required',
            'plot_type_id'     =>  'required',
            'plot_category_id'     =>  'required',
            'block_no'     =>  'required',
            'plot_no'     =>  'required',
            'plot_area'     =>  'required',
            'cost_of_land'     =>  'required',
            'no_of_shares'     =>  'required',
            'allotment_no'     =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'membership_no'    =>  $request->membership_no,
            'member_name'     =>  $request->member_name,
            'member_cnic_no'     =>  $request->member_cnic_no,
            'plot_type_id'     =>  $request->plot_type_id,
            'plot_category_id'     =>  $request->plot_category_id,
            'block_no'     =>  $request->block_no,
            'plot_no'     =>  $request->plot_no,
            'plot_area'     =>  $request->plot_area,
            'cost_of_land'     =>  $request->cost_of_land,
            'no_of_shares'     =>  $request->no_of_shares,
            'allotment_no'     =>  $request->allotment_no,
        );

        Allotment::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Allotment::findOrFail($id);
        $data->delete();

    }
}
