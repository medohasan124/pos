<!-- Modal -->
<form class='modalActionback' action='#' method='POST'>

  {{csrf_field()}}
 
 
<div class="modal fade modal" id="back" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Are You Sure You Want To Delete item
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="type" class="btn btn-danger">Sure </button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- Modal -->
<form class='modalActionbackAll' action='#' method='POST'>

  {{csrf_field()}}


 
<div class="modal fade modal" id="backAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Are You Sure You Want To  Back All
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="type" class="btn btn-danger">Sure </button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- Modal -->
<form class='modalActioncheckAll' action='#' method='POST'>

  {{csrf_field()}}

 
 
<div class="modal fade modal" id="checkAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Are You Sure You Want To checkAll
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="type" class="btn btn-success">Sure </button>
      </div>
    </div>
  </div>
</div>
</form>