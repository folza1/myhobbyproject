@section('contentError')
    @if(Session::has('failed_message'))
        <div id="failed-alert" class="alert alert-warning alert-dismissible fade show text-center m-0" role="alert">
            {{ Session::get('failed_message') }}
        </div>
        <script>
            $(document).ready(function () {
                // Delay the alert hide for 5 seconds
                setTimeout(function () {
                    $("#failed-alert").alert('close');
                }, 3000);

                // Close the alert when the close button is clicked
                $("#failed-alert").on('click', function () {
                    $("#failed-alert").alert('close');
                });
            });
        </script>
    @endif
@endsection

@extends('layouts.app')

@section('content')
<h1>Hello World!</h1>
@endsection

