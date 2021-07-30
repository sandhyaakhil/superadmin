@extends('layouts.main')

@section('content')

@include('settings.partials.header')

<link rel="stylesheet" href="{{ asset('adm') }}/dist/css/sweetalert.css">
<script src="{{ asset('adm') }}/dist/js/sweetalert.min.js"></script>


    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">WhatsApp Widget Code</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush" id="example2">
                <thead class="thead-light">
                  <tr>
                    <!-- <th>Key</th>
                    <th>Value</th>
                    <th>Action</th> -->
                  </tr>
                </thead>
                  <tbody class="list">

                    <tr id="row{{$settings->id}}">

                     <td>
                       <form class="" id="widget_section" name="widget_section">

                               <div class="form-group">
                                   <textarea  id="value{{$settings->id}}" class="full-width form-control" >{{ $settings->field_value }}</textarea>
                               </div>

                             </form>



                     </td>
                   </tr>
                     <tr>
                     <td><button onclick="javascript:update({{$settings->id}})" class="btn btn-primary btn-sm">Update</button></td>
                   </tr>

                  </tbody>
              </table>
            </div>
            <!-- Card footer -->

            <div class="card-footer py-4">
              <nav aria-label="...">

                <!-- <ul class="pagination justify-content-end mb-0">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      <i class="fas fa-angle-right"></i>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul> -->
              </nav>
            </div>
          </div>
        </div>
      </div>


      <!-- Footer -->
      @include('layouts.footers.auth')
    </div>



    <script>

    function update(id)
        {

            var url = '{{ route("admin.whatsapp_settings.save_configurations", ":id") }}';
            url = url.replace(':id', id);
            swal({
                    title: "Update Value",
                    text: "Are you sure to update value?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, update it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                  },
                  function(isConfirm) {
                    if (isConfirm) {
                       $.ajax({
                                type:'POST',
                                url:url,
                                data:'_token={{ csrf_token() }}'+'&value='+$('#value'+id).val(),
                                success:function(data){
                                  if(data.success==1)
                                  {
                                       swal(
                                            'Updated!',
                                            'Value has been updated.',
                                            'success'
                                          );

                                  }
                                  else
                                  {
                                      swal(
                                            'Failed!',
                                            data.message,
                                            'error'
                                          );
                                  }
                                },
                                error:function(data)
                                {
                                    console.log(data);
                                    swal(
                                            'Failed!',
                                            data.message,
                                            'error'
                                          );

                                }

                             });
                    } else {


                    }
                  });

        };
    </script>

      @endsection
