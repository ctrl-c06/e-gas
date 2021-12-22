@extends('layouts.app')
@section('title', 'List of Administrator')
@section('content')
<div class="d-flex justify-content-between w-100 flex-wrap my-3">
    <div class="mb-3 mb-lg-0">
        <h1 class="h4">Administrators</h1>
    </div>
    <div>
        <a href="{{ route('admin.create') }}" class="btn btn-outline-gray-600 d-inline-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-person-plus-fill mx-1" viewBox="0 0 16 16">
                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                <path fill-rule="evenodd"
                    d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
            </svg>
            Add new administrator
        </a>
    </div>
</div>
<div class="card border-0 shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0 rounded">
                <thead class="thead-light">
                    <tr>
                        <th class="border-0 rounded-start align-middle">ID</th>
                        <th class="border-0 align-middle">Username</th>
                        <th class="border-0 align-middle">Firstname</th>
                        <th class="border-0 align-middle">Middlename</th>
                        <th class="border-0 align-middle">Lastname</th>
                        <th class="border-0 text-center align-middle">Created At</th>
                        <th class="border-0 rounded-end text-center align-middle">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="border-0 fw-bold align-middle">{{ $user->id }}</td>
                        <td class="border-0 fw-bold align-middle">{{ $user->username }}</td>
                        <td class="border-0 fw-bold align-middle">{{ $user->firstname }}</td>
                        <td class="border-0 fw-bold align-middle">{{ $user->middlename }}</td>
                        <td class="border-0 fw-bold align-middle">{{ $user->lastname }}</td>
                        <td class="border-0 fw-bold text-center align-middle">
                            {{ $user->created_at->format('F d, Y h:i A') }}</td>
                        <td class="border-0 fw-bold text-center">
                            <a class="btn btn-icon-only btn-success text-white d-inline-flex align-items-center shadow"
                                href="{{ route('admin.edit', $user->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                </svg>
                            </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
