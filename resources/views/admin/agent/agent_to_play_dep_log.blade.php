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


.custom-form-group {
 margin-bottom: 20px;
}

.custom-form-group label {
 display: block;
 margin-bottom: 5px;
 font-weight: bold;
 color: #555;
}

.custom-form-group input,
.custom-form-group select {
 width: 100%;
 padding: 10px 15px;
 border: 1px solid #e1e1e1;
 border-radius: 5px;
 font-size: 16px;
 color: #333;
}

.custom-form-group input:focus,
.custom-form-group select:focus {
 border-color: #d33a9e;
 box-shadow: 0 0 5px rgba(211, 58, 158, 0.5);
}

.submit-btn {
 background-color: #d33a9e;
 color: white;
 border: none;
 padding: 12px 20px;
 border-radius: 5px;
 cursor: pointer;
 font-size: 18px;
 font-weight: bold;
}

.submit-btn:hover {
 background-color: #b8328b;
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-icons@1.13.12/iconfont/material-icons.min.css">
@endsection
@section('content')
<div class="row justify-content-center">
 <div class="col-12">
  <div class="container mt-2">
   <div class="d-flex justify-content-between">
    <h4>Agent To Player Deposit Log Detail</h4>
   </div>
   <div class="card">
    <div class="table-responsive">
     <table class="table align-items-center mb-0">
      <thead>
            <tr>
                <th class="text-center align-middle">Agent Name</th>
                <th class="text-center align-middle">Player Name</th>
                <th class="text-center align-middle">Total Deposits</th>
                <th class="text-center align-middle">Total DepositAmount</th>
                <th class="text-center align-middle">Commission Percentage %</th>
                <th class="text-center align-middle">Commission Amount</th>
                <th class="text-center align-middle">Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td  class="text-center align-middle">{{ $transaction->agent_name }}</td>
                    <td  class="text-center align-middle">{{ $transaction->player_name }}</td>
                    <td  class="text-center align-middle">{{ $transaction->total_deposits }}</td>
                    <td  class="text-center align-middle">{{ number_format($transaction->total_amount / 100, 2) }}</td>
                    <td  class="text-center align-middle">{{ $transaction->agent_commission }}%</td>
                    <td  class="text-center align-middle">{{ number_format(($transaction->total_amount / 100) * ($transaction->agent_commission / 100), 2) }}</td>
                    <td class="text-center align-middle">
                        <a href="{{ route('admin.agent.to.player.detail', ['agent_id' => $transaction->agent_id, 'player_id' => $transaction->player_id]) }}" class="btn btn-primary btn-sm">
                            View Details
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
     </table>
    </div>
   </div>
  </div>
 </div>
</div>


@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>

<script src="{{ asset('admin_app/assets/js/plugins/choices.min.js') }}"></script>
<script src="{{ asset('admin_app/assets/js/plugins/quill.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

<script>
if (document.getElementById('choices-tags-edit')) {
 var tags = document.getElementById('choices-tags-edit');
 const examples = new Choices(tags, {
  removeItemButton: true
 });
}
</script>
<script>
if (document.getElementById('choices-roles')) {
 var role = document.getElementById('choices-roles');
 const examples = new Choices(role, {
  removeItemButton: true
 });

 examples.setChoices(
  [{
    value: 'One',
    label: 'Expired',
    disabled: true
   },
   {
    value: 'Two',
    label: 'Out of Role',
    selected: true
   }
  ],
  'value',
  'label',
  false,
 );
}
// store role
$(document).ready(function() {
 $('#submitForm').click(function(e) {
  e.preventDefault();

  $.ajax({
   type: "POST",
   url: "{{ route('admin.roles.store') }}",
   data: $('form').serialize(),
   success: function(response) {
    Swal.fire({
     icon: 'success',
     title: 'Role created successfully',
     background: 'hsl(230, 40%, 10%)',
     showConfirmButton: false,
     timer: 1500
    });
    // Reset the form after successful submission
    $('form')[0].reset();
   },
   error: function(error) {
    console.log(error);
    Swal.fire({
     icon: 'error',
     title: 'Oops...',
     background: 'hsl(230, 40%, 10%)',
     text: 'Something went wrong!'
    });
   }
  });
 });
});
</script>
@endsection
