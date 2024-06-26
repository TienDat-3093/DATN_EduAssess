@extends('layout')

@section('content')
@include('admin.modals')
<div class="mt-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createUser">
        <i class="ti ti-playlist-add"></i>
        Create
    </button>
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#importexportUser">
        <i class="ti ti-playlist-add"></i>
        Import/Export
    </button>
</div>
    @error('displayname')
    <font id="error" style="vertical-align: inherit;color:red">{{ $message }}.<br></font>
    @enderror
    @error('email')
    <font id="error" style="vertical-align: inherit;color:red">{{ $message }}.<br></font>
    @enderror
    @error('password')
    <font id="error" style="vertical-align: inherit;color:red">{{ $message }}.<br></font>
    @enderror
    @error('date_of_birth')
    <font id="error" style="vertical-align: inherit;color:red">{{ $message }}.<br></font>
    @enderror
<div class="input-group input-group-merge">
    <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
    <input type="text" id="searchInput" class="form-control" placeholder="Search by displayname or email" aria-label="Search by displayname or email"
        aria-describedby="basic-addon-search31">
</div>
<div class="col-lg-13 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">List Users</h5>
            <div class="table-responsive">
                <table id="listUsers" class="table text-nowrap mb-0 align-middle text-center">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Order</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Displayname</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Avatar</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Email</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Date of Birth</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Admin Role</h6>
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
                        @include('admin/results')
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
                editForm.action = "{{ route('admin.editHandle', ['id' => ':itemId']) }}".replace(':itemId', itemId);
                getUser(itemId);
            });
        });
    })
    function resetModalUser(modalType) {
        document.getElementById(`${modalType}Displayname`).value = '';
        document.getElementById(`${modalType}Dateofbirth`).value = '';
        if(modalType == "create"){
        document.getElementById(`${modalType}Email`).value = '';
        document.getElementById(`${modalType}Password`).value = '';
        document.getElementById(`${modalType}RePassword`).value = '';
        }
        const newFilePreview = document.getElementById(`${modalType}FileUser`);
        const imgElement = newFilePreview.querySelector('img');
        if(imgElement)
        newFilePreview.removeChild(imgElement);
    }
    document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                var elements = document.querySelectorAll('#error');
                if (elements) {
                    elements.forEach(function(element) {
                        element.remove();
                    });
                }
            }, 5000);
        });
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
                url: "{{ route('admin.search') }}",
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
    function getUser(userID){
            $j.ajax({
                url: "{{ route('admin.getUser', ['id' => ':userID']) }}".replace(':userID', userID),
                method: 'GET',
                success: function(data) {
                    document.getElementById('editDisplayname').value = data.displayname;
                    document.getElementById('editDateofbirth').value = data.date_of_birth;
                    const imgElement = document.createElement('img');
                    const newFilePreview = document.getElementById('editFileUser');
                    imgElement.src = data.image;
                    imgElement.className = 'preview-img';
                    newFilePreview.appendChild(imgElement);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching user data:', error);
                }
            });
    }
</script>
@endsection
