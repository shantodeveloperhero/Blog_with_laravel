                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['id'=>'name','class'=>'form-control', 'placeholder'=>'Enter Sub Category Name']) !!}
                {!! Form::label('slug', 'Slug', ['class'=>'mt-2']) !!}
                {!! Form::text('slug', null, ['id'=>'slug','class'=>'form-control', 'placeholder'=>'Enter Sub Category Slug']) !!}
                {!! Form::label('category_id', 'Select Category', ['class'=>'mt-2']) !!}
                {!! Form::select('category_id', $categories, null, ['class'=>'form-select', 'placeholder'=>'Select Category']) !!}
                {!! Form::label('order_by', 'Sub Category Serial', ['class'=>'mt-2']) !!}
                {!! Form::number('order_by', null, ['class'=>'form-control', 'placeholder'=>'Enter Sub Category Serial']) !!}
                {!! Form::label('status', 'Sub Category Status', ['class'=>'mt-2']) !!}
                {!! Form::select('status', [1=>'Active', 0 =>'Inactive'], null, ['class'=>'form-select', 'placeholder'=>'Select Sub Category Status']) !!}