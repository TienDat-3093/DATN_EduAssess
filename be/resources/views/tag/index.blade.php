@extends('layout')

@section('content')
@include('tag.modals')
<div class="mt-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createTag">
        <i class="ti ti-playlist-add"></i>
        Create
    </button>
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#importexportTag">
        <i class="ti ti-playlist-add"></i>
        Import/Export
    </button>
</div>
<font id="errorName" style="vertical-align: inherit;">
    @error('name')
    <font style="vertical-align: inherit;color:red">{{ $message }}</font>
    @enderror
</font>
<div class="input-group input-group-merge">
    <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
    <input type="text" id="searchInput" class="form-control" placeholder="Search..." aria-label="Search..."
        aria-describedby="basic-addon-search31">
</div>
<div class="col-lg-13 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">List Tags</h5>
            <div class="table-responsive">
                <table id="lisTags" class="table text-nowrap mb-0 align-middle text-center">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Order</h6>
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
                    <tbody class="table-bordered">
                    @include('tag/results')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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
                url: "{{ route('tag.search') }}",
                type: 'POST',
                data: {
                    data: keyword,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $j('#lisTags tbody').html(data);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }
    document.addEventListener('DOMContentLoaded', (event) => {
        const createTag = document.getElementById('createTag');
        createTag.addEventListener('hidden.bs.modal', () => resetModalTag('create'));
        
        const editTag = document.getElementById('editTag');
        editTag.addEventListener('hidden.bs.modal', () => resetModalTag('edit'));

        const editButtons = document.querySelectorAll('.edit-tag-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                const itemId = button.getAttribute('item-id');
                const itemName = button.getAttribute('item-name');
                const editTagModal = document.getElementById('editTag');
                const editForm = editTagModal.querySelector('form');
                editForm.action = "{{ route('tag.edit', ['id' => ':itemId']) }}".replace(':itemId', itemId);
                const editName = document.getElementById('editTagName');
                editName.value = itemName;
            });
        });
    })
    function resetModalTag(modalType) {
        document.getElementById(`${modalType}TagName`).value = '';
    }
    setTimeout(function() {
    var element = document.getElementById('errorName');
    if (element) {
        element.style.display = 'none';
    }
    }, 5000);
</script>
@endsection
