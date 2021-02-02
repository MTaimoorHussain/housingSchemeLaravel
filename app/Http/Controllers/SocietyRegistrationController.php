<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DataTables;
use Validator;

use App\Models\Admin\SocietyRegistration;
use App\Models\Admin\Country;
use App\Models\Admin\State;
use App\Models\Admin\City;

class SocietyRegistrationController extends Controller
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
            $data = SocietyRegistration::latest()->get();
            return DataTables::of($data)
            ->addColumn('action', function($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'" class="btn-warning edit action"><i class="fa fa-edit"></i></button>';
                $button .= '<button type="button" name="edit" id="'.$data->id.'" class="btn-danger delete action"><i class="fa fa-trash"></i></button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $data = SocietyRegistration::first();
        $countries = Country::orderBy('id','ASC')->get();
        return view('layouts.admin.societyregistration.index',compact('countries','data'));
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
            'name' => 'required',
            'slug' => 'required',
            'address' => 'required',
            'registration_no' => 'required',
            'registration_date' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'total_society_plots' => 'required',
            'total_alloted_area_sq' => 'required',
            'total_alloted_area_acre' => 'required'
        ];
        $messages = array(
            'name.required' => 'The name field is required.',
            'slug.required' => 'The short name field is required.',
            'address.required' => 'The address field is required.',
            'registration_no.required' => 'The registration no# field is required.',
            'registration_date.required' => 'The registration date field is required.',
            'country.required' => 'The country field is required.',
            'state.required' => 'The state field is required.',
            'city.required' => 'The city field is required.',
            'total_society_plots.required' => 'The society plots field is required.',
            'total_alloted_area_sq.required' => 'The alloted area sq. yards field is required.',
            'total_alloted_area_acre.required' => 'The alloted area acre field is required.'
        );
        $error = Validator::make($request->all(), $rules, $messages);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'address' => $request->address,
            'registration_no' => $request->registration_no,
            'registration_date' => $request->registration_date,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'total_society_plots' => $request->total_society_plots,
            'total_alloted_area_sq' => $request->total_alloted_area_sq,
            'total_alloted_area_acre' => $request->total_alloted_area_acre
        ];
        SocietyRegistration::create($form_data);
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
            $data = SocietyRegistration::findOrFail($id);
            $country = Country::select('*')
            ->orderBy('id','ASC')
            ->get();
            $state = State::select('*')
            ->orderBy('id','ASC')
            ->get();
            $city = City::select('*')
            ->orderBy('id','ASC')
            ->get();
            return response()->json(['result' => $data, 'country' => $country, 'state' => $state, 'city' => $city]);
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
            'name' => 'required',
            'slug' => 'required',
            'address' => 'required',
            'registration_no' => 'required',
            'registration_date' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'total_society_plots' => 'required',
            'total_alloted_area_sq' => 'required',
            'total_alloted_area_acre' => 'required'
        ];
        $messages = array(
            'name.required' => 'The name field is required.',
            'slug.required' => 'The short name field is required.',
            'address.required' => 'The address field is required.',
            'registration_no.required' => 'The registration no# field is required.',
            'registration_date.required' => 'The registration date field is required.',
            'country.required' => 'The country field is required.',
            'state.required' => 'The state field is required.',
            'city.required' => 'The city field is required.',
            'total_society_plots.required' => 'The society plots field is required.',
            'total_alloted_area_sq.required' => 'The alloted area sq. yards field is required.',
            'total_alloted_area_acre.required' => 'The alloted area acre field is required.'
        );
        $error = Validator::make($request->all(), $rules, $messages);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'address' => $request->address,
            'registration_no' => $request->registration_no,
            'registration_date' => $request->registration_date,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'total_society_plots' => $request->total_society_plots,
            'total_alloted_area_sq' => $request->total_alloted_area_sq,
            'total_alloted_area_acre' => $request->total_alloted_area_acre
        ];
        SocietyRegistration::whereId($request->hidden_id)->update($form_data);
        return response()->json(['updated' => 'Data successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SocietyRegistration::findOrFail($id)->delete();
    }

    /**
     * Custom function to overview the roster from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_states(Request $request)
    {   
        $state = State::where('country_id',$request->country_id)
        ->select('*')
        ->orderBy('id','ASC')
        ->get();
        return response()->json($state, 200);
    }

    /**
     * Custom function to overview the roster from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_cities(Request $request)
    {   
        $city = City::where('state_id',$request->state_id)
        ->select('*')
        ->orderBy('id','ASC')
        ->get();
        return response()->json($city, 200);
    }
}