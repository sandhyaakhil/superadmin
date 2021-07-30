@extends('layouts.main')

@section('content')

@include('settings.partials.header',['clients'=> $clients])

<link rel="stylesheet" href="{{ asset('adm') }}/dist/css/sweetalert.css">
<script src="{{ asset('adm') }}/dist/js/sweetalert.min.js"></script>
<script src="{{ asset('') }}/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
        selector: '.richtext',
        height: 200,
        menubar: false,
        plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css']
        });
</script>



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
                    @if(session()->has('client_id'))
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

                       @elseif($setting->type=='select' && $setting->key == 'industry')
                       <select class="nice-select select2 open full-width form-control" name="industry" id="value{{$setting->id}}" required>

                           <option data-display="Select"></option>
                           @foreach($industries as $industry)
                           <?php
                           $selected = '';
                           if($industry->id == $setting->value)
                           {
                             $selected = "selected";
                           } ?>
                           <option value="{{$industry->id}}" {{ $selected }}>{{$industry->name}}</option>
                           @endforeach
                       </select>

                       @elseif($setting->type=='boolean')

                         <input type="radio"  id="value{{$setting->id}}" value="1" name= "value{{$setting->id}}" {{ $setting->value == '1'? 'checked':'' }}/><label for="on">&nbsp;ON</label><br/>
                          <input type="radio" id="value{{$setting->id}}" value="0" name= "value{{$setting->id}}" {{ $setting->value == '0'? 'checked':'' }}/><label for="on">&nbsp;OFF</label>
                       @else
                        <input type="{{$setting->type}}" class="full-width form-control" id="value{{$setting->id}}" value="{{ $setting->value }}" />
                       @endif

                     </td>
                     <td><button onclick="javascript:update({{$setting->id}}, '{{$setting->type}}')" class="btn btn-primary btn-sm">Update</button></td>
                   </tr>
                   @endforeach
                   @endif
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
                        else
                       val=  $('#value'+id).val();
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
