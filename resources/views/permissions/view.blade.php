<x-app-layout>
    <div class="container mt-5">
      @can("permission:add")
        <a href="/permissions/create" class="btn btn-success mb-2">Create</a>
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

                        @can("permission:update")
                          <a href="/permissions/{{$item->id}}/edit" class="btn btn-primary">Edit</a>
                        @endcan

                        @can('permission:delete')
                          <form action="permissions/{{$item->id}}/" method="POST">
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

    <script>


      async function deleteUnite(event) {

        let id = event.target.id;

        console.log(id);
          
        fetch('/permissions/' + id, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Replace with your actual CSRF token
          },
        })
        .then(response => {
          if (response.ok) {
            // Handle success response
            console.log('Permission deleted successfully.');

            var button = event.target; // Get the clicked button
            var row = button.parentNode.parentNode; // Get the parent <tr> element
            row.parentNode.removeChild(row); // Remove the <tr> element from the DOM


          } else {
            // Handle error response
            console.log('Error deleting permission.');
          }
        })
        .catch(error => {
          // Handle network error
          console.log('Network error:', error);
        });

      
      }



    </script>

</x-app-layout>
