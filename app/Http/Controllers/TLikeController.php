<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TLike;

class TLikeController extends Controller
{
    /**
     * LIKE COUNT
     */
    public function likeIt(Request $request) {
        $post_id = $request->post_id;
        $reaction = $request->reaction;
        if($reaction == 1) {
            TLike::updateOrCreate(
                ['post_id' => $post_id, 'create_at' => date("Y-m-d H:i:s")],
                ['iine' => 1]
            );
        } else if($reaction == -1) {
            TLike::updateOrCreate(
                ['post_id' => $post_id, 'create_at' => date("Y-m-d H:i:s")],
                ['iine' => 0]
            );
        }

        return response()->json(['post_id' => $post_id, 'reaction' => $reaction]);
    }
}
