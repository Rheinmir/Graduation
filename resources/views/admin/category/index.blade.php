@extends('master.admin')
@section('title', 'Category manager')
@section('main')

<form action="" method="POST" class="form-inline" role="form">

    <div class="form-group">
        <label class="sr-only" for="">label</label>
        <input type="email" class="form-control" id="" placeholder="Input field">
    </div>

    

    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
    <a href="{{ route('category.create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add new</a>
</form>


<br>


<table class="table table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Category Name</th>
            <th>Category Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Toyota</td>
            <td>Hiden</td>
            <td class="text-right">
                <a href="{{ route('category.edit', 1) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <tr>
            <td>1</td>
            <td>Toyota</td>
            <td>Hiden</td>
            <td class="text-right">
                <a href="{ route('category.edit', 1) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <tr>
            <td>1</td>
            <td>Toyota</td>
            <td>Hiden</td>
            <td class="text-right">
                <a href="{ route('category.edit', 1) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <tr>
            <td>1</td>
            <td>Toyota</td>
            <td>Hiden</td>
            <td class="text-right">
                <a href="{ route('category.edit', 1) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <tr>
            <td>1</td>
            <td>Toyota</td>
            <td>Hiden</td>
            <td class="text-right">
                <a href="{ route('category.edit', 1) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
    </tbody>
</table>


@stop()
