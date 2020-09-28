<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use DB;
use View;


class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.admin.setting.index');
    }

    public function getAll()
    {

        $can_edit = $can_delete = '';
        if (!auth()->user()->can('settings-edit')) {
            $can_edit = "style='display:none;'";
        }
        if (!auth()->user()->can('settings-delete')) {
            $can_delete = "style='display:none;'";
        }

        $settings = Setting::get();
        return DataTables::of($settings)
            ->addColumn('layout', function ($settings) {
                return $settings->layout ? '<span class="label label-success">Fullwidth</span>' : '<span class="label label-danger">Boxed</span>';
            })
            ->addColumn('action', function ($settings) use ($can_edit, $can_delete) {
                $html = '<div class="btn-group">';
                $html .= '<a data-toggle="tooltip"  id="' . $settings->id . '" class="btn btn-xs btn-success margin-r-5 view" title="View"><i class="fa fa-eye fa-fw"></i> </a>';
                $html .= '<a data-toggle="tooltip" ' . $can_edit . '  id="' . $settings->id . '" class="btn btn-xs btn-primary margin-r-5 edit" title="Edit"><i class="fa fa-edit fa-fw"></i> </a>';
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['action', 'layout'])
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $settings = Setting::findOrFail($id);
            $view = View::make('backend.admin.setting.view', compact('settings'))->render();
            return response()->json(['html' => $view]);
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Setting $setting)
    {
        if ($request->ajax()) {
            $haspermision = auth()->user()->can('settings-create');
            if ($haspermision) {
                $settings = Setting::findOrFail($setting->id);
                $view = View::make('backend.admin.setting.edit', compact('settings'))->render();
                return response()->json(['html' => $view]);
            } else {
                abort(403, 'Sorry, you are not authorized to access the page');
            }
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
        if ($request->ajax()) {
            $haspermision = auth()->user()->can('settings-create');
            if ($haspermision) {

                $settings = Setting::findOrFail($setting->id);
                $old_file = $settings->logo;
                $rules = [
                    'name' => 'required',
                    'email' => 'required|email|unique:settings,email,' . $setting->id,
                    'contact' => 'required',
                    'address' => 'required',
                    'logo' => 'image|max:2024|mimes:jpeg,jpg,png'
                ];
                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    return response()->json(['type' => 'error', 'errors' => $validator->getMessageBag()->toArray()]);
                } else {

                    if ($request->hasFile('logo')) {
                        if ($request->file('logo')->isValid()) {
                            $destinationPath = public_path('assets/images/logo');
                            $extension = $request->file('logo')->getClientOriginalExtension();
                            $fileName = time() . '.' . $extension;
                            $file_path = 'assets/images/logo/' . $fileName;
                            $request->file('logo')->move($destinationPath, $fileName);
                            File::delete($old_file); //unlink($old_file);
                        } else {
                            return response()->json([
                                'type' => 'error',
                                'message' => "<div class='alert alert-warning'>Please! File is not valid</div>"
                            ]);
                        }

                    } else {
                        $file_path = $old_file;
                    }

                    $settings->name = $request->input('name');
                    $settings->slogan = $request->input('slogan');
                    $settings->contact = $request->input('contact');
                    $settings->stablished = $request->input('stablished');
                    $settings->website = $request->input('website');
                    $settings->reg = $request->input('reg');
                    $settings->email = $request->input('email');
                    $settings->address = $request->input('address');
                    $settings->running_year = trim($request->input('running_year'));
                    $settings->logo = $file_path;
                    $settings->layout = $request->input('layout');
                    $settings->created_at = Carbon::now();
                    $settings->updated_at = Carbon::now();
                    $settings->save();
                    return response()->json(['type' => 'success', 'message' => "Successfully Updated"]);
                }

            } else {
                abort(403, 'Sorry, you are not authorized to access the page');
            }
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Setting $setting)
    {
        if ($request->ajax()) {
            $haspermision = auth()->user()->can('settings-delete');
            if ($haspermision) {
                $setting->delete();
                return response()->json(['type' => 'success', 'message' => 'Successfully Deleted']);
            } else {
                abort(403, 'Sorry, you are not authorized to access the page');
            }
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }
}
