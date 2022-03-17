@extends('layouts.admin')
@section('content')
<div class="content">
    @can('user_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.restaurant.create") }}">
                    {{ trans('global.add') }} {{ trans('global.restaurant.title') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.restaurant.title') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('global.restaurant.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('global.restaurant.fields.code') }}
                                    </th>
                                    <th>
                                        {{ trans('global.restaurant.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('global.restaurant.fields.phone_number') }}
                                    </th>
                                    <th>
                                        {{ trans('global.restaurant.fields.image') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                              	@foreach($restaurants as $key => $restaurant)
                                    <tr id="item_{{ $restaurant->id }}" data-entry-id="{{ $restaurant->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $restaurant->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $restaurant->code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $restaurant->email ?? '' }}
                                        </td>
                                        <td>
                                           {{ $restaurant->number ?? '' }}
                                        </td>
                                        <td>
                                        	<div style="display: inline-block; vertical-align: top;">
		                                        <img src="@if($restaurant->image->image){{ asset('images/restaurant'.'/'.$restaurant->image->image)}}@else{{ asset('image/default-avatar.jpg') }}@endif" width="40" height="40" class="img-circle" alt="{{ $restaurant->name }}" class="img-responsive img-thumbnail" title="{{ $restaurant->name }}" />
		                                	</div>
                                        </td>
                                        <td>
                                            @can('user_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.restaurant.show', $restaurant->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan
                                            @can('user_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.restaurant.edit', $restaurant->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan
                                            @can('user_delete')
                                                <a class="btn btn-xs btn-danger deleteItem" href="#" data-id="{{ $restaurant->id }}">
                                                    {{ trans('global.delete') }}
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@parent
<script>
  	$('.content').on('click','.deleteItem', function(){
        var itemId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this item!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
            	$.ajax({
                    url: '{{ route('admin.restaurant.delete') }}',
                    type: 'POST',
                    data: {_token:'{{ csrf_token() }}', item_id:itemId},
                    success: function (response){
                      $('#item_'+itemId).remove();
                    },
                    error: function (error){
                        console.log(error);
                    }
                });
               
            }
        });
    });
</script>
@endsection