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
              <h2 class="page-title">Tabung</h2>
            </div>
          </div>
        </div>
	  </div>

	  <!-- Page body -->
	  <div class="page-body">
		<div class="container-xl">
            <div class="col-lg-12">
                <div class="card rounded-3 shadow-sm">
                  <div class="card-header d-flex flex-column flex-xl-row align-items-start align-items-xl-center">
                    <h3 class="card-title">Senarai Tabung</h3>
                    <a href="{{route('add_fund')}}" class="btn btn-primary mt-3 mt-xl-0 ms-xl-auto">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                      Tambah Tabung
                  </a>
                  </div>
                  <div class="table-responsive p-3">
                    <table class="table card-table table-vcenter" id="dataTableDonationBoxs">
                        <thead>
                        <tr>
                            <th class="w-1">#</th>
                            <th>Nama Tabung</th>
                            <th>Jumlah Sasaran</th>
                            <th>Peratus</th>
                            <th>Status</th>
                            <th class="w-1">Tindakan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($funds as $fund)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$fund->fund_name}}</td>
                            <td>RM {{$fund->fund_target}}</td>
                            <td>
                              <div class="row g-2 align-items-center">
                                <div class="col-auto">
                                  {{ number_format(min(($fund->total_donations / $fund->fund_target) * 100, 100), 0) }}%
                                </div>
                                <div class="col">
                                  <div class="progress progress-sm">
                                      <div class="progress-bar" style="width:{{($fund->total_donations / $fund->fund_target) * 100}}%" role="progressbar" aria-valuenow="{{($fund->total_donations / $fund->fund_target) * 100}}" aria-valuemin="0" aria-valuemax="100">
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td>
                              @if($fund->fund_status == 'inactive')
                              <span class="status status-danger">
                                Tidak aktif
                              </span>
                              @elseif($fund->fund_status == 'active')
                              <span class="status status-success">
                                Aktif
                              </span>
                              @endif
                            </td>
                            <td>
                              <a href="{{route('read_fund',['id'=>encrypt_string($fund->fund_id)])}}" class="btn btn-cyan btn-icon">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                              </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
	    </div>
	  </div>

    <!-- Footer -->
	@include('admin.partial.footer')
  </div>
</div>

@endsection