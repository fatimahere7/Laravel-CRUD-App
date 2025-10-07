@extends('students.layout')
@section('content')

<div class="container mt-5">
    <div class="container mt-6">
        <div class="card">
            <div class="card-body" id="main">
                <h1 class="display-one mt-5 text-center">PHP Laravel Project - CRUD</h1>
                <p class="text-center">Welcome to the PHP Laravel project demo </p>
                <br>
                <div class="text-center">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                        Add New
                    </button>
                </div>
                <br><br>

                <!-- Create Modal -->
              <!-- Create Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" @if($errors->any()) style="display: block;" @endif>
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><b>Add New Student</b></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <form id="addStudentForm" action="{{ url('student') }}" method="post" enctype="multipart/form-data">
                                  @csrf
              
                                  <!-- Display validation errors -->
                                  {{-- @if ($errors->any())
                                      <div class="alert alert-danger">
                                          <ul>
                                              @foreach ($errors->all() as $error)
                                                  <li>{{ $error }}</li>
                                              @endforeach
                                          </ul>
                                      </div>
                                  @endif
               --}}
                                  <div class="form-group">
                                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Full Name" value="{{ old('name') }}">
                                      <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                                      <br>
              
                                      <input type="text" class="form-control @error('adress') is-invalid @enderror" id="adress" name="adress" placeholder="Address" value="{{ old('adress') }}">
                                      <span class="text-danger">@error('adress') {{ $message }} @enderror</span>
                                      <br>
              
                                      <input type="number" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" placeholder="Mobile Number" value="{{ old('mobile') }}">
                                      <span class="text-danger">@error('mobile') {{ $message }} @enderror</span>
                                      <br>
              
                                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                      <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                                      <br>
              
                                      <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                      <span class="text-danger">@error('image') {{ $message }} @enderror</span>
                                  </div>
              
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary">Save</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>

                <!-- End of Create Modal -->

                <!-- Table View -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" style="text-align: center; width: 5%">#</th>
                                <th scope="col" style="text-align: center; width: 15%;">Name</th>
                                <th scope="col" style="text-align: center; width: 15%;">Picture</th>
                                <th scope="col" style="text-align: center; width: 15%;">Address</th>
                                <th scope="col" style="text-align: center; width: 15%;">Mobile Number</th>
                                <th scope="col" style="text-align: center">Email</th>
                                <th scope="col" style="text-align: center;width: 70%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="Student Image" class="img-thumbnail" style="max-width: 80px;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $item->adress }}</td>
                                <td>{{ $item->mobile }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewModal-{{ $item->id }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                    </button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal-{{ $item->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ url('student/' . $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Confirm Delete?')">
                                            <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End of Table View -->

                <!-- View Modal -->
                @foreach ($students as $item)
                <div class="modal fade" id="viewModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel-{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewModalLabel-{{ $item->id }}"><b>View Student</b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5 class="card-title">Name: {{ $item->name }}</h5>
                                <p class="card-text">Address: {{ $item->adress }}</p>
                                <p class="card-text">Mobile: {{ $item->mobile }}</p>
                                <p class="card-text">Email: {{ $item->email }}</p>
                                @if($item->image)
                                    <p class="card-text">Image:</p>
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="Student Image" class="img-fluid" style="max-width: 150px;">
                                @else
                                    <p class="card-text">No image available.</p>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- End of View Modal -->

                <!-- Edit Modal -->
                @foreach ($students as $item)
                <div class="modal fade" id="editModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel-{{ $item->id }}"><b>Edit Student</b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ url('student/' . $item->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}">
                                        <br>
                                        <input type="text" class="form-control" id="adress" name="adress" value="{{ $item->adress }}">
                                        <br>
                                        <input type="number" class="form-control" id="mobile" name="mobile" value="{{ $item->mobile }}">
                                        <br>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $item->email }}">
                                        <br>
                                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                        <br>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- End of Edit Modal -->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // If there are validation errors, open the modal
        @if($errors->any())
            $('#exampleModal').modal('show');
        @endif

        // Prevent form submission if there are errors
        $('#addStudentForm').on('submit', function(e) {
        //     var hasError = false;

        //     // Check each field for errors
        //     $(this).find('input').each(function() {
        //         if ($(this).hasClass('is-invalid') || !$(this).val()) {
        //             hasError = true;
        //         }
        //     });

            // if (hasError) {
                // e.preventDefault(); // Prevent the form from submitting
            //     $('#exampleModal').modal('show'); // Show the modal
            
        });
    });
</script>

@stop
