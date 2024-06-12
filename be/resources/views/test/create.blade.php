@extends('layout')

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
</form>
<div class="col-lg-13 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Select Questions</h5>
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
                    <button id="searchButton" type="button" class="btn btn-outline-secondary">
                        Search
                    </button>
        </div>
    </div>
</div>
<div id="added-question">
</div>
<div class="col-lg-13 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">List Questions</h5>
            <div class="table-responsive">
                <table id="listSearchQuestions" class="table text-nowrap mb-0 align-middle">
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
            $j('#searchButton').on('click', function() {
                search();
            });
        });

        function search() {
            let topic_id = $j('#topic').val();
            let level_id = $j('#level').val();
            $j.ajax({
                url: "{{ route('test.searchQuestion') }}",
                type: 'POST',
                data: {
                    topic_id: topic_id,
                    level_id: level_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $j('#listSearchQuestions tbody').html(data);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        };
        function AddQuestion(button) {
            var questionId = button.getAttribute('questionId');
            var questionTopic = button.getAttribute('questionTopic');
            var questionText = button.getAttribute('questionText');

            var existingContainer = document.querySelector('div[data-question="' + questionId + '"][data-topic="' + questionTopic + '"]');
            var existingParagraph = document.querySelector('p[data-question="' + questionId + '"][data-topic="' + questionTopic + '"]');

            if (existingContainer||existingParagraph) {
                return;
            }

            var container = document.createElement('div');
            container.setAttribute('data-question', questionId);
            container.setAttribute('data-topic', questionTopic);

            var questionInput = document.createElement('input');
            questionInput.type = 'hidden';
            questionInput.name = 'question_data[]';
            questionInput.value = questionId;

            var topicInput = document.createElement('input');
            topicInput.type = 'hidden';
            topicInput.name = 'topic_data[]';
            topicInput.value = questionTopic;

            container.appendChild(questionInput);
            container.appendChild(topicInput);

            document.getElementById('createTest').appendChild(container);
            
            var wrapperDiv = document.createElement('div');

            var questionParagraph = document.createElement('p');
            questionParagraph.style.display = 'inline';
            questionParagraph.setAttribute('data-question', questionId);
            questionParagraph.setAttribute('data-topic', questionTopic);
            questionParagraph.textContent = 'Added Question: ' + questionText;

            var deleteButton = document.createElement('button');
            deleteButton.style.display = 'inline';
            deleteButton.textContent = 'X';
            deleteButton.onclick = function() {
                DeleteQuestion(this,questionId, questionTopic);
            };

            var container = document.getElementById('added-question');

            wrapperDiv.appendChild(questionParagraph);
            wrapperDiv.appendChild(deleteButton);

            container.appendChild(wrapperDiv);
        };
        function DeleteQuestion(button,questionId,questionTopic){
            var existingContainer = document.querySelector('div[data-question="' + questionId + '"][data-topic="' + questionTopic + '"]');
            var existingParagraph = document.querySelector('p[data-question="' + questionId + '"][data-topic="' + questionTopic + '"]');

            if (existingContainer) {
                existingContainer.remove();
            }

            if (existingParagraph) {
                existingParagraph.remove();
            }
            button.remove();
            return;
        }
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
