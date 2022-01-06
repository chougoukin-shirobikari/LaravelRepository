<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{asset('/css/app.css')}}" rel="stylesheet">
<title>BBS</title>
</head>
<body>
    @php
    $status_code = $exception->getStatusCode();
    $message = $exception->getMessage();
    if(! $message){
        switch($status_code){
            case 400:
                $message = 'Bad Request';
                break;
            case 401:
                $message = '認証に失敗しました';
                break;
            case 403:
                $message = 'アクセス権がありません';
                break;
            case 404:
                $message = '存在しないページです';
                break;
            case 408:
                $message = 'タイムアウトです';
                break;
            case 419:
                $message = '不正なリクエストです';
                break;
            case 500:
                $message = 'Internal Server Error';
                break;
            case 503:
                $message = 'Service Unavailable';
                break;
            default:
                $message = 'エラーが発生しました';
                break;
        }
    }
    @endphp
    <!-- メインコンテンツここから -->
    <div class="container">
        <div class="row vh-100 align-items-md-center justify-content-md-center">
            <div class="jumbotron" style="max-width: 600px;">
                <div id="heading" class="mb-4 mt-5 mt-md-0 display-1 text-center">{{$status_code}}</div>
                <div class="text-center mb-4">
                    <div class="text-danger">{{$message}}</div>
                </div>
                <div class="text-center">
                    <a class="btn btn-primary rounded-pill text-white" href="{{url('TopPage')}}">Topページに戻る</a>
                </div>
            </div>
        </div>
    </div>
    <!-- メインコンテンツここまで -->
    <script src="{{asset('/js/app.js')}}"></script>
</body>
</html>
