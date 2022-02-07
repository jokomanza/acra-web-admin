<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Application::query();
        if (request('search')) {
            $applications->where('name', 'Like', '%' . request('search') . '%');
        }

        $applications = $applications->paginate(5);

        return view('applications')->with('applications', $applications);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:application,name|min:3|max:20',
            'package_name' => 'required|unique:application,package_name|string|regex:/com.[a-z]{3,20}.[a-z]{3,20}$/',
        ]);

        if ($validator->fails()) {
            // get the error messages from the validator
            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return redirect()->route('application.index')
                ->withErrors($validator)
                ->withInput();
        }

        $app = new Application();
        $app->fill($request->all());
        $app->token = str_random(36);

        try {
            $app->save();
        } catch (\Throwable $th) {
            return redirect()->route('application.index')
                ->withErrors($th)
                ->withInput();
        }

        return redirect()->route('application.index')
            ->with('message', 'Application created successfully.');
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
    public function destroy(Request $request)
    {
        if (!$request->has('id')) {
            return redirect()->route('application.index')
                ->with('table-message', $request->id);
        }

        $app = Application::find($request->id);

        if (!isset($app)) {
            return redirect()->route('application.index')
                ->with('table-error', 'App with id ' . $request->id . ' not found, why you can do that?!');
        }

        try {
            $app->delete();
        } catch (\Exception $th) {
            return redirect()->route('application.index')
                // ->with('table-error', $th->getMessage());
                ->with('table-error', "Failed to delete the application, maybe this happens because there are still reports in this application, please check again, if you still can't, please contact the developers.");
        }

        return redirect()->route('application.index')
            ->with('table-message', 'Application successfully deleted.');
    }
}
