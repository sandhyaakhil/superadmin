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
                     <td>{{ $setting->display_name }}</td>
                     <td class="w-25">
                       @if($setting->type=='select' && $setting->key=='country')
                       <select class="nice-select select2 open" name="country" id="value{{$setting->id}}" required>

                           <option data-display="Country1*"></option>
                           @foreach($countries as $country)
                           <?php
                           $selected = '';
                           if($country->id == $setting->value)
                           {
                             $selected = "selected";
                           } ?>
                           <option value="{{$country->id}}" {{ $selected }}>{{$country->name}}</option>
                           @endforeach
                       </select>
                       @elseif($setting->type=='image')
                       <img src="{{ $setting->value }}" class="img-fluid img-thumbnail" />
                       <input type="file" class="full-width form-control" id="value{{$setting->id}}" value="{{ $setting->value }}" />

                       @elseif($setting->type=='text')
                       <input type="text" class="full-width form-control" id="value{{$setting->id}}" value="{{ $setting->value }}" />
                       @elseif($setting->type=='html')
                       <textarea class="richtext" class="full-width form-control" id="value{{$setting->id}}" >{{ $setting->value }}</textarea>
                       @elseif($setting->type=='textarea')
                       <textarea  id="value{{$setting->id}}" class="full-width form-control" >{{ $setting->value }}</textarea>
                       @else
                        <input type="{{$setting->type}}" class="full-width form-control" id="value{{$setting->id}}" value="{{ $setting->value }}" />
                       @endif

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

            var url = '{{ route("admin.settings.save_configurations", ":id") }}';
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
                      //console.log($('#status'+id));

                    }
                  });

        };
    </script>

      @endsection
