@extends('admin_layouts.app')
@section('styles')
<style>
 .transparent-btn {
  background: none;
  border: none;
  padding: 0;
  outline: none;
  cursor: pointer;
  box-shadow: none;
  appearance: none;
  /* For some browsers */
 }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
@endsection
@section('content')
<div class="row mt-4">
 <div class="col-12">
  <div class="card">
   <!-- Card header -->
   <div class="card-header pb-0">
    <div class="d-lg-flex">
     <div>
      <h5 class="mb-0">Product Code Dashboards</h5>

     </div>
     <div class="ms-auto my-auto mt-lg-0 mt-4">
      <div class="ms-auto my-auto">
       <a href="{{ route('admin.product_code.create') }}" class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Product Code</a>
       <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
      </div>
     </div>
    </div>
   </div>
   <div class="table-responsive">
    <table class="table table-flush" id="banners-search">
     <thead class="thead-light">
      <tr>
       <th>#</th>
       <th>Product</th>
       <th>Product Code</th>
       <th>Game Type</th>
       <th>Currency Code</th>
       <th>Conversion Rate</th>
       <th>Actions</th>
      </tr>
     </thead>
     <tbody>
      @foreach($product_code as $key => $value)
      <tr>
       <td class="text-sm font-weight-normal">{{ ++$key }}</td>
       <td>{{ $value->product }}</td>
       <td>{{ $value->product_code }}</td>
       <td>{{ $value->game_type }}</td>
       <td>{{ $value->currency_code }}</td>
       <td>{{ $value->conversion_rate }}</td>
       <td> <a href="{{ route('admin.product_code.edit', $value->id) }}" data-bs-toggle="tooltip" data-bs-original-title="Edit Product Code"><i class="material-icons-round text-info position-relative text-lg">mode_edit</i></a>
        <!-- <a href="{{ route('admin.product_code.show', $value->id) }}" data-bs-toggle="tooltip" data-bs-original-title="Preview Banner Detail">
        <i class="material-icons text-secondary position-relative text-lg">visibility</i>
       </a> -->
        <form class="d-inline" action="{{ route('admin.product_code.destroy', $value->id) }}" method="POST">
         @csrf
         @method('DELETE')
         <button type="submit" class="transparent-btn" data-bs-toggle="tooltip" data-bs-original-title="Delete Product Code">
          <i class="material-icons text-danger position-relative text-lg">delete</i>
         </button>
        </form>
       </td>
      </tr>
      @endforeach
     </tbody>
    </table>
   </div>
  </div>
 </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

<script src="{{ asset('admin_app/assets/js/plugins/datatables.js') }}"></script>
<script>
 if (document.getElementById('banners-search')) {
  const dataTableSearch = new simpleDatatables.DataTable("#banners-search", {
   searchable: true,
   fixedHeight: false,
   perPage: 7
  });

  document.querySelectorAll(".export").forEach(function(el) {
   el.addEventListener("click", function(e) {
    var type = el.dataset.type;

    var data = {
     type: type,
     filename: "material-" + type,
    };

    if (type === "csv") {
     data.columnDelimiter = "|";
    }

    dataTableSearch.export(data);
   });
  });
 };
</script>
<script>
 var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
 var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
 })
</script>
<script>
 $(document).ready(function() {
  $('.transparent-btn').on('click', function(e) {
   e.preventDefault();
   let form = $(this).closest('form');
   Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    background: 'hsl(230, 40%, 10%)',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, cancel!'
   }).then((result) => {
    if (result.isConfirmed) {
     form.submit();
    }
   });
  });
 });
</script>
@if(session()->has('success'))
<script>
 Swal.fire({
  icon: 'success',
  title: '{{ session('
  success ') }}',
  showConfirmButton: false,
  background: 'hsl(230, 40%, 10%)',
  timer: 1500
 })
</script>
@endif


@endsection
