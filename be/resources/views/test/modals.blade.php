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
                    <div style="display:inline-block; margin:5px;">
                    <input class="btn-check" id="tag-{{ $tag->id }}" autocomplete="off" type="checkbox" name="tag_data[]" value="{{ $tag->id }}" id="tag-{{ $tag->id }}">
                    <label style="border-radius:25px;" class="btn btn-secondary" for="tag-{{ $tag->id }}" class="tag-label">{{ $tag->name }}</label>
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

<!-- Import Export -->
<div class="modal fade" id="importexportTest" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">    
            <div class="modal-header">
                <h5 class="modal-title" id="importexportModalTest">Import/Export Test</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card-body p-4">
                <a href="{{route('test.exportTests')}}"><button class="btn btn-primary mb-4">
                    Export Tests
                </button></a>
                <h5 class="card-title fw-semibold mb-4">Import Tests</h5>
                <form action="{{ route('test.importTests') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <p class="form-label">Your file</p>
                        <input type="file" name="importTests_file" class="form-control" accept=".xlsx">
                    <br>
                    <button type="submit" class="btn btn-primary">Import Tests</button>
                </form>
            </div>
        </div>
    </div>
</div>