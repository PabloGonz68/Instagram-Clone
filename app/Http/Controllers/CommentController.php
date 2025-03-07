<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use Carbon\Carbon;


class CommentController extends Controller
{
    public function crearComment(Request $request, $post_id)
    {
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = Auth::user()->id;// Asume que el usuario está autenticado
        $comment->post_id = $post_id;
        $comment->publish_date = Carbon::now();
        $comment->save();

        return redirect()->route('home');
        /* $validator = Validator::make($request->all(), [
             'comment' => 'required|max:255'
         ]);
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator);
         }
         $post = Post::findOrFail($request->post_id);

         Comment::create([
             'post_id' => $post_id,
             'user_id' => Auth::user()->id,
             'comment' => $request->comment,
         ]);

         return redirect()->route('post', ['id' => $post_id])->with('success', 'Comentario creado correctamente.');
     
     */
    }
}
