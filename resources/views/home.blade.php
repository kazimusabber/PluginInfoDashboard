@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $name ?? '' }}

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-2">
                            <a href="{{url('plugin/woocommerce')}}" class="btn btn-info">WooCommerce</a>
                        </div>
                        <div class="col-12 col-md-2">
                            <a href="{{url('plugin/contact-form-7')}}" class="btn btn-info">Contact Form 7</a>
                        </div>
                        <div class="col-12 col-md-2">
                            <a href="{{url('plugin/classic-editor')}}" class="btn btn-info">Classic Editor</a>
                        </div>
                        <div class="col-12 col-md-2">
                            <a href="{{url('plugin/yoast-seo')}}" class="btn btn-info">Yoast SEO</a>
                        </div>
                    </div>
                    <form action="{{url('changestatus')}}" method="post" class="mt-3">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <div class="input-group">
                                    <input type="date" name="startdate" class="form-control" placeholder="Start Date" required value="{{ $start_date ?? '' }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="input-group date">
                                    <input type="date" name="enddate" class="form-control" placeholder="End Date" required value="{{$end_date ?? ''}}">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="input-group">
                                    <select name="pluginname" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="1" @if($pluginid == 1){{"selected"}}@endif>WooCommerce</option>
                                        <option value="2" @if($pluginid == 2){{"selected"}}@endif>Contact Form 7</option>
                                        <option value="3" @if($pluginid == 3){{"selected"}}@endif>Classic Editor</option>
                                        <option value="4" @if($pluginid == 4){{"selected"}}@endif>Yoast SEO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="input-group">
                                   <button class="btn btn-primary w-100">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>ACTIVE / INACTIVE</h5>
                            <canvas id="activeChart" width="400" height="150"></canvas>
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
var ctx = document.getElementById('activeChart').getContext('2d');;
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo $downloadkey ?? '';?>,
        datasets: [
        {
            label: 'Inactive Install',
            data: <?php echo $inactive ?? '';?>,
            backgroundColor: [
                'rgb(0,206,209)',
                
            ],
            borderColor: [
                'rgb(0,206,209)',
                
            ],
            borderWidth: 1
        },
        {
            label: 'Active Install',
            data: <?php echo $downloadvalue ?? ''; ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 1
        }
        ]
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
</script>
@endsection
