<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DataTables;
use Validator;

use App\Models\Admin\PlotType;
use App\Models\Admin\PlotCategory;
use App\Models\Admin\SocietyRegistration;

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
            $data = PlotCategory::with('plot_type_name')->get();
            return DataTables::of($data)
            ->addColumn('action', function($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit action" style="background: none; outline: none; border: none; color: blue;"><i class="fa fa-edit"></i>  /</button>';
                $button .= '<button type="button" name="edit" id="'.$data->id.'" class="delete action" style="background: none; outline: none; border: none; color: blue; padding-left: 0%;"><i class="fa fa-trash"></i></button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $plot_types = PlotType::all();
        $data = SocietyRegistration::first();
        return view('layouts.admin.societySetup.plotcategory', compact('plot_types','data'));
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
        // dd($request->all());
        $rules = array(
            'plot_type_id' => 'required',
            'name' => 'required',
            'area' => 'required',
            'no_of_plots' => 'required',
        );
        $messages = array(
            'plot_type_id.required' => 'The Plot type field is required.',
            'name.required' => 'The category name field is required.',
            'area.required' => 'The area field is required.',
            'no_of_plots.required' => 'The total no. of plots field is required.'
        );
        $error = Validator::make($request->all(), $rules, $messages);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = array(
            'plot_type_id' => $request->plot_type_id,
            'name' => $request->name,
            'area' => $request->area,
            'no_of_plots' => $request->no_of_plots,
        );
        PlotCategory::create($form_data);
        $prev_alloted_plot = PlotType::where('id',$request->plot_type_id)->first();
        if(!empty($prev_alloted_plot))
        {
            PlotType::where('id',$request->plot_type_id)
            ->update(
                [
                    'remaining_plots' => $request->remaining_plots,
                    'alloted_plots' => $request->no_of_plots + $prev_alloted_plot->alloted_plots
                ]
            );
        }
        return response()->json(['added' => 'Data successfully added.']);
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
            $prev_alloted_plot = PlotType::where('id',$data->plot_type_id)->first();
            return response()->json(['result' => $data, 'prev_alloted_plot' => $prev_alloted_plot]);
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

        return response()->json(['updated' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = PlotCategory::findOrFail($id)->delete();
    }

    /**
     * Custom function to overview the roster from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_total_plots_of_plot_type(Request $request)
    {   
        $total_plots = PlotType::where('id',$request->plot_type_id)
        ->select('*')
        ->orderBy('id','ASC')
        ->get();
        return response()->json($total_plots, 200);
    }
}