@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/fm.tagator.jquery.css') }}"/>
@endpush

@section('content')
    <div class="container">
        <livewire:filter-posts/>
        <livewire:post-tiles/>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/fm.tagator.jquery.js') }}"></script>
@endpush
