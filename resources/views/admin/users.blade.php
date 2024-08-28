@extends('admin.layout.layout')

@section('title','Pengguna')

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
            <h2 class="page-title">Akaun Pengguna</h2>
          </div>
        </div>
      </div>
	  </div>

	  <!-- Page body -->
	  <div class="page-body">
		  <div class="container-xl">
        <div class="col-12">
          <div class="card rounded-3 shadow-sm">
            <div class="card-header d-flex flex-column flex-xl-row align-items-start align-items-xl-center">
              <h3 class="card-title">Senarai Pengguna</h3>
              <a href="#" class="btn btn-primary mt-3 mt-xl-0 ms-xl-auto" data-bs-toggle="modal" data-bs-target="#modal-add">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                  Tambah pengguna
              </a>
            </div>

            <div class="table-responsive p-3">
              <table class="table table-vcenter card-table" id="dataTableUsers">
                <thead>
                  <tr>
                    <th class="w-1">#</th>
                    <th>Nama</th>
                    <th>E-mel</th>
                    <th>No. Telefon</th>
                    <th class="w-1">Tindakan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$user->user_name}}</td>
                    <td>{{$user->user_email}}</td>
                    <td>{{$user->user_notel}}</td>
                    <td class="text-end">
                      @if($user->user_status == '1')
                      <button class="btn btn-red btn-icon" data-bs-toggle="modal" data-bs-target="#deactivate-{{$user->user_id}}">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-lock"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" /><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M8 11v-4a4 4 0 1 1 8 0v4" /></svg>
                      </button>
                      @elseif($user->user_status == '2')
                      <button class="btn btn-yellow btn-icon"  data-bs-toggle="modal" data-bs-target="#activate-{{$user->user_id}}">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-lock-open"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" /><path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M8 11v-5a4 4 0 0 1 8 0" /></svg>
                      </button>
                      @endif
                    </td>
                  </tr>

                  {{-- activate --}}
                  <div class="modal modal-blur fade" id="activate-{{$user->user_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-status bg-warning"></div>
                        <div class="modal-body text-center py-4">
                          <svg  xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-warning icon-lg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-help"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 17l0 .01" /><path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4" /></svg>
                          <h3>Aktifkan Akaun?</h3>
                          <div>Adakah anda pasti ingin mengaktifkan akaun ini?</div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                          <form action="{{route('activate_user',['id'=>encrypt_string($user->user_id)])}}" method="post">
                            @method('put')
                            @csrf
                            <button class="btn btn-warning btn-icon p-2">
                              Ya, saya pasti
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  {{-- deactivate --}}
                  <div class="modal modal-blur fade" id="deactivate-{{$user->user_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-status bg-warning"></div>
                        <div class="modal-body text-center py-4">
                          <svg  xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-warning icon-lg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-help"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 17l0 .01" /><path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4" /></svg>
                          <h3>Nyahaktifkan Akaun?</h3>
                          <div>Adakah anda pasti ingin menyahaktifkan akaun ini?</div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                          <form action="{{route('deactivate_user',['id'=>encrypt_string($user->user_id)])}}" method="post">
                            @method('put')
                            @csrf
                            <button class="btn btn-warning btn-icon p-2">
                              Ya, saya pasti
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Modal Add User -->
        <div class="modal modal-blur fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <form action="{{route('create_user')}}" method="post" autocomplete="off">
                <div class="modal-header bg-primary text-light">
                  <h5 class="modal-title">Pengguna Baharu</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  @csrf
                  <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" placeholder="Nama penuh" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">E-mel</label>
                    <input type="email" class="form-control" name="email" placeholder="Alamat e-mel" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <a class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Batal
                  </a>
                  <button type="submit" class="btn btn-primary ms-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    Tambah pengguna
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- End Modal Add User -->

        {{-- Alert Modal --}}
        @if(session()->has('message'))
        <div class="modal modal-blur fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-{{session('alert')}}"></div>
                    <div class="modal-body text-center py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-{{session('alert')}} icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">{!!session('icon')!!}</svg>
                        <h3>{{session('title')}}</h3>
                        <div class="text-secondary">{{session('message')}}</div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        {{-- End Alert Modal --}}
	    </div>
	  </div>
  <!-- Footer -->
	@include('admin.partial.footer')
  </div>
</div>
@endsection