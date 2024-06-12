

                        @foreach($listQuestions as $question)
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">{{$question->id}}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1">{{$question->user->username}}</h6>
                            </td>

                            <td class="border-bottom-0">
                                <img src="{{asset($question->question_img)}}" class="question-img" style="width: 50px; height: 50px;" alt="">
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
                                    <button type="button" onclick="AddQuestion(this)" questionText="{{$question->question_text}}" questionId="{{$question->id}}" questionTopic="{{$question->topic->id}}" class="btn btn-primary mb-4">
                                        Add
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach