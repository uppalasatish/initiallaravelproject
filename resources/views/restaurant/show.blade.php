@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('global.restaurant.title') }}
                </div>
                <div class="panel-body">

                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('global.restaurant.fields.name') }}
                                </th>
                                <td>
                                    {{ $restaurant->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('global.restaurant.fields.code') }}
                                </th>
                                <td>
                                    {{ $restaurant->code }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('global.restaurant.fields.email') }}
                                </th>
                                <td>
                                    {{ $restaurant->email }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('global.restaurant.fields.phone_number') }}
                                </th>
                                <td>
                                    {{ $restaurant->number }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('global.restaurant.fields.desc') }}
                                </th>
                                <td>
                                    {{ $restaurant->desc }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('global.restaurant.fields.image') }}
                                </th>
                                <td>
                                    <img src="{{ asset('images/restaurant/'.$restaurant->image->image) }}" style="width: 160px; height: 160px;" class="img img-thumbnail img-profile"/>
                                </td>
                            </tr>
                           
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection