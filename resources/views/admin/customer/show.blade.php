@extends('layouts.app')

@section('title') {{ $customer->name }} @endsection

@section('css')
     <!-- Lightbox css -->
     <link href="{{asset('assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Müsterin Bilgileri",
    "pageDescription"=>"Sistemde Müsterin bilgileri burada görüntülenebilir"
    ])
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                @if (session('errorType'))
                    <x-alert type="danger" :message="session('errorType')" />
                @endif
                @if (session('errorTitle'))
                    <x-alert type="danger" :message="session('errorTitle')" />
                @endif
                @if (session('errorNote'))
                    <x-alert type="danger" :message="session('errorNote')" />
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        {{-- Genel bilgileri --}}
        @include('admin.customer.partials.general-info')
        @include('admin.customer.modals.general-info.edit-general-info')
        @include('admin.customer.modals.contact.edit-contact')
        @include('admin.customer.modals.projects.edit-project')

        {{-- Adres Bilgileri --}}
        @include('admin.customer.partials.address')
        @include('admin.customer.modals.address.edit-address')
        {{-- Diğer Bilgileri --}}
        @include('admin.customer.partials.other-info')
        @include('admin.customer.modals.other-info.edit-other-info')
        {{-- Teklifler --}}
        @include('admin.customer.partials.bids')
        {{-- Görüşme Bilgileri --}}
        @include('admin.customer.partials.meeting',["meetings" =>$customerMeetings])

        {{-- Yaklaşan görüşmeler --}}
        @include('admin.customer.partials.next-meeting')
        {{-- Doküman --}}
        @include('admin.customer.partials.document')
        @include('admin.customer.modals.document.add-doc')
        {{-- Note --}}
        @include('admin.customer.partials.note')
        @include('admin.customer.modals.note.add-note')
    </div>

    <!-- end row -->
@endsection

@section('script')
    <!-- Magnific Popup-->
    <script src="{{asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

    <!-- Tour init js-->
    <script src="{{asset('assets/js/pages/lightbox.init.js')}}"></script>
@endsection
