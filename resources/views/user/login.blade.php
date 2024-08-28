@extends('user.layout.app')

@section('title' , 'Log Masuk')

@section('content')
        <!--=====================================-->
        <!--=       Breadcrumb Area Start      =-->
        <!--=====================================-->


        <div class="edu-breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-inner">
                    <div class="page-title">
                        <h1 class="title">Log Masuk</h1>
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
        <!--=          Login Area Start         =-->
        <!--=====================================-->
        <section class="account-page-area section-gap-equal">
            <div class="container position-relative">
                <div class="row g-5 justify-content-center">
                    <div class="col-lg-5">
                        <div class="login-form-box">
                            <h3 class="title">Log Masuk</h3>
                            <form method="post" action="{{route ('auth_user')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="current-log-email">E-mel</label>
                                    <input type="email" name="email" id="current-log-email" placeholder="E-mel">
                                </div>
                                <div class="form-group">
                                    <label for="current-log-password">Kata Laluan</label>
                                    <input type="password" name="password" id="current-log-password" placeholder="Kata laluan">
                                </div>
                                <div class="form-group chekbox-area">
                                    <div class="edu-form-check">
                                        <input type="checkbox" id="show-password-checkbox">
                                        <label for="show-password-checkbox">Tunjuk Kata Laluan</label>
                                    </div>
                                    <a href="#" class="password-reset">Lupa Kata Laluan</a>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="edu-btn btn-medium">Log Masuk<i class="icon-4"></i></button>
                                </div>
                            </form>
                        </div>
                        
                        <script>
                            document.getElementById('show-password-checkbox').addEventListener('change', function() {
                                var passwordField = document.getElementById('current-log-password');
                                if (this.checked) {
                                    passwordField.type = 'text';
                                } else {
                                    passwordField.type = 'password';
                                }
                            });
                        </script>
                        
                    </div>
                </div>
                <ul class="shape-group">
                    <li class="shape-1 scene"><img data-depth="2" src="assets/images/about/shape-07.png" alt="Shape"></li>
                    <li class="shape-2 scene"><img data-depth="-2" src="assets/images/about/shape-13.png" alt="Shape"></li>
                    <li class="shape-3 scene"><img data-depth="2" src="assets/images/counterup/shape-02.png" alt="Shape"></li>
                </ul>
            </div>
        </section>
@endsection
        