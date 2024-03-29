@extends('admin.layout.master')

@section('content')
<div class="row">
    <div class="col-6">
        <div class="card p-2">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <div class="col-6">
        <div class="card p-2">
            <canvas id="inOut"></canvas>
        </div>
    </div>
    <div class="col-4">
        <div class="card p-2">
            <div class="d-flex justify-content-between p-2">
                <b>Latest Users</b>
                <a href="" class="btn btn-sm btn-primary">All</a>
            </div>

            <ul class="list-group">
                <li class="list-group-item">
                    <span>Mg Mg</span> <br>
                    <small class="text-muted">mgmg@a.com</small>
                </li>
                <li class="list-group-item">
                    <span>Mg Mg</span> <br>
                    <small class="text-muted">mgmg@a.com</small>
                </li>
                <li class="list-group-item">
                    <span>Mg Mg</span> <br>
                    <small class="text-muted">mgmg@a.com</small>
                </li>

            </ul>
        </div>

    </div>
    <div class="col-8">

    </div>
</div>
@endsection


@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: @json($orderDateArray),
        datasets: [{
          label: 'Last 6 month order',
          data: @json($orderData),
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // income outcome chart
    const inoutCtx = document.getElementById('inOut');

    new Chart(inoutCtx, {
    type: 'line',
    data: {
        labels: @json($inOutDates),
        datasets: [
            {
                label: 'Income',
                data: @json($incomeData),
                borderWidth: 1
            },
            {
                label: 'Outcome',
                data: @json($outcomeData),
                borderWidth: 1
            },

    ]
    },
    options: {
        scales: {
        y: {
            beginAtZero: true
        }
        }
    }
    });
</script>
@endsection