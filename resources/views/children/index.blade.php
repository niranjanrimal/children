@extends('layouts.app')

@section('content')
@if(session('success'))
<div class="alert alert-success" id="success-message" role="alert">{{session('success')}}</div>
@endif

@if(session('successdelete'))
<div class="alert alert-danger" id="success-message" role="alert">{{session('successdelete')}}</div>
@endif

<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Manage <b>Children</b></h2>
                </div>
                <div class="col-sm-6">
                      <a href="#addchildrenModal" class="btn btn-success" data-toggle="modal" ><i class="material-icons">&#xE147;</i> <span>Add New children</span></a>			
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Actions</th>
                    <th>FirstName</th>
                    <th>MiddleName</th>
                    <th>LastName</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>ZipCode</th>
                    
                </tr>
            </thead>
            <tbody>
              @foreach($children as $child)
              <tr>

                
                <td>
                  <form id="delete-form-{{ $child->id }}" action="{{ route('children.destroy', $child) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm rounded-0 delete-btn" data-id="{{ $child->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                  </form>
                </td>
                  <td>{{$child->firstname}}</td>
                  <td @if($child->middlename == null) style="font-style: italic" @endif>{{ $child->middlename ?: 'null' }}</td>
                  <td>{{$child->lastname}}</td>
                  <td>{{$child->age}}</td>
                  <td>{{$child->gender}}</td>
                  <td @if($child->address === null) style="font-style: italic" @endif>{{ $child->address ?: 'null' }}</td>
                  <td @if($child->city === null) style="font-style: italic" @endif>{{ $child->city ?: 'null' }}</td>
                  <td @if($child->state === null) style="font-style: italic" @endif>{{ $child->state ?: 'null' }}</td>
                  <td @if($child->country === null) style="font-style: italic" @endif>{{ $child->country ?: 'null' }}</td>
                  <td @if($child->zipcode === null) style="font-style: italic" @endif>{{ $child->zipcode ?: 'null' }}</td>
              </tr>
          @endforeach
            </tbody>
        </table>
     
    </div>
</div>

<div>
  {{$children->links()}}
</div>

<div id="addchildrenModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="myForm" action="{{route('children.store')}}">
              @csrf
                <div class="modal-header">						
                    <h4 class="modal-title">Add Children</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
                    <div class="form-group">
                        <label>FirstName <label class="text-danger">*</label>
                      </label>
                        <input type="text" class="form-control @error('firstname') is-invalid @enderror " id="firstname" name="firstname" value="{{old('firstname')}}">

                        <div class="invalid-feedback">
                          @error('firstname')
                          {{$message}}
                          @enderror
                    </div>

                    <div class="form-group">
                        <label>MiddleName</label>
                        <input type="text" class="form-control " name="middlename" >
                        <div class="invalid-feedback">
                      
                    </div>

                    <div class="form-group">
                        <label>LastName <label for="name" class="text-danger">*</label></label>
                        <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{old('lastname')}}" >
                        <div class="invalid-feedback">
                          @error('lastname')
                          {{$message}}
                          @enderror
                    </div>

                    <div class="form-group">
                        <label>Age <label for="name" class="text-danger">*</label></label>
                        <input type="text" class="form-control @error('age') is-invalid @enderror" name="age" >
                        <div class="invalid-feedback">
                          @error('age')
                          {{$message}}
                          @enderror
                    </div>

                    <div class="form-group">
                        <label>Gender <label for="name" class="text-danger">*</label></label>
                        <select class="form-control @error('gender') is-invalid @enderror" name="gender" >
                          <option value="">Choose a gender</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                          <option value="other">Other</option>
                        </select>

                        <div class="invalid-feedback">
                        @error('gender')
                          {{$message}}
                          @enderror

                        </div>
                      <div class="form-group">
                        <label>
                          <input type="checkbox" id="enable-address">
                          Different Address
                        </label>
                      </div>

                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" disabled readonly>
                        <div class="invalid-feedback">
                          @error('address')
                          {{$message}}
                          @enderror
                      </div>

                      <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" disabled readonly>
                        <div class="invalid-feedback">
                          @error('city')
                          {{$message}}
                          @enderror
                      </div>
                      
                      <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" name="state" disabled readonly >
                        <div class="invalid-feedback">
                          @error('state')
                          {{$message}}
                          @enderror
                      </div>
                      
                      <div class="form-group">
                        <label>Country</label>
                        <select class="form-control" id="country" name="country" disabled readonly>
                          <option value="">Select a Country</option>
                          @foreach(\App\Models\Country::pluck('name','name') as  $name=>$name)   
                           <option value="{{ $name }}">{{ $name }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Zipcode</label>
                        <input type="text" class="form-control @error('zipcode') is-invalid @enderror" id="zipcode" name="zipcode" disabled readonly value="{{old('zipcode')}}">

                        <div class="invalid-feedback">
                          @error('zipcode')
                          {{$message}}
                          @enderror
                        </div>
  
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{asset('js/script.js')}}"></script>
@endsection 



