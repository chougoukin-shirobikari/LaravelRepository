<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{asset('/css/app.css')}}" rel="stylesheet">
<title>BBS</title>
</head>
<body>
    <!-- メインコンテンツここから -->
    <div class="container">
        <div class="row vh-100 align-items-md-center justify-content-md-center">
            <div class="card" style="max-width: 600px;">
                <div class="card-body">
                    <h3 class="card-title mb-3 text-center">新規メッセージの投稿</h3>
                    <!-- エラーが発生した場合メッセージを表示 -->
                    @if(session('optimisticklockexception') === 'occur')
                    <div class="text-danger text-center mb-2">※エラーが発生したため投稿できませんでした</div>
                    @endif
                    <!-- 入力フォームここから -->
                    <form enctype="multipart/form-data" action="{{url('posting/createPosting', $thread->thread_id)}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="thread_version" value={{$thread->thread_version}}>
                            <input class="form-control" type="text" name="name" placeholder="名前を入力してください">
                            @if($errors->has('name'))
                            <div class="mt-3">
                                <div class="text-danger">{{$errors->first('name')}}</div>
                            </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="message" rows="4" cols="40" placeholder="メッセージを入力してください"></textarea>
                            @if($errors->has('message'))
                            <div class="mt-3">
                                <div class="text-danger">{{$errors->first('message')}}</div>
                            </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="file" name="image">
                            @if($errors->has('image'))
                            <div class="mt-3">
                                <div class="text-danger">{{$errors->first('image')}}</div>
                            </div>
                            @endif
                        </div>
                        <!-- クリックすると送信 -->
                        <button class="w-100 btn btn-primary text-white" type="submit">投稿する</button>
                        <div class="mb-3 text-center">
                            <a class="btn btn-link" href="{{url('posting/showPosting', $thread->thread_id)}}">戻る</a>
                        </div>
                    </form>
                    <!-- 入力フォームここまで -->
                </div>
            </div>
        </div>
    </div>
    <!-- メインコンテンツここまで -->
</body>
