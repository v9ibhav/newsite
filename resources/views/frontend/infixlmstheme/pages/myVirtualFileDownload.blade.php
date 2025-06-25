@extends(theme('layouts.dashboard_master'))
@section('title')
    {{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} | {{__('invoice.Invoice')}}
@endsection
@section('css')
    <link href="{{asset('public/frontend/infixlmstheme/css/my_invoice.css')}}{{assetVersion()}}" rel="stylesheet"
          media="screen,print"/>
@endsection
@section('mainContent')
    <x-my-virtual-file-download-page-section :id="$id"/>

@endsection
@section('js')
    <script src="{{ asset('public/frontend/infixlmstheme') }}/js/html2pdf.bundle.js"></script>
    <script src="{{ asset('public/frontend/infixlmstheme/js/my_invoice.js') }}"></script>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.order_cancel_by_id', function (e) {
                e.preventDefault();
                $('#orderCancelReasonModal').modal('show');
                $('.order_id').val($(this).attr('data-id'));
            });
        });
    </script>

@endsection
