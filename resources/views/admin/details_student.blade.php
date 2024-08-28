@extends('admin.layout.layout')

@section('title','Pelajar')

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
              <h2 class="page-title">{{$student->student_name}}</h2>
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
            <h3 class="card-title">Butiran Pelajar</h3>
          </div>
          <div class="card-body">
            <div class="datagrid">
              <div class="datagrid-item">
                <div class="datagrid-title">Nama</div>
                <div class="datagrid-content">{{$student->student_name}}</div>
              </div>
              <div class="datagrid-item">
                <div class="datagrid-title">No. KP</div>
                <div class="datagrid-content">{{$student->student_ic}}</div>
              </div>
              <div class="datagrid-item">
                <div class="datagrid-title">Kelas</div>
                <div class="datagrid-content">{{$student->class_standard}} {{$student->class_name}}</div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
        @foreach($guardians as $guardian)
            <div class="col-sm">
                <div class="card rounded-3 shadow-sm mb-3">
                    <div class="card-header bg-cyan text-light">
                      <h3 class="card-title">Butiran
                        @if($guardian->guardian_role == '1')
                        Bapa
                        @elseif($guardian->guardian_role == '2')
                        Ibu
                        @elseif($guardian->guardian_role == '3')
                        Penjaga
                        @endif
                      </h3>
                    </div>
                    <div class="card-body">
                      <div class="datagrid">
                        <div class="datagrid-item">
                          <div class="datagrid-title">Nama</div>
                          <div class="datagrid-content">{{$guardian->guardian_name}}</div>
                        </div>
                        <div class="datagrid-item">
                          <div class="datagrid-title">E-mel</div>
                          <div class="datagrid-content">{{$guardian->guardian_email}}</div>
                        </div>
                        <div class="datagrid-item">
                          <div class="datagrid-title">No. Telefon</div>
                          <div class="datagrid-content">{{$guardian->guardian_notel}}</div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
	    </div>
	  </div>

    <!-- Footer -->
	@include('admin.partial.footer')
  </div>
</div>

@endsection