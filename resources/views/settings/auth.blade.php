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
              <h3 class="mb-0">{{$subtitle}}</h3>
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
                     <td>
                       @if($setting->type=='text')
                       <input type="text" class="full-width form-control" id="value{{$setting->id}}" value="{{ $setting->value }}" />
                       @elseif($setting->type=='html')
                       <textarea class="richtext" class="full-width form-control" id="value{{$setting->id}}" >{{ $setting->value }}</textarea>
                       @elseif($setting->type=='textarea')
                       <textarea  id="value{{$setting->id}}" class="full-width form-control" >{{ $setting->value }}</textarea>

                       @elseif($setting->type=='select' && $setting->key == 'category_level')
                       <select  id="value{{$setting->id}}" class="full-width form-control" >
                         <option value="1" {{ $setting->value == '1'? 'selected':'' }}>1</option>
                         <option value="2" {{ $setting->value == '2'? 'selected':'' }}>2</option>
                         <option value="3" {{ $setting->value == '3'? 'selected':'' }}>3</option>
                         <option value="4" {{ $setting->value == '4'? 'selected':'' }}>4</option>
                       </select>
                       @elseif($setting->type=='boolean')

                         <input type="radio"  id="value{{$setting->id}}" value="1" name= "{{ $setting->key }}" {{ $setting->value == '1'? 'checked':'' }}/><label for="on">&nbsp;ON</label><br/>
                          <input type="radio" id="value{{$setting->id}}" value="0" name= "{{ $setting->key }}" {{ $setting->value == '0'? 'checked':'' }}/><label for="on">&nbsp;OFF</label>
                       @elseif($setting->type=='checkbox')
                        <input type="checkbox" class="" id="value{{$setting->id}}" value="1" {{ $setting->value == '1'? 'checked':'' }}/>
                       @else
                          <input type="{{$setting->type}}" class="full-width form-control" id="value{{$setting->id}}" value="{{ $setting->value }}"/>
                       @endif

                     </td>
                     <td><button onclick="javascript:update({{$setting->id}}, '{{$setting->type}}')" class="btn btn-primary btn-sm">Update</button></td>
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

    function update(id, type)
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
                      var val;
                      if(type=='boolean')
                          val =$("input[name=value"+id+"]:checked").val();
                      else if(type=='checkbox')
                          if($('#value'+id).prop("checked") == true)
                            val =1;
                          else
                            val = 0;
                       else
                          val = $('#value'+id).val();
                       $.ajax({
                                type:'POST',
                                url:url,
                                data:'_token={{ csrf_token() }}'+'&value='+val,
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
