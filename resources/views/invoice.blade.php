<!doctype html>
<html class="" lang="zxx">

<head>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <meta charset="utf-8">
    <meta name="csrf-token" content="">
    <title>{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name') }}</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">


    <!--==============================
	    All CSS File
	============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('invoice-assets/css/bootstrap.min.css')}}">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('invoice-assets/css/style.css')}}">

</head>

<body>

    <div class="invoice-container-wrap">
        <div class="invoice-container">
            <main>
                <!--==============================
                    Invoice Area
                    ==============================-->
                <div class="themeholy-invoice invoice_style14">
                    <div class="download-inner" id="download_section">
                        <!--==============================
                            Header Area
                        ==============================-->
                        <header class="themeholy-header header-layout10">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto">
                                    <div class="header-logo">
                                        <a href="index.html"><img src="{{asset('frontend/assets/images/logo.png')}}" class="" style="width: 70px;" alt="kbn logo"></a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h1 class="big-title">Invoice</h1>
                                    <span><b>Invoice No: </b> #{{ $customer->id }}</span>
                                    <span><b>Date: </b> {{ $customer->created_at }}</span>
                                </div>
                            </div>
                        </header>
                        <div class="address-bg1 mt-4">
                            <div class="row gx-0 justify-content-between">
                                <div class="col-6">
                                    <div class="invoice-left border-right">
                                        <b>Invoice To:</b>
                                        <address>
                                            {{ $customer->customer->first_name .' '.  $customer->customer->last_name}} <br> 
                                            email : {{ $customer->customer->email }}
                                        </address>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="invoice-right">
                                        <b>From Shop:</b>
                                        <address>
                                            KBN <br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-between my-4">
                            <div class="col-6">
                                <div class="text-start">
                                    <b>Order Date:</b> <br>
                                    <span>{{ $customer->created_at }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <b>Payment Method:</b> <br>
                                    <span>Transfer</span>
                                </div>
                            </div>
                        </div>

                        <table class="invoice-table table-stripe3">
                            <thead>
                                <tr>
                                    <th>Product No.</th>
                                    <th>Product Description</th>
                                    <th>Price</th>
                                    <th>Qty Sold</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td>711011</td>
                                    <td>{{ $order->product->name ?? ''  }}</td>
                                    <td>{{ $order->product->nett_price ?? ''  }}</td>
                                    <td>{{ $order->product->sold_qty ?? ''  }}</td>
                                    <td>{{ $order->product->total_amount ?? ''  }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <div class="invoice-left">
                                    <b>Payment Info:</b>
                                    <p class="mb-0">Credit Card No: 2456********** <br> A/C Name: Alex Farnandes</p>
                                </div>
                            </div>
                            <div class="col-auto">
                                <table class="total-table">
                                    <tr>
                                        <th>Sub Total:</th>
                                        <td>Rp 1150.00</td>
                                    </tr>
                                    <tr>
                                        <th>Tax:</th>
                                        <td>Rp 50.00</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>Rp 1200.00</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <p class="company-address style2">
                            <b>Invar Inc:</b> <br>
                            12th Floor, Plot No.5, IFIC Bank, Gausin Rod, Suite 250-20, Franchisco USA 2022.
                        </p>
                        <p class="invoice-note mt-3">
                            <svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.64581 13.7917H10.3541V12.5417H3.64581V13.7917ZM3.64581 10.25H10.3541V9.00002H3.64581V10.25ZM1.58331 17.3334C1.24998 17.3334 0.958313 17.2084 0.708313 16.9584C0.458313 16.7084 0.333313 16.4167 0.333313 16.0834V1.91669C0.333313 1.58335 0.458313 1.29169 0.708313 1.04169C0.958313 0.791687 1.24998 0.666687 1.58331 0.666687H9.10415L13.6666 5.22919V16.0834C13.6666 16.4167 13.5416 16.7084 13.2916 16.9584C13.0416 17.2084 12.75 17.3334 12.4166 17.3334H1.58331ZM8.47915 5.79169V1.91669H1.58331V16.0834H12.4166V5.79169H8.47915ZM1.58331 1.91669V5.79169V1.91669V16.0834V1.91669Z" fill="#2D7CFE" />
                            </svg>

                            <b>NOTE: </b>This is computer generated receipt and does not require physical signature.
                        </p>
                        <div class="footer-info">
                            <div class="row gx-0 justify-content-center">
                                <div class="col-auto">
                                    <span class="info left">Call: +153 654 3648</span>
                                </div>
                                <div class="col-auto">
                                    <span class="info right">www.Invarsupershop.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-buttons">
                        <button class="print_btn">
                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.25 13H3.75C3.38542 13 3.08594 13.1172 2.85156 13.3516C2.61719 13.5859 2.5 13.8854 2.5 14.25V19.25C2.5 19.6146 2.61719 19.9141 2.85156 20.1484C3.08594 20.3828 3.38542 20.5 3.75 20.5H16.25C16.6146 20.5 16.9141 20.3828 17.1484 20.1484C17.3828 19.9141 17.5 19.6146 17.5 19.25V14.25C17.5 13.8854 17.3828 13.5859 17.1484 13.3516C16.9141 13.1172 16.6146 13 16.25 13ZM16.25 19.25H3.75V14.25H16.25V19.25ZM17.5 8V3.27344C17.5 2.90885 17.3828 2.60938 17.1484 2.375L15.625 0.851562C15.3646 0.617188 15.0651 0.5 14.7266 0.5H5C4.29688 0.526042 3.71094 0.773438 3.24219 1.24219C2.77344 1.71094 2.52604 2.29688 2.5 3V8C1.79688 8.02604 1.21094 8.27344 0.742188 8.74219C0.273438 9.21094 0.0260417 9.79688 0 10.5V14.875C0.0260417 15.2656 0.234375 15.474 0.625 15.5C1.01562 15.474 1.22396 15.2656 1.25 14.875V10.5C1.25 10.1354 1.36719 9.83594 1.60156 9.60156C1.83594 9.36719 2.13542 9.25 2.5 9.25H17.5C17.8646 9.25 18.1641 9.36719 18.3984 9.60156C18.6328 9.83594 18.75 10.1354 18.75 10.5V14.875C18.776 15.2656 18.9844 15.474 19.375 15.5C19.7656 15.474 19.974 15.2656 20 14.875V10.5C19.974 9.79688 19.7266 9.21094 19.2578 8.74219C18.7891 8.27344 18.2031 8.02604 17.5 8ZM16.25 8H3.75V3C3.75 2.63542 3.86719 2.33594 4.10156 2.10156C4.33594 1.86719 4.63542 1.75 5 1.75H14.7266L16.25 3.27344V8ZM16.875 10.1875C16.3021 10.2396 15.9896 10.5521 15.9375 11.125C15.9896 11.6979 16.3021 12.0104 16.875 12.0625C17.4479 12.0104 17.7604 11.6979 17.8125 11.125C17.7604 10.5521 17.4479 10.2396 16.875 10.1875Z" fill="#00C764" />
                            </svg>
                        </button>
                        <button id="download_btn" class="download_btn">
                            <svg width="25" height="19" viewBox="0 0 25 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.94531 11.1797C8.6849 10.8932 8.6849 10.6068 8.94531 10.3203C9.23177 10.0599 9.51823 10.0599 9.80469 10.3203L11.875 12.3516V6.375C11.901 5.98438 12.1094 5.77604 12.5 5.75C12.8906 5.77604 13.099 5.98438 13.125 6.375V12.3516L15.1953 10.3203C15.4818 10.0599 15.7682 10.0599 16.0547 10.3203C16.3151 10.6068 16.3151 10.8932 16.0547 11.1797L12.9297 14.3047C12.6432 14.5651 12.3568 14.5651 12.0703 14.3047L8.94531 11.1797ZM10.625 0.75C11.7969 0.75 12.8646 1.01042 13.8281 1.53125C14.8177 2.05208 15.625 2.76823 16.25 3.67969C16.8229 3.39323 17.4479 3.25 18.125 3.25C19.375 3.27604 20.4036 3.70573 21.2109 4.53906C22.0443 5.34635 22.474 6.375 22.5 7.625C22.5 8.01562 22.4479 8.41927 22.3438 8.83594C23.151 9.2526 23.7891 9.85156 24.2578 10.6328C24.7526 11.4141 25 12.2865 25 13.25C24.974 14.6562 24.4922 15.8411 23.5547 16.8047C22.5911 17.7422 21.4062 18.224 20 18.25H5.625C4.03646 18.1979 2.70833 17.651 1.64062 16.6094C0.598958 15.5417 0.0520833 14.2135 0 12.625C0.0260417 11.375 0.377604 10.2812 1.05469 9.34375C1.73177 8.40625 2.63021 7.72917 3.75 7.3125C3.88021 5.4375 4.58333 3.88802 5.85938 2.66406C7.13542 1.4401 8.72396 0.802083 10.625 0.75ZM10.625 2C9.08854 2.02604 7.78646 2.54688 6.71875 3.5625C5.67708 4.57812 5.10417 5.85417 5 7.39062C4.94792 7.91146 4.67448 8.27604 4.17969 8.48438C3.29427 8.79688 2.59115 9.33073 2.07031 10.0859C1.54948 10.8151 1.27604 11.6615 1.25 12.625C1.27604 13.875 1.70573 14.9036 2.53906 15.7109C3.34635 16.5443 4.375 16.974 5.625 17H20C21.0677 16.974 21.9531 16.6094 22.6562 15.9062C23.3594 15.2031 23.724 14.3177 23.75 13.25C23.75 12.5208 23.5677 11.8698 23.2031 11.2969C22.8385 10.724 22.3568 10.2682 21.7578 9.92969C21.2109 9.59115 21.0026 9.09635 21.1328 8.44531C21.2109 8.21094 21.25 7.9375 21.25 7.625C21.224 6.73958 20.9245 5.9974 20.3516 5.39844C19.7526 4.82552 19.0104 4.52604 18.125 4.5C17.6302 4.5 17.1875 4.60417 16.7969 4.8125C16.1719 5.04688 15.651 4.90365 15.2344 4.38281C14.7135 3.65365 14.0495 3.08073 13.2422 2.66406C12.4609 2.22135 11.5885 2 10.625 2Z" fill="#2D7CFE" />
                            </svg>
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- Invoice Conainter End -->

    <!--==============================
    All Js File
============================== -->
    <!-- Jquery -->
    <script src="{{ asset('invoice-assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('invoice-assets/js/bootstrap.min.js')}}"></script>
    <!-- PDF Generator -->
    <script src="{{ asset('invoice-assets/js/jspdf.min.js')}}"></script>
    <script src="{{ asset('invoice-assets/js/html2canvas.min.js')}}"></script>
    <!-- Main Js File -->
    <script src="{{ asset('invoice-assets/js/main.js')}}"></script>

</body>

</html>