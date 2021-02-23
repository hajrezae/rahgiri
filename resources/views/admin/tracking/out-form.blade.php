@extends('admin.layout.base-layout')

@section('content')
    <div class="col-12 col-md-4 d-flex flex-column justify-content-center" style="height: 60vh">
        <form action="{{ route('out-submit') }}" method="POST">
            @csrf
            <div class="input-group input-group-md">
                <span class="input-group-text" id="inputGroup-sizing-lg">شناسه سفارش</span>
                <input type="text" maxlength="5" class="form-control" aria-label="Sizing example input">
            </div>
            <button type="submit" class="btn btn-primary btn-block w-100 mt-2">ثبت خروج از مغازه</button>
        </form>
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
{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function() {--}}
{{--            $("#motorcode_ship_date").pDatepicker({--}}
{{--                altField: '#motorcode_ship_time',--}}
{{--                calendarType: "gregorian",--}}
{{--                altFormat: "YYYY-MM-DD h:m:s",--}}
{{--                calendar: {--}}
{{--                    persian: {--}}
{{--                        locale: "fa",--}}
{{--                        showHint: true,--}}
{{--                        leapYearMode: "algorithmic"--}}
{{--                    },--}}
{{--                }--}}
{{--            });--}}
{{--            const formattedMotorCodes = $('#formatted_motorcodes');--}}
{{--            const motorcodes = $('#motorcodes')--}}
{{--            motorcodes.on('keyup', function(e){--}}
{{--                let input = $(this).val();--}}
{{--                let realLength = input.replaceAll("\n", "").length;--}}

{{--                if(e.keyCode === 8) return--}}


{{--                if(realLength % 5 === 0)--}}
{{--                    $(this).val(input + "\n");--}}


{{--                let codes = $(this).val().split("\n");--}}
{{--                let fl = codes.filter(code => code !== "" && code.length === 5)--}}
{{--                let values = JSON.stringify(fl);--}}

{{--                $(formattedMotorCodes).val(values);--}}
{{--                if(realLength % 5 === 0)--}}
{{--                    showEntered(fl.length);--}}
{{--            })--}}

{{--            function showEntered(number) {--}}
{{--                $('#motorcodes-formatting-result').html(`<span class="text-success">${number} شناسه سفارش وارد شد<span/>`);--}}
{{--            }--}}
{{--        })--}}
{{--    </script>--}}
@endsection
