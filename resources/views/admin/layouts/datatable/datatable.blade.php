@push('styles')
{{--    <link rel="stylesheet" href="{{ asset('assets/admin/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">--}}
{{--    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">--}}
{{--    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables/customs/css/style.css') }}">--}}
@endpush

@push('scripts')
{{--    <script src="{{ asset('assets/admin/plugins/datatables/datatables.net/js/jquery.datatables.min.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/admin/plugins/datatables/datatables.net-bs/js/datatables.bootstrap.min.js') }}"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>--}}
{{--    <script src="{{ asset('assets/admin/plugins/datatables/customs/js/buttons-server-side.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/admin/plugins/datatables/customs/js/plugin.js') }}"></script>--}}
    <script>
        (function ($, DataTable) {
            // Datatable global configuration
            $.extend(true, DataTable.defaults, {
                language: {
                    "sProcessing":   "جارٍ التحميل...",
                    "sLengthMenu":   "أظهر _MENU_ مدخلات",
                    "sZeroRecords":  "لم يعثر على أية سجلات",
                    "sInfo":         "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty":    "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix":  "",
                    "sSearch":       "ابحث:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "الأول",
                        "sPrevious": "السابق",
                        "sNext":     "التالي",
                        "sLast":     "الأخير"
                    },
                    "sEmptyTable": "لا يوجد بيانات فى الجدول",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "جارى التحميل ...",
                    "oAria": {
                        "sSortAscending": ": التفعيل لفرز العمود بترتيب تصاعدي",
                        "sSortDescending": ": نشط لفرز العمود بترتيب تنازلي"
                    },
                    "buttons": {
                        "csv": 'سى اس فى',
                        "excel": 'اكسيل',
                        "print": 'طباعة',
                        "reset": 'اعادة تعيين',
                        "reload": 'اعادة تحميل',
                    }
                }
            });

        })(jQuery, jQuery.fn.dataTable);
    </script>
    {!! $dataTable->scripts() !!}
@endpush
