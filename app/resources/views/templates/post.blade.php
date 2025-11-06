@php
use App\Models\User;
@endphp
<div class='post_preview'>
	<fieldset>
		<div class='post'>
			@if(!isset($no_reports) && Auth::check())
				@include('templates.create_report_form', ['id'=>$post->id, 'type'=>"post"])
			@endif

			@can('isAdmin')
			<form method='POST' action='{{URL("posts/" . $post->id)}}'onclick='return confirm("Delete Post: {{$post->title}}\nAre you sure?")'>
			@csrf
			@method('DELETE')
				<input type='submit' value='Delete this Post'>
			</form>
			@endcan
			
			@if(count($post->files)>0)
				<span style='font-size: 0.8em;'>file: <a href='{{asset("storage/" . $post->files->first()->file_path)}}' target="_blank">{{substr($post->files->first()->file_path, 11)}}</a>
				</span>
			@endif
			<div class='post_content'>
			@if(count($post->files)>0)
				<img class='review_img' src='{{asset("storage/" . $post->files->first()->file_path)}}'></img>
			<br>
			@endif
			<span style='white-space: nowrap;'>
				@if($post->status == 'pinned')
				<span style='color: red'>PINNED</span>
				@endif
				<span class='user_index'>{{User::findOrFail($post->id_user)->name}}</span>
				<span>{{$post->updated_at}}</span>
				<span class='title_index'><a href='{{URL("posts/" . $post->id)}}'>{{$post->title}}</a></span>
			</span>
			<br>
			<blockquote>{{$post->content}}</blockquote>
			</div>
		</div>
		@if(count($post->comments)>0)
			@if(isset($limit))
				@for($i = count($post->comments) - $limit; $i <= count($post->comments) - 1; $i++)
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