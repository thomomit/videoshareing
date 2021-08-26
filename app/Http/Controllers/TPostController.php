<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TPost;
use App\Models\TLike;
use Illuminate\Support\Facades\DB;

use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class TPostController extends Controller
{
    /**
     * TOP
     */
    public function top() {
        return view('top');
    }

    /**
     * VIDEO POST
     */
    public function post(){
        return view('post');
    }

    /**
     * COMBINE DATAS
     */
	public function video_combine(Request $request){

        $file_place = config('app.video').$request->name;
        $file = $_FILES['file'];

        try {
            file_put_contents($file_place, file_get_contents($file['tmp_name']), FILE_APPEND);
        }
        catch (\Exception $ex) {
            echo json_encode(['err' => $ex]);
            return;
        }

        echo json_encode(['size' => filesize($file_place)]);
    }

    /**
     * SAVE THE COMBINED VIDEO TO DB
     */
    public function video_save(Request $request){

        $file_place = config('app.video').$request->name;

		if($file_place){
            $title = $request->name;
            $create_at = date("Y-m-d H:i:s");
            $team =$request->team;
            $view_mode =$request->view_mode;
			$tpost = TPost::create([
                "title" => $title,
                "video_path" => $file_place,
                "create_at" => $create_at,
                "team" => $team,
                "view_mode" => $view_mode,
            ]);
            $this->convertVideoFunc($title, $tpost->id);
		}
        return redirect('/mypage');
	}

    /**
     * VIDEO MANAGE
     */
    public function manage(){

        $likes = TLike::select(
            'post_id',
            DB::raw('SUM(iine) as iine_count'),
            )
            ->groupBy('post_id');

       
            $upload_files_query = DB::table('t_post')
                ->leftJoinSub($likes, 't_like', function ($join) {
                    $join->on('t_post.id', '=', 't_like.post_id');
                })
                ->where(function($q){
                    $q->where('t_post.delete_flg', '=', null)
                      ->orWhere('t_post.delete_flg', '=', 0);
                })
            ->get();

            return view("/manage",[
                "videos" => $upload_files_query
            ]);
    }

    /**
     * VIDEO EDIT
     */
    public function edit($post_id)
    {
        $post = TPost::findOrFail($post_id);
       
        return view('edit', ['post' => $post]);
    }

    /**
     * VIDEO UPDATE
     */
    public function tryUpdate(Request $request)
    {
        $savedata = [    
            "create_at" =>  $request->create_at,
            "edit_at" =>  date("Y-m-d H:i:s"),
            "team" => $request->team,
            "view_mode" => $request->view_mode,
            "title" => $request->title,
        ];
        $post = TPost::findOrFail($request->id);

        $post->forceFill($savedata)->save();

        return redirect('/manage');
    }

    /**
     * VIDEO DELETE
     */
    public function tryDelete($post_id)
    {
        $post = TPost::findOrFail($post_id);

        $post->forceFill(["delete_flg" => true])->save();

        return redirect('/manage');
    }

    /**
     * VIEW COUNT
     */
    public function view(Request $request)
    {
        $data = $request->all();
        $video_id = $data['video_id'];
        $video = TPost::findOrFail($video_id);
        $count = $video->view_count + 1;

        $video->forceFill(["view_count" => $count])->save();
    }

    /**
     * MAKE THUMNAME(NEW ONE)
     * @$fileName   File Name
     */
    public function convertVideo(Request $request) {
        echo "OK";
        return $this->convertVideoFunc($request->src, $request->pid);
    }

    public function convertVideoFunc($src, $pid) {
        try {
            $fileName = $src;
            mb_internal_encoding("UTF-8");
            $sp = explode('-', $fileName, 2);
            if(count($sp) < 1) { return; }
            $fname = $sp[0];

            // FFMpeg
            $fmt = new \FFMpeg\Format\Video\X264('aac');
            $fmt->setKiloBitrate(500);
            FFMpeg::fromDisk('video')
                ->open($fileName)
                ->export()
                ->onProgress(function ($percentage) {
                    echo "{$percentage}% transcoded";
                })
                ->resize(660, 370, 'height')
                ->toDisk('convert')
                ->inFormat($fmt)
                ->save($fname.".mp4")
                ->getFrameFromSeconds(2)
                ->export()
                ->toDisk('convert')
                ->save($fname.".jpg")
                ;

            // SAVE TO DB
            TPost::where('id', $pid)
                ->update(['thumbnail' => $fname.".jpg", 'converted' => $fname.".mp4"]);

        } catch(\Exception $ex) {
            TPost::where('id', $pid)->where('title', $src)
                ->update(['view_mode' => 0
                    , 'error_comment' => 'Faild. Uploaded videos should be played on Windows Media Player. This will not be Public.'
                    , 'thumbnail' => null
                    , 'converted' => null
                ]);
            return "NG";
        }
        return "OK";
    }

    /**
     * MAKE THUMNAME(ALL)
     * @$fileName   File name
     */
    public function convertAllVideo(Request $request) {
        
        // 全ポストデータ取得
        $posts = DB::table('t_post')->where('event_id', '<', 8)->get();
        $all = count($posts);

        $i = 1;
        foreach($posts as $post) {
            echo(" - id : ".$post->id);
            try {
                $fileName = $post->title;
                mb_internal_encoding("UTF-8");
                $sp = explode('-', $fileName, 2);
                if(count($sp) < 1) { return; }
                $fname = $sp[0];

                // FFMpeg
                $fmt = new \FFMpeg\Format\Video\X264('aac');
                $fmt->setKiloBitrate(500);
                $video = FFMpeg::fromDisk('convert')
                    ->open($fname.".mp4")
                    ->export()
                    ->toDisk('convert')
                    ->inFormat($fmt)
                    ->save($fname."-2.mp4");
                TPost::where('id', $post->id)
                    ->update(['thumbnail' => $fname.".jpg", 'converted' => $fname."-2.mp4", 'error_comment' => '']);
               
                echo(" ... OK<br>");

            } catch(\Exception $ex) {
                echo " ... NG<br>";
            }
        }
        return "OK";
    }

    /**
     * VIDEO LIST
     */
    public function list(Request $request) {

        $likes = TLike::select(
            'post_id',
            DB::raw('SUM(iine) as iine_count'),
            )
            ->groupBy('post_id');

        $key = $request->input('search');

        $query = DB::table('t_post');
        $query
            ->leftJoinSub($likes, 't_like', function ($join) {
                $join->on('t_post.id', '=', 't_like.post_id');
            });

            if ($request->has('search') && $key != '') {
                $query->where(function($query) use ($key) {
                    $query->where('team', 'like', '%'.$key.'%');
                })
                ->where('view_mode', '=', 1)
                ->where(function($query) {
                    $query->where('t_post.delete_flg', '=', null)
                    ->orWhere('t_post.delete_flg', '=', 0);
                });
            } else {
                $query
                ->where('view_mode', '=', 1)
                ->where(function($query) {
                    $query->where('t_post.delete_flg', '=', null)
                    ->orWhere('t_post.delete_flg', '=', 0);
                });
            }

        $data = $query->get();

        return view("list",[
            "videos" => $data
        ]);
    }
}
