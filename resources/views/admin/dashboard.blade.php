@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card-header">
            <h3 class="card-title">
                sales chart
            </h3>
        </div>
        <div class="card-body">
            <canvas class="chart" id="myChart" style="height: 250px">

            </canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-header">
            <h3 class="card-title">
                Latest transaction
            </h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product</th>
                        <th>Trx_date</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $key => $value)
                    <tr>
                        <td>{{ ($key+1)}}</td>
                        <td>{{ $value->product->name}}</td>
                        <td>{!! $value->dateFormat ()   !!}</td>
                        <td>{!! $value->price ()   !!}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        var chart = document.getElementById('myChart').getContext('2d');
        var areachart = new Chart(chart, {
            type: 'line',
            data: {
                // json
                    labels:@json($months), // 'months'
                datasets: [{
                    label : 'Overall Sales',
                    data : @json($totals),
                    borderColor : 'blue',

                }
            ]
            }
        });
    </script>
@endsection
