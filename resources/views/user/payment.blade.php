@extends('user.layout.app')

@section('title' , 'Pembayaran')

@section('content')
        <!--=====================================-->
        <!--=       Breadcrumb Area Start      =-->
        <!--=====================================-->
        <div class="edu-breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-inner">
                    <div class="page-title">
                        <span class="pre-title">Sumbangan Tabung</span>
                        <h1 class="title">{{$details->fund_name}}</h1>
                    </div>
                </div>
            </div>
            <ul class="shape-group">
                <li class="shape-1">
                    <span></span>
                </li>
                <li class="shape-2 scene"><img data-depth="2" src="../../assets/images/about/shape-13.png" alt="shape"></li>
                <li class="shape-3 scene"><img data-depth="-2" src="../../assets/images/about/shape-15.png" alt="shape"></li>
                <li class="shape-4">
                    <span></span>
                </li>
                <li class="shape-5 scene"><img data-depth="2" src="../../assets/images/about/shape-07.png" alt="shape"></li>
            </ul>
        </div>

        <!--=====================================-->
        <!--=       Checkout Area Start         =-->
        <!--=====================================-->
        <section class="checkout-page-area section-gap-equal">
            <div class="container">
                <a href="{{ url()->previous() }}" class="btn btn-secondary fs-2 mb-5 rounded-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                    </svg>
                </a>
                <br>
                <form action="{{route('pay')}}" method="post">
                    @csrf
                    <div class="row row--25">
                        <div class="col-lg-6">
                            <div class="checkout-billing">
                                <h3 class="title">Maklumat Pengguna</h3>
                                <div class="row g-lg-5">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="name" value="@if(Auth::check()){{$acc->user_name}}@endif" placeholder="Masukkan nama penuh" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>E-mel</label>
                                    <input type="email" name="email" value="@if(Auth::check()){{$acc->user_email}}@endif" placeholder="Masukkan e-mel" required>
                                </div>
                                <div class="row g-lg-5">
                                    <div class="form-group">
                                    <label>No. Telefon</label>
                                        <input type="text" name="notel" value="@if(Auth::check()){{$acc->user_notel}}@endif" placeholder="Masukkan no. telefon" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="order-payment" hidden>
                                <h4 class="title">Tabung</h4>
                                <div class="payment-method">
                                    <div class="form-group">
                                        <div class="edu-form-check">
                                            <label for="pay-bank">{{$details->fund_name}}</label>
                                            <input type="text" name="tabung" value="{{$details->fund_name}}">
                                            <input type="text" name="fund_id" value="{{$details->fund_id}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="order-payment">
                                <h4 class="title">Pembayaran</h4>
                                <div class="row g-lg-5 mb-5">
                                    <div class="form-group">
                                        <label>Jumlah Sumbangan (RM)</label>

                                        <div class="mx-auto">
                                            <input type="radio" class="btn-check btn-secondary" name="options-base" id="amount5" value="5" autocomplete="off">
                                            <label class="btn px-5 py-4 btn-outline-primary" for="amount5">RM 5</label>
                                    
                                            <input type="radio" class="btn-check btn-secondary" name="options-base" id="amount10" value="10" autocomplete="off">
                                            <label class="btn px-5 py-4 btn-outline-primary" for="amount10">RM 10</label>
                                    
                                            <input type="radio" class="btn-check btn-secondary" name="options-base" id="amount15" value="15" autocomplete="off">
                                            <label class="btn px-5 py-4 btn-outline-primary" for="amount15">RM 15</label>

                                            <input type="radio" class="btn-check btn-secondary" name="options-base" id="amount20" value="20" autocomplete="off">
                                            <label class="btn px-5 py-4 btn-outline-primary" for="amount20">RM 20</label>
                                        </div>

                                
                                        <input class="border" type="number" name="amount" id="amount" placeholder="00.00" step="0.01" min="2.0" required>
                                        <small>Min: RM2.00</small>
                                    </div>
                                </div>
                                <p>Dengan melengkapkan pembayaran ini anda bersetuju menerima Terma dan Syarat yang dikenakan.</p>
                                <button type="submit" class="edu-btn order-place">Bayar<i class="icon-4"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        
                                
        <script>
            document.querySelectorAll('input[name="options-base"]').forEach((radio) => {
                radio.addEventListener('change', function() {
                    document.getElementById('amount').value = this.value;
                });
            });
        
            // Initialize the input field with the checked radio button's value
            document.getElementById('amount').value = document.querySelector('input[name="options-base"]:checked').value;
        </script>    
@endsection
