<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use DB;
use View;


class SettingsController extends Controller
{
   /**
    * Display a listing of the resource.
    *
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

      $settings = Setting::all();
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
    *
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
    * @return \Illuminate\Http\Response
    */
   public function show(Request $request, $id)
   {
      if ($request->ajax()) {
         $haspermision = auth()->user()->can('settings-view');
         if ($haspermision) {
            $settings = Setting::findOrFail($id);
            $view = View::make('backend.admin.setting.view', compact('settings'))->render();
            return response()->json(['html' => $view]);
         } else {
            abort(403, 'Sorry, you are not authorized to access the page');
         }
      } else {
         return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
      }
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int $id
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
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, Setting $setting)
   {
      //
      if ($request->ajax()) {
         $haspermision = auth()->user()->can('settings-create');
         if ($haspermision) {

            $settings = Setting::findOrFail($setting->id);
            $logo = $settings->logo;
            $favicon = $settings->favicon;
            $rules = [
              'name' => 'required',
              'eiin' => 'required',
              'email' => 'required|email|unique:settings,email,' . $setting->id,
              'contact' => 'required',
              'address' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
               return response()->json(['type' => 'error', 'errors' => $validator->getMessageBag()->toArray()]);
            } else {

               if ($request->hasFile('logo')) {
                  $extensionLogo = strtolower($request->file('logo')->getClientOriginalExtension());
                  if ($extensionLogo == "jpg" || $extensionLogo == "jpeg" || $extensionLogo == "png") {
                     if ($request->file('logo')->isValid()) {
                        $destinationLogoPath = public_path('assets/images/logo');
                        $logoName = time() . '.' . $extensionLogo; // renameing image
                        $logo = 'assets/images/logo/' . $logoName;
                        $request->file('logo')->move($destinationLogoPath, $logoName); // uploading file to given path

                     } else {
                        return response()->json([
                          'type' => 'error',
                          'message' => "<div class='alert alert-warning'>File is not valid</div>",
                        ]);
                     }
                  } else {
                     return response()->json([
                       'type' => 'error',
                       'message' => "<div class='alert alert-warning'>Error! File type is not valid</div>",
                     ]);
                  }
               }

               if ($request->hasFile('favicon')) {
                  $extensionFav = strtolower($request->file('favicon')->getClientOriginalExtension());
                  if ($extensionFav == "jpg" || $extensionFav == "jpeg" || $extensionFav == "png") {
                     if ($request->file('favicon')->isValid()) {
                        $destinationFavPath = public_path('assets/images/logo');
                        $fileFavName = time() . '.' . $extensionFav; // renameing image
                        $favicon = 'assets/images/logo/' . $fileFavName;
                        $request->file('favicon')->move($destinationFavPath, $fileFavName); // uploading file to given path

                     } else {
                        return response()->json([
                          'type' => 'error',
                          'message' => "<div class='alert alert-warning'>File is not valid</div>",
                        ]);
                     }
                  } else {
                     return response()->json([
                       'type' => 'error',
                       'message' => "<div class='alert alert-warning'>Error! File type is not valid</div>",
                     ]);
                  }
               }


               $settings->name = $request->input('name');
               $settings->slogan = $request->input('slogan');
               $settings->eiin = $request->input('eiin');
               $settings->pabx = $request->input('pabx');
               $settings->contact = $request->input('contact');
               $settings->stablished = $request->input('stablished');
               $settings->website = $request->input('website');
               $settings->reg = $request->input('reg');
               $settings->email = $request->input('email');
               $settings->address = $request->input('address');
               $settings->running_year = trim($request->input('running_year'));
               $settings->logo = $logo;
               $settings->favicon = $favicon;
               $settings->social_facebook = $request->input('social_facebook');
               $settings->social_twitter = $request->input('social_twitter');
               $settings->social_linkedin = $request->input('social_linkedin');
               $settings->social_google = $request->input('social_google');
               $settings->social_youtube = $request->input('social_youtube');
               $settings->layout = $request->input('layout');
               $settings->maps = $request->input('maps');
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
