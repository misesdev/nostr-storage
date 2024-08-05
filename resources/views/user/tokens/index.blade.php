@extends('layouts/app')

@section('content')
    <main>

        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">My Tokens</h1>
            <a href="#" data-toggle="modal" data-target="#create-modal" class="btn-primary px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">
                Create
            </a>
        </div>
        @if(session('token'))
            <div class="alert alert-success" role="alert"> Please copy and save the token, it will not be displayed again: '{{ session('token') }}'</div>
        @endif

        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach
        @endif

        <div class="w-full mt-12">
            <div class="bg-white overflow-auto">
                <table class="text-left w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                    <thead>
                        <tr>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Name</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">directory</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Abilities</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Expires In</th>
                            <th class="py-4 px-2 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tokens as $token)

                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">{{ $token->name }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">storage/{{ $token->token }}/</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ implode(', ',$token->abilities) }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $token->expires_at }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    <a href="/tokens/delete/{{ $token->id }}" >
                                        <i class="fa fa-trash"></i>
                                    </id>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>

                @if($tokens->isEmpty())
                    <div class="py-4 px-6 bg-grey-ligh font-bold uppercase text-sm text-grey-dark text-center">No Results</div>
                @endif

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form" method="post" action="/tokens/create">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create a Token</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Token Name</label>
                                <div class="mt-2">
                                    <input id="name" name="name" type="text" maxlength="50" autocomplete="email" required class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="expires" class="block text-sm font-medium leading-6 text-gray-900">Expires In</label>
                                <div class="mt-2">
                                    <input id="expires" name="expires" type="datetime-local" autocomplete="date" required class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                                </div>
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


