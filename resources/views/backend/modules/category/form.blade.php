                
                
                
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['id'=>'name','class'=>'form-control', 'placeholder'=>'Enter Category Name']) !!}
                {!! Form::label('slug', 'Slug', ['class'=>'mt-2']) !!}
                {!! Form::text('slug', null, ['id'=>'slug','class'=>'form-control', 'placeholder'=>'Enter Category Slug']) !!}
                {!! Form::label('order_by', 'Category Serial', ['class'=>'mt-2']) !!}
                {!! Form::number('order_by', null, ['class'=>'form-control', 'placeholder'=>'Enter Category Serial']) !!}
                {!! Form::label('status', 'Category Status', ['class'=>'mt-2']) !!}
                {!! Form::select('status', [1=>'Active', 0 =>'Inactive'], null, ['class'=>'form-select', 'placeholder'=>'Select Category Status']) !!}