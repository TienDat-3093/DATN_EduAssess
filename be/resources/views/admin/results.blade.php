@php
    $order = 1;
@endphp
@foreach ($listUsers as $user)
    <tr>
        <td class="border-bottom-0">
            <h6 class="fw-semibold mb-0">{{$order}}</h6>
        </td>
        <td class="border-bottom-0">
            <h6 class="fw-semibold mb-0">{{$user->displayname}}</h6>
        </td>
        <td class="border-bottom-0">
            <img src="{{ $user->image ? asset($user->image) : asset('img/users/default.png') }}" class="preview-img" alt="">
        </td>
        <td class="border-bottom-0">
            <h6 class="fw-semibold mb-0">{{$user->email}}</h6>
        </td>
        <td class="border-bottom-0">
            <h6 class="fw-semibold mb-0">{{ \Carbon\Carbon::parse($user->date_of_birth)->format('d/m/Y') }}</h6>
        </td>
        <td class="border-bottom-0">
            @if($user->admin_role == 1)
            <h6 class="fw-semibold mb-0">Admin</h6>
            @elseif($user->admin_role == 2)
            <h6 class="fw-semibold mb-0">Lead Admin</h6>
            @endif
        </td>
        @if($user->status == 0)
        <td class="border-bottom-0">
            <font class="badge bg-danger rounded-3 fw-semibol">
                Locked
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
                    <li><button id="edit-user" type="button" class="edit-user-btn dropdown-item" data-bs-toggle="modal" data-bs-target="#editUser" item-name="{{$user->name}}" item-id="{{$user->id}}" >Edit</button></li>
                    @if($user->status == 0)
                    <li><a href="{{ route('admin.delete', ['id' => $user->id] )}}" class="dropdown-item">Unlock</a></li>
                    @else
                    <li><a href="{{ route('admin.delete', ['id' => $user->id] )}}" class="dropdown-item">Lock</a></li>
                    @endif
                </ul>
            </div>
        </td>
    </tr>
@php
    $order++;
@endphp
@endforeach