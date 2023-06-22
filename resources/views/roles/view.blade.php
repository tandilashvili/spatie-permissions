<x-app-layout>
    <div class="container mt-5">
      @can("role:add")
      <a href="/roles/create" class="btn btn-success mb-2">Create</a>
      @endcan
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col" style="width: 100px">#</th>
                <th scope="col">Name</th>
                <th scope="col" style="width: 150px">Actions</th>
              </tr>
            </thead>
            <tbody>
               @foreach ($items as $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$item->name}}</td>
                    <td>

                      <div style="display: flex">

                        @can("role:update")
                          <a href="/roles/{{$item->id}}/edit" class="btn btn-primary">Edit</a>
                        @endcan

                        @can('role:delete')
                          <form action="roles/{{$item->id}}/" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="delete btn btn-danger" style="margin-left:4px; background:#dc3545; color:white;">Delete</button>
                          </form>
                        @endcan

                      </div>
                     
                    </td>
                </tr>
               @endforeach 
             
              
            </tbody>
          </table>

    </div>




</x-app-layout>
