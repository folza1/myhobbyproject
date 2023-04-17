@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Write in your weight!</div>

                <div class="card-body">
                    <form method="post" action="/home">
                        @csrf
                        <div>
                            <label for="weight">Weight:</label>
                            <input type="number" step="0.01" min="0" name="weight" id="weight" required class="form-control mb-3">
                        </div>
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #chartDiv{
        width: 65%;
        background: #f1f1f1;
    }
</style>
<div id="chartDiv" class="p-5 mx-auto mt-4 mb-4">
<canvas id="myChart"></canvas>
</div>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($weights->pluck('created_at')) !!},
            datasets: [{
                label: 'Weight',
                data: {!! json_encode($weights->pluck('weight')) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
@endsection
