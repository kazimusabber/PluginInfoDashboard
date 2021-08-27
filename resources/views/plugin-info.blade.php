@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $pluginname ?? '' }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>ACTIVE VERSIONS</h5>
                            <canvas id="version" width="400" height="400"></canvas>
                        </div>
                        <div class="col-md-6">
                            <h5>DOWNLOADS PER DAY</h5>
                            <canvas id="firstChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>DOWNLOADS HISTORY</h5>
                            <table class="table table-striped">
                                <tr>
                                    <td>Today</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Yesterday</td>
                                    <td align="right">{{ number_format($yesterdaydownload) }}</td>
                                </tr>
                                <tr>
                                    <td>Last 7 Days</td>
                                    <td align="right">{{ number_format($lastsevendaydownload) }}</td>
                                </tr>
                                <tr>
                                    <td>All Time</td>
                                    <td align="right">{{ number_format($alltimedownload) }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <table class="table table-striped">
                                <tr>
                                    <td>Version</td>
                                    <td  align="right">{{$info['version'] ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Last updated:</td>
                                    <td align="right">{{$info['last_updated'] ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Active installations:</td>
                                    <td align="right">{{$info['downloaded'] ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>WordPress Version:</td>
                                    <td align="right">{{$info['requires'] ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Tested up to:</td>
                                    <td align="right">{{$info['tested'] ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>PHP Version:</td>
                                    <td align="right">{{$info['requires'] ?? ''}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
var ctx = document.getElementById('firstChart').getContext('2d');;
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo $downloadkey ?? '';?>,
        datasets: [{
            label: 'Downloads',
            data: <?php echo $downloadvalue; ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
    animations: {
      tension: {
        duration: 1000,
        easing: 'linear',
        from: 1,
        to: 0,
        loop: true
      }
    },
    scales: {
      y: { // defining min and max so hiding the dataset does not change scale range
        min: 0,
        max: 100
      }
    }
  }
});


var ctx = document.getElementById('version').getContext('2d');;
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: <?php echo $versionkey ?? '';?>,
        datasets: [{
            data: <?php echo $versionvalue; ?>,
            backgroundColor: [
                'rgb(51, 102, 204)',
                'rgb(220, 57, 18)',
                'rgb(128, 128, 128)',
                'rgb(16, 150, 24)',
                'rgb(153, 0, 153)',
                'rgb(255, 159, 64)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
      }
    }
  },
});
</script>
@endsection