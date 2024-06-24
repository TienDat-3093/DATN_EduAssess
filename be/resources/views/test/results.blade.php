@foreach($listTests as $test)
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">{{$test->id}}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1">{{$test->name}}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <img src="{{asset($test->test_img)}}" class="preview-img" alt="">
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1">{{$test->user->username}}</h6>
                            </td>
                            @if($test->deleted_at)
                            <td class="border-bottom-0">
                                <font class="badge bg-danger rounded-3 fw-semibol">
                                    Deleted at: {{ \Carbon\Carbon::parse($test->deleted_at)->format('d/m/Y H:i:s') }}
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