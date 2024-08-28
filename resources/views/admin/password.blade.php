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
                  <a href="{{route('profile')}}" class="list-group-item list-group-item-action d-flex align-items-center nav-link">Akaun</a>
                  <a href="{{route('password')}}" class="list-group-item list-group-item-action d-flex align-items-center nav-link active">Kemas Kini Kata Laluan</a>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-9 tab-content">
              {{-- update password --}}
              <div class="tab-pane active show">
                <form class="card border-0" action="{{route('update_password', ['id'=>encrypt_string($acc->admin_id)])}}" method="post">
                    @method('put')
                    @csrf
                    <div class="card-body">
                      <h2 class="mb-4">Kemas kini kata laluan</h2>
                      @if ($errors->any())
                      <div class="alert alert-important alert-warning" role="alert">
                        <div class="d-flex">
                          <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>
                          </div>
                          <div>
                            <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                            </ul>
                          </div>
                        </div>
                      </div>
                      @endif
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
                        <div class="col-xl-12">
                          <div class="alert alert-info bg-info-lt" role="alert">
                            <div class="d-flex">
                              <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg>
                              </div>
                              <div>
                                <h4 class="alert-title">Format Kata Laluan</h4>
                                <div class="text-secondary">
                                  <ul>
                                    <li>Minimum 8 aksara</li>
                                    <li>Minimum 1 huruf besar</li>
                                    <li>Minumum 1 huruf kecil</li>
                                    <li>Minimum 1 <i>special character</i></li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-7 mb-2">
                          <label class="form-label">Kata laluan semasa</label>
                          <input type="password" name="current_password" class="form-control" value="{{old('current_password')}}" autocomplete="off" required>
                        </div>
                        <div class="col-xl-7 mb-2">
                          <label class="form-label">Kata laluan baru</label>
                          <input type="password" name="new_password" class="form-control" value="{{old('new_password')}}" autocomplete="off" required>
                        </div>
                        <div class="col-xl-7 mb-2">
                          <label class="form-label">Pengesahan kata laluan baru</label>
                          <input type="password" name="verify_password" class="form-control" value="{{old('verify_password')}}" autocomplete="off" required>
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