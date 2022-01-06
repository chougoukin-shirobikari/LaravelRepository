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
                    <h3 class="card-title mb-3 text-center">コメントの作成</h3>
                    <!-- エラーが発生した場合にメッセージを表示 -->
                    @if(session('optimisticklockexception') === 'occur')
                    <div class="text-danger text-center mb-2">※エラーが発生したためコメントできませんでした</div>
                    @endif
                    <!-- 入力フォームここから -->
                    <form action="{{url('reply/createReply', $posting->posting_id)}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="posting_version" value={{$posting->posting_version}}>
                            <input class="form-control" type="text" name="name" placeholder="名前を入力してください">
                            @if($errors->has('name'))
                            <div class="mt-3">
                                <div class="text-danger">{{$errors->first('name')}}</div>
                            </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="reply_message" rows="4" cols="40" placeholder="コメントを入力してください"></textarea>
                            @if($errors->has('reply_message'))
                            <div class="mt-3">
                                <div class="text-danger">{{$errors->first('reply_message')}}</div>
                            </div>
                            @endif
                        </div>
                        <!-- クリックすると送信 -->
                        <button class="w-100 btn btn-primary text-white" type="submit">コメントする</button>
                    </form>
                    <!-- 入力フォームここまで -->
                    <div class="mb-3 text-center">
                        <a class="btn btn-link" href="{{url('posting/showPosting', $posting->thread_id)}}">戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- メインコンテンツここから -->
</body>
