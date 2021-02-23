<form action="{{ route('tracking-tipax') }}" method="POST" id="tipax-form">
    @csrf
    @if(session('not_found'))
        <div class="alert alert-danger">
            سفارش های با شناسه زیر وجود ندارند لطفا دوباره بررسی کنید
            {{ session('not_found') }}
        </div>
    @endif

    @if(session('found'))
        <div class="alert alert-success my-2">
            اطلاعات رهگیری سفارشات زیر با موفقیت ثبت شد
            {{ session('found') }}
        </div>
    @endif

    <div id="rows">
        <div class="row order-row" id="1">
            <div class="col">
                <input type="text" class="form-control" name="tracking[1][order_id]" placeholder="شناسه سفارش"
                       aria-label="First name">
            </div>
            <div class="col">
                <input type="text" class="form-control" name="tracking[1][tracking_code]" placeholder="کد پیگیری"
                       aria-label="Last name">
            </div>
        </div>
    </div>
    <div class="col-12 my-2" id="add-row">
        <button type="button" class="w-100 btn-block btn btn-sm btn-primary fw-bold">+</button>
    </div>
    <div class="form-group my-4">
        @foreach($carriers as $carrier)
            <div class="form-check p-4 bg-light my-2 rounded-3">
                <input class="form-check-input mx-1" type="radio" name="carrier_id" id="{{ $carrier->id }}"
                       value="{{ $carrier->id }}">
                <label class="form-check-label" for="gridRadios1">
                    {{ $carrier->name }}
                </label>
            </div>
        @endforeach
    </div>
    <button type="submit" class="btn btn-sm btn-outline-primary mt-3">ذخیره</button>
</form>



