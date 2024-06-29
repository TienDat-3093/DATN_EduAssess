@php
    $order = 1;
@endphp
@foreach($listTopics as $topic)
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">{{$order}}</h6>
                            </td>
                            @php
                                $order++;
                            @endphp
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1">{{$topic->name}}</h6>
                            </td>
                            @if($topic->deleted_at)
                            <td class="border-bottom-0">
                                <font class="badge bg-danger rounded-3 fw-semibol">
                                    Deleted at: {{ \Carbon\Carbon::parse($topic->deleted_at)->format('d/m/Y H:i:s') }}
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
                                        <li><button class="edit-topic-btn dropdown-item" data-bs-toggle="modal" data-bs-target="#editTopic" item-name="{{$topic->name}}" item-id="{{$topic->id}}" >Edit</button></li>
                                        @if($topic->deleted_at)
                                        <li><a href="{{ route('topic.delete', ['id' => $topic->id] )}}" class="dropdown-item">Restore</a></li>
                                        @else
                                        <li><a href="{{ route('topic.delete', ['id' => $topic->id] )}}" class="dropdown-item">Delete</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach