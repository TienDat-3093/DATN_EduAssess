 <!-- Modal Create Question -->
 <div class="modal fade" id="createQuestion" tabindex="-1" style="display: none;" aria-hidden="true">
     <div class="modal-dialog " role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel1">Add Question</h5>
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
                         <label for="defaultSelect" class="form-label">Level</label>
                         <select id="defaultSelect" class="form-select">
                             <option>Level select</option>
                             <option value="1">Easy</option>
                             <option value="2">Medium</option>
                             <option value="3">Difficult</option>
                         </select>
                     </div>
                     <div class="mb-3 mt-1">
                         <label for="defaultSelect" class="form-label">Topic</label>
                         <select id="defaultSelect" class="form-select">
                             <option>Topic select</option>
                             <option value="1">php</option>
                             <option value="2">c+</option>
                             <option value="3">python</option>
                         </select>
                     </div>
                     <label for="answer" class="form-label">Answer</label>
                     <div class="input-group mb-2">
                         <span class="input-group-text"><input name="answers" class="form-check-input mt-0" type="checkbox" value=""></span>
                         <span class="input-group-text"><input type="file" class="form-control" id="inputGroupFile02"></span>
                         <input type="text" class="form-control">
                     </div>
                     <div class="input-group mb-2">
                         <span class="input-group-text"><input name="answers" class="form-check-input mt-0" type="checkbox" value=""></span>
                         <span class="input-group-text"><input type="file" class="form-control" id="inputGroupFile02"></span>
                         <input type="text" class="form-control">
                     </div>
                     <div class="input-group mb-2">
                         <span class="input-group-text"><input name="answers" class="form-check-input mt-0" type="checkbox" value=""></span>
                         <span class="input-group-text"><input type="file" class="form-control" id="inputGroupFile02"></span>
                         <input type="text" class="form-control">
                     </div>
                     <div class="input-group mb-2">
                         <span class="input-group-text"><input name="answers" class="form-check-input mt-0" type="checkbox" value=""></span>
                         <span class="input-group-text"><input type="file" class="form-control" id="inputGroupFile02"></span>
                         <input type="text" class="form-control">
                     </div>
                 </div>
                 <button type="button" class="btn rounded-pill btn-icon">
                     <span class="ti ti-circle-plus">  Add answer</span>

                 </button>
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


 <!-- Modal Edit Question -->
 <div class="modal fade" id="editQuestion" tabindex="-1" style="display: none;" aria-hidden="true">
     <div class="modal-dialog " role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel1">Add Question</h5>
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
                         <label for="defaultSelect" class="form-label">Level</label>
                         <select id="defaultSelect" class="form-select">
                             <option>Level select</option>
                             <option value="1">Easy</option>
                             <option value="2">Medium</option>
                             <option value="3">Difficult</option>
                         </select>
                     </div>
                     <div class="mb-3 mt-1">
                         <label for="defaultSelect" class="form-label">Topic</label>
                         <select id="defaultSelect" class="form-select">
                             <option>Topic select</option>
                             <option value="1">php</option>
                             <option value="2">c+</option>
                             <option value="3">python</option>
                         </select>
                     </div>
                     <label for="answer" class="form-label">Answer</label>
                     <div class="input-group mb-2">
                         <span class="input-group-text"><input name="answers" class="form-check-input mt-0" type="checkbox" value=""></span>
                         <span class="input-group-text"><input type="file" class="form-control" id="inputGroupFile02"></span>
                         <input type="text" class="form-control">
                     </div>
                     <div class="input-group mb-2">
                         <span class="input-group-text"><input name="answers" class="form-check-input mt-0" type="checkbox" value=""></span>
                         <span class="input-group-text"><input type="file" class="form-control" id="inputGroupFile02"></span>
                         <input type="text" class="form-control">
                     </div>
                     <div class="input-group mb-2">
                         <span class="input-group-text"><input name="answers" class="form-check-input mt-0" type="checkbox" value=""></span>
                         <span class="input-group-text"><input type="file" class="form-control" id="inputGroupFile02"></span>
                         <input type="text" class="form-control">
                     </div>
                     <div class="input-group mb-2">
                         <span class="input-group-text"><input name="answers" class="form-check-input mt-0" type="checkbox" value=""></span>
                         <span class="input-group-text"><input type="file" class="form-control" id="inputGroupFile02"></span>
                         <input type="text" class="form-control">
                     </div>
                 </div>
                 <button type="button" class="btn rounded-pill btn-icon">
                     <span class="ti ti-circle-plus">  Add answer</span>

                 </button>
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
