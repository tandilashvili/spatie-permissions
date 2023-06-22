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
            $form_action = '/permissions';
            ?>
        @else
            <?php 
            $title = 'Edit';
            $item_name = $item->name;
            $form_action = '/permissions/'.$item->id;
            ?>
        @endif
        <div class="card card-custom mt-5">
            <div class="card-header">
                <h3 class="card-title">
                    Permissions
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
