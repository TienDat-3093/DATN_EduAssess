 <!-- Modal Create Question -->
 <div class="modal fade" id="createQuestion" tabindex="-1" style="display: none;" aria-hidden="true">
     <div class="modal-dialog " role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="create_modalQuestion">Add Question</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form id="create_questionForm" action="{{route('question.create')}}" method="post" enctype="multipart/form-data" onsubmit="return validateForm('create_')">
                 @csrf
                 <div class="modal-body">
                     <div class="row">
                         <div class="col mb-3">
                             <label for="create_questionText" class="form-label">Name</label>
                                <textarea id="create_editor" name="create_questionText"></textarea>
                                 <label class="btn btn-outline-secondary mb-0" for="create_inputQuestion">
                                     <span class="ti ti-upload"></span>
                                 </label>
                                 <input type="file" name="create_questionImg" class="form-control d-none" id="create_inputQuestion" onchange="previewQuestion('create_')">
                             
                             <font id="errorName" style="vertical-align: inherit;">
                                 @error('questionText')
                                 <font style="vertical-align: inherit;color:red">{{ $message }}</font>
                                 @enderror
                             </font>
                             <div id="create_fileQuestion" name="create_fileQuestion" class="mt-2"></div>
                         </div>


                         <div class="mb-3">
                             <label for="create_levelSelect" class="form-label">Level</label>
                             <select id="create_levelSelect" name="create_level" class="form-select">
                                 @if(!empty($listLevels))
                                 @foreach($listLevels as $level )
                                 <option value="{{$level->id}}">{{$level->name}}</option>

                                 @endforeach
                                 @else
                                 <option value="">No choose</option>
                                 @endif
                             </select>
                         </div>
                         <div class="mb-3 mt-1">
                             <label for="create_topicSelect" class="form-label">Topic</label>
                             <select id="create_topicSelect" name="create_topic" class="form-select">
                                 @if(!empty($listTopics))
                                 @foreach($listTopics as $topic)
                                 <option value="{{$topic->id}}">{{$topic->name}}</option>

                                 @endforeach
                                 @else
                                 <option value="">No choose</option>
                                 @endif
                             </select>
                         </div>
                         <div class="col-md mb-2">
                             <label for="create_typeRadio" class="form-label d-block">Question Type</label>
                             @if(!empty($listTypes))
                             @foreach($listTypes as $type)
                             <div class="form-check form-check-inline mt-2">
                                 <input class="form-check-input" type="radio" name="create_typeRadio" id="create_typeRadio{{$type->id}}" value="{{$type->id}}" @if($type->id ==1) checked @endif >
                                 <label class="form-check-label" for="create_typeRadio{{$type->id}}">{{$type->name}}</label>
                             </div>

                             @endforeach
                             @endif
                         </div>
                         <label for="create_answer" class="form-label">Answer</label>
                         <div id="create_answersContainer">
                             <!-- answers -->

                         </div>


                     </div>
                     <button id="create_btnAnswer" type="button" class="btn rounded-pill btn-icon" onclick="addAnswer('checkbox','create_')">
                         <span class="ti ti-circle-plus"> Add answer</span>

                     </button>


                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-outline-secondary" onclick="resetModalQuestion('create_')">
                         Delete
                     </button>

                     <button type="submit" class="btn btn-primary">Save changes</button>
                 </div>
             </form>
         </div>
     </div>
 </div>


 <!-- Modal Edit Question -->
 <div class="modal fade" id="editQuestion" tabindex="-1" style="display: none;" aria-hidden="true">
     <div class="modal-dialog " role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalQuestion">Edit Question</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form id="edit_questionForm" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm('edit_')">
                 @csrf
                 <div class="modal-body">


                     <div class="row">
                         <div class="col mb-3">
                             <label for="edit_questionText" class="form-label">Name</label>
                                <textarea id="edit_editor" name="edit_questionText"></textarea>
                                 <label class="btn btn-outline-secondary mb-0" for="edit_inputQuestion">
                                     <span class="ti ti-upload"></span>
                                 </label>
                                 <input type="file" name="edit_questionImg" class="form-control d-none" id="edit_inputQuestion" onchange="previewQuestion('edit_')">
                             

                             <div id="edit_fileQuestion" name="edit_fileQuestion" class="mt-2">
                                 <img src="" class="question-img" id="edit_loadImg" />
                             </div>
                         </div>


                         <div class="mb-3">
                             <label for="edit_levelSelect" class="form-label">Level</label>
                             <select id="edit_levelSelect" name="edit_level" class="form-select">
                                 @if(!empty($listLevels))
                                 @foreach($listLevels as $level )
                                 <option value="{{$level->id}}">{{$level->name}}</option>

                                 @endforeach
                                 @else
                                 <option value="">No choose</option>
                                 @endif
                             </select>
                         </div>
                         <div class="mb-3 mt-1">
                             <label for="edit_topicSelect" class="form-label">Topic</label>
                             <select id="edit_topicSelect" name="edit_topic" class="form-select">
                                 @if(!empty($listTopics))
                                 @foreach($listTopics as $topic)
                                 <option value="{{$topic->id}}">{{$topic->name}}</option>

                                 @endforeach
                                 @else
                                 <option value="">No choose</option>
                                 @endif
                             </select>
                         </div>
                         <div class="col-md mb-2">
                             <label for="edit_typeRadio" class="form-label d-block">Question Type</label>
                             @if(!empty($listTypes))
                             @foreach($listTypes as $type)
                             <div class="form-check form-check-inline mt-2">
                                 <input class="form-check-input" type="radio" name="edit_typeRadio" id="edit_typeRadio{{$type->id}}" value="{{$type->id}}" @if($type->id ==1) checked @endif >
                                 <label class="form-check-label" for="edit_typeRadio{{$type->id}}">{{$type->name}}</label>
                             </div>

                             @endforeach
                             @endif
                         </div>
                         <label for="answer" class="form-label">Answer</label>
                         <div id="edit_answersContainer">
                             <!-- answers -->

                         </div>


                     </div>
                     <button id="edit_btnAnswer" type="button" class="btn rounded-pill btn-icon" onclick="addAnswer('checkbox','edit_')">
                         <span class="ti ti-circle-plus"> Add answer</span>

                     </button>


                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-outline-secondary" onclick="resetModalQuestion('edit_')">
                         Delete
                     </button>

                     <button type="submit" class="edit-question-btn btn btn-primary" data-id="">Save changes</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <div class="modal fade" id="detailQuestion" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Answer Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Img</th>
                                <th>Text</th>
                                <th>Answer Right</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                <td><img src="" alt="Avatar" class="preview-img"></td>
                                <td class="text-wrap text-break"><p class="mb-0 fw-normal">Your long text here that needs to be wrapped properly within the table cell to ensure it doesn't overflow.</p></td>
                                <td><span class="badge bg-secondary rounded-3 fw-semibold">Medium</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

