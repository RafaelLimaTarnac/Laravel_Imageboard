@php
use App\Models\User;
@endphp
<div class='post_preview'>
	<fieldset>
		<div class='post'>

			@include('templates.create_report_form', ['id'=>$post->id, 'type'=>"post"])

			@can('isAdmin')
			<form method='POST' action='{{URL("posts/" . $post->id)}}'>
			@csrf
			@method('DELETE')
				<input type='submit' value='Delete this Post'>
			</form>
			@endcan
			<span>
			@if($post->isPinned)
				<span style='color: red'>PINNED</span>
			@endif
			<span>{{$post->created_at}}</span>
			<span class='user_index'>{{User::findOrFail($post->id_user)->name}}</span>
			<span class='title_index'><a href='{{URL("posts/" . $post->id)}}'>{{$post->title}}</a></span>
			</span>
			<br>

			<div class='post_content'>
			@if(count($post->files)>0)
				<img class='post_index_img' src='{{asset("storage/" . $post->files->first()->file_path)}}'></img>
			@endif
			<blockquote>{{$post->content}}</blockquote>
			</div>
		</div>
		@if(count($post->comments)>0)
			@if(isset($limit))
				@for($i = 0; $i <= $limit - 1; $i++)
					@if(isset($post->comments[$i]))
						@include('templates.comment', ['comment'=>$post->comments[$i]])
					@endif
				@endfor
			@else
				@foreach($post->comments as $comment)
					@include('templates.comment', ['comment'=>$comment])
				@endforeach
			@endif
		@endif
	</fieldset>
</div>