<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">{{$title}}</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
                @if(isset($page) && $page == 'create')
                <li class="breadcrumb-item active"><a href="">{{$title}}</a></li>
                @else
                  <li class="breadcrumb-item active"><a>{{$title}}</a></li>
                  @endif
                @if(isset($page) && $page == 'create')
                  <li class="breadcrumb-item active" aria-current="page"><a href="">{{$subtitle}}</a></li>
                @endif
            </ol>
          </nav>
        </div>

        <div class="col-lg-6 col-5 text-right">



          <select class="nice-select select2 open btn-lg" name="client" id="client" required>

                            <option value="">Select Client</option>
                            @foreach($clients as $client)
                            <?php
                            $selected = '';
                            if($client->id == session()->get('client_id'))
                            {
                              $selected = "selected";
                            } ?>
                            <option value="{{$client->id}}" {{$selected}}>{{$client->name}}</option>
                            @endforeach
                        </select>
                          <a onclick="updateClient()" class="btn btn-sm btn-neutral">Select</a>
      </div>

      </div>
    </div>
  </div>
</div>
<script>
function updateClient()
    {
        var id = $('#client').children("option:selected").val();
        if(id=='') {
        swal(
                'Choose One!',
                'Please choose a client to continue',
                'error'
              );
              location.reload();
            }
        else {
        var url = '{{ route("admin.client.select", ":id") }}';
        url = url.replace(':id', id);


                   $.ajax({
                            type:'POST',
                            url:url,
                            data:'_token={{ csrf_token() }}',
                            success:function(data){
                              if(data==1)
                              {
                                  location.reload(true);
                              }
                              else
                              {
                                console.log(data);
                                swal(
                                        'Failed!',
                                        'Error occured',
                                        'error'
                                      );
                              }
                            },
                            error:function(data)
                            {
                                console.log(data);
                                swal(
                                        'Failed!',
                                        'Error occured',
                                        'error'
                                      );

                            }

                         });
                       }


    };


</script>
