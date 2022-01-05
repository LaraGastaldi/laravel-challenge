@extends('layout')

@section('extra_header')
    <script></script>
    <script src="https://kit.fontawesome.com/0181f8b5db.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
    <script>
        function changePassVisibility() {
            const element = document.getElementById("passField");
            const eye = document.getElementById("eye");
            if (element.type === "password") {
                element.type = "text"
            } else {
                element.type = "password"
            }
            if (eye.classList.contains("fa-eye-slash")) {
                eye.classList.remove("fa-eye-slash");
                eye.classList.add("fa-eye");
            } else {
                eye.classList.remove("fa-eye");
                eye.classList.add("fa-eye-slash");
            }
        }
        function toggleAddUser() {
            const element = document.getElementById("addUser");
            element.classList.toggle("visually-hidden");
        }

        function showUserEdit(user_id) {
            const to_show = document.getElementById("edit_user_" + user_id.toString());
            const to_highlight = document.getElementById("user_info_" + user_id.toString());

            to_show.classList.toggle("visually-hidden");
            to_highlight.classList.toggle("table-active");
        }
        function sendEdit(user_id) {
            const email = document.getElementById("email_edit_" + user_id.toString());
            const password = document.getElementById("pass_edit_" + user_id.toString());
            let route = "{{ route('update_user', ['id' => 'TO_SUB']) }}";
            route = route.replace("TO_SUB", user_id.toString());
            $.ajax({
                type: "PUT",
                contentType: "application/json; charset=utf-8",
                url: route,
                data: JSON.stringify({
                    email: email.value,
                    password: password.value
                }),
                success: function () {
                    alert("Updated successfully");
                },
                error: function (r) {
                    alert("Failed, message: " + r.toString());
                }
            });
        }
        function deleteUser(user_id) {
            let result = confirm("Are you sure you want to delete this user? (id: " + user_id.toString() + ")");

            if (!result) {
                return;
            }

            let route = "{{ route('delete_user', ['id' => 'TO_SUB']) }}";
            route = route.replace("TO_SUB", user_id.toString());

            $.ajax({
                type: "DELETE",
                contentType: "application/json; charset=utf-8",
                url: route,
                success: function () {
                    alert("Removed successfully");
                },
                error: function (r) {
                    alert("Failed, message: " + r.toString());
                }
            });
        }
    </script>
@stop

@section('title')
    Users control
@stop

@section('content')
    <div class="mt-5 container mx-auto">
        @if(!empty($message))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
        <div class="justify-content-between row ms-1">
            <button class="btn btn-sm btn-outline-secondary col-2" onclick="toggleAddUser()">Add user</button>
            <a href="{{ route('main') }}" class="col-1 my-auto"><i class="fas fa-sync-alt"></i></a>
        </div>
        <div class="visually-hidden mt-2" id="addUser">
            <form action="{{ route('insert_user', ['return' => true]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>E-mail
                        <input name="email" class="form-control" required />
                    </label>
                </div>
                <div class="form-group">
                    <label>Password
                        <input type="text" name="password" id="passField" class="form-control" required />
                    </label>
                    <div class="btn btn-sm btn" onclick="changePassVisibility()">
                        <i id="eye" class="far fa-eye-slash"></i>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <button class="btn btn-sm btn-outline-success" type="submit">Add</button>
                </div>
            </form>
        </div>
        @if(!$users)
            <p class="text-muted">No users yet</p>
        @else
            <div class="table-responsive">
                <table class="table table-hover mt-2">
                    <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>E-mail</th>
                        <th>Password</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr id="user_info_{{ $user->id }}">
                            <td>{{ $user->id }}</td>
                            <td>
                                <div class="to_hide_{{ $user->id }}">{{ $user->email }}</div>
                            </td>
                            <td>
                                <div class="to_hide_{{ $user->id }}">{{ str_repeat("*", strlen($user->password)) }}</div>
                            </td>
                            <td>
                                <a class="btn" onclick="showUserEdit({{ $user->id }})">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <a class="btn">
                                    <i class="fas fa-trash" onclick="deleteUser({{ $user->id }})"></i>
                                </a>
                            </td>
                        </tr>
                        <tr class="visually-hidden" id="edit_user_{{ $user->id }}">
                            <td></td>
                            <td>
                                <label>
                                    <input class="form-control" value="{{ $user->email }}" id="email_edit_{{ $user->id }}" />
                                </label>
                            </td>
                            <td>
                                <label>
                                    <input class="form-control" value="{{ $user->password }}" id="pass_edit_{{ $user->id }}" />
                                </label>
                            </td>
                            <td>
                                <a class="btn" onclick="showUserEdit({{ $user->id }})">
                                    <i class="fas fa-window-close"></i>
                                </a>
                            </td>
                            <td>
                                <a class="btn" onclick="sendEdit({{ $user->id }})">
                                    <i class="fas fa-check-square"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


        @endif
    </div>
@stop
