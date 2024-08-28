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
              <h2 class="page-title">Laporan Kewangan Sumbangan</h2>
            </div>
          </div>
        </div>
	  </div>

	  <!-- Page body -->
	  <div class="page-body">
		<div class="container-xl">
            <div class="col-lg-12">
                <div class="card rounded-3 shadow-sm">
                  <div class="card-header">
                    <h3 class="card-title">Tabung</h3>
                  </div>
                  <div class="table-responsive p-3">
                    <table class="table card-table table-vcenter" id="dataTableDonationBoxs">
                        <thead>
                        <tr>
                            <th class="w-1">#</th>
                            <th>Nama Tabung</th>
                            <th class="w-1">Tindakan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($funds as $fund)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$fund->fund_name}}</td>
                            <td>
                              <button onclick="window.open('{{route('generate_donation_report', ['id' => encrypt_string($fund->fund_id)])}}', '_blank')" class="btn btn-indigo btn-icon">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-text"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12h6" /><path d="M9 16h6" /></svg>
                              </button>
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