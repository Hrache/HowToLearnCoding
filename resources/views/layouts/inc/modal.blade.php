<div class="modal" tabindex="-1" role="dialog" id="emailmodal">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header bg-dark text-white">
    <h5 class="modal-title">Delete comment #<strong id="comment_id"></strong></h5>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   </div>
   <div id="emailredtxt"></div>
   <div class="modal-body d-flex flex-row justify-content-start p-1">

    <input type="email" id="modalemail" class="form-control" value="" />

    <span class="btn">
     <img src="{{ asset('images/delete.svg') }}" style="display: none;" data-action-image="destroy" width="16" />
     <img src="{{ asset('images/edit.svg') }}" style="display: none;" data-action-image="edit" width="16" />
    </span>
   </div>
   <small class="modal-body text-small p-1 pl-3">
    Enter the author email <sup class="text-red">*</sup>
   </small>
   <div class="modal-footer btn-group">
    <button type="button" class="btn btn-danger" onclick="Comment.destroy();">Check</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>