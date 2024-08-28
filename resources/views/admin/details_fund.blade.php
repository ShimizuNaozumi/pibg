@extends('admin.layout.layout')

@section('title','Tabung')

@section('content')
<div class="page">
	<!-- Navbar -->
	@include('admin.partial.navbar')

	<div class="page-wrapper">

	  <!-- Page header -->
	  <div class="page-header d-print-none">
        <div class="container-xl">
          <div class="row g-2 align-items-center">
            <div class="col">
              <h2 class="page-title">Tabung {{$fund->fund_name}}</h2>
            </div>
          </div>
        </div>
	  </div>

	  <!-- Page body -->
	  <div class="page-body">
		<div class="container-xl">
            <div class="row">
                <div class="col py-3">
                  <a href="{{route('fund')}}" class="btn btn-outline-secondary">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                    Kembali
                  </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 mb-3">
                    <div class="card rounded-3 p-3 shadow-sm">
                        <span class="card-subtitle">
                            <b>Dibuat oleh:</b> {{$fund->admin_name}} <br>
                            <b>Dibuat pada:</b> {{date('d/m/Y', strtotime($fund->fund_date))}}
                        </span>
                         
                        <span class="text-center mt-3">
                            <b>Dana terkumpul</b>
                            <h1>RM {{number_format($fund->total_donations, 2)}}</h1>
                        </span>
                        <div id="chart-demo-pie"></div>
                        <div class="row mt-3 text-center">
                            <div class="col">
                                Sasaran
                                <p class="fs-1 fw-bold text-success">RM {{number_format($fund->fund_target, 2)}}</p>
                            </div>
                            <div class="col">
                                Baki
                                <p class="fs-1 fw-bold text-secondary">RM {{number_format(max($fund->fund_target - $fund->total_donations, 0), 2)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 mb-3">
                    <div class="card rounded-3 p-3 shadow-sm" style="height: 28.45rem">
                        <h3 class="card-title">Rekod sumbangan</h3>
                        <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                          <div class="divide-y">
                            @if($donors->isEmpty())
                                <div class="empty">
                                <div class="empty-img"><img src="{{asset('/dist/img/undraw_no_data.svg')}}" height="128" alt="">
                                </div>
                                <p class="empty-title">Tiada Rekod</p>
                                <p class="empty-subtitle text-secondary">
                                  Tiada sumbangan dilakukan pada tabung ini.    
                                </p>
                                </div>
                            @else
                            @foreach($donors as $donor)
                            <div>
                              <div class="row">
                                <div class="col">
                                  <div class="text-truncate">
                                    <strong>{{$donor->donor_name}}</strong>.
                                  </div>
                                  <div class="text-secondary">{{date('d/m/Y', strtotime($donor->transaction_issued_date))}}</div>
                                </div>
                                <div class="col-auto align-self-center text-success fs-3 fw-bold">
                                    + RM {{$donor->transaction_amount}}
                                </div>
                                <div class="col-auto">
                                    <a href="{{route('show_donation', ['id'=>encrypt_string($donor->donation_id)])}}" class="btn btn-cyan btn-icon">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                    </a>
                                </div>
                              </div>
                            </div>
                            @endforeach
                            @endif
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col12 mb-3">
                    <div class="card rounded-3 p-3 shadow-sm">
                        <h3 class="card-title">Tindakan</h3>
                        <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                          <div class="row">
                            <div class="col-md mb-3 mx-3">
                                <div class="card">
                                    <div class="card-status-start bg-info"></div>
                                    <div class="card-body">
                                      <h3 class="card-title">Kemaskini Tabung</h3>
                                      <p class="text-secondary">Kemaskini maklumat tabung.</p>
                                      <a href="{{route('edit_fund',['id'=>encrypt_string($fund->fund_id)])}}" class="btn btn-info">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                        Kemas kini
                                      </a>
                                    </div>
                                </div>
                            </div>
                            @if($acc->admin_category == 'superadmin')
                            @if($fund->fund_status == 'inactive')
                            <div class="col-md mb-3 mx-3">
                                <div class="card">
                                    <div class="card-status-start bg-yellow"></div>
                                    <div class="card-body">
                                      <h3 class="card-title">Siar Tabung</h3>
                                      <p class="text-secondary">Siar tabung di katalog.</p>
                                      <button class="btn btn-yellow" data-bs-toggle="modal" data-bs-target="#publish-{{$fund->fund_id}}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-stack-pop"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 9.5l-3 1.5l8 4l8 -4l-3 -1.5" /><path d="M4 15l8 4l8 -4" /><path d="M12 11v-7" /><path d="M9 7l3 -3l3 3" /></svg>
                                        Siar
                                      </button>
                                    </div>
                                </div>
                            </div>
                            @elseif($fund->fund_status == 'active')
                            <div class="col-md mb-3 mx-3">
                                <div class="card">
                                    <div class="card-status-start bg-danger"></div>
                                    <div class="card-body">
                                      <h3 class="card-title">Sembunyi Tabung</h3>
                                      <p class="text-secondary">Sembunyikan tabung dari katalog tabung.</p>
                                      <button class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#conceal-{{$fund->fund_id}}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-stack-push"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l-2 1l8 4l8 -4l-2 -1" /><path d="M4 15l8 4l8 -4" /><path d="M12 4v7" /><path d="M15 8l-3 3l-3 -3" /></svg>
                                        Sembunyi
                                      </button>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($fund->total_donations == 0.00)
                            <div class="col-md mb-3 mx-3">
                                <div class="card">
                                    <div class="card-status-start bg-danger"></div>
                                    <div class="card-body">
                                      <h3 class="card-title">Padam Tabung</h3>
                                      <p class="text-secondary">Padam maklumat tabung.</p>
                                      <button class="btn btn-red"  data-bs-toggle="modal" data-bs-target="#delete-{{$fund->fund_id}}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                        Padam
                                      </button>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endif
                            {{-- modal publish --}}
                        <div class="modal modal-blur fade" id="publish-{{$fund->fund_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-status bg-info"></div>
                                <div class="modal-body text-center py-4">
                                  <svg  xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-info icon-lg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-help"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 17l0 .01" /><path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4" /></svg>
                                  <h3>Anda Pasti?</h3>
                                  <div>Jika anda meneruskan, tabung derma akan dipaparkan dalam katalog tabung</div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                                  <form action="{{route('publish_fund',['id'=>encrypt_string($fund->fund_id)])}}" method="post">
                                    @method('put')
                                    @csrf
                                    <button class="btn btn-primary btn-icon p-2">
                                      Ya, saya pasti
                                    </button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
  
                          {{-- modal conceal --}}
                          <div class="modal modal-blur fade" id="conceal-{{$fund->fund_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-status bg-info"></div>
                                <div class="modal-body text-center py-4">
                                  <svg  xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-info icon-lg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-help"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 17l0 .01" /><path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4" /></svg>
                                  <h3>Anda Pasti?</h3>
                                  <div>Jika anda meneruskan, tabung derma tidak akan dipaparkan dalam katalog tabung</div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                                  <form action="{{route('conceal_fund',['id'=>encrypt_string($fund->fund_id)])}}" method="post">
                                    @method('put')
                                    @csrf
                                    <button class="btn btn-primary btn-icon p-2">
                                      Ya, saya pasti
                                    </button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
  
                          {{-- modal delete --}}
                          <div class="modal modal-blur fade" id="delete-{{$fund->fund_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-status bg-danger"></div>
                                <div class="modal-body text-center py-4">
                                  <svg  xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-help"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 17l0 .01" /><path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4" /></svg>
                                  <h3>Anda Pasti?</h3>
                                  <div>Jika anda meneruskan, tabung ini akan dihapuskan</div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                                  <form action="{{route('delete_fund',['id'=>encrypt_string($fund->fund_id)])}}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-icon p-2">
                                      Hapus
                                    </button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
	    </div>
	  </div>

    <!-- Footer -->
	@include('admin.partial.footer')
  </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var targetAmount = {{$fund->fund_target}};
        var totalDonations = {{$fund->total_donations}};
        
        var percentage = (totalDonations / targetAmount) * 100;
        if (percentage > 100) {
            percentage = 100; // Cap the percentage at 100
        }
        var remaining = 100 - percentage;
        
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-demo-pie'), {
            chart: {
                type: "donut",
                fontFamily: 'inherit',
                height: 240,
                sparkline: {
                    enabled: true
                },
                animations: {
                    enabled: false
                },
            },
            fill: {
                opacity: 1,
            },
            series: [percentage, remaining],
            labels: ["Terkumpul", "Baki"],
            tooltip: {
                theme: 'dark'
            },
            grid: {
                strokeDashArray: 4,
            },
            colors: [tabler.getColor("success"), tabler.getColor("gray-300")],
            legend: {
                show: true,
                position: 'bottom',
                offsetY: 12,
                markers: {
                    width: 10,
                    height: 10,
                    radius: 100,
                },
                itemMargin: {
                    horizontal: 8,
                    vertical: 8
                },
            },
            tooltip: {
                fillSeriesColor: false
            },
        })).render();
    });
</script>

@endsection
