{!! Form::label('name', 'Name') !!}
{!! Form::text('name', null, ['id'=>'name','class'=>'form-control', 'placeholder'=>'Enter User Name']) !!}
{!! Form::label('email', 'Email') !!}
{!! Form::text('email', null, ['id'=>'email','class'=>'form-control', 'placeholder'=>'Enter Email Name']) !!}
<div class="form-group">
 <label for="password">Password</label>
 <input type="password" class="form-control" id="password" name="password" placeholder="password">
</div>

<div class="form-group">
 <label for="password_confirmation">Confirm Password</label>
 <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="confirm password">
</div>

<div class="form-group">
 <label for="roles">roles</label>
 <select class="form-control" multiple name="roles[]" id="">
     @foreach ($roles as $role)
       <option value="{{ $role->id }}" 
        @if (in_array($role->id, $user->roles->pluck('id')->toArray())) selected @endif
        >{{ $role->name }}</option>
     @endforeach
 </select>
</div>