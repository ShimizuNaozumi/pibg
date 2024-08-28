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
              <h2 class="page-title">{{$fee_session->fee_session_name}}</h2>
            </div>
          </div>
        </div>
	  </div>

	  <!-- Page body -->
	  <div class="page-body">
		  <div class="container-xl">
        <div class="row">
          <div class="col py-3">
            <a href="{{route('create_fee_session')}}" class="btn btn-outline-secondary">
              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
              Kembali
            </a>
          </div>
        </div>
        <div class="col-12">
          <div class="card shadow">
            <div class="card-header d-flex flex-column flex-xl-row align-items-start align-items-xl-center">
              <h3 class="card-title">Senarai Perkara</h3>
              <a href="#" class="btn btn-primary mt-3 mt-xl-0 ms-xl-auto" data-bs-toggle="modal" data-bs-target="#modal-add">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                  Tambah Perkara
              </a>
            </div>

            <div class="table-responsive p-3">
              <table class="table table-vcenter card-table" id="dataTableAdmins">
                <thead>
                  <tr>
                    <th class="w-1">#</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Jumlah (RM)</th>
                    <th class="w-1">Tindakan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($fees as $fee)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$fee->fee_name}}</td>
                    <td>
                      @if($fee->fee_specific == "family")
                      Keluarga
                      @elseif($fee->fee_specific == "student")
                      Arus Perdana
                      @elseif($fee->fee_specific == "ppki")
                      Program Pendidikan Khas Integrasi (PPKI)
                      @elseif($fee->fee_specific == "standard1")
                      Tahun 1
                      @elseif($fee->fee_specific == "standard2")
                      Tahun 2
                      @elseif($fee->fee_specific == "standard3")
                      Tahun 3
                      @elseif($fee->fee_specific == "standard4")
                      Tahun 4
                      @elseif($fee->fee_specific == "standard5")
                      Tahun 5
                      @elseif($fee->fee_specific == "standard6")
                      Tahun 6
                      @endif
                    </td>
                    <td>{{$fee->fee_amount}}</td>
                    <td></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Modal Add Fee -->
        <div class="modal modal-blur fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <form action="{{ route('create_fee') }}" method="post" autocomplete="off">
                      <div class="modal-header bg-primary text-light">
                          <h5 class="modal-title">{{$fee_session->fee_session_name}}</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          @csrf
                          <input type="text" name="session" value="{{$fee_session->fee_session_id}}" hidden>
                          <div class="mb-3">
                              <label class="form-label">Perkara</label>
                              <input type="text" class="form-control" name="name" placeholder="Sumbangan PIBG" required>
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Kategori</label>
                              <select class="form-select" name="category" required>
                                  <option value="" disabled selected>--Sila Pilih--</option>
                                  <option value="family">Keluarga</option>
                                  <option value="student">Arus Perdana</option>
                                  <option value="ppki">Program Pendidikan Khas Integrasi (PPKI)</option>
                                  <option value="standard1">Tahun 1</option>
                                  <option value="standard2">Tahun 2</option>
                                  <option value="standard3">Tahun 3</option>
                                  <option value="standard4">Tahun 4</option>
                                  <option value="standard5">Tahun 5</option>
                                  <option value="standard6">Tahun 6</option>
                              </select>
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Jumlah</label>
                              <div class="input-group">
                                <span class="input-group-text">
                                  RM
                                </span>
                                <input type="number" class="form-control" name="amount" placeholder="00" step="1" min="0" autocomplete="off" required>
                                <span class="input-group-text">
                                  .00
                                </span>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <a class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</a>
                          <button type="submit" class="btn btn-primary ms-auto">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                              Tambah perkara
                          </button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
        <!-- End Modal Add Fee -->
	    </div>
	  </div>

    <!-- Footer -->
	@include('admin.partial.footer')
  </div>
</div>
@endsection