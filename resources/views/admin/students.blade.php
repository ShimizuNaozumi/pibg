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
              <h2 class="page-title">{{$class->class_standard}} {{$class->class_name}}</h2>
            </div>
          </div>
        </div>
	  </div>

	  <!-- Page body -->
	  <div class="page-body">
		<div class="container-xl">
      <div class="row">
        <div class="col py-3">
          <a href="{{route('classes')}}" class="btn btn-outline-secondary">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
            Kembali
          </a>
        </div>
      </div>
      <div class="col-lg-12">
          <div class="card rounded-3 shadow-sm">
            <div class="card-header">
              <h3 class="card-title">Senarai Pelajar</h3>
            </div>
            <div class="table-responsive p-3">
              <table class="table card-table table-vcenter" id="dataTableStudents">
                  <thead>
                  <tr>
                      <th class="w-1">#</th>
                      <th>Nama</th>
                      <th>No. Kad Pengenalan</th>
                      <th class="w-1">Tindakan</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($students as $student)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$student->student_name}}</td>
                      <td>{{$student->student_ic}}</td>
                      <td>
                        <a href="{{route('show_student', ['id'=>encrypt_string($student->student_id)])}}" class="btn btn-cyan btn-icon">
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