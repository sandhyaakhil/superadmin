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
                    <!-- <th>Key</th>
                    <th>Value</th>
                    <th>Action</th> -->
                  </tr>
                </thead>
                  <tbody class="list">
                    @foreach($settings as $setting)

                    <tr id="row{{$setting->id}}">
                     <!-- <td>{{ $setting->name }}</td> -->
                     <td>
                        <label for=""> {{ $setting->name }}</label><br>
                        <input class="email_option" type="checkbox" id="email{{ $setting->id }}" name="{{ $setting->name }}" value="1" {{ $setting->is_enabled == '1'? 'checked': '' }}>
                        <form class="{{$setting->is_enabled == '0' ? 'hidden' : '' }}" id="config_section{{$setting->id}}" name="email_settings">
                          <span class="error{{ $setting->id }} hidden">Please enter value(s)</span>
                              <input type="hidden"  id="email_gateway_id{{ $setting->id }}" value = "{{ $setting->id }}" name="email_gateway_id"/>
                              <input type="hidden"  name="gateway" value ="{{$setting->keyword}}"/>

                                <div class="form-group">
                                    <input type="text" placeholder ="Host Name" class="full-width form-control" id="{{$setting->keyword}}_host" name="{{$setting->keyword}}_host" value="{{ old('name',isset($setting->hostSettings->host_name)?$setting->hostSettings->host_name: '') }}" required/>
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder ="Port" class="full-width form-control" id="{{$setting->keyword}}_port" name="{{$setting->keyword}}_port"  value="{{ isset($setting->hostSettings->port)? $setting->hostSettings->port:'' }}"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder ="Username" class="full-width form-control" id="{{$setting->keyword}}_username" name="{{$setting->keyword}}_username"  value="{{ isset($setting->hostSettings->username)? $setting->hostSettings->username:'' }}"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder ="Password" class="full-width form-control" id="{{$setting->keyword}}_password" name="{{$setting->keyword}}_password"  value="{{ isset($setting->hostSettings->password)? $setting->hostSettings->password:'' }}"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder ="Encryption" class="full-width form-control" id="{{$setting->keyword}}_encryption" name="{{$setting->keyword}}_encryption"  value="{{ isset($setting->hostSettings->encryption)? $setting->hostSettings->encryption:'' }}"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder ="From Name" class="full-width form-control" id="{{$setting->keyword}}_fromname" name="{{$setting->keyword}}_fromname"  value="{{ isset($setting->hostSettings->from_name)? $setting->hostSettings->from_name:'' }}"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder ="From Address" class="full-width form-control" id="{{$setting->keyword}}_fromaddress" name="{{$setting->keyword}}_fromaddress"  value="{{ isset($setting->hostSettings->from_address)? $setting->hostSettings->from_address:'' }}"/>
                                </div>

                        </form>
                     </td>
                     <td></td>

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
  $(document).ready(function(){
    $('.email_option').change(function(){
        var attr_id = $(this).attr('id');
        var id = attr_id.substring(5);
        if($(this).prop("checked") == true){
            $('#config_section'+id).removeClass('hidden');
            $('#config_section'+id).show();
        }
        else
        {
            $('#config_section'+id).addClass('hidden');
        }
    })
  });

    function update(id)
    {
        var error = false;
        var url = '{{ route("admin.email_settings.save_configurations", ":id") }}';
        url = url.replace(':id', id);
        if($('#email'+id).prop("checked") == true){
              $('#config_section'+id+' *').filter(':input')
               .each(function () {
                  if($(this).val() == ''){
                      error = true;
                  $('.error'+id).removeClass('hidden');
                      return false;
                  }
              });
        }

        if(error == false){

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

                  if($('#email'+id).prop("checked") == true)
                      val = 1;
                       //$('#config_section'+id).submit();

                        var formData = $('#config_section'+id).serialize();
                        console.log(formData);
                   $.ajax({
                            type:'POST',
                            url:url,
                            data:'_token={{ csrf_token() }}'+'&value='+val+'&'+formData,
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

            }
    };
    </script>

      @endsection
