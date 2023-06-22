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
            $form_action = '/roles';

            $permission = null;
            ?>
        @else
            <?php 
            $title = 'Edit';
            $item_name = $item->name;
            $form_action = '/roles/'.$item->id;
            $permission = $item->permissions;
            ?>
        @endif
        <div class="card card-custom mt-5">
            <div class="card-header">
                <h3 class="card-title">
                    Roles
                </h3>
            </div>
            <!--begin::Form-->
            <form class="form" method="POST" action="{{$form_action}}">
                @if ($action == 'edit')
                    @method('PUT')
                @endif
                <div class="card-body ">
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" value="{{ $item_name }}"  class="form-control" name="name" placeholder="Name"/>
                    </div>     

{{-- 
                    <div class="form-group mt-3">
                      <h3>Role Permissions:</h3>
                      <br>
                      @if($permission)
                        @foreach($item->permissions as $role_permission)
                          <span>{{$role_permission->name}}, </span>
                        @endforeach

                      @endif
                    </div>  --}}

                    

                   
                        @if ($action == 'edit')
                        <h4 style="padding-left:5px; padding-top:30px;">{{$item->name}}'s permissions</h4>
                        @endif
                      <div class="pl-3 pb-5">
                        <?php
                        $group_name_current = '';
                        ?>

                        @foreach($permissions as $permission)
                          <?php
                          list($group_name, $permission_action) = explode(':', $permission->name);
                          $group_name_title = str_replace('_', ' ', ucwords($group_name));
                          ?>
                          @if($group_name_current != $group_name)
                            <div style="clear: both"></div>
                            <br>
                            <h5>{{$group_name_title}}</h5>
                          @endif
                          <?php
                          $group_name_current = $group_name;
                          ?>
                          <div class="checkbox-inline" style="float: left; margin-right:20px; min-width:150px;">
                              <label class="checkbox checkbox-success">
                                  <input type="checkbox" @if($action == 'edit' && $item->hasPermissionTo($permission)) checked='checked' @endif value="{{$permission->name}}" name="permissions[]"/>
                                  <span></span>
                                  {{$permission->name}}
                              </label>
                          </div>
                        @endforeach
                            
                      </div>
                    <div style="clear: both"></div>
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
    <!--end::Container-->
  </x-app-layout>
