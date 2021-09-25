<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}: @yield('title','...')</title>
    <style>html,body {width:100%; height:100%; overflow:hidden;}</style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/data2.css">
    @stack('css')
</head>

<body class="m-0">
    {{-- <div class='d-flex flex-column jestify-content-between min-vh-100'></div> --}}

    <table border='0' cellpadding='0' cellspacing='0' style='width:100%; height:100%;'>
        <tr height='1px'>
            <td>
                @include('includes.alert')
                @include('includes.header')
            </td>
        </tr>

        <tr><td align="@yield('page-align-h','left')" valign="@yield('page-align-v','top')" style="position: relative;">
                
                    <content class='flex-grow-1 py-3'>
                        @yield('content')
                    </content>
                
            </td>
        </tr>

        <tr height='1px'>
            <td>
                @include('includes.footer')
            </td>
        </tr>
    </table>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>
    @stack('js')

</body>

</html>
