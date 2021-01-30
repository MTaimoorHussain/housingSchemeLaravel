<?php

namespace App\Http\Controllers;

use App\Models\Admin\PlotType;
use App\Models\Admin\PlotCategory;
use App\Models\Admin\SocietyRegistration;
use Illuminate\Http\Request;
use DataTables;
use Validator;

class PlotCategoryController extends Controller
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
            $data = PlotCategory::latest()->get();
            return DataTables::of($data)
            ->addColumn('action', function($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit action" style="background: none; outline: none; border: none; color: blue;"><i class="fa fa-edit"></i>  /</button>';
                $button .= '<button type="button" name="edit" id="'.$data->id.'" class="delete action" style="background: none; outline: none; border: none; color: blue; padding-left: 0%;"><i class="fa fa-trash"></i></button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $plotTypes = PlotType::all();
        $data = SocietyRegistration::first();
        return view('layouts.admin.societySetup.plotcategory', compact('plotTypes','data'));
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
            'plotTypeCat'    =>  'required',
            'CatName'     =>  'required',
            'catSize'    =>  'required',
            'catUnits'    =>  'required',
            'NoOfPlots'    =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'plotTypeCat'        =>  $request->plotTypeCat,
            'CatName'         =>  $request->CatName,
            'catSize'        =>  $request->catSize,
            'catUnits'        =>  $request->catUnits,
            'NoOfPlots'        =>  $request->NoOfPlots
        );

        PlotCategory::create($form_data);

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
            $data = PlotCategory::findOrFail($id);
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
            'plotTypeCat'    =>  'required',
            'CatName'     =>  'required',
            'catSize'    =>  'required',
            'catUnits'    =>  'required',
            'NoOfPlots'    =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'plotTypeCat'        =>  $request->plotTypeCat,
            'CatName'         =>  $request->CatName,
            'catSize'        =>  $request->catSize,
            'catUnits'        =>  $request->catUnits,
            'NoOfPlots'        =>  $request->NoOfPlots
        );

        PlotCategory::whereId($request->hidden_id)->update($form_data);

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
        $data = PlotCategory::findOrFail($id);
        $data->delete();
    }
}
