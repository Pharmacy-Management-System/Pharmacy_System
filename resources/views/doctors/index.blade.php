@extends('layouts.app')

@section('content')

<section class="content">
    <div class="container-fluid">

        {{ $dataTable->table() }}
    </div><!--/. container-fluid -->

</section>

@endsection

{{-- view model --}}
<div class="modal" id="viewForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">View Doctor Record</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table">
            <tbody id="recordData">

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


@push('scripts')
{{ $dataTable->scripts() }}
@endpush
<script>
function viewRecord($national_id) {
    consle.log($national_id);
  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var record = JSON.parse(this.responseText);
      var html = '';

      html += '<tr><td>National ID:</td><td>' + record.national_id + '</td></tr>';
      html += '<tr><td>Pharmacy ID:</td><td>' + record.pharmacy_id + '</td></tr>';
      html += '<tr><td>Is Banned:</td><td>' + record.is_banned + '</td></tr>';

      document.getElementById('recordData').innerHTML = html;
    }
  };

  xhr.open('GET', '/doctors/' + $doctor, true);
  xhr.send();
}
  </script>

