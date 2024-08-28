@extends('user.layout.app')

@section('title' , 'Akaun Saya')
    
@section('content')
<style>
    .image-container {
        width: 300px;
        height: 300px;
        overflow: hidden;
        position: relative;
        border: 0px solid #ddd; 
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover; 
        position: absolute;
        top: 0;
        left: 0;
    }
</style>

        <!--=====================================-->
        <!--=       Breadcrumb Area Start      =-->
        <!--=====================================-->

        <div class="edu-breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-inner">
                    <div class="page-title">
                        <h1 class="title">Akaun Saya</h1>
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

        <div class="edu-product-description gap-bottom-equal">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="product-description-nav nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button" role="tab" aria-controls="desc" aria-selected="true">Maklumat Akaun</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false">Pengurusan Keluarga</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review1" type="button" role="tab" aria-controls="review" aria-selected="false">Pengurusan Anak</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review2" type="button" role="tab" aria-controls="review" aria-selected="false">Sejarah Pembayaran</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="product-description-content tab-pane fade show active" id="desc" role="tabpanel" aria-labelledby="desc-tab">
                                <div class="edu-team-details-area section-gap-equal">
                                    <div class="container">
                                            <div class="row row--40">
                                                <div class="col-lg-4">
                                                    <form action="{{route('gambar',['id'=>encrypt_string($acc->user_id)])}}" method="post" enctype="multipart/form-data"> 
                                                        <div class="team-details-thumb">
                                                            @csrf
                                                            <input type="text" name="id" id="id" value="{{$acc->user_id}}" hidden>
                                                            <div class="thumbnail">
                                                                <label for="user_photo" id="imageLabel">
                                                                    <div class="image-container">
                                                                        <img id="oldImage" src="@if($acc->user_photo == null) {{asset('/assets/images/user-icon.png')}} @else {{$acc->user_photo}} @endif" alt="Tekan di sini" style="cursor: pointer;">
                                                                    </div>
                                                                </label>
                                                                <br>
                                                                <div class="image-container" hidden>
                                                                    <img id="newImage" src="{{$acc->user_photo}}" alt="New Photo" style="display: none;">
                                                                </div>
                                                                <br>
                                                                <input type="file" id="user_photo" name="user_photo" style="display: none;" onchange="previewPhotos(event)">
                                                                <small>Klik gambar untuk mengemas kini gambar profil anda</small>
                                                            </div>
                                                            <button type="submit" class="edu-btn btn-medium">Kemas Kini Gambar<i class="icon-45"></i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-lg-8">
                                                    <form method="POST" action="{{route('update',['id'=>encrypt_string($acc->user_id)])}}" >
                                                        <div class="team-details-content">
                                                            <div class="login-form-box registration-form">
                                                                @csrf
                                                                <input type="text" name="id" id="id" value="{{$acc->user_id}}" hidden>
                                                                <h2>Maklumat Pengguna</h2>
                                                                <div class="form-group">
                                                                    <h4 for="guardian_name">Nama Penuh</h4>
                                                                    <input type="text" class="form-control" name="name" id="name" value="{{$acc->user_name}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <h4 for="guardian_email">E-mel</h4>
                                                                    <input type="email" class="form-control" name="email" id="email" value="{{$acc->user_email}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <h4 for="guardian_notel">Nombor Telefon</h4>
                                                                    <input type="text" class="form-control" name="notel" id="notel" value="{{$acc->user_notel}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit" class="edu-btn btn-medium">Kemas Kini<i class="icon-45"></i></button>
                                                                </div>
                                                            </div>    
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-description-content tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                <div class="container position-relative">
                                    <div class="row g-5 justify-content-center">
                                        <div class="col-lg-5">
                                            <div class="login-form-box registration-form">
                                                <h3 class="title">Tambah Penjaga</h3>
                                                <form method="POST" action="{{route ('addG')}}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="guardian_name">Nama Penuh</label>
                                                        <input type="text" name="guardian_name" id="guardian_name" placeholder="Nama penuh">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="guardian_email">E-mel</label>
                                                        <input type="email" name="guardian_email" id="guardian_email" placeholder="E-mel">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="guardian_notel">Nombor Telefon</label>
                                                        <input type="text" name="guardian_notel" id="guardian_notel" placeholder="Nombor Telefon">
                                                    </div>
                                                    <div class="form-group" hidden>
                                                        <input type="text" name="user_id" id="user_id" value="{{$acc->user_id}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="guardian_role">Hubungan Dalam Keluarga</label>
                                                        <select name="guardian_role" id="guardian_role">
                                                            <option selected>Pilih hubungan</option>
                                                            <option value="1">Bapa</option>
                                                            <option value="2">Ibu</option>
                                                            <option value="3">Penjaga</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="edu-btn btn-medium">Tambah Penjaga<i class="icon-30"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="login-form-box table-responsive">
                                                <h3 class="title">Senarai Penjaga</h3>
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="product-title">Nama</th>
                                                            <th scope="col" class="product-price">E-mel</th>
                                                            <th scope="col" class="product-status">Hubungan</th>
                                                            <th scope="col" class="product-add-cart"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($guardians as $g)
                                                        <tr>
                                                            <td hidden>
                                                                {{$g->user_id}}
                                                                {{$g->guardian_id}}
                                                            </td>
                                                            <td class="product-title" data-title="Nama">
                                                                {{$g->guardian_name}}
                                                            </td>
                                                            <td class="product-price" data-title="">
                                                                {{$g->guardian_email}}
                                                            </td>
                                                            <td class="product-status" data-title="Peranan">
                                                                @if ($g->guardian_role == 1)
                                                                    Bapa
                                                                @elseif($g->guardian_role == 2)
                                                                    Ibu
                                                                @elseif($g->guardian_role == 3)
                                                                    Penjaga
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <form id="delete-form-{{ $g->guardian_id }}" method="POST" action="{{ route('destroyG', ['id' => encrypt($g->guardian_id)]) }}" style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                                
                                                                <button type="button" class="btn btn-danger" style="padding: 10px;" onclick="confirmDelete('{{ $g->guardian_id }}')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(250, 247, 247, 1);transform: rotate(90deg);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=1);">
                                                                        <path d="M9.172 16.242 12 13.414l2.828 2.828 1.414-1.414L13.414 12l2.828-2.828-1.414-1.414L12 10.586 9.172 7.758 7.758 9.172 10.586 12l-2.828 2.828z"></path>
                                                                        <path d="M12 22c5.514 0 10-4.486 10-10S17.514 2 12 2 2 6.486 2 12s4.486 10 10 10zm0-18c4.411 0 8 3.589 8 8s-3.589 8-8 8-8-3.589-8-8 3.589-8 8-8z"></path>
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>   
                                                </table>
                                                <script>
                                                    function confirmDelete(guardianId) {
                                                        Swal.fire({
                                                            title: "Anda pasti?",
                                                            text: "Data ini akan dibuang.",
                                                            icon: "warning",
                                                            showCancelButton: true,
                                                            confirmButtonColor: "#3085d6",
                                                            cancelButtonColor: "#d33",
                                                            cancelButtonText: "Batal",
                                                            confirmButtonText: "Pasti!"
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                // Submit the form
                                                                document.getElementById('delete-form-' + guardianId).submit();
                                                            }
                                                        });
                                                    }

                                                </script>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-description-content tab-pane fade" id="review1" role="tabpanel" aria-labelledby="review-tab">
                                <div class="container position-relative">
                                    <div class="row g-5 justify-content-center">
                                        <div class="col-lg-5">
                                            <div class="login-form-box registration-form">
                                                <h3 class="title">Tambah Anak</h3>
                                                <form method="POST" action="{{route ('addS')}}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="reg-name">Nama Penuh</label>
                                                        <input type="text" name="student_name" id="student_name" placeholder="Nama penuh">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="log-name">No. Kad Pengenalan</label>
                                                        <input type="text" name="student_ic" id="student_ic"  placeholder="tanpa (-)">
                                                    </div>
                                                    <div class="form-group" hidden>
                                                        <input type="text" name="user_id" id="user_id" value="{{$acc->user_id}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="reg-name">Kelas</label>
                                                        {{-- <input type="text" name="student_class" id="student_class" placeholder="Kelas"> --}}
                                                        <select name="student_class" required>
                                                            <option value="" selected disabled>--Sila Pilih--</option>
                                                            @foreach($classes as $class)
                                                            <option value="{{$class->class_id}}">{{$class->class_standard}} {{$class->class_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="edu-btn btn-medium">Tambah Anak<i class="icon-30"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="login-form-box  table-responsive">
                                                <h3 class="title">Senarai Anak</h3>
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="product-title">Nama</th>
                                                            <th scope="col" class="product-price">No. Kad</th>
                                                            <th scope="col" class="product-status">Kelas</th>
                                                            <th scope="col" class="product-add-cart"></th>
                                                        </tr>
                                                    </thead>
                                                    @foreach ($students as $s)
                                                    <tbody>
                                                        <tr>
                                                            <td hidden>
                                                                {{$s->user_id}}
                                                            </td>
                                                            <td class="product-title">
                                                                {{$s->student_name}}
                                                            </td>
                                                            <td class="product-price" data-title="Price">
                                                                {{$s->student_ic}}
                                                            </td>
                                                            <td class="product-status" data-title="Stock">
                                                                {{$s->class_standard}} {{$s->class_name}}
                                                            </td>
                                                            <td class="product-add-cart">
                                                                <form id="delete-form-{{ $s->student_id }}" method="POST" action="{{ route('destroyS', ['id' => encrypt($s->student_id)]) }}" style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                                
                                                                <button type="button" class="btn btn-danger" style="padding: 10px;" onclick="confirmDeletee('{{ $s->student_id }}')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(250, 247, 247, 1);transform: rotate(90deg);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=1);">
                                                                        <path d="M9.172 16.242 12 13.414l2.828 2.828 1.414-1.414L13.414 12l2.828-2.828-1.414-1.414L12 10.586 9.172 7.758 7.758 9.172 10.586 12l-2.828 2.828z"></path>
                                                                        <path d="M12 22c5.514 0 10-4.486 10-10S17.514 2 12 2 2 6.486 2 12s4.486 10 10 10zm0-18c4.411 0 8 3.589 8 8s-3.589 8-8 8-8-3.589-8-8 3.589-8 8-8z"></path>
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>   
                                                </table>
                                                <script>
                                                    function confirmDeletee(studentId) {
                                                        Swal.fire({
                                                            title: "Anda pasti?",
                                                            text: "Data ini akan dibuang.",
                                                            icon: "warning",
                                                            showCancelButton: true,
                                                            confirmButtonColor: "#3085d6",
                                                            cancelButtonColor: "#d33",
                                                            cancelButtonText: "Batal",
                                                            confirmButtonText: "Pasti!"
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                // Submit the form
                                                                document.getElementById('delete-form-' + studentId).submit();
                                                            }
                                                        });
                                                    }

                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-description-content tab-pane fade" id="review2" role="tabpanel" aria-labelledby="review-tab">
                                <div class="container position-relative">
                                    <div class="row g-5 justify-content-center">
                                        <div class="col-lg-12">
                                            <div class="login-form-box registration-form">
                                                <h3 class="title">Senarai Pembayaran Yuran PIBG</h3>
                                                <table class="table cart-table wishlist-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="product-title">No. Reference</th>
                                                            <th scope="col" class="product-price">Method</th>
                                                            <th scope="col" class="product-status">Jumlah</th>
                                                            <th scope="col" class="product-add-cart">Resit</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($transaction1s as $t1)
                                                            <tr>
                                                                <td class="product-title">
                                                                    {{ $t1->transaction_invoiceno }}
                                                                </td>
                                                                <td class="product-price">
                                                                    {{ $t1->transaction_method }}
                                                                </td>
                                                                <td class="product-status">
                                                                    {{ $t1->transaction_amount }}
                                                                </td>
                                                                <td class="product-add-cart">
                                                                    <button onclick="openReceiptInNewTab('{{ route('receipt.show', $t1->transaction_invoiceno) }}')" class="btn btn-secondary btn-lg" style="width: 50%; padding:10px;">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-receipt-2">
                                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                            <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2"/>
                                                                            <path d="M14 8h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5m2 0v1.5m0 -9v1.5"/>
                                                                        </svg>
                                                                        Resit
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <script>
                                                    function openReceiptInNewTab(url) {
                                                        window.open(url, '_blank');
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="login-form-box registration-form">
                                                <h3 class="title">Senarai Pembayaran Dana</h3>
                                                <table class="table cart-table wishlist-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="product-title">No. Reference</th>
                                                            <th scope="col" class="product-price">Method</th>
                                                            <th scope="col" class="product-status">Jumlah</th>
                                                            <th scope="col" class="product-add-cart">Resit</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($transactions as $t)
                                                            <tr>
                                                                <td class="product-title">
                                                                    {{ $t->transaction_invoiceno }}
                                                                </td>
                                                                <td class="product-price">
                                                                    {{ $t->transaction_method }}
                                                                </td>
                                                                <td class="product-status">
                                                                    {{ $t->transaction_amount }}
                                                                </td>
                                                                <td class="product-add-cart">
                                                                    <button onclick="openReceiptInNewTab('{{ route('receipt.show', $t->transaction_invoiceno) }}')" class="btn btn-secondary btn-lg" style="width: 50%; padding:10px;">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-receipt-2">
                                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                            <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2"/>
                                                                            <path d="M14 8h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5m2 0v1.5m0 -9v1.5"/>
                                                                        </svg>
                                                                        Resit
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <script>
                                                    function openReceiptInNewTab(url) {
                                                        window.open(url, '_blank');
                                                    }
                                                </script>
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
        <!--=====================================-->
        <!--=     script for imgage profile     =-->
        <!--=====================================-->
        
        <script>
            function previewPhotos(event) {
                var input = event.target;
                var reader = new FileReader();
                
                reader.onload = function(){
                    var dataURL = reader.result;
                    var newImage = document.getElementById('newImage');
                    newImage.src = dataURL;

                    var oldImage = document.getElementById('oldImage');
                    oldImage.style.display = 'block'; // Show the old image

                    // Display the name of the new image below the old image
                    var imageName = input.files[0].name;
                    var imageLabel = document.createElement('p');
                    imageLabel.textContent = "New Image: " + imageName;
                    oldImage.parentNode.insertBefore(imageLabel, oldImage.nextSibling);
                };

                if (input.files && input.files[0]) {
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
new DataTable('#dataTableReport');
new DataTable('#dataTablePendingReport');
new DataTable('#dataTableApproved');
</script>
@endsection


    