@extends('layout')

@section('content')
<div class="mt-3">
    <a href="{{route('test.create')}}"><button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createTest">
        <i class="ti ti-playlist-add"></i>
        Create
    </button></a>
</div>
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
                                    @if($test->deleted_at)
                                        <a href="{{ route('test.delete', ['id' => $test->id] )}}"><button class="btn btn-secondary">Restore</button></a>
                                    @else
                                        <a href="{{ route('test.delete', ['id' => $test->id] )}}"><button class="btn btn-secondary">Delete</button></a>
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
