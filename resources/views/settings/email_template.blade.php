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
                        <input class="template_option" type="checkbox" id="template{{ $setting->id }}" name="{{ $setting->name }}" value="1" {{ $setting->status == '1'? 'checked': '' }}>
                        <form class="" id="config_section{{$setting->id}}" name="template_settings">
                          <span class="error{{ $setting->id }} hidden">Please enter value(s)</span>


                              <?php if(isset($setting->mailTemplateSettings)) foreach ($setting->mailTemplateSettings as $templateSetting): ?>



                                <div class="form-group">
                                    <input type="text" placeholder ="{{$templateSetting->display_name}}" class="full-width form-control" id="{{$templateSetting->key}}" name="{{$templateSetting->key}}" value="{{$templateSetting->value?:''}}"/>
                                </div>


                                    <?php endforeach; ?>

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
    $('.template_option').change(function(){
        var attr_id = $(this).attr('id');
        var id = attr_id.substring(8);
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
        var url = '{{ route("admin.email_template_settings.save_configurations", ":id") }}';
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

                  if($('#template'+id).prop("checked") == true)
                      val = 1;
                       //$('#config_section'+id).submit();

                        var formData = $('#config_section'+id).serializeArray();
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


    };
    </script>

      @endsection
