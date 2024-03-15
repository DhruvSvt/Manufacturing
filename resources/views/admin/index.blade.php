@extends('admin.layouts.app',['title'=>'Dashboard'])
@section('content')
<!-- ===== Main Content Start ===== -->
<main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
            <!-- Users Card Item Start -->
            <div
                class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2">
                   <i class="fas fa-users" style="color: #1f7dbf;"></i>
                </div>

                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">
                            {{ $users }}
                        </h4>
                        <span class="text-sm font-medium">Total no. of Users</span>
                    </div>
                </div>
            </div>
            <!-- Users Card Item End -->

            <!-- Product Card Item Start -->
            <div
                class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2">
                   <i class="fa-solid fa-warehouse" style="color: #1f7dbf;"></i>
                </div>

                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">
                            {{ $products }}
                        </h4>
                        <span class="text-sm font-medium">Total no. of Product</span>
                    </div>
                </div>
            </div>
            <!-- Product Card Item End -->

            <!-- Raw Material Card Item Start -->
            <div
                class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2">
                    <i class="fa fa-industry" aria-hidden="true" style="color: #1f7dbf;"></i>
                </div>

                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">
                            {{ $raw_materials }}
                        </h4>
                        <span class="text-sm font-medium">Total no. of Raw Material</span>
                    </div>

                </div>
            </div>
            <!-- Raw Material Card Item End -->

            <!-- Gift Card Item Start -->
            <div
                class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2">
                    <i class="fa-solid fa-gift" style="color: #1f7dbf;"></i>
                </div>

                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">
                            {{ $gifts }}
                        </h4>
                        <span class="text-sm font-medium">Total no. of Gifts</span>
                    </div>
                </div>
            </div>
            <!-- Gift Card Item End -->


        </div>

      <div
              class="mt-4 grid grid-cols-12 gap-4 md:mt-6 md:gap-6 2xl:mt-7.5 2xl:gap-7.5"
            >
              <!-- ====== Chart One Start -->
              <div
  class="col-span-12 rounded-sm border border-stroke bg-white px-5 pb-5 pt-7.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:col-span-12"
>
  <div class="flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">
    <div class="flex w-full flex-wrap gap-3 sm:gap-5">
      <div class="flex min-w-47.5">
        <span
          class="mr-2 mt-1 flex h-4 w-full max-w-4 items-center justify-center rounded-full border border-primary"
        >
          <span
            class="block h-2.5 w-full max-w-2.5 rounded-full bg-primary"
          ></span>
        </span>
        <div class="w-full">
          <p class="font-semibold text-primary">Last 30 Days Sale</p>

        </div>
      </div>

    </div>

  </div>
  <div class="p-4 flex-auto">
        <!-- Chart -->
        <div class="relative h-350-px">
          <canvas id="bar-chart" style="    height: 400px;"></canvas>
        </div>
      </div>
</div>
    </div>
</main>
<!-- ===== Main Content End ===== -->
@endsection
@section('scripts')
<script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      charset="utf-8"
    ></script>
<script type="text/javascript">

      (function () {
        /* Chart initialisations */
        /* Bar Chart */
        var config = {
          type: "bar",
          data: {
            labels: [
                 @foreach ($sale as $society)
                 "{{ date('d-m-Y', strtotime($society->date)) }}",
       @endforeach
            ],
            datasets: [
              {
                label: 'Sale',
                backgroundColor: "#1f7dbf",
                borderColor: "#1f7dbf",
                data: [  @foreach ($sale as $society)
                 {{ $society->sale }},
       @endforeach],
                fill: false,
                barThickness: 18,
              },
            ],
          },
          options: {
            maintainAspectRatio: false,
            responsive: true,
            title: {
              display: false,
              text: "Orders Chart",
            },
            tooltips: {
              mode: "index",
              intersect: false,
            },
            hover: {
              mode: "nearest",
              intersect: true,
            },
            legend: {
              labels: {
                fontColor: "rgba(0,0,0,.4)",
              },
              align: "end",
              position: "bottom",
            },
            scales: {
              xAxes: [
                {
                  display: false,
                  scaleLabel: {
                    display: true,
                    labelString: "Month",
                  },
                  gridLines: {
                    borderDash: [2],
                    borderDashOffset: [2],
                    color: "rgba(33, 37, 41, 0.3)",
                    zeroLineColor: "rgba(33, 37, 41, 0.3)",
                    zeroLineBorderDash: [2],
                    zeroLineBorderDashOffset: [2],
                  },
                },
              ],
              yAxes: [
                {
                  display: true,
                  scaleLabel: {
                    display: false,
                    labelString: "Value",
                  },
                  gridLines: {
                    borderDash: [2],
                    drawBorder: false,
                    borderDashOffset: [2],
                    color: "rgba(33, 37, 41, 0.2)",
                    zeroLineColor: "rgba(33, 37, 41, 0.15)",
                    zeroLineBorderDash: [2],
                    zeroLineBorderDashOffset: [2],
                  },
                },
              ],
            },
          },
        };
        ctx = document.getElementById("bar-chart").getContext("2d");
        window.myBar = new Chart(ctx, config);
      })();
    </script>
@endsection
