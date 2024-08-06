@extends('layouts/app')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.semanticui.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css" />
@endsection

@section('content')
    <main>
        <div class="flex items-center justify-between px-2 py-2 lg:py-2">
            <h1 class="text-2xl font-semibold">Dashboard</h1>
            <a href="https://github.com/emptioapp/nostr-storage" target="_blank"
                class="btn-primary px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">
                Github Projetc
            </a>
        </div>

        <div class="flex flex-wrap mt-12">
            <div class="w-full lg:w-1/1 pr-0 lg:pr-2">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-plus mr-3"></i> Last 7 Days
                </p>
                <div class="p-6 bg-white">
                    <canvas id="chartOne" width="350" height="200"></canvas>
                </div>
            </div>
        </div>

        <div class="w-full mt-12">
            <div class="bg-white overflow-auto" style="padding: 10px;">
                <table id="table-file" class="ui table text-left w-full border-collapse">
                    <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                    <thead>
                        <tr>
                            <th class="uppercase">archive</th>
                            <th class="uppercase">file url</th>
                            <th class="uppercase">upload date</th>
                            <th class="uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($file_list as $file)
                            <tr class="">
                                <td class="">
                                    <img src="/{{ $file->archive }}" class="image-table"
                                        style="max-width: 100px;max-height: 75px;" />
                                </td>
                                <td>{{ url('/') }}/{{ $file->archive }}</td>
                                <td class="">{{ $file->created_at }}</td>
                                <td class="">
                                    <a href="/file/delete/{{ $file->id }}">
                                        <i class="fa fa-trash"></i>
                                        </id>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if (empty($file_list))
                    <div class="py-4 px-6 bg-grey-ligh font-bold uppercase text-sm text-grey-dark text-center">No Results
                    </div>
                @endif

            </div>
        </div>

        <br />
        <br />
        <br />
        <br />
        <br />
    </main>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.semanticui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js"></script>
    <script>
        let metrics = @php echo json_encode($metrics) @endphp

        var chartOne = document.getElementById('chartOne');
        var myChart = new Chart(chartOne, {
            type: 'bar',
            data: {
                labels: metrics.map(m => m.month),
                datasets: [{
                    label: 'Uploads',
                    data: metrics.map(m => m.quantity),
                    backgroundColor: metrics.map(m => 'rgba(54, 162, 235, 0.4)'),
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        $(document).ready(() => {
            new DataTable("#table-file", {
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
