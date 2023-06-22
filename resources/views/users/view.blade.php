<x-app-layout>
    <div class="container mt-5">

      @can('user:add')
        <a href="/users/create" class="btn btn-success mb-2">Create</a>
      @endcan

        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col" style="width: 100px">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Roles</th>
                <th scope="col" style="width: 150px">Actions</th>
              </tr>
            </thead>
            <tbody>
               @foreach ($users as $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>

                    <td>
                      @php
                        $roles = '';
                        foreach ($item->roles as $role) {
                          $roles .= $role->name.', ';
                        }
                        $roles = trim($roles,", ");
                      @endphp
                      
                      {{$roles}}

                    </td>
                    <td colspan="2">
                      @can("user:update")
                        <a href="/users/{{$item->id}}/edit" class="btn btn-primary">Edit</a>
                      @endcan
                      @can("user:delete")
                      <button class="delete btn btn-danger" onclick="del(event, 'users')" id="{{$item->id}}">Delete</button>
                      @endcan
                    </td>
                </tr>
               @endforeach 
             
              
            </tbody>
          </table>           
    </div>


<script>


  
async function del(event, model) {

if(confirm("Do you really want to delete this record?")){
  let id = event.target.id;

  console.log(id);
    
  fetch('/'+model+'/' + id, {
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
}


</script>   

</x-app-layout>
