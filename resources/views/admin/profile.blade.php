@extends('admin.layout.layout')

@section('title','Profil')

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
			      <h2 class="page-title">Profil</h2>
			    </div>
		    </div>
		  </div>
	  </div>

	  <!-- Page body -->
	  <div class="page-body">
      <div class="container-xl">
        <div class="card rounded-3 shadow-sm">
          <div class="row g-0">
            <div class="col-12 col-md-3 border-end">
              <div class="card-body">
                <h4 class="subheader">Tetapan</h4>
                <div class="list-group list-group-transparent">
                  <a href="{{route('profile')}}" class="list-group-item list-group-item-action d-flex align-items-center nav-link active">Akaun</a>
                  <a href="{{route('password')}}" class="list-group-item list-group-item-action d-flex align-items-center nav-link">Kemas Kini Kata Laluan</a>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-9 tab-content">
              {{-- account --}}
              <div class="tab-pane active show">
                <form class="card border-0" action="{{route('update_profile', ['id'=>encrypt_string($acc->admin_id)])}}" method="post" autocomplete="off">
                    @method('put')
                    @csrf
                    <div class="card-body">
                      <h2 class="mb-4">Akaun</h2>
                      @if(session()->has('message'))
                      <div class="alert alert-important alert-{{session('alert')}}" role="alert">
                        <div class="d-flex">
                          <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">{!! session('icon') !!}</svg>
                          </div>
                          <div>
                            {{session('message')}}
                          </div>
                        </div>
                      </div>
                      @endif
                      <div class="row row-cards">
                        <span class="card-title mt-4 mb-0">Butiran Akaun</span>
                        <div class="col-xl-7 mb-2">
                          <label class="form-label">Alamat e-mel</label>
                          <div class="datagrid-content">{{$acc->admin_email}}</div>
                        </div>
                        <div class="col-xl-7 mb-2">
                          <label class="form-label">Username</label>
                          <input type="text" class="form-control" name="username" value="{{$acc->admin_username}}" required>
                        </div>
                        <span class="card-title mt-4 mb-0">Butiran Profil</span>
                        <div class="col-xl-7 mb-2">
                          <label class="form-label">Nama</label>
                          <input type="text" class="form-control" name="name" value="{{$acc->admin_name}}" required>
                        </div>
                        <div class="col-xl-7 mb-2">
                          <label class="form-label">No. telefon</label>
                          <input type="text" name="notel" class="form-control" value="{{$acc->admin_notel}}" required>
                      </div>
                      </div>
                    </div>
                    <div class="card-footer text-start">
                      <button type="submit" class="btn btn-primary">Kemas kini</button>
                    </div>
                </form>
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
@endsection
