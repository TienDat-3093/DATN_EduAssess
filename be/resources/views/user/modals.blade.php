 <!-- Modal Create User -->
 <div class="modal fade" id="createUser" tabindex="-1" style="display: none;" aria-hidden="true">
     <div class="modal-dialog " role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="createModalUser">Add User</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
            <form action="{{ route('user.createHandle' )}}" method="POST" enctype="multipart/form-data">
                @csrf
             <div class="modal-body">
                 <div class="row">
                     <div class="col mb-3">
                         <label for="createUserName" class="form-label">Username</label>
                         <div class="input-group">
                             <input type="text" id="createUsername" name="username" class="form-control" placeholder="Enter username">
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col mb-3">
                         <label for="createUserName" class="form-label">Email</label>
                         <div class="input-group">
                             <input type="email" id="createEmail" name="email" class="form-control" placeholder="Enter email">
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col mb-3">
                         <label for="createUserName" class="form-label">Password</label>
                         <div class="input-group">
                             <input type="password" id="createPassword" name="password" class="form-control" placeholder="Enter password">
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col mb-3">
                         <label for="createUserName" class="form-label">Confirm Password</label>
                         <div class="input-group">
                             <input type="password" id="createRePassword" name="password_confirmation" class="form-control" placeholder="Re-Enter password">
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col mb-3">
                         <label for="createUserName" class="form-label">Date of Birth</label>
                         <div class="input-group">
                             <input type="date" id="createDateofbirth" name="date_of_birth" class="form-control">
                         </div>
                     </div>
                 </div>
                <label class="btn btn-outline-secondary mb-0" for="createInputUser">
                    <span class="ti ti-upload"></span>
                </label>
                <input type="file" name="image" class="form-control d-none" id="createInputUser" onchange="previewUser('create')">
                <div id="createFileUser" name="createFileUser" class="mt-2"></div>
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-outline-secondary" onclick="resetModalUser('create')">
                     Delete
                 </button>
                 <button type="submit" class="btn btn-primary">Save changes</button>
             </div>
            </form>
         </div>
     </div>
 </div>


 <!-- Modal Edit User -->
 <div class="modal fade" id="editUser" tabindex="-1" style="display: none;" aria-hidden="true">
 <div class="modal-dialog " role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="editModalUser">Edit User</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                 <div class="row">
                     <div class="col mb-3">
                         <label for="editUserName" class="form-label">Username</label>
                         <div class="input-group">
                             <input type="text" id="editUsername" name="username" class="form-control" placeholder="Enter username">
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col mb-3">
                         <label for="editUserName" class="form-label">Date of Birth</label>
                         <div class="input-group">
                             <input type="date" id="editDateofbirth" name="date_of_birth" class="form-control">
                         </div>
                     </div>
                 </div>
                <label class="btn btn-outline-secondary mb-0" for="editInputUser">
                    <span class="ti ti-upload"></span>
                </label>
                <input type="file" name="image" class="form-control d-none" id="editInputUser" onchange="previewUser('edit')">
                <div id="editFileUser" name="editFileUser" class="mt-2"></div>
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-outline-secondary" onclick="resetModalUser('edit')">
                     Delete
                 </button>
                 <button type="submit" class="btn btn-primary">Save changes</button>
             </div>
            </form>
         </div>
     </div>
     </div>
