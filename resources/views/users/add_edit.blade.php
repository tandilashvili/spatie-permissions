<x-app-layout>

<style>
  .form-group{
    margin: 30px 5px;
  }

  .form-control{
    border-radius: 10px !important;
  }

</style>

@section('content')
    <!--begin::Container-->
    <div class=" container ">
        @if ($action == 'add')
            <?php 
            $title = 'Add New';
            $item_name = old('name');
            $item_email = old('email');
            $form_action = '/users';
            ?>
        @else
            <?php 
            $title = 'Edit';
            $item_name = $item->name;
            $item_email = $item->email;
            $form_action = '/users/'.$item->id;
            ?>
        @endif
        <div class="card card-custom mt-5">
            <div class="card-header">
                <h3 class="card-title">
                     Users
                </h3>
            </div>
            <!--begin::Form-->
            <form class="form" method="POST" action="{{$form_action}}">
                @if ($action == 'edit')
                    @method('PUT')
                @endif
                <div class="card-body">
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" value="{{ $item_name }}"  class="form-control" name="name" placeholder="Name"/>
                    </div>

                    <div class="form-group">
                      <label>Email<span class="text-danger">*</span></label>
                      <input type="text" value="{{ $item_email }}"  class="form-control" name="email" placeholder="Name"/>
                  </div>

                  <div class="form-group">
                    <label>Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" placeholder="password"/>
                  </div>

                  <div class="form-group mt-3">
                    <label>Roles <span class="text-danger">*</span></label>
                    <select class="form-control" name="role_ids[]" id="role_id" multiple style="height: 150px">
                      @foreach ($roles as $role)
                        <option value="{{$role->id}}" @if(in_array($role->id, $roleIds)) selected @endif>{{$role->name}}</option>
                      @endforeach
                    </select>
                  </div>

                </div>






                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Submit</button>
                    {{-- <a href="/control-standards" class="btn btn-secondary">Cancel</a> --}}
                    @csrf
                </div>
            </form>
            <!--end::Form-->

        </div>

    </div>
  
    

  </x-app-layout>
