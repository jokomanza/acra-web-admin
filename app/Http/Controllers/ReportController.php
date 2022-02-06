<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function indexApi()
    {
        $data = Report::all();

        return response()->json($data, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Report::query()
            ->select(
                [
                    DB::raw('DISTINCT exception'),
                    'package_name', 'app_version_code',
                    'brand',
                    'phone_model',
                    DB::raw("count(*) as count"),
                    DB::raw("SUBSTRING(coalesce(to_char(created_at, 'MM-DD-YYYY HH24:MI:SS'), ''), 1, 10) as reported_at")
                ]
            )
            ->groupBy('exception')
            ->groupBy('package_name')
            ->groupBy('app_version_code')
            ->groupBy('brand')
            ->groupBy('phone_model')
            // ->groupBy('count')
            ->groupBy('reported_at')
            ->get();
        // return response($data);
        // $data = $data->paginate(5);

        return view('reports')->with('data', $data);
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


    private function array_change_key_case_recursive($arr)
    {
        return array_map(function ($item) {
            if (is_array($item))
                $item = $this->array_change_key_case_recursive($item);
            return $item;
        }, array_change_key_case($arr));
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
            'token' => 'required|string|exists:application,token',
            'report_id' => 'required|string',
            'app_version_code' => 'required|numeric',
            'app_version_name' => 'required|string',
            'package_name' => 'required|string',
            'file_path' => 'required|string',
            'phone_model' => 'required|string',
            'brand' => 'required|string',
            'product' => 'required|string',
            'android_version' => 'required|string',
            'build' => 'required|nullable',
            'total_mem_size' => 'required|string',
            'available_mem_size' => 'required|string',
            'build_config' => 'required|nullable',
            'custom_data.*' => 'required',
            'is_silent' => 'required|boolean',
            'stack_trace' => 'required|string',
            'exception' => 'required|string',
            'initial_configuration' => 'required',
            'crash_configuration' => 'required',
            'display' => 'required',
            'user_comment' => 'nullable|string',
            'user_email' => 'required|string',
            'user_app_start_date' => 'required|string',
            'user_crash_date' => 'required|string',
            'dumpsys_meminfo' => 'nullable|string',
            'logcat' => 'required|string',
            'installation_id' => 'required|string',
            'device_features' => 'required',
            'environment' => 'required|nullable',
            'shared_preferences' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $data = $this->array_change_key_case_recursive($request->all());

        $stacktrace = explode(PHP_EOL, $data['stack_trace']);
        foreach ($stacktrace as $line) {
            if (strpos($line, 'Caused by: ') === 0) {
                $data['exception'] = substr($line, strpos($line, ':') + 2);
                break;
            }
        }

        $crash = new Report();
        $crash->fill($data);

        $app = Application::where('token', $request->token)->first();
        $crash->application_id = $app->id;

        $crash->save();

        return response()->json($request->all(), 200);
    }

    public function showHeader(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_name' => 'required',
            'app_version_code' => 'required',
            'brand' => 'required',
            'phone_model' => 'required',
            'exception' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('reports');
        }
        $data = Report::where([
            'package_name' => $request->package_name,
            'app_version_code' => $request->app_version_code,
            'brand' => $request->brand,
            'phone_model' => $request->phone_model,
            'exception' => $request->exception
        ])->paginate(5)->appends(request()->except('page'));

        return view('report', $request->all())->with('data', $data);
    }

    public function showDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'report_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('reports');
        }
        $data = Report::where([
            'report_id' => $request->report_id
        ])->first();

        // return response($data);

        return view('report.detail', $data);
    }

    public function showFullReport($report_id)
    {

        if (!isset($report_id)) {
            abort(404);
        }

        $data = Report::where([
            'report_id' => $report_id
        ])->first();

        if (!isset($data)) {
            abort(404);
        }

        $data = json_decode($data);

        // return response($data);

        return view('report.full')->with('data', $data);
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
    public function destroy($id)
    {
        //
    }
}
