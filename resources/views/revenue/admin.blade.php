<!--Revenue Admin View-->
<div class="container">
    {{ $dataTable->table() }}
</div>

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
