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
              <h3 class="mb-0">{{$title}}</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush" id="example2">
                <thead class="thead-light">
                  <tr>
                    <th>Address Field</th>
                    <th>Order</th>
                    <th></th>
                  </tr>
                </thead>
                  <tbody class="list">
                    @foreach($settings as $setting)

                    <tr id="row{{$setting->id}}">
                     <!-- <td>{{ $setting->name }}</td> -->
                     <td>
                        <label for=""> {{ $setting->field_name }}</label><br>
                         <input type="checkbox"  id="value{{$setting->id}}" value="1" name= "{{ $setting->key }}" {{ $setting->status == '1'? 'checked':'' }}/>
                         </td>
                         <td>
                         <input type="text" class="form-control input-sm col-xs-3" id="order{{$setting->id}}"  name= "{{ $setting->key }}" value="{{ $setting->order}}"/>
                       </td>



                     <td><button onclick="javascript:update({{$setting->id}})" class="btn btn-primary btn-sm">Update</button></td>
                   </tr>
                   @endforeach
                  </tbody>
              </table>
            </div>
            <!-- Card footer -->

            <div class="card-footer py-4">
              <nav aria-label="...">
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
        var error = false;
        var url = '{{ route("admin.address_settings.save_configurations", ":id") }}';
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
                  var val = 0;
                  var order;

                      val = $('#value'+id).val();

                        order = $('#order'+id).val();


                   $.ajax({
                            type:'POST',
                            url:url,
                            data:'_token={{ csrf_token() }}'+'&value='+val+'&order='+order,
                            success:function(data){
                              if(data.success==1)
                              {
                                console.log(data);
                                   swal('Updated!','Value has been updated.','success' );
                              }
                              else
                              {
                                  swal('Failed!', data.message, 'error' );
                              }
                            },
                            error:function(data)
                            {
                                console.log(data);
                                swal('Failed!', data.message, 'error');
                            }

                         });
                } else {
                  //console.log($('#status'+id));

                }
              });


    };
    </script>

      @endsection
