@extends('admin.layout.base-layout')

@section('content')
    <div class="col-12 mb-4">
        <div class="card text-center">
            <div class="card-header text-start">
                <div class="row align-items-center">
                    <span class="col-12 col-md-4">آخرین ارسالی ها | <a
                            href="{{route('dashboard')}}">همه رهگیری ها</a></span>
                    <form class="d-flex col-12 col-md-8 mt-3 mt-md-0" action="{{ route('dashboard') }}">
                        <input class="form-control me-0 me-md-3" type="search" name="search"
                               placeholder="جستجو بر اساس شناسه سفارش..." aria-label="Search">
                        <button class="btn btn-outline-success ms-1" type="submit">بجور</button>
                    </form>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-start table-striped">
                        <thead>
                        <tr>
                            <th scope="col">شناسه سفارش</th>
                            <th scope="col">نام صورتحساب</th>
                            <th scope="col">نام گیرنده</th>
                            <th scope="col">تاریخ سفارش</th>
                            <th scope="col">تاریخ ارسال</th>
                            <th scope="col">روش حمل و نقل</th>
                            <th scope="col">کد رهگیری</th>
                            <th scope="col">وضعیت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trackings as $tracking_item)
                            @if($tracking_item->ordermeta->isEmpty())
                                <tr>
                                    <td colspan="8">اطلاعات این سفارش نادرست است</td>
                                </tr>
                            @else
                                <tr>
                                    <td scope="col" class="text-success fw-bold"><a
                                            href="{{route('tracking-edit', $tracking_item)}}">{{ $tracking_item->order_id }}#</a>
                                    </td>
                                    <td scope="col">{{ $tracking_item->ofMeta('_billing_first_name') }}</td>
                                    <td scope="col">{{ $tracking_item->ofMeta('_shipping_first_name') }}</td>
                                    <td scope="col"
                                        class="text-muted">{{ Jalali::jdate("l j F ساعت G:i" ,strtotime($tracking_item->ofMeta('_completed_date')),'','local') }}</td>
                                    <td scope="col" class="text-success">&#10003 {{  $tracking_item->ship_date }}</td>
                                    <td scope="col" class="text-warning">
                                        &#128238 {{ $tracking_item->carrier->name }}</td>
                                    <td scope="col">{{ $tracking_item->tracking_code }}</td>
                                    <td scope="col" class="text-success fw-bold">  {{ $tracking_item->status }}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-muted text-end">
                {{ $trackings->render() }}
            </div>
        </div>
    </div>
@endsection
