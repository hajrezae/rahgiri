<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fas/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        .text-small {
            font-size: 0.7rem;
        }

        .backdrop {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: white;
            z-index: 20;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-size: 0.9rem;
        }

        .lds-ripple {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
            z-index: 21;

        }
        .lds-ripple div {
            position: absolute;
            border: 4px solid #ccc;
            opacity: 1;
            border-radius: 50%;
            animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
            display: none;
        }
        .lds-ripple div:nth-child(2) {
            animation-delay: -0.5s;
        }
        @keyframes lds-ripple {
            0% {
                top: 36px;
                left: 36px;
                width: 0;
                height: 0;
                opacity: 1;
            }
            100% {
                top: 0px;
                left: 0px;
                width: 72px;
                height: 72px;
                opacity: 0;
            }
        }

        .background{
            background-image: repeating-linear-gradient(
                135deg
                , #CF2004 0px, #CF2004 15px, transparent 15px, transparent 25px, #3EA8F2 25px, #3EA8F2 40px, transparent 40px, transparent 50px);
        }
    </style>

    <title>رهگیری سفارشات</title>
</head>
<body>
<nav class="navbar navbar-light bg-light text-center">
    <div class="container-fluid text-center justify-content-center p-2">
        <span class="navbar-brand mb-0 h1 text-center">رهگیری سفارشات</span>
    </div>
</nav>
<div class="container-fluid mt-3">
    <div class="row justify-content-center my-4">
        <div class="col col-md-6 my-4">
            <div class="mb-3 text-center">
                <label for="exampleInputEmail1" class="form-label" style="font-size: 0.8rem">شناسه سفارش ۵ رقمی خودتون
                    رو در کادر زیر وارد کنید</label>
                <input type="text" maxlength="5" class="form-control text-center border-3" id="order-id">
            </div>
            <div class="background p-2 rounded-2">
                <div class="card text-center shadow-sm border-3 position-relative">
                    <div class="backdrop rounded-1">اطلاعات سفارش رو وارد کنید</div>
                    <div class="lds-ripple position-absolute top-50 start-50 translate-middle d-flex justify-content-center"><div></div><div></div></div>
                    <div class="card-body align-content-stretch d-flex flex-column" style="min-height: 50vh;">
                        <div class="order-info-wrapper">
                            {{--                            <div class="row header justify-content-between">--}}
                            {{--                                <div class="col-6 text-start"> # شناسه سفارش</div>--}}
                            {{--                                <div class="col-6 text-end text-success fw-bold">۴۵۹۸۱</div>--}}
                            {{--                            </div>--}}
                            {{--                            <hr>--}}
                            {{--                            <div class="receiver-name text-start">--}}
                            {{--                                <i class="fas fa-user me-2"></i> <span class="text-muted">گیرنده</span> : خانم رضایی--}}
                            {{--                            </div>--}}
                            {{--                            <div class="receiver-address text-start mt-3">--}}
                            {{--                                <i class="fas fa-home me-2"></i> <span class="text-muted">آدرس</span> : تهران میرداماد پاساژ--}}
                            {{--                                پایتخت طبقه سوم پلاک ۳۰۴--}}
                            {{--                            </div>--}}
                            {{--                            <div class="order-date text-start mt-3">--}}
                            {{--                                <i class="fas fa-calendar me-2"></i> <span class="text-muted">تاریخ سفارش</span> : دوشنبه ۱۰--}}
                            {{--                                بهمن ۹۹--}}
                            {{--                            </div>--}}
                        </div>
                        <hr>
                        <div class="tracking-info-wrapper">
                            {{--                            <div class="title mb-4 text-muted">--}}
                            {{--                                اطلاعات ارسال سفارش--}}
                            {{--                            </div>--}}
                            {{--                            <div class="row header justify-content-between">--}}
                            {{--                                <div class="col-6 text-start"><i class="fas fa-box me-2 text-success"></i>تاریخ ارسال</div>--}}
                            {{--                                <div class="col-6 text-end text-success fw-bold text-small"></div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="order-date text-start mt-3">--}}
                            {{--                                <i class="fas fa-shipping-fast me-2 text-success"></i><span--}}
                            {{--                                    class="text-muted">روش ارسال</span><span></span>--}}
                            {{--                            </div>--}}
                            {{--                            <hr>--}}
                            {{--                            <div class="tracking-code d-flex flex-column">--}}
                            {{--                                <div class="mb-3">کد پیگیری</div>--}}
                            {{--                                <div class="text-success fw-bold"></div>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                    <a href="https://tracking.post.ir/" class="my-2">لینک ورود به صفحه رهگیری اداره پست</a>
                     <a href="https://tipaxco.com/tracking" class="mb-3">لینک صفحه رهگیری تیپاکس</a>
                    <div class="card-footer border-4 bg-white text-success mt-3">

                        <span class="order-status"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/jquery.min.js"></script>
<script src="/boot.bundle.js"></script>

<script>
    const orderStatuses = {
        'wc-completed': 'تکمیل شده',
        'wc-processing': 'در حال انجام',
        'wc-pending': 'در انتظار پرداخت'
    }
    $('#order-id').on('keyup', function (e) {
        if (this.value.length < 5 || this.value.length > 5) {
            $('.backdrop').fadeIn(500);
            $('.backdrop').html('<div class="mt-4 ">لطفا شناسه ۵ رقمی را به درستی وارد کنید</div>')
            $('.lds-ripple div').hide();
            return;
        }

        $('.backdrop').html('');

        if(this.value.length === 5) {
            let orderId = this.value;
            $.ajax({
                type: 'post',
                url: '{{ route('customer.find-code') }}',
                data: {'_token': $('meta[name="csrf-token"]').attr('content'), orderId: orderId},
                beforeSend: function() {
                    $('.backdrop').fadeIn()
                    $('.lds-ripple div').fadeIn();
                },
                success: function (response) {
                    $('.backdrop').fadeOut()
                    $('.lds-ripple div').fadeOut();
                    if(response == 'order-not-found') {
                        $('.backdrop').html('<div class="mt-4 ">سفارشی با این شناسه وجود ندارد لطفا دوباره تلاش کنید</div>')
                        $('.lds-ripple div').hide();

                        return;
                    }

                    if(response['tracking'] == null) {
                        const {order, meta} = response;
                        $('.lds-ripple div').hide();
                        $('.backdrop').fadeOut(500)
                        $('.order-info-wrapper').html(`<div class="order-info-wrapper">
                        <div class="row header justify-content-between">
                            <div class="col-6 text-start"> # شناسه سفارش</div>
                            <div class="col-6 text-end text-success fw-bold">${order.ID}</div>
                        </div>
                        <hr>
                        <div class="receiver-name text-start">
                            <i class="fas fa-user me-2"></i> <span class="text-muted">گیرنده</span> : ${meta._shipping_first_name}
                        </div>
                        <div class="receiver-address text-start mt-3">
                            <i class="fas fa-home me-2"></i> <span class="text-muted">آدرس</span> : ${meta._shipping_address_1}

                        </div>
                        <div class="order-date text-start mt-3">
                           <i class="fas fa-calendar me-2"></i> <span class="text-muted">تاریخ سفارش</span> : ${meta._completed_date}
                        </div>
                    </div>`)
                        $('.tracking-info-wrapper').html(`<div class="tracking-info-wrapper">
                        <div class="title mb-4 text-muted">
                            اطلاعات ارسال سفارش
                        </div>
                        <div class="row header justify-content-between">
                            <div class="col-6 text-start"><i class="fas fa-box me-2 text-success"></i>تاریخ ارسال</div>
                            <div class="col-6 text-end text-success fw-bold text-small">داریم آماده میکنیم که سریع بفرستیم 😁</div>
                        </div>
                        <div class="order-date text-start mt-3">
                            <i class="fas fa-shipping-fast me-2 text-success"></i><span
                                class="text-muted">روش ارسال : </span><span>هنوز معلوم نیست</span>
                        </div>
                        <hr>
                        <div class="tracking-code d-flex flex-column">
                            <div class="mb-3">کد پیگیری</div>
                            <div class="text-success fw-bold">به زودی آپلود میکنیم</div>
                        </div>
                    </div>`)
                        $('.order-status').html(orderStatuses[order.post_status]);
                        return;
                    }else{
                        const {order, tracking, meta, carrier} = response;
                        setTimeout( function() {
                            $('.lds-ripple div').hide();
                            $('.backdrop').fadeOut(500)
                            $('.order-info-wrapper').html(`<div class="order-info-wrapper">
                        <div class="row header justify-content-between">
                            <div class="col-6 text-start"> # شناسه سفارش</div>
                            <div class="col-6 text-end text-success fw-bold">${order.ID}</div>
                        </div>
                        <hr>
                        <div class="receiver-name text-start">
                            <i class="fas fa-user me-2"></i> <span class="text-muted">گیرنده</span> : ${meta._shipping_first_name}
                        </div>
                        <div class="receiver-address text-start mt-3">
                            <i class="fas fa-home me-2"></i> <span class="text-muted">آدرس</span> : ${meta._shipping_address_1}

                        </div>
                        <div class="order-date text-start mt-3">
                           <i class="fas fa-calendar me-2"></i> <span class="text-muted">تاریخ سفارش</span> : ${meta._completed_date}
                        </div>
                    </div>`)
                            $('.tracking-info-wrapper').html(`<div class="tracking-info-wrapper">
                        <div class="title mb-4 text-muted">
                            اطلاعات ارسال سفارش
                        </div>
                        <div class="row header justify-content-between">
                            <div class="col-6 text-start"><i class="fas fa-box me-2 text-success"></i>تاریخ ارسال</div>
                            <div class="col-6 text-end text-success fw-bold text-small">${tracking.ship_date}</div>
                        </div>
                        <div class="order-date text-start mt-3">
                            <i class="fas fa-shipping-fast me-2 text-success"></i><span
                                class="text-muted">روش ارسال</span><span> : ${carrier.description}</span>
                        </div>
                        <hr>
                        <div class="tracking-code d-flex flex-column">
                            <div class="mb-3">کد پیگیری</div>
                            <div class="text-success fw-bold">${tracking.tracking_code}</div>
                        </div>
                    </div>`)
                            $('.order-status').html(orderStatuses[order.post_status]);
                        },200)
                    }
                },
                error: function (err) {
                    $('.backdrop').fadeIn(500);
                    $('.backdrop').html('<div class="mt-4 ">خطایی پیش اومده</div>')
                    $('.lds-ripple div').hide();
                }
            })
        }
    })



</script>
</body>
</html>
