<!-- Modal -->

<div class="modal fade deleteModal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Search Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
      <table >
        

      </table>

      <table class="table" id='myTable'>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">@lang('user.username')</th>
      <th scope="col">@lang('user.number')</th>
    </tr>
  </thead>
  <tbody>
    @foreach($client as $index => $row)
    <tr id='{{$row->id}}' data-name='{{$row->username}}' class='clientS'>
      <td>{{$index + 1}}</td>
      <td>{{$row->username}}</td>
      <td>{{$row->number}}</td>
    </tr>
    @endforeach
  </tbody>
</table>


    </div>
  </div>
</div>
</form>