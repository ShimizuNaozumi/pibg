@extends('admin.layout.layout')

@section('title','Lupa Username')

@section('content')
  <div class="page page-center">
    <div class="container container-tight py-4">

      <form class="card card-md" action="./" method="post" autocomplete="off" novalidate>
          @csrf
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Lupa username</h2>
            <p class="text-secondary mb-4">Sila masukkan emel yang berkaitan dengan akaun anda dan kami akan menghantar pautan untuk menetap semula kata laluan anda</p>
            <div class="mb-3">
              <label class="form-label">Alamat e-mel</label>
              <input type="text" class="form-control">
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>
                Hantar
              </button>
              <a href="{{route('index')}}" class="btn btn-outline-primary w-100">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                Kembali
              </a>
            </div>
          </div>
        </form>
      
      <!-- Footer -->
      @include('admin.partial.footer')
    </div>
  </div>
@endsection