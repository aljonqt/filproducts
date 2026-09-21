@extends('layouts.navbar')

@section('content')

<link rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
</script>

@vite(['resources/js/app.js'])

<link rel="stylesheet"
      href="{{ asset('css/residential.css') }}">


<div class="page-wrapper">

    <div class="form-container">

        @if(session('success'))

            <div class="alert-success">
                {!! session('success') !!}
            </div>

        @endif


        @if(session('error'))

            <div class="alert-error">
                {{ session('error') }}
            </div>

        @endif


        <form id="residentialForm"
              method="POST"
              enctype="multipart/form-data"
              action="{{ route('residential.inquiry.submit') }}">

            @csrf


            {{-- STEP 1 --}}
            @include('inquiry.Residential.steps.step-1-branch')


            {{-- STEP 2 --}}
            @include('inquiry.Residential.steps.step-2-plan')


            {{-- STEP 3 --}}
            @include('inquiry.Residential.steps.step-3-personal')


            {{-- STEP 4 --}}
            @include('inquiry.Residential.steps.step-4-address')


            {{-- STEP 5 --}}
            @include('inquiry.Residential.steps.step-5-employment')


            {{-- STEP 6 --}}
            @include('inquiry.Residential.steps.step-6-authorized-contact')


            {{-- STEP 7 --}}
            @include('inquiry.Residential.steps.step-7-attachments')


            {{-- STEP 8 --}}
            @include('inquiry.Residential.steps.step-8-declaration')


            {{-- STEP 9 --}}
            @include('inquiry.Residential.steps.step-9-review')

        </form>

    </div>

</div>


{{-- SHARED MODALS --}}

@include('inquiry.components.data-privacy')

@include('inquiry.components.declaration-modal')

@include('inquiry.components.contract-modal')

@include('inquiry.components.signature-modal')


@include('layouts.footer')

@endsection