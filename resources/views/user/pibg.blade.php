@extends('user.layout.app')

@section('title' , 'Yuran PIBG')
    
@section('content')
        <!--=====================================-->
        <!--=       Breadcrumb Area Start      =-->
        <!--=====================================-->
        <div class="edu-breadcrumb-area breadcrumb-style-4">
            <div class="container">
                <div class="breadcrumb-inner">
                    <div class="page-title">
                        <span class="pre-title">PIBG</span>
                        <h1 class="title">Yuran PIBG</h1>
                    </div>
                </div>
            </div>
            <ul class="shape-group">
                <li class="shape-1">
                    <span></span>
                </li>
                <li class="shape-2 scene"><img data-depth="2" src="assets/images/about/shape-13.png" alt="shape"></li>
                <li class="shape-3 scene"><img data-depth="-2" src="assets/images/about/shape-15.png" alt="shape"></li>
                <li class="shape-4">
                    <span></span>
                </li>
                <li class="shape-5 scene"><img data-depth="2" src="assets/images/about/shape-07.png" alt="shape"></li>
            </ul>
        </div>

        <!--=====================================-->
        <!--=        Event Area Start         =-->
        <!--=====================================-->
        {{-- <section class="event-details-area edu-section-gap">
            <div class="container">
                <div class="event-details">
                    <div class="row row--30">
                        <div class="col-lg-12">
                            <div class="details-content">
                                <h3>Pastikan maklumat anak anda adalah maklumat yang terkini dan lengkap.</h3>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="order-summery checkout-summery">
                                <div class="summery-table-wrap">
                                    <h4 class="title">Bayaran Anda</h4>
                                    <table class="table summery-table">
                                        <tbody>
                                            <tr>
                                                <td>Sumbangan PIBG & Majalah Sekolah <span class="quantity"> x 1</span></td>
                                                <td>RM 70</td>
                                            </tr>
                                            <tr>
                                                <td>Sumbangan Tahun 1 hingga 5 <span class="quantity"> x {{$perdana}}</span></td>
                                                <td>RM {{$Jperdana = 60 * $perdana}}</td>
                                            </tr>
                                            <tr>
                                                <td>Sumbangan Tahun 6<span class="quantity"> x {{$enam}}</span></td>
                                                <td>RM {{$Jenam = 260 * $enam}}</td>
                                            </tr>
                                            <tr>
                                                <td>Sumbangan Pelajar (PPKI) <span class="quantity"> x {{$ppki}}</span></td>
                                                <td>RM {{$Jppki = 610 * $ppki}}</td>
                                            </tr>
                                            <tr class="order-subtotal">
                                                <td>Jumlah</td>
                                                <td>RM {{$J = 70 + $Jperdana + $Jenam + $Jppki}}</td>
                                            </tr>
                                            <tr class="order-total">
                                                <td>Jumlah Sumbangan</td>
                                                <td>RM {{$J = 70 + $Jperdana + $Jenam + $Jppki}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                        <div class="read-more-btn">
                            <form action="{{route('feepayment')}}" method="post">
                                @csrf
                                <input type="text" name="name" value="@if(Auth::check()){{$acc->user_name}}@endif" required hidden>
                                <input type="email" name="email" value="@if(Auth::check()){{$acc->user_email}}@endif" required hidden>
                                <input type="text" name="notel" value="@if(Auth::check()){{$acc->user_notel}}@endif" required hidden>
                                <input type="text" name="amount" value="{{$J}}" required hidden>
                                <input type="text" name="tabung" value="Bayaran Sumbangan PIBG" required hidden>
                                <input type="text" name="fund_id" value="{{$pibg->fee_session_id = '1'}}" required>
                                <p>Dengan melengkapkan pembayaran ini anda bersetuju menerima Terma dan Syarat yang dikenakan.</p>
                                <button type="submit" class="edu-btn order-place">Bayar<i class="icon-4"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <section class="section-gap-equal">
            <div class="container">
                <div class="row row--30">
                    <div class="col-lg-12">
                        <div class="edu-blog blog-style-list" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                            <div class="inner">
                                <div class="content">
                                    <h5 class="title"><a href="">Sumbangan PIBG & Majalah Sekolah (RM 70)</a></h5>
                                    <p>Setiap 1 Keluarga</p>
                                    <div class="read-more-btn">
                                        <a class="edu-btn btn-border btn-medium" href="">Lanjut<i class="icon-4"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach ($students as $s)
                            <div class="edu-blog blog-style-list" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                <div class="inner">
                                    <div class="content">
                                        <h5 class="title">
                                            <a href="">{{$s->student_name}}</a>
                                        </h5>
                                        <p>Jumlah selesai bayaran: RM {{number_format($fees, 2)}}</p>
                                        <p>Jumlah baki yuran: RM {{number_format($s->student_fee - $fees, 2)}}</p>
                                        <div class="read-more-btn">
                                            <a href="{{route('yuran',['id'=>encrypt_string($s->student_id)])}}" class="edu-btn btn-border btn-medium">Lanjut<i class="icon-4"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
@endsection
