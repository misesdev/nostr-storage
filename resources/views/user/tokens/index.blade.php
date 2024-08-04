@extends('layouts/app')

@section('content')
    <main>

        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">My Tokens</h1>
            <a href="#" class="btn-primary px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">
                Create
            </a>
        </div>

        <div class="w-full mt-12">
            <div class="bg-white overflow-auto">
                <table class="text-left w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                    <thead>
                        <tr>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Name</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Last Name</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Phone</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light">Lian</td>
                            <td class="py-4 px-6 border-b border-grey-light">Smith</td>
                            <td class="py-4 px-6 border-b border-grey-light">622322662</td>
                            <td class="py-4 px-6 border-b border-grey-light">jonsmith@mail.com</td>
                        </tr>
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light">Lian</td>
                            <td class="py-4 px-6 border-b border-grey-light">Smith</td>
                            <td class="py-4 px-6 border-b border-grey-light">622322662</td>
                            <td class="py-4 px-6 border-b border-grey-light">jonsmith@mail.com</td>
                        </tr>
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light">Lian</td>
                            <td class="py-4 px-6 border-b border-grey-light">Smith</td>
                            <td class="py-4 px-6 border-b border-grey-light">622322662</td>
                            <td class="py-4 px-6 border-b border-grey-light">jonsmith@mail.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
@endsection


