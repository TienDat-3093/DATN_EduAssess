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
<div class="input-group input-group-merge">
    <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
    <input type="text" id="searchInput" class="form-control" placeholder="Search..." aria-label="Search..."
        aria-describedby="basic-addon-search31">
</div>
<div class="col-lg-13 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">List Tests</h5>
            <div class="table-responsive">
                <table id="listTests" class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Id</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Author</h6>
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
                    @include('test/results')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="{{asset('assets/jquery-3.7.1.min.js')}}"></script>
<script>
    var $j = jQuery.noConflict();
        $j(document).ready(function() {
            $j('#searchInput').on('keyup', function(event) {
                if (event.key === 'Enter') {
                    search();
                }
            });
        });
    function search() {
            let keyword = $j('#searchInput').val();
            $j.ajax({
                url: "{{ route('test.search') }}",
                type: 'POST',
                data: {
                    data: keyword,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $j('#listTests tbody').html(data);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }
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