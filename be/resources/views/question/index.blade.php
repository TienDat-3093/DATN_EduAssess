@extends('layout')

@section('content')
@include('question.modals')
<style>
    .preview-img,.question-img {
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
                                <h6 class="fw-semibold mb-0">Function</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">1</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1">Sunil Joshi</h6>
                                <span class="fw-normal">Web Designer</span>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">Elite Admin</p>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0 fs-4">Null</h6>
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-danger rounded-3 fw-semibold">Difficult</span>
                                </div>
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-primary rounded-3 fw-semibold">php</span>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-icon rounded-pill hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#detailQuestion">Detail</a></li>
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editQuestion">Edit</a></li>
                                        <li><a class="dropdown-item">Delete</a></li>


                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">2</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1">Andrew McDownland</h6>
                                <span class="fw-normal">Project Manager</span>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">Real Homes WP Theme</p>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0 fs-4">Null</h6>
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-secondary rounded-3 fw-semibold">Medium</span>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">3</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1">Christopher Jamil</h6>
                                <span class="fw-normal">Project Manager</span>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">MedicalPro WP Theme</p>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0 fs-4">Null</h6>
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-success rounded-3 fw-semibold">Easy</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

     function previewQuestion() {
        const fileInput = document.getElementById('inputQuestion');
        const fileQuestion = document.getElementById('fileQuestion');
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
    let answerCount = 1;
    function addAnswer(){

    }
    function previewFile(event,answerId) {
        const fileInput = event.target;
        const filePreview = document.getElementById(`filePreview${answerId}`);
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
</script>
@endsection
