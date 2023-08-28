                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title', null, ['id'=>'title','class'=>'form-control', 'placeholder'=>'Enter Post Title']) !!}
                    {!! Form::label('slug', 'Slug', ['class'=>'mt-2']) !!}
                    {!! Form::text('slug', null, ['id'=>'slug','class'=>'form-control', 'placeholder'=>'Enter Post Slug']) !!}
                    
                    
                   
                    {!! Form::label('is_approved', 'Post status', ['class'=>'mt-2']) !!}
                    {!! Form::select('is_approved', [ 0 =>'active'], null, ['class'=>'form-select', 'placeholder'=>'Select Post Status']) !!}
                   <div class="row">
                    <div class="col-md-6">
                      {!! Form::label('category_id', 'Select Category', ['class'=>'mt-2']) !!}
                      {!! Form::select('category_id', $categories, null, ['id'=>'category_id','class'=>'form-select', 'placeholder'=>'Select Category']) !!}
                    </div>
                    <div class="col-md-6">
                      {!! Form::label('sub_category_id', 'Select Sub Category', ['class'=>'mt-2']) !!}
                      <select name="sub_category_id" id="sub_category_id" class="form-select">
                        <option selected="selected">Select Sub Category</option>
                      </select>
                    
                    
                    
                    </div>
                   </div>

                   {!! Form::label('description', 'Description', ['class'=>'mt-2']) !!}
                   {!! Form::textarea('description', null, ['id'=>'description', 'class'=>'form-control', 'placeholder'=>'Enter Description']) !!}

                   {!! Form::label('tag', 'Select Tag', ['class'=>'mt-2']) !!}
                   <br/>
                   <div class="row">
                   @foreach ($tags as $tag)
                   <div class="col-md-3">
                    {!! Form::checkbox('tag_ids[]', $tag->id, Route::currentRouteName() == 'post.edit' ? in_array($tag->id, $selected_tags) : false ) !!} <span>{{ $tag->name }}</span>
                   </div>
                   @endforeach
                  </div>
                   
                  {!! Form::label('photo', 'Select Photo', ['class'=>'mt-2']) !!}
                  {!! Form::file('photo', ['class'=>'form-control']) !!}
                   
                  @if (Route::currentRouteName() == 'post.edit')
                  <div class="my-3">
                    <img class="img-thumbnail post_image" data-src="{{ url('image/post/original/'.$post->photo) }}" src="{{ url('image/post/thumbnail/'.$post->photo) }}" alt="{{ $post->title }}">
                  </div>
                  @endif
                  
                 {{--   {!! Form::label('UserId', 'UserId', ['class'=>'mt-2']) !!}
                    {!! Form::input('user_id', auth()->user()->id, ['class'=>'form-control', 'placeholder'=>'Select UserId Status']) !!} --}}


                   

                   @push('css')
    <style>
      .ck.ck-editor__main>.ck-editor__editable{
        min-height: 250px;
      }
    </style>
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js" integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>

  <script>
    const get_sub_categories = (category_id) => {
        let route_name = '{{ Route::currentRouteName() }}'   
        let sub_category_element = $('#sub_category_id')
        sub_category_element.empty()
        let sub_category_select = ''
        if (route_name != 'post.edit'){
           sub_category_select = 'selected'
        }
        
        sub_category_element.append(`<option ${sub_category_select}>Select Sub Category</option>`)
        axios.get(window.location.origin+'/dashboard/get-subcategory/'+category_id).then(res=>{
          let sub_categories = res.data
          sub_categories.map((sub_category, index) => {
            let selected = ''
            if(route_name == 'post.edit'){
                let sub_category_id = '{{ $post->sub_category_id ?? null }}'
                if( sub_category_id == sub_category.id){
             selected = 'selected'
                    }
                }
           
           sub_category_element.append(`<option ${selected} value="${sub_category.id}"> ${sub_category.name} </option>`)
           })
        })
      }
      ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );
    
    $('#category_id').on('change', function(){
        let category_id = $('#category_id').val()
      get_sub_categories(category_id)
    })
  </script>
@endpush

  @push('js')
  <script>
    $('#title').on('input', function(){
        let name= $(this).val()
        let slug = name.replaceAll(' ', '-')
        $('#slug').val(slug.toLowerCase());
    })
</script>
@if (Route::currentRouteName() == 'post.edit')
  <script>
    get_sub_categories('{{ $post->category_id }}')
    </script>  
@endif
  @endpush