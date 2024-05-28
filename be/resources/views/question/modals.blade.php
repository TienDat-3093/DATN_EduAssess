 <!-- Modal Create Question -->
 <div class="modal fade" id="createQuestion" tabindex="-1" style="display: none;" aria-hidden="true">
     <div class="modal-dialog " role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="createModalQuestion">Add Question</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <div class="row">
                     <div class="col mb-3">
                         <label for="createQuestionText" class="form-label">Name</label>
                         <div class="input-group">
                             <input type="text" id="createQuestionText" name="createQuestionText" class="form-control" placeholder="Enter Name">
                             <label class="btn btn-outline-secondary mb-0" for="createInputQuestion">
                                 <span class="ti ti-upload"></span>
                             </label>
                             <input type="file" name="createInputQuestion" class="form-control d-none" id="createInputQuestion" onchange="previewQuestion('create')">
                         </div>
                         <div id="createFileQuestion" name="createFileQuestion" class="mt-2"></div>
                     </div>


                     <div class="mb-3">
                         <label for="createLevelSelect" class="form-label">Level</label>
                         <select id="createLevelSelect" name="createLevelSelect" class="form-select">
                             <option>Level select</option>
                             <option value="1">Easy</option>
                             <option value="2">Medium</option>
                             <option value="3">Difficult</option>
                         </select>
                     </div>
                     <div class="mb-3 mt-1">
                         <label for="createTopicSelect" class="form-label">Topic</label>
                         <select id="createTopicSelect" name="createTopicSelect" class="form-select">
                             <option>Topic select</option>
                             <option value="1">php</option>
                             <option value="2">c+</option>
                             <option value="3">python</option>
                         </select>
                     </div>
                     <label for="answer" class="form-label">Answer</label>
                     <div id="createAnswersContainer">
                         <div id="createAnswerBox_1">
                             <div class="input-group mb-2">
                                 <span class="input-group-text">
                                     <input name="answerCheck" class="form-check-input mt-0" type="checkbox" value="">
                                 </span>
                                 <input type="text" name="answerText" class="form-control">
                                 <label class="btn btn-outline-secondary mb-0" for="createInputAnswer1">
                                     <span class="ti ti-upload"></span>
                                 </label>
                                 <input type="file" name="answerImg" class="form-control d-none" id="createInputAnswer1" onchange="previewFile(event,1,'create')">
                                 <button type="button" class="btn btn-icon">
                                     <span class="ti ti-circle-minus" aria-hidden="true" onclick="deleteAnswer(event,1,'create')"></span>
                                 </button>
                             </div>
                             <div id="createFilePreview1" class="mt-2"></div>
                         </div>
                     </div>




                 </div>
                 <button type="button" class="btn rounded-pill btn-icon" onclick="addAnswer('create')">
                     <span class="ti ti-circle-plus"> Add answer</span>

                 </button>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-outline-secondary" onclick="resetModalQuestion('create')">
                     Delete
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
                 <h5 class="modal-title" id="editModalQuestion">Edit Question</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <div class="row">
                     <div class="col mb-3">
                         <label for="editQuestionText" class="form-label">Name</label>
                         <div class="input-group">
                             <input type="text" id="editQuestionText" name="editQuestionText" class="form-control" placeholder="Enter Name">
                             <label class="btn btn-outline-secondary mb-0" for="editInputQuestion">
                                 <span class="ti ti-upload"></span>
                             </label>
                             <input type="file" name="editInputQuestion" class="form-control d-none" id="editInputQuestion" onchange="previewQuestion('edit')">
                         </div>
                         <div id="editFileQuestion" name="editFileQuestion" class="mt-2"></div>
                     </div>


                     <div class="mb-3">
                         <label for="editLevelSelect" class="form-label">Level</label>
                         <select id="editLevelSelect" name="editLevelSelect" class="form-select">
                             <option>Level select</option>
                             <option value="1">Easy</option>
                             <option value="2">Medium</option>
                             <option value="3">Difficult</option>
                         </select>
                     </div>
                     <div class="mb-3 mt-1">
                         <label for="editTopicSelect" class="form-label">Topic</label>
                         <select id="editTopicSelect" name="editTopicSelect" class="form-select">
                             <option>Topic select</option>
                             <option value="1">php</option>
                             <option value="2">c+</option>
                             <option value="3">python</option>
                         </select>
                     </div>
                     <label for="answer" class="form-label">Answer</label>
                     <div id="editAnswersContainer">
                         <div id="editAnswerBox_1">
                             <div class="input-group mb-2">
                                 <span class="input-group-text">
                                     <input name="answerCheck" class="form-check-input mt-0" type="checkbox" value="">
                                 </span>
                                 <input type="text" name="answerText" class="form-control">
                                 <label class="btn btn-outline-secondary mb-0" for="editInputAnswer1">
                                     <span class="ti ti-upload"></span>
                                 </label>
                                 <input type="file" name="answerImg" class="form-control d-none" id="editInputAnswer1" onchange="previewFile(event,1,'edit')">
                                 <button type="button" class="btn btn-icon">
                                     <span class="ti ti-circle-minus" aria-hidden="true" onclick="deleteAnswer(event,1,'edit')"></span>
                                 </button>
                             </div>
                             <div id="editFilePreview1" class="mt-2"></div>
                         </div>
                     </div>




                 </div>
                 <button type="button" class="btn rounded-pill btn-icon" onclick="addAnswer('edit')">
                     <span class="ti ti-circle-plus"> Add answer</span>

                 </button>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-outline-secondary" onclick="resetModalQuestion('edit')">
                     Delete
                 </button>
                 <button type="button" class="btn btn-primary">Save changes</button>
             </div>
         </div>
     </div>
 </div>
