@extends('user.layout.app')

@section('title' , 'Tabung')

@section('content')
        <!--=====================================-->
        <!--=       Breadcrumb Area Start      =-->
        <!--=====================================-->
        <div class="edu-breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-inner">
                    <div class="page-title">
                        <h1 class="title">Tabung</h1>
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
        <!--=       Tabung Start      	=-->
        <!--=====================================-->
        <div class="gap-bottom-equal edu-about-area about-style-1">
            <div class="container">
                <div class="section-title section-center" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <br>
                    <h2 class="title">Dana Yang Diperlukan</h2>
                    <span class="shape-line"><i class="icon-19"></i></span>
                </div>
                <div class="row g-5">
                    <!-- Start Single Course  -->
                    @foreach($funds as $fund)
                        <div class="col-md-6 col-lg-4" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                            <div class="edu-course course-style-3 course-box-shadow">
                                <div class="inner">
                                    <div class="thumbnail" style="overflow: hidden; height: 250px;">
                                        <a href="">
                                            <img src="{{$fund->fund_image_path}}" style="width: 100%; height: auto; object-fit: cover;" alt="Course Meta">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="title">
                                            <a href="{{route('detail',['id'=>encrypt_string($fund->fund_id)])}}">{{$fund->fund_name}}</a>
                                        </h5>
                                        <?php
                                            $desc = Str::limit(strip_tags($fund->fund_purpose), 90); 
                                        ?>
                                        <p>{!! $desc !!}</p>
                                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{($fund->total_donations / $fund->fund_target) * 100}}" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-success" style="width: {{($fund->total_donations / $fund->fund_target) * 100}}%;"></div>
                                        </div>
                                        <div class="text-end">{{ number_format(min(($fund->total_donations / $fund->fund_target) * 100, 100), 0) }}%</div>
                                        <div class="read-more-btn">
                                            <a class="edu-btn btn-small btn-secondary" href="{{route('detail',['id'=>encrypt_string($fund->fund_id)])}}">Lanjut<i class="icon-4"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- End Single Course  -->
                </div>
            </div>
        </div>
    
@endsection