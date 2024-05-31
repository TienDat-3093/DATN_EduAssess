@extends('layout')

@section('content')
@include('topic.modals')
<div class="mt-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createTopic">
        <i class="ti ti-playlist-add"></i>
        Create
    </button>
</div>
<font id="errorName" style="vertical-align: inherit;">
    @error('name')
    <font style="vertical-align: inherit;color:red">{{ $message }}</font>
    @enderror
</font>
<div class="col-lg-13 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">List Topics</h5>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Id</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Status</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Functions</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listTopics as $topic)
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">{{$topic->id}}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1">{{$topic->name}}</h6>
                            </td>
                            @if($topic->deleted_at)
                            <td class="border-bottom-0">
                                <font class="badge bg-danger rounded-3 fw-semibol">
                                    Deleted at: {{$topic->deleted_at}}
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const createTopic = document.getElementById('createTopic');
        createTopic.addEventListener('hidden.bs.modal', () => resetModalTopic('create'));
        
        const editTopic = document.getElementById('editTopic');
        editTopic.addEventListener('hidden.bs.modal', () => resetModalTopic('edit'));

        const editButtons = document.querySelectorAll('.edit-topic-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                const itemId = button.getAttribute('item-id');
                const itemName = button.getAttribute('item-name');
                const editTopicModal = document.getElementById('editTopic');
                const editForm = editTopicModal.querySelector('form');
                editForm.action = "{{ route('topic.edit', ['id' => ':itemId']) }}".replace(':itemId', itemId);
                const editName = document.getElementById('editTopicName');
                editName.value = itemName;
            });
        });
    })
    function resetModalTopic(modalType) {
        document.getElementById(`${modalType}TopicName`).value = '';
    }
    setTimeout(function() {
    var element = document.getElementById('errorName');
    if (element) {
        element.style.display = 'none';
    }
    }, 5000);
</script>
@endsection