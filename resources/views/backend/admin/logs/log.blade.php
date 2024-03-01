@extends('backend.layouts.app')
@section('title','Logs')
@section('content')
<div class="row">
    <div class="col-lg-6 my-auto">
        <h3 class="page-title">{{ __('All System Logs') }}</h3>
    </div>
    <div class="col-lg-6 mt-3 mt-lg-0">
        <div class="flex-mode gap-2  justify-content-lg-end">
            @if($current_file)
            <a class="btn btn-secondary flex-mode"    href="?dl={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                <span id="view-symbol" class="material-symbols-outlined ">
                    download
                </span>
            </a>
            <a id="clean-log" class="btn btn-green flex-mode gap-2"
            href="?clean={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                <span class="material-symbols-outlined">
                    cleaning_services
                </span>
            </a>
            <a id="delete-log" href="?del={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}"
            class="btn btn-theme flex-mode">
            <span class="material-symbols-outlined">
                delete
            </span>
                </a>
            @if(count($files) > 1)
            <a class="btn btn-theme flex-mode gap-2" id="delete-all-log"
            href="?delall=true{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                <span class="material-symbols-outlined">
                    delete
                </span>
            </a>
            @endif
            @endif
        </div>
    </div>
    <div class="col-12 mt-3 tables">
        @if ($logs === null)
        <div>
            Log file >50M, please download it.
        </div>
        @else
        <div class="table-responsive table-nowrap d-box p-0 border-radius-0 animated zoomIn">
            <table id="table-log" class="table" data-ordering-index="{{ $standardFormat ? 2 : 0 }}">
                <thead class="sticky-top">
                    <tr>
                        @if ($standardFormat)
                        <th>Level</th>
                        <th>Context</th>
                        <th>Date</th>
                        @else
                        <th>Line number</th>
                        @endif
                        <th>Content</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($logs as $key => $log)
                    <tr data-display="stack{{{$key}}}">
                        @if ($standardFormat)
                        <td class="nowrap text-center text-{{{$log['level_class']}}}">
                            <span class="fa fa-{{{$log['level_img']}}}"
                                aria-hidden="true"></span> <br>
                            {{$log['level']}}
                        </td>
                        <td class="text">{{$log['context']}}</td>
                        @endif
                        <td class="date">{{{$log['date']}}}</td>
                        <td class="text">
                            {{-- @if ($log['stack'])
                            <button type="button" class="float-right expand btn btn-outline-dark btn-sm mb-2 ml-2"
                                data-display="stack{{{$key}}}">
                                <span class="fa fa-search"></span>
                            </button>
                            @endif --}}
                             {{{$log['text']}}}
                            @if (isset($log['in_file']))
                            <br />{{{$log['in_file']}}}
                            @endif
                            @if ($log['stack'])
                            <div class="stack" id="stack{{{$key}}}" style="display: none; white-space: pre-wrap;">{{{
                                trim($log['stack']) }}}
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
            @endif
        </div>

    </div>
    @endsection
