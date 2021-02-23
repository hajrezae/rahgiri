@extends('admin.layout.base-layout')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills mb-4 text-center" id="pills-tab" role="tablist">
                    <li class="nav-item col-12 col-md-2">
                        <a class="nav-link {{ session('pill') === 'pills-postcode' || !session('pill')? 'active': null }}" id="pills-postcode-tab" data-toggle="pill" href="#pills-postcode" role="tab" aria-controls="pills-postcodes" aria-selected="true">کد های پستی</a>
                    </li>
                    <li class="nav-item col-12 col-md-2">
                        <a class="nav-link {{ session('pill') === 'pills-motor'? 'active': null }}" id="pills-motor-tab" data-toggle="pill" href="#pills-motor" role="tab" aria-controls="pills-profile" aria-selected="false">کد پیک</a>
                    </li>
                    <li class="nav-item col-12 col-md-2">
                        <a class="nav-link {{ session('pill') === 'pills-tipax'? 'active': null }}" id="pills-tipax-tab" data-toggle="pill" href="#pills-tipax" role="tab" aria-controls="pills-tipax" aria-selected="false">تیپاکس و کالارسان</a>
                    </li>
                </ul>
                <hr>
                <div class="tab-content mt-3" id="pills-tabContent">
                    <div class="tab-pane fade {{ session('pill') === 'pills-postcode' || !session('pill')? 'active show': null }}" id="pills-postcode" role="tabpanel" aria-labelledby="pills-home-tab">
                        @include('admin.tracking.post-form')
                    </div>
                    <div class="tab-pane fade {{ session('pill') === 'pills-motor'? 'active show': null }}" id="pills-motor" role="tabpanel" aria-labelledby="pills-motor-tab">
                        @include('admin.tracking.motor-form')
                    </div>
                    <div class="tab-pane fade {{ session('pill') === 'pills-tipax'? 'active show': null }}" id="pills-tipax" role="tabpanel" aria-labelledby="pills-tipax-tab">
                        @include('admin.tracking.tipax-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".ship_date").pDatepicker({
                altField: '#ship_date_datetime',
                calendarType: "gregorian",
                altFormat: "YYYY-MM-DD h:m:s",
                calendar: {
                    persian: {
                        locale: "fa",
                        showHint: true,
                        leapYearMode: "algorithmic"
                    },
                }
            });
        });

        let postcodes = $('#postcodes');
        let formatBtn = $('#formatBtn');
        let postCodesForm = $('#postcodes-form');

        formatBtn.attr('disabled', true);


        postcodes.on('keyup', function (e) {
            if (postcodes.val().length > 0)
                formatBtn.attr('disabled', false);
            else
                formatBtn.attr('disabled', true) && $('#import-result').hide()
        })

        formatBtn.click(function (e) {
            e.preventDefault();
            if (postcodes.val().length === 0) {
                showError('ابتدا کد ها را وارد کنید');
                return;
            }

            let postTable = postcodes.val();
            let formattedCodes = reformatCodes(postTable).map(row => {
                let order_id = row.find(col => col.length === 5 && parseInt(col) < 60000);
                let tracking_code = row.find(col => col.length === 24);
                return {
                    order_id,
                    tracking_code
                }
            });

            // temporary
            // formattedCodes = formattedCodes.map(row => `${row.order_id}|${row.tracking_code}\n`);
            // console.log(formattedCodes.join(""));

            postcodes.val(JSON.stringify(formattedCodes));
            // postcodes.attr('disabled', true);

            showResult(formattedCodes.length);
        })

        function reformatCodes(codes) {
            return chunkedCodes = chunk(
                codes.split('\n').map(field => {
                    field = field.trim();
                    return field.replaceAll('￼', '');
                })
                    .filter(field => field != "")
                , 6)
        }

        function chunk(array, size) {
            let i, j, temporary, chunk = size;
            let chunked = [];
            for (i = 0, j = array.length; i < j; i += chunk) {
                temporary = array.slice(i, i + chunk);
                chunked.push(temporary);
            }

            return chunked;
        }

        function showResult(number) {
            $('#import-result').html(`<span class="text-success">${number}</span> سطر اطلاعات پستی بارگزاری شد لطفا با فایل اصلی چک کنید`).show()
        }

        function showError(message) {
            $('#error-message').html(message);
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#motorcode_ship_date").pDatepicker({
                altField: '#motorcode_ship_time',
                calendarType: "gregorian",
                altFormat: "YYYY-MM-DD h:m:s",
                calendar: {
                    persian: {
                        locale: "fa",
                        showHint: true,
                        leapYearMode: "algorithmic"
                    },
                }
            });
            const formattedMotorCodes = $('#formatted_motorcodes');
            const motorcodes = $('#motorcodes')
            motorcodes.on('keyup', function(e){
                let input = $(this).val();
                let realLength = input.replaceAll("\n", "").length;

                if(e.keyCode === 8) return


                if(realLength % 5 === 0)
                    $(this).val(input + "\n");


                let codes = $(this).val().split("\n");
                let fl = codes.filter(code => code !== "" && code.length === 5)
                let values = JSON.stringify(fl);

                $(formattedMotorCodes).val(values);
                if(realLength % 5 === 0)
                    showEntered(fl.length);
            })

            function showEntered(number) {
                $('#motorcodes-formatting-result').html(`<span class="text-success">${number} شناسه سفارش وارد شد<span/>`);
            }
        })
    </script>
    <script>
        const addBtn = $('#add-row');
        const form = $('#rows')
        $(addBtn).click(function (e) {
            const lastId = $('.order-row:last-child').attr('id');
            const row = $(`<div class="row order-row mt-2" id=${parseInt(lastId) + 1}>
        <div class="col">
            <input type="text" class="form-control" name="tracking[${parseInt(lastId) + 1}][order_id]" placeholder="شناسه سفارش"
                   aria-label="First name">
        </div>
        <div class="col">
            <input type="text" class="form-control" name="tracking[${parseInt(lastId) + 1}][tracking_code]" placeholder="کد پیگیری"
                   aria-label="Last name">
        </div>
    </div>`)
            $(form).append(row);
        })
    </script>

@endsection
