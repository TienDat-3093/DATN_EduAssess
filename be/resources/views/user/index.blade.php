@extends('layout')

@section('content')
@include('user.modals')
<div class="mt-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createUser">
        <i class="ti ti-playlist-add"></i>
        Create
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
            <h5 class="card-title fw-semibold mb-4">List Users</h5>
            <div class="table-responsive">
                <table id="listUsers" class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Id</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Username</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Email</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Date of Birth</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Is Admin</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Status</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Functions</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @include('user/results')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/jquery-3.7.1.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const createUser = document.getElementById('createUser');
        createUser.addEventListener('hidden.bs.modal', () => resetModalUser('create'));
        
        const editUser = document.getElementById('editUser');
        editUser.addEventListener('hidden.bs.modal', () => resetModalUser('edit'));

        const editButtons = document.querySelectorAll('.edit-user-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                const itemId = button.getAttribute('item-id');
                const itemName = button.getAttribute('item-name');
                const editUserModal = document.getElementById('editUser');
                const editForm = editUserModal.querySelector('form');
                editForm.action = "{{ route('user.editHandle', ['id' => ':itemId']) }}".replace(':itemId', itemId);
                const editName = document.getElementById('editUserName');
                editName.value = itemName;
            });
        });
    })
    function resetModalUser(modalType) {
        document.getElementById(`${modalType}UserName`).value = '';
    }
    setTimeout(function() {
    var element = document.getElementById('errorName');
    if (element) {
        element.style.display = 'none';
    }
    }, 5000);
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
                url: "{{ route('user.search') }}",
                type: 'POST',
                data: {
                    data: keyword,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $j('#listUsers tbody').html(data);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }
        function previewUser(modalType) {
        const fileInput = document.getElementById(`${modalType}InputUser`);
        const fileUser = document.getElementById(`${modalType}FileUser`);
        const file = fileInput.files[0];
        fileUser.innerHTML = '';
        if (file) {
            const fileName = document.createElement('p');
            fileName.textContent = `Selected file: ${file.name}`;
            fileUser.appendChild(fileName);
            if (file.type.startsWith('image/')) {
                const imgUser = document.createElement('img');
                imgUser.classList.add('preview-img');
                imgUser.src = URL.createObjectURL(file);
                fileUser.appendChild(imgUser);
                }
            }
        }
</script>
@endsection
