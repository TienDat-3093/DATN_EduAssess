@extends('layout')
<style>
    .fixed-corner {
        position: fixed;
        top: 20px; /* Adjust top position as needed */
        right: 20px; /* Adjust right position as needed */
        z-index: 1000; /* Adjust z-index if necessary to ensure it appears above other content */
        padding: 10px;
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
</style>
@section('content')
<form action="{{route('test.createHandle')}}" method="POST" id="createTest">
    @csrf
<div class="col-lg-13 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Create Test</h5>
            <div style="margin:10px;">
            <font id="error">
                @error('name')
                <font style="vertical-align: inherit;color:red">{{ $message }}</font>
                @enderror
            </font>
            </div>
            <div class="col mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Name">
                <button class="btn btn-primary">Create Test</button>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-13 d-flex align-items-stretch">
    <div class="card w-100">
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
<div id="question_data">
</div>
</form>
<div class="col-lg-13 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Automatic Questions Selector</h5>
            <div>
            <font id="error">
                @error('question_data')
                <font style="vertical-align: inherit;color:red">{{ $message }}</font>
                @enderror
            </font>
            </div>
                    <label class="form-label">
                        Level
                    </label>
                    <select id="level" name="levels_id" class="form-select" aria-label="Default select example">
                        <option value="0">All</option>
                        @foreach ($listLevels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                        @endforeach
                    </select>
                    <label class="form-label">
                        Topic
                    </label>
                    <select id="topic" name="topics_id" class="form-select" aria-label="Default select example">
                        <option value="0">All</option>
                        @foreach ($listTopics as $topic)
                            <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                        @endforeach
                    </select>
                    <label class="form-label">
                        Amount
                    </label>
                    <input id="amount_question" class="form-control" type="number" name="amount_question"/>
                    <br>
                    <button id="getQuestionButton" type="button" class="btn btn-outline-secondary">
                        Get questions
                    </button>
        </div>
    </div>
</div>
<div class="col-lg-13 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Selected Questions</h5>
            <div class="table-responsive">
            <table id="listSelectedQuestions" class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Id</h6>
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
                                <h6 class="fw-semibold mb-0">Function</h6>
                            </th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    @include('test/create_results')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/jquery-3.7.1.min.js') }}"></script>
    <script>
        var $j = jQuery.noConflict();
        $j(document).ready(function() {
            $j('#getQuestionButton').on('click', function() {
                getQuestion();
            });
        });
        function removeQuestion(button) {
        var tr = $j(button).closest('tr');
        tr.remove();
            let amount_question = $j('#amount_question').val();
            let selected_questions = [];
            $j('input[name="selected_questions[]"]').each(function() {
                selected_questions.push($j(this).val());
            });
            $j.ajax({
                url: "{{ route('test.getQuestion') }}",
                type: 'POST',
                data: {
                    selected_questions: selected_questions,
                    amount_question: amount_question,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $j('#listSelectedQuestions tbody').html(data);
                    var hiddenInputs = $j('#listSelectedQuestions tbody').find('input[type="hidden"]');
                    $j('#question_data').empty();
                    hiddenInputs.each(function(index, element) {
                        var hiddenInput = document.createElement('input'); // Create a new hidden input element
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'question_data[]'; // Set the name attribute to question_data[]
                        hiddenInput.value = $j(element).val();
                        $j('#question_data').append(hiddenInput);
                    });
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }
        function getQuestion() {
            let topic_id = $j('#topic').val();
            let level_id = $j('#level').val();
            let amount_question = $j('#amount_question').val();
            let selected_questions = [];
            $j('input[type="hidden"][name="selected_questions[]"]').each(function() {
                selected_questions.push($j(this).val());
            });
            // console.log(selected_questions);
            $j.ajax({
                url: "{{ route('test.getQuestion') }}",
                type: 'POST',
                data: {
                    topic_id: topic_id,
                    level_id: level_id,
                    selected_questions: selected_questions,
                    amount_question: amount_question,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $j('#listSelectedQuestions tbody').html(data);
                    var hiddenInputs = $j('#listSelectedQuestions tbody').find('input[type="hidden"]');
                    $j('#question_data').empty();
                    hiddenInputs.each(function(index, element) {
                        var hiddenInput = document.createElement('input'); // Create a new hidden input element
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'question_data[]'; // Set the name attribute to question_data[]
                        hiddenInput.value = $j(element).val();
                        $j('#question_data').append(hiddenInput);
                    });
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        };
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                var elements = document.querySelectorAll('#error');
                if (elements) {
                    elements.forEach(function(element) {
                        element.style.display = 'none';
                    });
                }
            }, 5000);
        });
    </script>
@endsection
