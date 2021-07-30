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
              <table class="table align-items-center" id="example2">
                <thead class="thead-light">
                  <tr>
                    <th>Main Category</th>
                    <th>Sub Category</th>
                    <th></th>
                  </tr>
                </thead>
                  <tbody class="list">

                    <form id="config_section" name="category_settings1" >
                    <tr>
                    @foreach($settings as $category)
                    <tr>

                     <td class="w15"><div class=""><input class="category_option" type="checkbox" id="category_{{ $category['category']['category_id'] }}" name="cat_{{ $category['category']['category_id'] }}"  value="1"><?php echo($category['category']['name']);?></div></td></tr>
                       @foreach($category['subcategories'] as $subcategory)
                    <tr> <td></td><td><div><input class="category_option" type="checkbox" id="category_{{ $subcategory['category_id'] }}" name="subcat_{{ $subcategory['category_id'] }}" value="1"><?php echo($subcategory['name']);?></div></td></tr>
                       @endforeach
                          @endforeach

                        </tr>
                    <tr>
                     <td><input type="button" onclick="javascript:update()" class="btn btn-primary btn-sm" value="update"/></td>
                   </tr>
                     </form>
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

    function update()
        {

            var url = '{{ route("admin.category_settings.save_configurations") }}';
              //  url = url.replace(':id', '1');
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
                        var formData = $('#config_section').serializeArray();
                        var arr = [];
                        $.each(formData, function(i, field){
                          var split = field.name.split('_');
    arr.push(split[1]);
     });

console.log(arr);

                        // if($('#category'+id).prop("checked") == true){
                              // $('#config_section').filter(':input')
                              //  .each(function () {
                              //    alert();
                              //    console.log('here'+$(this).id)
                              //     if($(this).val() != ''){
                              //         console.log($(this).id);
                              //         var split = split($(this).id, '_');
                              //         arr.push(split[1]);
                              //     }
                              // });
                        // }
                        //console.log(formData);
                       $.ajax({
                                type:'POST',
                                url:url,
                                data:'_token={{ csrf_token() }}'+'&ids='+arr,
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
