@extends('web.layouts.master')
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                <li class="breadcrumb-item"><a href="#">قسم المتجر</a></li>
                <li class="breadcrumb-item"><a href="#">المنتجات</a></li>
                <li class="breadcrumb-item active" aria-current="page">اسم المنتج</li>
            </ol>
        </nav>
    </div>

    <div class="products single-product store-order-inner mt-5">
        <div class="container">
            <div class="head text-center">
                <h2>طلباتي</h2>
            </div>

            <p>رقم الطلب: <strong>{{$order->id}}</strong></p>
            <p><strong>قائمة الوجبات داخل الطلب:</strong></p>

            <div class="row order-items">
                @foreach($order_items as $orderItem)

                    <div class="col-lg-3 col-md-4">
                        <div class="item mb-4">
                            <figure><img src="{{$orderItem->food->image}}" alt=""></figure>
                            <div class="caption">
                                <p><strong>{{$orderItem->food->name}}</strong></p>
                                {!! $orderItem->food->details !!}
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

            <div class="d-order">
                <p>اسم المستخدم صاحب الطلب: <strong> {{$order->user->name}}</strong></p>
                <p>رقم الجوال الخاص بالمستخدم صاحب الطلب: <strong>{{$order->user->phone}}</strong></p>
                <p>العنوان الخاص بالمستخدم صاحب الطلب: <strong>{{$order->user->address}}</strong></p>
                <p>طريقة الدفع المحددة داخل الطلب: <strong>{{$order->payment}}</strong></p>
                <p>اليوم الخاص بالتوصيل: <strong> {{$order->delivery_date}}</strong></p>
                <p>الوقت الخاص بالتوصيل: <strong>{{$order->delivery_time}}ً</strong></p>
                <h3>ملخص فاتورة الطلب:</h3>
                <div>
                    <p>عدد الوجبات 4 وجبات - سعر كل وجبة 500.00 ريال</p>
                    <p>الضريبة المضافة : {{$order->tax}} ريال</p>
                    <p>قيمة التوصيل: {{$order->delivery}} ريال</p>
                    <p>ملخص الطلب إجمالياً :{{$order->total_price}} ريال</p>
                </div>
                <p>حالة الطلب: <strong> {{$order->status->name}}</strong></p>
                <h3>تقييم الطلب:</h3>
                <div>
                    <p>نشكركم على الخدمة الرائعة</p>
                    <span>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star off"></i>
                    </span>
                </div>
                <a href="" class="btn btn-warning mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal">إلغاء
                    الطلب</a>
            </div>
        </div>
    </div>
{{--    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <div class="text-center">--}}
{{--                        <h4>تأكيد إلغاء الطلب</h4>--}}
{{--                        <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على--}}
{{--                            الشكل الخارجي</p>--}}
{{--                        <a href="" class="btn btn-warning">تأكيد</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
