{!! Form::label('name', 'Name') !!}
{!! Form::text('name', null, ['id'=>'name','class'=>'form-control', 'placeholder'=>'Enter Role Name']) !!}
<div class="row">
    <div class="col-lg-4">
        <label for="">Posts Permission</label>
        @foreach ($permissions as $permission)
        @if ($permission->for == 'post')
        <div class="checkbox">
         <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}"
            @foreach ($role->permissions as $role_permit)
                @if ($role_permit->id == $permission->id)
                
                checked
                    
                @endif
            @endforeach
            >{{ $permission->name }}</label>
         
        </div>
          
        @endif
          
        @endforeach
        
    </div>
    <div class="col-lg-4">
     <label for="">User Permission</label>
     @foreach ($permissions as $permission)
        @if ($permission->for == 'user')
        <div class="checkbox">
         <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}"
            @foreach ($role->permissions as $role_permit)
                @if ($role_permit->id == $permission->id)
                
                checked
                    
                @endif
            @endforeach
            >{{ $permission->name }}</label>
         
        </div>
          
        @endif
          
        @endforeach
    </div>
    <div class="col-lg-4">
     <label for="">Other Permission</label>
     @foreach ($permissions as $permission)
        @if ($permission->for == 'other')
        <div class="checkbox">
         <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}"
            @foreach ($role->permissions as $role_permit)
                @if ($role_permit->id == $permission->id)
                
                checked
                    
                @endif
            @endforeach
            >{{ $permission->name }}</label>
         
        </div>
          
        @endif
          
        @endforeach
    </div>
   </div>
