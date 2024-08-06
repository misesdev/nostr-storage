@extends('layouts/app')

@section('styles')
    {{-- <link rel="stylesheet" href="{{ asset("/css/account.css") }}" /> --}}
@endsection

@section('content')
    <main>
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">My Account</h1>
            {{-- <a href="#" target="_blank"
                class="btn-primary px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">
                View on github
            </a> --}}
        </div>

        @if(session('message'))
            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
        @endif

        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach
        @endif

        <div class="container-xl px-4 mt-4">
            <!-- Account page navigation-->
            <nav class="nav nav-borders">
                <a class="nav-link active ms-0" href="#" target="__blank">Profile</a>
                <a class="nav-link" href="#" target="__blank">Security</a>
                {{-- <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-edit-notifications-page"
                    target="__blank">Notifications</a> --}}
            </nav>
            <hr class="mt-0 mb-4">

            <div class="row">

                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2" style="margin: auto;" src="/{{ auth()->user()->profile ?? 'profiles/default.jpg' }}" alt="">
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <!-- Profile picture upload button-->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#upload-modal" type="button">
                                Upload new image
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <form method="post" action="/user/update" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">Account Details</div>
                            <div class="card-body">
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="name">User Name</label>
                                        <input maxlength="50" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="name" name="name" type="text" placeholder="Enter your last name" value="{{ $user->name }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputFirstName">E-mail</label>
                                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="email" name="email" type="text" placeholder="" value="{{ $user->email }}">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary" style="float: right;margin: 10px 0px;" type="button">
                                    Save changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="upload-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form class="form" method="post" action="/user/update-profile" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="file_input">Upload file</label>
                                    <input id="archive" name="archive" type="file" required
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                </div>                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    </main>
@endsection
