 <!-- Modal Create Question -->
 <div class="modal fade" id="createTag" tabindex="-1" style="display: none;" aria-hidden="true">
     <div class="modal-dialog " role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="createModalTag">Add Tag</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
            <form action="{{ route('tag.create' )}}" method="POST">
                @csrf
             <div class="modal-body">
                 <div class="row">
                     <div class="col mb-3">
                         <label for="createTagName" class="form-label">Name</label>
                         <div class="input-group">
                             <input type="text" id="createTagName" name="name" class="form-control" placeholder="Enter Name">
                         </div>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-outline-secondary" onclick="resetModalTag('create')">
                     Delete
                 </button>
                 <button type="submit" class="btn btn-primary">Save changes</button>
             </div>
            </form>
         </div>
     </div>
 </div>


 <!-- Modal Edit Question -->
 <div class="modal fade" id="editTag" tabindex="-1" style="display: none;" aria-hidden="true">
 <div class="modal-dialog " role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="editModalTag">Edit Tag</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
            <form action="" method="POST">
                @csrf
             <div class="modal-body">
                 <div class="row">
                     <div class="col mb-3">
                         <label for="editTagName" class="form-label">Name</label>
                         <div class="input-group">
                             <input type="text" id="editTagName" name="name" class="form-control" placeholder="Enter Name">
                         </div>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-outline-secondary" onclick="resetModalTag('edit')">
                     Delete
                 </button>
                 <button type="submit" class="btn btn-primary">Save changes</button>
             </div>
            </form>
         </div>
     </div>
     </div>
