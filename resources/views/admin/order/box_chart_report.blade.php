<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-value-lg" id="totalRevenue">0 {{ config('constant.PRICE_UNIT') }}</div>
                        <div><i class="icon fa fa-money"></i> {{ trans('sale_order.report.total_revenue') }}</div>
                        <div class="progress progress-xs my-2">
                            <div class="progress-bar bg-gradient-success" role="progressbar"
                                 style="width: 100%"
                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-value-lg" id="totalRevenue7day">0 {{ config('constant.PRICE_UNIT') }}</div>
                        <div><i class="icon fa fa-money"></i> {{ trans('sale_order.report.total_revenue_7day') }}
                        </div>
                        <div class="progress progress-xs my-2">
                            <div class="progress-bar bg-gradient-primary" role="progressbar"
                                 style="width: 50%"
                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-value-lg" id="totalOrderCompleted">0</div>
                        <div>
                            <i class="nav-icon fa fa-shopping-cart"></i> {{ trans('sale_order.report.total_order_completed') }}
                        </div>
                        <div class="progress progress-xs my-2">
                            <div class="progress-bar bg-gradient-info" role="progressbar"
                                 style="width: 70%"
                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-value-lg" id="totalOrderNew">0</div>
                        <div>
                            <i class="nav-icon fa fa-shopping-cart"></i> {{ trans('sale_order.report.total_order_news') }}
                        </div>
                        <div class="progress progress-xs my-2">
                            <div class="progress-bar bg-gradient-success" role="progressbar"
                                 style="width: 30%"
                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- chart -->
        <div class="row">
            <div class="col-lg-12">
                <div class="chart-data" id="chart-data"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function () {
    let title_main = '{{ trans('sale_order.report.title_main') }}';
    let title_order = '{{ trans('sale_order.report.title_order') }}';
    let title_total = '{{ trans('sale_order.report.title_total') }}';
    $.ajax({
      url: '{{ admin_url('orders/get-report') }}',
      dataType: 'json',
      success: function (result) {
        $('#totalRevenue').text(result.total_revenue);
        $('#totalRevenue7day').text(result.total_revenue_7day);
        $('#totalOrderNew').text(result.total_order_new);
        $('#totalOrderCompleted').text(result.total_order_completed);

        Highcharts.chart('chart-data', {
          chart: {
            zoomType: 'xy'
          },
          title: {
            text: title_main
          },
          subtitle: {
            text: 'Source: {{ $config['company_name'] }}'
          },
          xAxis: [{
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            crosshair: true
          }],
          yAxis: [
            {
              labels: {
                format: '',
                style: {
                  color: Highcharts.getOptions().colors[1]
                }
              },
              title: {
                text: title_order,
                style: {
                  color: Highcharts.getOptions().colors[1]
                }
              }
            },
            {
              title: {
                text: title_total,
                style: {
                  color: Highcharts.getOptions().colors[0]
                }
              },
              labels: {
                format: '{value} {{ config('constant.PRICE_UNIT') }}',
                style: {
                  color: Highcharts.getOptions().colors[0]
                }
              },
              opposite: true
            }
          ],
          tooltip: {
            shared: true
          },
          legend: {
            layout: 'vertical',
            align: 'left',
            x: 120,
            verticalAlign: 'top',
            y: 100,
            floating: true,
            backgroundColor:
              Highcharts.defaultOptions.legend.backgroundColor || // theme
              'rgba(255,255,255,0.25)'
          },
          series: [{
            name: title_total,
            type: 'column',
            yAxis: 1,
            data: result.total,
            tooltip: {
              valueSuffix: ' {{ config('constant.PRICE_UNIT') }}'
            }
          }, {
            name: title_order,
            type: 'spline',
            data: result.totalOrder,
          }]
        });
      },
      cache: false
    });
  });
</script>
