@extends('backend.layouts.main') 
@section('title', 'Debt Logic')
@section('content')
@php
/**
 * Debt Logic 
 *
 * @category  zStarter
 *
 * @ref  zCURD
 * @author    Defenzelite <hq@defenzelite.com>
 * @license  https://www.defenzelite.com Defenzelite Private Limited
 * @version  <zStarter: 1.1.0>
 * @link        https://www.defenzelite.com
 */
$breadcrumb_arr = [
    ['name'=>'Add Debt Logic', 'url'=> "javascript:void(0);", 'class' => '']
]
@endphp
    <!-- push external head elements to head -->
    @push('head')
    <link rel="stylesheet" href="{{ asset('backend/plugins/mohithg-switchery/dist/switchery.min.css') }}">
    <style>
        .error{
            color:red;
        }
    </style>
    @endpush

    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>Add Debt Logic</h5>
                            <span>Create a record for Debt Logic</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('backend.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <!-- start message area-->
               @include('backend.include.message')
                <!-- end message area-->
                <div class="card ">
                    <div class="card-header">
                        <h3>Create Debt Logic</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('panel.debt_logics.store') }}" method="post" enctype="multipart/form-data" id="DebtLogicForm">
                            @csrf
                            <div class="row">
                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('institutions') ? 'has-error' : ''}}">
                                        <label for="institutions" class="control-label">Institutions<span class="text-danger">*</span> </label>
                                        <input required  class="form-control" name="institutions" type="text" id="institutions" value="{{old('institutions')}}" placeholder="Enter Institutions" >
                                    </div>
                                </div>
                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('type_of_bank') ? 'has-error' : ''}}">
                                        <label for="type_of_bank" class="control-label">Type Of Bank<span class="text-danger">*</span> </label>
                                        <input required  class="form-control" name="type_of_bank" type="text" id="type_of_bank" value="{{old('type_of_bank')}}" placeholder="Enter Type Of Bank" >
                                    </div>
                                </div>
                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('rate') ? 'has-error' : ''}}">
                                        <label for="rate" class="control-label">Rate<span class="text-danger">*</span> </label>
                                        <input required  class="form-control" name="rate" type="" id="rate" value="{{old('rate')}}" placeholder="Enter Rate" >
                                    </div>
                                </div>
                                                                                            
                                <div class="col-md-6 col-12"> 
                                    <div class="form-group {{ $errors->has('period') ? 'has-error' : ''}}">
                                        <label for="period" class="control-label">Period<span class="text-danger">*</span> </label>
                                        <input required  class="form-control" name="period" type="" id="period" value="{{old('period')}}" placeholder="Enter Period" >
                                    </div>
                                </div>
                                                            
                                <div class="col-md-12 ml-auto">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="{{asset('backend/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
    <script src="{{asset('backend/js/form-advanced.js') }}"></script>
    <script>
        $('#DebtLogicForm').validate();
                                                                                        
    </script>
    @endpush
@endsection
