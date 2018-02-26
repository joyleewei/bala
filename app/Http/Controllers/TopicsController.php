<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use Auth;

use App\Handlers\UploadHandler;

class TopicsController extends Controller{

    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show','up','think_up']]);
    }

	public function index(Request $request,Topic $topic){
		$topics = Topic::withOrder($request->order)->paginate(30);
		return view('topics.index', compact('topics'));
	}

    public function show(Request $request,Topic $topic){
        // URL 矫正
        if(!empty($topic->slug) && $topic->slug != $request->slug){
            return redirect($topic->link(),301);
        }
        return view('topics.show', compact('topic'));
    }

	public function create(Topic $topic){
        $categories = Category::all();
		return view('topics.create_and_edit', compact('topic','categories'));
	}
    // 更新
	public function store(TopicRequest $request,Topic $topic){
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();

        // return redirect()->route('topics.show', $topic->id)->with('message', '创建成功');
        return redirect()->to($topic->link())->with('message', '创建成功');
	}

	public function edit(Topic $topic){
        $categories = Category::all();
        $this->authorize('update', $topic);
		return view('topics.create_and_edit', compact('topic','categories'));
	}

	public function update(TopicRequest $request, Topic $topic){
		$this->authorize('update', $topic);
		$topic->update($request->all());

		// return redirect()->route('topics.show', $topic->id)->with('message', '更新成功');
		return redirect()->to($topic->link())->with('message', '更新成功');
	}

	public function destroy(Topic $topic){
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('message', '删除成功!');
	}

    // 上传图片
    public function uploadImage(Request $request,ImageUploadHandler $uploader){
        // 初始化返回数据，默认是失败的
        $data = [
            'success' => false,
            'msg' => '上传失败',
            'file_path' => ''
        ];

        // 判断是否有上传文件，并赋值给$file
        if($file = $request->upload_file){
            // 保存图片到本地
            $result = $uploader->save($request->upload_file,'topics',\Auth::id(),1024);
            // 图片保存成功的话
            if($result){
                $data['file_path'] = $result['path'];
                $data['msg'] = '上传成功';
                $data['success'] = true;
            }
        }
        return $data;
    }

    public function up(){
        return view('topics.up');
    }

    public function think_up(){
        $savepath=date('Ymd').'/';
        $config=array(
            // /home/centos/public_html/bala/public/uploads
            'rootPath' => public_path('uploads'),
            'savePath' => '/'.$savepath,
            'maxSize' => 11048576,
            'saveName'   =>    array('uniqid',''),
            'exts'       =>    array('jpg','gif','png','jpeg'),
            'autoSub'    =>    false,
        );

        $upload = new UploadHandler($config);
        $info = $upload->upload();
        //开始上传
        if ($info){
            //上传成功
            //写入附件数据库信息
            $first=array_shift($info);
            if(!empty($first['url'])){
                $url=$first['url'];
            }else{
                $url = '/update/'.$first['savepath'].$first['savename'];
            }
            $data = array(
                'status'=>'success',
                'url' => $url,
                'name'=>$first['name']

            );
        } else {
            //上传失败，返回错误
            $data = array(
                'status'=>'error',
                'error'=>$upload->getError()
            );

        }
    }
}