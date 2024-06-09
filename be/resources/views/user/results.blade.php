@foreach ($listUsers as $user)
    <tr>
        <td class="border-bottom-0">
            <h6 class="fw-semibold mb-0">{{$user->id}}</h6>
        </td>
        <td class="border-bottom-0">
            <h6 class="fw-semibold mb-0">{{$user->username}}</h6>
        </td>
        <td class="border-bottom-0">
            <h6 class="fw-semibold mb-0">{{$user->email}}</h6>
        </td>
        <td class="border-bottom-0">
            <h6 class="fw-semibold mb-0">{{ \Carbon\Carbon::parse($user->date_of_birth)->format('d/m/Y') }}</h6>
        </td>
        @if($user->is_admin == 1)
        <td class="border-bottom-0">
            <h6 class="fw-semibold mb-0">Admin</h6>
        </td>
        @else
        <td class="border-bottom-0">
            <h6 class="fw-semibold mb-0">Normal</h6>
        </td>
        @endif
        @if($user->deleted_at)
        <td class="border-bottom-0">
            <font class="badge bg-danger rounded-3 fw-semibol">
                Deleted at: {{ \Carbon\Carbon::parse($user->deleted_at)->format('d/m/Y H:i:s') }}
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
                    @if($user->deleted_at)
                    <li><a href="{{ route('user.delete', ['id' => $user->id] )}}" class="dropdown-item">Restore</a></li>
                    @else
                    <li><a href="{{ route('user.delete', ['id' => $user->id] )}}" class="dropdown-item">Delete</a></li>
                    @endif
                </ul>
            </div>
        </td>
    </tr>
@endforeach