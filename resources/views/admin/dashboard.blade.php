@extends('admin.layout.layout')

@section('title','Dashboard')

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
			  <h2 class="page-title">Dashboard</h2>
		    </div>
		  </div>
		  <div class="row mt-1 g-2 align-items-center">
		    <div class="col">
				@if($acc->last_login_date)
				<div class="text-muted">Log masuk terakhir: {{date('d/m/Y', strtotime($acc->last_login_date))}}</div>
				@endif
		    </div>
		  </div>
	    </div>
	  </div>

	  <!-- Page body -->
	  <div class="page-body">
		<div class="container-xl">
		  {{-- stat --}}
		  <div class="row row-cards">
			<div class="col-sm-6 col-lg-3" onclick="window.location='{{route('users')}}'" style="cursor: pointer;">
			  <div class="card card-sm rounded-3 border-0 shadow-sm">
				<div class="card-body rounded-3 bg-primary-lt p-5">
				  <div class="row align-items-center">
					<div class="col-auto">
					  <span class="bg-primary text-white avatar">
						<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
					  </span>
					</div>
					<div class="col">
					  <div class="font-weight-medium fs-1">
						{{$statUsers}}
					  </div>
					  <div class="text-secondary">
						Jumlah Pengguna
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
			<div class="col-sm-6 col-lg-3" onclick="window.location='{{route('classes')}}'" style="cursor: pointer;">
			  <div class="card card-sm rounded-3 border-0 shadow-sm">
				<div class="card-body rounded-3 bg-indigo-lt p-5">
				  <div class="row align-items-center">
					<div class="col-auto">
					  <span class="bg-indigo text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
						<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-school"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" /><path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" /></svg>
					  </span>
					</div>
					<div class="col">
					  <div class="font-weight-medium fs-1">
						{{$statStudents}}
					  </div>
					  <div class="text-secondary">
						Jumlah Pelajar
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
			<div class="col-sm-6 col-lg-3" @if($acc->admin_category == 'superadmin') onclick="window.location='{{route('admins')}}'" style="cursor: pointer;" @endif>
			  <div class="card card-sm rounded-3 border-0 shadow-sm">
				<div class="card-body rounded-3 bg-orange-lt p-5">
				  <div class="row align-items-center">
					<div class="col-auto">
					  <span class="bg-orange text-white avatar">
						<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-shield"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 21v-2a4 4 0 0 1 4 -4h2" /><path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" /><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /></svg>
					  </span>
					</div>
					<div class="col">
					  <div class="font-weight-medium fs-1">
						{{$statAdmins}}
					  </div>
					  <div class="text-secondary">
						Pentadbir
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
			<div class="col-sm-6 col-lg-3"  onclick="window.location='{{route('fund')}}'" style="cursor: pointer;">
			  <div class="card card-sm rounded-3 border-0 shadow-sm">
				<div class="card-body rounded-3 bg-yellow-lt p-5">
				  <div class="row align-items-center">
					<div class="col-auto">
					  <span class="bg-yellow text-white avatar">
						<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-moneybag"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9.5 3h5a1.5 1.5 0 0 1 1.5 1.5a3.5 3.5 0 0 1 -3.5 3.5h-1a3.5 3.5 0 0 1 -3.5 -3.5a1.5 1.5 0 0 1 1.5 -1.5z" /><path d="M4 17v-1a8 8 0 1 1 16 0v1a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" /></svg>
					  </span>
					</div>
					<div class="col">
					  <div class="font-weight-medium fs-1">
						{{$statFunds}}
					  </div>
					  <div class="text-secondary">
						Tabung
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		  </div>

		  <div class="row row-cards mt-1">
			<div class="col-lg-6" onclick="window.location='{{route('donation')}}'" style="cursor: pointer;">
			  <div class="card card-sm rounded-3 border-0 shadow-sm">
				<div class="card-body rounded-3 bg-teal-lt p-5">
				  <div class="row align-items-center">
					<div class="col-auto">
					  <span class="bg-teal text-white avatar">
						<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-tax-pound"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.487 21h7.026a4 4 0 0 0 3.808 -5.224l-1.706 -5.306a5 5 0 0 0 -4.76 -3.47h-1.71a5 5 0 0 0 -4.76 3.47l-1.706 5.306a4 4 0 0 0 3.808 5.224" /><path d="M15 3q -1 4 -3 4t -3 -4z" /><path d="M14 11h-1a2 2 0 0 0 -2 2v2c0 1.105 -.395 2 -1.5 2h4.5" /><path d="M10 14h3" /></svg>
					  </span>
					</div>
					<div class="col">
					  <div class="font-weight-medium fs-1">
						RM {{formatNumberShort($statDonations)}}
					  </div>
					  <div class="text-secondary">
						Sumbangan Tabung
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
			<div class="col-lg-6">
			  <div class="card card-sm rounded-3 border-0 shadow-sm" style="cursor: pointer;">
				<div class="card-body rounded-3 bg-teal-lt p-5">
				  <div class="row align-items-center">
					<div class="col-auto">
					  <span class="bg-teal text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
						<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-dollar"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h3" /><path d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" /><path d="M19 21v1m0 -8v1" /></svg>
					  </span>
					</div>
					<div class="col">
					  <div class="font-weight-medium fs-1">
						RM 0
					  </div>
					  <div class="text-secondary">
						Yuran PIBG
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		  {{-- end stat --}}

		  {{-- graph --}}
		  <div class="row mt-3">
			<div class="col-lg-6 mb-3">
                <div class="card rounded-3 shadow-sm">
                  <div class="card-body">
                    <div id="donation-chart"></div>
                  </div>
                </div>
            </div>
			<div class="col-lg-6">
                <div class="card rounded-3 shadow-sm">
                  <div class="card-body">
                    <div id="fee-chart"></div>
                  </div>
                </div>
            </div>
		  </div>
		  {{-- end grph --}}

		  {{-- record --}}
		  <div class="row row-card mt-3">
			<div class="col-xl-6">
			  <div class="card rounded-3 shadow-sm">
				<div class="card-header">
				  <h3 class="card-title">Pengguna Berdaftar Terkini</h3>
				</div>
				<div class="list-group list-group-flush list-group">
				  @foreach($users as $user)
				  <div class="list-group-item">
					<div class="row align-items-center">
					  <div class="col-auto">
						<span class="avatar bg-primary-lt">
							<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
						</span>
					  </div>
					  <div class="col text-truncate">
						<div class="text-reset d-block">{{$user->user_name}}</div>
						<div class="d-block text-secondary text-truncate mt-n1 fs-5">{{$user->user_email}}</div>
					  </div>
					  <div class="col-auto">
						{{date('d/m/Y', strtotime($user->created_at))}}
					  </div>
					</div>
				  </div>
				  @endforeach
				</div>
			  </div>
			</div>
			
			<div class="col-xl-6">
                <div class="row row-cards">
                  <div class="col-12 mt-3">
                    <div class="card rounded-3 shadow-sm">
						<div class="card-header">
						  <h3 class="card-title">Pembayaran Yuran Terkini</h3>
						</div>
						<div class="list-group list-group-flush list-group">
						  <div class="list-group-item">
							<div class="row align-items-center">
							  <div class="col-auto">
								<span class="avatar bg-teal-lt">
									<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-coin"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" /><path d="M12 7v10" /></svg>
								</span>
                              </div>
							  <div class="col text-truncate">
								<div class="text-reset d-block">name</div>
								<div class="d-block text-secondary text-truncate mt-n1 fs-5">invoice</div>
							  </div>
							  <div class="col-auto">
								date
							  </div>
							</div>
						  </div>
						</div>
					  </div>
                  </div>
                  <div class="col-12">
                    <div class="card rounded-3 shadow-sm">
						<div class="card-header">
						  <h3 class="card-title">Sumbangan Terkini</h3>
						</div>
						<div class="list-group list-group-flush list-group">
						  @foreach($donors as $donor)
						  <div class="list-group-item">
							<div class="row align-items-center">
							  <div class="col-auto">
								<span class="avatar bg-teal-lt">
									<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-tax-pound"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.487 21h7.026a4 4 0 0 0 3.808 -5.224l-1.706 -5.306a5 5 0 0 0 -4.76 -3.47h-1.71a5 5 0 0 0 -4.76 3.47l-1.706 5.306a4 4 0 0 0 3.808 5.224" /><path d="M15 3q -1 4 -3 4t -3 -4z" /><path d="M14 11h-1a2 2 0 0 0 -2 2v2c0 1.105 -.395 2 -1.5 2h4.5" /><path d="M10 14h3" /></svg>
								</span>
                              </div>
							  <div class="col text-truncate">
								<div class="text-reset d-block">{{$donor->donor_name}}</div>
								<div class="d-block text-secondary text-truncate mt-n1 fs-5">{{$donor->donor_email}}</div>
							  </div>
							  <div class="col-auto">
								{{date('d/m/Y', strtotime($donor->created_at))}}
							  </div>
							</div>
						  </div>
						  @endforeach
						</div>
					  </div>
                  </div>
                </div>
            </div>
		  </div>
		  {{-- end record --}}
		</div>
	  </div>

	<!-- Footer -->
	@include('admin.partial.footer')
	</div>
</div>
<script>
	document.addEventListener("DOMContentLoaded", function () {
		var donationMonths = @json($donationMonths);
		var donationAmounts = @json($donationAmounts);
	
		var options = {
			chart: {
				type: "line",
				fontFamily: 'inherit',
				height: 240,
				parentHeightOffset: 0,
				toolbar: {
					show: false,
				},
				animations: {
					enabled: false
				},
			},
			fill: {
				opacity: 1,
			},
			stroke: {
				width: 2,
				lineCap: "round",
				curve: "straight",
			},
			series: [{
				name: "Jumlah (RM)",
				data: donationAmounts
			}],
			tooltip: {
				theme: 'dark'
			},
			grid: {
				padding: {
					top: -20,
					right: 0,
					left: -4,
					bottom: -4
				},
				strokeDashArray: 4,
			},
			xaxis: {
				labels: {
					padding: 0,
				},
				tooltip: {
					enabled: false
				},
				type: 'category',
				categories: donationMonths.map(month => `${month}`)
			},
			yaxis: {
				labels: {
					padding: 4
				},
			},
			colors: [tabler.getColor("teal")],
			legend: {
				show: false,
			},
		};
	
		var chart = new ApexCharts(document.getElementById('donation-chart'), options);
		chart.render();
	});
	</script>
<script>
	// @formatter:off
	document.addEventListener("DOMContentLoaded", function () {
		window.ApexCharts && (new ApexCharts(document.getElementById('fee-chart'), {
			chart: {
				type: "line",
				fontFamily: 'inherit',
				height: 240,
				parentHeightOffset: 0,
				toolbar: {
					show: false,
				},
				animations: {
					enabled: false
				},
			},
			fill: {
				opacity: 1,
			},
			stroke: {
				width: 2,
				lineCap: "round",
				curve: "straight",
			},
			series: [{
				name: "Tasks completion",
				data: [155, 65, 465, 265, 225, 325, 80]
			}],
			tooltip: {
				theme: 'dark'
			},
			grid: {
				padding: {
					top: -20,
					right: 0,
					left: -4,
					bottom: -4
				},
				strokeDashArray: 4,
			},
			xaxis: {
				labels: {
					padding: 0,
				},
				tooltip: {
					enabled: false
				},
				type: 'datetime',
			},
			yaxis: {
				labels: {
					padding: 4
				},
			},
			labels: [
				'2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26'
			],
			colors: [tabler.getColor("teal")],
			legend: {
				show: false,
			},
		})).render();
	});
	// @formatter:on
  </script>
@endsection