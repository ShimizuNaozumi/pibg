@extends('admin.layout.layout')

@section('title','Lupa Kata Laluan')

@section('content')
  <div class="page page-center">
    <div class="container container-tight py-4">

      <form class="card card-md" action="{{route('modify_password', ['id' => encrypt_string($id)])}}" method="post" autocomplete="off">
          @method('put')
          @csrf
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Tukar kata laluan</h2>
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
            <div class="mb-3">
              <label class="form-label">Kata laluan baru</label>
              <input type="password" name="new_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Pengesahan kata laluan baru</label>
                <input type="password" name="verify_password" class="form-control" required>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100 mb-3">
                Tukar
              </button>
              <a href="{{route('login_admin')}}" class="btn btn-outline-primary w-100">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                Kembali ke log masuk
              </a>
            </div>
          </div>
        </form>
      
      <!-- Footer -->
      @include('admin.partial.footer')
    </div>
  </div>
@endsection