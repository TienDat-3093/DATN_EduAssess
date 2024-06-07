@extends('layout')
@include('test.modals')
@section('content')
<div class="mt-3">
    <a href="{{route('test.create')}}"><button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createTest">
        <i class="ti ti-playlist-add"></i>
        Create
    </button></a>
</div>
<font id="error">
@if(Session::has('error'))
    <font style="vertical-align: inherit;color:red">{{Session::get('error')}}</font>
@endif
</font>
<div class="col-lg-13 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">List Tests</h5>
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
                        @foreach($listTests as $test)
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">{{$test->id}}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1">{{$test->name}}</h6>
                            </td>
                            @if($test->deleted_at)
                            <td class="border-bottom-0">
                                <font class="badge bg-danger rounded-3 fw-semibol">
                                    Deleted at: {{$test->deleted_at}}
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
                                        <li><button onclick="getTags(this)" id="edit-test" type="button" class="edit-test-btn dropdown-item" data-bs-toggle="modal" data-bs-target="#editTest" item-name="{{$test->name}}" item-id="{{$test->id}}" >Edit</button></li>
                                        <li><a href="{{route('test.detail', ['id' => $test->id] )}}"><button id="edit-test" type="button" class="edit-test-btn dropdown-item"  >Detail</button></a></li>
                                        @if($test->deleted_at)
                                        <li><a href="{{ route('test.delete', ['id' => $test->id] )}}" class="dropdown-item">Restore</a></li>
                                        @else
                                        <li><a href="{{ route('test.delete', ['id' => $test->id] )}}" class="dropdown-item">Delete</a></li>
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
@endsection
<script src="{{ asset('assets/jquery-3.7.1.min.js') }}">    
</script>
<script>
    var $j = jQuery.noConflict();
    document.addEventListener('DOMContentLoaded', (event) => {
        const createTag = document.getElementById('editTest');
        editTest.addEventListener('hidden.bs.modal', () => {
            const checkboxes = editTest.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
        });
        setTimeout(function() {
                var elements = document.querySelectorAll('#error');
                if (elements) {
                    elements.forEach(function(element) {
                        element.style.display = 'none';
                    });
                }
            }, 5000);
    });
    function getTags(button) {
            const testID = button.getAttribute('item-id')
            $j.ajax({
                url: "{{ route('test.getTags', ['id' => ':testID']) }}".replace(':testID', testID),
                method: 'GET',
                success: function(data) {
                    const tags = JSON.parse(data.tag_data);
                    tags.forEach(tagNumber => {
                        const input = document.getElementById('tag-' + tagNumber);
                        if (input) {
                            input.checked = true;
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching tag_data:', error);
                }
            });
        const editTest = document.getElementById('editTest');
        const editForm = editTest.querySelector('form');
        editForm.action = "{{ route('test.edit', ['id' => ':testID']) }}".replace(':testID', testID);
    };
</script>