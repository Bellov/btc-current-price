@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            @if(session()->has('message'))
            <p class="alert alert-success"> {{ session()->get('message') }}</p>
            @endif

        <div class="alert alert-danger text-center dangerAlert" role="alert"></div>
          <div class="alert alert-success text-center notifyAlert" role="alert"></div>

            <div class="card">
                <div class="card-header text-center">{{ __('Dashboard') }}</div>
                    <h1 class="text-center">BTC price tracker</h1>
                </div>

                @foreach($btcPrice as $key => $price)
                @endforeach

                <div>
                    <canvas id="myChart"></canvas>
                  </div>

                  <form method="POST" action="{{ route('notifyUser') }}" role="form" class="form-horizontal">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="email" class="form-control" id="userEmail" aria-describedby="emailHelp" placeholder="Enter email" name="userEmail">
                            </div>
                            <hr>
                            <div class="col">
                                <input type="number" class="form-control" placeholder="Enter price" id="btcPrice" name="btcPrice">
                            </div>
                            <hr>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                  value="{{$notifiedStatus}}"
                                  selected
                                  @if ($notifiedStatus) checked="checked"
                                     @else
                                      value="0"
                                   @endif
                                id="notify">
                                <label class="form-check-label" for="defaultCheck1">
                                Email Notify
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
                  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                  <script>
                    const ctx = document.getElementById('myChart');
                    new Chart(ctx, {
                      type: 'line',
                      data: {
                        labels: ['Lowest Price',' Highest price'],
                        datasets: [{
                          label: 'BTC price',
                          data: [
                            {{number_format((float)$price->low, 2, '.', '')}},
                            {{number_format((float)$price->high, 2, '.', '')}},
                        ],
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
                  </script>
            </div>
        </div>
    </div>
</div>
@endsection
