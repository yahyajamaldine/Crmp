@extends('adminlte::page')

@section('title', 'All Projects')

@section('content_header')
    <h1>All Projects</h1>
@stop

@section('content')
    <div class="card px-3 py-2">
        @can('project_create')
        <div class="my-3">
            <a class="btn btn-success text-uppercase float-right" href="{{ route('projects.create') }}">
                <i class="fas fa-plus fa-fw"></i>
                <span class="big-btn-text">Add New Project</span>
            </a>
        </div>
        @endcan
        <input type="text" id="searchBox" placeholder="🔍 Search the table below">
        <br>

        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-uppercase" scope="col">#</th>
                        <th class="text-uppercase" scope="col">Name</th>
                        <th class="text-uppercase" scope="col">Details</th>
                        <th class="text-uppercase" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->details }}</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
                                    ACTIONS
                                </a>
                                <div id="{{ $project->id }}" class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    @can('project_show')
                                    <a class="dropdown-item text-primary"
                                        href="{{ route('projects.show', ['id' => $project->id]) }}">View</a>
                                    @endcan
                                    @can('project_edit')
                                    <a class="dropdown-item text-primary"
                                        href="{{ route('projects.edit', ['id' => $project->id]) }}">Edit</a>
                                    @endcan
                                    @can('project_delete')
                                    <div class="dropdown-divider"></div>
                                    @if(!$project->is_active)
                                        <a role="button" class="entry-delete-btn dropdown-item text-danger" style="">
                                            Delete This project
                                        </a>
                                    @endif
                                    @endcan
                                </div>
                            </div>
                        </td>
                    </tr>
                    <input type="hidden" id="deleteUrl{{ $project->id }}" value="{{ route('projects.destroy', ['id' => $project->id]) }}">
                    @endforeach
                    {{-- Required for mark delete action --}}
                    <input type="hidden" id="deletedBtnText" value="Yes, delete it!">
                    <input type="hidden" id="deletedTitle" value="Deleted!">
                    <input type="hidden" id="deletedMsg" value="Your request has been successfully completed.">

                </tbody>
            </table>
            @if (count($projects) < 1)
                <div class="px-4 py-5 mx-auto text-secondary">
                    No results found!
                </div>
            @endif
        </div>

        {{-- Pagination links --}}
        <div class="mt-4">
            {{ $projects->links() }}
        </div>

    </div>
@stop

@section('css')
@stop

@section('js')
    <script src="{{ asset('js/table_utils.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/delete_entry.js') }}"></script>
@stop
