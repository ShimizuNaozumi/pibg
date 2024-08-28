@extends('admin.layout.layout')

@section('title','Butiran Tabung')

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
              <h2 class="page-title">Butiran Tabung</h2>
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
        <div class="row">
          <div class="col-lg-12">
            <form class="card rounded-3 shadow-sm" action="{{route('update_fund',['id'=>encrypt_string($fund->fund_id)])}}" method="post" enctype="multipart/form-data">
              @method('put')
              @csrf
              <div class="card-header">
                <h3 class="card-title">Maklumat Tabung</h3>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-md-6 p-3">
                        <div>
                            <label class="form-label">Gambar Tabung</label>
                            <img src="{{ asset($fund->fund_image_path) }}" alt="Gambar tabung" class="img-fluid rounded-3 shadow-sm mb-3">
                            <div>
                              <input type="file" name="image" class="form-control">
                              <small class="form-hint">
                                Maksimum: 5MB
                              </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="mb-3">
                            <label class="form-label">Nama Tabung</label>
                            <div>
                              <input type="text" class="form-control" name="name" placeholder="Masukkan nama tabung" value="{{$fund->fund_name}}" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tujuan</label>
                            <div>
                              <textarea id="tinymce-mytextarea" name="purpose">{{$fund->fund_purpose}}</textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pihak Sasaran</label>
                            <div>
                              <input type="text" class="form-control" name="side" placeholder="Masukkan pihak sasaran" value="{{$fund->fund_side}}" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tarikh Sasaran</label>
                            <div>
                              <input type="date" class="form-control" name="date" value="{{date('Y-m-d', strtotime($fund->fund_date))}}" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah Sasaran</label>
                            <div class="input-group">
                              <span class="input-group-text">
                                RM
                              </span>
                              <input type="number" class="form-control" name="target" placeholder="00.00" step="0.01" min="0" value="{{$fund->fund_target}}" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Kemaskini</button>
              </div>
            </form> 
          </div>
        </div>
	    </div>
	  </div>

    <!-- Footer -->
	@include('admin.partial.footer')
  </div>
</div>



@endsection