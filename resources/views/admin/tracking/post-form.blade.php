<form action="{{ route('tracking-postcodes') }}" method="POST" id="postcodes-form">
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
                        سفارش با شناسه های روبرو موجود نیست (با فایل اصلی بررسی کنید)
                        {{ session('not_exists') }}
                    </div>
            @endif

            <label class="my-2" for="postcodes">محل ورود کد های پستی</label>
            <span class="ms-5" id="import-result"></span>

            <textarea rows="10" class="form-control" id="postcodes" name="postcodes"
                      placeholder="کد ها را با فرمت درست اینجا وارد کنید">{{ old('postcodes') }}</textarea>
            @error('postcodes')
            <div class="text-danger mt-2">
                {{ $message }}
            </div>
            @enderror
            <button id="formatBtn" class="btn btn-primary btn-sm mt-2">اصلاح فرمت کد ها</button>
            <span id="error-message" class="text-danger mx-3"></span>
        </div>
        <div class="form-row">
            <label for="ship_date" class="mt-3 mb-2">تاریخ ارسال</label>
            <input type="text" class="ship_date form-control" name="ship_date"/>
            @error('ship_date_datetime')
            <div class="text-danger mt-2">
                {{ $message }}
            </div>
            @enderror
            <input type="text" hidden id="ship_date_datetime" class="ship_date form-control" name="ship_date_datetime"/>
            <button type="submit" id="submitBtn" name="uploade_postcodes" value="1" class="btn btn-primary btn-sm mt-2">
                آپلود کد ها
            </button>
        </div>
    </div>
</form>


