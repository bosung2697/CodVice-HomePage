<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>어드민 페이지</h2>
        <p>부트스트랩 템플릿</p>
        <table class="table table-hover">
            <tbody>
            <tr>
                <td><a href="{{ url('admin/create') }}" style="color:black; text-decoration: none;">소개글 입력하기</a></td>
            </tr>
            <tr>
                <td><a href="{{ url('admin/1/edit') }}" style="color:black; text-decoration: none;">소개글 수정하기</a></td>
            </tr>
            </tbody>
        </table>
    </div>
</body>
