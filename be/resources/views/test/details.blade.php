@extends('layout')

@section('content')
<style>
    .preview-img,
    .question-img {
        max-height: 100px;
        margin-top: 10px;
    }
</style>
<div class="mt-3">
    <a href="{{route('test.index')}}"><button type="button" class="btn btn-primary mb-4">
        Return
    </button></a>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listQuestions as $question)
                        <tr>
                            <td class="border-bottom-0">
                                @php
                                    $textWithoutTags = strip_tags($question->question_text);
                                @endphp
                                <h6 class="fw-semibold mb-1">
                                @if (strlen($textWithoutTags) > 30)
                                    <span title="{{$textWithoutTags}}">{!! substr($textWithoutTags, 0, 30) !!}...</span>
                                @else
                                    {!! $question->question_text !!}
                                @endif
                                </h6>
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

<script src="{{ asset('assets/jquery-3.7.1.min.js') }}"></script>
<script>
    var csrfToken = '{{ csrf_token() }}';
    $(document).ready(function() {
        $('.btnDetail').click(function() {
            var questionID = $(this).data('question-id');
            showAnswers(questionID);
            console.log('detail', questionID);

        })
    })
    function showAnswers(questionID) {
        console.log('answer', questionID)
        $.ajax({
            url: '/question/edit/' + questionID,
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
</script>
@endsection