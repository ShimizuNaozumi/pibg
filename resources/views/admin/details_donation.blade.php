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
              <h2 class="page-title">Butiran Pembayaran {{$donation->donor_name}}</h2>
            </div>
          </div>
        </div>
	  </div>

	  <!-- Page body -->
	  <div class="page-body">
		  <div class="container-xl">
        <div class="row">
          <div class="col py-3">
            <a href="{{url()->previous();}}" class="btn btn-outline-secondary">
              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
              Kembali
            </a>
          </div>
        </div>
        <div class="card rounded-3 shadow-sm mb-3">
          <div class="card-header bg-cyan text-light">
            <h3 class="card-title">Butiran Penyumbang</h3>
          </div>
          <div class="card-body">
            <div class="datagrid">
              <div class="datagrid-item">
                <div class="datagrid-title">Nama</div>
                <div class="datagrid-content">{{$donation->donor_name}}</div>
              </div>
              <div class="datagrid-item">
                <div class="datagrid-title">e-mel</div>
                <div class="datagrid-content">{{$donation->donor_email}}</div>
              </div>
              <div class="datagrid-item">
                <div class="datagrid-title">No. telefon</div>
                <div class="datagrid-content">{{$donation->donor_notel}}</div>
              </div>
            </div>
          </div>
        </div>
        <div class="card rounded-3 shadow-sm mb-3">
          <div class="card-header bg-cyan text-light">
            <h3 class="card-title">Butiran Sumbangan</h3>
          </div>
          <div class="card-body">
            <div class="datagrid">
              <div class="datagrid-item">
                <div class="datagrid-title">No. invoice</div>
                <div class="datagrid-content">{{$donation->transaction_invoiceno}}</div>
              </div>
              <div class="datagrid-item">
                <div class="datagrid-title">Jumlah</div>
                <div class="datagrid-content">RM {{$donation->transaction_amount}}</div>
              </div>
              <div class="datagrid-item">
                <div class="datagrid-title">Kaedah</div>
                <div class="datagrid-content">{{$donation->transaction_method}}</div>
              </div>
              <div class="datagrid-item">
                <div class="datagrid-title">Status</div>
                <div class="datagrid-content">
                  @if($donation->transaction_status == 1)
                      <span class="status status-success">
                          Dibayar
                      </span>
                  @elseif($donation->transaction_status == 2)
                      <span class="status status-warning">
                          Dalam Proses
                      </span>
                  @elseif($donation->transaction_status == 3)
                      <span class="status status-danger">
                          Gagal
                      </span>
                  @endif
                </div>
              </div>
              <div class="datagrid-item">
                <div class="datagrid-title">Tabung</div>
                <div class="datagrid-content">{{$donation->fund_name}}</div>
              </div>
              <div class="datagrid-item">
                <div class="datagrid-title">Tarikh Pembayaran</div>
                <div class="datagrid-content">
                  @if ($donation->transaction_issued_date)
                      {{ date('d/m/Y h:i:s A', strtotime($donation->transaction_issued_date)) }}
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col py-3">
            <button onclick="window.open('{{ route('donation_receipt', ['id' => encrypt_string($donation->donation_id)]) }}', '_blank')" @if($donation->transaction_status != 1) disabled @endif class="btn btn-cyan">
              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-receipt-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" /><path d="M14 8h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5m2 0v1.5m0 -9v1.5" /></svg>
              Resit
            </button>
          </div>
        </div>

	    </div>
	  </div>

    <!-- Footer -->
	@include('admin.partial.footer')
  </div>
</div>

@endsection