<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use View;
use DB;

class AdminController extends Controller
{

    public function index()
    {
        return view('backend.admin.admin.index');
    }

    public function allAdmin()
    {

        $can_edit = $can_delete = '';
        if (!auth()->user()->can('news-edit')) {
            $can_edit = "style='display:none;'";
        }
        if (!auth()->user()->can('news-delete')) {
            $can_delete = "style='display:none;'";
        }
        $roles = Role::pluck('name')->all();
        $users = Admin::get();
        return Datatables::of($users)
            ->addColumn('role', function ($user) use ($roles) {
                return $user->roles->pluck('name')->implode(',');
            })
            ->addColumn('action', function ($users) use ($can_edit, $can_delete) {
                $html = '<div class="btn-group">';
                $html .= '<a data-toggle="tooltip" ' . $can_edit . '  id="' . $users->id . '" class="btn btn-xs btn-info mr-1 edit" title="Edit"><i class="fa fa-edit"></i> </a>';
                $html .= '<a data-toggle="tooltip" ' . $can_delete . ' id="' . $users->id . '" class="btn btn-xs btn-danger delete" title="Delete"><i class="fa fa-trash"></i> </a>';
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['action', 'status'])
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = Auth::user();
        return view('backend.admin.admin.profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('backend.admin.admin.edit_profile', compact('user'));
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {

            $user = Admin::findOrFail(Auth::user()->id);

            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:admins,email,' . $user->id,
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'type' => 'error',
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            } else {

                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->save(); //
                return response()->json(['type' => 'success', 'message' => "Successfully Updated"]);

            }
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }

    public function change_password()
    {
        return view('backend.admin.admin.change_password');
    }

    public function update_password(Request $request)
    {
        if ($request->ajax()) {

            $user = Admin::findOrFail(Auth::user()->id);

            $rules = [
                'password' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'type' => 'error',
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            } else {
                $user->password = Hash::make($request->input('password'));
                $user->save(); //
                return response()->json(['type' => 'success', 'message' => "Successfully Updated"]);
            }
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }

    public function barcode()
    {
        return view('backend.admin.example.barcode');
    }

    public function passport()
    {
        return view('backend.admin.example.passport');
    }
}
