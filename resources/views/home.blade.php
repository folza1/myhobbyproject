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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Write in your weight!</div>

                    <div class="card-body">
                        <form method="post" action="/home">
                            @csrf
                            <div>
                                <label for="weight">Weight:</label>
                                <input type="number" step="0.01" min="0" name="weight" id="weight" required
                                       class="form-control mb-3" autofocus>
                            </div>
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* set the #chartDiv width to 100% under 700px screen */
        #chartDiv {
            background: #f1f1f1;
        }

        @media screen and (max-width: 700px) {
            #chartDiv {
                width: 100%;
            }
        }
    </style>
    <div class="container">
        <div id="chartDiv" class="mx-auto mt-4 mb-4 col-md-10">
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <script>

        var ctx = document.getElementById('myChart').getContext('2d');
        var chart;

        function createChart() {
            if (chart) {
                chart.destroy(); // destroy existing chart instance
            }
            chart = new Chart(ctx, {
                // updated chart configuration
                type: 'line',
                data: {
                    labels: {!! json_encode($weights->pluck('created_at')->map(function ($date) { return \Carbon\Carbon::parse($date)->format('D M d'); })) !!},
                    datasets: [{
                        label: 'Weight',
                        data: {!! json_encode($weights->pluck('weight')) !!},
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'green',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            type: 'category'
                        }]
                    }
                }
            });
        }

        // function to refresh chart on window resize
        function refreshChart() {
            createChart();
        }

        // add event listener for window resize
        window.addEventListener('resize', refreshChart);

        // create chart on page load
        window.addEventListener('load', createChart);
    </script>
@endsection
