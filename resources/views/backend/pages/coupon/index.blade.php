@extends('backend.layouts.master')

@section('title')
    Coupon Index
@endsection
@push('admin_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .dataTables_length {
            padding: 20px 0;
        }
    </style>
@endpush
@section('admin.content')
    <div class="row">
        <h2>Coupon List</h2>
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                <a href="{{ route('coupon.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                    Add Coupon
                </a>
            </div>
        </div>

        <div class="col-md-12">
            <div class="table-responsive my-2">
                <table class="table table-bordered table-striped" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Last Modified</th>
                            <th>Coupon Name</th>
                            <th>Coupon discount (%)</th>
                            <th>Validity</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon)
                            <tr>
                                <th scope="row">{{ $coupons->firstItem() + $loop->index }}</th>
                                <td>{{ $coupon->updated_at->format('d M Y') }}</td>
                                <td>{{ $coupon->coupon_name }}</td>
                                <td>{{ $coupon->discount_amount }}</td>
                                <td>{{$coupon->validity_till}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Setting
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{route('coupon.edit',$coupon->id)}}"><i class="fa fa-edit"></i>Edit</a>
                                            </li>
                                            <li>
                                                <form action="{{route('coupon.destroy',$coupon->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item show_confirm"><i
                                                        class="fa fa-trash"></i>Delete</button>
                                                </form>

                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('admin_script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                pagingType: 'first_last_numbers'
            });

        });

        $('.show_confirm').click(function(event){
            let form = $(this).closest('form');
            event.preventDefault();
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })

        });
    </script>
@endpush
