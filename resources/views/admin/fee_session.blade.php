@extends('admin.layout.layout')

@section('title','Yuran PIBG')

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
              <h2 class="page-title">Yuran PIBG</h2>
            </div>
          </div>
        </div>
	  </div>

	  <!-- Page body -->
	  <div class="page-body">
		  <div class="container-xl">
        <div class="col-12">
          <div class="card shadow">
            <div class="card-header d-flex flex-column flex-xl-row align-items-start align-items-xl-center">
              <h3 class="card-title">Senarai Yuran</h3>
              <a href="#" class="btn btn-primary mt-3 mt-xl-0 ms-xl-auto" data-bs-toggle="modal" data-bs-target="#modal-add">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                  Tambah sesi
              </a>
            </div>

            <div class="table-responsive p-3">
              <table class="table table-vcenter card-table" id="dataTableAdmins">
                <thead>
                  <tr>
                    <th class="w-1">#</th>
                    <th>Yuran</th>
                    <th class="w-1">Tindakan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($fee_sessions as $fee_session)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$fee_session->fee_session_name}}</td>
                    <td class="text-end">
                        <a href="{{route('read_fee',['id'=>encrypt_string($fee_session->fee_session_id)])}}" class="btn btn-cyan btn-icon">
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

        <!-- Modal Add Fee Session-->
        <div class="modal modal-blur fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <form action="{{ route('create_fee_session') }}" method="post" autocomplete="off">
                      <div class="modal-header bg-primary text-light">
                          <h5 class="modal-title">Sesi Yuran PIBG</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          @csrf
                          <div class="mb-3">
                              <label class="form-label">Nama</label>
                              <input type="text" class="form-control" name="name" value="Sumbangan PIBG SKTTDI 2" readonly required>
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Sesi</label>
                              <input type="text" name="session" class="form-control" data-mask="0000/0000" data-mask-visible="true" placeholder="0000/0000">
                          </div>
                      </div>
                      <div class="modal-footer">
                          <a class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</a>
                          <button type="submit" class="btn btn-primary ms-auto">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                              Tambah sesi
                          </button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
        <!-- End Modal Add Fee Session-->
	    </div>
	  </div>

    <!-- Footer -->
	@include('admin.partial.footer')
  </div>
</div>
@endsection