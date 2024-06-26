@extends('layout')

@section('content')
@include('question.modals')
<style>
    .preview-img,
    .question-img {
        max-height: 100px;
        max-width: 100px;
        margin-top: 10px;
    }
    td > h6 > p {
    margin-bottom: 0;
    }
</style>
<div class="mt-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createQuestion" onclick="checkType(null,'create_')">
            <i class="ti ti-playlist-add"></i>
            Create
        </button>
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#importexportQuestion">
            <i class="ti ti-playlist-add"></i>
            Import/Export
        </button>
</div>
<div class="col-lg-13 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Select Questions</h5>
            <div>
            </div>
                <form action="/question" method="GET">
                    <div class="d-flex mb-4">
                        <div class="flex-fill me-2">
                            <label for="searchQuestionText" class="form-label">Question Text</label>
                            <input type="text" id="searchQuestionText" name="question_text" class="form-control" placeholder="Enter Question" value="{{ request('question_text', old('question_text')) }}">
                        </div>
                        <div class="flex-fill me-2">
                            <label for="searchUser" class="form-label">User</label>
                            <input type="text" id="searchUser" name="user_displayname" class="form-control" placeholder="Enter User" value="{{ request('user_displayname', old('user_displayname')) }}">
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="flex-fill me-2">
                        <label class="form-label">Level</label>
                        <select id="level" name="levels_id" class="form-select" aria-label="Default select example">
                            <option value="0" {{ (request()->has('levels_id') && request('levels_id') == 0) ? 'selected' : '' }}>All</option>
                            @foreach ($listLevels as $level)
                                <option value="{{ $level->id }}" {{ (request()->has('levels_id') && request('levels_id') == $level->id) ? 'selected' : '' }}>{{ $level->name }}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="flex-fill me-2">
                        <label class="form-label">Topic</label>
                        <select id="topic" name="topics_id" class="form-select" aria-label="Default select example">
                            <option value="0" {{ (request()->has('topics_id') && request('topics_id') == 0) ? 'selected' : '' }}>All</option>
                            @foreach ($listTopics as $topic)
                                <option value="{{ $topic->id }}" {{ (request()->has('topics_id') && request('topics_id') == $topic->id) ? 'selected' : '' }}>{{ $topic->name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary">
                        Search
                    </button>
                </form>
        </div>
    </div>
</div>
<div class="col-lg-13 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">List Questions</h5>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle text-center">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Order</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">User</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Text</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Image</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Level</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Topic</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Type</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Status</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Function</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-bordered">
                    @php
                        $order = 1;
                    @endphp
                    @foreach($listQuestions as $question)
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">{{$order}}</h6>
                            </td>
                            @php
                                $order++;
                            @endphp
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1">{{$question->user->displayname}}</h6>
                            </td>
                            <td class="border-bottom-0">
                                @php
                                    $textWithoutTags = strip_tags($question->question_text);
                                @endphp
                                <h6 class="fw-semibold mb-1">
                                @if (strlen($textWithoutTags) > 25)
                                    <span title="{{$textWithoutTags}}">{!! substr($textWithoutTags, 0, 25) !!}...</span>
                                @else
                                    {!! $question->question_text !!}
                                @endif
                                </h6>
                            </td>
                            <td class="border-bottom-0">
                                <img src="{{asset($question->question_img)}}" class="question-img" alt="">
                            </td>
                            <td class="border-bottom-0">
                                @if($question->level->name == 'Difficult')
                                <span class="badge bg-danger rounded-3 fw-semibold">{{$question->level->name}}</span>
                                @elseif($question->level->name == 'Medium')
                                <span class="badge bg-secondary rounded-3 fw-semibold">{{$question->level->name}}</span>
                                @else
                                <span class="badge bg-success rounded-3 fw-semibold">{{$question->level->name}}</span>
                                @endif
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge text-info rounded-3 fw-semibold">{{$question->topic->name}}</span>
                                </div>
                            </td>
                            <td class="border-bottom-0">
                                @if($question->question_type->name == 'one answer')
                                <span class="badge bg-dark rounded-3 fw-semibold">{{$question->question_type->name}}</span>
                                @elseif($question->question_type->name == 'many answers')
                                <span class="badge bg-warning rounded-3 fw-semibold">{{$question->question_type->name}}</span>
                                @else
                                <span class="badge bg-info rounded-3 fw-semibold">{{$question->question_type->name}}</span>
                                @endif
                            </td>
                            @if($question->deleted_at)
                            <td class="border-bottom-0">
                                <font class="badge bg-danger rounded-3 fw-semibol">
                                    Inactive
                                </font>
                            </td>
                            @else
                            <td class="border-bottom-0">
                                <font class="badge bg-success rounded-3 fw-semibol">
                                    Active
                                </font>
                            </td>
                            @endif
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-icon rounded-pill hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><button data-question-id="{{$question->id}}" class="btnDetail dropdown-item" data-bs-toggle="modal" data-bs-target="#detailQuestion">Show Answers</button></li>
                                        @if($question->deleted_at)
                                        <li>
                                            <form action="{{ route('question.delete', ['id' => $question->id]) }}" method="POST" class="restore-form">
                                                @csrf
                                                <button type="button" class="dropdown-item restore-link">Restore</button>
                                            </form>
                                        </li>
                                        @else
                                        <li>
                                        <li>
                                            <button data-question-id="{{$question->id}}" class="btnEdit dropdown-item" data-bs-toggle="modal" data-bs-target="#editQuestion">Edit</button></li>
                                            <form action="{{ route('question.delete', ['id' => $question->id]) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('POST')
                                                <button type="button" class="dropdown-item delete-link">Delete</button>
                                            </form>
                                        </li>
                                        @endif


                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>

    </div>

</div>

<script src="{{ asset('assets/jquery-3.7.1.min.js') }}"></script>
<script>
        ClassicEditor
            .create(document.querySelector( '#create_editor' ) )
            .then(  newEditor => {
                create_editor = newEditor;
                newEditor.model.document.on('change:data', () => {
                handleInput(newEditor.getData(), 'create');
                });
            } )
            .catch(error => {
                console.error(error);
            });
        // ClassicEditor
        //     .create(document.querySelector( '#edit_editor' ) )
        //     .then(  newEditor => {
        //         edit_editor = newEditor;
        //         newEditor.model.document.on('change:data', () => {
        //         handleInput(newEditor.getData(), 'edit');
        //     });
        //     } )
        //     .catch(error => {
        //         console.error(error);
        //     });
            
    let typingTimer;
    const doneTypingInterval = 500; // 1 second
    let previousValue = { create: '', edit: '' };
    function handleInput(value, editorType, id = null) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function() {
            if(value && value !== previousValue[editorType]) {
                previousValue[editorType] = value;
                processInput(value,editorType,id);
            }
            // Call your processing function here or perform any actions
        }, doneTypingInterval);
    }

    function processInput(question_text,editorType,id) {
        $.ajax({
            url: url = 'question/findDupeQuestions' + (id ? '/' + id : ''),
            type: "post",
            data: {
                    question_text: question_text,
                    _token: '{{ csrf_token() }}'
                },
            success: function(matching_questions) {
                //Remove old lines
                var alertElement = document.getElementById(editorType+'_name_duplicate_error')
                var children = Array.from(alertElement.children);
                    children.forEach(child => {
                        if (child.tagName !== 'BUTTON' && child.tagName !== 'H4') {
                            child.remove();
                        }
                    });
                if (matching_questions.length > 0) {
                    //Add new lines
                    for (const question of matching_questions) {
                        alertElement.innerHTML += question.question_text;
                    };
                    alertElement.classList.remove('d-none');
                }else{
                    var alertElement = document.getElementById(editorType+'_name_duplicate_error')
                    alertElement.classList.add('d-none');
                }
            }
        })
    }
    function hideAlert(button) {
        var alertDiv = button.closest('.alert');
        alertDiv.classList.add('d-none');
        //Remove old lines
        var children = Array.from(alertDiv.children);
        children.forEach(child => {
            if (child !== button && child.tagName !== 'H4') {
                child.remove();
            }
        });
    }
</script>
<script>
    var csrfToken = '{{ csrf_token() }}';
    $(document).ready(function() {
        $("#create_questionForm").submit(function(event) {
                const errorAlert = $(this).find('#create_name_duplicate_error');
                if (!errorAlert.hasClass('d-none')) {
                    event.preventDefault();
                    alert("Question duplicates haven't been resolved yet.");
                }
        });
        $("#edit_questionForm").submit(function(event) {
                const errorAlert = $(this).find('#edit_name_duplicate_error');
                if (!errorAlert.hasClass('d-none')) {
                    event.preventDefault();
                    alert("Question duplicates haven't been resolved yet.");
                }
        });
        var editID = 0;
        $('.btnEdit').click(function() {
            var questionID = $(this).data('question-id');
            editID = questionID;
            editQuestion(questionID);
            console.log('editID', editID);
        })
        $('.btnDetail').click(function() {
            var questionID = $(this).data('question-id');
            showAnswers(questionID);
            console.log('detail', questionID);

        })
        $('.edit-question-btn').click(function() {

            var formAction = "{{ route('question.editHandle', ['id' => ':id']) }}";
            formAction = formAction.replace(':id', editID);
            $('#edit_questionForm').attr('action', formAction);
        });
    })
    $('#createQuestion').on('show.bs.modal', function(e) {
        $('#edit_answersContainer').empty();
        $('#editQuestion').modal('hide');



    });

    $('#editQuestion').on('show.bs.modal', function(e) {
        $('#create_createQuestion').modal('hide');

    });

    function showAnswers(questionID) {
        console.log('answer', questionID)
        $.ajax({
            url: 'question/edit/' + questionID,
            type: "get",
            success: function(data, answer) {

                console.log('data', data)
                if (data.answer) {
                    const answers = data.answer[0].answer_data;
                    const answersTableBody = $('#detailQuestion tbody');

                    answersTableBody.empty();

                    const answersData = JSON.parse(answers);

                    for (const key in answersData) {
                        if (answersData.hasOwnProperty(key)) {
                            const answer = answersData[key];

                            // Create a new row
                            const answerRow = document.createElement('tr');

                            // Img cell
                            let imgCell = document.createElement('td');
                            if (answer.img) {
                                const img = document.createElement('img');
                                img.src = `img/answers/${answer.img}`;
                                img.alt = 'Answer Image';
                                img.classList.add('preview-img');
                                imgCell.appendChild(img);
                            }else{
                                const textParagraph = document.createElement('p');
                                textParagraph.textContent = "No Image";
                                imgCell.appendChild(textParagraph);
                            }
                            answerRow.appendChild(imgCell);

                            // Text cell
                            const textCell = document.createElement('td');
                            textCell.className = 'text-wrap text-break';
                            const textParagraph = document.createElement('p');
                            textParagraph.className = 'mb-0 fw-normal';
                            textParagraph.textContent = answer.text;
                            textCell.appendChild(textParagraph);
                            answerRow.appendChild(textCell);

                            // Badge cell
                            const badgeCell = document.createElement('td');
                            const badge = document.createElement('span');
                            badge.className = `badge ${answer.is_correct ? 'bg-primary' : 'bg-secondary'}`;
                            badge.textContent = answer.is_correct ? 'Correct' : 'Incorrect';
                            badgeCell.appendChild(badge);
                            answerRow.appendChild(badgeCell);

                            // Append row to the table body
                            console.log(answerRow);
                            answersTableBody.append(answerRow);
                        }
                    }

                    $('#detailQuestion').modal('show'); // Show the modal
                }
            }
        })
    }


    function editQuestion(questionID) {
        $('#edit_questionImg').hide();
        $.ajax({
            url: 'question/edit/' + questionID,
            type: "get",
            success: function(data, answer) {

                console.log(data.data.question_img)
                const editorElement = document.querySelector('#edit_editor');
                ClassicEditor
                .create(editorElement)
                .then(newEditor => {
                    edit_editor = newEditor;
                    edit_editor.setData(data.data.question_text);
                    edit_editor.model.document.on('change:data', () => {
                        handleInput(edit_editor.getData(), 'edit', questionID);
                    });
                })
                .catch(error => {
                    console.error(error);
                });
                $("#edit_topicSelect").val(data.data.topic_id);
                $("#edit_levelSelect").val(data.data.level_id);

                $('input[name="edit_typeRadio"][value="' + data.data.question_type_id + '"]').prop('checked', true);
                if (data.data.question_type_id == '1') {
                    loadAnswer(data.answer[0].answer_data, 'edit_', 'checkbox')
                } else if (data.data.question_type_id == '2') {
                    loadAnswer(data.answer[0].answer_data, 'edit_', 'radio')
                } else if (data.data.question_type_id == '3') {
                    loadAnswer(data.answer[0].answer_data, 'edit_', 'radio')
                }
                const imgElement = document.createElement('img');
                const newFilePreview = document.getElementById('edit_fileQuestion');
                if (data.data.question_img) {
                imgElement.src = data.data.question_img;
                }
                imgElement.className = 'preview-img';
                newFilePreview.appendChild(imgElement);
            }
        })
    }



    let create_answer = 1;
    let edit_answer = 1;
    let answerCount = {
        create_: 1,
        edit_: 1
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        //event close modal ok
        const createQuestion = document.getElementById('createQuestion');
        createQuestion.addEventListener('hidden.bs.modal', () => {
            resetModalQuestion('create_');
        });
        const editQuestion = document.getElementById('editQuestion');
        editQuestion.addEventListener('hidden.bs.modal', () => {
            resetModalQuestion('edit_');
            // window.location.reload();
        });
        //end event


        document.getElementById('edit_questionForm').addEventListener('change', (event) => {
            if (event.target.name === 'edit_typeRadio') {
                checkType(event, 'edit_');
            }
        });
        document.getElementById('create_questionForm').addEventListener('change', (event) => {
            if (event.target.name === 'create_typeRadio') {
                checkType(event, 'create_');

            }
        });
        document.getElementById('createQuestion').addEventListener('submit', (event) => {
            var checkInputs = document.querySelectorAll('input[name="create_answers[]"].check-box');
            var hiddenInputs = document.querySelectorAll('input[name="create_answers[]"][type="hidden"].hidden-box');

            checkInputs.forEach(function(item, index) {
                if (item.checked == true) {
                    hiddenInputs[index].disabled = true;
                } else {
                    hiddenInputs[index].disabled = false;
                }
            })
        })
        document.getElementById('editQuestion').addEventListener('submit', (event) => {
            var checkInputs = document.querySelectorAll('input[name="edit_answers[]"].check-box');
            var hiddenInputs = document.querySelectorAll('input[name="edit_answers[]"][type="hidden"].hidden-box');

            checkInputs.forEach(function(item, index) {
                if (item.checked == true) {
                    hiddenInputs[index].disabled = true;
                } else {
                    hiddenInputs[index].disabled = false;
                }
            })

            // var imgInputs = document.querySelectorAll('input[name="edit_answerImg[]"]');
            // var hiddenImg = document.querySelectorAll('input[name="edit_answerImg[]"][type="hidden"]');

            // imgInputs.forEach(function(item, index) {
            //     checkbox.addEventListener('change', function() {
            //         console.log("running");
            //         hiddenInputs[index].disabled = true;
            //     });
            // })
        })
        document.querySelectorAll('.delete-link').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                var form = this.closest('form');

                Swal.fire({
                    title: 'Xác Nhận Xóa?',
                    text: 'Bạn có chắc muốn xóa câu hỏi ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy bỏ',
                }).then(function(result) {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        document.querySelectorAll('.restore-link').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                var form = this.closest('form');
                var name = this.getAttribute('data-name');

                Swal.fire({
                    title: 'Xác Nhận Khôi Phục?',
                    text: 'Bạn có chắc muốn khôi phục câu hỏi: ' + name,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy bỏ',
                }).then(function(result) {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });


    })
    //

    function loadAnswer(dataString, modalType, inputType) {
        const data = JSON.parse(dataString);

        answerCount[modalType] = 0;
        console.log(inputType);
        const answersContainer = document.getElementById(`${modalType}answersContainer`);
        answersContainer.innerHTML = ''
        Object.keys(data).forEach(function(key) {
            answerCount[modalType]++;
            const answer = data[key];
            const answerId = key.split('_')[1];

            const answerBox = document.createElement('div');
            answerBox.className = `${modalType}answerBox`;
            answerBox.id = `${modalType}answerBox_${answerCount[modalType]}`;

            const newInputGroup = document.createElement('div');
            newInputGroup.className = "input-group mb-2";
            newInputGroup.innerHTML = `
            <span class="input-group-text">
                <input name="${modalType}answers[]" class="check-box form-check-input mt-0" type="${inputType}" ${answer.is_correct ? 'checked' : ''} value ="1">
                <input name ="${modalType}answers[]" class="hidden-box" type="hidden" value="0">
            </span>
            <input type="text" name="${modalType}answerText[]" id="${modalType}answerText${answerCount[modalType]}" class="form-control" value="${answer.text}">
            <label class="btn btn-outline-secondary mb-0" for="${modalType}inputAnswer${answerCount[modalType]}">
                <span class="ti ti-upload"></span>
            </label>
            <input type="file" name="${modalType}answerImg[]" class="form-control d-none" id="${modalType}inputAnswer${answerCount[modalType]}" onchange="previewFile(event, ${answerCount[modalType]}, '${modalType}')">
            <input type="hidden" name="${modalType}answerImg[]" id="${modalType}inputAnswer${answerCount[modalType]}" value="${answer.img ? answer.img : ''}">
            <button type="button" class="btn btn-icon" onclick="deleteAnswer(event, ${answerCount[modalType]}, '${modalType}')">
                <span class="ti ti-circle-minus" style="font-size: 20px;" aria-hidden="true"></span>
            </button>
        `;

            const newFilePreview = document.createElement('div');
            newFilePreview.id = `${modalType}filePreview${answerCount[modalType]}`;
            newFilePreview.className = 'mt-2';


            answersContainer.appendChild(answerBox);
            answerBox.appendChild(newInputGroup);
            answerBox.appendChild(newFilePreview);


            if (answer.img) {
                const imgElement = document.createElement('img');
                imgElement.src = 'img/answers/' + answer.img;
                imgElement.className = 'preview-img';
                newFilePreview.appendChild(imgElement);
            }
        });

    }

    function checkType(event, modalType) {

        const questionForm = document.getElementById(`${modalType}questionForm`);

        const typeRadio = questionForm.querySelector(`input[name="${modalType}typeRadio"]:checked`);
        const answersContainer = document.getElementById(`${modalType}answersContainer`);
        const btnAddAnswer = document.getElementById(`${modalType}btnAnswer`);

        // const getAnswerTemplate = (index, inputType, modalType) => `
        // <div class ="${modalType}answerBox" id="${modalType}answerBox_${index}">
        //     <div class="input-group mb-2">
        //         <span class="input-group-text">
        //             <input name="${modalType}answers[]" class="check-box form-check-input mt-0" type="${inputType}" value ="1">
        //             <input name ="${modalType}answers[]" class="hidden-box" type="hidden" value="0">
        //             </span>
        //         <input type="text" name="${modalType}answerText[]" class="form-control" id ="${modalType}answerText${index}">
        //         <label class="btn btn-outline-secondary mb-0" for="${modalType}inputAnswer${index}">
        //             <span class="ti ti-upload"></span>
        //         </label>
        //         <input type="file" name="${modalType}answerImg[]" class="form-control d-none" id="${modalType}inputAnswer${index}" onchange="previewFile(event,${index},'${modalType}')">
        //         <button type="button" class="btn btn-icon" onclick="deleteAnswer(event,${index},'${modalType}')">
        //             <span class="ti ti-circle-minus" aria-hidden="true"></span>
        //         </button>
        //     </div>
        //     <div id="${modalType}filePreview${index}" class="mt-2"></div>
        // </div>`;


        let template = '';

        resetAnswer(modalType);
        document.getElementById(`${modalType}btnAnswer`).style.display = 'block'
        // template = getAnswerTemplate(1, 'checkbox', `${modalType}`);
        btnAddAnswer.setAttribute('onclick', `addAnswer('checkbox','${modalType}')`)

        if (typeRadio.value == '1') {
            resetAnswer(modalType);
            document.getElementById(`${modalType}btnAnswer`).style.display = 'block'
            // template = getAnswerTemplate(1, 'checkbox', `${modalType}`);
            btnAddAnswer.setAttribute('onclick', `addAnswer('checkbox','${modalType}')`)

        } else if (typeRadio.value == '2') {
            resetAnswer(modalType);
            document.getElementById(`${modalType}btnAnswer`).style.display = 'block'
            // template = getAnswerTemplate(1, 'radio', `${modalType}`);
            btnAddAnswer.setAttribute('onclick', `addAnswer('radio','${modalType}')`)

        } else if (typeRadio.value == '3') {
            /* resetAnswer(modalType); */
            document.getElementById(`${modalType}btnAnswer`).style.display = 'none'
            // template = getAnswerTemplate(1, 'radio', modalType) + getAnswerTemplate(2, 'radio', modalType);
        }
        answersContainer.innerHTML = template;

    }

    function addAnswer(inputType, modalType) {
        answerCount[modalType]++;
        const answersContainer = document.getElementById(`${modalType}answersContainer`);
        const answerBox = document.createElement('div');
        answerBox.className = `${modalType}answerBox`;
        answerBox.id = `${modalType}answerBox_${answerCount[modalType]}`;
        const newInputGroup = document.createElement('div');
        newInputGroup.className = "input-group mb-2";
        newInputGroup.innerHTML = `<span class="input-group-text">
                                     <input name="${modalType}answers[]" class="check-box form-check-input mt-0" type="${inputType}" value="1">
                                        <input name ="${modalType}answers[]" class="hidden-box" type="hidden" value="0">
                                     </span>
                                 <input type="text" name="${modalType}answerText[]" id="${modalType}answerText${answerCount[modalType]}" class="form-control">
                                 <label class="btn btn-outline-secondary mb-0" for="${modalType}inputAnswer${answerCount[modalType]}">
                                     <span class="ti ti-upload"></span>
                                 </label>
                                 <input type="file" name="${modalType}answerImg[]" class="form-control d-none" id="${modalType}inputAnswer${answerCount[modalType]}" onchange="previewFile(event,${answerCount[modalType]},'${modalType}')">
                                 <button type="button" class="btn btn-icon" onclick="deleteAnswer(event,${answerCount[modalType]},'${modalType}')">
                                     <span class="ti ti-circle-minus" style="font-size: 20px;" aria-hidden="true" ></span>
                                 </button>
                             </div>`
        const newFilePreview = document.createElement('div');
        newFilePreview.id = `${modalType}filePreview${answerCount[modalType]}`;
        newFilePreview.className = 'mt-2';

        answersContainer.appendChild(answerBox);
        answerBox.appendChild(newInputGroup);
        answerBox.appendChild(newFilePreview);
    }

    function previewQuestion(modalType) {

        const fileInput = document.getElementById(`${modalType}inputQuestion`);

        const fileQuestion = document.getElementById(`${modalType}fileQuestion`);
        const file = fileInput.files[0];

        fileQuestion.innerHTML = '';

        if (file) {
            const fileName = document.createElement('p');
            fileName.textContent = `Selected file: ${file.name}`;
            fileQuestion.appendChild(fileName);

            if (file.type.startsWith('image/')) {
                const imgQuestion = document.createElement('img');
                imgQuestion.classList.add('preview-img');
                imgQuestion.src = URL.createObjectURL(file);
                fileQuestion.appendChild(imgQuestion);
            }
        }
    }



    function previewFile(event, index, modalType) {
        const fileInput = event.target;
        const filePreview = document.getElementById(`${modalType}filePreview${index}`);
        const file = fileInput.files[0];

        filePreview.innerHTML = '';

        if (file) {
            const fileName = document.createElement('p');
            fileName.textContent = `Selected file: ${file.name}`;
            filePreview.appendChild(fileName);

            if (file.type.startsWith('image/')) {
                const imgPreview = document.createElement('img');
                imgPreview.classList.add('preview-img');
                imgPreview.src = URL.createObjectURL(file);
                filePreview.appendChild(imgPreview);
            }
        }
    }

    function deleteAnswer(event, index, modalType) {
        const button = event.target;
        const answerInput = document.getElementById(`${modalType}answerBox_${index}`);
        answerInput.remove();

    }

    function resetAnswer(modalType) {
        const answersContainer = document.getElementById(`${modalType}answersContainer`);
        answersContainer.innerHTML = ``
        answerCount[modalType] = 1;
    }

    function resetModalQuestion(modalType) {
        if (modalType === 'create_') {
            create_editor.setData('');
        } else if (modalType === 'edit_') {
            edit_editor.setData('');
        }
        document.getElementById(`${modalType}inputQuestion`).value = '';
        document.getElementById(`${modalType}fileQuestion`).innerHTML = '';
        document.getElementById(`${modalType}topicSelect`).selectedIndex = 0;
        document.getElementById(`${modalType}levelSelect`).selectedIndex = 0;

        // const newFilePreview = document.getElementById(`${modalType}fileQuestion`);
        // const imgElement = newFilePreview.querySelector('img');
        // if(imgElement)
        // imgElement.src = '';
    
        checkType('null', `${modalType}`);
        answerCount[modalType] = 1;
        //Reset dupe question check
        previousValue.create = '';
        previousValue.edit = '';
        //Reset dupe question alert
        var alertElement = document.getElementById(modalType+'name_duplicate_error')
        var children = Array.from(alertElement.children);
            children.forEach(child => {
                if (child.tagName !== 'BUTTON' && child.tagName !== 'H4') {
                    child.remove();
                }
            });
        alertElement.classList.add('d-none');
        //Reset ckeditor
        if (edit_editor) {
            edit_editor.destroy()
                .then(() => {
                    console.log('Editor destroyed');
                    edit_editor = null; // Reset the editor variable
                })
                .catch(error => {
                    console.error('Error destroying editor:', error);
                });
        }
    }

    //
    function validateForm(modalType) {
        var questionText;
        if (modalType === 'create_') {
            questionText = create_editor.getData();
        } else if (modalType === 'edit_') {
            questionText = edit_editor.getData();
        }

        if (questionText.trim() == "") {

            document.getElementById(modalType+"errorName").innerHTML = '<font style="vertical-align: inherit;color:red">(Name can\'t be empty)</font>';
            
            setTimeout(function() {
                var element = document.getElementById(modalType+'errorName');
                if (element) {
                    element.innerHTML = '';
                };
            }, 5000);
            return false;
        }
        return true;
    }

    //
</script>
@endsection
