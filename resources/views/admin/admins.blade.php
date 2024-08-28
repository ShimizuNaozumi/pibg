@extends('admin.layout.layout')

@section('title','Pentadbir')

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
              <h2 class="page-title">Akaun Pentadbir</h2>
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
              <h3 class="card-title">Senarai Pentadbir</h3>
              <a href="#" class="btn btn-primary mt-3 mt-xl-0 ms-xl-auto" data-bs-toggle="modal" data-bs-target="#modal-add">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                  Tambah pentadbir
              </a>
            </div>

            <div class="table-responsive p-3">
              <table class="table table-vcenter card-table" id="dataTableAdmins">
                <thead>
                  <tr>
                    <th class="w-1">#</th>
                    <th>Nama</th>
                    <th>E-mel</th>
                    <th>No. Telefon</th>
                    <th>Kategori</th>
                    <th class="w-1">Tindakan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($admins as $admin)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$admin->admin_name}}</td>
                    <td>{{$admin->admin_email}}</td>
                    <td>{{$admin->admin_notel}}</td>
                    <td>
                      @if($admin->admin_category == 'teacher')
                      <span class="badge badge-pill p-1 bg-red-lt">
                        Guru
                      </span>
                      @elseif($admin->admin_category == 'treasurer')
                      <span class="badge badge-pill p-1 bg-orange-lt">
                        Bendahari
                      </span>
                      @endif
                    </td>
                    <td class="text-end">
                      @if($admin->admin_status == 'active')
                      <button class="btn btn-red btn-icon" data-bs-toggle="modal" data-bs-target="#deactivate-{{$admin->admin_id}}">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-lock"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" /><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M8 11v-4a4 4 0 1 1 8 0v4" /></svg>
                      </button>
                      @elseif($admin->admin_status == 'inactive')
                      <button class="btn btn-yellow btn-icon"  data-bs-toggle="modal" data-bs-target="#activate-{{$admin->admin_id}}">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-lock-open"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" /><path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M8 11v-5a4 4 0 0 1 8 0" /></svg>
                      </button>
                      @endif
                    </td>
                  </tr>

                  {{-- activate --}}
                  <div class="modal modal-blur fade" id="activate-{{$admin->admin_id}}" tabindex="-1" role="dialog" aria-hidden="true">
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
                          <form action="{{route('activate_admin',['id'=>encrypt_string($admin->admin_id)])}}" method="post">
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
                  <div class="modal modal-blur fade" id="deactivate-{{$admin->admin_id}}" tabindex="-1" role="dialog" aria-hidden="true">
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
                          <form action="{{route('deactivate_admin',['id'=>encrypt_string($admin->admin_id)])}}" method="post">
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

        <!-- Modal Add Admin -->
        <div class="modal modal-blur fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <form action="{{ route('create_admin') }}" method="post" autocomplete="off">
                      <div class="modal-header bg-primary text-light">
                          <h5 class="modal-title">Pentadbir Baharu</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          @csrf
                          <div class="mb-3">
                              <label class="form-label">Username</label>
                              <input type="text" class="form-control" name="username" id="username" value="{{old('username')}}" placeholder="Username" required>
                              <label class="form-check form-check-inline mt-2 mb-0">
                                <input class="form-check-input" type="checkbox" id="generateUsername" name="generateUsername">
                                <span class="form-check-label">Jana Username</span>
                              </label>
                            </div>
                          <div class="mb-3">
                              <label class="form-label">Nama</label>
                              <input type="text" class="form-control" name="name" placeholder="Nama penuh" value="{{old('name')}}" required>
                          </div>
                          <div class="mb-3">
                              <label class="form-label">E-mel</label>
                              <input type="email" class="form-control" name="email" placeholder="Alamat e-mel" value="{{old('email')}}" required>
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Kategori</label>
                              <select class="form-select" name="category" required>
                                  <option value="" disabled selected>--Sila Pilih--</option>
                                  <option value="2" {{old('category') == 'teacher' ? 'selected' : ''}}>Guru</option>
                                  <option value="3" {{old('category') == 'treasurer' ? 'selected' : ''}}>Bendahari</option>
                              </select>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <a class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</a>
                          <button type="submit" class="btn btn-primary ms-auto">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                              Tambah pentadbir
                          </button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
        <!-- End Modal Add Admin -->
	    </div>
	  </div>

    <!-- Footer -->
	@include('admin.partial.footer')
  </div>
</div>
<script>
  document.getElementById('generateUsername').addEventListener('change', function() {
      if (this.checked) {
          const generatedUsername = generateUsername();
          document.getElementById('username').value = generatedUsername;
      } else {
          document.getElementById('username').value = '';
      }
  });

  function generateUsername() {
      const prefix = "admin";
      const randomNum = Math.floor(Math.random() * 10000);
      return prefix + randomNum;
  }
</script>
@endsection