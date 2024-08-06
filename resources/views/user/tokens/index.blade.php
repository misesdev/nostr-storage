@extends('layouts/app')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.semanticui.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css" />
@endsection

@section('content')
    <main>

        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">My Tokens</h1>
            <a href="#" data-toggle="modal" data-target="#create-modal" class="ui primary button">
                Create
            </a>
        </div>
        @if (session('token'))
            <div class="alert alert-success" role="alert"> Please copy and save the token, it will not be displayed again:
                '{{ session('token') }}'</div>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach
        @endif

        <div class="w-full mt-12">
            <div class="bg-white overflow-auto" style="padding: 10px;">
                <table id="table-tokens" class="ui table text-left w-full border-collapse">
                    <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                    <thead>
                        <tr>
                            <th class="uppercase"> Name</th>
                            <th class="uppercase">directory</th>
                            <th class="uppercase">Abilities</th>
                            <th class="uppercase">Expires In</th>
                            <th class="uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tokens as $token)
                            <tr>
                                <td>{{ $token->name }}</td>
                                <td>storage/{{ $token->token }}/</td>
                                <td>{{ implode(', ', $token->abilities) }}</td>
                                <td>{{ $token->expires_at }}</td>
                                <td>
                                    <a href="/tokens/delete/{{ $token->id }}">
                                        <i class="fa fa-trash"></i>
                                        </id>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($tokens->isEmpty())
                    <div class="py-4 px-6 bg-grey-ligh font-bold uppercase text-sm text-grey-dark text-center">No Results
                    </div>
                @endif

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Token
                                    Name</label>
                                <div class="mt-2">
                                    <input id="name" name="name" type="text" maxlength="50" autocomplete="email"
                                        required
                                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="expires" class="block text-sm font-medium leading-6 text-gray-900">Expires
                                    In</label>
                                <div class="mt-2">
                                    <input id="expires" name="expires" type="datetime-local" autocomplete="date" required
                                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
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

@section('scripts')
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.semanticui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js"></script>
    <script>
        $(document).ready(() => {
            new DataTable("#table-tokens", {
                info: false,
                searchable: false,
                layout: {
                    bottomEnd: {
                        paging: {
                            firstLast: false
                        }
                    }
                }
            })
        })
    </script>
@endsection
