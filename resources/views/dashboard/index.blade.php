@extends('layouts/app')

@section('styles')
    @include('components.assets.dt-css')
@endsection

@section('content')
    <main>
        <div class="flex items-center justify-between px-2 py-2 lg:py-2">
            <h1 class="text-2xl font-semibold">Dashboard</h1>
            <a href="https://github.com/emptioapp/nostr-storage" target="_blank" class="ui primary button">
                Github Projetc
            </a>
        </div>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach
        @endif

        <div class="flex flex-wrap mt-12">
            <div class="w-full lg:w-1/2 pr-0 lg:pr-2">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-plus mr-3"></i> Last 7 Days
                </p>
                <div class="p-6 bg-white">
                    <canvas id="chartOne" width="400" height="200"></canvas>
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
                                        style="max-width:100px;max-height:75px;border-radius:10px;" />
                                </td>
                                <td>
                                    <div class="ui action input" style="width: 90%">
                                        <input type="text" value="{{ url('/') }}/{{ $file->archive }}" disabled>
                                        <button class="ui teal right labeled icon button" onclick="methods.copy(this)">
                                            <i class="copy icon"></i>
                                            Copy
                                        </button>
                                    </div>
                                </td>
                                <td class="">{{ $file->created_at }}</td>
                                <td class="">
                                    <a href="#" onclick='methods.delete(this, {{ $file->id }})'>
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if (empty($file_list))
                    <div class="py-4 px-6 bg-grey-ligh font-bold uppercase text-sm text-grey-dark text-center">
                        No Results
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
    @include('components.assets.dt-js')
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
            },
            responseve: true,
            maintainAspectRatio: false
        });

        const methods = {
            table: null,
            copy: (event) => {
                let link = $(event).parent().children('input').val()

                console.log(link)
                $.toast({
                    class : 'success',
                    message: 'Link copied to clipboard!',
                    showProgress: 'top'
                })
            },
            delete: (event, id) => {
                $.toast({
                    position: 'bottom right',
                    message: 'Do you really want to delete this file?',
                    displayTime: 5000,
                    class: 'white',
                    classActions: 'top attached',
                    showProgress: 'bottom',
                    actions: [{
                        text: 'Yes, delete',
                        class: 'green',
                        click: function() {
                            $(event).parent().parent().remove();
                            $.toast({message:'Deleted file from storage blob!'});
                        }
                    },{
                        text: 'No',
                        class: 'gray',
                        click: function() {  }
                    }]
                })
            },
            init: () => {
                methods.table = new DataTable("#table-file", {
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
            }
        }

        $(document).ready(methods.init)
    </script>
@endsection
