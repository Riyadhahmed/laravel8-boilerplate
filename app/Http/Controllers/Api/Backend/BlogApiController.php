<?php

namespace App\Http\Controllers\Api\Backend;

use App\Models\Blog;
use App\Http\Controllers\Api\ResponseController;
use Illuminate\Http\Request;

class BlogApiController extends ResponseController
{

    public function __construct()
    {
        $this->middleware('auth:admin_api')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $blogs = Blog::all();

        if ($blogs) {
            return $this->sendResponse($blogs, 'success');
        } else {
            return $this->sendError('No records have found');
        }

    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
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
    public function show($id)
    {
        $blogs = Blog::where('id', 1)->get();

        if ($blogs) {
            return $this->sendResponse($blogs, 'success');
        } else {
            return $this->sendError('No records have found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $haspermision = auth()->user()->can('blog-delete');
            if ($haspermision) {
                $blog = Blog::findOrFail($id);
                $blog->delete();
                return response()->json(['type' => 'success', 'message' => 'Successfully Deleted']);
            } else {
                abort(403, 'Sorry, you are not authorized to access the page');
            }
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }
}
