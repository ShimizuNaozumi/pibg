@extends('admin.layout.layout')

@section('title','Log Masuk')

@section('content')
<div class="row g-0 flex-fill">
  <div class="col-12 col-lg-6 col-xl-4 border-top-wide border-primary d-flex flex-column justify-content-center">
    <div class="container container-tight my-5 px-lg-5">
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
      <div class="text-center mb-4">
        <img src="{{asset('/dist/img/logo.png')}}" onclick="window.location='{{route('index')}}'" width="110" alt="logo skttdi2">
        {{-- PIBGPortal SKTTDI2 --}}
      </div>
      <h2 class="h3 text-center mb-3">
        Log Masuk
      </h2>
      <form action="{{route('auth_admin')}}" method="post" autocomplete="off">
        @csrf
        <div class="mb-3">
          <label class="form-label">
            Username/E-mel
            <span class="form-label-description">
              <a href="{{route('forgot_username')}}">Lupa username</a>
            </span>
          </label>
          <input type="text" name="login" class="form-control" required>
        </div>
        <div class="mb-2">
          <label class="form-label">
            Kata laluan
            <span class="form-label-description">
              <a href="{{route('forgot_password')}}">Lupa kata laluan</a>
            </span>
          </label>
          <div class="input-group input-group-flat">
            <input type="password" name="password" id="password" class="form-control" required>
          </div>
        </div>
        <div class="mt-3 mb-2">
          <label class="form-check">
            <input type="checkbox" class="form-check-input" id="show-password-checkbox"/>
            <span class="form-check-label">Tunjuk kata laluan</span>
          </label>
        </div>
        <div class="form-footer">
          <button type="submit" class="btn btn-primary w-100">Log Masuk</button>
        </div>
      </form>
      <!-- Footer -->
      @include('admin.partial.footer')
    </div>
  </div>
  <div class="col-12 col-lg-6 col-xl-8 d-none d-lg-block">
    <!-- Photo -->
    <div class="bg-cover h-100 min-vh-100" style="background-image: url(../../dist/img/loginbg.jpg)"></div>
  </div>
</div>

<script>
  document.getElementById('show-password-checkbox').addEventListener('change', function() {
    var passwordInput = document.getElementById('password');
    if (this.checked) {
      passwordInput.type = 'text';
    } else {
      passwordInput.type = 'password';
    }
  });
</script>
@endsection