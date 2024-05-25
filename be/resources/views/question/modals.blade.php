 <!-- Modal Create Question -->
 <div class="modal fade" id="createQuestion" tabindex="-1" style="display: none;" aria-hidden="true">
     <div class="modal-dialog " role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <div class="row">
                     <div class="col mb-3">
                         <label for="nameBasic" class="form-label">Name</label>
                         <input type="text" id="nameBasic" class="form-control" placeholder="Enter Name">
                     </div>
                     <div class="input-group">
                         <input type="file" class="form-control" id="inputGroupFile02">
                         <label class="input-group-text" for="inputGroupFile02">Upload</label>
                     </div>
                     <div class="mb-3 mt-3">
                         <label for="defaultSelect" class="form-label">Default select</label>
                         <select id="defaultSelect" class="form-select">
                             <option>Default select</option>
                             <option value="1">One</option>
                             <option value="2">Two</option>
                             <option value="3">Three</option>
                         </select>
                     </div>
                     <div class="mb-3 mt-1">
                         <label for="defaultSelect" class="form-label">Default select</label>
                         <select id="defaultSelect" class="form-select">
                             <option>Default select</option>
                             <option value="1">One</option>
                             <option value="2">Two</option>
                             <option value="3">Three</option>
                         </select>
                     </div>
                 </div>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                     Close
                 </button>
                 <button type="button" class="btn btn-primary">Save changes</button>
             </div>
         </div>
     </div>
 </div>


 <!-- Modal Create Question -->
 <div class="modal fade" id="editQuestion" tabindex="-1" style="display: none;" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <div class="row">
                     <div class="col mb-3">
                         <label for="nameBasic" class="form-label">Name</label>
                         <input type="text" id="nameBasic" class="form-control" placeholder="Enter Name">
                     </div>
                 </div>
                 <div class="row g-2">
                     <div class="col mb-0">
                         <label for="emailBasic" class="form-label">Email</label>
                         <input type="text" id="emailBasic" class="form-control" placeholder="xxxx@xxx.xx">
                     </div>
                     <div class="col mb-0">
                         <label for="dobBasic" class="form-label">DOB</label>
                         <input type="text" id="dobBasic" class="form-control" placeholder="DD / MM / YY">
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                     Close
                 </button>
                 <button type="button" class="btn btn-primary">Save changes</button>
             </div>
         </div>
     </div>
 </div>
