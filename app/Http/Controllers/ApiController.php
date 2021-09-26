<?php // php artisan make:controller ApiController --resource

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function axios(Request $request)
    {
        //$data = json_decode($request->getContent());
        return response()->json([
            'status' => true,
            'module' => $request->module,
            'data' => \App\Http\Controllers\ModuleController::getData($request->module, 'api'),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request->all());

        // for api
        // $validator = Validator::make(
        //     $request->all(),
        //     [
        //         'login' => ['required', 'string'],
        //         'password' => ['required'],
        //     ],
        // );
        // if ($validator->fails()) {
        // return response()->json([
        //     'status'=>false,
        //     'errors'=> $validator->messages(),
        // ]);
        // }
        // $post = Post::create([
        //     'title'=>$request->title,
        // ]);
        // return response()->json([
        //     'status'=>true,
        //     'post'=>$post,
        // ]);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // http://data2.test/api/module/{id}
    {
        // $post = Post::find($id);
        // if (!$post) return response()->json([
        //     'status' => false,
        //     'errors' => 'Post id not found',
        // ])->setStatusCode(404);
        // return $post;
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