<?php

namespace App\Http\Controllers;

use App\Models\EmailRecipient;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
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
        $emails = EmailRecipient::paginate(5);
        return view('setting.main')->with('emails', $emails);
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
            'email' => 'required|unique:email_recipients,email|email',
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            // get the error messages from the validator
            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return redirect()->route('setting.index')
                ->withErrors($validator)
                ->withInput();
        }

        $email = new EmailRecipient();
        $email->fill($request->all());
        $email->email = $request->email;

        try {
            $email->save();
        } catch (\Throwable $th) {
            return redirect()->route('setting.index')
                ->withErrors($th)
                ->withInput();
        }

        return redirect()->route('setting.index')
            ->with('message', 'Email added successfully.');
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showLogs(Request $request)
    {
        $date = new Carbon($request->get('date', Carbon::now()));

        $filePath = storage_path("logs/laravel-{$date->format('Y-m-d')}.log");

        $data = [];

        if (File::exists($filePath)) {
            $data = [
                'lastModified' => DateTime::createFromFormat("U", File::lastModified($filePath))->setTimezone(new DateTimeZone('Asia/Jakarta')),
                'size' => File::size($filePath),
                'file' => File::get($filePath)
            ];
        }

        return view('setting.logs', compact('date', 'data'));
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
        if (!$request->has('email')) {
            return redirect()->route('setting.index')
                ->withErrors('Email not found');
        }

        $email = EmailRecipient::find($request->email);

        if (!isset($email)) {
            return redirect()->route('setting.index')
                ->withErrors('Email ' . $request->id . ' not found, why you can do that?!');
        }

        if ($request->email == 'joko_supriyanto@quick.com') {
            return redirect()->route('setting.index')
                ->withErrors("You can't delete this email ^_^")
                ->withInput();
        }

        try {
            $email->delete();
        } catch (\Exception $th) {
            return redirect()->route('setting.index')
                ->withErrors("Failed to delete the email.");
        }

        return redirect()->route('setting.index')
            ->with('message', 'Email successfully deleted.');
    }
}
