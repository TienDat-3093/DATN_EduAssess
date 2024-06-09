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
</style>
<div class="mt-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createQuestion" onclick="checkType(null,'create_')">
        <i class="ti ti-playlist-add"></i>
        Create
    </button>


</div>
<div class="col-lg-13 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">List Questions</h5>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Id</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">User</h6>
                            </th>

                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Image</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Text</h6>
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
                                <h6 class="fw-semibold mb-0">Function</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listQuestions as $question)
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">{{$question->id}}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1">{{$question->user->username}}</h6>
                            </td>

                            <td class="border-bottom-0">
                                <img src="{{asset($question->question_img)}}" class="question-img" alt="">
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal text-wrap ">{{$question->question_text}}</p>
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                    @if($question->level->name == 'Difficult')
                                    <span class="badge bg-danger rounded-3 fw-semibold">{{$question->level->name}}</span>
                                    @elseif($question->level->name == 'Medium')
                                    <span class="badge bg-secondary rounded-3 fw-semibold">{{$question->level->name}}</span>
                                    @else
                                    <span class="badge bg-success rounded-3 fw-semibold">{{$question->level->name}}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge text-info rounded-3 fw-semibold">{{$question->topic->name}}</span>
                                </div>
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                    @if($question->question_type->name == 'one answer')
                                    <span class="badge bg-dark rounded-3 fw-semibold">{{$question->question_type->name}}</span>
                                    @elseif($question->question_type->name == 'many answers')
                                    <span class="badge bg-warning rounded-3 fw-semibold">{{$question->question_type->name}}</span>
                                    @else
                                    <span class="badge bg-info rounded-3 fw-semibold">{{$question->question_type->name}}</span>
                                    @endif

                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-icon rounded-pill hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><button data-question-id="{{$question->id}}" class="btnDetail dropdown-item" data-bs-toggle="modal" data-bs-target="#detailQuestion">Show Answers</button></li>
                                        <li><button data-question-id="{{$question->id}}" class="btnEdit dropdown-item" data-bs-toggle="modal" data-bs-target="#editQuestion">Edit</button></li>
                                        @if($question->deleted_at)
                                        <li>
                                            <form action="{{ route('question.delete', ['id' => $question->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item">Restore</button>
                                            </form>
                                        </li>
                                        @else
                                        <li>
                                            <form action="{{ route('question.delete', ['id' => $question->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this question?');">
                                                @csrf
                                                <button type="submit" class="dropdown-item">Delete</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var csrfToken = '{{ csrf_token() }}';
    $(document).ready(function() {
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

                            const answerRow = `
                            <tr>
                                <td><img src="img/answers/${answer.img}" alt="Answer Image" class="preview-img"></td>
                                <td class="text-wrap text-break"><p class="mb-0 fw-normal">${answer.text}</p></td>
                                <td><span class="badge ${answer.is_correct ? 'bg-primary' : 'bg-secondary'}">${answer.is_correct ? 'Correct' : 'Incorrect'}</span></td>
                            </tr>
                        `;
                            answersTableBody.append(answerRow);
                        }
                    }

                    $('#detailQuestion').modal('show'); // Show the modal
                }
            }
        })
    }


    function editQuestion(questionID) {
        $.ajax({
            url: 'question/edit/' + questionID,
            type: "get",
            success: function(data, answer) {

                console.log('data', data)

                $('#edit_questionText').val(data.data.question_text);



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
        editQuestion.addEventListener('hidden.bs.modal', () => resetModalQuestion('edit_'));
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
                <input name="${modalType}answers[]" class="form-check-input mt-0" type="${inputType}" ${answer.is_correct ? 'checked' : ''}>
            </span>
            <input type="text" name="${modalType}answerText[]" id="${modalType}answerText${answerCount[modalType]}" class="form-control" value="${answer.text}">
            <label class="btn btn-outline-secondary mb-0" for="${modalType}inputAnswer${answerCount[modalType]}">
                <span class="ti ti-upload"></span>
            </label>
            <input type="file" name="${modalType}answerImg[]" class="form-control d-none" id="${modalType}inputAnswer${answerCount[modalType]}" onchange="previewFile(event, ${answerCount[modalType]}, '${modalType}')">
            <button type="button" class="btn btn-icon" onclick="deleteAnswer(event, ${answerCount[modalType]}, '${modalType}')">
                <span class="ti ti-circle-minus" aria-hidden="true"></span>
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

        const getAnswerTemplate = (index, inputType, modalType) => `
        <div class ="${modalType}answerBox" id="${modalType}answerBox_${index}">
            <div class="input-group mb-2">
                <span class="input-group-text">
                    <input name="${modalType}answers[]" class="form-check-input mt-0" type="${inputType}" >
                </span>
                <input type="text" name="${modalType}answerText[]" class="form-control" id ="${modalType}answerText${index}">
                <label class="btn btn-outline-secondary mb-0" for="${modalType}inputAnswer${index}">
                    <span class="ti ti-upload"></span>
                </label>
                <input type="file" name="${modalType}answerImg[]" class="form-control d-none" id="${modalType}inputAnswer${index}" onchange="previewFile(event,${index},'${modalType}')">
                <button type="button" class="btn btn-icon" onclick="deleteAnswer(event,${index},'${modalType}')">
                    <span class="ti ti-circle-minus" aria-hidden="true"></span>
                </button>
            </div>
            <div id="${modalType}filePreview${index}" class="mt-2"></div>
        </div>`;


        let template = '';

        resetAnswer(modalType);
        document.getElementById(`${modalType}btnAnswer`).style.display = 'block'
        template = getAnswerTemplate(1, 'checkbox', `${modalType}`);
        btnAddAnswer.setAttribute('onclick', `addAnswer('checkbox','${modalType}')`)

        if (typeRadio.value == '1') {
            resetAnswer(modalType);
            document.getElementById(`${modalType}btnAnswer`).style.display = 'block'
            template = getAnswerTemplate(1, 'checkbox', `${modalType}`);
            btnAddAnswer.setAttribute('onclick', `addAnswer('checkbox','${modalType}')`)

        } else if (typeRadio.value == '2') {
            resetAnswer(modalType);
            document.getElementById(`${modalType}btnAnswer`).style.display = 'block'
            template = getAnswerTemplate(1, 'radio', `${modalType}`);
            btnAddAnswer.setAttribute('onclick', `addAnswer('radio','${modalType}')`)

        } else if (typeRadio.value == '3') {
            /* resetAnswer(modalType); */
            document.getElementById(`${modalType}btnAnswer`).style.display = 'none'
            template = getAnswerTemplate(1, 'radio', modalType) + getAnswerTemplate(2, 'radio', modalType);
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
                                     <input name="${modalType}answers[]" class="form-check-input mt-0" type="${inputType}" >
                                 </span>
                                 <input type="text" name="${modalType}answerText[]" id="${modalType}answerText${answerCount[modalType]}" class="form-control">
                                 <label class="btn btn-outline-secondary mb-0" for="${modalType}inputAnswer${answerCount[modalType]}">
                                     <span class="ti ti-upload"></span>
                                 </label>
                                 <input type="file" name="${modalType}answerImg[]" class="form-control d-none" id="${modalType}inputAnswer${answerCount[modalType]}" onchange="previewFile(event,${answerCount[modalType]},'${modalType}')">
                                 <button type="button" class="btn btn-icon" onclick="deleteAnswer(event,${answerCount[modalType]},'${modalType}')">
                                     <span class="ti ti-circle-minus" aria-hidden="true" ></span>
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
        document.getElementById(`${modalType}questionText`).value = '';
        document.getElementById(`${modalType}inputQuestion`).value = '';
        document.getElementById(`${modalType}fileQuestion`).innerHTML = '';

        document.getElementById(`${modalType}topicSelect`).selectedIndex = 0;
        document.getElementById(`${modalType}levelSelect`).selectedIndex = 0;

        checkType('null', `${modalType}`);
        answerCount[modalType] = 1;
    }

    //
    function validateForm(modalType) {

        var questionText = document.getElementById(`${modalType}QuestionText`).value;

        if (questionText.trim() == "") {

            document.getElementById("errorName").innerHTML = '<font style="vertical-align: inherit;color:red">Name can\'t be empty</font>';
            return false;
        }
        return true;
    }
    setTimeout(function() {
        var element = document.getElementById('errorName');
        if (element) {
            element.style.display = 'none';
        };
    }, 5000);


    //
</script>
@endsection
