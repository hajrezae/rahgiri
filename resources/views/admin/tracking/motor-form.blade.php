<form action="{{ route('tracking-motorcodes') }}" method="POST">
    @csrf
    <div class="mb-3">
        <div class="form-row">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('not_exists'))
                <div class="alert alert-danger">
                    سفارش با شناسه های روبرو موجود نیست
                    {{ session('not_exists') }}
                </div>
            @endif

            <label class="my-2" for="motorcodes">هر شناسه سفارش رو با خط تیره از هم جدا کنید مثال :
                ۱۲۴۳-۳۴۵۶۶۷-۲۳۲۳۴</label>
            <span class="ms-5" id="motorcodes-formatting-result"></span>

            <textarea rows="10" class="form-control" id="motorcodes" name="motorcodes"
                      placeholder="کد ها را با فرمت درست اینجا وارد کنید">{{ old('postcodes') }}</textarea>
                <input type="text" hidden name="formatted_motorcodes" id="formatted_motorcodes">
            @error('motorcodes')
            <div class="text-danger mt-2">
                {{ $message }}
            </div>
            @enderror
            <span id="error-message" class="text-danger mx-3"></span>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="ship_date" class="mt-3 mb-2">تاریخ ارسال</label>
                <input type="text" id="motorcode_ship_date" class="ship_date form-control" name="ship_date"/>
                @error('ship_date_datetime')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-12 col-md-6">
                <label for="carrier" class="mt-3 mb-2">پیک</label>
                <select class="form-control" name="carrier" id="carrier">
                    @foreach($carriers as $carrier)
                        <option value="{{ $carrier->id }}">{{ $carrier->name  }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-4">
                <input type="text" hidden id="motorcode_ship_time" class="ship_date form-control"
                       name="motorcode_ship_time"/>
                <button type="submit" id="submitBtn" name="uploade_postcodes" value="1"
                        class="btn btn-block btn-primary btn-sm mt-2">
                    آپلود کد ها
                </button>
            </div>

        </div>
    </div>
</form>
