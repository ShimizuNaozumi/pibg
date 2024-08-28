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
                        <h1 class="title">Pembayaran Berjaya</h1>
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
        <style>
          .receipt-container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          }
          .receipt-header {
            text-align: center;
            margin-bottom: 20px;
          }
          .receipt-details {
            margin-bottom: 20px;
          }
          .receipt-footer {
            text-align: center;
            margin-top: 20px;
          }
          .button-container {
            text-align: center;
            margin-top: 20px;
          }
          .hide-for-pdf {
            display: none;
          }
        </style>
        <div class="container">
          <br>
          <div class="receipt-container" id="receipt">
            <div class="receipt-header">
              <h4>Terima kasih atas sumbangan anda!</h4>
            </div>
            <div class="receipt-details">
              <div class="row">
                <div class="col-6"><strong>No. Invois:</strong></div>
                <div class="col-6 text-right">{{ $transaction->transaction_invoiceno }}</div>
              </div>
              <div class="row">
                <div class="col-6"><strong>Status:</strong></div>
                <div class="col-6 text-right">
                  @if ($transaction->transaction_status == 1)
                    Berjaya
                  @elseif ($transaction->transaction_status == 3)
                    Gagal
                  @else
                    Dalam Proses
                  @endif
                </div>
              </div>
              <div class="row">
                <div class="col-6"><strong>Kaedah Pembayaran:</strong></div>
                <div class="col-6 text-right">{{ $transaction->transaction_method }}</div>
              </div>
              <div class="row">
                <div class="col-6"><strong>No. Rujukan:</strong></div>
                <div class="col-6 text-right">{{ $transaction->transaction_refno }}</div>
              </div>
              <div class="row">
                <div class="col-6"><strong>Tarikh:</strong></div>
                <div class="col-6 text-right">{{ \Carbon\Carbon::parse($transaction->transaction_issued_date)->format('d/m/Y') }}</div>
              </div>
              <div class="row">
                <div class="col-6"><strong>Masa:</strong></div>
                <div class="col-6 text-right">{{ \Carbon\Carbon::parse($transaction->transaction_issued_date)->format('h:i A') }}</div>
              </div>
            </div>
            <div class="receipt-footer">
              <p>Simpan resit ini sebagai bukti pembayaran anda.</p>
            </div>
            <div class="button-container">
              <button onclick="openReceiptInNewTab('{{ $transaction->transaction_code }}')" class="btn btn-secondary btn-lg" style="width: 50%; padding:10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-receipt-2">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2"/>
                    <path d="M14 8h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5m2 0v1.5m0 -9v1.5"/>
                </svg>
                Muat Turun Resit
            </button>
            <script>
              function openReceiptInNewTab(billCode) {
                  window.open('{{ route('showReceipt', ['billCode' => '']) }}' + billCode, '_blank');
              }
              </script>
            </div>
          </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
</body>
@endsection