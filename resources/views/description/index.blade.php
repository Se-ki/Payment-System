@extends('layouts.main')
@section('title', 'Description')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/payment/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    <!--Container Main start-->
    <div class="card card-outline rounded-0 card-navy">
        <span class="border-top border-black "></span>
        <div class="card-header">
            <div class="row">
                <div class="col-auto">
                    <h2 class="fw-bold">Description List</h2>
                </div>

                <div class="col-auto" style="margin-left:50px">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Create Description Payment
                    </button>
                </div>
            </div>
        </div>
        <main class="cd__main">
            <table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
                <colgroup>
                    <col width="25%">
                    <col width="25%">
                    <col width="25%">

                </colgroup>
                <thead>
                    <tr>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($descriptions as $key => $description)
                        <tr>
                            <td> {{ $description->name }} </td>
                            <td>
                                @if ($description->status === 1)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>

                            <td class="action">
                                <li class="nav-item dropdown">
                                    <a class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon"
                                        data-bs-toggle="dropdown">
                                        Action
                                    </a>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item edit_data" style="cursor:pointer" data-toggle="modal"
                                            id="descriptionButton" data-target="#descriptionModal"
                                            data-attr="{{ route('descriptions.edit', $description->id) }}"><span
                                                class="fa fa-edit text-primary"> </span>Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('description.destroy', $description->id) }}"
                                            id="delete-description" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="dropdown-item"><i
                                                    class="fa-solid fa-trash text-primary"> </i>Delete</button>
                                        </form>
                                    </div>
                                </li>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </main>
        <!-- Modal for adding description -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Description List</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('description.store') }}" method="POST" id="create-description-form">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control" id="floatingDescription"
                                    placeholder="" />
                                <label for="floatingDescription">Description</label>
                                <small class="show-error text-danger"></small>
                            </div>
                            <div class="form-floating">
                                <select name="status" class="form-select" id="floatingSelect"
                                    aria-label="Floating label select example">
                                    <option value="1">
                                        Active
                                    </option>
                                    <option value="0">
                                        Inactive
                                    </option>
                                </select>
                                <label for="floatingSelect">Status</label>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="save-button" data-bs-dismiss="">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal for editing description -->
        <div class="modal fade" id="descriptionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="descriptionLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Description</h1>
                        <span class="modal-title" id="staticBackdropLabel"></span>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="descriptionBody">
                        <!-- //Here Will show the Data -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Container Main end-->
    <script>
        $(document).ready(function() {
            $('#example').DataTable()
        });

        fetchDescriptionData();

        function tableRow(data) {
            return "<tr> \
                    <td>" + data.name + "</td>\
                      <td>" + status(data.status) + "</td>\
                    <td class='action'>\
                        <li class='nav-item dropdown'>\
                              <a class='btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon'\
                                data-bs-toggle='dropdown'>\
                                Action\
                              </a>\
                            <div class='dropdown-menu' role='menu'>\
                                <a class='dropdown-item edit_data' style='cursor:pointer' data-toggle='modal'\
                                      id='descriptionButton' data-target='#descriptionModal'\
                                     data-attr='" + pathTo(data) + "'><span\
                                          class='fa fa-edit text-primary'></span>Edit</a>\
                                   <div class='dropdown-divider'></div>\
                                 <form action=''\
                                  id='delete-description' method='post'>\
                                   <button type='submit' class='dropdown-item'><i\
                                         class='fa-solid fa-trash text-primary'> </i>Delete</button>\
                              </form>\
                               </div>\
                         </li>\
                      </td>\
                </tr>"
        }

        function fetchDescriptionData() {
            $.ajax({
                method: "GET",
                url: "{{ route('ajax-fetch-description') }}",
                dataType: "json",
                success: function(response) {
                    $('tbody').html('')
                    $.each(response.description, function(key, data) {
                        $('tbody').append(tableRow(data))
                    })

                },
                error: function(error) {
                    console.error(error)
                }
            })
        }

        function pathTo(data) {
            return "{{ route('description.edit', '') }}/" + data.id + ""
        }

        function status(s) {
            if (s == 1) {
                return "Active"
            } else {
                return "Inactive"
            }
        }
        $('#create-description-form').submit(function(event) {
            event.preventDefault()
            var form = new FormData(this)
            $.ajax({
                url: "{{ route('description.store') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: form,
                success: function(response) {
                    fetchDescriptionData()
                    $('#exampleModal').modal('hide');
                    alert("You added a description named " + response.name)
                },
                error: function(error) {
                    $(".show-error").html(error.responseJSON.message)
                    console.log(error.responseJSON.message)
                }
            })
        })

        function redirect(path) {
            return location.href = path
        }
    </script>
@endsection
