@extends('layout')

@section('content')
@include('question.modals')
<style>
    .preview-img,
    .question-img {
        max-height: 100px;
        margin-top: 10px;
    }
</style>
<div class="mt-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createQuestion">
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
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#detailQuestion">Detail</a></li>
                                        <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editQuestion">Edit</button></li>
                                        <li><a class="dropdown-item">Delete</a></li>


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

<script>
    let answerCount = {
        create: 1,
        edit: 1
    };
    //Gọi sự kiện đóng modal ok
    document.addEventListener('DOMContentLoaded', (event) => {
        const createQuestion = document.getElementById('createQuestion');
        createQuestion.addEventListener('hidden.bs.modal', () => resetModalQuestion('create'));
    })

    function previewQuestion(modalType) {
        const fileInput = document.getElementById(`${modalType}InputQuestion`);
        const fileQuestion = document.getElementById(`${modalType}FileQuestion`);
        const file = fileInput.files[0];

        fileQuestion.innerHTML = '';

        if (file) {
            const fileName = document.createElement('p');
            fileName.textContent = `Selected file: ${file.name}`;
            fileQuestion.appendChild(fileName);

            if (file.type.startsWith('image/')) {
                const imgQuestion = document.createElement('img');
                imgQuestion.classList.add('question-img');
                imgQuestion.src = URL.createObjectURL(file);
                fileQuestion.appendChild(imgQuestion);
            }
        }
    }


    function addAnswer(modalType) {
        answerCount[modalType]++;
        const answersContainer = document.getElementById(`${modalType}AnswersContainer`);
        const answerBox = document.createElement('div');
        answerBox.id = `${modalType}AnswerBox_${answerCount[modalType]}`;
        const newInputGroup = document.createElement('div');
        newInputGroup.className = "input-group mb-2";
        newInputGroup.innerHTML = `<span class="input-group-text">
                                     <input name="answers" class="form-check-input mt-0" type="checkbox" value="">
                                 </span>
                                 <input type="text" class="form-control">
                                 <label class="btn btn-outline-secondary mb-0" for="${modalType}InputAnswer${answerCount[modalType]}">
                                     <span class="ti ti-upload"></span>
                                 </label>
                                 <input type="file" class="form-control d-none" id="${modalType}InputAnswer${answerCount[modalType]}" onchange="previewFile(event,${answerCount[modalType]},'${modalType}')">
                                 <button type="button" class="btn btn-icon" onclick="deleteAnswer(event,${answerCount[modalType]},'${modalType}')">
                                     <span class="ti ti-circle-minus" aria-hidden="true" ></span>
                                 </button>
                             </div>`
        const newFilePreview = document.createElement('div');
        newFilePreview.id = `${modalType}FilePreview${answerCount[modalType]}`;
        newFilePreview.className = 'mt-2';

        answersContainer.appendChild(answerBox);
        answerBox.appendChild(newInputGroup);
        answerBox.appendChild(newFilePreview);
    }

    function previewFile(event, index, modalType) {
        const fileInput = event.target;
        const filePreview = document.getElementById(`${modalType}FilePreview${index}`);
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
        const answerInput = document.getElementById(`${modalType}AnswerBox_${index}`);
        answerInput.remove();

    }

    function resetModalQuestion(modalType) {
        document.getElementById(`${modalType}QuestionText`).value = '';
        document.getElementById(`${modalType}InputQuestion`).value = '';
        document.getElementById(`${modalType}FileQuestion`).innerHTML = '';

        document.getElementById(`${modalType}LevelSelect`).selectedIndex = 0;
        document.getElementById(`${modalType}TopicSelect`).selectedIndex = 0;

        const answersContainer = document.getElementById(`${modalType}AnswersContainer`);
        answersContainer.innerHTML = `<div id="createAnswerBox_1">
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
                         </div>`
        answerCount[modalType] = 1;
    }
</script>
@endsection
