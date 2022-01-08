<!-- Modal -->
<form class='modalAction' action='#' method='POST'>

  {{csrf_field()}}
  {{method_field('DELETE')}}
<div class="modal fade deleteModal" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Are You Sur You Want To Delete Catigory
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="type" class="btn btn-danger">Delete <i class='fas fa-trash'></i></button>
      </div>
    </div>
  </div>
</div>
</form>