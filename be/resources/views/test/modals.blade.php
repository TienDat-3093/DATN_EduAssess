<!-- Modal Edit Question -->
<div class="modal fade" id="editTest" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog " role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="editModalTest">Edit Test</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
            <form action="" method="POST"  enctype="multipart/form-data">
                @csrf
             <div class="modal-body">
                 <div class="row">
                    <div class="col mb-3">
                         <label for="editTestName" class="form-label">Name</label>
                         <div class="input-group">
                             <input type="text" id="editTestName" name="name" class="form-control" placeholder="Enter Name">
                         </div>
                         <label class="form-label">Test Banner</label><br>
                            <label class="btn btn-outline-secondary mb-0" for="test_img">
                                <span class="ti ti-upload"></span>
                            </label>
                            <input type="file" name="test_img" class="form-control d-none" id="test_img" onchange="previewTest()">
                            <div id="test_imgPreview" name="test_imgPreview" class="mt-2">
                            <img class="preview-img" id="editTestImg"></img>
                            </div>
                     </div>
                 <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Select Tags</h5>
                    <div>
                    <font id="error">
                        @error('tag_data')
                        <font style="vertical-align: inherit;color:red">{{ $message }}</font>
                        @enderror
                    </font>
                    </div>
                    @foreach ($listTags as $tag)
                    <div style="display:inline; border:1px solid; margin:5px; padding:2px; border-radius: 10px;">
                        <label style="user-select: none;" for="tag-{{ $tag->id }}" class="tag-label">{{ $tag->name }}</label>
                        <input type="checkbox" name="tag_data[]" value="{{ $tag->id }}" id="tag-{{ $tag->id }}">
                    </div>
                    @endforeach
                </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="submit" class="btn btn-primary">Save changes</button>
             </div>
            </form>
         </div>
     </div>
</div>