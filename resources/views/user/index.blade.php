@extends('user.layout.app')

@section('title' , 'Utama')

@section('content')

        <!--=====================================-->
        <!--=       Hero Banner Area Start      =-->
        <!--=====================================-->
        <div class="hero-banner hero-style-1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="banner-content">
                            <h1 class="title" data-sal-delay="100" data-sal="slide-up" data-sal-duration="1000">Sekolah Kebangsaan Taman Tun Dr. Ismail (2)</h1>
                            <div class="banner-btn" data-sal-delay="400" data-sal="slide-up" data-sal-duration="1000">
                            </div>
                            <ul class="shape-group">
                                <li class="shape-1 scene" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                    <img data-depth="2" src="assets/images/about/shape-13.png" alt="Shape">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="banner-thumbnail">
                            <div class="thumbnail" data-sal-delay="500" data-sal="slide-left" data-sal-duration="1000">
                                <img src="assets/images/banner/skttdii.png">
                            </div>
                            <ul class="shape-group">
                                <li class="shape-1" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                    <img data-depth="1.5" src="assets/images/about/shape-15.png" alt="Shape">
                                </li>
                                <li class="shape-2 scene" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                    <img data-depth="-1.5" src="assets/images/about/shape-16.png" alt="Shape">
                                </li>
                                <li class="shape-3 scene" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                    <span data-depth="3" class="circle-shape"></span>
                                </li>
                                <li class="shape-4" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                    <img data-depth="-1" src="assets/images/counterup/shape-02.png" alt="Shape">
                                </li>
                                <li class="shape-5 scene" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                    <img data-depth="1.5" src="assets/images/about/shape-13.png" alt="Shape">
                                </li>
                                <li class="shape-6 scene" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                    <img data-depth="-2" src="assets/images/about/shape-18.png" alt="Shape">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shape-7">
                <img src="assets/images/about/h-1-shape-01.png" alt="Shape">
            </div>
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
                <div class="course-view-all" data-sal-delay="150" data-sal="slide-up" data-sal-duration="1200">
                    <a href="{{route('tabung')}}" class="edu-btn">Tabung Lain<i class="icon-4"></i></a>
                </div>
            </div>
        </div>
        <!--=====================================-->
        <!--=        FAQ Area Start            =-->
        <!--=====================================-->
        <section class="edu-section-gap faq-page-area">
            <div class="container">
                <div class="section-title section-center" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <br>
                    <h2 class="title">Frequently Asked Questions (FAQ)</h2>
                    <span class="shape-line"><i class="icon-19"></i></span>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content faq-page-tab-content" id="faq-accordion">
                            <div class="tab-pane fade show active" id="gn-ques" role="tabpanel">
                                <div class="faq-accordion">
                                    <div class="accordion">
                                        <div class="accordion-item">
                                            <h5 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#question-1" aria-expanded="true">
                                                    Bagaimana cara untuk melakukan sumbangan pada Tabung?
                                                </button>
                                            </h5>
                                            <div id="question-1" class="accordion-collapse collapse show" data-bs-parent="#faq-accordion">
                                                <div class="accordion-body">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labore et dolore magna aliqua enim ad minim veniam quis nostrud exercitation ullamco qui laboris nis aliquip commodo consequat.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h5 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#question-2" aria-expanded="false">
                                                    Bolehkah sumbangan dilakukan tanpa Log Masuk ke dalam sistem?
                                                </button>
                                            </h5>
                                            <div id="question-2" class="accordion-collapse collapse" data-bs-parent="#faq-accordion">
                                                <div class="accordion-body">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labore et dolore magna aliqua enim ad minim veniam quis nostrud exercitation ullamco qui laboris nis aliquip commodo consequat.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h5 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#question-3" aria-expanded="false">
                                                    Duit yang disumbang akan disimpan di mana?
                                                </button>
                                            </h5>
                                            <div id="question-3" class="accordion-collapse collapse" data-bs-parent="#faq-accordion">
                                                <div class="accordion-body">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labore et dolore magna aliqua enim ad minim veniam quis nostrud exercitation ullamco qui laboris nis aliquip commodo consequat.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h5 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#question-4" aria-expanded="false">
                                                    Bolehkan sumbangan dilakukan di atas talian?
                                                </button>
                                            </h5>
                                            <div id="question-4" class="accordion-collapse collapse" data-bs-parent="#faq-accordion">
                                                <div class="accordion-body">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labore et dolore magna aliqua enim ad minim veniam quis nostrud exercitation ullamco qui laboris nis aliquip commodo consequat.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h5 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#question-5" aria-expanded="false">
                                                    Apakah Terma dan Syarat untuk melakukan sumbangan?
                                                </button>
                                            </h5>
                                            <div id="question-5" class="accordion-collapse collapse" data-bs-parent="#faq-accordion">
                                                <div class="accordion-body">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labore et dolore magna aliqua enim ad minim veniam quis nostrud exercitation ullamco qui laboris nis aliquip commodo consequat.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection    