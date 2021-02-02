<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DataTables;
use Validator;

use App\Models\Admin\PlotType;
use App\Models\Admin\SocietyRegistration;

class PlotTypeController extends Controller
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
            $data = PlotType::latest()->get();
            return DataTables::of($data)
            ->addColumn('action', function($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit action" style="background: none; outline: none; border: none; color: blue;"><i class="fa fa-edit"></i>  /</button>';
                $button .= '<button type="button" name="edit" id="'.$data->id.'" class="delete action" style="background: none; outline: none; border: none; color: blue; padding-left: 0%;"><i class="fa fa-trash"></i></button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $data = SocietyRegistration::first();
        return view('layouts.admin.societySetup.plottype',compact('data'));
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
        $rules = [
            'society_id' => 'required',
            'plot_type_name' => 'required',
            'total_plots' => 'required',
        ];
        $messages = array(
            'society_id.required' => 'The society name field is required.',
            'plot_type_name.required' => 'The plot name field is required.',
            'total_plots.required' => 'The total plots field is required.'
        );
        $error = Validator::make($request->all(), $rules, $messages);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = array(
            'society_id' => $request->society_id,
            'name' => $request->plot_type_name,
            'total_plots' => $request->total_plots,
        );
        PlotType::create($form_data);
        $last_alloted_as_plot_type = SocietyRegistration::where('id',$request->society_id)->first();
        if(!empty($last_alloted_as_plot_type))
        {
            SocietyRegistration::where('id',$request->society_id)
            ->update(
                [
                    'remaining_society_plots' => $request->total_remaining_plots,
                    'alloted_society_plots_in_plot_type' => $request->total_plots + $last_alloted_as_plot_type->alloted_society_plots_in_plot_type
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
            $data = PlotType::findOrFail($id);
            $last_alloted_as_plot_type = SocietyRegistration::where('id',$data->society_id)->first();
            return response()->json(['result' => $data, 'last_alloted_as_plot_type' => $last_alloted_as_plot_type]);
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
        $rules = [
            'society_id' => 'required',
            'plot_type_name' => 'required',
            'total_plots' => 'required',
        ];
        $messages = array(
            'society_id.required' => 'The society name field is required.',
            'plot_type_name.required' => 'The plot name field is required.',
            'total_plots.required' => 'The total plots field is required.'
        );
        $error = Validator::make($request->all(), $rules, $messages);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'society_id' => $request->society_id,
            'name' => $request->plot_type_name,
            'total_plots' => $request->total_plots,
        );
        PlotType::whereId($request->hidden_id)->update($form_data);
        $last_alloted_as_plot_type = SocietyRegistration::where('id',$request->society_id)->first();
        if(!empty($last_alloted_as_plot_type))
        {
            SocietyRegistration::where('id',$request->society_id)
            ->update(
                [
                    'remaining_society_plots' => $request->total_remaining_plots,
                    'alloted_society_plots_in_plot_type' => $request->total_plots + $last_alloted_as_plot_type->alloted_society_plots_in_plot_type
                ]
            );
        }
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
        $data = PlotType::findOrFail($id);
        $data->delete();
    }

    /**
     * Custom function to overview the roster from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_total_society_plots(Request $request)
    {   
        $total_society_plots = SocietyRegistration::where('id',$request->society_id)
        ->select('*')
        ->orderBy('id','ASC')
        ->get();
        return response()->json($total_society_plots, 200);
    }
}
