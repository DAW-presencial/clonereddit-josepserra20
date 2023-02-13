<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() :JsonResponse
    {

        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->get();

        return Response::json($posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form')->with([
            'title' => old('title'),
            'description' => old('description'),
            'content' => old('content'),
            'caducable' => old('caducable'),
            'comentable' => old('comentable'),
            'acceso' => old('acceso')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) :JsonResponse
    {
        // Lógica para almacenar la publicación
        $request->validate([
            'title' => 'required|min:10',
        ]);

        $post = new Post();
        $post->title = $request->get('title');
        $post->description = $request->get('description');
        $post->content = $request->get('content');
        $post->caducable = $request->get('caducable') ?? false;
        $post->acceso = $request->get('acceso') ?? false;
        $post->comentable = false;

        $user = Auth::user();
        $post->user_id = $user->id;
        $post->save();

        return Response::json($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) :JsonResponse
    {
        //
        $post = Post::find($id);

        return response()->json($post);
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
        if (Gate::denies('update-post', $id)) {
            abort(403, 'No tienes permiso para actualizar esta publicación.');
        }

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
