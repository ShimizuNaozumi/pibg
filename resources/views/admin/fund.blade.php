@extends('admin.layout.layout')

@section('title','Tabung')

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
              <h2 class="page-title">Tabung</h2>
            </div>
          </div>
        </div>
	  </div>

	  <!-- Page body -->
	  <div class="page-body">
		<div class="container-xl">
            <div class="col-lg-12">
                <div class="card rounded-3 shadow-sm">
                  <div class="card-header">
                    <h3 class="card-title">Senarai Tabung</h3>
                  </div>
                  <div class="table-responsive p-3">
                    <table class="table card-table table-vcenter" id="dataTableDonationBoxs">
                        <thead>
                        <tr>
                            <th class="w-1">#</th>
                            <th>Nama Tabung</th>
                            @if($acc->admin_category == '1')
                            <th>Penerbit</th>
                            @endif
                            <th>Jumlah Sasaran</th>
                            <th>Peratus</th>
                            <th>Status</th>
                            <th>Tindakan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($funds as $fund)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$fund->fund_name}}</td>
                            @if($acc->admin_category == '1')
                            <td>{{$fund->admin_name}}</td>
                            @endif
                            <td>RM {{$fund->fund_target}}</td>
                            <td>
                              <div class="row g-2 align-items-center">
                                <div class="col-auto">
                                  {{ number_format(min(($fund->total_donations / $fund->fund_target) * 100, 100), 0) }}%
                                </div>
                                <div class="col">
                                  <div class="progress progress-sm">
                                      <div class="progress-bar" style="width:{{($fund->total_donations / $fund->fund_target) * 100}}%" role="progressbar" aria-valuenow="{{($fund->total_donations / $fund->fund_target) * 100}}" aria-valuemin="0" aria-valuemax="100">
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td>
                              @if($fund->fund_status == '1')
                              <span class="status status-danger">
                                Tidak aktif
                              </span>
                              @elseif($fund->fund_status == '2')
                              <span class="status status-success">
                                Aktif
                              </span>
                              @endif
                            </td>
                            <td>
                              <a href="{{route('edit_fund',['id'=>encrypt_string($fund->fund_id)])}}" class="btn btn-info btn-icon">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                              </a>
                              <a href="{{route('read_fund',['id'=>encrypt_string($fund->fund_id)])}}" class="btn btn-cyan btn-icon">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                              </a>
                              @if($acc->admin_category == '1')
                                @if($fund->fund_status == '1')
                                <button class="btn btn-yellow btn-icon" data-bs-toggle="modal" data-bs-target="#publish-{{$fund->fund_id}}">
                                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-stack-pop"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 9.5l-3 1.5l8 4l8 -4l-3 -1.5" /><path d="M4 15l8 4l8 -4" /><path d="M12 11v-7" /><path d="M9 7l3 -3l3 3" /></svg>
                                </button>
                                @elseif($fund->fund_status == '2')
                                <button class="btn btn-red btn-icon"  data-bs-toggle="modal" data-bs-target="#conceal-{{$fund->fund_id}}">
                                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-stack-push"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l-2 1l8 4l8 -4l-2 -1" /><path d="M4 15l8 4l8 -4" /><path d="M12 4v7" /><path d="M15 8l-3 3l-3 -3" /></svg>
                                </button>
                                @endif
                                <button class="btn btn-red btn-icon"  data-bs-toggle="modal" data-bs-target="#delete-{{$fund->fund_id}}" @if($fund->total_donations > 0.01) disabled @endif>
                                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                </button>
                              @endif
                            </td>
                        </tr>

                        {{-- modal publish --}}
                        <div class="modal modal-blur fade" id="publish-{{$fund->fund_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-status bg-info"></div>
                              <div class="modal-body text-center py-4">
                                <svg  xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-info icon-lg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-help"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 17l0 .01" /><path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4" /></svg>
                                <h3>Anda Pasti?</h3>
                                <div>Jika anda meneruskan, tabung derma akan dipaparkan dalam katalog tabung</div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                                <form action="{{route('publish_fund',['id'=>encrypt_string($fund->fund_id)])}}" method="post">
                                  @method('put')
                                  @csrf
                                  <button class="btn btn-primary btn-icon p-2">
                                    Ya, saya pasti
                                  </button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        {{-- modal conceal --}}
                        <div class="modal modal-blur fade" id="conceal-{{$fund->fund_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-status bg-info"></div>
                              <div class="modal-body text-center py-4">
                                <svg  xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-info icon-lg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-help"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 17l0 .01" /><path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4" /></svg>
                                <h3>Anda Pasti?</h3>
                                <div>Jika anda meneruskan, tabung derma tidak akan dipaparkan dalam katalog tabung</div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                                <form action="{{route('conceal_fund',['id'=>encrypt_string($fund->fund_id)])}}" method="post">
                                  @method('put')
                                  @csrf
                                  <button class="btn btn-primary btn-icon p-2">
                                    Ya, saya pasti
                                  </button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        {{-- modal delete --}}
                        <div class="modal modal-blur fade" id="delete-{{$fund->fund_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-status bg-danger"></div>
                              <div class="modal-body text-center py-4">
                                <svg  xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-help"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 17l0 .01" /><path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4" /></svg>
                                <h3>Anda Pasti?</h3>
                                <div>Jika anda meneruskan, tabung ini akan dihapuskan</div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                                <form action="{{route('delete_fund',['id'=>encrypt_string($fund->fund_id)])}}" method="post">
                                  @method('delete')
                                  @csrf
                                  <button class="btn btn-danger btn-icon p-2">
                                    Hapus
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
	    </div>
	  </div>

    <!-- Footer -->
	@include('admin.partial.footer')
  </div>
</div>

@endsection